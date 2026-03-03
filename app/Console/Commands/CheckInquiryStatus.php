<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Inquiiry;

class CheckInquiryStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inquiries:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update inquiries status if cold or dead after 1 month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Inquiiry::checkAndUpdateStatus();
        $this->info('Inquiry status updated successfully.');
    }
}
