<?php

namespace App\Livewire\Admin\InquiriesDetail\Modal;

use Livewire\Component;
use App\Models\Inquiiry;
use Livewire\Attributes\On;

class ViewModal extends Component
{
    public $inquiryId;
    public $name, $email, $phone_number, $study_course, $response, $country, $budget,
           $plan, $extra, $inquiry_status, $type, $phone_number2, $assigned_at;
    public $showModal = false;

    #[On('viewDetails')]
    public function viewDetails($id)
    {
        $inquiry = Inquiiry::select('id', 'name', 'email', 'phone_number', 'study_course', 'response', 'country', 'budget', 'plan', 'extra', 'inquiry_status', 'type', 'phone_number2', 'assigned_at')->findOrFail($id);

        $this->inquiryId = $inquiry->id;
        $this->name = $inquiry->name;
        $this->email = $inquiry->email;
        $this->phone_number = $inquiry->phone_number;
        $this->study_course = $inquiry->study_course;
        $this->response = $inquiry->response;
        $this->country = $inquiry->country;
        $this->budget = $inquiry->budget;
        $this->plan = $inquiry->plan;
        $this->extra = $inquiry->extra;
        $this->inquiry_status = $inquiry->inquiry_status;
        $this->type = $inquiry->type;
        $this->phone_number2 = $inquiry->phone_number2;
        $this->assigned_at = $inquiry->assigned_at;

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.inquiries-detail.modal.view-modal');
    }
}