<?php

namespace App\Livewire\Agent\Notification;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class CounsellorNotification extends Component
{
    public $notifications;

    protected $listeners = ['refreshNotifications' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications();
    }

  public function loadNotifications()
{
    $user = Auth::user();

    $this->notifications = Notification::with('registeredInquiry') // eager load
        ->where('notifiable_id', $user->id)
        ->where('notifiable_type', get_class($user))
        ->where('type', 'status_change')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();
}



    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification && is_null($notification->read_at)) {
            $notification->read_at = now();
            $notification->save();
            $this->loadNotifications();
            $this->dispatch('refreshNotificationCount');
        }
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->where('type', 'status_change')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
            
        $this->loadNotifications();
        $this->dispatch('refreshNotificationCount');
    }

    public function render()
    {
        return view('livewire.agent.notification.counsellor-notification');
    }
}