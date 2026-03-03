<div>
    <div class="card">
        <!-- Enhanced Header with Search -->
        <div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">
            <div class="card-body py-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-2 text-white">
                            <i class="fas fa-calendar-alt me-2"></i>
                            All Intakes
                        </h2>
                        <p class="mb-0 opacity-75">
                            Manage and review all intake periods from the past five years
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3 justify-content-end align-items-center">
                            <!-- Search Bar -->
                            <div class="flex-grow-1" style="max-width: 280px;">
    <div class="input-group input-group-sm search-container">
        <span class="input-group-text bg-white border-0 ps-2">
            <i class="fas fa-search text-muted"></i>
        </span>
        <input type="text" 
               class="form-control border-0 py-2" 
               placeholder="Search intakes..." 
               wire:model="searchTerm"
               style="border-radius: 0;">
        <button class="btn btn-dark border-0 px-3 search-btn" 
                type="button"
                wire:click="performSearch"
                style="border-radius: 0 6px 6px 0;">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>

                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Intakes Grid -->
            @if($intakes->count() > 0)
                <div class="row g-3 px-4 py-4">
                    @foreach($intakes as $intake)
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100 intake-card">
                                
                                <!-- Modern Intake Header -->
                                <div class="d-flex justify-content-between align-items-center p-3 rounded-top"
                                     style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                                     
                                    <!-- Left: Intake Info -->
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                             style="width: 42px; height: 42px; background-color: rgba(115, 103, 240, 0.1);">
                                            <i class="fas fa-calendar text-primary fs-5"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold text-dark text-truncate">
                                                {{ $intake->name }} {{ $intake->year }}
                                            </h5>
                                            <p class="text-muted mb-0 small d-flex align-items-center">
                                                <i class="fas fa-user me-1 text-secondary"></i> 
                                                <span class="text-truncate">{{ $intake->creator->username ?? 'N/A' }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Right: Student Count -->
                                    <div class="text-end">
                                        <div class="bg-white px-3 py-2 rounded shadow-sm text-center" style="min-width: 70px;">
                                            <h6 class="mb-0 fw-bold text-dark">{{ $intake->inquiries_count }}</h6>
                                            <small class="text-muted">Students</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body d-flex flex-column py-3 px-3">
                                    
                                    <!-- Intake Details -->
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-3 text-center text-dark" style="font-size: 14px;">
                                            <i class="fas fa-info-circle me-2 text-primary"></i>Intake Details
                                        </h6>
                                        
                                        <!-- Details List -->
                                        <div class="details-list">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <div class="text-center p-3 rounded bg-light">
                                                        <i class="fas fa-calendar mb-2 fs-5"></i>
                                                        <div class="fw-semibold text-dark mb-1" style="font-size: 12px;">Created Date</div>
                                                        <div class="text-muted" style="font-size: 11px;">{{ $intake->created_at->format('M d, Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-center p-3 rounded bg-light">
                                                        <i class="fas fa-user mb-2 fs-5"></i>
                                                        <div class="fw-semibold text-dark mb-1" style="font-size: 12px;">Created By</div>
                                                        <div class="text-muted text-truncate" style="font-size: 11px;" title="{{ $intake->creator->username ?? 'N/A' }}">
                                                            {{ $intake->creator->username ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Academic Year -->
                                    <div class="mt-auto">
                                        <div class="text-center p-2 rounded" style="background: linear-gradient(45deg, #f8f9fa, #e9ecef);">
                                            <small class="text-muted fw-semibold" style="font-size: 12px;">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                Academic Year: {{ $intake->year }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- View Button -->
                                <div class="card-footer bg-white border-0 py-3 rounded-bottom">
                                    <a href="{{ route('admission.intake-details', $intake->id) }}" 
                                       class="btn btn-primary w-100 fw-semibold d-flex align-items-center justify-content-center view-intake-btn"
                                       style="transition: all 0.3s ease; font-size: 14px; padding: 10px 16px; border-radius: 8px;"
                                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(115, 103, 240, 0.3)';"
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        <i class="fas fa-eye me-2"></i> View Students
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $intakes->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No Intakes Found</h4>
                    <p class="text-muted">
                        @if($searchTerm)
                            No intakes found matching "{{ $searchTerm }}".
                        @else
                            No intakes found for the last 5 years.
                        @endif
                    </p>
                    @if($searchTerm)
                        <button class="btn btn-outline-primary me-2" wire:click="clearSearch">
                            <i class="fas fa-times me-2"></i>Clear Search
                        </button>
                    @endif
                    <a href="{{ route('admission.add-intake') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create First Intake
                    </a>
                </div>
            @endif
        </div>
    </div>
    <style>
.intake-card {
    transition: all 0.3s ease;
    border-radius: 12px;
}

.intake-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.view-intake-btn {
    background: linear-gradient(45deg, #7367f0, #9e95f5);
    border: none;
    position: relative;
    overflow: hidden;
}

.view-intake-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.view-intake-btn:hover::before {
    left: 100%;
}

.details-list .progress {
    border-radius: 3px;
}

.details-list .progress-bar {
    border-radius: 3px;
    transition: width 0.8s ease-in-out;
}

/* Custom scrollbar for future use */
.team-members-container::-webkit-scrollbar {
    width: 4px;
}

.team-members-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.team-members-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.team-members-container::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
</div>