<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Inquiiry;
use App\Models\RegisteredInquiry;
use App\Models\User;
use App\Models\Team;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalLeads, $hotLeads, $coldLeads, $deadLeads, $pendingLeads, $registeredLeads;
    public $unassignedLeads, $reassignedLeads;
    public $reassignedHot, $reassignedCold, $reassignedDead, $reassignedPending;
    public $totalApplications;
    public $underAssessmentCount, $processedCount, $conditionalCount, $unconditionalCount;
    public $underCasCount, $casReceivedCount, $visaProcessCount, $enrollmentCount, $caseClosedCount;
    public $rejectedCount, $withdrawnCount;
    public $totalParentApplications; // <-- ADD THIS NEW PROPERTY

    
    // Dashboard data
    public $recentInquiries = [];
    public $recentApplications = [];
    public $teams = [];
    public $userStats = [];
    public $systemOverview = [];

    public function mount()
    {
        $this->loadInquiryCounts();
        $this->loadApplicationCounts();
        $this->loadDashboardData();
    }

    protected function loadInquiryCounts()
    {
        // Total assigned inquiries
        $this->totalLeads = Inquiiry::where('status', 'assigned')->count();
        $this->hotLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'hot')->count();
        $this->coldLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'cold')->count();
        $this->deadLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'dead')->count();
        $this->pendingLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'pending')->count();
        $this->registeredLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'registered')->count();

        // Unassigned inquiries
        $this->unassignedLeads = Inquiiry::where('status', 'unassigned')
            ->whereNull('assigned_to')
            ->whereNull('previous_assigned_to')
            ->count();

        // Reassigned inquiries
        $this->reassignedLeads = Inquiiry::where('status', 'unassigned')
            ->whereNull('assigned_to')
            ->whereNotNull('previous_assigned_to')
            ->count();

        // Reassigned by status
        $this->reassignedHot = Inquiiry::where('status', 'unassigned')
            ->whereNull('assigned_to')
            ->whereNotNull('previous_assigned_to')
            ->where('inquiry_status', 'hot')
            ->count();

        $this->reassignedCold = Inquiiry::where('status', 'unassigned')
            ->whereNull('assigned_to')
            ->whereNotNull('previous_assigned_to')
            ->where('inquiry_status', 'cold')
            ->count();

        $this->reassignedDead = Inquiiry::where('status', 'unassigned')
            ->whereNull('assigned_to')
            ->whereNotNull('previous_assigned_to')
            ->where('inquiry_status', 'dead')
            ->count();

        $this->reassignedPending = Inquiiry::where('status', 'unassigned')
            ->whereNull('assigned_to')
            ->whereNotNull('previous_assigned_to')
            ->where('inquiry_status', 'pending')
            ->count();
    }

   protected function loadApplicationCounts()
{
    // Main query for all active applications (excluding rejected, withdrawn, and caseclosed)
    // AND only including records with assigned_to NOT NULL
    $query = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->whereNotNull('assigned_to') // ADD THIS
        ->where('inquiry_status', '!=', 'rejection')
        ->whereNull('intake_id') 
        ->where('inquiry_status', '!=', 'withdrawn')
        ->where('inquiry_status', '!=', 'caseclosed');

    $this->totalApplications = $query->count();
    
    // NEW: Count only parent applications (parent_id IS NULL) with assigned_to NOT NULL
    $this->totalParentApplications = $query->clone()
        ->whereNull('parent_id')
        ->count();
    
    $this->underAssessmentCount = $query->clone()->where('inquiry_status', 'underassessment')->count();
    $this->processedCount = $query->clone()->where('inquiry_status', 'processed')->count();
    $this->conditionalCount = $query->clone()->where('inquiry_status', 'conditional')->count();
    $this->unconditionalCount = $query->clone()->where('inquiry_status', 'unconditional')->count();
    $this->underCasCount = $query->clone()->where('inquiry_status', 'undercas')->count();
    $this->casReceivedCount = $query->clone()->where('inquiry_status', 'casreceived')->count();
    $this->visaProcessCount = $query->clone()->where('inquiry_status', 'visaprocess')->count();
    $this->enrollmentCount = $query->clone()->where('inquiry_status', 'enrollment')->count();
    
    // SEPARATE query for caseclosed count with assigned_to NOT NULL
    $this->caseClosedCount = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->whereNotNull('assigned_to') // ADD THIS
        ->where('inquiry_status', 'caseclosed')
        ->count();
    
    // Separate queries for rejected and withdrawn with assigned_to NOT NULL
    $this->rejectedCount = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->whereNotNull('assigned_to') // ADD THIS
        ->where('inquiry_status', 'rejection')
        ->count();
        
    $this->withdrawnCount = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->whereNotNull('assigned_to') // ADD THIS
        ->where('inquiry_status', 'withdrawn')
        ->count();
}

    protected function loadDashboardData()
{
    // Recent inquiries (last 5)
    $this->recentInquiries = Inquiiry::with('assignedUser')
        ->where('status', 'assigned')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Recent applications (last 5) - only include records with assigned_to NOT NULL
    $this->recentApplications = RegisteredInquiry::with(['user', 'assignedTo'])
        ->where('status', '!=', 'unassigned')
        ->whereNotNull('assigned_to') // ADD THIS
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Teams data
    $this->teams = Team::with(['counsellors', 'manager'])->get();

    // User statistics
    $this->userStats = [
        'total_users' => User::count(),
        'active_users' => User::where('status', true)->count(),
        'counsellors' => User::where('role', 'counsellor')->where('status', true)->count(),
        'managers' => User::where('role', 'manager')->where('status', true)->count(),
        'admission_team' => User::whereIn('role', ['admission', 'admissionagent'])->where('status', true)->count(),
    ];

    // Get current month and year for monthly calculations
    $currentMonth = now()->month;
    $currentYear = now()->year;

    // Monthly inquiries and registrations
    $monthlyInquiries = Inquiiry::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->count();

    // Monthly registered - only include records with assigned_to NOT NULL
    $monthlyRegistered = RegisteredInquiry::whereNull('parent_id')
        ->whereNotNull('assigned_to') // ADD THIS
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->count();

    // Calculate monthly conversion rate
    $monthlyConversionRate = $monthlyInquiries > 0 ? round(($monthlyRegistered / $monthlyInquiries) * 100, 2) : 0;

    // System overview
    $this->systemOverview = [
        'total_inquiries' => Inquiiry::count(),
        'total_applications' => $this->totalParentApplications, // <-- USE THE NEW PROPERTY HERE
        'conversion_rate' => $monthlyConversionRate, // Now shows monthly conversion rate
        'active_teams' => Team::count(),
        'monthly_inquiries' => $monthlyInquiries, // Add monthly inquiries count
        'monthly_registered' => $monthlyRegistered, // Add monthly registered count
        'month_name' => now()->format('F'), // Add month name for display
    ];
}

    // Helper methods for status colors and icons
    private function getInquiryStatusColor($status)
    {
        $colors = [
            'hot' => '#ff5722',
            'cold' => '#00c0ff',
            'dead' => '#6c757d',
            'pending' => '#ffc107',
            'registered' => '#28a745'
        ];

        return $colors[$status] ?? '#6c757d';
    }

    private function getInquiryStatusIcon($status)
    {
        $icons = [
            'hot' => 'fa-fire',
            'cold' => 'fa-snowflake',
            'dead' => 'fa-times-circle',
            'pending' => 'fa-hourglass-half',
            'registered' => 'fa-user-check'
        ];

        return $icons[$status] ?? 'fa-question-circle';
    }

    private function getApplicationStatusInfo($status)
    {
        $statusInfo = [
            'underassessment' => ['color' => '#517577', 'icon' => 'fa-hourglass-half'],
            'processed' => ['color' => '#09122C', 'icon' => 'fa-tasks'],
            'conditional' => ['color' => '#27391C', 'icon' => 'fa-file-signature'],
            'unconditional' => ['color' => '#87431D', 'icon' => 'fa-file-contract'],
            'undercas' => ['color' => '#C69749', 'icon' => 'fa-passport'],
            'casreceived' => ['color' => '#828383', 'icon' => 'fa-file-invoice'],
            'visaprocess' => ['color' => '#673AB7', 'icon' => 'fa-stamp'],
            'enrollment' => ['color' => '#009688', 'icon' => 'fa-user-graduate'],
            'caseclosed' => ['color' => '#c01414', 'icon' => 'fa-archive'],
            'rejection' => ['color' => '#ff0000', 'icon' => 'fa-times-circle'],
            'withdrawn' => ['color' => '#ff5252', 'icon' => 'fa-user-slash'],
        ];

        return $statusInfo[$status] ?? ['color' => '#6c757d', 'icon' => 'fa-question-circle'];
    }

    private function getApplicationStatusColor($status)
    {
        $info = $this->getApplicationStatusInfo($status);
        return $info['color'];
    }

    private function getApplicationStatusIcon($status)
    {
        $info = $this->getApplicationStatusInfo($status);
        return $info['icon'];
    }

    // Calculate percentages for progress bars
    public function getHotLeadsPercentProperty()
    {
        return $this->unassignedLeads > 0 ? ($this->hotLeads / $this->unassignedLeads) * 100 : 0;
    }

    public function getColdLeadsPercentProperty()
    {
        return $this->unassignedLeads > 0 ? ($this->coldLeads / $this->unassignedLeads) * 100 : 0;
    }

    public function getDeadLeadsPercentProperty()
    {
        return $this->unassignedLeads > 0 ? ($this->deadLeads / $this->unassignedLeads) * 100 : 0;
    }

    public function getPendingLeadsPercentProperty()
    {
        return $this->unassignedLeads > 0 ? ($this->pendingLeads / $this->unassignedLeads) * 100 : 0;
    }

    public function getReassignedHotPercentProperty()
    {
        return $this->reassignedLeads > 0 ? ($this->reassignedHot / $this->reassignedLeads) * 100 : 0;
    }

    public function getReassignedColdPercentProperty()
    {
        return $this->reassignedLeads > 0 ? ($this->reassignedCold / $this->reassignedLeads) * 100 : 0;
    }

    public function getReassignedDeadPercentProperty()
    {
        return $this->reassignedLeads > 0 ? ($this->reassignedDead / $this->reassignedLeads) * 100 : 0;
    }

    public function getReassignedPendingPercentProperty()
    {
        return $this->reassignedLeads > 0 ? ($this->reassignedPending / $this->reassignedLeads) * 100 : 0;
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            // Inquiry counts
            'totalLeads' => $this->totalLeads,
            'hotLeads' => $this->hotLeads,
            'coldLeads' => $this->coldLeads,
            'deadLeads' => $this->deadLeads,
            'pendingLeads' => $this->pendingLeads,
            'registeredLeads' => $this->registeredLeads,
            
            // Unassigned and reassigned
            'unassignedLeads' => $this->unassignedLeads,
            'reassignedLeads' => $this->reassignedLeads,
            'reassignedHot' => $this->reassignedHot,
            'reassignedCold' => $this->reassignedCold,
            'reassignedDead' => $this->reassignedDead,
            'reassignedPending' => $this->reassignedPending,
            
            // Application counts
            'totalApplications' => $this->totalApplications,
            'totalParentApplications' => $this->totalParentApplications, // <-- ADD THIS

            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casReceivedCount' => $this->casReceivedCount,
            'visaProcessCount' => $this->visaProcessCount,
            'enrollmentCount' => $this->enrollmentCount,
            'caseClosedCount' => $this->caseClosedCount,
            'rejectedCount' => $this->rejectedCount,
            'withdrawnCount' => $this->withdrawnCount,
            
            // Dashboard data
            'recentInquiries' => $this->recentInquiries,
            'recentApplications' => $this->recentApplications,
            'teams' => $this->teams,
            'userStats' => $this->userStats,
            'systemOverview' => $this->systemOverview,
            
            // Percentages
            'hotLeadsPercent' => $this->hotLeadsPercent,
            'coldLeadsPercent' => $this->coldLeadsPercent,
            'deadLeadsPercent' => $this->deadLeadsPercent,
            'pendingLeadsPercent' => $this->pendingLeadsPercent,
            'reassignedHotPercent' => $this->reassignedHotPercent,
            'reassignedColdPercent' => $this->reassignedColdPercent,
            'reassignedDeadPercent' => $this->reassignedDeadPercent,
            'reassignedPendingPercent' => $this->reassignedPendingPercent,
            
            // Helper methods
            'getInquiryStatusColor' => fn($status) => $this->getInquiryStatusColor($status),
            'getInquiryStatusIcon' => fn($status) => $this->getInquiryStatusIcon($status),
            'getApplicationStatusColor' => fn($status) => $this->getApplicationStatusColor($status),
            'getApplicationStatusIcon' => fn($status) => $this->getApplicationStatusIcon($status),
        ])->layout('layouts.admindashboard');
    }
}