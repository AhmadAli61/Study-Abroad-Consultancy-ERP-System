<?php

namespace App\Console\Commands;

use App\Models\Intake;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;

class CleanupOldIntakes extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'intakes:cleanup';

    /**
     * The console command description.
     */
    protected $description = 'Remove intakes older than 5 years and unassign their inquiries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentYear = date('Y');
        $cutoffYear = $currentYear - 5;

        $this->info("🧹 Cleaning up intakes older than {$cutoffYear}...");

        // Fetch all intakes older than 5 years
        $oldIntakes = Intake::where('year', '<', $cutoffYear)->get();

        if ($oldIntakes->isEmpty()) {
            $this->info('✅ No old intakes found to clean up.');
            return Command::SUCCESS;
        }

        $this->info("📦 Found {$oldIntakes->count()} intakes to clean up.\n");

        DB::transaction(function () use ($oldIntakes) {
            foreach ($oldIntakes as $intake) {
                $this->line("➡ Processing intake: {$intake->display_name}");

                // Unassign inquiries
                $updatedCount = DB::table('registered_inquiries')
                    ->where('intake_id', $intake->id)
                    ->update([
                        'intake_id' => null,
                        'added_to_intake_at' => null,
                    ]);

                $this->info("🔄 Unassigned {$updatedCount} inquiries from {$intake->display_name}");

                // Delete intake
                $intake->delete();
                $this->info("❌ Deleted intake: {$intake->display_name}\n");
            }
        });

        $this->info('🎯 Intake cleanup completed successfully.');
        return Command::SUCCESS;
    }

    /**
     * Define the schedule for this command (Laravel 11 style).
     */
    public function schedule(Schedule $schedule): void
    {
        // Run every day at 2:00 AM
        $schedule->command(static::class)->dailyAt('02:00');

        // 🧪 For testing, uncomment this to run every minute
        // $schedule->command(static::class)->everyMinute();
    }
}
