<?php

namespace App\Livewire\Agent\Intake;

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
        $currentUserId = Auth::id();
        
        $this->intake = Intake::withCount(['inquiries' => function($query) use ($currentUserId) {
            $query->where('inquiry_status', 'enrollment')
                  ->where('users_id', $currentUserId); // Only count inquiries where agent is the owner
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
    
    public function render()
    {
        $currentUserId = Auth::id();
        
        $inquiries = $this->intake->inquiries()
            ->where('inquiry_status', 'enrollment')
            ->where('users_id', $currentUserId) // Only show inquiries where agent is the owner
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('unique_id', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('added_to_intake_at', 'desc')
            ->paginate(10);
            
        return view('livewire.agent.intake.intake-details', [
            'inquiries' => $inquiries
        ])->layout('layouts.agentdashboard');
    }
}