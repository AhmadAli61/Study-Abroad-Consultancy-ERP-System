<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;

    public $search = '';
    public $permissionLevels = [];
    public $isViewOnly = false; // ADD THIS

    public function mount()
    {
        $this->isViewOnly = auth()->user()->permission_level === 'view_only'; // ADD THIS
        $this->loadPermissions();
    }

    protected function loadPermissions()
    {
        $adminUsers = User::where('role', 'admin')->get();
        
        foreach ($adminUsers as $user) {
            if (isset($user->permission_level)) {
                $this->permissionLevels[$user->id] = $user->permission_level;
            } else {
                $this->permissionLevels[$user->id] = 'full_access';
                
                if (\Schema::hasColumn('users', 'permission_level')) {
                    $user->update(['permission_level' => 'full_access']);
                }
            }
        }
    }

    public function updatePermission($userId)
    {
        // ADD VIEW-ONLY CHECK
        if ($this->isViewOnly) {
            $this->dispatch('show-error', message: 'View-only admins cannot update permissions');
            return;
        }

        $user = User::findOrFail($userId);
        
        if (!\Schema::hasColumn('users', 'permission_level')) {
            session()->flash('error', 'Permission level column does not exist in database. Please run migrations.');
            return;
        }
        
        if ($user->role === 'admin') {
            $newPermission = $this->permissionLevels[$userId] ?? 'full_access';
            
            $user->update([
                'permission_level' => $newPermission
            ]);
            
            session()->flash('message', "Permission updated successfully for {$user->username}");
        }
    }

    public function render()
    {
        $users = User::where('role', 'admin')
            ->when($this->search, function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%');
            })
            ->orderBy('username')
            ->paginate(10);

        return view('livewire.admin.roles', compact('users'))
            ->layout('layouts.admindashboard');
    }
}