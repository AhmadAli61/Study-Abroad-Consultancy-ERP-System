<?php
// app/Services/WhatsAppIntegrationService.php

namespace App\Services;

use App\Models\Inquiiry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class WhatsAppIntegrationService
{
    protected $whatsappToken;
    protected $phoneNumberId;
    protected $metaService;

    public function __construct(MetaIntegrationService $metaService)
    {
        $this->whatsappToken = config('services.whatsapp.token');
        $this->phoneNumberId = config('services.whatsapp.phone_number_id');
        $this->metaService = $metaService;
    }

    /**
     * Handle incoming WhatsApp message
     */
    public function handleIncomingMessage($payload)
    {
        Log::info('WhatsApp message received', $payload);

        try {
            // Extract message details
            $contacts = $payload['entry'][0]['changes'][0]['value']['contacts'][0] ?? null;
            $messages = $payload['entry'][0]['changes'][0]['value']['messages'][0] ?? null;
            
            if (!$contacts || !$messages) {
                return;
            }

            $waId = $contacts['wa_id'];
            $profileName = $contacts['profile']['name'] ?? null;
            $messageId = $messages['id'];
            $messageType = $messages['type'];
            $messageText = $messages['text']['body'] ?? null;

            // Check if this is from a Click-to-WhatsApp ad
            $conversation = $payload['entry'][0]['changes'][0]['value']['conversation'] ?? null;
            $adId = null;
            $campaignId = null;
            
            if ($conversation && isset($conversation['origin']['type']) && $conversation['origin']['type'] === 'ad') {
                // This is from a Click-to-WhatsApp ad
                $adId = $conversation['origin']['ad_id'] ?? null;
                $campaignId = $conversation['origin']['campaign_id'] ?? null;
            }

            // Check if we already have this WhatsApp conversation
            $existingInquiry = Inquiiry::where('whatsapp_conversation_id', $messageId)
                ->orWhere('phone_number', $waId)
                ->first();

            if (!$existingInquiry) {
                // Create new inquiry from WhatsApp
                $this->createInquiryFromWhatsApp($waId, $profileName, $messageId, $messageText, $adId, $campaignId);
            }

        } catch (\Exception $e) {
            Log::error('WhatsApp webhook error', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Create inquiry from WhatsApp message
     */
    protected function createInquiryFromWhatsApp($waId, $profileName, $messageId, $messageText, $adId, $campaignId)
    {
        // Fetch campaign details if available
        $campaignName = null;
        $campaignCountry = null;

        if ($campaignId) {
            $campaignDetails = $this->fetchCampaignDetails($campaignId);
            $campaignName = $campaignDetails['name'] ?? null;
            $campaignCountry = $this->metaService->extractCountryFromCampaign($campaignName ?? '');
        }

        $inquiry = Inquiiry::create([
            'whatsapp_conversation_id' => $messageId,
            'name' => $profileName,
            'phone_number' => $waId,
            'type' => 'Meta Leads W',
            'status' => 'unassigned',
            'inquiry_status' => 'pending',
            'response' => "Initial WhatsApp message: " . ($messageText ?? 'No message'),
            'ad_id' => $adId,
            'campaign_id' => $campaignId,
            'campaign_name' => $campaignName,
            'campaign_country' => $campaignCountry,
            'meta_sync_status' => 'pending',
        ]);

        Log::info('New WhatsApp lead created', ['inquiry_id' => $inquiry->id]);
        
        return $inquiry;
    }

    /**
     * Fetch campaign details from Meta
     */
    protected function fetchCampaignDetails($campaignId)
    {
        try {
            $response = Http::get("https://graph.facebook.com/v22.0/{$campaignId}", [
                'access_token' => config('services.meta.access_token'),
                'fields' => 'name,objective'
            ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            Log::error('Failed to fetch campaign details', ['campaign_id' => $campaignId]);
        }

        return [];
    }
}