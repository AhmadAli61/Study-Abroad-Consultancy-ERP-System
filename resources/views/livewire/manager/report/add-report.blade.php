<div>
<div class="card border-0 shadow-lg mb-4">
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
                            Daily Work Report - Manager
                        </h2>
                        <p class="mb-0 opacity-75">
                            Submit your daily performance metrics and activities
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block me-3">
                            <h3 class="mb-0 text-dark">{{ $totalLeads }}</h3>
                            <small class="opacity-75 text-dark">Total Inquiries</small>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block">
                            <h3 class="mb-0 text-dark">{{ $hotLeads }}</h3>
                            <small class="opacity-75 text-dark">Hot Leads</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lead Statistics Cards -->
        <div class="p-4">
            <div class="row mb-4">
                <div class="col-12 mb-3">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                         style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                                <i class="fas fa-chart-bar text-primary fs-5"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold text-dark">Lead Statistics Overview</h4>
                                <p class="text-muted mb-0 small">Current lead distribution and status</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 d-flex justify-content-between flex-wrap" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
                        <div class="card text-center bg-primary" style="height: 80px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border: none;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="padding: 10px; color: white;">
                                <h3 class="fw-bold m-0 text-white">{{ $totalLeads }}</h3>
                                <h6 class="mt-1 mb-0 text-white"><strong>Total Inquiries</strong></h6>
                            </div>
                        </div>
                    </div>

                    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
                        <div class="card text-center" style="background-color: #ff5722; height: 80px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border: none;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="padding: 10px; color: white;">
                                <h3 class="fw-bold m-0 text-white">{{ $hotLeads }}</h3>
                                <h6 class="mt-1 mb-0 text-white"><strong>Hot Leads</strong></h6>
                            </div>
                        </div>
                    </div>

                    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
                        <div class="card text-center" style="background-color: #0dcaf0; height: 80px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border: none;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="padding: 10px; color: white;">
                                <h3 class="fw-bold m-0 text-white">{{ $coldLeads }}</h3>
                                <h6 class="mt-1 mb-0 text-white"><strong>Cold Leads</strong></h6>
                            </div>
                        </div>
                    </div>

                    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
                        <div class="card text-center" style="background-color: #2d2f31; height: 80px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border: none;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="padding: 10px; color: white;">
                                <h3 class="fw-bold m-0 text-white">{{ $deadLeads }}</h3>
                                <h6 class="mt-1 mb-0 text-white"><strong>Dead Leads</strong></h6>
                            </div>
                        </div>
                    </div>

                    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
                        <div class="card text-center" style="background-color: #ffc107; height: 80px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border: none;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="padding: 10px; color: white;">
                                <h3 class="fw-bold m-0 text-black">{{ $pendingLeads }}</h3>
                                <h6 class="mt-1 mb-0 text-black"><strong>Pending Leads</strong></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Form -->
            <form wire:submit.prevent="submitReport">
                <div class="row g-3">
                    <!-- Basic Information Section -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-calendar-alt me-1 text-primary"></i> Date</label>
                        <input type="date" class="form-control rounded" wire:model.defer="date" required>
                        @error('date') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-chart-bar me-1 text-primary"></i> Total Inquiries Received Today</label>
                        <input type="number" class="form-control rounded" wire:model="total_inquiries_received">
                        @error('total_inquiries_received') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Calls Section -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-phone me-1 text-primary"></i> Inbound Calls</label>
                        <input type="number" class="form-control rounded" wire:model="inbound_calls">
                        @error('inbound_calls') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-phone-alt me-1 text-primary"></i> Outbound Calls (Dial/Connect)</label>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="number" class="form-control rounded" wire:model="dial_calls" placeholder="Dial">
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control rounded" wire:model="connect_calls" placeholder="Connect">
                            </div>
                        </div>
                        @error('dial_calls') <span class="text-danger small">{{ $message }}</span> @enderror
                        @error('connect_calls') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Follow-ups Section -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-reply me-1 text-primary"></i> Interested Follow-ups</label>
                        <input type="number" class="form-control rounded" wire:model="interested_followups">
                        @error('interested_followups') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-reply me-1 text-primary"></i> Weak Follow-ups</label>
                        <input type="number" class="form-control rounded" wire:model="weak_followups">
                        @error('weak_followups') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Registration Section -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-user-plus me-1 text-primary"></i> Today's Registration</label>
                        <input type="number" class="form-control rounded" wire:model="today_registration">
                        @error('today_registration') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-clock me-1 text-primary"></i> Expected Registration</label>
                        <input type="number" class="form-control rounded" wire:model="expected_registration">
                        @error('expected_registration') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Students Section -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-users me-1 text-primary"></i> Total Students</label>
                        <input type="number" class="form-control rounded" wire:model="total_students">
                        @error('total_students') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-user-clock me-1 text-primary"></i> On Hold Students</label>
                        <input type="number" class="form-control rounded" wire:model="on_hold_students">
                        @error('on_hold_students') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Applications & Offers Section -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-paperclip me-1 text-primary"></i> Applications Processed Today</label>
                        <input type="number" class="form-control rounded" wire:model="applications_processed">
                        @error('applications_processed') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-clipboard-check me-1 text-primary"></i> Total Conditional Offers till Today</label>
                        <input type="number" class="form-control rounded" wire:model="total_conditional_offers">
                        @error('total_conditional_offers') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-user-graduate me-1 text-primary"></i> Total Students Processed</label>
                        <input type="number" class="form-control rounded" wire:model="total_students_processed">
                        @error('total_students_processed') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-award me-1 text-primary"></i> Total Unconditional Offers Till Today</label>
                        <input type="number" class="form-control rounded" wire:model="total_unconditional_offers">
                        @error('total_unconditional_offers') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-user-edit me-1 text-primary"></i> Total No. of Cas Stage Students</label>
                        <input type="number" class="form-control rounded" wire:model="cas_stage_students">
                        @error('cas_stage_students') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-passport me-1 text-primary"></i> Total No. of Visa Stage Students</label>
                        <input type="number" class="form-control rounded" wire:model="visa_stage_students">
                        @error('visa_stage_students') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Gmail Section -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-envelope me-1 text-primary"></i> Gmail Check</label>
                        <input type="text" class="form-control rounded" wire:model="gmail_check">
                        @error('gmail_check') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="fas fa-envelope-open me-1 text-primary"></i> Gmail Chase-up</label>
                        <input type="text" class="form-control rounded" wire:model="gmail_chase_up">
                        @error('gmail_chase_up') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Miscellaneous Tasks -->
                    <div class="col-12">
                        <label class="form-label fw-semibold"><i class="fas fa-tasks me-1 text-primary"></i> Miscellaneous Tasks</label>
                        <textarea class="form-control rounded" wire:model="miscellaneous_tasks" rows="3"></textarea>
                        @error('miscellaneous_tasks') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded">
                        <i class="fas fa-plus me-2"></i> Submit Report
                    </button>
                </div>
            </form>

            <!-- Important Note -->
            <div class="card mt-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);">
                <div class="card-body">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-exclamation-triangle me-2 text-warning"></i> Important Note
                    </h5>
                    <p class="text-dark mb-3">
                        <strong><em>This report must be submitted before leaving the office.</em></strong>
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 text-dark"><i class="fas fa-arrow-right me-2 text-warning"></i><em>If anyone forgets to submit it, they will be fined 250 PKR per day</em></li>
                        <li class="mb-2 text-dark"><i class="fas fa-arrow-right me-2 text-warning"></i><em>Data should be accurate and all boxes must be filled</em></li>
                        <li class="mb-2 text-dark"><i class="fas fa-arrow-right me-2 text-warning"></i><em>Calls should be as per requirement</em></li>
                        <li class="text-dark"><i class="fas fa-arrow-right me-2 text-warning"></i><em>Comments must be at least 30 words long</em></li>
                    </ul>
                </div>
            </div>
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