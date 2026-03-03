<?php

namespace App\Livewire\Manager\Report;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class AllReports extends Component
{
    use WithPagination;

    public $reportId;
    public $searchDate;

    public function mount()
    {
        $this->reportId = request()->get('reportId');
    }

    public function searchReports()
    {
        $this->resetPage(); // Reset to first page when searching
    }

    public function render()
    {
        $query = Report::where('user_id', Auth::id());

        if (!empty($this->searchDate)) {
            // Format the date to match your database format (assuming YYYY-MM-DD)
            $formattedDate = $this->searchDate;
            $query->where('date', $formattedDate);
        }

        $reports = $query->orderBy('date', 'desc')->paginate(25);

        return view('livewire.manager.report.all-reports', [
            'reports' => $reports,
        ])->with('reportId', $this->reportId)
        ->layout('layouts.managerdashboard');
    }
}