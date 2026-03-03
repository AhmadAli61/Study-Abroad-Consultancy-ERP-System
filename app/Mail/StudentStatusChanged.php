<?php

namespace App\Mail;

use App\Models\RegisteredInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $oldStatus;
    public $newStatus;
    public $studentEmail;
    public $companyEmail;
    public $companyPhone;
    public $activeApplications;

    /**
     * Create a new message instance.
     */
    public function __construct(RegisteredInquiry $inquiry, $oldStatus, $newStatus, $studentEmail, $companyEmail, $companyPhone, $activeApplications = [])
    {
        $this->inquiry = $inquiry;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->studentEmail = $studentEmail;
        $this->companyEmail = $companyEmail;
        $this->companyPhone = $companyPhone;
        $this->activeApplications = $activeApplications;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('noreply@7skyportal.ramadanumrah2025.co.uk', '7Sky Consultancy')
                    ->replyTo('do-not-reply@7skyportal.ramadanumrah2025.co.uk', 'Do Not Reply')
                    ->subject($this->getSubject())
                    ->view('emails.student-status-changed')
                    ->withHeaders([
                        'X-Auto-Response-Suppress' => 'OOF, AutoReply',
                    ]);
    }

    /**
     * Get email subject based on status change type
     */
    protected function getSubject()
    {
        $statusConfig = $this->getStatusConfig();
        $newStatusLabel = $statusConfig[$this->newStatus]['label'] ?? ucfirst($this->newStatus);
        
        // Special cases for negative statuses
        $negativeStatuses = ['caseclosed', 'withdrawn', 'rejection'];
        if (in_array($this->newStatus, $negativeStatuses)) {
            return 'Update Regarding Your Application – ' . $newStatusLabel;
        }
        
        // Special case for restarting from negative status
        $negativeToActive = in_array($this->oldStatus, $negativeStatuses) && $this->newStatus === 'underassessment';
        if ($negativeToActive) {
            return 'Your Application Process Has Restarted';
        }
        
        // Regular progress update
        return 'Application Update – Your Process Is Moving Forward';
    }

    /**
     * Get status configuration for labels
     */
    protected function getStatusConfig()
    {
        return [
            'underassessment' => ['label' => 'Under Assessment'],
            'processed' => ['label' => 'Processed'],
            'conditional' => ['label' => 'Conditional'],
            'unconditional' => ['label' => 'Unconditional'],
            'undercas' => ['label' => 'Under CAS'],
            'casreceived' => ['label' => 'CAS Received'],
            'visaprocess' => ['label' => 'Visa Process'],
            'enrollment' => ['label' => 'Enrollment'],
            'caseclosed' => ['label' => 'Case Closed'],
            'withdrawn' => ['label' => 'Withdrawn'],
            'rejection' => ['label' => 'Rejected'],
        ];
    }
}