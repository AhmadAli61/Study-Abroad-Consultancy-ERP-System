<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use Livewire\Component;

class Notifications extends Component
{
    public $submittedUsers;
    public $notSubmittedUsers;

    public function mount()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $today = Carbon::today()->toDateString();

        // Get all active counselors and managers
        $users = User::where('status', 1) // Filter by active users
            ->whereIn('role', ['counsellor', 'manager'])
            ->get();

        // Get user IDs who submitted reports today
        $submittedUserIds = Report::whereDate('date', $today)->pluck('user_id')->toArray();

        // Separate submitted and not submitted
        $this->submittedUsers = $users->whereIn('id', $submittedUserIds);
        $this->notSubmittedUsers = $users->whereNotIn('id', $submittedUserIds);
    }

    public function render()
    {
        return view('livewire.admin.notifications', [
            'submittedUsers' => $this->submittedUsers,
            'notSubmittedUsers' => $this->notSubmittedUsers,
        ])->layout('layouts.admindashboard');
    }
}
