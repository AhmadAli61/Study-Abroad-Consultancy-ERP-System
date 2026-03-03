<?php

namespace App\Livewire\Manager\Report;

use App\Models\Team;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TeamReport extends Component
{
    public $teams;

    public function mount()
    {
        $this->teams = Team::where('manager_id', Auth::id())
            ->with([
                'manager' => function ($query) {
                    $query->withCount([
                        'inquiries as inquiries_count',
                        'inquiries as hot_leads' => fn($q) => $q->where('inquiry_status', 'hot'),
                        'inquiries as cold_leads' => fn($q) => $q->where('inquiry_status', 'cold'),
                        'inquiries as dead_leads' => fn($q) => $q->where('inquiry_status', 'dead'),
                        'inquiries as pending_leads' => fn($q) => $q->where('inquiry_status', 'pending'),
                    ]);
                },
                'counsellors' => function ($query) {
                    $query->withCount([
                        'inquiries as inquiries_count',
                        'inquiries as hot_leads' => fn($q) => $q->where('inquiry_status', 'hot'),
                        'inquiries as cold_leads' => fn($q) => $q->where('inquiry_status', 'cold'),
                        'inquiries as dead_leads' => fn($q) => $q->where('inquiry_status', 'dead'),
                        'inquiries as pending_leads' => fn($q) => $q->where('inquiry_status', 'pending'),
                    ]);
                }
            ])->get();
    }

    public function render()
    {
        return view('livewire.manager.report.team-report', [
            'teams' => $this->teams,
        ])->layout('layouts.managerdashboard');
    }
}
