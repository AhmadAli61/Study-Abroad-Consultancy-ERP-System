<?php
namespace App\Livewire\Manager\Team;

use Livewire\Component;
use App\Models\Inquiiry;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use Livewire\WithPagination;

class Dead extends Component
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
            ->where('inquiry_status', 'dead') // Filter for hot inquiries
            ->with('assignedToUser') // Add relationship in Inquiiry model
            ->latest()
            ->paginate(25); // 👈 Change this line from `->get()` to `->paginate(10)`

        }
    return view('livewire.manager.team.dead' , [
        'allInquiries' => $allInquiries,
    ])->layout('layouts.managerdashboard');
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
}