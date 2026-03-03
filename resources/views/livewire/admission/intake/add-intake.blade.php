<div><div class="d-flex flex-column gap-4">
    <!-- Main Form Card -->
    <div class="card shadow-sm border-0">
        <!-- Header Section -->
        <div class="bg-gradient-primary text-white px-4 py-4" style="border-radius: 12px 12px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 text-white fw-bold">
                        <i class="fas fa-plus-circle me-2"></i>Create New Intake
                    </h4>
                    <p class="mb-0 opacity-75">Add a new intake period for student enrollments</p>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="card-body p-4">
            <!-- Alert Messages -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div class="flex-grow-1">{{ session('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <div class="flex-grow-1">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <!-- Intake Form -->
            <form wire:submit.prevent="saveIntake">
                <div class="row g-4">
                    <!-- Intake Name Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label fw-semibold">
                                Intake Name <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-list-alt text-primary"></i>
                                </span>
                                <select class="form-select @error('name') is-invalid @enderror border-start-0 ps-3" 
                                        id="name" 
                                        wire:model="name">
                                    <option value="">-- Select Intake Type --</option>
                                    <option value="Spring Intake">Spring Intake</option>
                                    <option value="Mid Intake">Mid Intake</option>
                                    <option value="Fall Intake">Fall Intake</option>
                                </select>
                            </div>
                            @error('name') 
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div> 
                            @enderror
                        </div>
                    </div>

                    <!-- Year Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="year" class="form-label fw-semibold">
                                Academic Year <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </span>
                                <input type="number" 
                                       class="form-control @error('year') is-invalid @enderror border-start-0 ps-3" 
                                       id="year"
                                       wire:model="year"
                                       min="2020" 
                                       max="2030"
                                       placeholder="Enter year (2020-2030)">
                            </div>
                            <div class="form-text">Enter a year between 2020 and 2030</div>
                            @error('year') 
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div> 
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                    <a href="{{ route('admission.all-intakes') }}" class="btn btn-outline-secondary px-4 py-2">
                        <i class="fas fa-arrow-left me-2"></i>Back to All Intakes
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                        <i class="fas fa-save me-2"></i>Create Intake
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Recent Intakes Card -->
<div class="card shadow-sm border-0">
    <!-- Recent Intakes Header - Attached to card -->
    <div class="d-flex justify-content-between align-items-center p-4 rounded-top shadow-sm" 
         style="background: linear-gradient(90deg, #f8f9fa 0%, #f1f3ff 100%); border-left: 4px solid #7367F0; border-radius: 12px 12px 0 0 !important;">
        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                 style="width: 42px; height: 42px; background-color: rgba(115, 103, 240, 0.1);">
                <i class="fas fa-clock text-primary fs-5"></i>
            </div>
            <div>
                <h4 class="mb-1 fw-bold text-dark">Recent Intakes</h4>
                <p class="text-muted mb-0 small">Last 5 created intakes</p>
            </div>
        </div>
        <a href="{{ route('admission.all-intakes') }}" 
           class="btn btn-sm fw-semibold"
           style="background-color: #ffffff; color: #7367F0; border: 1px solid #dee2e6; transition: all 0.3s ease;"
           onmouseover="this.style.backgroundColor='#7367F0'; this.style.color='white'; this.style.borderColor='#7367F0';"
           onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#7367F0'; this.style.borderColor='#dee2e6';">
           <i class="fas fa-external-link-alt me-1"></i> View All
        </a>
    </div>
    
    <!-- Recent Intakes List -->
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @php
                $recentIntakes = \App\Models\Intake::withCount('inquiries')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            @endphp
            
            @forelse($recentIntakes as $intake)
                <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-bottom">
                    <div class="d-flex align-items-start">
                        <div class="bg-light rounded-circle p-2 me-3 flex-shrink-0">
                            <i class="fas fa-calendar-check text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong class="d-block text-dark">{{ $intake->display_name }}</strong>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $intake->created_at->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                    <span class="badge bg-primary rounded-pill px-3 py-2 ms-2">
                        {{ $intake->inquiries_count }}
                    </span>
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="bg-light rounded-circle p-4 d-inline-block mb-3">
                        <i class="fas fa-inbox fa-2x text-muted"></i>
                    </div>
                    <p class="text-muted mb-0">No intakes created yet</p>
                    <small class="text-muted">New intakes will appear here</small>
                </div>
            @endforelse
        </div>
    </div>
    
    
</div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%) !important;
    }
    
    .form-group {
        margin-bottom: 1.75rem;
    }
    
    .form-label {
        margin-bottom: 0.75rem;
        color: #2c3e50;
        font-size: 0.95rem;
    }
    
    .input-group-lg .form-control,
    .input-group-lg .form-select {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #e9ecef;
        padding: 0.75rem 1rem;
    }
    
    .form-select:focus, 
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(115, 103, 240, 0.25);
        border-color: #7367F0;
    }
    
    .list-group-item {
        border: none;
        transition: all 0.2s ease;
    }
    
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
    }
    
    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
    }
    
    .card {
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }
    
    .badge {
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .form-text {
        font-size: 0.825rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }
    
    .invalid-feedback {
        font-size: 0.875rem;
    }
    
    .gap-4 {
        gap: 1.5rem !important;
    }
</style>
</div>