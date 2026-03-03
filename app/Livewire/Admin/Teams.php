<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Team;
use App\Models\User;

class Teams extends Component
{
    // Public properties
    public $teams, $teamName, $managerId, $teamId, $counsellors = [];
    public $editingTeamId, $editingTeamName, $editingManagerId, $editingCounsellors = [];
    public $confirmingDeleteId = null;
    public $showEditModal = false;
    public $showDeleteModal = false;

    /**
     * Initialize component with team data
     */
    public function mount()
    {
        $this->teams = Team::with('manager', 'counsellors')->get();
    }

    public function closeDeleteModal()
    {
        $this->reset(['confirmingDeleteId']);
        $this->showDeleteModal = false;
    }

    /**
     * Refresh team data
     */
    public function refreshTeams()
    {
        $this->teams = Team::with('manager', 'counsellors')->get();
    }

    /**
     * Create a new team
     */
    public function createTeam()
    {
        $this->validate([
            'teamName' => 'required|string|max:255',
            'managerId' => 'required|exists:users,id',
        ]);

        Team::create([
            'name' => $this->teamName,
            'manager_id' => $this->managerId,
        ]);

        session()->flash('message', 'Team created successfully.');
        $this->reset(['teamName', 'managerId']);
        $this->mount();
    }

    public function closeEditModal()
    {
        $this->reset(['editingTeamId', 'editingTeamName', 'editingManagerId', 'editingCounsellors']);
        $this->showEditModal = false;
    }

    /**
     * Open edit modal with team data
     */
    public function openEditModal($teamId)
    {
        $team = Team::with('counsellors')->findOrFail($teamId);
        $this->editingTeamId = $team->id;
        $this->editingTeamName = $team->name;
        $this->editingManagerId = $team->manager_id;
        $this->editingCounsellors = $team->counsellors->pluck('id')->toArray();
        $this->showEditModal = true;
    }

    /**
     * Update team information - FIXED VERSION
     */
    public function updateTeam()
    {
        $this->validate([
            'editingTeamName' => 'required|string|max:255',
            'editingManagerId' => 'required|exists:users,id',
        ]);

        $team = Team::findOrFail($this->editingTeamId);
        
        // Update team basic info
        $team->update([
            'name' => $this->editingTeamName,
            'manager_id' => $this->editingManagerId,
        ]);

        // Get currently assigned counsellors
        $currentCounsellors = $team->counsellors->pluck('id')->toArray();
        
        // Find counsellors to remove (were in team but not in new selection)
        $counsellorsToRemove = array_diff($currentCounsellors, $this->editingCounsellors);
        
        // Find counsellors to add (are in new selection but not currently in team)
        $counsellorsToAdd = array_diff($this->editingCounsellors, $currentCounsellors);

        // Remove counsellors that were deselected
        if (!empty($counsellorsToRemove)) {
            $team->counsellors()->detach($counsellorsToRemove);
        }

        // Add new counsellors (only those not already in any team)
        if (!empty($counsellorsToAdd)) {
            $validNewCounsellors = User::whereIn('id', $counsellorsToAdd)
                ->whereDoesntHave('teams')
                ->pluck('id')
                ->toArray();
                
            if (!empty($validNewCounsellors)) {
                $team->counsellors()->attach($validNewCounsellors);
            }
        }

        session()->flash('message', 'Team updated successfully.');
        $this->refreshTeams();
        $this->closeEditModal();
    }

    /**
     * Confirm team deletion
     */
    public function confirmDelete($teamId)
    {
        $this->confirmingDeleteId = $teamId;
        $this->showDeleteModal = true;
    }

    /**
     * Delete a team
     */
    public function deleteTeam()
    {
        $team = Team::findOrFail($this->confirmingDeleteId);
        $team->delete();

        session()->flash('message', 'Team deleted successfully.');
        $this->refreshTeams();
        $this->closeDeleteModal();
    }

    /**
     * Assign counsellors to a team
     */
    public function assignCounsellors()
    {
        $this->validate([
            'teamId' => 'required|exists:teams,id',
            'counsellors' => 'required|array|min:1',
        ]);

        $team = Team::find($this->teamId);

        // Filter counsellors who are already in a team
        $validCounsellors = User::whereIn('id', $this->counsellors)
            ->whereDoesntHave('teams')
            ->pluck('id')
            ->toArray();

        // Only sync those counsellors who are unassigned
        if (!empty($validCounsellors)) {
            $team->counsellors()->attach($validCounsellors);
            session()->flash('message', 'Counsellors assigned successfully.');
        } else {
            session()->flash('error', 'Selected counsellors are already assigned to a team.');
        }

        $this->reset(['counsellors', 'teamId']);
        $this->mount();
    }

    /**
     * Render the component view
     */
    public function render()
    {
        return view('livewire.admin.teams', [
            'managers' => User::where('role', 'manager')->get(),
            'counsellorsList' => User::where('role', 'counsellor')
                ->whereDoesntHave('teams')
                ->get()
        ])->layout('layouts.admindashboard');
    }
}