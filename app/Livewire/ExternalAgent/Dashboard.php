<?php

namespace App\Livewire\ExternalAgent;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalApplications;
    public $underAssessmentCount;
    public $processedCount;
    public $conditionalCount;
    public $unconditionalCount;
    public $underCasCount;
    public $casDocumentCount;
    public $visaProcessCount;
    public $enrollmentCount;
    public $caseClosedCount;
    
    public $recentApplications = [];
    public $statusDistribution = [];
    public $monthlyStats = [];
    public $topUniversities = [];

    public function mount()
    {
        $this->loadDashboardData();
    }

    // Updated method to get both color and icon for a status
    private function getStatusInfo($status)
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
            'registered' => ['color' => '#28a745', 'icon' => 'fa-clipboard-list'],
        ];

        return $statusInfo[$status] ?? ['color' => '#6c757d', 'icon' => 'fa-question-circle'];
    }

    // Keep the original method for backward compatibility
    private function getStatusColor($status)
    {
        $info = $this->getStatusInfo($status);
        return $info['color'];
    }

    // New method to get only the icon
    private function getStatusIcon($status)
    {
        $info = $this->getStatusInfo($status);
        return $info['icon'];
    }

    protected function loadDashboardData()
    {
        $agent = Auth::user();
        
        // Base query for counts - using the same logic from sample component
        $query = RegisteredInquiry::where('users_id', $agent->id)        ->whereNull('intake_id')
;
        
        // Application counts by status - using the same variable names from sample
        $this->totalApplications = $query->count();
        $this->underAssessmentCount = $query->clone()->where('inquiry_status', 'underassessment')->count();
        $this->processedCount = $query->clone()->where('inquiry_status', 'processed')->count();
        $this->conditionalCount = $query->clone()->where('inquiry_status', 'conditional')->count();
        $this->unconditionalCount = $query->clone()->where('inquiry_status', 'unconditional')->count();
        $this->underCasCount = $query->clone()->where('inquiry_status', 'undercas')->count();
        $this->casDocumentCount = $query->clone()->where('inquiry_status', 'casreceived')->count();
        $this->visaProcessCount = $query->clone()->where('inquiry_status', 'visaprocess')->count();
        $this->enrollmentCount = $query->clone()->where('inquiry_status', 'enrollment')->count();
        $this->caseClosedCount = $query->clone()->where('inquiry_status', 'caseclosed')->count();

        // Recent applications (last 5)
        $this->recentApplications = $query->clone()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Status distribution for chart
        $this->statusDistribution = $query->clone()
            ->select('inquiry_status', DB::raw('count(*) as count'))
            ->groupBy('inquiry_status')
            ->get()
            ->toArray();

        // Monthly application stats (last 6 months)
        $this->monthlyStats = $query->clone()
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Top universities
        $this->topUniversities = $query->clone()
            ->select('university_name', DB::raw('COUNT(*) as count'))
            ->whereNotNull('university_name')
            ->groupBy('university_name')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();
    }

    // Add refresh functionality from sample component
    protected $listeners = ['refreshApplications' => '$refresh'];

    public function render()
    {
        return view('livewire.external-agent.dashboard', [
            'totalApplications' => $this->totalApplications,
            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casDocumentCount' => $this->casDocumentCount,
            'visaProcessCount' => $this->visaProcessCount,
            'enrollmentCount' => $this->enrollmentCount,
            'caseClosedCount' => $this->caseClosedCount,
            'recentApplications' => $this->recentApplications,
            'statusDistribution' => $this->statusDistribution,
            'monthlyStats' => $this->monthlyStats,
            'topUniversities' => $this->topUniversities,
            'getStatusInfo' => fn($status) => $this->getStatusInfo($status),
            'getStatusColor' => fn($status) => $this->getStatusColor($status),
            'getStatusIcon' => fn($status) => $this->getStatusIcon($status),
        ])->layout('layouts.externalagent');
    }
}