<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use App\Models\Inquiiry;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class Inquiries extends Component
{
    use WithPagination;
    
    public $search = '';
    public $inquiryId, $name, $email,$type, $phone_number, $phone_number2, $response, $study_course, $country, $budget, $plan, $extra, $inquiry_status;
    public $totalLeads, $hotLeads, $coldLeads, $deadLeads , $pendingLeads;
    public $assigned_at;
    public $currentPage = 1;



    public function mount()
{
    $this->currentPage = request()->get('page', 1); // stores current page in property
    $this->inquiryId = request()->get('inquiryId');  // Get inquiryId from URL
}

public function searchInquiries()
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
    public function unassignInquiry($inquiryId)
{
    $inquiry = Inquiiry::find($inquiryId);

    if ($inquiry && $inquiry->assigned_to) {
        $inquiry->update([
            'previous_assigned_to' => $inquiry->assigned_to,
            'assigned_to' => null,
            'assigned_at' => null,
            'status' => 'unassigned',
            'inquiry_status' => 'pending',
            'status_updated_at' => now(),
        ]);

        // Add these lines to refresh the page
        session()->flash('message', 'Inquiry unassigned successfully.');
    }

    // This line will refresh the page
    $this->js('window.location.reload()');
}

    public function render()
    {

        $manager = Auth::user();

            $managerInquiries = Inquiiry::where('assigned_to', $manager->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                        ->orWhere('study_course', 'like', '%' . $this->search . '%')
                        ->orWhere('extra', 'like', '%' . $this->search . '%')
                        ->orWhere('response', 'like', '%' . $this->search . '%')
                        ->orWhere('inquiry_status', 'like', '%' . $this->search . '%');
                })
                ->orderBy('updated_at', 'desc')
                ->with('assignedToUser') // Add relationship in Inquiiry model
                ->latest()
                ->paginate(100);

        return view('livewire.manager.inquiries', [
            'managerInquiries' => $managerInquiries,
        ])->layout('layouts.managerdashboard');
    }

    #[On('inquiry-updated')]
public function refreshRow($id)
{
    $this->resetPage();
}

    public function resetInputs()
    {
        $this->name = $this->email = $this->type = $this->phone_number = $this->phone_number2 = null;
        $this->response = $this->study_course = $this->country = $this->budget = null;
        $this->plan = $this->extra = $this->inquiry_status = null;
    }
}
