<?php

namespace App\Livewire\Admission\Intake;

use App\Models\Intake;
use Livewire\Component;

class AddIntake extends Component
{
    public $name = '';
    public $year = '';
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'year' => 'required|integer|min:2020|max:2030'
    ];
    
    protected $messages = [
        'name.required' => 'Intake name is required.',
        'year.required' => 'Intake year is required.',
        'year.integer' => 'Year must be a valid number.',
        'year.min' => 'Year must be at least 2020.',
        'year.max' => 'Year cannot be greater than 2030.'
    ];
    
    public function mount()
    {
        $this->year = date('Y'); // Set current year as default
    }
    
    public function saveIntake()
    {
        $this->validate();
        
        try {
            // Check if intake already exists
            $existingIntake = Intake::where('name', $this->name)
                ->where('year', $this->year)
                ->first();
                
            if ($existingIntake) {
                session()->flash('error', 'An intake with this name and year already exists.');
                return;
            }
            
            Intake::create([
                'name' => $this->name,
                'year' => $this->year,
                'created_by' => auth()->id()
            ]);
            
            session()->flash('message', 'Intake created successfully!');
            $this->reset(['name']);
            $this->year = date('Y'); // Reset to current year
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create intake: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.admission.intake.add-intake')->layout('layouts.admissiondashboard');
    }
}