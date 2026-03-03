<?php

namespace App\Livewire\Admission\Intake;

use App\Models\Intake;
use Livewire\Component;
use Livewire\WithPagination;

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
        $intakes = Intake::withCount(['inquiries' => function($query) {
                $query->where('inquiry_status', 'enrollment');
            }])
            ->when($this->searchTerm, function($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('year', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy('year', 'desc')
            ->orderBy('name')
            ->paginate(12);
            
        return view('livewire.admission.intake.all-intakes', compact('intakes'))->layout('layouts.admissiondashboard');
    }
}