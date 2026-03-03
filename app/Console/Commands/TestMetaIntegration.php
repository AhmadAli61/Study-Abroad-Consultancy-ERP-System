<?php
// app/Console/Commands/TestMetaIntegration.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Inquiiry;
use App\Services\MetaIntegrationService;

class TestMetaIntegration extends Command
{
    protected $signature = 'meta:test {inquiry_id}';
    protected $description = 'Test Meta integration for an inquiry';

    public function handle(MetaIntegrationService $metaService)
    {
        $inquiryId = $this->argument('inquiry_id');
        $inquiry = Inquiiry::find($inquiryId);

        if (!$inquiry) {
            $this->error('Inquiry not found');
            return 1;
        }

        $this->info('Testing Meta integration for inquiry: ' . $inquiryId);
        
        // Test lead event
        $this->info('Sending lead event...');
        $result = $metaService->sendLeadEvent($inquiry);
        $this->info($result ? '✓ Lead event sent' : '✗ Lead event failed');

        // Test status event
        if ($inquiry->inquiry_status) {
            $this->info('Sending status event...');
            $result = $metaService->sendStatusEvent(
                $inquiry, 
                $inquiry->previous_inquiry_status ?? 'pending', 
                $inquiry->inquiry_status
            );
            $this->info($result ? '✓ Status event sent' : '✗ Status event failed');
        }

        return 0;
    }
}