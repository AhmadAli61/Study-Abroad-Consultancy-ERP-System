<?php

namespace App\Livewire\Admin\Main;

use Livewire\Component;
use App\Models\Inquiiry;
use Livewire\WithPagination;

class Hot extends Component
{
    use WithPagination;

    public $search = '';
    public $totalLeads;
    public $hotLeads;
    public $coldLeads;
    public $deadLeads;
    public $pendingLeads;

    public function mount()
    {
        $this->totalLeads = Inquiiry::where('status', 'assigned')->count();
        $this->hotLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'hot')->count();
        $this->coldLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'cold')->count();
        $this->deadLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'dead')->count();
        $this->pendingLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'pending')->count();
    }

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
        $inquiries = Inquiiry::with('assignedUser')
            ->where('status', 'assigned')
            ->where('inquiry_status', 'hot')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
        ->orderBy('updated_at', 'DESC') // CHANGED FROM latest() to orderBy('updated_at', 'DESC')
            ->paginate(50);

        return view('livewire.admin.main.hot', [
            'inquiries' => $inquiries,
        ])->layout('layouts.admindashboard');
    }
}
