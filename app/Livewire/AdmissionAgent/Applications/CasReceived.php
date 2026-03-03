<?php

namespace App\Livewire\AdmissionAgent\Applications;

use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\UserHelper;



class CasReceived extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'casreceived';

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

    public function mount()
    {
        $this->loadCounts();
    }

 protected function loadCounts()
{
    // Get accessible user IDs (for both primary agents and their assistants)
    $accessibleUserIds = UserHelper::getAccessibleUserIds(auth()->user());
    
    // Base query for counts - show inquiries assigned to this agent OR their parent/assistant
    // Excluding withdrawn, caseclosed, and rejection from main counts
    $query = RegisteredInquiry::whereIn('assigned_to', $accessibleUserIds)
        ->where('status', '!=', 'unassigned')
        ->where('inquiry_status', '!=', 'withdrawn') // Exclude withdrawn from counts
        ->whereNull('intake_id')
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
    $this->caseClosedCount = RegisteredInquiry::whereIn('assigned_to', $accessibleUserIds)
        ->where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'caseclosed')
        ->count();
    
    // If you also need separate rejected and withdrawn counts for boxes:
    $this->rejectedCount = RegisteredInquiry::whereIn('assigned_to', $accessibleUserIds)
        ->where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'rejection')
        ->count();
        
    $this->withdrawnCount = RegisteredInquiry::whereIn('assigned_to', $accessibleUserIds)
        ->where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'withdrawn')
        ->count();
}

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function searches()
    {
        // This method is triggered by the search button click
        $this->resetPage();
    }

    public function render()
    {
            $accessibleUserIds = UserHelper::getAccessibleUserIds(auth()->user());
        
        $query = RegisteredInquiry::query()
            ->whereIn('assigned_to', $accessibleUserIds) 
            ->where('status', '!=', 'unassigned')
            ->where('inquiry_status', 'casreceived')
            // UPDATED SEARCH LOGIC TO MATCH REFERENCE
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_contact', 'like', '%' . $this->search . '%')
                        ->orWhere('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('unique_id', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('inquiry_status', $this->statusFilter);
            })
            ->orderBy('updated_at', 'desc');

        $registeredInquiries = $query->paginate(10);

        return view('livewire.admission-agent.applications.cas-received', [
            'registeredInquiries' => $registeredInquiries,
            'totalCount' => $this->totalCount,
            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casReceiveCount' => $this->casReceivedCount,
            'visaProcessCount' => $this->visaProcessCount,
            'enrollmentCount' => $this->enrollmentCount,
            'caseClosedCount' => $this->caseClosedCount,
        ])->layout('layouts.admissionagentdashboard');
    }

   
     protected $listeners = ['refreshApplications' => '$refresh'];

    public function openNewInquiry($inquiryId)
    {
        $this->dispatch('openNewInquiryModal', parentId: $inquiryId);
    }

    public function filterByStatus($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }
}