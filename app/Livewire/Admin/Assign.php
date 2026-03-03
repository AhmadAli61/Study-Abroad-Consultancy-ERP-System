<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Inquiiry;
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
    return Inquiiry::where('status', 'unassigned')
        ->whereNull('previous_assigned_to')
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('phone_number', 'like', '%' . $this->search . '%');
            });
        })
        ->latest()
        ->paginate(50);
}

    
public function getUsersProperty()
{
    return User::where('status', 1) // Only include users with status = 1
        ->whereIn('role', ['counsellor', 'manager']) // Include only counsellors and managers
        ->select('id', 'username' ,'role') // Select only 'id' and 'username' columns
        ->get();
}


    public function assignInquiry($inquiryId)
    {
        if (empty($this->selectedUser[$inquiryId])) {
            session()->flash('error', 'Please select a user before assigning.');
            return;
        }
    
        $inquiry = Inquiiry::find($inquiryId);
        if (!$inquiry) {
            session()->flash('error', 'Inquiry not found.');
            return;
        }
    
        $userId = $this->selectedUser[$inquiryId];
    
        $inquiry->update([
            'assigned_to' => $userId,
            'previous_assigned_to' => $userId, // ✅ this ensures first time is stored too
            'assigned_at' => now(),
            'status_updated_at' => now(),
            'status' => 'assigned'
        ]);
    
        unset($this->selectedUser[$inquiryId]);
        session()->flash('message', 'Inquiry assigned successfully.');
        return redirect()->route('admin.assign'); // Use the named route
    }
    
    
    public function assignSelectedInquiries()
    {
        if (!$this->bulkAssignUserId) {
            session()->flash('error', 'Please select a user from dropdown for bulk assign.');
            return;
        }
    
        foreach ($this->selectedInquiries as $inquiryId) {
            $inquiry = Inquiiry::find($inquiryId);
            if ($inquiry) {
                $inquiry->update([
                    'assigned_to' => $this->bulkAssignUserId,
                    'previous_assigned_to' => $this->bulkAssignUserId,
                    'assigned_at' => now(),
                    'status_updated_at' => now(),
                    'status' => 'assigned'
                ]);
            }
        }
    
        $this->selectedInquiries = [];
        $this->bulkAssignUserId = null;
        $this->resetPage();
        session()->flash('message', 'Selected inquiries assigned successfully.');
        return redirect()->route('admin.assign'); // Use the named route

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

    return view('livewire.admin.assign', [
        'inquiries' => $inquiries,
        'users' => $this->users
    ])->layout('layouts.admindashboard');
}
}
