<?php

namespace App\Livewire\Manager\Team;

use Livewire\Component;
use App\Models\Inquiiry;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;

class Dashboard extends Component
{
    public $totalLeads, $hotLeads, $coldLeads, $deadLeads, $pendingLeads;

   public function render()
    {
        $manager = Auth::user();
        $team = Team::where('manager_id', $manager->id)->first();

        if ($team) {
            $teamMemberIds = $team->counsellors->pluck('id');
            $this->totalLeads = Inquiiry::whereIn('assigned_to', $teamMemberIds)->count();
            $this->hotLeads = Inquiiry::whereIn('assigned_to', $teamMemberIds)->where('inquiry_status', 'hot')->count();
            $this->coldLeads = Inquiiry::whereIn('assigned_to', $teamMemberIds)->where('inquiry_status', 'cold')->count();
            $this->deadLeads = Inquiiry::whereIn('assigned_to', $teamMemberIds)->where('inquiry_status', 'dead')->count();
            $this->pendingLeads = Inquiiry::whereIn('assigned_to', $teamMemberIds)->where('inquiry_status', 'pending')->count();
        }
        return view('livewire.manager.team.dashboard')->layout('layouts.managerdashboard');
    }
}
