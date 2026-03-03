<?php

namespace App\Livewire\Admission\AdmissionTeam;

use App\Models\RegisteredInquiry;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class AllStudents extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';
    public $dateFilter = '';
    public $universityFilter = '';
    public $courseFilter = '';
    public $partnerFilter = '';
    public $assignedToFilter = '';
    public $dateRange = '';
    public $counsellorFilter = '';
    
    public $totalCount;
    public $underAssessmentCount;
    public $processedCount;
    public $conditionalCount;
    public $unconditionalCount;
    public $underCasCount;
    public $casReceivedCount;
    public $visaProcessCount;
    public $enrollmentCount;
    public $rejectedCount;
    public $withdrawnCount;
    public $caseClosedCount;
    public $isViewOnly = false;

    // Check if any filters are active
    public function hasActiveFilters()
    {
        return $this->search !== '' || 
               $this->statusFilter !== 'all' || 
               $this->dateRange !== '' || 
               $this->partnerFilter !== '' || 
               $this->assignedToFilter !== '' ||
               $this->counsellorFilter !== '';
    }

    public function mount()
    {
        $this->isViewOnly = auth()->user()->permission_level === 'view_only';
        $this->loadCounts();
    }

    protected function loadCounts()
    {
        // Get current user
        $user = auth()->user();
        
        // Base query for ALL parent records - EXCLUDE where assigned_to is null
        $baseQuery = RegisteredInquiry::where('status', '!=', 'unassigned')
            ->whereNotNull('assigned_to') // ADD THIS: Exclude records with null assigned_to
            ->whereNull('intake_id');

        // Filter by assigned_to for non-admin users
        if (!in_array($user->role, ['admin', 'admission'])) {
            $baseQuery->where('assigned_to', $user->id);
        }

        // MAIN QUERY for active applications (EXCLUDING rejected, withdrawn, caseclosed)
        $activeQuery = clone $baseQuery;
        $activeQuery->where('inquiry_status', '!=', 'rejection')
            ->where('inquiry_status', '!=', 'withdrawn')
            ->where('inquiry_status', '!=', 'caseclosed');

        // Top boxes count (active records only)
        $this->totalCount = $activeQuery->count();
        $this->underAssessmentCount = $activeQuery->clone()->where('inquiry_status', 'underassessment')->count();
        $this->processedCount = $activeQuery->clone()->where('inquiry_status', 'processed')->count();
        $this->conditionalCount = $activeQuery->clone()->where('inquiry_status', 'conditional')->count();
        $this->unconditionalCount = $activeQuery->clone()->where('inquiry_status', 'unconditional')->count();
        $this->underCasCount = $activeQuery->clone()->where('inquiry_status', 'undercas')->count();
        $this->casReceivedCount = $activeQuery->clone()->where('inquiry_status', 'casreceived')->count();
        $this->visaProcessCount = $activeQuery->clone()->where('inquiry_status', 'visaprocess')->count();
        $this->enrollmentCount = $activeQuery->clone()->where('inquiry_status', 'enrollment')->count();
        
        // Bottom boxes count (terminal statuses) - also exclude null assigned_to
        $this->caseClosedCount = $baseQuery->clone()->where('inquiry_status', 'caseclosed')->count();
        $this->rejectedCount = $baseQuery->clone()->where('inquiry_status', 'rejection')->count();
        $this->withdrawnCount = $baseQuery->clone()->where('inquiry_status', 'withdrawn')->count();
    }

    public function updated()
    {
        $this->updateSearchFilterCount();
    }

    public function handleFiltersApplied($filters)
    {
        $this->search = $filters['search'];
        $this->statusFilter = $filters['status'];
        $this->dateRange = $filters['dateRange'];
        $this->partnerFilter = $filters['partner'];
        $this->assignedToFilter = $filters['assignedTo'];
        $this->counsellorFilter = $filters['counsellor'];

        $this->resetPage();
        $this->updateSearchFilterCount();
    }

    protected function updateSearchFilterCount()
    {
        $user = auth()->user();
        $query = RegisteredInquiry::query()
            ->where('status', '!=', 'unassigned')
            ->whereNotNull('assigned_to') // ADD THIS: Exclude records with null assigned_to
            ->whereNull('intake_id')
            ->whereNull('parent_id')
            // EXCLUDE rejected, withdrawn, caseclosed from search counts
            ->where('inquiry_status', '!=', 'rejection')
            ->where('inquiry_status', '!=', 'withdrawn')
            ->where('inquiry_status', '!=', 'caseclosed');

        if (!in_array($user->role, ['admin', 'admission'])) {
            $query->where('assigned_to', $user->id);
        }

        $query->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_contact', 'like', '%' . $this->search . '%')
                      ->orWhere('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('unique_id', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('inquiry_status', $this->statusFilter);
            })
            ->when($this->partnerFilter, function ($query) {
                $query->where('partner', $this->partnerFilter);
            })
            ->when($this->counsellorFilter, function ($query) {
                $query->where('users_id', $this->counsellorFilter);
            })
            ->when($this->assignedToFilter, function ($query) {
                $query->where('assigned_to', $this->assignedToFilter);
            })
            ->when($this->dateRange, function ($query) {
                $this->applyDateRangeFilter($query);
            });

        $filteredCount = $query->count();
        $this->dispatch('updateFilteredCount', count: $filteredCount);
    }

    public function filterByStatus($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searches()
    {
        $this->resetPage();
    }
    
    protected $listeners = [
        'refreshApplications' => '$refresh', 
        'filtersApplied' => 'handleFiltersApplied',
        'filtersReset' => 'resetFilters',
        'updateFilteredCount' => 'updateFilteredCount'
    ];

    public function resetFilters()
    {
        $this->search = '';
        $this->statusFilter = 'all';
        $this->dateRange = '';
        $this->partnerFilter = '';
        $this->assignedToFilter = '';
        $this->counsellorFilter = '';
        $this->resetPage();
        $this->updateSearchFilterCount();
    }

    public function showViewOnlyError()
    {
        if ($this->isViewOnly) {
            $this->dispatch('show-error', message: 'View-only users cannot perform this action');
            return true;
        }
        return false;
    }

    protected function applyDateRangeFilter($query)
    {
        if ($this->dateRange) {
            $dates = explode(' to ', $this->dateRange);
            if (count($dates) === 2) {
                $startDate = trim($dates[0]);
                $endDate = trim($dates[1]);
                $query->whereBetween('created_at', [
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                ]);
            } elseif (count($dates) === 1) {
                $singleDate = trim($dates[0]);
                $query->whereDate('created_at', $singleDate);
            }
        }
    }

    public function render()
    {
        $user = auth()->user();
        
        $query = RegisteredInquiry::query()
            ->where('status', '!=', 'unassigned')
            ->whereNotNull('assigned_to') // ADD THIS: Exclude records with null assigned_to
            ->whereNull('intake_id')
            ->whereNull('parent_id') // Only parent records
            // EXCLUDE rejected, withdrawn, caseclosed from the table view
            ->where('inquiry_status', '!=', 'rejection')
            ->where('inquiry_status', '!=', 'withdrawn')
            ->where('inquiry_status', '!=', 'caseclosed');

        // Filter by assigned_to for non-admin users
        if (!in_array($user->role, ['admin', 'admission'])) {
            $query->where('assigned_to', $user->id);
        }

        $query->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_contact', 'like', '%' . $this->search . '%')
                      ->orWhere('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('unique_id', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('inquiry_status', $this->statusFilter);
            })
            ->when($this->partnerFilter, function ($query) {
                $query->where('partner', $this->partnerFilter);
            })
            ->when($this->counsellorFilter, function ($query) {
                $query->where('users_id', $this->counsellorFilter);
            })
            ->when($this->assignedToFilter && in_array($user->role, ['admin', 'admission']), function ($query) {
                $query->where('assigned_to', $this->assignedToFilter);
            })
            ->when($this->dateRange, function ($query) {
                $this->applyDateRangeFilter($query);
            })
            ->orderBy('updated_at', 'desc');

        if ($this->hasActiveFilters()) {
            $registeredInquiries = $query->paginate(1000);
        } else {
            $registeredInquiries = $query->paginate(10);
        }

        return view('livewire.admission.admission-team.all-students', [
            'registeredInquiries' => $registeredInquiries,
            'totalCount' => $this->totalCount,
            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casReceivedCount' => $this->casReceivedCount,
            'visaProcessCount' => $this->visaProcessCount,
            'enrollmentCount' => $this->enrollmentCount,
            'rejectedCount' => $this->rejectedCount,
            'withdrawnCount' => $this->withdrawnCount,
            'caseClosedCount' => $this->caseClosedCount,
            'hasActiveFilters' => $this->hasActiveFilters(),
            'isViewOnly' => $this->isViewOnly,
        ])->layout('layouts.admissiondashboard');
    }
}