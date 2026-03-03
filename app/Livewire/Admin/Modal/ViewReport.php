<?php

namespace App\Livewire\Admin\Modal;

use Livewire\Component;
use App\Models\Report;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ViewReport extends Component
{

     use WithPagination;
    public $report_id;
    public $id;
    public $report;
    public $inquiryId;
    public $user_id;

public $date, $total_inquiries_received, $inbound_calls, $dial_calls, $connect_calls, $interested_followups, $weak_followups, $today_registration, $expected_registration, 
       $total_students, $on_hold_students, $applications_processed, $total_conditional_offers, $total_students_processed, $total_unconditional_offers, $cas_stage_students, 
       $visa_stage_students, $gmail_check, $gmail_chase_up, $miscellaneous_tasks, $total_leads, $hot_leads, $cold_leads, $dead_leads, $pending_leads , $username;

    public $showModal = false;


    #[On('viewDetails')]
   public function viewDetails($id)
{
    $report = Report::select(
        'id', 'user_id', 'date', 'total_inquiries_received', 'inbound_calls', 'dial_calls', 'connect_calls', 'interested_followups', 'weak_followups', 'today_registration', 'expected_registration', 
        'total_students', 'on_hold_students', 'applications_processed', 'total_conditional_offers', 'total_students_processed', 'total_unconditional_offers', 'cas_stage_students', 'visa_stage_students', 
        'gmail_check', 'gmail_chase_up', 'miscellaneous_tasks', 'total_leads', 'hot_leads', 'cold_leads', 'dead_leads', 'pending_leads')->findOrFail($id);

    // Assigning report data to public properties
    $this->id = $report->id;
    $this->user_id = $report->user_id;
    $this->date = $report->date;
    $this->total_inquiries_received = $report->total_inquiries_received;
    $this->inbound_calls = $report->inbound_calls;
    $this->dial_calls = $report->dial_calls;
    $this->connect_calls = $report->connect_calls;
    $this->interested_followups = $report->interested_followups;
    $this->weak_followups = $report->weak_followups;
    $this->today_registration = $report->today_registration;
    $this->expected_registration = $report->expected_registration;
    $this->total_students = $report->total_students;
    $this->on_hold_students = $report->on_hold_students;
    $this->applications_processed = $report->applications_processed;
    $this->total_conditional_offers = $report->total_conditional_offers;
    $this->total_students_processed = $report->total_students_processed;
    $this->total_unconditional_offers = $report->total_unconditional_offers;
    $this->cas_stage_students = $report->cas_stage_students;
    $this->visa_stage_students = $report->visa_stage_students;
    $this->gmail_check = $report->gmail_check;
    $this->gmail_chase_up = $report->gmail_chase_up;
    $this->miscellaneous_tasks = $report->miscellaneous_tasks;
    $this->total_leads = $report->total_leads;
    $this->hot_leads = $report->hot_leads;
    $this->cold_leads = $report->cold_leads;
    $this->dead_leads = $report->dead_leads;
    $this->pending_leads = $report->pending_leads;

    // Set modal visibility
    $this->showModal = true;
}


    public function closeModal()
    {
        $this->showModal = false;
        $this->reset();
    }


    public function render()
    {
        return view('livewire.admin.modal.view-report');
    }
}
