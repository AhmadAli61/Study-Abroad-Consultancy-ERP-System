<?php

namespace App\Livewire\Admin\Report;

use App\Models\Team;
use App\Models\Inquiiry;
use App\Models\RegisteredInquiry;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TeamReports extends Component
{
    public $team;
    public $monthStart;
    public $monthEnd;
    public $currentMonth;

    public function mount($team)
    {
        $this->monthStart = now()->startOfMonth()->format('Y-m-d');
        $this->monthEnd = now()->format('Y-m-d');
        $this->currentMonth = now()->format('F Y');
        
        $this->team = Team::with([
            'manager' => function ($query) {
                $query->withCount('inquiries')
                    ->withCount([
                        'inquiries as hot_leads' => function ($query) {
                            $query->where('inquiry_status', 'hot');
                        },
                        'inquiries as cold_leads' => function ($query) {
                            $query->where('inquiry_status', 'cold');
                        },
                        'inquiries as pending_leads' => function ($query) {
                            $query->where('inquiry_status', 'pending');
                        },
                        'inquiries as dead_leads' => function ($query) {
                            $query->where('inquiry_status', 'dead');
                        }
                    ]);
            },
            'counsellors' => function ($query) {
                $query->withCount('inquiries')
                    ->withCount([
                        'inquiries as hot_leads' => function ($query) {
                            $query->where('inquiry_status', 'hot');
                        },
                        'inquiries as cold_leads' => function ($query) {
                            $query->where('inquiry_status', 'cold');
                        },
                        'inquiries as pending_leads' => function ($query) {
                            $query->where('inquiry_status', 'pending');
                        },
                        'inquiries as dead_leads' => function ($query) {
                            $query->where('inquiry_status', 'dead');
                        }
                    ]);
            }
        ])->findOrFail($team);
        
        // Load additional data for each user
        $this->loadUserMonthlyData();
    }
    
    protected function loadUserMonthlyData()
    {
        // Load monthly data for manager
        $this->loadMonthlyDataForUser($this->team->manager);
        
        // Load monthly data for each counselor
        foreach ($this->team->counsellors as $counsellor) {
            $this->loadMonthlyDataForUser($counsellor);
        }
    }
    
    protected function loadMonthlyDataForUser($user)
    {
        $today = now()->format('Y-m-d');
        
        // Monthly report data
        $monthlyReports = Report::where('user_id', $user->id)
            ->whereBetween('date', [$this->monthStart, $this->monthEnd])
            ->get();
            
        // Calculate monthly totals
        $user->monthly_dialed_calls = $monthlyReports->sum('dial_calls') ?? 0;
        $user->monthly_connected_calls = $monthlyReports->sum('connect_calls') ?? 0;
        $user->monthly_inbound_calls = $monthlyReports->sum('inbound_calls') ?? 0;
        $user->monthly_registrations = $monthlyReports->sum('today_registration') ?? 0;
        
        // Today's data
        $todayReport = $monthlyReports->where('date', $today)->first();
        $user->today_inquiries = Inquiiry::where('assigned_to', $user->id)
            ->whereDate('created_at', $today)
            ->count();
        $user->today_registrations = $todayReport->today_registration ?? 0;
            
        // Monthly inquiries
        $user->monthly_inquiries = Inquiiry::where('assigned_to', $user->id)
            ->whereBetween('created_at', [$this->monthStart, $this->monthEnd])
            ->count();
            
        // Monthly conversion rate
        $user->monthly_conversion = $user->monthly_inquiries > 0 ? 
            round(($user->monthly_registrations / $user->monthly_inquiries) * 100, 1) : 0;
            
        // Last activity
        $lastReport = $monthlyReports->sortByDesc('date')->first();
        $user->last_active = $lastReport ? $lastReport->date : 'No activity';
    }
    
    public function calculateUserPerformance($user)
    {
        $score = 0;
        
        // Conversion rate (max 40 points)
        $conversionRate = $user->monthly_conversion;
        if ($conversionRate >= 30) $score += 40;
        elseif ($conversionRate >= 20) $score += 30;
        elseif ($conversionRate >= 10) $score += 20;
        elseif ($conversionRate >= 5) $score += 10;
        elseif ($conversionRate > 0) $score += 5;
        
        // Call activity (max 30 points)
        $callActivity = $user->monthly_dialed_calls;
        if ($callActivity >= 100) $score += 30;
        elseif ($callActivity >= 75) $score += 25;
        elseif ($callActivity >= 50) $score += 20;
        elseif ($callActivity >= 25) $score += 15;
        elseif ($callActivity >= 10) $score += 10;
        elseif ($callActivity > 0) $score += 5;
        
        // Lead quality (max 30 points)
        $totalLeads = ($user->hot_leads ?? 0) + ($user->cold_leads ?? 0) + ($user->pending_leads ?? 0);
        $hotLeadPercent = $totalLeads > 0 ? (($user->hot_leads ?? 0) / $totalLeads) * 100 : 0;
        if ($hotLeadPercent >= 40) $score += 30;
        elseif ($hotLeadPercent >= 30) $score += 20;
        elseif ($hotLeadPercent >= 20) $score += 15;
        elseif ($hotLeadPercent >= 10) $score += 10;
        elseif ($hotLeadPercent > 0) $score += 5;

        return min(100, round($score));
    }
    
    public function getConnectionRate($user)
    {
        $dialed = $user->monthly_dialed_calls ?? 0;
        $connected = $user->monthly_connected_calls ?? 0;
        
        return $dialed > 0 ? round(($connected / $dialed) * 100, 1) : 0;
    }
    
    public function getConnectionRateColor($user)
    {
        $rate = $this->getConnectionRate($user);
        
        if ($rate >= 40) return 'connection-high';
        if ($rate >= 20) return 'connection-medium';
        return 'connection-low';
    }
    
    public function getLastActive($user)
    {
        return $user->last_active ?? 'No activity';
    }
    
    public function getTeamTotalInquiries($team)
    {
        $total = $team->manager->monthly_inquiries ?? 0;
        foreach ($team->counsellors as $counsellor) {
            $total += $counsellor->monthly_inquiries ?? 0;
        }
        return $total;
    }
    
    public function getTeamConversionRate($team)
    {
        $totalInquiries = $this->getTeamTotalInquiries($team);
        $totalRegistrations = $this->getTeamTotalRegistrations($team);
        
        return $totalInquiries > 0 ? round(($totalRegistrations / $totalInquiries) * 100, 1) : 0;
    }
    
    public function getTeamMonthlyCalls($team)
    {
        $total = $team->manager->monthly_dialed_calls ?? 0;
        foreach ($team->counsellors as $counsellor) {
            $total += $counsellor->monthly_dialed_calls ?? 0;
        }
        return $total;
    }
    
    public function getTeamTotalRegistrations($team)
    {
        $total = $team->manager->monthly_registrations ?? 0;
        foreach ($team->counsellors as $counsellor) {
            $total += $counsellor->monthly_registrations ?? 0;
        }
        return $total;
    }
    
    public function getTeamAveragePerformance($team)
    {
        $totalPerformance = $this->calculateUserPerformance($team->manager);
        $count = 1;
        
        foreach ($team->counsellors as $counsellor) {
            $totalPerformance += $this->calculateUserPerformance($counsellor);
            $count++;
        }
        
        return round($totalPerformance / $count, 1);
    }
    
    public function getTeamActiveLeads($team)
    {
        $total = ($team->manager->hot_leads ?? 0) + ($team->manager->pending_leads ?? 0);
        foreach ($team->counsellors as $counsellor) {
            $total += ($counsellor->hot_leads ?? 0) + ($counsellor->pending_leads ?? 0);
        }
        return $total;
    }
    
    public function getTeamCompletionRate($team)
    {
        $daysInMonth = now()->daysInMonth();
        $currentDay = now()->day;
        return round(($currentDay / $daysInMonth) * 100, 1);
    }

    public function render()
    {
        return view('livewire.admin.report.team-reports', [
            'team' => $this->team,
        ])->layout('layouts.admindashboard');
    }
}