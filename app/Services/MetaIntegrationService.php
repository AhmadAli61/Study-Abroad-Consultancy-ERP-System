<?php
// app/Services/MetaIntegrationService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Inquiiry;

class MetaIntegrationService
{
    protected $accessToken;
    protected $pixelId;
    protected $apiVersion = 'v22.0';
    protected $testMode = false; // Set to false in production

    public function __construct()
    {
        // Add these to your .env file and config/services.php
        $this->accessToken = config('services.meta.access_token');
        $this->pixelId = config('services.meta.pixel_id');
    }

    /**
     * Send lead event to Meta (when new lead arrives)
     */
    public function sendLeadEvent(Inquiiry $inquiry)
    {
        // Only send for Meta leads
        if (!in_array($inquiry->type, ['Meta Leads F', 'Meta Leads W'])) {
            return false;
        }

        $eventData = [
            'event_name' => 'Lead',
            'event_time' => time(),
            'action_source' => 'system_generated',
            'user_data' => $this->hashUserData($inquiry),
            'custom_data' => [
                'lead_id' => $inquiry->id,
                'meta_lead_id' => $inquiry->meta_lead_id,
                'type' => $inquiry->type,
                'country' => $inquiry->campaign_country ?? $inquiry->country,
                'source' => $inquiry->type === 'Meta Leads F' ? 'form' : 'whatsapp',
            ],
            'event_source_url' => $inquiry->url ?? config('app.url'),
        ];

        // Add ad tracking if available
        if ($inquiry->ad_id) {
            $eventData['custom_data']['ad_id'] = $inquiry->ad_id;
            $eventData['custom_data']['campaign_id'] = $inquiry->campaign_id;
            $eventData['custom_data']['campaign_name'] = $inquiry->campaign_name;
        }

        return $this->sendEvent($eventData);
    }

    /**
     * Send status update event to Meta
     * Uses your existing previous_inquiry_status field
     */
    public function sendStatusEvent(Inquiiry $inquiry, $oldStatus, $newStatus)
    {
        // Only send for Meta leads
        if (!in_array($inquiry->type, ['Meta Leads F', 'Meta Leads W'])) {
            return false;
        }

        // Map your inquiry_status to Meta standard events
        $metaEvent = $this->mapStatusToMetaEvent($newStatus);
        
        if (!$metaEvent) {
            return false; // Don't send for non-conversion statuses (like pending)
        }

        $eventData = [
            'event_name' => $metaEvent,
            'event_time' => time(),
            'action_source' => 'system_generated',
            'user_data' => $this->hashUserData($inquiry),
            'custom_data' => [
                'lead_id' => $inquiry->id,
                'meta_lead_id' => $inquiry->meta_lead_id,
                'previous_status' => $oldStatus,
                'current_status' => $newStatus,
                'country' => $inquiry->campaign_country ?? $inquiry->country,
                'campaign_id' => $inquiry->campaign_id,
                'ad_id' => $inquiry->ad_id,
            ],
        ];

        // Add value for registered students (high value conversion)
        if ($newStatus === 'registered') {
            // You can customize this based on course/country
            $eventData['custom_data']['value'] = $this->getLeadValue($inquiry);
            $eventData['custom_data']['currency'] = 'USD';
        }

        return $this->sendEvent($eventData);
    }

    /**
     * Map your inquiry status to Meta event names
     */
    protected function mapStatusToMetaEvent($status)
    {
        return match(strtolower($status)) {
            'hot' => 'Qualified',        // Hot lead → Qualified
            'cold', 'dead' => 'Disqualified', // Cold/Dead → Disqualified
            'registered' => 'Complete',   // Registered → Complete
            'pending' => null,            // Don't send pending
            default => null,
        };
    }

    /**
     * Hash user data as required by Meta (SHA-256)
     */
    protected function hashUserData(Inquiiry $inquiry)
    {
        $userData = [
            'em' => $inquiry->email ? hash('sha256', strtolower(trim($inquiry->email))) : null,
            'ph' => $inquiry->phone_number ? hash('sha256', preg_replace('/[^0-9]/', '', $inquiry->phone_number)) : null,
            'fn' => $inquiry->name ? hash('sha256', strtolower(trim(explode(' ', $inquiry->name)[0]))) : null,
            'ln' => $inquiry->name && str_contains($inquiry->name, ' ') ? 
                   hash('sha256', strtolower(trim(substr($inquiry->name, strpos($inquiry->name, ' ') + 1)))) : null,
        ];

        // Remove null values
        return array_filter($userData);
    }

    /**
     * Send event to Meta Conversions API
     */
    protected function sendEvent(array $eventData)
    {
        if ($this->testMode) {
            Log::info('Meta CAPI Event (Test Mode):', $eventData);
            return true;
        }

        try {
            $response = Http::post("https://graph.facebook.com/{$this->apiVersion}/{$this->pixelId}/events", [
                'access_token' => $this->accessToken,
                'data' => [$eventData],
            ]);

            if ($response->successful()) {
                Log::info('Meta CAPI Event Sent Successfully', [
                    'event' => $eventData['event_name'],
                    'lead_id' => $eventData['custom_data']['lead_id'] ?? null
                ]);
                return true;
            } else {
                Log::error('Meta CAPI Event Failed', [
                    'event' => $eventData['event_name'],
                    'error' => $response->json()
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Meta CAPI Exception', [
                'message' => $e->getMessage(),
                'event' => $eventData['event_name'] ?? 'unknown'
            ]);
            return false;
        }
    }

    /**
     * Get lead value based on country/course
     */
    protected function getLeadValue(Inquiiry $inquiry)
    {
        // You can customize these values based on your business
        $values = [
            'UK' => 150,
            'US' => 200,
            'AU' => 180,
            'CA' => 170,
            'default' => 100
        ];

        return $values[$inquiry->campaign_country] ?? $values['default'];
    }

    /**
     * Extract country from campaign name
     */
    public function extractCountryFromCampaign($campaignName)
    {
        if (!$campaignName) return null;
        
        $campaignName = strtolower($campaignName);
        
        $countryPatterns = [
            'UK' => ['uk', 'united kingdom', 'england', 'scotland', 'wales'],
            'US' => ['us', 'usa', 'united states', 'america'],
            'AU' => ['au', 'australia', 'aussie'],
            'CA' => ['ca', 'canada'],
            'NZ' => ['nz', 'new zealand'],
            'IE' => ['ie', 'ireland'],
        ];

        foreach ($countryPatterns as $country => $patterns) {
            foreach ($patterns as $pattern) {
                if (str_contains($campaignName, $pattern)) {
                    return $country;
                }
            }
        }

        return null;
    }
}