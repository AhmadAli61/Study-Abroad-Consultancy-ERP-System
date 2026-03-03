<?php

namespace App\Livewire\Agent;

use Livewire\Component;
use App\Models\Inquiiry;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Inquiries extends Component
{
    use WithPagination;

    public $inquiryId, $name, $email,$type, $phone_number, $phone_number2, $response, $study_course, $country, $budget, $plan, $extra, $inquiry_status;
    public $totalLeads, $hotLeads, $coldLeads, $deadLeads, $pendingLeads, $registeredLeads;
    public $assigned_at;
    public $currentPage = 1;
    public $search = '';
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $userId = Auth::id();
        
        $inquiries = Inquiiry::where('assigned_to', Auth::id())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                      ->orWhere('budget', 'like', '%' . $this->search . '%');
            })
            ->orderBy('updated_at', 'desc')
            ->latest()
            ->paginate(100);

        return view('livewire.agent.inquiries', compact('inquiries'))
            ->layout('layouts.agentdashboard');
    }

    public function searches(){
        $inquiries = Inquiiry::where('assigned_to', Auth::id())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                      ->orWhere('budget', 'like', '%' . $this->search . '%');
            })
            ->orderBy('updated_at', 'desc')
            ->latest()
            ->get();
    }

    #[On('inquiry-updated')]
    public function refreshRow($id)
    {
        $this->resetPage();
    }
    
    public function getDateStatus($inquiry)
    {
        $now = now();
        $sevenDaysAgo = $now->subDays(7);
        
        $status = [
            'updated_at_old' => false,
            'assigned_at_pending' => false
        ];
        
        if ($inquiry->updated_at && $inquiry->updated_at->lt($sevenDaysAgo)) {
            $status['updated_at_old'] = true;
        }
        
        if ($inquiry->assigned_at && empty($inquiry->response)) {
            $status['assigned_at_pending'] = true;
        }
        
        return $status;
    }
    
    public function mount()
    {
        $this->currentPage = request()->get('page', 1);
        $this->inquiryId = request()->get('inquiryId');
        
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