<?php

namespace App\Livewire\ExternalAgent\Intake;

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
                      ->where('users_id', $currentUserId); // Only count inquiries where external agent is the owner
            }])
            ->when($this->searchTerm, function($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('year', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy('year', 'desc')
            ->orderBy('name')
            ->paginate(12);
            
        return view('livewire.external-agent.intake.all-intakes', compact('intakes'))->layout('layouts.externalagent');
    }
}