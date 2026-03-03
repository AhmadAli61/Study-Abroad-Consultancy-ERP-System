<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserSession;
use App\Models\PortalLog;
use Illuminate\Support\Facades\DB;

class LogoutAllUsers extends Command
{
    protected $signature = 'users:logout-all';
    protected $description = 'Logout all users at midnight';

    public function handle()
    {
        DB::transaction(function () {
            UserSession::where('is_logged_in', true)->update(['is_logged_in' => false]);
            PortalLog::where('is_logged_in', true)->update(['is_logged_in' => false]);
        });
        
        $this->info('All users logged out successfully.');
    }
}