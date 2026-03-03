<?php

namespace App\Livewire\Admission\AdmissionTeam;

use Livewire\Component;

class SearchFilter extends Component
{
    public $search = '';
    public $statusFilter = 'all';
    public $partnerFilter = '';
    public $assignedToFilter = '';
    public $counsellorFilter = '';
    public $startDate = '';
    public $endDate = '';
    
    // For dynamic options
    public $partners = [];
    public $teamMembers = [];
    public $counsellors = [];
    
    // Property to store the filtered count
    public $filteredCount = 0;

    public function mount()
    {
        $this->loadFilterOptions();
        
        // UPDATED: Initialize with total count (excluding rejected, withdrawn, caseclosed)
        $totalCount = \App\Models\RegisteredInquiry::where('status', '!=', 'unassigned')
            ->where('inquiry_status', '!=', 'rejection')
            ->where('inquiry_status', '!=', 'withdrawn')
            ->where('inquiry_status', '!=', 'caseclosed')
            ->whereNull('intake_id')
            ->count();
        
        $this->filteredCount = $totalCount;
    }

    protected function loadFilterOptions()
    {
        // Load partners from ALL registered inquiries
        $this->partners = \App\Models\RegisteredInquiry::distinct()
            ->whereNotNull('partner')
            ->where('partner', '!=', '')
            ->pluck('partner')
            ->toArray();

        // Load team members (admission team users)
        $this->teamMembers = \App\Models\User::whereIn('role', ['admission', 'admissionagent'])
            ->pluck('username', 'id')
            ->toArray();

        // Load counsellors from ALL applications
        $counsellorIds = \App\Models\RegisteredInquiry::distinct()
            ->whereNotNull('users_id')
            ->pluck('users_id')
            ->toArray();

        if (!empty($counsellorIds)) {
            $this->counsellors = \App\Models\User::whereIn('id', $counsellorIds)
                ->pluck('username', 'id')
                ->toArray();
        } else {
            $this->counsellors = [];
        }
    }

    // Get filtered count from parent
    public function updateFilteredCount($count)
    {
        $this->filteredCount = $count;
    }

    public function hasActiveFilters()
    {
        return $this->search !== '' || 
               $this->statusFilter !== 'all' || 
               $this->startDate !== '' || 
               $this->endDate !== '' || 
               $this->partnerFilter !== '' || 
               $this->assignedToFilter !== '' ||
               $this->counsellorFilter !== '';
    }

    // ADD THIS: Automatically apply when filters change
    public function updated($property)
    {
        // Apply filters when any filter property changes
        if (in_array($property, ['search', 'statusFilter', 'startDate', 'endDate', 'partnerFilter', 'assignedToFilter', 'counsellorFilter'])) {
            $this->applyFilters();
        }
    }

    public function applyFilters()
    {
        // Combine dates into range string for compatibility
        $dateRange = '';
        if ($this->startDate && $this->endDate) {
            $dateRange = $this->startDate . ' to ' . $this->endDate;
        } elseif ($this->startDate) {
            $dateRange = $this->startDate;
        }
        
        $filters = [
            'search' => $this->search,
            'status' => $this->statusFilter,
            'dateRange' => $dateRange,
            'partner' => $this->partnerFilter,
            'assignedTo' => $this->assignedToFilter,
            'counsellor' => $this->counsellorFilter,
        ];

        $this->dispatch('filtersApplied', filters: $filters);
    }

    protected $listeners = ['updateFilteredCount' => 'updateFilteredCount'];

    public function resetFilters()
    {
        $this->search = '';
        $this->statusFilter = 'all';
        $this->startDate = '';
        $this->endDate = '';
        $this->partnerFilter = '';
        $this->assignedToFilter = '';
        $this->counsellorFilter = '';
        
        $this->applyFilters();
    }

    public function render()
    {
        return view('livewire.admission.admission-team.search-filter');
    }
}