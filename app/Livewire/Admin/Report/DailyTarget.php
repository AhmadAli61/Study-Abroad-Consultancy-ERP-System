<?php

namespace App\Livewire\Admin\Report;

use Livewire\Component;

class DailyTarget extends Component
{
    public function render()
    {
        return view('livewire.admin.report.daily-target')->layout('layouts.admindashboard');
    }
}
