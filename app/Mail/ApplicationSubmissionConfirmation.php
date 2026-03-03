<?php

namespace App\Mail;

use App\Models\RegisteredInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationSubmissionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $studentEmail;
    public $companyEmail;
    public $companyPhone;

    /**
     * Create a new message instance.
     */
    public function __construct(RegisteredInquiry $inquiry, $studentEmail)
    {
        $this->inquiry = $inquiry;
        $this->studentEmail = $studentEmail;
        $this->companyEmail = 'admission@7skyconsultancy.com';
        $this->companyPhone = '+92 3021495826';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('noreply@7skyportal.ramadanumrah2025.co.uk', '7Sky Consultancy')
                    ->replyTo('do-not-reply@7skyportal.ramadanumrah2025.co.uk', 'Do Not Reply')
                    ->subject('Application Successfully Registered – 7 Sky Consultancy')
                    ->view('emails.application-submission-confirmation')
                    ->withHeaders([
                        'X-Auto-Response-Suppress' => 'OOF, AutoReply',
                    ]);
    }
}