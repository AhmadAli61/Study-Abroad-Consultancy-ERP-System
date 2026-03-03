<?php

namespace App\Livewire\Manager\Report;

use Livewire\Component;
use App\Models\Report;
use App\Models\User;

class CounsellorReport extends Component
{
       public $user;
    public $reports;
    public $searchDate; // To store search input

    public function mount($user)
    {
        $this->user = User::findOrFail($user);
        // Initially load all reports ordered by date descending
        $this->loadReports();
    }

    // Load reports based on searchDate (if set)
    public function loadReports()
    {
        $query = Report::where('user_id', $this->user->id);

        if (!empty($this->searchDate)) {
            // Filter reports by date. Adjust format based on how you store dates
            $query->where('date', $this->searchDate);
        }

        $this->reports = $query->orderBy('date', 'desc')->get();
    }

    // Method triggered by the search button
    public function searchReports()
    {
        $this->loadReports();
    }
    public function render()
    {
        return view('livewire.manager.report.counsellor-report', [
            'reports' => $this->reports,
            'user' => $this->user,
        ])->layout('layouts.managerdashboard');
    }
}
