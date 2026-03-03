<?php

namespace App\Livewire\ExternalAgent\Applications;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UnconditionalOffers extends Component
{
    use WithPagination;
    
    public $search = '';
    
    // Count variables for all statuses
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
    
    public function mount()
    {
        $this->loadCounts();
    }
    protected function loadCounts()
    {
        $agent = Auth::user();
        
        // Base query for counts - only show inquiries for this agent
        $query = RegisteredInquiry::where('users_id', $agent->id)        ->whereNull('intake_id')
;
        
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

     public function render()
    {
        $agent = Auth::user();
        $registeredInquiries = RegisteredInquiry::where('users_id', $agent->id)
            ->where('inquiry_status', 'unconditional')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_name', 'like', '%'.$this->search.'%')
                      ->orWhere('student_contact', 'like', '%'.$this->search.'%')
                      ->orWhere('course_name', 'like', '%'.$this->search.'%')
                                          ->orWhere('student_name', 'like', '%' . $this->search . '%')

                      ->orWhere('unique_id', 'like', '%'.$this->search.'%')
                      ->orWhere('passport_number', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(50);

        return view('livewire.external-agent.applications.unconditional-offers', [
            'registeredInquiries' => $registeredInquiries,
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
        ])->layout('layouts.externalagent');
    }
     public function showDetails($id)
    {
        $this->dispatch('showDetails', id: $id)->to(\App\Livewire\ExternalAgent\Modal\ViewRegisteredApplicationDetails::class);
    }
        protected $listeners = ['refreshApplications' => '$refresh'];

    public function searches()
    {
        $this->resetPage();
        $this->loadCounts(); // Reload counts when searching
    }
}
