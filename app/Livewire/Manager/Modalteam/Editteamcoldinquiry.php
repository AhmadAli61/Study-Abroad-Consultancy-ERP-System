<?php

namespace App\Livewire\Manager\Modalteam;

use Livewire\Component;
use App\Models\Inquiiry;
use Livewire\Attributes\On;

class Editteamcoldinquiry extends Component
{
    public $inquiryId, $name, $email, $type, $phone_number, $phone_number2, $response, $study_course, $country, $budget, $plan, $extra, $inquiry_status;
    public $currentPage = 1;
    public $showModal = false;

    public function mount() {

        $this->currentPage = request()->get('page', 1);  
        $this->showModal = false;
    }
    
    #[On('editInquiry')]
    public function editInquiry($id)
    {
        \Log::info('Editing inquiry ID: ' . $id);


        $inquiry = Inquiiry::findOrFail($id);
        $this->inquiryId = $inquiry->id;
        $this->name = $inquiry->name;
        $this->email = $inquiry->email;
        $this->type = $inquiry->type;
        $this->phone_number = $inquiry->phone_number;
        $this->phone_number2 = $inquiry->phone_number2;
        $this->response = $inquiry->response;
        $this->study_course = $inquiry->study_course;
        $this->country = $inquiry->country;
        $this->budget = $inquiry->budget;
        $this->plan = $inquiry->plan;
        $this->extra = $inquiry->extra;
        $this->inquiry_status = $inquiry->inquiry_status;

        $this->showModal = true;
    }    
        public function update()
    {
        $this->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'type' => 'required|in:Referral,Meta Leads W,Google Leads',
            'phone_number' => 'required',
            'phone_number2' => 'nullable',
            'response' => 'nullable',
            'study_course' => 'nullable',
            'country' => 'nullable',
            'budget' => 'nullable',
            'plan' => 'nullable',
            'extra' => 'nullable',
            'inquiry_status' => 'nullable',
        ]);

        \Log::info('Updating inquiry ID: ' . $this->inquiryId);

        Inquiiry::where('id', $this->inquiryId)->update([
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'phone_number' => $this->phone_number,
            'phone_number2' => $this->phone_number2,
            'response' => $this->response,
            'study_course' => $this->study_course,
            'country' => $this->country,
            'budget' => $this->budget,
            'plan' => $this->plan,
            'extra' => $this->extra,
            'inquiry_status' => $this->inquiry_status,
        ]);

        session()->flash('message', 'Inquiry updated successfully!');
        $this->showModal = false;
    
        return redirect()->route('manager.team.inquiry.cold', [
            'page' => $this->currentPage, 
        ]);


    }
    public function render()
    {
        return view('livewire.manager.modalteam.editteamcoldinquiry');
    }
}
