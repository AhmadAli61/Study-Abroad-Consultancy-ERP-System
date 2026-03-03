<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <p class="text-green-500 m-0">{{ session('message') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <p class="text-red-500 m-0">{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card mb-3 mt-2">
        <form wire:submit.prevent="createTeam">
            @csrf
            <div class="bg-primary text-white p-3 rounded-top">
                <h4 class="mb-0 text-white">
                    <i class="ti ti-users me-2 text-white"></i> Create Admission Team
                </h4>
            </div>
            <div class="p-4">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="col-form-label"><i class="ti ti-flag me-1"></i> Team Name</label>
                        <input type="text" class="form-control" placeholder="Enter Team Name"
                            wire:model="teamName" />
                        @error('teamName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label"><i class="ti ti-user me-1"></i> Admission Manager</label>
                        <select class="form-control" wire:model="managerId">
                            <option value="">Select Manager</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->username }}</option>
                            @endforeach
                        </select>
                        @error('managerId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Create Team
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="card mb-3 mt-2">
        <form wire:submit.prevent="assignAgents">
            @csrf
            <div class="bg-primary text-white p-3 rounded-top">
                <h4 class="mb-0 text-white">
                    <i class="ti ti-users me-2 text-white"></i> Assign Agents to Team
                </h4>
            </div>
            <div class="p-4">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="col-form-label"><i class="ti ti-team me-1"></i> Team</label>
                        <select class="form-control" wire:model="teamId">
                            <option value="">Select Team</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                        @error('teamId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label"><i class="ti ti-user-check me-1"></i> Admission Agents</label>
                        <div class="mt-2">
                            <select class="form-control" wire:model="agents" multiple>
                                @foreach ($agentsList as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('agents')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-user-check me-1"></i> Assign Agents
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-white">
                <i class="fas fa-users me-2"></i> All Admission Teams
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($teams as $team)
                    <div class="col-12 col-md-4 mb-4 mt-4">
                        <div class="card shadow-lg h-100 d-flex flex-column" style="min-height: 360px;">
                            <div class="card-header bg-success text-white pb-3 d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="m-0 card-title text-white">
                                        <i class="fas fa-layer-group me-2"></i> {{ $team->name }}
                                    </h5>
                                    <span class="badge bg-primary text-white mt-1">
                                        <i class="fas fa-user-tie me-1"></i> Manager: {{ $team->manager->username }}
                                    </span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="#" wire:click.prevent="openEditModal({{ $team->id }})" data-bs-toggle="modal" data-bs-target="#editTeamModal" title="Edit">
                                        <i class="ti ti-pencil text-white fs-5"></i>
                                    </a>
                                    <a href="#" wire:click.prevent="confirmDelete({{ $team->id }})" data-bs-toggle="modal" data-bs-target="#deleteTeamModal" title="Delete">
                                        <i class="ti ti-trash text-white fs-5"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body flex-grow-1">
                                <div class="row g-0 h-100">
                                    <div class="col-md-12 p-3 d-flex flex-column">
                                        <h6 class="text-center fw-bold mb-3">
                                            <i class="fas fa-user-friends me-2"></i>Admission Agents
                                        </h6>
                                        <div class="overflow-auto" style="max-height: 180px;">
                                            <ul class="list-unstyled">
                                                @forelse ($team->agents as $agent)
                                                    <li class="mb-1">
                                                        <i class="fas fa-user text-dark me-2"></i>{{ $agent->username }}
                                                    </li>
                                                @empty
                                                    <li class="text-muted">No agents assigned</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @if ($showEditModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form wire:submit.prevent="updateTeam">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white d-flex align-items-center">
                                <i class="fas fa-edit me-2"></i> Edit Admission Team
                            </h5>
                            <button type="button" class="btn-close" wire:click="closeEditModal"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Team Name</label>
                                <input type="text" class="form-control" wire:model.defer="editingTeamName">
                                @error('editingTeamName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Admission Manager</label>
                                <select class="form-control" wire:model.defer="editingManagerId">
                                    <option value="">Select Manager</option>
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->username }}</option>
                                    @endforeach
                                </select>
                                @error('editingManagerId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Admission Agents</label>
                                <select class="form-control" multiple wire:model.defer="editingAgents">
                                    @foreach ($agentsList as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->username }}</option>
                                    @endforeach
                                </select>
                                @error('editingAgents')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeEditModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Delete Modal --}}
    @if ($showDeleteModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title text-white"><i class="fas fa-trash-alt me-2"></i>Delete Admission Team</h5>
                        <button type="button" class="btn-close" wire:click="closeDeleteModal"></button>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure you want to delete this admission team?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="closeDeleteModal">Cancel</button>
                        <button class="btn btn-danger" wire:click="deleteTeam">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>