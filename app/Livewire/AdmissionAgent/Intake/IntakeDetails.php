<?php

namespace App\Livewire\AdmissionAgent\Intake;

use App\Models\Intake;
use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class IntakeDetails extends Component
{
    use WithPagination;
    
    public $intake;
    public $search = '';
    
    public function mount($intakeId)
    {
        $this->intake = Intake::withCount(['inquiries' => function($query) {
            $currentUserId = Auth::id();
            $query->where('inquiry_status', 'enrollment')
                  ->where('assigned_to', $currentUserId);
        }])->findOrFail($intakeId);
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function searches()
    {
        $this->resetPage();
    }
    
    public function removeFromIntake($inquiryId)
    {
        try {
            $currentUserId = Auth::id();
            $inquiry = RegisteredInquiry::where('id', $inquiryId)
                        ->where('assigned_to', $currentUserId) // Only allow removal if assigned to this agent
                        ->firstOrFail();
                        
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
        $currentUserId = Auth::id();
        
        $inquiries = $this->intake->inquiries()
            ->where('inquiry_status', 'enrollment')
            ->where('assigned_to', $currentUserId) // Only show inquiries assigned to this agent
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('unique_id', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('added_to_intake_at', 'desc')
            ->paginate(10);
            
        return view('livewire.admission-agent.intake.intake-details', [
            'inquiries' => $inquiries
        ])->layout('layouts.admissionagentdashboard');
    }
}