<?php

namespace App\Mail;

use App\Models\RegisteredInquiry;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotesNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $messageData;
    public $sender;

    /**
     * Create a new message instance.
     */
    public function __construct(RegisteredInquiry $inquiry, array $messageData, User $sender)
    {
        $this->inquiry = $inquiry;
        $this->messageData = $messageData;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('noreply@7skyportal.ramadanumrah2025.co.uk', '7Sky Portal')
                    ->replyTo('do-not-reply@7skyportal.ramadanumrah2025.co.uk', 'Do Not Reply')
                    ->subject('New Message - Application ' . $this->inquiry->unique_id)
                    ->view('emails.notes-notification')
                    ->withHeaders([
                        'X-Auto-Response-Suppress' => 'OOF, AutoReply',
                    ]);
    }
}