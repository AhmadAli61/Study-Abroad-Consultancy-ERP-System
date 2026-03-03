<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;

class NotificationBell extends Component
{
    public $unreadCount = 0;

    protected $listeners = ['notificationRead' => 'loadUnreadCount'];

    public function mount()
    {
        $this->loadUnreadCount();
    }

   public function loadUnreadCount()
{
    $this->unreadCount = Notification::where('type', 'new_application')
        ->where('notifiable_type', 'admission_team')
        ->where('notifiable_id', 0)
        ->whereNull('read_at')
        ->count();
}


    public function render()
    {
        return view('livewire.notification-bell');
    }
}