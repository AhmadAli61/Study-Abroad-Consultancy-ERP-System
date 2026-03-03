<?php

namespace App\Livewire\Admission\AdmissionTeam\Application;

use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;

class CaseClosed extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'caseclosed'; // Default to caseclosed status
    
    // Count properties
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

    public function render()
    {
        $query = RegisteredInquiry::query()
            ->where('status', '!=', 'unassigned') // Exclude unassigned inquiries
            ->where('inquiry_status', '!=', 'withdrawn')
            ->where('inquiry_status', 'caseclosed') // Filter for caseclosed status
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_contact', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('unique_id', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('updated_at', 'desc');

        $registeredInquiries = $query->paginate(10);

        return view('livewire.admission.admission-team.application.case-closed', [
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
            'caseClosedCount' => $this->caseClosedCount,
        ])->layout('layouts.admissiondashboard');
    }

      public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searches()
    {
        $this->resetPage();
    }
        protected $listeners = ['refreshApplications' => '$refresh'];

    public function filterByStatus($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }
}