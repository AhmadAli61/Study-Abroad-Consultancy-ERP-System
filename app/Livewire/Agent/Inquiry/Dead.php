<?php

namespace App\Livewire\Agent\Inquiry;

use Livewire\Component;
use App\Models\Inquiiry;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Dead extends Component
{
    use WithPagination;

    public $inquiryId, $name, $email, $type, $phone_number, $phone_number2, $response, $study_course, $country, $budget, $plan, $extra, $inquiry_status;
    public $assigned_at;

    public $search = '';
    public $currentPage = 1;    
    
    // Add lead count properties
    public $totalLeads, $hotLeads, $coldLeads, $deadLeads, $pendingLeads, $registeredLeads;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = ['refreshInquiries' => '$refresh'];

    #[On('inquiry-updated')]
    public function refreshRow($id)
    {
        $this->resetPage();
    }
    
    public function mount()
    {
        $this->currentPage = request()->get('page', 1); // stores current page in property
        $this->inquiryId = request()->get('inquiryId');  // Get inquiryId from URL
        
        // Add lead counts calculation
        $userId = Auth::id();
        $this->totalLeads = Inquiiry::where('assigned_to', $userId)->count();
        $this->hotLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'hot')->count();
        $this->coldLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'cold')->count();
        $this->deadLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'dead')->count();
        $this->pendingLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'pending')->count();
        $this->registeredLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'registered')->count();
    }

    public function resetInputs()
    {
        $this->name = null;
        $this->email = null;
        $this->type = null;
        $this->phone_number = null;
        $this->phone_number2 = null;
        $this->response = null;
        $this->study_course = null;
        $this->country = null;
        $this->budget = null;
        $this->plan = null;
        $this->extra = null;
        $this->inquiry_status = null;
    }
    
    public function render()
    {
        $userId = Auth::id();

        $inquiries = Inquiiry::where('assigned_to', Auth::id())
            ->where('inquiry_status', 'Dead')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                      ->orWhere('budget', 'like', '%' . $this->search . '%');
            })
            ->orderBy('updated_at', 'desc')  // This will sort by most recently updated first
            ->paginate(25);

        return view('livewire.agent.inquiry.dead', compact('inquiries'))
            ->layout('layouts.agentdashboard');
    }

    public function searches()
    {
        $userId = Auth::id();

        $inquiries = Inquiiry::where('assigned_to', $userId)
            ->where('inquiry_status', 'Dead')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                      ->orWhere('budget', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->get();
    }
}