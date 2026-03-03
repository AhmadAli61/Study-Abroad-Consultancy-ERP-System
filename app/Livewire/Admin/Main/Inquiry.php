<?php

namespace App\Livewire\Admin\Main;

use Livewire\Component;
use App\Models\Inquiiry;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Inquiry extends Component
{
    public $assignedUser;
    public $statusFilter;
    public $typeFilter;
    public $dateRange;
    public $tempDateRange; // Temporary property for date range

    public $search = '';
    public $selectedInquiries = [];
    public $selectPage = false;

    public $totalLeads;
    public $hotLeads;
    public $coldLeads;
    public $deadLeads;
    public $pendingLeads;
    public $users = [];
    public $admins = [];

    use WithPagination;

    public function mount()
    {
        $this->getInquiryCounts();
        $this->users = User::whereIn('role', ['manager', 'counsellor'])->get();
        $this->admins = User::where('role', 'admin')->get();
        
        // Initialize tempDateRange with current dateRange value
        $this->tempDateRange = $this->dateRange;
    }
    
    public function searchData()
    {
        // Apply the temporary date range to the actual filter
        $this->dateRange = $this->tempDateRange;
        $this->resetPage();
    }
    
    public function resetFilters()
    {
        // Reset both the actual filter and temporary value
        $this->reset(['assignedUser', 'statusFilter', 'typeFilter', 'dateRange', 'tempDateRange']);
        $this->resetPage();
    }
    
    public function getDateStatus($inquiry)
    {
        $now = now();
        $sevenDaysAgo = $now->subDays(7);
        
        $status = [
            'updated_at_old' => false,
            'assigned_at_pending' => false
        ];
        
        // Check if updated_at is older than 7 days
        if ($inquiry->updated_at && $inquiry->updated_at->lt($sevenDaysAgo)) {
            $status['updated_at_old'] = true;
        }
        
        // Check if assigned_at exists and no response
        if ($inquiry->assigned_at && empty($inquiry->response)) {
            $status['assigned_at_pending'] = true;
        }
        
        return $status;
    }

    public function getInquiryCounts()
    {
        $this->totalLeads = Inquiiry::where('status', 'assigned')->count();
        $this->hotLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'hot')->count();
        $this->coldLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'cold')->count();
        $this->deadLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'dead')->count();
        $this->pendingLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'pending')->count();
    }

    public function unassignInquiry($inquiryId)
    {
        $inquiry = Inquiiry::find($inquiryId);

        if ($inquiry && $inquiry->assigned_to) {
            // Check if inquiry status is 'registered'
            if ($inquiry->inquiry_status === 'registered') {
                // For registered inquiries, keep the inquiry_status as 'registered'
                $inquiry->update([
                    'previous_assigned_to' => $inquiry->assigned_to,
                    'assigned_to' => null,
                    'assigned_at' => null,
                    'status' => 'unassigned',
                    // inquiry_status remains 'registered'
                    'status_updated_at' => now(),
                ]);
            } else {
                // For non-registered inquiries, use the existing logic
                $inquiry->update([
                    'previous_assigned_to' => $inquiry->assigned_to,
                    'assigned_to' => null,
                    'assigned_at' => null,
                    'status' => 'unassigned',
                    'inquiry_status' => 'pending',
                    'status_updated_at' => now(),
                ]);
            }
        }

        $this->getInquiryCounts(); // Refresh counts
    }

    public function unassignSelected()
    {
        $inquiries = Inquiiry::whereIn('id', $this->selectedInquiries)->get();
    
        foreach ($inquiries as $inquiry) {
            if ($inquiry->assigned_to) {
                // Check if inquiry status is 'registered'
                if ($inquiry->inquiry_status === 'registered') {
                    // For registered inquiries, keep the inquiry_status as 'registered'
                    $inquiry->update([
                        'previous_assigned_to' => $inquiry->assigned_to,
                        'assigned_to' => null,
                        'assigned_at' => null,
                        'status' => 'unassigned',
                        // inquiry_status remains 'registered'
                        'status_updated_at' => now(),
                    ]);
                } else {
                    // For non-registered inquiries, use the existing logic
                    $inquiry->update([
                        'previous_assigned_to' => $inquiry->assigned_to,
                        'assigned_to' => null,
                        'assigned_at' => null,
                        'status' => 'unassigned',
                        'inquiry_status' => 'pending',
                        'status_updated_at' => now(),
                    ]);
                }
            }
        }
    
        $this->selectedInquiries = [];
        $this->selectPage = false;
    
        // Dispatch to clear checkboxes from frontend
        $this->dispatch('clearCheckboxes');
    
        // Refresh the inquiry counts
        $this->getInquiryCounts();
    
        // Refresh the view with pagination and search reset
        $this->resetPage();
    
        session()->flash('message', 'Selected inquiries unassigned successfully.');
    }
    

    public function getCurrentPageInquiries()
    {
        $query = Inquiiry::with('assignedUser')
            ->where('status', 'assigned')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
            ->latest();

        // Use the same logic as render method
        if ($this->hasActiveFilters) {
            return $query->paginate(1000); // Large number for "all" results
        } else {
            return $query->paginate(100);
        }
    }

    public function toggleAll()
    {
        $this->selectPage = !$this->selectPage;

        if ($this->selectPage) {
            $inquiries = $this->getCurrentPageInquiries();
            $this->selectedInquiries = $inquiries->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedInquiries = [];
        }
    }

    public function toggleInquirySelection($inquiryId)
    {
        if (in_array($inquiryId, $this->selectedInquiries)) {
            $this->selectedInquiries = array_diff($this->selectedInquiries, [$inquiryId]);
        } else {
            $this->selectedInquiries[] = $inquiryId;
        }
    }

    public function getHasActiveFiltersProperty()
    {
        return $this->assignedUser || 
               ($this->statusFilter && $this->statusFilter !== 'all') || 
               $this->typeFilter || 
               $this->dateRange ||
               $this->search;
    }

    public function searchInquiries()
    {
        $this->resetPage();
        $this->selectedInquiries = [];
    }

    public function render()
    {
        $query = Inquiiry::with('assignedUser')
            ->where('status', 'assigned')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->assignedUser, function ($query) {
                $query->where('assigned_to', $this->assignedUser);
            })
            ->when($this->statusFilter && $this->statusFilter !== 'all', function ($query) {
                $query->where('inquiry_status', $this->statusFilter);
            })
            ->when($this->typeFilter, function ($query) {
                $query->where('type', $this->typeFilter);
            })
            ->when($this->dateRange, function ($query) {
                // Filter by CREATED_AT (inquiry creation date) - not assigned_at
                $dates = explode(' to ', $this->dateRange);
                
                if (count($dates) === 2) {
                    $start = trim($dates[0]);
                    $end = trim($dates[1]);
                    $query->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
                }
                elseif (count($dates) === 1) {
                    $singleDate = trim($dates[0]);
                    if ($singleDate) { 
                        $query->whereDate('created_at', $singleDate);
                    }
                }
            })
        ->orderBy('updated_at', 'DESC'); // CHANGED FROM latest() to orderBy('updated_at', 'DESC')

        // Always use pagination, but with a large number when filters are active
        if ($this->hasActiveFilters) {
            $inquiries = $query->paginate(1000);
        } else {
            $inquiries = $query->paginate(100);
        }

        $this->getInquiryCounts();

        return view('livewire.admin.main.inquiry', [
            'inquiries' => $inquiries,
            'totalLeads' => $this->totalLeads,
            'hotLeads' => $this->hotLeads,
            'coldLeads' => $this->coldLeads,
            'deadLeads' => $this->deadLeads,
            'pendingLeads' => $this->pendingLeads,
            'hasActiveFilters' => $this->hasActiveFilters,
        ])->layout('layouts.admindashboard');
    }
}