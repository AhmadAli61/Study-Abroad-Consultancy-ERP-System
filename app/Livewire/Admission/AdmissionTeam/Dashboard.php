<?php

namespace App\Livewire\Admission\AdmissionTeam;

use App\Models\RegisteredInquiry;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';
    
    // Add count properties
    public $totalCount;
    public $totalParentCount; // NEW PROPERTY for All Students

    public $underAssessmentCount;
    public $processedCount;
    public $conditionalCount;
    public $unconditionalCount;
    public $underCasCount;
    public $casReceivedCount;
    public $visaProcessCount;
    public $enrollmentCount;
    public $caseClosedCount;
    public $rejectedCount;
    public $withdrawnCount;
    
    // Add property for staff counts
    public $staffCounts = [];

    // New properties for enhanced dashboard
    public $monthlyProgress = [];
    public $assignmentMetrics = [];
    public $reassignmentStats = [];
    public $teamPerformance = [];
    public $topPerformers = [];

    public function mount()
    {
        $this->loadCounts();
        $this->loadStaffCounts();
        $this->loadEnhancedDashboardData();
    }

   protected function loadCounts()
    {
        // Main query for all active applications (excluding rejected, withdrawn, AND caseclosed)
        // AND only including records with assigned_to NOT NULL
        $query = RegisteredInquiry::where('status', '!=', 'unassigned')
            ->whereNotNull('assigned_to') // ADD THIS
            ->where('inquiry_status', '!=', 'rejection')
            ->where('inquiry_status', '!=', 'withdrawn')
            ->where('inquiry_status', '!=', 'caseclosed')
            ->whereNull('intake_id');

        $this->totalCount = $query->count();
        
        // NEW: Count for All Students (only parent records) with assigned_to NOT NULL
        $this->totalParentCount = $query->clone()
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
        
        // Separate query for caseclosed count with assigned_to NOT NULL
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

    
    protected function loadStaffCounts()
    {
        // Get all admission staff (admission and admissionagent roles) excluding developer accounts
        $admissionStaff = User::whereIn('role', ['admission', 'admissionagent'])
            ->whereNotIn('username', ['admission1', 'admission2'])
            ->get();
        
        $statuses = [
            'caseclosed',
            'casreceived',
            'conditional',
            'enrollment',
            'processed',
            'unconditional',
            'underassessment',
            'undercas',
            'visaprocess'
        ];
        
        foreach ($admissionStaff as $staff) {
            $staffCounts = [
                'name' => $staff->username,
                'total' => 0,
                'role' => $staff->role
            ];
            
            // Initialize all status counts to 0
            foreach ($statuses as $status) {
                $staffCounts[$status] = 0;
            }
            
            // Get counts for each status - EXCLUDE reject and withdrawn
            // AND only include records with assigned_to NOT NULL (which they will be since we're filtering by assigned_to)
            $inquiries = RegisteredInquiry::where('assigned_to', $staff->id)
                ->where('status', '!=', 'unassigned')
                ->whereNotNull('assigned_to') // ADD THIS for consistency
                ->whereNotIn('inquiry_status', ['reject', 'withdrawn'])
                ->get();
            
            foreach ($inquiries as $inquiry) {
                $status = $inquiry->inquiry_status;
                if (in_array($status, $statuses)) {
                    $staffCounts[$status]++;
                }
                $staffCounts['total']++;
            }
            
            $this->staffCounts[] = $staffCounts;
        }
    }

    protected function loadEnhancedDashboardData()
    {
        // Monthly Progress Data - only include records with assigned_to NOT NULL
        $this->monthlyProgress = RegisteredInquiry::where('status', '!=', 'unassigned')
            ->whereNotNull('assigned_to') // ADD THIS
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

        // Assignment Metrics - only include records with assigned_to NOT NULL
        $this->assignmentMetrics = [
            'total_assigned' => RegisteredInquiry::where('status', 'assigned')
                ->whereNotNull('assigned_to') // ADD THIS
                ->count(),
            'total_unassigned' => RegisteredInquiry::where('status', 'unassigned')
                ->whereNull('assigned_to') // This one should be NULL
                ->count(),
            'assignments_this_month' => RegisteredInquiry::where('status', 'assigned')
                ->whereNotNull('assigned_to') // ADD THIS
                ->whereMonth('assigned_at', date('m'))
                ->whereYear('assigned_at', date('Y'))
                ->count(),
            'reassignments_this_month' => RegisteredInquiry::whereNotNull('previous_assigned_to')
                ->whereNotNull('assigned_to') // ADD THIS
                ->whereMonth('assigned_at', date('m'))
                ->whereYear('assigned_at', date('Y'))
                ->count(),
        ];

        // Reassignment Stats - only include records with assigned_to NOT NULL
        $this->reassignmentStats = RegisteredInquiry::whereNotNull('previous_assigned_to')
            ->whereNotNull('assigned_to') // ADD THIS
            ->select(
                DB::raw('COUNT(*) as total_reassignments'),
                DB::raw('COUNT(DISTINCT previous_assigned_to) as affected_agents'),
                DB::raw('AVG(TIMESTAMPDIFF(DAY, created_at, assigned_at)) as avg_reassignment_time')
            )
            ->first();

        // Team Performance Metrics - this is calculated from other data that already has the filter
        $this->teamPerformance = [
            'total_agents' => User::whereIn('role', ['admission', 'admissionagent'])->count(),
            'active_agents' => User::whereIn('role', ['admission', 'admissionagent'])
                ->whereHas('assignedInquiries', function($query) {
                    $query->whereNotNull('assigned_to'); // ADD THIS
                })
                ->count(),
            'avg_applications_per_agent' => $this->totalCount > 0 ? round($this->totalCount / count($this->staffCounts), 1) : 0,
            'highest_performing_agent' => collect($this->staffCounts)->sortByDesc('total')->first() ?? ['name' => 'N/A', 'total' => 0],
        ];

        // Top Performers - this is calculated from staffCounts which already has the filter
        $this->topPerformers = collect($this->staffCounts)
            ->sortByDesc('total')
            ->take(3)
            ->values()
            ->all();
    }

   public function render()
    {
        $query = RegisteredInquiry::query()
            ->where('status', '!=', 'unassigned')
            ->whereNotNull('assigned_to') // ADD THIS
            ->where('inquiry_status', '!=', 'rejection')
            ->where('inquiry_status', '!=', 'withdrawn')
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('student_name', 'like', '%'.$this->search.'%')
                      ->orWhere('passport_number', 'like', '%'.$this->search.'%')
                      ->orWhere('student_contact', 'like', '%'.$this->search.'%')
                      ->orWhere('university_name', 'like', '%'.$this->search.'%')
                      ->orWhere('course_name', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('inquiry_status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc');

        $registeredInquiries = $query->paginate(10);

        return view('livewire.admission.admission-team.dashboard', [
            'registeredInquiries' => $registeredInquiries,
            'totalCount' => $this->totalCount,
            'totalParentCount' => $this->totalParentCount,
            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casDocumentCount' => $this->casReceivedCount,
            'visaProcessCount' => $this->visaProcessCount,
            'enrollmentCount' => $this->enrollmentCount,
            'rejectedCount' => $this->rejectedCount,
            'withdrawnCount' => $this->withdrawnCount,
            'caseClosedCount' => $this->caseClosedCount,
            'staffCounts' => $this->staffCounts,
            'monthlyProgress' => $this->monthlyProgress,
            'assignmentMetrics' => $this->assignmentMetrics,
            'reassignmentStats' => $this->reassignmentStats,
            'teamPerformance' => $this->teamPerformance,
            'topPerformers' => $this->topPerformers,
        ])->layout('layouts.admissiondashboard');
    }


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function filterByStatus($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }
}