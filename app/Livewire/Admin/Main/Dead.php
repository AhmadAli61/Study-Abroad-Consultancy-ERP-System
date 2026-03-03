<?php

namespace App\Livewire\Admin\Main;

use Livewire\Component;
use App\Models\Inquiiry;
use Livewire\WithPagination;

class Dead extends Component
{
    public $search = '';
    use WithPagination;

    public function searchInquiries()
    {
        $this->resetPage();
    }

    public function render()
    {
        $totalLeads = Inquiiry::where('status', 'assigned')->count();
        $hotLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'hot')->count();
        $coldLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'cold')->count();
        $deadLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'dead')->count();
        $pendingLeads = Inquiiry::where('status', 'assigned')->where('inquiry_status', 'pending')->count();
    
        $inquiries = Inquiiry::with('assignedUser')
            ->where('inquiry_status', 'dead')
            ->where('status','assigned')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
        ->orderBy('updated_at', 'DESC') // CHANGED FROM latest() to orderBy('updated_at', 'DESC')
            ->paginate(50);
    
        return view('livewire.admin.main.dead', compact(
            'inquiries', 'totalLeads', 'hotLeads', 'coldLeads', 'deadLeads', 'pendingLeads'
        ))->layout('layouts.admindashboard');
    }
}
