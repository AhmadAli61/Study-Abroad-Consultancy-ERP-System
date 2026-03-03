<?php

namespace App\Livewire\Manager\Team;

use Livewire\Component;
use App\Models\Inquiiry;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use Livewire\WithPagination;

class Pending extends Component
{
use WithPagination;
public $search = '';
public $inquiryId, $name, $email,$type, $phone_number, $phone_number2, $response, $study_course, $country, $budget, $plan, $extra, $inquiry_status;
public $assigned_at;

public $currentPage = 1;



public function searchInquiries()
{
    $this->resetPage();
}



public function render()
{

    $manager = Auth::user();
    $team = Team::where('manager_id', $manager->id)->first();

    if ($team) {
        $teamMemberIds = $team->counsellors->pluck('id');
        $allInquiries = Inquiiry::whereIn('assigned_to', $teamMemberIds)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $this->search . '%');
            })
            ->where('inquiry_status', 'pending') // Filter for hot inquiries
            ->with('assignedToUser') // Add relationship in Inquiiry model
            ->latest()
            ->paginate(25); // 👈 Change this line from `->get()` to `->paginate(10)`
        }


    return view('livewire.manager.team.pending' , [
        'allInquiries' => $allInquiries,
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
public function mount()
{
    $this->currentPage = request()->get('page', 1); // stores current page in property
    $this->inquiryId = request()->get('inquiryId');  // Get inquiryId from URL
}
}