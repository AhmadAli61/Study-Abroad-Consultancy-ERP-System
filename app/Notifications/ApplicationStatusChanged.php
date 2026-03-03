<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public $application;
    public $oldStatus;
    public $newStatus;

    public function __construct($application, $oldStatus, $newStatus)
    {
        $this->application = $application;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Application Status Updated - company Portal')
            ->greeting('Hello ' . $notifiable->username . '!')
            ->line('The status of your application has been updated.')
            ->line('**Student:** ' . $this->application->student_name)
            ->line('**Passport:** ' . $this->application->passport_number)
            ->line('**University:** ' . $this->application->university_name)
            ->line('**Course:** ' . $this->application->course_name)
            ->line('**Previous Status:** ' . ucwords(str_replace('_', ' ', $this->oldStatus)))
            ->line('**New Status:** ' . ucwords(str_replace('_', ' ', $this->newStatus)))
            ->action('View Application', url('/admin/admission/applications'))
            ->line('Thank you for using our application!');
    }
}