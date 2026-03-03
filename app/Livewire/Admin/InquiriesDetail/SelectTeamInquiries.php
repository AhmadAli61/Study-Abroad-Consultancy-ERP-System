<?php

namespace App\Livewire\Admin\InquiriesDetail;

use Livewire\Component;
use App\Models\Team;

class SelectTeamInquiries extends Component
{
    public function render()
    {
      $teams = Team::with(['manager', 'counsellors'])->get(); // Fetch teams with manager and counselors
        return view('livewire.admin.inquiries-detail.select-team-inquiries', compact('teams'))->layout('layouts.admindashboard');
    }
}
