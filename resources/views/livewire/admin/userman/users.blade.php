<div>
    @if (session()->has('message'))
        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- User Creation Card -->
    <div class="card border-0 shadow-lg mt-2 mb-3">
    <!-- Header -->
    <div class="card-header bg-gradient-primary text-white py-4" style="border-radius: 12px 12px 0 0 !important;">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-2 text-white">
                    <i class="ti ti-user-plus me-2"></i> Add New User
                </h2>
                <p class="mb-0 opacity-75">
                    Create a new system user, assign role and type (Primary or Assistant)
                </p>
            </div>
            <div class="col-md-4 text-end">
                <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block">
                    <i class="ti ti-users fs-4 text-dark"></i>
                    <small class="opacity-75 text-dark ms-1">User Creation Panel</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="card-body p-4">
        <form wire:submit.prevent="saveUser">
            @csrf
            <style>
                .modern-input, .modern-select {
                    border: 1px solid rgba(0, 0, 0, 0.08);
                    background-color: #f8f9fa;
                    transition: all 0.25s ease-in-out;
                    border-radius: 8px;
                    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
                    height: 42px;
                    padding-left: 12px;
                }
                .bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}


                .modern-input:hover, .modern-select:hover {
                    border-color: rgba(115, 103, 240, 0.4);
                    box-shadow: 0 0 8px rgba(115, 103, 240, 0.25);
                }

                .modern-input:focus, .modern-select:focus {
                    background-color: #fff;
                    border-color: rgba(115, 103, 240, 0.8);
                    box-shadow: 0 0 10px rgba(115, 103, 240, 0.45);
                    outline: none;
                }

                .btn-modern {
                    transition: all 0.25s ease-in-out;
                }

                .btn-modern:hover {
                    box-shadow: 0 0 8px rgba(115, 103, 240, 0.3);
                    transform: translateY(-1px);
                }
            </style>

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-dark">
                    <i class="ti ti-user me-1 text-primary"></i> Username
                </label>
                <input type="text" class="form-control modern-input" placeholder="john.doe" wire:model="username" />
                @error('username')
                    <span class="text-danger small mt-2 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                @enderror
            </div>


            <!-- Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-dark">
                    <i class="ti ti-lock me-1 text-primary"></i> Password
                </label>
                <input type="password" class="form-control modern-input" placeholder="••••••••••••" wire:model="password" />
                @error('password')
                    <span class="text-danger small mt-2 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                @enderror
            </div>
            <!-- Email -->
<div class="mb-3">
    <label class="form-label fw-semibold text-dark">
        <i class="ti ti-mail me-1 text-primary"></i> Email
    </label>
    <input type="email" class="form-control modern-input" placeholder="agent@example.com" wire:model="email" />
    @error('email')
        <span class="text-danger small mt-2 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
    @enderror
</div>

            <!-- User Type -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-dark">
                    <i class="ti ti-users me-1 text-primary"></i> User Type
                </label>
                <select class="form-control modern-select" wire:model="user_type" wire:change="changeUserType($event.target.value)">
                    <option value="primary">Primary User</option>
                    <option value="assistant">Assistant (Child User)</option>
                </select>
                <small class="text-muted d-block mt-1">
                    Only choose "Assistant" to link this user with a Primary Admission Agent
                </small>
                @error('user_type')
                    <span class="text-danger small mt-2 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                @enderror
            </div>

            <!-- Primary Agent (Conditional) -->
            @if($user_type === 'assistant')
            <div class="mb-3">
                <label class="form-label fw-semibold text-dark">
                    <i class="ti ti-user me-1 text-primary"></i> Primary Agent
                </label>
                <select class="form-control modern-select" wire:model="parent_id">
                    <option value="">Select Primary Agent</option>
                    @foreach($primaryAgents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->username }}</option>
                    @endforeach
                </select>
                @error('parent_id')
                    <span class="text-danger small mt-2 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Role -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                    <i class="ti ti-id-badge me-1 text-primary"></i> Role
                </label>
                <select class="form-control modern-select" wire:model="role" @if($user_type === 'assistant') disabled @endif>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="counsellor">Counsellor</option>
                    <option value="admission">Admission Manager</option>
                    <option value="admissionagent">Admission Counsellor</option>
                    <option value="externalagent">External Agent</option>
                </select>
                @if($user_type === 'assistant')
                    <small class="text-muted d-block mt-1">Role is automatically set to "Admission Counsellor" for assistants</small>
                    <input type="hidden" wire:model="role" value="admissionagent">
                @endif
                @error('role')
                    <span class="text-danger small mt-2 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary fw-semibold px-4 py-2 btn-modern">
                    <i class="ti ti-user-plus me-1"></i> Add User
                </button>
            </div>
        </form>
    </div>
</div>

    
<ul class="container nav nav-tabs-dashboard" role="tablist">
    <li role="presentation">
        <button class="nav-link {{ $activeTab == 'systemUsers' ? 'active' : '' }}" 
                data-bs-toggle="tab" 
                data-bs-target="#systemUsers" 
                type="button" 
                role="tab"
                wire:click="$set('activeTab', 'systemUsers')">
            <div class="dashboard-tab-content">
                <div class="dashboard-icon">
                    <i class="ti ti-users"></i>
                </div>
                <div class="dashboard-text">
                    <div class="dashboard-title">All Counsellors</div>
                    <div class="dashboard-count">
                        @php
                            $systemCount = collect($users)->filter(function($user) {
                                return in_array($user['role'], ['admin', 'manager', 'counsellor']);
                            })->count();
                        @endphp
                        {{ $systemCount }}
                    </div>
                </div>
            </div>
        </button>
    </li>
    <li role="presentation">
        <button class="nav-link {{ $activeTab == 'admissionTeam' ? 'active' : '' }}" 
                data-bs-toggle="tab" 
                data-bs-target="#admissionTeam" 
                type="button" 
                role="tab"
                wire:click="$set('activeTab', 'admissionTeam')">
            <div class="dashboard-tab-content">
                <div class="dashboard-icon">
                    <i class="ti ti-user-check"></i>
                </div>
                <div class="dashboard-text">
                    <div class="dashboard-title">All Admissions</div>
                    <div class="dashboard-count">
                        @php
                            $admissionCount = collect($users)->filter(function($user) {
                                return in_array($user['role'], ['admission', 'admissionagent']);
                            })->count();
                        @endphp
                        {{ $admissionCount }}
                    </div>
                </div>
            </div>
        </button>
    </li>
    <li role="presentation">
        <button class="nav-link {{ $activeTab == 'externalAgents' ? 'active' : '' }}" 
                data-bs-toggle="tab" 
                data-bs-target="#externalAgents" 
                type="button" 
                role="tab"
                wire:click="$set('activeTab', 'externalAgents')">
            <div class="dashboard-tab-content">
                <div class="dashboard-icon">
                    <i class="ti ti-world"></i>
                </div>
                <div class="dashboard-text">
                    <div class="dashboard-title">External Agents</div>
                    <div class="dashboard-count">
                        @php
                            $externalCount = collect($users)->filter(function($user) {
                                return $user['role'] === 'externalagent';
                            })->count();
                        @endphp
                        {{ $externalCount }}
                    </div>
                </div>
            </div>
        </button>
    </li>
    <li role="presentation">
        <button class="nav-link {{ $activeTab == 'adminUsers' ? 'active' : '' }}" 
                data-bs-toggle="tab" 
                data-bs-target="#adminUsers" 
                type="button" 
                role="tab"
                wire:click="$set('activeTab', 'adminUsers')">
            <div class="dashboard-tab-content">
                <div class="dashboard-icon">
                    <i class="ti ti-crown"></i>
                </div>
                <div class="dashboard-text">
                    <div class="dashboard-title">All Admins</div>
                    <div class="dashboard-count">
                        @php
                            $adminCount = collect($users)->filter(function($user) {
                                return $user['role'] === 'admin';
                            })->count();
                        @endphp
                        {{ $adminCount }}
                    </div>
                </div>
            </div>
        </button>
    </li>
    <li role="presentation">
        <button class="nav-link {{ $activeTab == 'managerUsers' ? 'active' : '' }}" 
                data-bs-toggle="tab" 
                data-bs-target="#managerUsers" 
                type="button" 
                role="tab"
                wire:click="$set('activeTab', 'managerUsers')">
            <div class="dashboard-tab-content">
                <div class="dashboard-icon">
                    <i class="ti ti-user"></i>
                </div>
                <div class="dashboard-text">
                    <div class="dashboard-title">All Managers</div>
                    <div class="dashboard-count">
                        @php
                            $managerCount = collect($users)->filter(function($user) {
                                return $user['role'] === 'manager';
                            })->count();
                        @endphp
                        {{ $managerCount }}
                    </div>
                </div>
            </div>
        </button>
    </li>
</ul>

<style>
    
/* Remove nav-tabs class completely and use only custom class */
.nav-tabs-dashboard {
    border-bottom: none !important;
    gap: 16px;
    padding: 16px 0;
    display: flex;
    flex-wrap: wrap;
    position: relative;
}

/* Remove any potential border from the container */
.nav-tabs-dashboard::before,
.nav-tabs-dashboard::after {
    display: none !important;
    content: none !important;
}

.nav-tabs-dashboard > li {
    margin-bottom: 0;
    flex: 1;
    min-width: 200px;
    list-style: none;
}

.nav-tabs-dashboard .nav-link {
    border: none !important;
    border-radius: 12px;
    padding: 0 !important;
    background: transparent !important;
    transition: all 0.3s ease;
    height: 100%;
    cursor: pointer;
    width: 100%;
    position: relative;
    margin-bottom: 0 !important;
}

/* Remove any focus states that might add borders */
.nav-tabs-dashboard .nav-link:focus,
.nav-tabs-dashboard .nav-link:active {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}

/* Remove any active state borders */
.nav-tabs-dashboard .nav-link.active {
    border: none !important;
    background: transparent !important;
}

/* Remove any hover state borders */
.nav-tabs-dashboard .nav-link:hover {
    transform: translateY(-4px);
    border: none !important;
}

.dashboard-tab-content {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid transparent;
    position: relative;
    z-index: 1;
}

.nav-tabs-dashboard .nav-link.active .dashboard-tab-content {
    border-color: #7367F0;
    box-shadow: 0 4px 12px rgba(8, 8, 8, 0.15);
}

.nav-tabs-dashboard .nav-link:hover .dashboard-tab-content {
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
}

.dashboard-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 10px;
    background: linear-gradient(135deg, #7367F0, #7367F0);
    color: white;
    font-size: 20px;
}

/* Different gradient colors for each tab */
.nav-tabs-dashboard > li:nth-child(1) .dashboard-icon {
    background: linear-gradient(135deg, #7367F0, #7367F0);
}

.nav-tabs-dashboard > li:nth-child(2) .dashboard-icon {
    background: linear-gradient(135deg, #E74C3C, #E74C3C);
}

.nav-tabs-dashboard > li:nth-child(3) .dashboard-icon {
    background: linear-gradient(135deg, #4B4B4B, #4B4B4B);
}

.nav-tabs-dashboard > li:nth-child(4) .dashboard-icon {
    background: linear-gradient(135deg, #00CFE8, #00CFE8);
}

.nav-tabs-dashboard > li:nth-child(5) .dashboard-icon {
    background: linear-gradient(135deg, #198754, #198754);
}

.dashboard-text {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.dashboard-title {
    font-weight: 600;
    font-size: 14px;
    color: #495057;
}

.dashboard-count {
    font-size: 24px;
    font-weight: 700;
    color: #7367F0;
}

/* Different count colors for each tab */
.nav-tabs-dashboard > li:nth-child(1) .dashboard-count {
    color: #555554;
}

.nav-tabs-dashboard > li:nth-child(2) .dashboard-count {
    color: #555554;
}

.nav-tabs-dashboard > li:nth-child(3) .dashboard-count {
    color: #555554;
}

.nav-tabs-dashboard > li:nth-child(4) .dashboard-count {
    color: #555554;
}

.nav-tabs-dashboard > li:nth-child(5) .dashboard-count {
    color: #555554;
}

/* Responsive design */
@media (max-width: 1200px) {
    .nav-tabs-dashboard > li {
        min-width: 180px;
    }
}

@media (max-width: 992px) {
    .nav-tabs-dashboard > li {
        flex: 0 0 calc(50% - 8px);
        min-width: auto;
    }
}

@media (max-width: 576px) {
    .nav-tabs-dashboard > li {
        flex: 0 0 100%;
    }
    
    .dashboard-tab-content {
        padding: 16px;
    }
    
    .dashboard-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    
    .dashboard-count {
        font-size: 20px;
    }
}
</style>
    
    <!-- Tab Content -->
    <div class="tab-content mt-3">
        <!-- System Users Tab -->
        <div class="tab-pane fade {{ $activeTab == 'systemUsers' ? 'show active' : '' }}" id="systemUsers" role="tabpanel">
            <div class="card">
                <h5 class="card-header bg-primary text-white">
                    <i class="ti ti-users me-1 text-white"></i> All Counsellors
                </h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-light">
                                <th><i class="ti ti-user me-1"></i> Username</th>
                                <th><i class="ti ti-id-badge me-1"></i> Role</th>
                                <th><i class="ti ti-circle-check me-1"></i> Status</th>
                                <th><i class="ti ti-settings me-1"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php
                                $systemUsers = collect($users)->filter(function($user) {
                                    return in_array($user['role'], ['admin', 'manager', 'counsellor']);
                                });
                            @endphp
                            
                            @if ($systemUsers->count() > 0)
                                @foreach ($systemUsers as $index => $user)
                                    <tr>
                                          <td>
        <strong>
            <i class="ti ti-user-circle me-1 text-dark"></i>
            {{ $user['username'] }}
        </strong>
        <div class="small text-muted">
            <span class="me-4"></span>
            ID: {{ $user['id'] }}
        </div>
    </td>
                                        <td
                                            class="{{ $user['role'] == 'admin' ? 'text-info' : ($user['role'] == 'manager' ? 'text-success' : 'text-dark') }}">
                                            <i class="ti ti-shield me-1"></i> {{ ucfirst($user['role']) }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $user['status'] ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                                <i
                                                    class="ti {{ $user['status'] ? 'ti-circle-check' : 'ti-circle-dot' }} me-1"></i>
                                                {{ $user['status'] ? 'Active' : 'Disabled' }}
                                            </span>
                                        </td>
                                        <td  style="min-width: 160px;">
                                            <div class="d-flex align-items-center gap-2">
                                            <button
                                                class="btn btn-sm btn-success d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;"
                                                wire:click="editUser({{ $user['id'] }})" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <div class="form-check form-switch" style="display: flex; align-items: center;">
                                                <input class="form-check-input" type="checkbox"
                                                    id="userStatus{{ $user['id'] }}"
                                                    wire:click.prevent="confirmToggle({{ $user['id'] }})"
                                                    @if ($user['status']) checked @endif
                                                    style="width: 40px; height: 20px; margin-top: 0;">
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No system users found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Admission Team Tab -->
        <div class="tab-pane fade {{ $activeTab == 'admissionTeam' ? 'show active' : '' }}" id="admissionTeam" role="tabpanel">
            <div class="card">
                <h5 class="card-header bg-primary text-white">
                    <i class="ti ti-user-check me-1 text-white"></i> Admission Team 
                </h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-light">
                                <th><i class="ti ti-user me-1"></i> Username</th>
                                <th><i class="ti ti-id-badge me-1"></i> Role</th>
                                <th><i class="ti ti-circle-check me-1"></i> Status</th>
                                <th><i class="ti ti-settings me-1"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php
                                $admissionUsers = collect($users)->filter(function($user) {
                                    return in_array($user['role'], ['admission', 'admissionagent']);
                                });
                            @endphp
                            
                            @if ($admissionUsers->count() > 0)
                                @foreach ($admissionUsers as $index => $user)
                                    <tr>
                                        <td>
        <strong>
            <i class="ti ti-user-circle me-1 text-dark"></i>
            {{ $user['username'] }}
        </strong>
        <div class="small text-muted">
            <span class="me-4"></span>
            ID: {{ $user['id'] }}
        </div>
    </td>

   <td class="{{ $user['role'] === 'admission' ? 'text-danger fw-bold' : 'text-dark' }}">
    <i class="ti ti-shield me-1"></i>
    {{ $user['role'] === 'admission' ? 'Admission Manager' : 'Admission Agent' }}
</td>

                                        <td>
                                            <span
                                                class="badge {{ $user['status'] ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                                <i
                                                    class="ti {{ $user['status'] ? 'ti-circle-check' : 'ti-circle-dot' }} me-1"></i>
                                                {{ $user['status'] ? 'Active' : 'Disabled' }}
                                            </span>
                                        </td>
                                        <td  style="min-width: 160px;">
                                                                                        <div class="d-flex align-items-center gap-2">

                                            <button
                                                class="btn btn-sm btn-success d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;"
                                                wire:click="editUser({{ $user['id'] }})" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <div class="form-check form-switch" style="display: flex; align-items: center;">
                                                <input class="form-check-input" type="checkbox"
                                                    id="userStatus{{ $user['id'] }}"
                                                    wire:click.prevent="confirmToggle({{ $user['id'] }})"
                                                    @if ($user['status']) checked @endif
                                                    style="width: 40px; height: 20px; margin-top: 0;">
                                            </div>
                                                                                        </div>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No admission team users found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- External Agents Tab -->
        <div class="tab-pane fade {{ $activeTab == 'externalAgents' ? 'show active' : '' }}" id="externalAgents" role="tabpanel">
            <div class="card">
                <h5 class="card-header bg-primary text-white">
                    <i class="ti ti-world me-1 text-white"></i> External Agents
                </h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-light">
                                <th><i class="ti ti-user me-1"></i> Username</th>
                                <th><i class="ti ti-id-badge me-1"></i> Role</th>
                                <th><i class="ti ti-circle-check me-1"></i> Status</th>
                                <th><i class="ti ti-settings me-1"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php
                                $externalUsers = collect($users)->filter(function($user) {
                                    return $user['role'] === 'externalagent';
                                });
                            @endphp
                            
                            @if ($externalUsers->count() > 0)
                                @foreach ($externalUsers as $index => $user)
                                    <tr>
                                                               <td>
        <strong>
            <i class="ti ti-user-circle me-1 text-dark"></i>
            {{ $user['username'] }}
        </strong>
        <div class="small text-muted">
            <span class="me-4"></span>
            ID: {{ $user['id'] }}
        </div>
    </td>
                                        <td class="text-dark">
                                            <i class="ti ti-shield me-1"></i> External Agent
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $user['status'] ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                                <i
                                                    class="ti {{ $user['status'] ? 'ti-circle-check' : 'ti-circle-dot' }} me-1"></i>
                                                {{ $user['status'] ? 'Active' : 'Disabled' }}
                                            </span>
                                        </td>
                                        <td style="min-width: 160px;">
                                           <div class="d-flex align-items-center gap-2">
                                            <button
                                                class="btn btn-sm btn-success d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;"
                                                wire:click="editUser({{ $user['id'] }})" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <div class="form-check form-switch" style="display: flex; align-items: center;">
                                                <input class="form-check-input" type="checkbox"
                                                    id="userStatus{{ $user['id'] }}"
                                                    wire:click.prevent="confirmToggle({{ $user['id'] }})"
                                                    @if ($user['status']) checked @endif
                                                    style="width: 40px; height: 20px; margin-top: 0;">
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No external agents found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Admin Users Tab -->
        <div class="tab-pane fade {{ $activeTab == 'adminUsers' ? 'show active' : '' }}" id="adminUsers" role="tabpanel">
            <div class="card">
                <h5 class="card-header bg-primary text-white">
                    <i class="ti ti-crown me-1 text-white"></i>All Admins
                </h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-light">
                                <th><i class="ti ti-user me-1"></i> Username</th>
                                <th><i class="ti ti-id-badge me-1"></i> Role</th>
                                <th><i class="ti ti-circle-check me-1"></i> Status</th>
                                <th><i class="ti ti-settings me-1"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php
                                $adminUsers = collect($users)->filter(function($user) {
                                    return $user['role'] === 'admin';
                                });
                            @endphp
                            
                            @if ($adminUsers->count() > 0)
                                @foreach ($adminUsers as $index => $user)
                                    <tr>
                                                                <td>
        <strong>
            <i class="ti ti-user-circle me-1 text-dark"></i>
            {{ $user['username'] }}
        </strong>
        <div class="small text-muted">
            <span class="me-4"></span>
            ID: {{ $user['id'] }}
        </div>
    </td>
                                        <td class="text-info">
                                            <strong>
                                            <i class="ti ti-shield me-1"></i> Admin
                                            </strong>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $user['status'] ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                                <i
                                                    class="ti {{ $user['status'] ? 'ti-circle-check' : 'ti-circle-dot' }} me-1"></i>
                                                {{ $user['status'] ? 'Active' : 'Disabled' }}
                                            </span>
                                        </td>
                                        <td  style="min-width: 160px;">
                                            <div class="d-flex align-items-center gap-2">
                                            <button
                                                class="btn btn-sm btn-success d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;"
                                                wire:click="editUser({{ $user['id'] }})" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <div class="form-check form-switch" style="display: flex; align-items: center;">
                                                <input class="form-check-input" type="checkbox"
                                                    id="userStatus{{ $user['id'] }}"
                                                    wire:click.prevent="confirmToggle({{ $user['id'] }})"
                                                    @if ($user['status']) checked @endif
                                                    style="width: 40px; height: 20px; margin-top: 0;">
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No admin users found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Manager Users Tab -->
        <div class="tab-pane fade {{ $activeTab == 'managerUsers' ? 'show active' : '' }}" id="managerUsers" role="tabpanel">
            <div class="card">
                <h5 class="card-header bg-primary text-white">
                    <i class="ti ti-user me-1 text-white"></i>All Managers
                </h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-light">
                                <th><i class="ti ti-user me-1"></i> Username</th>
                                <th><i class="ti ti-id-badge me-1"></i> Role</th>
                                <th><i class="ti ti-circle-check me-1"></i> Status</th>
                                <th><i class="ti ti-settings me-1"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php
                                $managerUsers = collect($users)->filter(function($user) {
                                    return $user['role'] === 'manager';
                                });
                            @endphp
                            
                            @if ($managerUsers->count() > 0)
                                @foreach ($managerUsers as $index => $user)
                                    <tr>
                                                                <td>
        <strong>
            <i class="ti ti-user-circle me-1 text-dark"></i>
            {{ $user['username'] }}
        </strong>
        <div class="small text-muted">
            <span class="me-4"></span>
            ID: {{ $user['id'] }}
        </div>
    </td>
                                        <td class="text-success">
                                            <strong>
                                            <i class="ti ti-shield me-1"></i> Manager
                                            </strong>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $user['status'] ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                                <i
                                                    class="ti {{ $user['status'] ? 'ti-circle-check' : 'ti-circle-dot' }} me-1"></i>
                                                {{ $user['status'] ? 'Active' : 'Disabled' }}
                                            </span>
                                        </td>
                                        <td  style="min-width: 160px;">
                                            <div class="d-flex align-items-center gap-2">
                                            <button
                                                class="btn btn-sm btn-success d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;"
                                                wire:click="editUser({{ $user['id'] }})" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <div class="form-check form-switch" style="display: flex; align-items: center;">
                                                <input class="form-check-input" type="checkbox"
                                                    id="userStatus{{ $user['id'] }}"
                                                    wire:click.prevent="confirmToggle({{ $user['id'] }})"
                                                    @if ($user['status']) checked @endif
                                                    style="width: 40px; height: 20px; margin-top: 0;">
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No manager users found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modals -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Status Change</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to change this user's status?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary" wire:click="applyToggleStatus"
                        data-bs-dismiss="modal">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>
    
   <div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content border-0 shadow-lg" wire:submit.prevent="updateUser">
            
            <!-- Header -->
            <div class="modal-header bg-gradient-primary text-white py-3" style="border-radius: 8px 8px 0 0 !important;">
                <h5 class="modal-title text-white d-flex align-items-center mb-0">
                    <i class="ti ti-edit me-2 text-white"></i> Edit User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">
                <input type="hidden" wire:model="userId">

                <style>
                    .modern-input, .modern-select {
                        border: 1px solid rgba(0, 0, 0, 0.08);
                        background-color: #f8f9fa;
                        transition: all 0.25s ease-in-out;
                        border-radius: 8px;
                        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
                        height: 42px;
                        padding-left: 12px;
                    }
                    .modern-input:hover, .modern-select:hover {
                        border-color: rgba(115, 103, 240, 0.4);
                        box-shadow: 0 0 8px rgba(115, 103, 240, 0.25);
                    }
                    .modern-input:focus, .modern-select:focus {
                        background-color: #fff;
                        border-color: rgba(115, 103, 240, 0.8);
                        box-shadow: 0 0 10px rgba(115, 103, 240, 0.45);
                        outline: none;
                    }
                </style>

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">
                        <i class="ti ti-user me-1 text-primary"></i> Username
                    </label>
                    <input type="text" class="form-control modern-input" wire:model="username">
                    @error('username')
                        <span class="text-danger small mt-1 d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>
                <!-- Email -->
<div class="mb-3">
    <label class="form-label fw-semibold text-dark">
        <i class="ti ti-mail me-1 text-primary"></i> Email
    </label>
    <input type="email" class="form-control modern-input" wire:model="email">
    @error('email')
        <span class="text-danger small mt-1 d-block">
            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </span>
    @enderror
</div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">
                        <i class="ti ti-lock me-1 text-primary"></i> Password
                    </label>
                    <input type="text" class="form-control modern-input" wire:model="password"
                        placeholder="Leave blank to keep current password">
                    @error('password')
                        <span class="text-danger small mt-1 d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- User Type -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">
                        <i class="ti ti-users me-1 text-primary"></i> User Type
                    </label>
                    <select class="form-control modern-select" wire:model="user_type" wire:change="changeUserType($event.target.value)">
                        <option value="primary">Primary User</option>
                        <option value="assistant">Assistant</option>
                    </select>
                    @error('user_type')
                        <span class="text-danger small mt-1 d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Primary Agent (only for assistants) -->
                @if($user_type === 'assistant')
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">
                        <i class="ti ti-user me-1 text-primary"></i> Primary Agent
                    </label>
                    <select class="form-control modern-select" wire:model="parent_id">
                        <option value="">Select Primary Agent</option>
                        @foreach($primaryAgents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->username }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <span class="text-danger small mt-1 d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>
                @endif

                <!-- Role -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">
                        <i class="ti ti-id-badge me-1 text-primary"></i> Role
                    </label>
                    <select class="form-control modern-select" wire:model="role"
                        @if($user_type === 'assistant') disabled @endif>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="counsellor">Counsellor</option>
                        <option value="admission">Admission Manager</option>
                        <option value="admissionagent">Admission Counsellor</option>
                        <option value="externalagent">External Agent</option>
                    </select>
                    @if($user_type === 'assistant')
                        <small class="text-muted d-block mt-1">Role is automatically set to "Admission Counsellor" for assistants</small>
                        <input type="hidden" wire:model="role" value="admissionagent">
                    @endif
                    @error('role')
                        <span class="text-danger small mt-1 d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 pt-0 pb-3">
                <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary fw-semibold px-4">
                    <i class="ti ti-check me-1"></i> Update User
                </button>
            </div>
        </form>
    </div>
</div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('show-confirmation-modal', event => {
            var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            myModal.show();
        });
        window.addEventListener('status-updated', event => {
            let userId = event.detail.userId;
            let status = event.detail.status;
            let checkbox = document.getElementById('userStatus' + userId);
            if (checkbox) {
                checkbox.checked = status; // Explicitly set checked state
            }
        });
        
        // Store active tab in Livewire component when Bootstrap tab is shown
        document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (event) {
                const target = event.target.getAttribute('data-bs-target');
                const tabName = target.replace('#', '');
                // You might need to emit a Livewire event here if needed
            });
        });
    });
</script>