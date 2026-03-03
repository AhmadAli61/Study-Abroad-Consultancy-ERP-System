<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inquiiry;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;

class ReassignInquiry extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedUser = [];
    public $bulkAssignUserId = null;
    public $selectedInquiries = [];
    public $selectAll = false;

    public function getUsersProperty()
{
    $managerId = Auth::id();
    $manager = Auth::user();

    // Get the manager's team with counselors
    $team = Team::where('manager_id', $managerId)->with('counsellors')->first();

    if (!$team) {
        return collect([$manager]); // No team found, return manager only
    }

    $counsellors = $team->counsellors()
        ->where('status', 1)
        ->where('role', 'counsellor')
        ->select('users.id', 'users.username')
        ->get();

    return $counsellors->push((object)[
        'id' => $manager->id,
        'username' => $manager->username . ' (You)'
    ]);
}

    

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function toggleAll()
    {
        if ($this->selectAll) {
            $this->selectedInquiries = [];
            $this->selectAll = false;
        } else {
            $this->selectedInquiries = $this->inquiries->pluck('id')->toArray();
            $this->selectAll = true;
        }
    }
    public function reassignInquiry($inquiryId)
    {
        $userId = $this->selectedUser[$inquiryId] ?? null;
        if (!$userId) return;

        $inquiry = Inquiiry::find($inquiryId);
        if (!$inquiry) return;

        $inquiry->update([
            'previous_assigned_to' => $inquiry->assigned_to,
            'assigned_to' => $userId,
            'assigned_at' => now(),
            'status_updated_at' => now(),
            'status' => 'assigned',
        ]);

        unset($this->selectedUser[$inquiryId]);
    }

    public function reassignSelectedInquiries()
    {
        if (!$this->bulkAssignUserId) return;

        foreach ($this->selectedInquiries as $inquiryId) {
            $inquiry = Inquiiry::find($inquiryId);
            if ($inquiry) {
                $inquiry->update([
                    'previous_assigned_to' => $inquiry->assigned_to,
                    'assigned_to' => $this->bulkAssignUserId,
                    'assigned_at' => now(),
                    'status_updated_at' => now(),
                    'status' => 'assigned',
                ]);
            }
        }

        $this->selectedInquiries = [];
        $this->bulkAssignUserId = null;
        $this->selectAll = false;
    }

    public function getInquiriesProperty()
    {
        $managerId = Auth::id();
        $team = Team::where('manager_id', $managerId)->with('counsellors')->first();


        if ($team) {
            $teamMemberIds = $team->counsellors->pluck('id');
        return Inquiiry::with('previousAssignedUser')
            ->where('status', 'unassigned')
            ->where(function ($query) use ($managerId, $teamMemberIds) {
                $query->where('previous_assigned_to', $managerId)
                      ->orWhereIn('previous_assigned_to', $teamMemberIds);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(50);
    }
    return Inquiiry::whereRaw('1 = 0')->paginate(50);

    }

    public function render()
    {
        return view('livewire.manager.reassign-inquiry', [
            'inquiries' => $this->inquiries,
            'users' => $this->users,
        ])->layout('layouts.managerdashboard');
    }
}
