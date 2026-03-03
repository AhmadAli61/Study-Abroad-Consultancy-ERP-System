<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Team;
use App\Models\Inquiiry;
use App\Models\RegisteredInquiry;
use Illuminate\Support\Facades\DB;

class SelectTeamInquiries extends Component
{
    public $teams = [];
    public $monthlyStats = [];
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

        // Total inquiries across all teams
        $totalInquiries = Inquiiry::count();
        $monthlyInquiries = Inquiiry::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $monthlyRegistered = RegisteredInquiry::whereNull('parent_id')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $conversionRate = $monthlyInquiries > 0 ? round(($monthlyRegistered / $monthlyInquiries) * 100, 1) : 0;

        $this->overallStats = [
            'total_teams' => $this->teams->count(),
            'total_inquiries' => $totalInquiries,
            'monthly_inquiries' => $monthlyInquiries,
            'monthly_registered' => $monthlyRegistered,
            'conversion_rate' => $conversionRate,
            'month_name' => now()->format('F Y')
        ];
    }

    // Helper method to get status color
    public function getStatusColor($status)
    {
        $colors = [
            'hot' => 'danger',
            'cold' => 'info',
            'dead' => 'secondary',
            'pending' => 'warning',
            'registered' => 'success'
        ];

        return $colors[$status] ?? 'secondary';
    }

    // Helper method to get status icon
    public function getStatusIcon($status)
    {
        $icons = [
            'hot' => 'fa-fire',
            'cold' => 'fa-snowflake',
            'dead' => 'fa-skull',
            'pending' => 'fa-clock',
            'registered' => 'fa-user-check'
        ];

        return $icons[$status] ?? 'fa-question-circle';
    }

    public function render()
    {
        return view('livewire.admin.select-team-inquiries', [
            'teams' => $this->teams,
            'overallStats' => $this->overallStats,
            'getStatusColor' => fn($status) => $this->getStatusColor($status),
            'getStatusIcon' => fn($status) => $this->getStatusIcon($status),
        ])->layout('layouts.admindashboard');
    }
}