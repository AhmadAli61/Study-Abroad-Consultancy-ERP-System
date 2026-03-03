<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use App\Models\PortalLog;
use Jenssegers\Agent\Agent;


class LogUserLogin
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
        $agent = new Agent();
        PortalLog::create([
            'user_id' => $event->user->id,
            'role' => $event->user->role ?? 'N/A',
            'login_time' => now(),
            'ip_address' => request()->ip(),
            'device' => $agent->platform() . ' - ' . $agent->browser(),
            'is_logged_in' => true,
        ]);
    }
}
