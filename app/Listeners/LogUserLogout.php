<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Logout;
use App\Models\PortalLog;

class LogUserLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        PortalLog::where('user_id', $event->user->id)
        ->where('is_logged_in', true)
        ->latest()
        ->first()
        ?->update([
            'logout_time' => now(),
            'is_logged_in' => false,
        ]);
    }
}
