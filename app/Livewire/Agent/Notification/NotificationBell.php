<?php

namespace App\Livewire\Agent\Notification;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public $unreadCount = 0;

    protected $listeners = ['refreshNotificationCount' => 'loadUnreadCount'];

    public function mount()
    {
        $this->loadUnreadCount();
    }

    public function loadUnreadCount()
    {
        $user = Auth::user();
        $this->unreadCount = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->where('type', 'status_change')
            ->whereNull('read_at')
            ->count();
    }

    public function render()
    {
        return view('livewire.agent.notification.notification-bell');
    }
}