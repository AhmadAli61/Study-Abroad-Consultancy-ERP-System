<?php

namespace App\Livewire\Hr\StaffDetails;

use Livewire\Component;
use App\Models\StaffDetail;
use Livewire\WithPagination;

class AllStaff extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'roleFilter' => ['except' => ''],
        'perPage' => ['except' => 10]
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function getStaffQueryProperty()
    {
        return StaffDetail::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('full_name', 'like', '%' . $this->search . '%')
                      ->orWhere('cnic_number', 'like', '%' . $this->search . '%')
                      ->orWhere('personal_contact_number', 'like', '%' . $this->search . '%')
                      ->orWhere('role', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->roleFilter, function ($query) {
                $query->where('role', $this->roleFilter);
            })
            ->latest();
    }

    public function getStaffProperty()
    {
        return $this->staffQuery->paginate($this->perPage);
    }

    public function getRolesProperty()
    {
        return StaffDetail::distinct()->pluck('role')->filter();
    }

    public function getTotalStaffProperty()
    {
        return $this->staffQuery->count();
    }

    public function render()
    {
        return view('livewire.hr.staff-details.all-staff', [
            'staff' => $this->staff,
            'roles' => $this->roles,
            'totalStaff' => $this->totalStaff,
        ])->layout('layouts.hrdashboard');
    }
}