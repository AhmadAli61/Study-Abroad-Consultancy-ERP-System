<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Mail\InquiryStatusChanged;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotesNotification; // Add this
use App\Mail\ApplicationSubmissionConfirmation;
use App\Mail\StudentStatusChanged; // Add this


class RegisteredInquiry extends Model
{
    protected $fillable = [
        'unique_id',
        'parent_id', // ← ADD THIS LINE
        'inquiry_id',
        'users_id',
        'passport_number',
        'student_name',
        'partner',
        'student_contact',
        'emergency_contact_1',
        'emergency_contact_2',
        'course_link',
        'course_name',
        'notes_history',
        'university_name',
        'inquiry_status',
        'status_change_time',
        'last_inquiry_status',
        'course_intake',
        'gmail_password',
        'matric_dmc_path',
        'intermediate_dmc_path',
        'bs_hons_path',
        'ba_bsc_path',
        'ma_msc_path',
        'reference_letters_path',
        'cv_file_path',
        'passport_pages_path',
        'experience_letter_path',
        'english_test_path',
        'agent_consent_path',
        'student_consent_path',
        'additional_docs_path',
        'extra_path',
        'extra2_path',
        'extra3_path',
        'extra4_path',
        'extra5_path',
        'extra6_path',
        'extra7_path',
        'extra8_path',
        'extra9_path',
        'extra10_path',
        'extra11_path',
        'refusal_letter_path',
        'has_refusal_letter',
        'notes',
        'assigned_at',
        'assigned_to',
        'status',
        'status_updated_at',
        'previous_assigned_to',
        'previous_assigned_at'
    ];

    protected $casts = [
        'notes_history' => 'array',
        'assigned_at' => 'datetime',
        'status_updated_at' => 'datetime',
        'previous_assigned_at' => 'datetime',
                'status_change_time' => 'datetime' // Add this

    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiiry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
public function getSeenByAdmissionTime()
{
    $notification = \App\Models\Notification::where('type', 'new_application')
        ->where('registered_inquiry_id', $this->id)
        ->whereNotNull('read_at')
        ->orderBy('read_at', 'desc')
        ->first();

    return $notification ? $notification->read_at : null;
}

public function hasBeenSeenByAdmission()
{
    return $this->getSeenByAdmissionTime() !== null;
}
    public function previousAssignedTo()
    {
        return $this->belongsTo(User::class, 'previous_assigned_to');
    }
    public function previousAssignedUser()
{
    return $this->belongsTo(User::class, 'previous_assigned_to');
}

public function assignedUser()
{
    return $this->belongsTo(User::class, 'assigned_to');
}
public function admissionForms()
{
    return $this->hasMany(AdmissionForm::class, 'registered_inquiry_id');
}
// Add to your RegisteredInquiry model
public function intake()
{
    return $this->belongsTo(Intake::class);
}

// Add a scope for inquiries without intake
public function scopeWithoutIntake($query)
{
    return $query->whereNull('intake_id');
}
   // Add this new relationship for parent inquiry
    public function parentInquiry()
    {
        return $this->belongsTo(RegisteredInquiry::class, 'parent_id');
    }

    // Optional: Relationship for child inquiries
    public function childInquiries()
    {
        return $this->hasMany(RegisteredInquiry::class, 'parent_id');
    }
// App\Models\RegisteredInquiry.php
public function registeredByUser()
{
    return $this->belongsTo(User::class, 'users_id');
}
   protected static function booted()
    {
        static::created(function ($inquiry) {
            // Send application submission confirmation email to student
            static::sendApplicationSubmissionEmail($inquiry);
        });

        static::updated(function ($inquiry) {
            // Check if status was changed
            if ($inquiry->isDirty('inquiry_status')) {
                $oldStatus = $inquiry->getOriginal('inquiry_status');
                $newStatus = $inquiry->inquiry_status;
                $inquiry->updateQuietly(['status_change_time' => now()]);
                
                // Send email notification to counsellor
                static::sendStatusChangeEmail($inquiry, $oldStatus, $newStatus);
                
                // Send email notification to student
                static::sendStudentStatusChangeEmail($inquiry, $oldStatus, $newStatus);
                
                // Create notification for status change
                Notification::createStatusChangeNotification($inquiry, $oldStatus, $newStatus);
            }
            
            // Check if notes_history was changed (new message added)
            if ($inquiry->isDirty('notes_history')) {
                $oldNotes = static::parseNotesHistory($inquiry->getOriginal('notes_history'));
                $newNotes = static::parseNotesHistory($inquiry->notes_history);
                
                // Find the new message by comparing arrays
                if (count($newNotes) > count($oldNotes)) {
                    $latestMessage = end($newNotes);
                    static::sendNotesNotification($inquiry, $latestMessage);
                }
            }
        });
    }
    /**
 * Send status change email to student
 */
/**
 * Send status change email to student
 */
protected static function sendStudentStatusChangeEmail($inquiry, $oldStatus, $newStatus)
{
    try {
        // Extract student email from gmail_password column
        $gmailPasswordData = $inquiry->gmail_password;
        
        if (empty($gmailPasswordData)) {
            \Log::warning('gmail_password is empty for student status change notification', [
                'inquiry_id' => $inquiry->id,
                'student_name' => $inquiry->student_name
            ]);
            return;
        }
        
        // Extract email (part before the slash)
        $emailParts = explode('/', $gmailPasswordData);
        $studentEmail = trim($emailParts[0]);
        
        // Validate email format
        if (!filter_var($studentEmail, FILTER_VALIDATE_EMAIL)) {
            \Log::warning('Invalid email format in gmail_password for student notification', [
                'inquiry_id' => $inquiry->id,
                'gmail_password_data' => $gmailPasswordData,
                'extracted_email' => $studentEmail
            ]);
            return;
        }
        
        // Use fixed company contact details
        $companyEmail = 'admission@companyconsultancy.com';
        $companyPhone = '+92 3021495826';
        
        // Check for other active applications ONLY for negative status changes
        $activeApplications = [];
        $negativeStatuses = ['caseclosed', 'withdrawn', 'rejection'];
        
        if (in_array($newStatus, $negativeStatuses)) {
            $activeApplications = static::getOtherActiveApplications($inquiry);
        }
        
        // Send the email to student
        Mail::to($studentEmail)
            ->send(new StudentStatusChanged($inquiry, $oldStatus, $newStatus, $studentEmail, $companyEmail, $companyPhone, $activeApplications));
            
        \Log::info('Student status change notification sent successfully', [
            'to' => $studentEmail,
            'inquiry_id' => $inquiry->id,
            'student_name' => $inquiry->student_name,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'company_email' => $companyEmail,
            'company_phone' => $companyPhone,
            'other_active_applications' => count($activeApplications)
        ]);
        
    } catch (\Exception $e) {
        // Log the error but don't break the application
        \Log::error('Failed to send student status change notification: ' . $e->getMessage(), [
            'inquiry_id' => $inquiry->id,
            'student_name' => $inquiry->student_name,
            'error' => $e->getMessage()
        ]);
    }
}

/**
 * Get other active applications for the same student
 */
protected static function getOtherActiveApplications($currentInquiry)
{
    // List of active statuses
    $activeStatuses = ['underassessment', 'processed', 'conditional', 'unconditional', 'undercas', 'casreceived', 'visaprocess'];
    
    // Find all applications for the same student (using gmail_password)
    $studentEmail = explode('/', $currentInquiry->gmail_password)[0];
    
    $otherApplications = static::where('gmail_password', 'like', $studentEmail . '/%')
        ->where('id', '!=', $currentInquiry->id) // Exclude current application
        ->whereIn('inquiry_status', $activeStatuses)
        ->get(['id', 'unique_id', 'university_name', 'course_name', 'inquiry_status', 'parent_id']);
    
    return $otherApplications;
}
    protected static function sendApplicationSubmissionEmail($inquiry)
{
    try {
        // Extract student email from gmail_password column
        $gmailPasswordData = $inquiry->gmail_password;
        
        if (empty($gmailPasswordData)) {
            \Log::warning('gmail_password is empty for application submission confirmation', [
                'inquiry_id' => $inquiry->id,
                'student_name' => $inquiry->student_name
            ]);
            return;
        }
        
        // Extract email (part before the slash)
        $emailParts = explode('/', $gmailPasswordData);
        $studentEmail = trim($emailParts[0]);
        
        // Validate email format
        if (!filter_var($studentEmail, FILTER_VALIDATE_EMAIL)) {
            \Log::warning('Invalid email format in gmail_password', [
                'inquiry_id' => $inquiry->id,
                'gmail_password_data' => $gmailPasswordData,
                'extracted_email' => $studentEmail
            ]);
            return;
        }
        
        // Use fixed company contact details
        $companyEmail = 'admission@companyconsultancy.com';
        $companyPhone = '+92 3021495826';
        
        // Send the email
        Mail::to($studentEmail)
            ->send(new ApplicationSubmissionConfirmation($inquiry, $studentEmail, $companyEmail, $companyPhone));
                
        \Log::info('Application submission confirmation sent successfully', [
            'to' => $studentEmail,
            'inquiry_id' => $inquiry->id,
            'student_name' => $inquiry->student_name,
            'company_email' => $companyEmail,
            'company_phone' => $companyPhone
        ]);
        
    } catch (\Exception $e) {
        // Log the error but don't break the application
        \Log::error('Failed to send application submission confirmation email: ' . $e->getMessage(), [
            'inquiry_id' => $inquiry->id,
            'student_name' => $inquiry->student_name,
            'error' => $e->getMessage()
        ]);
    }
}

     protected static function sendStatusChangeEmail($inquiry, $oldStatus, $newStatus)
    {
        try {
            // Get the user who submitted the application
            $user = $inquiry->user;
            
            if ($user && $user->email) {
                Mail::to($user->email)
                    ->send(new InquiryStatusChanged($inquiry, $oldStatus, $newStatus, $user));
            }
        } catch (\Exception $e) {
            // Log the error but don't break the application
            \Log::error('Failed to send status change email: ' . $e->getMessage());
        }
    }
     protected static function parseNotesHistory($notesHistory)
    {
        if (empty($notesHistory)) {
            return [];
        }
        
        // If it's already an array, return as is
        if (is_array($notesHistory)) {
            return $notesHistory;
        }
        
        // If it's a JSON string, decode it
        if (is_string($notesHistory)) {
            $decoded = json_decode($notesHistory, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        return [];
    }
    protected static function sendNotesNotification($inquiry, $messageData)
    {
        try {
            // Get the sender (user who posted the message)
            $sender = User::where('username', $messageData['user_name'] ?? '')
                         ->orWhere('id', $messageData['user_id'] ?? null)
                         ->first();
            
            if (!$sender) {
                \Log::warning('Sender not found for notes notification', ['message_data' => $messageData]);
                return;
            }

            // Get recipients based on the logic you described
            $recipients = static::getNotesNotificationRecipients($inquiry, $sender);
            
            foreach ($recipients as $recipient) {
                // Don't send email to the person who posted the message
                if ($recipient->id !== $sender->id && !empty($recipient->email)) {
                    Mail::to($recipient->email)
                        ->send(new NotesNotification($inquiry, $messageData, $sender));
                        
                    \Log::info('Notes notification sent', [
                        'to' => $recipient->email,
                        'inquiry_id' => $inquiry->id,
                        'sender' => $sender->username
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send notes notification email: ' . $e->getMessage());
        }
    }

    /**
     * Get recipients for notes notifications based on your criteria
     */
    protected static function getNotesNotificationRecipients($inquiry, $sender)
    {
        $recipients = collect();

        // Always include the agent who submitted the application (users_id)
        if ($inquiry->user && $inquiry->user->email) {
            $recipients->push($inquiry->user);
        }

        // Get the assigned admission user (assigned_to)
        if ($inquiry->assigned_to) {
            $assignedUser = User::find($inquiry->assigned_to);
            if ($assignedUser && $assignedUser->email) {
                $recipients->push($assignedUser);
            }
        }

        // Get additional users based on sender's role
        $additionalUsers = static::getAdditionalRecipientsBySenderRole($sender, $inquiry);
        $recipients = $recipients->merge($additionalUsers);

        // Remove duplicates
        return $recipients->unique('id');
    }

    /**
     * Get additional recipients based on who sent the message
     */
    protected static function getAdditionalRecipientsBySenderRole($sender, $inquiry)
    {
        $additionalUsers = collect();

        switch ($sender->role) {
            case 'admin':
                // When admin posts: send to admission role users and assigned_to user
                $additionalUsers = User::where('role', 'admission')
                    ->orWhere(function($query) use ($inquiry) {
                        $query->where('id', $inquiry->assigned_to);
                    })
                    ->get();
                break;

            case 'admission':
                // When admission posts: send to admin (full_access), managers, and assigned_to user
                $additionalUsers = User::where(function($query) {
                        $query->where('role', 'admin')
                              ->where('permission_level', 'full_access');
                    })
                    ->orWhere('role', 'manager')
                    ->orWhere(function($query) use ($inquiry) {
                        $query->where('id', $inquiry->assigned_to);
                    })
                    ->get();
                break;

            case 'admissionagent':
                // When assigned agent posts: send to admin (full_access), admission users, and the application owner
                $additionalUsers = User::where(function($query) {
                        $query->where('role', 'admin')
                              ->where('permission_level', 'full_access');
                    })
                    ->orWhere('role', 'admission')
                    ->orWhere(function($query) use ($inquiry) {
                        $query->where('id', $inquiry->users_id);
                    })
                    ->get();
                break;

            default:
                // For other roles (manager, counsellor, externalagent): send to admin, admission, and assigned_to
                $additionalUsers = User::where('role', 'admin')
                    ->orWhere('role', 'admission')
                    ->orWhere(function($query) use ($inquiry) {
                        $query->where('id', $inquiry->assigned_to);
                    })
                    ->get();
                break;
        }

        return $additionalUsers;
    }

}