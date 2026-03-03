<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\TeamAdmission;
use App\Models\User;

class AdmissionTeams extends Component
{
    // Public properties
    public $teams, $teamName, $managerId, $teamId, $agents = [];
    public $editingTeamId, $editingTeamName, $editingManagerId, $editingAgents = [];
    public $confirmingDeleteId = null;
    public $showEditModal = false;
    public $showDeleteModal = false;

    /**
     * Initialize component with team data
     */
    public function mount()
    {
        $this->teams = TeamAdmission::with('manager', 'agents')->get();
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
        $this->teams = TeamAdmission::with('manager', 'agents')->get();
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

        TeamAdmission::create([
            'name' => $this->teamName,
            'manager_id' => $this->managerId,
        ]);

        session()->flash('message', 'Admission team created successfully.');
        $this->reset(['teamName', 'managerId']);
        $this->mount();
    }

    public function closeEditModal()
    {
        $this->reset(['editingTeamId', 'editingTeamName', 'editingManagerId', 'editingAgents']);
        $this->showEditModal = false;
    }

    /**
     * Open edit modal with team data
     */
    public function openEditModal($teamId)
    {
        $team = TeamAdmission::with('agents')->findOrFail($teamId);
        $this->editingTeamId = $team->id;
        $this->editingTeamName = $team->name;
        $this->editingManagerId = $team->manager_id;
        $this->editingAgents = $team->agents->pluck('id')->toArray();
        $this->showEditModal = true;
    }

    /**
     * Update team information
     */
    public function updateTeam()
    {
        $this->validate([
            'editingTeamName' => 'required|string|max:255',
            'editingManagerId' => 'required|exists:users,id',
        ]);

        $team = TeamAdmission::findOrFail($this->editingTeamId);
        $team->update([
            'name' => $this->editingTeamName,
            'manager_id' => $this->editingManagerId,
        ]);

        $team->agents()->sync($this->editingAgents);

        session()->flash('message', 'Admission team updated successfully.');
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
        $team = TeamAdmission::findOrFail($this->confirmingDeleteId);
        $team->delete();

        session()->flash('message', 'Admission team deleted successfully.');
        $this->refreshTeams();
        $this->closeDeleteModal();
    }

    /**
     * Assign agents to a team
     */
    public function assignAgents()
    {
        $this->validate([
            'teamId' => 'required|exists:team_admissions,id',
            'agents' => 'required|array|min:1',
        ]);

        $team = TeamAdmission::find($this->teamId);

        // Filter agents who are already in a team
        $validAgents = User::whereIn('id', $this->agents)
            ->whereDoesntHave('admissionTeams')
            ->pluck('id')
            ->toArray();

        // Only sync those agents who are unassigned
        if (!empty($validAgents)) {
            $team->agents()->attach($validAgents);
            session()->flash('message', 'Agents assigned successfully.');
        } else {
            session()->flash('error', 'Selected agents are already assigned to a team.');
        }

        $this->reset(['agents', 'teamId']);
        $this->mount(); // Refresh data
    }

    /**
     * Render the component view
     */
    public function render()
    {
        return view('livewire.admin.admission-teams', [
            'managers' => User::where('role', 'admission')->get(),
            'agentsList' => User::where('role', 'admissionagent')
                ->whereDoesntHave('admissionTeams') // this filters out agents already in any team
                ->get()
        ])->layout('layouts.admindashboard');
    }
}