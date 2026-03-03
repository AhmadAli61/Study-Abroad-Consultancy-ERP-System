<div class="all-staff-container">
    <!-- Custom CSS -->
    <style>
        .all-staff-container {
            padding: 20px 0;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .staff-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .staff-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .staff-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .staff-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            margin-right: 15px;
        }

        .role-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .role-badge-primary {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .role-badge-success {
            background-color: #e8f5e8;
            color: #2e7d32;
        }

        .role-badge-warning {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .asset-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .asset-laptop {
            background-color: #28a745;
        }

        .asset-phone {
            background-color: #17a2b8;
        }

        .filter-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #667eea;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            margin-right: 5px;
        }

        .btn-view {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .btn-view:hover {
            background-color: #1976d2;
            color: white;
        }

        .btn-edit {
            background-color: #e8f5e8;
            color: #2e7d32;
        }

        .btn-edit:hover {
            background-color: #2e7d32;
            color: white;
        }

        .btn-delete {
            background-color: #ffebee;
            color: #d32f2f;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
            color: white;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state-icon {
            font-size: 64px;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .pagination-container {
            background: white;
            padding: 15px;
            border-radius: 0 0 10px 10px;
            border-top: 1px solid #e9ecef;
        }

        @media (max-width: 768px) {
            .staff-card {
                margin-bottom: 15px;
            }
            
            .table-responsive {
                border: 1px solid #dee2e6;
                border-radius: 10px;
            }
        }
    </style>

    <div class="container-fluid">
        <!-- Header Section -->
        <div class="staff-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="h2 mb-2">Staff Management</h1>
                        <p class="mb-0 opacity-75">Manage and view all staff members in the organization</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="stats-card">
                            <h3 class="mb-1">{{ $totalStaff }}</h3>
                            <p class="mb-0 text-muted">Total Staff</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="container">
            <div class="filter-section">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="search" class="form-label">Search Staff</label>
                        <input
                            type="text"
                            id="search"
                            class="form-control"
                            wire:model.live="search"
                            placeholder="Search by name, CNIC, phone, or role..."
                        >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="roleFilter" class="form-label">Filter by Role</label>
                        <select
                            id="roleFilter"
                            class="form-select"
                            wire:model.live="roleFilter"
                        >
                            <option value="">All Roles</option>
                            @foreach($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="perPage" class="form-label">Items per page</label>
                        <select
                            id="perPage"
                            class="form-select"
                            wire:model.live="perPage"
                        >
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Staff Table -->
            <div class="staff-card">
                @if($staff->count() > 0)
                    <!-- Desktop Table -->
                    <div class="d-none d-md-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Staff Member</th>
                                        <th>Contact Info</th>
                                        <th>Job Details</th>
                                        <th>Assets</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staff as $member)
                                        <tr>
                                            <!-- Personal Information -->
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="staff-avatar">
                                                        {{ substr($member->full_name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark">{{ $member->full_name }}</div>
                                                        <div class="text-muted small">CNIC: {{ $member->cnic_number }}</div>
                                                        <div class="text-muted small">DOB: {{ $member->date_of_birth->format('M d, Y') }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Contact Information -->
                                            <td>
                                                <div class="text-dark">{{ $member->personal_contact_number }}</div>
                                                <div class="text-muted small">Emergency: {{ $member->emergency_contact_number }}</div>
                                                <div class="text-muted small text-truncate" style="max-width: 200px;">
                                                    {{ $member->home_address }}
                                                </div>
                                            </td>

                                            <!-- Job Details -->
                                            <td>
                                                <span class="role-badge role-badge-primary">
                                                    {{ $member->role }}
                                                </span>
                                                <div class="mt-1">
                                                    <small class="text-dark d-block">Joined: {{ $member->date_of_joining->format('M d, Y') }}</small>
                                                    <small class="text-muted d-block">Package: {{ $member->salary_package }}</small>
                                                    @if($member->commission)
                                                        <small class="text-primary d-block">Commission: {{ $member->commission }}</small>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Assets -->
                                            <td>
                                                <div>
                                                    @if($member->assigned_laptop)
                                                        <div class="d-flex align-items-center mb-1">
                                                            <span class="asset-indicator asset-laptop"></span>
                                                            <small class="text-dark">Laptop: {{ $member->assigned_laptop }}</small>
                                                        </div>
                                                    @endif
                                                    @if($member->assigned_phone)
                                                        <div class="d-flex align-items-center">
                                                            <span class="asset-indicator asset-phone"></span>
                                                            <small class="text-dark">Phone: {{ $member->assigned_phone }}</small>
                                                        </div>
                                                    @endif
                                                    @if(!$member->assigned_laptop && !$member->assigned_phone)
                                                        <small class="text-muted">No assets assigned</small>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Actions -->
                                            <td>
                                                <div class="btn-group">
                                                    <button class="action-btn btn-view">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                    <button class="action-btn btn-edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="action-btn btn-delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="d-md-none">
                        <div class="p-3">
                            @foreach($staff as $member)
                                <div class="staff-card p-3 mb-3">
                                    <!-- Card Header -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="staff-avatar">
                                            {{ substr($member->full_name, 0, 1) }}
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold">{{ $member->full_name }}</h6>
                                            <span class="role-badge role-badge-primary">
                                                {{ $member->role }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <small class="text-muted d-block">Contact</small>
                                            <small class="text-dark">{{ $member->personal_contact_number }}</small>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <small class="text-muted d-block">CNIC</small>
                                            <small class="text-dark">{{ $member->cnic_number }}</small>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <small class="text-muted d-block">Joined</small>
                                            <small class="text-dark">{{ $member->date_of_joining->format('M d, Y') }}</small>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <small class="text-muted d-block">Salary</small>
                                            <small class="text-dark">{{ $member->salary_package }}</small>
                                        </div>
                                    </div>

                                    <!-- Assets -->
                                    @if($member->assigned_laptop || $member->assigned_phone)
                                        <div class="border-top pt-2 mt-2">
                                            <small class="text-muted d-block mb-1">Assets:</small>
                                            <div class="d-flex flex-wrap gap-2">
                                                @if($member->assigned_laptop)
                                                    <span class="badge bg-light text-dark">
                                                        <i class="fas fa-laptop me-1"></i> {{ $member->assigned_laptop }}
                                                    </span>
                                                @endif
                                                @if($member->assigned_phone)
                                                    <span class="badge bg-light text-dark">
                                                        <i class="fas fa-mobile-alt me-1"></i> {{ $member->assigned_phone }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Actions -->
                                    <div class="border-top pt-3 mt-3">
                                        <div class="d-flex justify-content-between">
                                            <button class="action-btn btn-view">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="action-btn btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $staff->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="mb-3">No staff members found</h4>
                        <p class="text-muted mb-4">
                            @if($search || $roleFilter)
                                Try adjusting your search criteria or filters.
                            @else
                                No staff members have been added yet.
                            @endif
                        </p>
                        @if($search || $roleFilter)
                            <button 
                                wire:click="$set('search', '')" 
                                class="btn btn-primary"
                            >
                                <i class="fas fa-times me-2"></i>Clear Filters
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</div>