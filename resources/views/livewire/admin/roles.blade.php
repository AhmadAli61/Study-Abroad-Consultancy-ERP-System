<div>
<div>
    <div class="col-12">
        <div class="modern-admin-card" style="background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); overflow: hidden;">
           <!-- Header Section -->
<div class="admin-header" 
     style="background: linear-gradient(135deg, #7367F0 0%, #7367F0 100%);
            color: white; 
            padding: 0.75rem 1rem; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            flex-wrap: wrap;">

    <!-- Left Side: Title and Icon -->
    <div style="display: flex; align-items: center;">
        <div class="header-icon" style="font-size: 2rem; margin-right: 1rem; opacity: 0.9;">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="header-content">
            <h4 class="text-white mb-1">Admin Roles & Permissions</h4>
            <p class="text-white mb-0" style="opacity: 0.9; font-size: 0.9rem;">
                Manage admin access levels and permissions across the platform
            </p>
        </div>
    </div>

    <!-- Right Side: Search Input -->
    <div style="background: white; 
                border-radius: 8px; 
                padding: 6px 10px; 
                display: flex; 
                align-items: center; 
                width: 250px; 
                margin-top: 8px;">
        <i class="fas fa-search" style="color: #7367F0; margin-right: 8px;"></i>
        <input type="text" 
               wire:model.live="search" 
               placeholder="Search admins..."
               style="border: none; 
                      background: transparent; 
                      outline: none; 
                      width: calc(100% - 30px); 
                      color: #333;">
    </div>
</div>


            <div>
                <!-- Alert Messages -->
                <div class="alert-section" style="margin-bottom: 2rem;">
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none; padding: 1rem 1.25rem; margin-bottom: 1rem;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none; padding: 1rem 1.25rem; margin-bottom: 1rem; background: #d1fae5; color: #065f46;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <span>{{ session('message') }}</span>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Database Status -->
                    @php
                        $hasPermissionColumn = \Schema::hasColumn('users', 'permission_level');
                    @endphp
                    
                    @if (!$hasPermissionColumn)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none; padding: 1rem 1.25rem; margin-bottom: 1rem; background: #fef3c7; color: #92400e;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>
                                    <strong class="d-block">Database Configuration Required</strong>
                                    Permission level column not found. Please run: <code>php artisan migrate</code>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>

                <!-- Stats Cards -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border: 1px solid #f0f0f0; display: flex; align-items: center; height: 100%;">
                <div class="stats-icon bg-primary" style="width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem; color: white; font-size: 1.5rem;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-content">
                    <h3 style="margin: 0; font-weight: 700; font-size: 1.75rem; color: #2d3748;">{{ $users->total() }}</h3>
                    <p style="margin: 0.25rem 0 0 0; color: #718096; font-size: 0.875rem;">Total Admins</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border: 1px solid #f0f0f0; display: flex; align-items: center; height: 100%;">
                <div class="stats-icon bg-success" style="width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem; color: white; font-size: 1.5rem;">
                    <i class="fas fa-key"></i>
                </div>
                <div class="stats-content">
                    <h3 style="margin: 0; font-weight: 700; font-size: 1.75rem; color: #2d3748;">{{ $users->where('permission_level', 'full_access')->count() }}</h3>
                    <p style="margin: 0.25rem 0 0 0; color: #718096; font-size: 0.875rem;">Full Access</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border: 1px solid #f0f0f0; display: flex; align-items: center; height: 100%;">
                <div class="stats-icon bg-info" style="width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem; color: white; font-size: 1.5rem;">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stats-content">
                    <h3 style="margin: 0; font-weight: 700; font-size: 1.75rem; color: #2d3748;">{{ $users->where('permission_level', 'view_only')->count() }}</h3>
                    <p style="margin: 0.25rem 0 0 0; color: #718096; font-size: 0.875rem;">View Only</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border: 1px solid #f0f0f0; display: flex; align-items: center; height: 100%;">
                <div class="stats-icon bg-warning" style="width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem; color: white; font-size: 1.5rem;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-content">
                    <h3 style="margin: 0; font-weight: 700; font-size: 1.75rem; color: #2d3748;">Just now</h3>
                    <p style="margin: 0.25rem 0 0 0; color: #718096; font-size: 0.875rem;">Last Updated</p>
                </div>
            </div>
        </div>
    </div>
</div>


                <!-- Main Content Section -->
                <div class="content-section" style="background: #fff; border-radius: 12px; border: 1px solid #f0f0f0; overflow: hidden;">
                    

                    <!-- Users Table -->
                    <div class="table-container" style="overflow: hidden;">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" style="margin: 0;">
                               <thead class="table-light">
    <tr>
        <th class="ps-4">
            <i class="fas fa-user-shield me-2 text-dark"></i> Admin
        </th>
        <th>
            <i class="fas fa-user-tag me-2 text-dark"></i> Role
        </th>
        <th>
            <i class="fas fa-lock me-2 text-dark"></i> Permission Level
        </th>
        <th>
            <i class="fas fa-clock me-2 text-dark"></i> Last Active
        </th>
        <th class="text-end pe-4">
            <i class="fas fa-cogs me-2 text-dark"></i> Actions
        </th>
    </tr>
</thead>

                                <tbody>
                                    @forelse($users as $user)
                                        <tr class="user-row" style="transition: background-color 0.2s ease;">
                                           <td class="ps-4">
    <div class="d-flex align-items-center">
        <div class="user-avatar" style="position: relative; margin-right: 1rem;">
            @php
                // Clean the username (remove @ if present)
                $cleanedName = ltrim($user->username, '@');
                // Get first letter after removing @
                $firstLetter = strtoupper(substr($cleanedName, 0, 1));
            @endphp

            <span class="avatar-text"
                style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #7367F0 0%, #7367F0 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                {{ $firstLetter }}
            </span>

            <span class="online-status"
                style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; border-radius: 50%; background: #10b981; border: 2px solid white;"></span>
        </div>

        <div class="user-info">
            <h6 class="mb-0" style="font-weight: 600; color: #2d3748;">
                {{ ltrim($user->username, '@') }}
            </h6>

            @if(!$hasPermissionColumn)
                <small class="text-danger d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>Permission column missing
                </small>
            @endif
        </div>
    </div>
</td>

                                            <td>
                                                <span class="role-badge" style="background: #fcddd9; color: #E74C3C; padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                                    <i class="fas fa-user-shield me-1"></i>{{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>
                                                <select wire:model="permissionLevels.{{ $user->id }}" 
                                                        class="permission-select"
                                                        style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 1rem; background: white; font-size: 0.875rem; transition: all 0.2s ease; min-width: 140px;"
                                                        @if(!$hasPermissionColumn || $isViewOnly) disabled @endif>
                                                    <option value="full_access">Full Access</option>
                                                    <option value="view_only">View Only</option>
                                                </select>
                                            </td>
                                            <td>
                                                <span class="last-active" style="color: #718096; font-size: 0.875rem;">2 hours ago</span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="action-buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                                    <button wire:click="updatePermission({{ $user->id }})" 
                                                            wire:loading.attr="disabled"
                                                            class="btn btn-primary btn-sm action-btn"
                                                            style="border-radius: 8px; padding: 0.5rem 1rem; font-size: 0.875rem; transition: all 0.2s ease;"
                                                            @if(!$hasPermissionColumn || $isViewOnly) disabled @endif>
                                                        <span wire:loading.remove>
                                                            <i class="fas fa-save me-1"></i>Update
                                                        </span>
                                                        <span wire:loading>
                                                            <i class="fas fa-spinner fa-spin me-1"></i>Updating...
                                                        </span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 empty-state" style="padding: 3rem 1rem;">
                                                <i class="fas fa-users fa-3x text-muted mb-3" style="opacity: 0.5;"></i>
                                                <h5 class="text-muted">No admin users found</h5>
                                                @if($search)
                                                    <p class="text-muted">Try adjusting your search criteria</p>
                                                @else
                                                    <p class="text-muted">Get started by adding your first admin user</p>
                                                    <button class="btn btn-primary mt-2">
                                                        <i class="fas fa-plus me-1"></i> Add Admin
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($users->hasPages())
                            <div class="pagination-section" style="padding: 1.5rem; border-top: 1px solid #f0f0f0; background: #f8f9fa;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted mb-0">
                                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} results
                                    </p>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="text-muted">Rows per page:</span>
                                        <select class="form-select form-select-sm w-auto">
                                            <option>10</option>
                                            <option>25</option>
                                            <option>50</option>
                                        </select>
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>