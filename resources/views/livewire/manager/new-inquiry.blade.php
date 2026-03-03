<div><div class="card border-0 shadow-lg mb-4">
    <div class="card-body p-0">
        <!-- Success/Error Messages -->
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show m-3 rounded" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3 rounded" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Form Header with Gradient -->
        <div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">
            <div class="card-body py-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2 text-white">
                            <i class="fas fa-file-alt me-2"></i>
                            Add New Inquiry
                        </h2>
                        <p class="mb-0 opacity-75">
                            Complete the form below to add a new student inquiry
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block">
                            <h4 class="mb-0 text-dark"><i class="fas fa-headset me-1"></i></h4>
                            <small class="opacity-75 text-dark">New Lead</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-4">
            <form wire:submit.prevent="saveInquiry">
                <div class="row g-3">
                    <!-- Personal Information Section -->
                    <div class="col-12 mb-3">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                                    <i class="fas fa-user text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold text-dark">Personal Information</h4>
                                    <p class="text-muted mb-0 small">Student's basic details</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-user me-1 text-secondary"></i> Name</label>
                        <input type="text" class="form-control rounded" wire:model.defer="name" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-phone me-1 text-secondary"></i> Contact
                        </label>
                        <input type="text"
                               class="form-control rounded"
                               wire:model.defer="phone_number"
                               maxlength="12"
                               placeholder="92XXXXXXXXXX"
                               pattern="92[0-9]{10}"
                               required>
                        @error('phone_number') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-phone-alt me-1 text-secondary"></i> Contact (Additional)</label>
                        <input type="text" class="form-control rounded" wire:model.defer="phone_number2">
                        @error('phone_number2') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-envelope me-1 text-secondary"></i> Email</label>
                        <input type="email" class="form-control rounded" wire:model.defer="email">
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Inquiry Details Section -->
                    <div class="col-12 mb-3 mt-4">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1)">
                                    <i class="fas fa-info-circle text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold text-dark">Inquiry Details</h4>
                                    <p class="text-muted mb-0 small">Student's academic and preference information</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-tag me-1 text-secondary"></i> Type</label>
                        <select class="form-control rounded" wire:model.defer="type">
                            <option value=""> Select Type </option>
                            <option value="Referral">Referral</option>
                            <option value="Meta Leads W">Meta Leads W</option>
                            <option value="Google Leads">Google Leads</option>
                        </select>
                        @error('type') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-graduation-cap me-1 text-secondary"></i> Education</label>
                        <input type="text" class="form-control rounded" wire:model.defer="study_course">
                        @error('study_course') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> City</label>
                        <input type="text" class="form-control rounded" wire:model.defer="budget">
                        @error('budget') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-globe me-1 text-secondary"></i> Country</label>
                        <input type="text" class="form-control rounded" wire:model.defer="country">
                        @error('country') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-lightbulb me-1 text-secondary"></i> Future Plan</label>
                        <input type="text" class="form-control rounded" wire:model.defer="plan">
                        @error('future plan') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-align-left me-1 text-secondary"></i> English Test</label>
                        <input type="text" class="form-control rounded" wire:model.defer="extra">
                        @error('english test') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Additional Information Section -->
                    <div class="col-12 mb-3 mt-4">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 42px; height: 42px; background-color:rgba(13,110,253,0.1);">
                                    <i class="fas fa-comments text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold text-dark">Additional Information</h4>
                                    <p class="text-muted mb-0 small">Remarks and notes</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold"><i class="fas fa-reply me-1 text-secondary"></i> Remarks</label>
                        <textarea class="form-control rounded" wire:model.defer="response" rows="3"></textarea>
                        @error('remarks') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded">
                        <i class="fas fa-plus me-2"></i> Add Inquiry
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.card {
    border-radius: 12px;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #7367F0;
    box-shadow: 0 0 0 0.2rem rgba(115, 103, 240, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #7367F0 0%, #9e95f5 100%);
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(115, 103, 240, 0.3);
}
</style>
</div>