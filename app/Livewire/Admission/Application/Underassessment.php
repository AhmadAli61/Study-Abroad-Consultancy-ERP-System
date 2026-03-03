<?php

namespace App\Livewire\Admission\Application;

use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;

class Underassessment extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'underassessment';
    
    // Add count properties
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

    public function render()
    {
        // Get the current authenticated user's ID
        $userId = auth()->id();
        
        $query = RegisteredInquiry::query()
            ->where('assigned_to', $userId) // Only show inquiries assigned to this user
            ->where('status', '!=', 'unassigned') // Exclude unassigned inquiries
            ->where('inquiry_status', '!=', 'withdrawn')
            ->where('inquiry_status', 'underassessment') // Filter for underassessment status
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

        return view('livewire.admission.application.underassessment', [
            'registeredInquiries' => $registeredInquiries,
            'totalCount' => $this->totalCount,
            'underAssessmentCount' => $this->underAssessmentCount,
            'processedCount' => $this->processedCount,
            'conditionalCount' => $this->conditionalCount,
            'unconditionalCount' => $this->unconditionalCount,
            'underCasCount' => $this->underCasCount,
            'casDocumentCount' => $this->casReceivedCount, // Maintaining blade template compatibility
            'visaProcessCount' => $this->visaProcessCount,
            'enrollmentCount' => $this->enrollmentCount,
            'caseClosedCount' => $this->caseClosedCount,
        ])->layout('layouts.admissiondashboard');
    }

        // ADDED: Search functionality methods from reference
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