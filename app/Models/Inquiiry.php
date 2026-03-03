<?php
// app/Models/Inquiiry.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Services\MetaIntegrationService;
use Illuminate\Support\Facades\Log;

class Inquiiry extends Model
{
    use HasFactory;

    protected $table = 'inquiiries';

    protected $fillable = [
        'website', 'name', 'email', 'phone_number', 'url', 'type', 'status', 
        'assigned_to', 'assigned_at', 'response', 'inquiry_status', 
        'phone_number2', 'study_course', 'country', 'budget', 'plan', 'extra', 
        'previous_assigned_to', 'status_updated_at',
        'previous_inquiry_status', 'inquiry_status_updated_at',
        // New Meta fields
        'meta_lead_id', 'whatsapp_conversation_id', 'ad_id', 'ad_name',
        'campaign_id', 'campaign_name', 'campaign_country', 'meta_sync_status',
        'meta_raw_data', 'meta_synced_at', 'meta_sync_attempts'
    ];

    protected static function booted()
    {
        // When a new inquiry is created (from Meta)
        static::created(function ($inquiry) {
            // Send initial Lead event to Meta
            if (in_array($inquiry->type, ['Meta Leads F', 'Meta Leads W'])) {
                try {
                    $metaService = app(MetaIntegrationService::class);
                    $success = $metaService->sendLeadEvent($inquiry);
                    
                    $inquiry->update([
                        'meta_sync_status' => $success ? 'synced' : 'failed',
                        'meta_synced_at' => $success ? now() : null,
                    ]);
                    
                    if (!$success) {
                        $inquiry->increment('meta_sync_attempts');
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to send lead event to Meta', [
                        'inquiry_id' => $inquiry->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        });

        // When inquiry_status is updated - using your existing fields
        static::updating(function ($inquiry) {
            if ($inquiry->isDirty('inquiry_status')) {
                $inquiry->previous_inquiry_status = $inquiry->getOriginal('inquiry_status');
                $inquiry->inquiry_status_updated_at = now();
            }
        });

        // After update, send status change to Meta
        static::updated(function ($inquiry) {
            if ($inquiry->wasChanged('inquiry_status')) {
                $oldStatus = $inquiry->getOriginal('inquiry_status');
                $newStatus = $inquiry->inquiry_status;
                
                // Send to Meta for Meta leads only
                if (in_array($inquiry->type, ['Meta Leads F', 'Meta Leads W'])) {
                    try {
                        $metaService = app(MetaIntegrationService::class);
                        $success = $metaService->sendStatusEvent($inquiry, $oldStatus, $newStatus);
                        
                        if (!$success) {
                            Log::warning('Failed to send status update to Meta', [
                                'inquiry_id' => $inquiry->id,
                                'old_status' => $oldStatus,
                                'new_status' => $newStatus
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('Exception sending status update to Meta', [
                            'inquiry_id' => $inquiry->id,
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            }
        });
    }

    // Your existing relationships
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedToUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function previousAssignedUser()
    {
        return $this->belongsTo(User::class, 'previous_assigned_to');
    }

    public function User(){
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public static function checkAndUpdateStatus()
    {
        $inquiries = Inquiiry::whereIn('inquiry_status', ['cold', 'dead'])
                         ->where('assigned_at', '<', Carbon::now()->subMonth())
                         ->get();

        foreach ($inquiries as $inquiry) {
            $inquiry->update([
                'status' => 'unassigned',
                'assigned_to' => null,
                'assigned_at' => null,
            ]);
        }
    }

    // New scopes for Meta leads
    public function scopeMetaLeads($query)
    {
        return $query->whereIn('type', ['Meta Leads F', 'Meta Leads W']);
    }

    public function scopeFromCountry($query, $country)
    {
        return $query->where('campaign_country', $country);
    }

    public function scopeFromCampaign($query, $campaignId)
    {
        return $query->where('campaign_id', $campaignId);
    }
}