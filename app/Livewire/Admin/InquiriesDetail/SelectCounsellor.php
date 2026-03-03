<?php
namespace App\Livewire\Admin\InquiriesDetail;

use Livewire\Component;
use App\Models\Team;
use App\Models\Inquiiry;
use App\Models\RegisteredInquiry;
use Illuminate\Support\Facades\DB;

class SelectCounsellor extends Component
{
    public $team;
    public $teamStats = [];

    public function mount($team)
    {
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
                        },
                        'inquiries as registered_leads' => function ($query) {
                            $query->where('inquiry_status', 'registered');
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
                        },
                        'inquiries as registered_leads' => function ($query) {
                            $query->where('inquiry_status', 'registered');
                        }
                    ]);
            }
        ])->findOrFail($team);

        $this->loadEnhancedStats();
    }

    protected function loadEnhancedStats()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Get all team member IDs (manager + counselors)
        $teamMemberIds = $this->team->counsellors->pluck('id')->merge([$this->team->manager_id]);

        // Team-wide statistics
        $this->teamStats = [
            'total_inquiries' => Inquiiry::whereIn('assigned_to', $teamMemberIds)->count(),
            'total_registrations' => RegisteredInquiry::whereIn('users_id', $teamMemberIds)
                ->whereNull('parent_id')
                ->count(),
            'monthly_inquiries' => Inquiiry::whereIn('assigned_to', $teamMemberIds)
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->count(),
            'monthly_registered' => RegisteredInquiry::whereIn('users_id', $teamMemberIds)
                ->whereNull('parent_id')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->count(),
            'active_counsellors' => $this->team->counsellors->count(),
        ];

        // Calculate MONTHLY conversion rate (for other parts of your app)
        $this->teamStats['monthly_conversion_rate'] = $this->teamStats['monthly_inquiries'] > 0 
            ? round(($this->teamStats['monthly_registered'] / $this->teamStats['monthly_inquiries']) * 100, 1)
            : 0;

        // Calculate OVERALL conversion rate (specifically for the card)
        $this->teamStats['overall_conversion_rate'] = $this->teamStats['total_inquiries'] > 0 
            ? round(($this->teamStats['total_registrations'] / $this->teamStats['total_inquiries']) * 100, 1)
            : 0;

        // Enhanced manager stats
        $this->enhanceUserStats($this->team->manager);

        // Enhanced counselor stats
        foreach ($this->team->counsellors as $counsellor) {
            $this->enhanceUserStats($counsellor);
        }
    }

    protected function enhanceUserStats($user)
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Monthly inquiries count
        $user->monthly_inquiries = Inquiiry::where('assigned_to', $user->id)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        // Monthly registered count
        $user->monthly_registered = RegisteredInquiry::where('users_id', $user->id)
            ->whereNull('parent_id')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        // Total registered count
        $user->registered_count = RegisteredInquiry::where('users_id', $user->id)
            ->whereNull('parent_id')
            ->count();

        // Calculate percentages for status bars
        $totalInquiries = $user->inquiries_count ?? 0;
        
        $user->hot_percent = $totalInquiries > 0 ? round(($user->hot_leads / $totalInquiries) * 100, 1) : 0;
        $user->cold_percent = $totalInquiries > 0 ? round(($user->cold_leads / $totalInquiries) * 100, 1) : 0;
        $user->pending_percent = $totalInquiries > 0 ? round(($user->pending_leads / $totalInquiries) * 100, 1) : 0;
        $user->dead_percent = $totalInquiries > 0 ? round(($user->dead_leads / $totalInquiries) * 100, 1) : 0;

        // Calculate conversion rates for user
        $user->monthly_conversion_rate = $user->monthly_inquiries > 0 
            ? round(($user->monthly_registered / $user->monthly_inquiries) * 100, 1)
            : 0;

        $user->overall_conversion_rate = $user->inquiries_count > 0 
            ? round(($user->registered_count / $user->inquiries_count) * 100, 1)
            : 0;
    }

    public function render()
    {
        return view('livewire.admin.inquiries-detail.select-counsellor', [
            'team' => $this->team,
            'teamStats' => $this->teamStats,
        ])->layout('layouts.admindashboard');
    }
}