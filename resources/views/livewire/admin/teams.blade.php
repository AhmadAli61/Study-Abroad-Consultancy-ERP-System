<div>
<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <p class="text-green-500 m-0">{{ session('message') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- Main Team Management Card -->
    <div class="card border-0 shadow-lg">
        <!-- Card Header -->
        <div class="card-header bg-gradient-primary text-white py-4" style="border-radius: 12px 12px 0 0 !important;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2 text-white">
                        <i class="fas fa-users me-2"></i>
                        Team Management
                    </h2>
                    <p class="mb-0 opacity-75">
                        Create teams, assign managers and counselors, and monitor team performance
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block me-3">
                        <h3 class="mb-0 text-dark">{{ $teams->count() }}</h3>
                        <small class="opacity-75 text-dark">Active Teams</small>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block">
                        <h3 class="mb-0 text-dark">{{ $managers->count() }}</h3>
                        <small class="opacity-75 text-dark">Managers</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">
            <!-- Create Team Section -->
            <style>
    /* === Modern Input & Select Styling === */
    .modern-input, .modern-select {
        border: 1px solid rgba(0, 0, 0, 0.08);
        background-color: #f8f9fa; /* light gray field background */
        transition: all 0.25s ease-in-out;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04);
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

    /* Placeholder color for subtlety */
    .modern-input::placeholder {
        color: #adb5bd;
    }

    /* Smooth button hover effect */
    .btn-modern {
        transition: all 0.25s ease-in-out;
    }

    .btn-modern:hover {
        box-shadow: 0 0 8px rgba(115, 103, 240, 0.3);
        transform: translateY(-1px);
    }
</style>

<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 14px; background: #fff;">
            
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center p-3"
                 style="
                    background: linear-gradient(90deg, #f8f9fa 0%, #e6ecfc 100%);
                    border-left: 4px solid #7367F0;
                    border-top-left-radius: 14px;
                    border-top-right-radius: 14px;
                    border-bottom: 1px solid #e5e7eb;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                        <i class="fas fa-plus-circle text-primary fs-5"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">Create New Team</h4>
                        <p class="text-muted mb-0 small">Set up a new team with a manager</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge bg-success">{{ $managers->count() }} Managers</span>
                    <span class="badge bg-primary">{{ $counsellorsList->count() }} Counselors</span>
                </div>
            </div>

            <!-- Form Section -->
            <form wire:submit.prevent="createTeam" style="background: #fff;">
                @csrf
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-dark">
                                <i class="ti ti-flag me-1 text-primary"></i> Team Name
                            </label>
                            <input type="text"
                                   class="form-control modern-input"
                                   placeholder="Enter Team Name"
                                   wire:model="teamName" />
                            @error('teamName')
                                <span class="text-danger small mt-2 d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-dark">
                                <i class="ti ti-user me-1 text-primary"></i> Manager
                            </label>
                            <select class="form-control modern-select" wire:model="managerId">
                                <option value="">Select Manager</option>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->username }}</option>
                                @endforeach
                            </select>
                            @error('managerId')
                                <span class="text-danger small mt-2 d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary fw-semibold px-4 py-2 btn-modern">
                            <i class="ti ti-plus me-1"></i> Create Team
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
 <div class="row mb-4">
                    <div class="col-12">
                        <hr class="border-1 border-secondary opacity-25">
                    </div>
                </div>

            <!-- Assign Counselors Section -->
            <!-- Assign Counselors Section -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 14px; background: #fff;">

            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center p-3"
                 style="
                    background: linear-gradient(90deg, #f8f9fa 0%, #ecfcee 100%);
                    border-left: 4px solid #28a745;
                    border-top-left-radius: 14px;
                    border-top-right-radius: 14px;
                    border-bottom: 1px solid #e5e7eb;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width: 42px; height: 42px; background-color: rgba(40,167,69,0.1);">
                        <i class="fas fa-user-check text-success fs-5"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">Assign Counselors to Team</h4>
                        <p class="text-muted mb-0 small">Assign counselors to existing teams</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge bg-success">{{ $teams->count() }} Teams</span>
                    <span class="badge bg-primary">{{ $counsellorsList->count() }} Counselors</span>
                </div>
            </div>

            <!-- Form Section -->
            <form wire:submit.prevent="assignCounsellors" style="background: #fff;">
                @csrf
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Team Selection -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-dark">
                                <i class="ti ti-team me-1 text-success"></i> Team
                            </label>
                            <select class="form-control modern-select"
                                    wire:model="teamId">
                                <option value="">Select Team</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @error('teamId')
                                <span class="text-danger small mt-2 d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Counselor Selection -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-dark">
                                <i class="ti ti-user-check me-1 text-success"></i> Counselors
                            </label>
                            <select class="form-control modern-select"
                                    wire:model="counsellors" multiple
                                    style="height: 120px;">
                                @foreach ($counsellorsList as $counsellor)
                                    <option value="{{ $counsellor->id }}">{{ $counsellor->username }}</option>
                                @endforeach
                            </select>
                            @error('counsellors')
                                <span class="text-danger small mt-2 d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </span>
                            @enderror
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i>Hold Ctrl to select multiple counselors
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success fw-semibold px-4 py-2 btn-modern">
                            <i class="ti ti-user-check me-1"></i> Assign Counselors
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
 <div class="row mb-4">
                    <div class="col-12">
                        <hr class="border-1 border-secondary opacity-25">
                    </div>
                </div>


            <!-- All Teams Section -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                         style="background: linear-gradient(90deg, #7367F0 0%, #7367F0 100%); border-left: 4px solid #7367F0;">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 42px; height: 42px; background-color: rgba(235, 245, 245, 0.1);">
                                <i class="fas fa-layer-group text-white fs-5"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold text-white">All Teams</h4>
                                <p class=" mb-0 small text-white">Manage and monitor all teams</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-white text-primary">{{ $teams->count() }} Teams</span>
                        </div>
                    </div>
                </div>

              <div class="col-12">
    <div class="row g-4">
        @foreach ($teams as $team)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card border-0 shadow-sm h-100 team-card">

                    <!-- ✅ Modern Team Header (from sample design) -->
                    <div class="d-flex justify-content-between align-items-center p-3 rounded-top"
                         style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                         
                        <!-- Left: Team Info -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                                <i class="fas fa-layer-group text-primary fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark text-truncate">
                                    {{ $team->name }}
                                </h5>
                                <p class="text-muted mb-0 small d-flex align-items-center">
                                    <i class="fas fa-user-tie me-1 text-secondary"></i> 
                                    <span class="text-truncate">{{ $team->manager->username }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Right: Edit/Delete Buttons -->
                        <div class="d-flex gap-2">
                            <a href="#" wire:click.prevent="openEditModal({{ $team->id }})" 
                               data-bs-toggle="modal" data-bs-target="#editTeamModal" 
                               class="text-dark" title="Edit">
                                <i class="ti ti-pencil fs-5"></i>
                            </a>
                            <a href="#" wire:click.prevent="confirmDelete({{ $team->id }})" 
                               data-bs-toggle="modal" data-bs-target="#deleteTeamModal" 
                               class="text-dark" title="Delete">
                                <i class="ti ti-trash fs-5"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Card Body (unchanged) -->
                    <div class="card-body d-flex flex-column py-3 px-3">
                        <!-- Counselors Section -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold mb-0 text-primary">
                                    <i class="fas fa-user-friends me-2"></i>Counselors
                                </h6>
                                <span class="badge bg-primary">{{ $team->counsellors->count() }}</span>
                            </div>
                            <div class="counsellors-list">
                                @forelse ($team->counsellors as $counsellor)
                                    <div class="d-flex align-items-center mb-2 pb-2 border-bottom" style="border-color: #f8f9fa !important;">
                                        <div class="flex-shrink-0">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 32px; height: 32px;">
                                                <i class="fas fa-user text-muted" style="font-size: 14px;"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <div class="fw-semibold text-dark" style="font-size: 14px;">
                                                {{ $counsellor->username }}
                                            </div>
                                            <small class="text-muted" style="font-size: 12px;">
                                                {{ $counsellor->role }}
                                            </small>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-2">
                                        <i class="fas fa-users text-muted mb-2" style="font-size: 16px;"></i>
                                        <p class="text-muted mb-0">No counselors assigned</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Team Stats -->
                        <div class="mt-auto pt-3 border-top" style="border-color: #f1f3f4 !important;">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border-end" style="border-color: #f1f3f4 !important;">
                                        <div class="fw-bold text-primary" style="font-size: 18px;">
                                            {{ $team->counsellors->count() }}
                                        </div>
                                        <small class="text-muted">Counselors</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fw-bold text-success" style="font-size: 18px;">
                                        {{ $team->created_at->format('M Y') }}
                                    </div>
                                    <small class="text-muted">Created</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($teams->count() === 0)
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-layer-group fa-3x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted mb-2">No Teams Available</h5>
                <p class="text-muted mb-3">Create your first team to get started</p>
                <a href="#create-team" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Create Team
                </a>
            </div>
        @endif
    </div>
</div>

            </div>
        </div>
    </div>

    <!-- Edit Team Modal -->
    @if ($showEditModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <form wire:submit.prevent="updateTeam">
                        <div class="modal-header bg-gradient-primary text-white py-3">
                            <h5 class="modal-title text-white d-flex align-items-center">
                                <i class="fas fa-edit me-2"></i> Edit Team
                            </h5>
                            <button type="button" class="btn-close btn-close-white" wire:click="closeEditModal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-dark">
                                        <i class="ti ti-flag me-1 text-primary"></i> Team Name
                                    </label>
                                    <input type="text" class="form-control border-0 shadow-sm" style="border-radius: 8px;"
                                           wire:model.defer="editingTeamName">
                                    @error('editingTeamName')
                                        <span class="text-danger small mt-2 d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-dark">
                                        <i class="ti ti-user me-1 text-primary"></i> Manager
                                    </label>
                                    <select class="form-control border-0 shadow-sm" style="border-radius: 8px;"
                                            wire:model.defer="editingManagerId">
                                        <option value="">Select Manager</option>
                                        @foreach ($managers as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('editingManagerId')
                                        <span class="text-danger small mt-2 d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="ti ti-user-check me-1 text-primary"></i> Counselors
                                </label>
                                
                                @php
                                    $currentTeam = $teams->firstWhere('id', $editingTeamId);
                                    $currentTeamCounsellors = $currentTeam ? $currentTeam->counsellors : collect();
                                @endphp
                                
                                <div class="card bg-light border-0 shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3">
                                            <i class="fas fa-users me-2"></i>Currently in this team:
                                        </h6>
                                        <div class="row">
                                            @forelse($currentTeamCounsellors as $counsellor)
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               value="{{ $counsellor->id }}" 
                                                               id="counsellor_{{ $counsellor->id }}"
                                                               wire:model="editingCounsellors"
                                                               checked>
                                                        <label class="form-check-label" for="counsellor_{{ $counsellor->id }}">
                                                            {{ $counsellor->username }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <p class="text-muted mb-0">
                                                        <i class="fas fa-info-circle me-1"></i>No counselors in this team
                                                    </p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                @if(count($counsellorsList) > 0)
                                    <div class="card bg-light border-0 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="text-success mb-3">
                                                <i class="fas fa-user-plus me-2"></i>Available counselors to add:
                                            </h6>
                                            <div class="row">
                                                @foreach($counsellorsList as $counsellor)
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   value="{{ $counsellor->id }}" 
                                                                   id="available_counsellor_{{ $counsellor->id }}"
                                                                   wire:model="editingCounsellors">
                                                            <label class="form-check-label" for="available_counsellor_{{ $counsellor->id }}">
                                                                {{ $counsellor->username }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info border-0 shadow-sm mt-2">
                                        <small>
                                            <i class="ti ti-info-circle me-1"></i> No available counselors to add.
                                        </small>
                                    </div>
                                @endif
                                
                                @error('editingCounsellors')
                                    <span class="text-danger small mt-2 d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary fw-semibold" wire:click="closeEditModal">Cancel</button>
                            <button type="submit" class="btn btn-primary fw-semibold">Update Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Team Modal -->
    @if ($showDeleteModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-gradient-danger text-white py-3">
                        <h5 class="modal-title text-white d-flex align-items-center">
                            <i class="fas fa-trash-alt me-2"></i>Delete Team
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeDeleteModal"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Are you sure you want to delete this team?</h5>
                        <p class="text-muted">This action cannot be undone and all team assignments will be lost.</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn btn-secondary fw-semibold" wire:click="closeDeleteModal">Cancel</button>
                        <button class="btn btn-danger fw-semibold" wire:click="deleteTeam">Yes, Delete Team</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #dc3545 70%, #f8d7da 100%) !important;
}

.card {
    border-radius: 12px;
}

.team-card:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.counsellors-list {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #f1f3f4;
    border-radius: 8px;
    padding: 12px;
}

/* Custom scrollbar for counselors list */
.counsellors-list::-webkit-scrollbar {
    width: 4px;
}

.counsellors-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.counsellors-list::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 2px;
}

.counsellors-list::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

.form-control {
    border-radius: 8px;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-control:focus {
    box-shadow: 0 2px 8px rgba(115, 103, 240, 0.3);
}

.btn {
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 600;
}

.modal-content {
    border-radius: 12px;
}

.badge {
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 6px;
}
</style>
</div>