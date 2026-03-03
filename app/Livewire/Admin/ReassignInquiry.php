<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inquiiry;
use App\Models\User;

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
        return User::where('status', 1) // Only include users with status = 1
            ->whereIn('role', ['counsellor', 'manager']) // Include only counsellors and managers
            ->select('id', 'username' ,'role')
            ->get();
    }
    

    public function searchInquiries()
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

        if (!$userId) {
            session()->flash('error', 'Please select a user before reassigning.');
            return;
        }

        $inquiry = Inquiiry::find($inquiryId);
        if (!$inquiry) {
            session()->flash('error', 'Inquiry not found.');
            return;
        }

        $inquiry->update([
            'previous_assigned_to' => $inquiry->assigned_to,
            'assigned_to' => $userId,
            'assigned_at' => now(),
            'status_updated_at' => now(),
            'status' => 'assigned',
        ]);

        unset($this->selectedUser[$inquiryId]);
        session()->flash('message', 'Inquiry reassigned successfully.');
        return redirect()->route('admin.reassign'); // Use the named route
    }

    public function reassignSelectedInquiries()
    {
        if (!$this->bulkAssignUserId) {
            session()->flash('error', 'Please select a user for bulk reassignment.');
            return;
        }

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

        session()->flash('message', 'Selected inquiries reassigned successfully.');
        return redirect()->route('admin.reassign'); // Use the named route

    }

    public function getInquiriesProperty()
    {
        return Inquiiry::with('previousAssignedUser')
            ->where('status', 'unassigned')
            ->whereNotNull('previous_assigned_to')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
->orderBy('updated_at', 'desc')
            ->paginate(50);
    }

    public function render()
    {
        return view('livewire.admin.reassign-inquiry', [
            'inquiries' => $this->inquiries,
            'users' => $this->users,
        ])->layout('layouts.admindashboard');
    }

    public function updatingPage()
    {
        $this->reset(['selectedInquiries', 'selectAll']);
    }

    public function updatedSelectedInquiries()
    {
        if (count($this->selectedInquiries) < $this->inquiries->count()) {
            $this->selectAll = false;
        }
    }
}
