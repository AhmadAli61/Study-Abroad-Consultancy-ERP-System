<?php

namespace App\Livewire\HR;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.hr.dashboard')->layout('layouts.hrdashboard');
    }
}
