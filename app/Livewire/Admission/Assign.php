<?php

namespace App\Livewire\Admission;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use App\Models\User;
use Livewire\WithPagination;

class Assign extends Component
{
    use WithPagination;
    public $search = '';

    public $selectedUser = [];
    public $bulkAssignUserId = null;
    public $selectedInquiries = [];
    public $selectAll = false;

    public function getInquiriesProperty()
    {
        return RegisteredInquiry::where('status', 'unassigned')
            ->whereNull('previous_assigned_to')
            ->with([
                'user', 
                'assignedUser',
                'parentInquiry.assignedUser' // Eager load parent relationship with assigned user
            ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('student_name', 'like', '%' . $this->search . '%')
                      ->orWhere('student_contact', 'like', '%' . $this->search . '%')
                      ->orWhere('passport_number', 'like', '%' . $this->search . '%')
                      ->orWhere('course_name', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(50);
    }

    public function getUsersProperty()
    {
        return User::where('status', 1)
            ->whereIn('role', ['admission', 'admissionagent'])
            ->select('id', 'username', 'role')
            ->get();
    }

    public function assignInquiry($inquiryId)
    {
        if (empty($this->selectedUser[$inquiryId])) {
            session()->flash('error', 'Please select a user before assigning.');
            return;
        }
    
        $inquiry = RegisteredInquiry::find($inquiryId);
        if (!$inquiry) {
            session()->flash('error', 'Inquiry not found.');
            return;
        }
    
        $userId = $this->selectedUser[$inquiryId];
    
        $inquiry->update([
            'assigned_to' => $userId,
            'previous_assigned_to' => $userId,
            'assigned_at' => now(),
            'status_updated_at' => now(),
            'status' => 'assigned',
            'inquiry_status' => 'underassessment'
        ]);
    
        unset($this->selectedUser[$inquiryId]);
        session()->flash('message', 'Inquiry assigned successfully.');
        return redirect()->route('admission.assign-application');
    }
    
    public function assignSelectedInquiries()
    {
        if (!$this->bulkAssignUserId) {
            session()->flash('error', 'Please select a user from dropdown for bulk assign.');
            return;
        }
    
        foreach ($this->selectedInquiries as $inquiryId) {
            $inquiry = RegisteredInquiry::find($inquiryId);
            if ($inquiry) {
                $inquiry->update([
                    'assigned_to' => $this->bulkAssignUserId,
                    'previous_assigned_to' => $this->bulkAssignUserId,
                    'assigned_at' => now(),
                    'status_updated_at' => now(),
                    'status' => 'assigned',
                    'inquiry_status' => 'underassessment'
                ]);
            }
        }
    
        $this->selectedInquiries = [];
        $this->bulkAssignUserId = null;
        $this->resetPage();
        session()->flash('message', 'Selected inquiries assigned successfully.');
        return redirect()->route('admission.assign-application');
    }

    public function toggleAll()
    {
        if ($this->selectAll) {
            $this->selectedInquiries = [];
            $this->selectAll = false;
        } else {
            $this->selectedInquiries = $this->getInquiriesProperty()->pluck('id')->toArray();
            $this->selectAll = true;
        }
    }

    public function searches()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $inquiries = $this->getInquiriesProperty();

        return view('livewire.admission.assign', [
            'inquiries' => $inquiries,
            'users' => $this->users
        ])->layout('layouts.admissiondashboard');
    }
}