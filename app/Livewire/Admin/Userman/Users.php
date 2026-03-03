<?php

namespace App\Livewire\Admin\Userman;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    public $activeTab = 'systemUsers'; // Default tab

    // Public properties
    public $username, $password, $role, $parent_id, $user_type = 'primary', $email;
    public $userId;
    public $users;
    public $confirmingUserId = null; // Store user ID for confirmation
    public $primaryAgents = []; // For dropdown of primary agents

    // Validation rules - ADD 'viewer' TO THE ROLES
       protected $rules = [
        'username' => 'required|unique:users,username',
        'password' => 'required|min:6',
                'email' => 'nullable|email|unique:users,email', // Add email validation

        'role' => 'required|in:admin,manager,counsellor,admission,admissionagent,externalagent,viewer',
        'user_type' => 'sometimes|in:primary,assistant', // Changed to 'sometimes'
    'parent_id' => 'nullable|required_if:user_type,assistant|exists:users,id', // Added 'nullable'
    ];
    /**
 * Handle user type changes - using a public method instead of updated hook
 */
/**
 * Update role field based on user type selection
 */
private function updateRoleBasedOnUserType()
{
    if ($this->user_type === 'assistant') {
        $this->role = 'admissionagent';
    }
}
public function changeUserType($value)
{
    $this->user_type = $value;
    $this->updateRoleBasedOnUserType();
}

    // Event listeners
    protected $listeners = [
        'user-added' => 'refreshUsers', 
        'user-updated' => 'refreshUsers'
    ];

    /**
     * Initialize component with user data
     */
   public function mount()
{
    $this->users = User::all()->toArray();
    $this->activeTab = request()->get('tab', 'systemUsers');
    $this->loadPrimaryAgents();
    
    // Set default role based on user type
    $this->updateRoleBasedOnUserType(); // ADD THIS LINE
}
      // Load primary agents for assistant dropdown
    public function loadPrimaryAgents()
    {
        $this->primaryAgents = User::where('role', 'admissionagent')
            ->where('user_type', 'primary')
            ->where('status', 1)
            ->get();
    }
    public function updatedUserType($value)
    {
        if ($value === 'primary') {
            $this->parent_id = null;
        }
    }

    /**
     * Create a new user
     */
 public function saveUser()
    {
        $this->validate();

        $userData = [
            'username' => $this->username,
            'password' => $this->password,
                        'email' => $this->email, // Add email

            'role' => $this->role,
        'user_type' => $this->user_type ?? 'primary', // Default to 'primary'
        ];

        // Only add parent_id for assistants
       if ($this->user_type === 'assistant' && $this->parent_id) {
        $userData['parent_id'] = $this->parent_id;
    }

        User::create($userData);

        $this->reset(['username', 'password', 'email', 'role', 'parent_id', 'user_type']);
        session()->flash('message', 'User added successfully.');
        $this->dispatch('user-added');
        $this->loadPrimaryAgents(); // Reload primary agents
    }

    /**
     * Confirm user status toggle
     */
    public function confirmToggle($userId)
    {
        $this->confirmingUserId = $userId;
        $this->dispatch('show-confirmation-modal');
    }

    /**
     * Apply status toggle to user
     */
    public function applyToggleStatus()
    {
        $user = User::find($this->confirmingUserId);
        if (!$user) return;

        $user->status = !$user->status;
        $user->save();

        // Update users array
        $this->users = User::all()->toArray();

        // Dispatch event to update the UI
        $this->dispatch('status-updated', [
            'userId' => $this->confirmingUserId, 
            'status' => $user->status
        ]);

        session()->flash('message', 'User status updated successfully!');
        $this->confirmingUserId = null;

        return redirect()->route('admin.users');
    }

    /**
     * Load user data for editing
     */
 public function editUser($id)
{
    $user = User::find($id);
    if (!$user) return;

    $this->userId = $user->id;
    $this->username = $user->username;
            $this->email = $user->email; // Add email

    $this->role = $user->role;
    $this->user_type = $user->user_type ?? 'primary';
    $this->parent_id = $user->parent_id;
    $this->password = ''; // Don't pre-fill password for security

    session()->put('lastActiveTab', $this->activeTab);
    
    // Update role based on user type for edit modal - ADD THIS
    $this->updateRoleBasedOnUserType();
}


    /**
     * Update user information - UPDATE VALIDATION TO INCLUDE 'viewer'
     */
   public function updateUser()
    {
        $this->validate([
            'username' => 'required|unique:users,username,' . $this->userId,
            'role' => 'required|in:admin,manager,counsellor,admission,admissionagent,externalagent,viewer',
                        'email' => 'nullable|email|unique:users,email,' . $this->userId, // Add email validation

            'user_type' => 'sometimes|in:primary,assistant', // Changed to 'sometimes'
        'parent_id' => 'nullable|required_if:user_type,assistant|exists:users,id', // Added 'nullable'
        ]);

        $user = User::find($this->userId);
        if (!$user) return;

        $user->username = $this->username;
        $user->role = $this->role;
                $user->email = $this->email; // Add email

        $user->user_type = $this->user_type;
        
        if ($this->user_type === 'assistant') {
            $user->parent_id = $this->parent_id;
        } else {
            $user->parent_id = null;
        }
        
        if ($this->password) {
            $user->password = $this->password;
        }

        $user->save();

        $this->activeTab = session()->get('lastActiveTab', 'systemUsers');
        session()->flash('message', 'User updated successfully.');
        $this->reset(['userId', 'username', 'password', 'email', 'role', 'parent_id', 'user_type']);
        $this->dispatch('user-updated');
        $this->dispatch('close-edit-modal');
        $this->loadPrimaryAgents();

        return redirect()->route('admin.users', ['tab' => $this->activeTab]);
    }

    /**
     * Refresh users list
     */
    public function refreshUsers()
    {
        $this->users = User::all()->toArray();
    }

    /**
     * Render the component view
     */
      public function render()
    {
        return view('livewire.admin.userman.users', [
            'users' => User::all(),
            'primaryAgents' => $this->primaryAgents,
        ])->layout('layouts.admindashboard');
    }
}