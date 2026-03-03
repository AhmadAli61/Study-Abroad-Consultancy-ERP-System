<?php

namespace App\Livewire\Admin\Report;

use App\Models\Team;
use App\Models\Inquiiry;
use App\Models\RegisteredInquiry;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reports extends Component
{
    public $teams = [];
    public $overallStats = [];

    public function mount()
    {
        $this->loadTeamsData();
        $this->loadOverallStats();
    }

    protected function loadTeamsData()
    {
        $this->teams = Team::with(['manager', 'counsellors'])->get();
    }

    protected function loadOverallStats()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $startDate = now()->startOfMonth();
        $endDate = now();

        // Get all user IDs from all teams
        $allUserIds = [];
        foreach ($this->teams as $team) {
            $counsellorIds = $team->counsellors->pluck('id')->toArray();
            $managerId = $team->manager_id;
            $allUserIds = array_merge($allUserIds, $counsellorIds, [$managerId]);
        }
        $allUserIds = array_unique($allUserIds);

        // Monthly inquiries
        $monthlyInquiries = Inquiiry::whereIn('assigned_to', $allUserIds)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $this->overallStats = [
            'total_teams' => $this->teams->count(),
            'monthly_inquiries' => $monthlyInquiries,
            'month_name' => now()->format('F Y')
        ];
    }

    public function getTeamMonthlyStats($teamId)
    {
        $team = Team::with(['counsellors'])->find($teamId);
        $counsellorIds = $team->counsellors->pluck('id')->toArray();
        $managerId = $team->manager_id;
        $allUserIds = array_merge($counsellorIds, [$managerId]);

        $startDate = now()->startOfMonth();
        $endDate = now();

        // Get reports data for the month
        $reportsData = Report::whereIn('user_id', $allUserIds)
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->select(
                DB::raw('COALESCE(SUM(inbound_calls), 0) as inbound_calls'),
                DB::raw('COALESCE(SUM(dial_calls), 0) as dialed_calls'),
                DB::raw('COALESCE(SUM(connect_calls), 0) as connected_calls'),
                DB::raw('COALESCE(SUM(hot_leads), 0) as hot_leads'),
                DB::raw('COALESCE(SUM(cold_leads), 0) as cold_leads'),
                DB::raw('COALESCE(SUM(dead_leads), 0) as dead_leads'),
                DB::raw('COALESCE(SUM(pending_leads), 0) as pending_leads')
            )->first();

        // Get inquiries data
        $inquiriesCount = Inquiiry::whereIn('assigned_to', $allUserIds)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $registeredCount = RegisteredInquiry::whereIn('users_id', $allUserIds)
            ->whereNull('parent_id')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $conversionRate = $inquiriesCount > 0 ? round(($registeredCount / $inquiriesCount) * 100, 1) : 0;

        return [
            'inquiries' => $inquiriesCount,
            'registered' => $registeredCount,
            'conversion_rate' => $conversionRate,
            'inbound_calls' => $reportsData->inbound_calls ?? 0,
            'dialed_calls' => $reportsData->dialed_calls ?? 0,
            'connected_calls' => $reportsData->connected_calls ?? 0,
            'hot_leads' => $reportsData->hot_leads ?? 0,
            'cold_leads' => $reportsData->cold_leads ?? 0,
            'dead_leads' => $reportsData->dead_leads ?? 0,
            'pending_leads' => $reportsData->pending_leads ?? 0,
        ];
    }

    public function calculateMonthlyProgress($teamStats)
    {
        $currentDay = now()->day;
        $totalDaysInMonth = now()->daysInMonth();
        $daysElapsedPercent = round(($currentDay / $totalDaysInMonth) * 100);

        $dailyAvgInquiries = $currentDay > 0 ? round($teamStats['inquiries'] / $currentDay, 1) : 0;
        $dailyAvgCalls = $currentDay > 0 ? round($teamStats['dialed_calls'] / $currentDay, 1) : 0;

        return [
            'days_elapsed' => $currentDay,
            'total_days' => $totalDaysInMonth,
            'days_elapsed_percent' => $daysElapsedPercent,
            'daily_avg_inquiries' => $dailyAvgInquiries,
            'daily_avg_calls' => $dailyAvgCalls,
        ];
    }

    public function calculatePerformanceScore($teamStats)
    {
        $score = 0;
        
        // Conversion rate (max 40 points)
        $conversionRate = $teamStats['conversion_rate'];
        if ($conversionRate >= 30) $score += 40;
        elseif ($conversionRate >= 20) $score += 30;
        elseif ($conversionRate >= 10) $score += 20;
        elseif ($conversionRate >= 5) $score += 10;
        
        // Call connection rate (max 30 points)
        $connectionRate = $teamStats['dialed_calls'] > 0 ? 
            ($teamStats['connected_calls'] / $teamStats['dialed_calls']) * 100 : 0;
        if ($connectionRate >= 40) $score += 30;
        elseif ($connectionRate >= 30) $score += 20;
        elseif ($connectionRate >= 20) $score += 15;
        elseif ($connectionRate >= 10) $score += 10;
        
        // Hot leads percentage (max 30 points)
        $totalLeads = $teamStats['hot_leads'] + $teamStats['cold_leads'] + $teamStats['pending_leads'];
        $hotLeadPercent = $totalLeads > 0 ? ($teamStats['hot_leads'] / $totalLeads) * 100 : 0;
        if ($hotLeadPercent >= 40) $score += 30;
        elseif ($hotLeadPercent >= 30) $score += 20;
        elseif ($hotLeadPercent >= 20) $score += 15;
        elseif ($hotLeadPercent >= 10) $score += 10;

        return min(100, round($score));
    }

    public function render()
    {
        return view('livewire.admin.report.reports', [
            'teams' => $this->teams,
            'overallStats' => $this->overallStats,
        ])->layout('layouts.admindashboard');
    }
}