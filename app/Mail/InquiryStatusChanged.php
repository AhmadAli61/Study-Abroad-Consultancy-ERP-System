<?php

namespace App\Mail;

use App\Models\RegisteredInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $oldStatus;
    public $newStatus;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(RegisteredInquiry $inquiry, $oldStatus, $newStatus, $user)
    {
        $this->inquiry = $inquiry;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
   public function build()
{
    return $this->from('noreply@companyportal.ramadanumrah2025.co.uk', 'company Portal')
                ->replyTo('do-not-reply@companyportal.ramadanumrah2025.co.uk', 'Do Not Reply')
                ->subject('Application Status Updated - ' . $this->inquiry->unique_id)
                ->view('emails.inquiry-status-changed')
                ->withHeaders([
                    'X-Auto-Response-Suppress' => 'OOF, AutoReply',
                ]);
}
}