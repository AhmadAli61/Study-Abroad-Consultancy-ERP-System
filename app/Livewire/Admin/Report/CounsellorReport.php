<?php

namespace App\Livewire\Admin\Report;

use App\Models\Report;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CounsellorReport extends Component
{
    use WithPagination;

    public $user;
    public $searchDate; // To store search input

    public function mount($user)
    {
        $this->user = User::findOrFail($user);
    }

    // Method triggered by the search button
    public function searchReports()
    {
        $this->resetPage(); // Reset to first page when searching
    }

    public function render()
    {
        $query = Report::where('user_id', $this->user->id);

        if (!empty($this->searchDate)) {
            // Filter reports by date. Adjust format based on how you store dates
            $query->where('date', $this->searchDate);
        }

        $reports = $query->orderBy('date', 'desc')->paginate(25);

        return view('livewire.admin.report.counsellor-report', [
            'user' => $this->user,
            'reports' => $reports,
        ])->layout('layouts.admindashboard');
    }
}