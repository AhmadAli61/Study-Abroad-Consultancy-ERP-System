<?php

namespace App\Livewire\Agent;

use Livewire\Component;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class DailyReportReminder extends Component
{
    public $showReminder = false;
    public $missingReportDate = null;
    public $reminderMessage = '';
    public $missingDates = [];

    protected $listeners = ['refreshDailyReportReminder' => 'checkReportSubmission'];

    public function mount()
    {
        $this->checkReportSubmission();
    }

    public function checkReportSubmission()
    {
        // Don't show reminder if on daily report page
        if (Route::currentRouteName() === 'agent.dailyreport') {
            $this->showReminder = false;
            return;
        }

        $userId = auth()->id();
        $today = Carbon::today();
        $currentTime = now();
        
        // Get the start date (today)
        $startDate = $today->copy();
        
        // After one week, check for missing reports from past 7 days (excluding Sundays)
        if ($today->diffInDays($today->copy()->startOfWeek()) >= 7) {
            $this->checkWeeklyMissingReports($userId, $today);
            return;
        }
        
        // Normal daily check (for today and past 5 days)
        $this->checkDailyMissingReports($userId, $today, $currentTime);
    }

    protected function checkWeeklyMissingReports($userId, $today)
    {
        $missingDates = [];
        $startDate = $today->copy()->subDays(6); // Check last 6 days + today
        
        for ($date = $startDate; $date <= $today; $date->addDay()) {
            // Skip Sundays (dayOfWeek 0 in Carbon)
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                continue;
            }
            
            $reportExists = Report::where('user_id', $userId)
                ->whereDate('date', $date->format('Y-m-d'))
                ->exists();
                
            if (!$reportExists) {
                $missingDates[] = $date->copy();
            }
        }
        
        if (!empty($missingDates)) {
            $this->missingReportDate = $missingDates[0]->format('Y-m-d');
            
            if (count($missingDates) > 1) {
                $dateList = collect($missingDates)->map(function($date) {
                    return $date->format('F j');
                })->join(', ', ' and ');
                
                $this->reminderMessage = "You have missing reports for multiple dates: " . $dateList . 
                    ". Please submit your reports starting with " . $missingDates[0]->format('F j, Y');
            } else {
                $this->reminderMessage = "You haven't submitted your daily report for " . 
                    $missingDates[0]->format('F j, Y') . ". Please submit it now to continue.";
            }
            
            $this->showReminder = true;
        } else {
            $this->showReminder = false;
        }
    }

   protected function checkDailyMissingReports($userId, $today, $currentTime)
{
    // Check for today's report during working hours (5:30 PM - 11:59 PM)
    $reminderStartTime = $today->copy()->setTime(18, 0, 0);
    $reminderEndTime = $today->copy()->setTime(23, 59, 59);
    
    if ($currentTime->between($reminderStartTime, $reminderEndTime)) {
        $todayReportSubmitted = Report::where('user_id', $userId)
            ->whereDate('date', $today->format('Y-m-d'))
            ->exists();

        if (!$todayReportSubmitted) {
            $this->missingReportDate = $today->format('Y-m-d');
            $this->reminderMessage = "Don't forget to submit your daily report by <strong>7:00 PM</strong> to stay on track.";
            $this->showReminder = true;
            return;
        }
    }
    
    // Check for missing reports in the last 5 days (excluding Sundays)
    $missingDates = [];
    $daysToCheck = 5;
    
    for ($i = 1; $i <= $daysToCheck; $i++) {
        $checkDate = $today->copy()->subDays($i);
        
        // Skip Sundays
        if ($checkDate->dayOfWeek === Carbon::SUNDAY) {
            continue;
        }
        
        $reportExists = Report::where('user_id', $userId)
            ->whereDate('date', $checkDate->format('Y-m-d'))
            ->exists();
            
        if (!$reportExists) {
            $missingDates[] = $checkDate->copy();
        }
    }
    
    // Sort dates in ascending order (oldest first)
    usort($missingDates, function($a, $b) {
        return $a->timestamp - $b->timestamp;
    });
    
    if (!empty($missingDates)) {
        $this->missingReportDate = $missingDates[0]->format('Y-m-d');
        
        if (count($missingDates) > 1) {
            // Format dates as bullet points
            $dateList = collect($missingDates)->map(function($date) {
                return "• <strong>" . $date->format('F j') . "</strong>";
            })->join('<br>');
            
            $this->reminderMessage = "You have missing reports for the following dates:<br>" . $dateList . 
                "<br><br>Submit your reports starting with " . $missingDates[0]->format('F j, Y');
        } else {
            $this->reminderMessage = "You haven't submitted your daily report for <strong>" . 
                $missingDates[0]->format('F j, Y') . "</strong>. Please submit it now to continue.";
        }
        
        $this->showReminder = true;
        return;
    }
    
    $this->showReminder = false;
}

    public function render()
    {
        return view('livewire.agent.daily-report-reminder');
    }
}