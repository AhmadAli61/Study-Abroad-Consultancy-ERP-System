<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;

class AdmissionNotification extends Component
{
    public $notifications = [];
    public $unreadCount = 0;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function redirectToApplication($registeredInquiryId)
    {
        return redirect()->route('admission.assign-application', ['id' => $registeredInquiryId]);
    }

    public function loadNotifications()
    {
        $this->notifications = Notification::where('type', 'new_application')
            ->where('notifiable_type', 'admission_team')
            ->where('notifiable_id', 0)
            ->with(['registeredInquiry.user', 'inquiry'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $this->unreadCount = Notification::where('type', 'new_application')
            ->where('notifiable_type', 'admission_team')
            ->where('notifiable_id', 0)
            ->whereNull('read_at')
            ->count();
    }

    public function getAgentName($notification)
    {
        if ($notification->registeredInquiry && $notification->registeredInquiry->user) {
            return $notification->registeredInquiry->user->username;
        }
        return $notification->data['agent_name'] ?? 'Unknown Agent';
    }

    public function getStudentName($notification)
    {
        if ($notification->registeredInquiry) {
            return $notification->registeredInquiry->student_name;
        }
        return $notification->data['student_name'] ?? 'Unknown Student';
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('notifiable_type', 'admission_team')
            ->where('notifiable_id', 0)
            ->first();
            
        if ($notification) {
            $notification->update(['read_at' => now()]);
            $this->loadNotifications();
            $this->dispatch('notificationRead');
        }
    }

    public function markAllAsRead()
    {
        Notification::where('type', 'new_application')
            ->where('notifiable_type', 'admission_team')
            ->where('notifiable_id', 0)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
            
        $this->loadNotifications();
        $this->dispatch('notificationRead');
    }

    public function render()
    {
        return view('livewire.admission-notification');
    }
}