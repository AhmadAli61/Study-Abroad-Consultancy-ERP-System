<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'notifiable_id',
        'notifiable_type',
        'data',
        'registered_inquiry_id',
        'inquiry_id',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime'
    ];

    // Add relationships
    public function registeredInquiry()
    {
        return $this->belongsTo(RegisteredInquiry::class, 'registered_inquiry_id');
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiiry::class, 'inquiry_id');
    }

    public function agent()
    {
        return $this->hasOneThrough(
            User::class,
            RegisteredInquiry::class,
            'id',
            'id',
            'registered_inquiry_id',
            'users_id'
        );
    }
    
    // NEW: Method to create status change notifications
  public static function createStatusChangeNotification(RegisteredInquiry $inquiry, $oldStatus, $newStatus)
{
    // Create notification for ANY status change
    if ($oldStatus !== $newStatus) {
        
        // Create notification for the agent who owns this inquiry
        $notification = new self();
        $notification->type = 'status_change';
        $notification->notifiable_id = $inquiry->users_id;
        $notification->notifiable_type = User::class;
        $notification->registered_inquiry_id = $inquiry->id;
        $notification->data = [
            'message' => "Status of inquiry {$inquiry->unique_id} changed from {$oldStatus} to {$newStatus}",
            'inquiry_id' => $inquiry->id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'change_time' => now()->toDateTimeString(),
            'student_name' => $inquiry->student_name,
            'university_name' => $inquiry->university_name
        ];
        $notification->save();
        
        return $notification;
    }
    
    return null;
}
}