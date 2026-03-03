<?php

namespace App\Livewire\Agent\Inquiry;

use Livewire\Component;
use App\Models\Inquiiry;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Hot extends Component
{
    use WithPagination;

    public $inquiryId, $name, $email, $type, $phone_number, $phone_number2, $response, $study_course, $country, $budget, $plan, $extra, $inquiry_status;
    public $created_at, $updated_at;
    public $currentPage = 1;
    public $assigned_at;
    public $search = '';

    // Add lead count properties
    public $totalLeads, $hotLeads, $coldLeads, $deadLeads, $pendingLeads, $registeredLeads;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $userId = Auth::id();

        $inquiries = Inquiiry::where('assigned_to', $userId)
            ->where('inquiry_status', 'Hot')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                      ->orWhere('budget', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('updated_at', 'desc')  // This will sort by most recently updated first
            ->paginate(25);

        return view('livewire.agent.inquiry.hot', compact('inquiries'))
            ->layout('layouts.agentdashboard');
    }

    public function getDateStatus($inquiry)
    {
        $now = now();
        $sevenDaysAgo = $now->subDays(7);
        
        $status = [
            'updated_at_old' => false,
            'assigned_at_pending' => false
        ];
        
        // Check if updated_at is older than 7 days
        if ($inquiry->updated_at && $inquiry->updated_at->lt($sevenDaysAgo)) {
            $status['updated_at_old'] = true;
        }
        
        // Check if assigned_at exists and no response
        if ($inquiry->assigned_at && empty($inquiry->response)) {
            $status['assigned_at_pending'] = true;
        }
        
        return $status;
    }

    protected $listeners = ['refreshInquiries' => '$refresh'];

    public function searches()
    {
        $userId = Auth::id();

        $inquiries = Inquiiry::where('assigned_to', $userId)
            ->where('inquiry_status', 'Hot')
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
        $this->name = $this->email = $this->type = $this->phone_number = $this->phone_number2 = null;
        $this->response = $this->study_course = $this->country = $this->budget = null;
        $this->plan = $this->extra = $this->inquiry_status = null;
    }
}