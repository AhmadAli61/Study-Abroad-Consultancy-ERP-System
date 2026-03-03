<?php

namespace App\Livewire\Admission;

use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';

    // Application counts
    public $totalCount;
    public $underAssessmentCount;
    public $processedCount;
    public $rejectedCount;
    public $withdrawnCount;
    public $conditionalCount;
    public $unconditionalCount;
    public $underCasCount;
    public $casReceivedCount;
    public $visaProcessCount;
    public $enrollmentCount;
    public $caseClosedCount;

    // Dashboard data
    public $monthlyProgress = [];
    public $recentApplications = [];
    public $statusDistribution = [];
    public $topUniversities = [];
    public $monthlyStats = [];

    public function mount()
    {
        $this->loadCounts();
        $this->loadDashboardData();
        $this->loadMonthlyProgressData();
    }

protected function loadCounts()
{
    // Get the current authenticated user's ID
    $userId = auth()->id();
    
    // Base query for counts - only show inquiries assigned to this user
    // Excluding rejected, withdrawn, AND caseclosed from main counts
    $query = RegisteredInquiry::where('assigned_to', $userId)
        ->where('status', '!=', 'unassigned')
        ->whereNull('intake_id')
        ->where('inquiry_status', '!=', 'withdrawn') // Exclude withdrawn from counts
        ->where('inquiry_status', '!=', 'rejection') // Exclude rejection status
        ->where('inquiry_status', '!=', 'caseclosed'); // Exclude caseclosed from main counts

    
    $this->totalCount = $query->count();
    $this->underAssessmentCount = $query->clone()->where('inquiry_status', 'underassessment')->count();
    $this->processedCount = $query->clone()->where('inquiry_status', 'processed')->count();
    $this->conditionalCount = $query->clone()->where('inquiry_status', 'conditional')->count();
    $this->unconditionalCount = $query->clone()->where('inquiry_status', 'unconditional')->count();
    $this->underCasCount = $query->clone()->where('inquiry_status', 'undercas')->count();
    $this->casReceivedCount = $query->clone()->where('inquiry_status', 'casreceived')->count();
    $this->visaProcessCount = $query->clone()->where('inquiry_status', 'visaprocess')->count();
    $this->enrollmentCount = $query->clone()->where('inquiry_status', 'enrollment')->count();
    
    // SEPARATE query for caseclosed count (to keep the box working)
    $this->caseClosedCount = RegisteredInquiry::where('assigned_to', $userId)
        ->where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'caseclosed')
        ->count();
    
    // Separate queries for rejected and withdrawn (if you need them for boxes)
    $this->rejectedCount = RegisteredInquiry::where('assigned_to', $userId)
        ->where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'rejection')
        ->count();
        
    $this->withdrawnCount = RegisteredInquiry::where('assigned_to', $userId)
        ->where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'withdrawn')
        ->count();
}

    protected function loadDashboardData()
    {
        $userId = auth()->id();

        // Recent applications (last 5)
        $this->recentApplications = RegisteredInquiry::where('assigned_to', $userId)
            ->where('status', '!=', 'unassigned')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Status distribution for chart
        $this->statusDistribution = RegisteredInquiry::where('assigned_to', $userId)
            ->where('status', '!=', 'unassigned')
            ->select('inquiry_status', DB::raw('count(*) as count'))
            ->groupBy('inquiry_status')
            ->get()
            ->toArray();

        // Monthly application stats (last 6 months)
        $this->monthlyStats = RegisteredInquiry::where('assigned_to', $userId)
            ->where('status', '!=', 'unassigned')
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
        $this->topUniversities = RegisteredInquiry::where('assigned_to', $userId)
            ->where('status', '!=', 'unassigned')
            ->select('university_name', DB::raw('COUNT(*) as count'))
            ->whereNotNull('university_name')
            ->groupBy('university_name')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();
    }

    protected function loadMonthlyProgressData()
    {
        $userId = auth()->id();

        // Get monthly application counts for the current year
        $this->monthlyProgress = RegisteredInquiry::where('assigned_to', $userId)
            ->where('status', '!=', 'unassigned')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('MONTHNAME(created_at) as month_name'),
                DB::raw('COUNT(*) as total_applications'),
                DB::raw('SUM(CASE WHEN inquiry_status = "caseclosed" THEN 1 ELSE 0 END) as completed_applications'),
                DB::raw('SUM(CASE WHEN inquiry_status = "enrollment" THEN 1 ELSE 0 END) as enrolled_applications')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('year', 'month', 'month_name')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($item) {
                $item->completion_rate = $item->total_applications > 0 
                    ? round(($item->completed_applications / $item->total_applications) * 100, 1)
                    : 0;
                $item->enrollment_rate = $item->total_applications > 0 
                    ? round(($item->enrolled_applications / $item->total_applications) * 100, 1)
                    : 0;
                return $item;
            });
    }

    // Helper method to get both color and icon for application status
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
            'registered' => ['color' => '#34A853', 'icon' => 'fa-clipboard-list'],
            'rejection' => ['color' => '#ff0000', 'icon' => 'fa-times-circle'],
            'withdrawn' => ['color' => '#ff5252', 'icon' => 'fa-user-slash'],
        ];

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

    public function render()
    {
        $userId = auth()->id();

        $query = RegisteredInquiry::query()
            ->where('assigned_to', $userId)
            ->where('status', '!=', 'unassigned')
            ->where('inquiry_status', '!=', 'withdrawn')
            ->where('inquiry_status', '!=', 'rejection')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('student_contact', 'like', '%' . $this->search . '%')
                      ->orWhere('university_name', 'like', '%' . $this->search . '%')
                      ->orWhere('course_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('inquiry_status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc');

        $registeredInquiries = $query->paginate(10);

        return view('livewire.admission.dashboard', [
            'registeredInquiries' => $registeredInquiries,
            // Application counts
            'totalCount' => $this->totalCount,
            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casDocumentCount' => $this->casReceivedCount,
            'visaProcessCount' => $this->visaProcessCount,
            'rejectedCount' => $this->rejectedCount,
            'withdrawnCount' => $this->withdrawnCount,
            'enrollmentCount' => $this->enrollmentCount,
            'caseClosedCount' => $this->caseClosedCount,
            
            // Dashboard data
            'recentApplications' => $this->recentApplications,
            'statusDistribution' => $this->statusDistribution,
            'topUniversities' => $this->topUniversities,
            'monthlyStats' => $this->monthlyStats,
            'monthlyProgress' => $this->monthlyProgress,
            
            // Helper methods for blade
            'getApplicationStatusInfo' => fn($status) => $this->getApplicationStatusInfo($status),
            'getApplicationStatusColor' => fn($status) => $this->getApplicationStatusColor($status),
            'getApplicationStatusIcon' => fn($status) => $this->getApplicationStatusIcon($status),
        ])->layout('layouts.admissiondashboard');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}