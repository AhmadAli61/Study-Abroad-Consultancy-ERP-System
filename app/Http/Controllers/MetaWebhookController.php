<?php
// app/Http/Controllers/MetaWebhookController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiiry;
use App\Services\MetaIntegrationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class MetaWebhookController extends Controller
{
    protected $metaService;

    public function __construct(MetaIntegrationService $metaService)
    {
        $this->metaService = $metaService;
    }

    /**
     * Verify webhook (for Meta verification)
     */
    public function verify(Request $request)
    {
        $mode = $request->get('hub_mode');
        $token = $request->get('hub_verify_token');
        $challenge = $request->get('hub_challenge');

        if ($mode === 'subscribe' && $token === config('services.meta.webhook_verify_token')) {
            return response($challenge, 200);
        }

        return response('Forbidden', 403);
    }

    /**
     * Handle incoming lead data from Meta
     */
    public function handleLead(Request $request)
    {
        Log::info('Meta Webhook Received', $request->all());

        try {
            $data = $request->all();

            if (isset($data['entry'])) {
                foreach ($data['entry'] as $entry) {
                    if (isset($entry['changes'])) {
                        foreach ($entry['changes'] as $change) {
                            if ($change['field'] === 'leadgen') {
                                $this->processLead($change['value']);
                            }
                        }
                    }
                }
            }

            return response('OK', 200);
        } catch (\Exception $e) {
            Log::error('Meta Webhook Error: ' . $e->getMessage());
            return response('Error', 500);
        }
    }

    /**
     * Process individual lead
     */
    protected function processLead($leadData)
    {
        $leadgenId = $leadData['leadgen_id'] ?? null;
        $pageId = $leadData['page_id'] ?? null;
        $formId = $leadData['form_id'] ?? null;
        $adId = $leadData['ad_id'] ?? null;
        $adName = $leadData['ad_name'] ?? null;
        $campaignId = $leadData['campaign_id'] ?? null;
        $campaignName = $leadData['campaign_name'] ?? null;

        // Fetch lead details from Meta Graph API
        $leadDetails = $this->fetchLeadDetails($leadgenId);

        if (!$leadDetails) {
            Log::error('Could not fetch lead details', ['leadgen_id' => $leadgenId]);
            return;
        }

        // Extract field data
        $fieldData = [];
        foreach ($leadDetails['field_data'] ?? [] as $field) {
            $fieldData[$field['name']] = $field['values'][0] ?? null;
        }

        // Extract phone number (handle different field names)
        $phoneNumber = $this->extractPhoneNumber($fieldData);
        
        if (!$phoneNumber) {
            Log::warning('Lead has no phone number', ['leadgen_id' => $leadgenId]);
            return;
        }

        // Check for duplicate
        if (Inquiiry::where('phone_number', $phoneNumber)->exists()) {
            Log::info('Duplicate lead detected', ['phone' => $phoneNumber]);
            return;
        }

        // Extract country from campaign
        $campaignCountry = $this->metaService->extractCountryFromCampaign($campaignName ?? '');

        // Create inquiry
        $inquiry = Inquiiry::create([
            'meta_lead_id' => $leadgenId,
            'name' => $fieldData['full_name'] ?? $fieldData['name'] ?? null,
            'email' => $fieldData['email'] ?? null,
            'phone_number' => $phoneNumber,
            'phone_number2' => null,
            'type' => 'Meta Leads F',
            'status' => 'unassigned',
            'inquiry_status' => 'pending',
            'study_course' => $fieldData['course'] ?? $fieldData['study_level'] ?? $fieldData['program'] ?? null,
            'country' => $fieldData['country'] ?? $campaignCountry,
            'campaign_country' => $campaignCountry,
            'ad_id' => $adId,
            'ad_name' => $adName,
            'campaign_id' => $campaignId,
            'campaign_name' => $campaignName,
            'url' => $fieldData['url'] ?? null,
            'meta_raw_data' => json_encode($leadDetails),
            'meta_sync_status' => 'pending',
        ]);

        Log::info('New Meta lead created', ['inquiry_id' => $inquiry->id]);
    }

    /**
     * Fetch lead details from Meta Graph API
     */
    protected function fetchLeadDetails($leadgenId)
    {
        try {
            $accessToken = config('services.meta.access_token');
            $response = Http::get("https://graph.facebook.com/v22.0/{$leadgenId}", [
                'access_token' => $accessToken,
                'fields' => 'created_time,field_data,id,page_id,form_id,ad_id,ad_name,campaign_id,campaign_name'
            ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            Log::error('Failed to fetch lead details', [
                'leadgen_id' => $leadgenId,
                'error' => $e->getMessage()
            ]);
        }

        return null;
    }

    /**
     * Extract phone number from various field formats
     */
    protected function extractPhoneNumber($fieldData)
    {
        $phoneFields = ['phone_number', 'phone', 'mobile', 'contact', 'whatsapp'];
        
        foreach ($phoneFields as $field) {
            if (isset($fieldData[$field]) && !empty($fieldData[$field])) {
                return preg_replace('/[^0-9+]/', '', $fieldData[$field]);
            }
        }
        
        return null;
    }
}