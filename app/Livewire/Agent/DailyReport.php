<?php

namespace App\Livewire\Agent;

use Livewire\Component;
use App\Models\Inquiiry;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DailyReport extends Component
{
    public $totalLeads, $hotLeads, $coldLeads, $deadLeads, $pendingLeads;
    public $date, $total_inquiries_received, $inbound_calls, $dial_calls, $connect_calls, $interested_followups, $weak_followups;
    public $today_registration, $expected_registration, $total_students, $on_hold_students, $applications_processed;
    public $total_conditional_offers, $total_students_processed, $total_unconditional_offers, $cas_stage_students, $visa_stage_students;
    public $gmail_check, $gmail_chase_up, $miscellaneous_tasks;
    public $isEditing = false;
    public $existingReport = null;

  public function mount($date = null)
{
    $userId = Auth::id();
    $this->totalLeads = Inquiiry::where('assigned_to', $userId)->count();
    $this->hotLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'hot')->count();
    $this->coldLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'cold')->count();
    $this->deadLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'dead')->count();
    $this->pendingLeads = Inquiiry::where('assigned_to', $userId)->where('inquiry_status', 'pending')->count();

    // Set the date - use provided date or default to today
    $this->date = $date ? Carbon::parse($date)->format('Y-m-d') : now()->format('Y-m-d');

    // Remove the pre-filling logic completely
    // This ensures form always starts empty
    $this->resetForm();
}

    
public function submitReport()
{
    $validatedData = $this->validate([
        'date' => 'required|date',
        'total_inquiries_received' => 'required|integer',
        'inbound_calls' => 'required|integer',
        'dial_calls' => 'required|integer',
        'connect_calls' => 'required|integer',
        'interested_followups' => 'required|integer',
        'weak_followups' => 'required|integer',
        'today_registration' => 'required|integer',
        'expected_registration' => 'required|integer',
        'total_students' => 'required|integer',
        'on_hold_students' => 'required|integer',
        'applications_processed' => 'required|integer',
        'total_conditional_offers' => 'required|integer',
        'total_students_processed' => 'required|integer',
        'total_unconditional_offers' => 'required|integer',
        'cas_stage_students' => 'required|integer',
        'visa_stage_students' => 'required|integer',
        'gmail_check' => 'required|string',
        'gmail_chase_up' => 'required|string',
        'miscellaneous_tasks' => 'nullable|string',
    ]);

    $userId = auth()->id();
    $submittedDate = Carbon::parse($this->date)->format('Y-m-d');
    $today = now()->format('Y-m-d');

    // Disallow future date submissions
    if ($submittedDate > $today) {
        session()->flash('error', 'You cannot submit a report for a future date.');
        return;
    }

    // Check if report already exists for this date
    $alreadySubmitted = Report::where('user_id', $userId)
        ->whereDate('date', $submittedDate)
        ->exists();

    if ($alreadySubmitted) {
        session()->flash('error', 'You have already submitted a report for ' . $submittedDate . '. Each date can only have one report.');
        return;
    }

    // Create new report
    Report::create(array_merge($validatedData, [
        'user_id' => $userId,
        'total_leads' => $this->totalLeads,
        'hot_leads' => $this->hotLeads,
        'cold_leads' => $this->coldLeads,
        'dead_leads' => $this->deadLeads,
        'pending_leads' => $this->pendingLeads,
    ]));

    session()->flash('success', 'Report submitted successfully for ' . $submittedDate . '.');

    // Reset form after successful submission
    $this->resetForm();
}

private function resetForm()
{
    $this->reset([
        'total_inquiries_received', 'inbound_calls', 'dial_calls', 'connect_calls',
        'interested_followups', 'weak_followups', 'today_registration', 'expected_registration',
        'total_students', 'on_hold_students', 'applications_processed', 'total_conditional_offers',
        'total_students_processed', 'total_unconditional_offers', 'cas_stage_students', 
        'visa_stage_students', 'gmail_check', 'gmail_chase_up', 'miscellaneous_tasks',
    ]);
    
    // Keep the date as today, but clear all other fields
    $this->date = now()->format('Y-m-d');
}

    private function resetInputFields()
    {
        $this->reset([
            'date', 'total_inquiries_received', 'inbound_calls', 'dial_calls', 'connect_calls',
            'interested_followups', 'weak_followups', 'today_registration', 'expected_registration',
            'total_students', 'on_hold_students', 'applications_processed', 'total_conditional_offers',
            'total_students_processed', 'total_unconditional_offers', 'cas_stage_students', 
            'visa_stage_students', 'gmail_check', 'gmail_chase_up', 'miscellaneous_tasks',
        ]);
    }

    public function render()
    {
        return view('livewire.agent.daily-report')->layout('layouts.agentdashboard');
    }
}