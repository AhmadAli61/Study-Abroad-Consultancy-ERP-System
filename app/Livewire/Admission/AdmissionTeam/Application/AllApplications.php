<?php

namespace App\Livewire\Admission\AdmissionTeam\Application;

use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator; // ADD THIS
use Illuminate\Support\Collection; // ADD THIS

class AllApplications extends Component
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
    public $caseClosedCount;
       public $rejectedCount;
    public $withdrawnCount;

    // ADD THIS METHOD: Check if any filters are active
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
        $this->loadCounts();
    }

protected function loadCounts()
{
    // Main query for all active applications (excluding rejected, withdrawn, AND caseclosed)
    $query = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->where('inquiry_status', '!=', 'rejection')
        ->where('inquiry_status', '!=', 'withdrawn')
        ->where('inquiry_status', '!=', 'caseclosed') // ADD THIS: Exclude caseclosed from main counts
        ->whereNull('intake_id');

    $this->totalCount = $query->count();
    $this->underAssessmentCount = $query->clone()->where('inquiry_status', 'underassessment')->count();
    $this->processedCount = $query->clone()->where('inquiry_status', 'processed')->count();
    $this->conditionalCount = $query->clone()->where('inquiry_status', 'conditional')->count();
    $this->unconditionalCount = $query->clone()->where('inquiry_status', 'unconditional')->count();
    $this->underCasCount = $query->clone()->where('inquiry_status', 'undercas')->count();
    $this->casReceivedCount = $query->clone()->where('inquiry_status', 'casreceived')->count();
    $this->visaProcessCount = $query->clone()->where('inquiry_status', 'visaprocess')->count();
    $this->enrollmentCount = $query->clone()->where('inquiry_status', 'enrollment')->count();
    
    // CHANGE THIS: Separate query for caseclosed count (not using clone from main query)
    $this->caseClosedCount = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'caseclosed')
        ->count();
    
    // Separate queries for rejected and withdrawn (keep as is)
    $this->rejectedCount = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'rejection')
        ->count();
        
    $this->withdrawnCount = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'withdrawn')
        ->count();
}
public function updated()
{
    // Whenever any filter property changes, update the count in search filter
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
    $this->updateSearchFilterCount(); // This will update the count in search filter
}
protected function updateSearchFilterCount()
{
    $query = RegisteredInquiry::query()
        ->where('status', '!=', 'unassigned')
        ->whereNull('intake_id')
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('student_contact', 'like', '%' . $this->search . '%')
                  ->orWhere('student_name', 'like', '%' . $this->search . '%')
                  ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                  ->orWhere('unique_id', 'like', '%' . $this->search . '%')
                  ->orWhere('gmail_password', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->statusFilter !== 'all', function ($query) {
            // When filtering by specific status, show only that status
            $query->where('inquiry_status', $this->statusFilter);
        }, function ($query) {
            // When NOT filtering by status (statusFilter = 'all'), 
            // exclude rejected, withdrawn, and caseclosed to match the "All Applications" box
            $query->where('inquiry_status', '!=', 'rejection')
                  ->where('inquiry_status', '!=', 'withdrawn')
                  ->where('inquiry_status', '!=', 'caseclosed');
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
    
    // Dispatch event to update search filter component
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
            'updateFilteredCount' => 'updateFilteredCount' // Add this if you want two-way communication

    ];

    // ADD THIS METHOD: Reset all filters
   public function resetFilters()
{
    $this->search = '';
    $this->statusFilter = 'all';
    $this->dateRange = '';
    $this->partnerFilter = '';
    $this->assignedToFilter = '';
    $this->counsellorFilter = '';
    $this->resetPage();
    $this->updateSearchFilterCount(); // Update count when resetting
}
    public function unassignInquiry($inquiryId)
    {
        $inquiry = RegisteredInquiry::find($inquiryId);

        if ($inquiry && $inquiry->assigned_to) {
            $inquiry->update([
                'previous_assigned_to' => $inquiry->assigned_to,
                'assigned_to' => null,
                'assigned_at' => null,
                'status' => 'unassigned',
                'status_updated_at' => now(),
            ]);

            $this->loadCounts();
            session()->flash('message', 'Application unassigned successfully.');
        }

        $this->js('window.location.reload()');
    }
public function render()
{
    $query = RegisteredInquiry::query()
        ->where('status', '!=', 'unassigned')
        // REMOVE THESE LINES to include caseclosed in table:
        // ->where('inquiry_status', '!=', 'withdrawn')
        // ->where('inquiry_status', '!=', 'rejection')
        ->whereNull('intake_id')
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('student_contact', 'like', '%' . $this->search . '%')
                  ->orWhere('student_name', 'like', '%' . $this->search . '%')
                  ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                  ->orWhere('unique_id', 'like', '%' . $this->search . '%')
                  ->orWhere('gmail_password', 'like', '%' . $this->search . '%');
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
        })
        ->orderBy('updated_at', 'desc');

        // MODIFIED: Always use pagination but with different approaches
        if ($this->hasActiveFilters()) {
            // When filters are active, get ALL results but manually paginate with a large number
            $registeredInquiries = $query->paginate(1000); // Use a very large number to effectively show all
        } else {
            // When no filters are active, use normal pagination
            $registeredInquiries = $query->paginate(10);
        }

        return view('livewire.admission.admission-team.application.all-applications', [
            'registeredInquiries' => $registeredInquiries,
            'totalCount' => $this->totalCount,
            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casDocumentCount' => $this->casReceivedCount,
            'visaProcessCount' => $this->visaProcessCount,
            'enrollmentCount' => $this->enrollmentCount,
                              'rejectedCount' => $this->rejectedCount, // Make sure this is included
        'withdrawnCount' => $this->withdrawnCount, // Make sure this is included
            'caseClosedCount' => $this->caseClosedCount,
            'hasActiveFilters' => $this->hasActiveFilters(),
        ])->layout('layouts.admissiondashboard');
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
}