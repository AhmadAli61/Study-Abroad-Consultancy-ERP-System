<?php

namespace App\Livewire\Agent;

use Livewire\Component;
use App\Models\Inquiiry;
use App\Models\RegisteredInquiry;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    // Inquiry counts (from your existing code)
    public $totalLeads, $hotLeads, $coldLeads, $deadLeads, $pendingLeads, $registeredLeads;
    
    // Application counts (all 10 statuses)
    public $totalCount;
    public $underAssessmentCount;
    public $processedCount;
    public $conditionalCount;
    public $unconditionalCount;
    public $underCasCount;
    public $casDocumentCount;
    public $visaProcessCount;
    public $enrollmentCount;
    public $caseClosedCount;
    
    // Dashboard data
    public $recentInquiries = [];
    public $recentApplications = [];
    public $statusDistribution = [];
    public $inquiryStatusDistribution = [];
    public $topUniversities = [];
    public $reports;

    public function mount()
    {
        $this->loadInquiryCounts();
        $this->loadApplicationCounts();
        $this->loadDashboardData();
        
        // Fetch the top 5 recent reports for the logged-in user
        $this->reports = Report::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
    }

    // Load inquiry counts (from your existing Inquiries component)
    protected function loadInquiryCounts()
    {
        $userId = Auth::id();
        $this->totalLeads = Inquiiry::where('assigned_to', $userId)->count();
        $this->hotLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'hot')->count();
        $this->coldLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'cold')->count();
        $this->deadLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'dead')->count();
        $this->pendingLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'pending')->count();
        $this->registeredLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'registered')->count();
    }

    // Load application counts (all 10 statuses excluding rejected/withdrawn)
    protected function loadApplicationCounts()
    {
        $agent = Auth::user();
        
        // Base query for counts - only show inquiries for this agent
        $query = RegisteredInquiry::where('users_id', $agent->id)->whereNull('intake_id');
        
        $this->totalCount = $query->count();
        $this->underAssessmentCount = $query->clone()->where('inquiry_status', 'underassessment')->count();
        $this->processedCount = $query->clone()->where('inquiry_status', 'processed')->count();
        $this->conditionalCount = $query->clone()->where('inquiry_status', 'conditional')->count();
        $this->unconditionalCount = $query->clone()->where('inquiry_status', 'unconditional')->count();
        $this->underCasCount = $query->clone()->where('inquiry_status', 'undercas')->count();
        $this->casDocumentCount = $query->clone()->where('inquiry_status', 'casreceived')->count();
        $this->visaProcessCount = $query->clone()->where('inquiry_status', 'visaprocess')->count();
        $this->enrollmentCount = $query->clone()->where('inquiry_status', 'enrollment')->count();
        $this->caseClosedCount = $query->clone()->where('inquiry_status', 'caseclosed')->count();
    }

    // Load additional dashboard data
    protected function loadDashboardData()
    {
        $userId = Auth::id();
        
        // Recent inquiries (last 5)
        $this->recentInquiries = Inquiiry::where('assigned_to', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Recent applications (last 5)
        $this->recentApplications = RegisteredInquiry::where('users_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Application status distribution
        $this->statusDistribution = RegisteredInquiry::where('users_id', $userId)
            ->select('inquiry_status', DB::raw('count(*) as count'))
            ->groupBy('inquiry_status')
            ->get()
            ->toArray();

        // Inquiry status distribution
        $this->inquiryStatusDistribution = Inquiiry::where('assigned_to', $userId)
            ->select('inquiry_status', DB::raw('count(*) as count'))
            ->groupBy('inquiry_status')
            ->get()
            ->toArray();

        // Top universities from applications
        $this->topUniversities = RegisteredInquiry::where('users_id', $userId)
            ->select('university_name', DB::raw('COUNT(*) as count'))
            ->whereNotNull('university_name')
            ->groupBy('university_name')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();
    }

    // Updated method to get both color and icon for application status
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
            'registered' => ['color' => '#28a745', 'icon' => 'fa-clipboard-list'],        ];

        return $statusInfo[$status] ?? ['color' => '#6c757d', 'icon' => 'fa-question-circle'];
    }

    // Keep the original method for backward compatibility
    private function getApplicationStatusColor($status)
    {
        $info = $this->getApplicationStatusInfo($status);
        return $info['color'];
    }

    // New method to get only the icon for application status
    private function getApplicationStatusIcon($status)
    {
        $info = $this->getApplicationStatusInfo($status);
        return $info['icon'];
    }

    // Helper method for inquiry status colors
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

    // Method to get inquiry status icons
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

    public function render()
    {
        return view('livewire.agent.dashboard', [
            // Inquiry counts
            'totalLeads' => $this->totalLeads,
            'hotLeads' => $this->hotLeads,
            'coldLeads' => $this->coldLeads,
            'deadLeads' => $this->deadLeads,
            'pendingLeads' => $this->pendingLeads,
            'registeredLeads' => $this->registeredLeads,
            
            // Application counts (all 10 statuses)
            'totalCount' => $this->totalCount,
            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casDocumentCount' => $this->casDocumentCount,
            'visaProcessCount' => $this->visaProcessCount,
            'enrollmentCount' => $this->enrollmentCount,
            'caseClosedCount' => $this->caseClosedCount,
            
            // Dashboard data
            'recentInquiries' => $this->recentInquiries,
            'recentApplications' => $this->recentApplications,
            'statusDistribution' => $this->statusDistribution,
            'inquiryStatusDistribution' => $this->inquiryStatusDistribution,
            'topUniversities' => $this->topUniversities,
            'reports' => $this->reports,
            
            // Helper methods for blade
            'getApplicationStatusInfo' => fn($status) => $this->getApplicationStatusInfo($status),
            'getApplicationStatusColor' => fn($status) => $this->getApplicationStatusColor($status),
            'getApplicationStatusIcon' => fn($status) => $this->getApplicationStatusIcon($status),
            'getInquiryStatusColor' => fn($status) => $this->getInquiryStatusColor($status),
            'getInquiryStatusIcon' => fn($status) => $this->getInquiryStatusIcon($status),
        ])->layout('layouts.agentdashboard');
    }
}