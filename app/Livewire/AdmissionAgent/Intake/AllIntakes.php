<?php

namespace App\Livewire\AdmissionAgent\Intake;

use App\Models\Intake;
use App\Models\RegisteredInquiry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AllIntakes extends Component
{
    use WithPagination;
    
    public $searchTerm = '';
    
    public function performSearch()
    {
        $this->resetPage();
    }
    
    public function clearSearch()
    {
        $this->searchTerm = '';
        $this->resetPage();
    }
    
    public function render()
    {
        $currentUserId = Auth::id();
        
        $intakes = Intake::withCount(['inquiries' => function($query) use ($currentUserId) {
                $query->where('inquiry_status', 'enrollment')
                      ->where('assigned_to', $currentUserId); // Only count inquiries assigned to this agent
            }])
            ->when($this->searchTerm, function($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('year', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy('year', 'desc')
            ->orderBy('name')
            ->paginate(12);
            
        return view('livewire.admission-agent.intake.all-intakes', compact('intakes'))->layout('layouts.admissionagentdashboard');
    }
}