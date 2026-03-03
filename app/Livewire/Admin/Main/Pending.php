<?php

namespace App\Livewire\Admin\Main;

use Livewire\Component;
use App\Models\Inquiiry;
use Livewire\WithPagination;

class Pending extends Component
{
    use WithPagination;

    public $search = '';

    public function searchInquiries()
    {
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

    public function render()
    {
        // Box counts
        $totalLeads = Inquiiry::where('status', 'assigned')->count();
        $hotLeads = Inquiiry::where('inquiry_status', 'hot')->where('status', 'assigned')->count();
        $coldLeads = Inquiiry::where('inquiry_status', 'cold')->where('status', 'assigned')->count();
        $deadLeads = Inquiiry::where('inquiry_status', 'dead')->where('status', 'assigned')->count();
        $pendingLeads = Inquiiry::where(function ($q) {
            $q->where('inquiry_status', 'pending')->orWhereNull('inquiry_status');
        })->where('status', 'assigned')->count();

        // Main table data
        $inquiries = Inquiiry::with('assignedUser')
            ->where(function ($q) {
                $q->where('inquiry_status', 'pending')->orWhereNull('inquiry_status');
            })
            ->where('status', 'assigned')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
        ->orderBy('updated_at', 'DESC') // CHANGED FROM latest() to orderBy('updated_at', 'DESC')
            ->paginate(50);
        return view('livewire.admin.main.pending', compact(
            'inquiries',
            'totalLeads',
            'hotLeads',
            'coldLeads',
            'deadLeads',
            'pendingLeads'
        ))->layout('layouts.admindashboard');
    }
}
