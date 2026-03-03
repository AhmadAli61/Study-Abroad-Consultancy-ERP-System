<?php

namespace App\Livewire\Admission;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RegisteredInquiry;
use App\Models\User;

class Reassign extends Component
{
       use WithPagination;

    public $search = '';
    public $selectedUser = [];
    public $bulkAssignUserId = null;
    public $selectedInquiries = [];
    public $selectAll = false;

    public function getUsersProperty()
    {
        return User::where('status', 1)
            ->whereIn('role', ['admission', 'admissionagent']) // Adjust roles as needed
            ->select('id', 'username', 'role')
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
            $this->selectedInquiries = $this->registeredInquiries->pluck('id')->toArray();
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

        $inquiry = RegisteredInquiry::find($inquiryId);
        if (!$inquiry) {
            session()->flash('error', 'Registered inquiry not found.');
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
        session()->flash('message', 'Registered inquiry reassigned successfully.');
        return redirect()->route('admission.reassign-application');
    }

    public function reassignSelectedInquiries()
    {
        if (!$this->bulkAssignUserId) {
            session()->flash('error', 'Please select a user for bulk reassignment.');
            return;
        }

        foreach ($this->selectedInquiries as $inquiryId) {
            $inquiry = RegisteredInquiry::find($inquiryId);
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

        session()->flash('message', 'Selected registered inquiries reassigned successfully.');
        return redirect()->route('admission.reassign-application');
    }

    public function getRegisteredInquiriesProperty()
    {
        return RegisteredInquiry::with(['previousAssignedUser', 'assignedUser'])
            ->where('status', 'unassigned')
            ->whereNotNull('previous_assigned_to')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('student_contact', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(50);
    }

    public function render()
    {
        return view('livewire.admission.reassign', [
            'registeredInquiries' => $this->registeredInquiries,
            'users' => $this->users,
        ])->layout('layouts.admissiondashboard');
    }

    public function updatingPage()
    {
        $this->reset(['selectedInquiries', 'selectAll']);
    }

    public function updatedSelectedInquiries()
    {
        if (count($this->selectedInquiries) < $this->registeredInquiries->count()) {
            $this->selectAll = false;
        }
    }
    }
