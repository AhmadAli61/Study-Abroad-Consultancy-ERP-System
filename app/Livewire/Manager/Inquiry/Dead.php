<?php

namespace App\Livewire\Manager\Inquiry;

use Livewire\Component;
use App\Models\Inquiiry;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
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

        protected $listeners = ['refreshInquiries' => '$refresh'];

public function render()
{

    $manager = Auth::user();
    $managerId = $manager->id;


        $managerInquiries = Inquiiry::where('assigned_to', $manager->id)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $this->search . '%');
            })
            ->where('inquiry_status', 'Dead')
            ->with('assignedToUser') // Add relationship in Inquiiry model
            ->orderBy('updated_at', 'desc')  // This will sort by most recently updated first
            ->paginate(25); // Adjust the number of items per page as needed

    return view('livewire.manager.inquiry.dead', [
        'managerInquiries' => $managerInquiries,
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
