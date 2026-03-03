<?php

namespace App\Livewire\Admission\Intake;

use App\Models\Intake;
use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;

class IntakeDetails extends Component
{
    use WithPagination;
    
    public $intake;
    public $search = '';
    
    public function mount($intakeId)
    {
        $this->intake = Intake::withCount('inquiries')->findOrFail($intakeId);
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    // ADD THIS METHOD
    public function searches()
    {
        $this->resetPage();
    }
    
    public function removeFromIntake($inquiryId)
    {
        try {
            $inquiry = RegisteredInquiry::findOrFail($inquiryId);
            $inquiry->update([
                'intake_id' => null,
                'added_to_intake_at' => null
            ]);
            
            session()->flash('message', 'Student removed from intake successfully.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to remove student from intake: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        $inquiries = $this->intake->inquiries()
            ->where('inquiry_status', 'enrollment')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('unique_id', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('added_to_intake_at', 'desc')
            ->paginate(10);
            
        return view('livewire.admission.intake.intake-details', [
            'inquiries' => $inquiries
        ])->layout('layouts.admissiondashboard');
    }
}