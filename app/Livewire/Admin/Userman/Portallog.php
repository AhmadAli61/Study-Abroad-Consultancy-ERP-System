<?php

namespace App\Livewire\Admin\Userman;

use Livewire\Component;
use Livewire\WithPagination;   // ✅ Import pagination
use App\Models\PortalLog as PortalsLog;
use Illuminate\Support\Facades\Session;

class Portallog extends Component
{
    use WithPagination;   // ✅ Enable pagination

    protected $paginationTheme = 'bootstrap'; // or 'tailwind' depending on your CSS framework

    public function render()
    {
        $logs = PortalsLog::with('user')->latest()->paginate(50); // ✅ paginate instead of get
        return view('livewire.admin.userman.portallog', compact('logs'))
            ->layout('layouts.admindashboard');
    }
}
