<?php

namespace App\Livewire\Admin\Admission\Applications;

use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;

class ConditionalOffers extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'conditional'; // Default to conditional status
    
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
                public $isViewOnly = false;


      public function mount()
    {
        $this->isViewOnly = auth()->user()->permission_level === 'view_only';

        $this->loadCounts();
    }
        public function showViewOnlyError()
    {
        if ($this->isViewOnly) {
            $this->dispatch('show-error', message: 'View-only admins cannot perform this action');
            return true;
        }
        return false;
    }
     public function performAction($action, $inquiryId = null)
    {
        if ($this->showViewOnlyError()) {
            return;
        }

        // Your existing action logic here
        // For example:
        // if ($action === 'edit') {
        //     // Edit logic
        // }
    }

   protected function loadCounts()
{
    // Main query for all active applications (excluding rejected, withdrawn, and caseclosed)
    $query = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->where('inquiry_status', '!=', 'rejection')
        ->whereNull('intake_id') 
        ->where('inquiry_status', '!=', 'withdrawn')
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
    $this->caseClosedCount = RegisteredInquiry::where('status', '!=', 'unassigned')
        ->where('inquiry_status', 'caseclosed')
        ->count();
    
    // Separate queries for rejected and withdrawn
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
                                                ->where('inquiry_status', '!=', 'rejection') // Exclude rejection status

            ->where('inquiry_status', 'conditional') // Filter for conditional status
           ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_contact', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('unique_id', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('inquiry_status', $this->statusFilter);
            })
            ->orderBy('updated_at', 'desc');

        $registeredInquiries = $query->paginate(10);

        return view('livewire.admin.admission.applications.conditional-offers', [
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
            'isViewOnly' => $this->isViewOnly, // PASS TO VIEW
        ])->layout('layouts.admindashboard');
    }

    // ADDED: Search functionality methods
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