<!-- resources/views/livewire/admission/modal/new-admission-modal.blade.php -->
<div>
    @if($showModal)
        <!-- Backdrop with subtle animation -->
        <div class="modal-backdrop fade show" style="animation: fadeIn 0.3s ease-in-out;"></div>
        
        <!-- Modal container -->
        <div class="modal fade show d-block" tabindex="-1" style="animation: slideIn 0.3s ease-in-out;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg overflow-hidden">
                    <!-- Modal Header - Modern and Professional -->
                    <!-- Modal Header - Modern and Professional -->
 <div class="modal-header bg-gradient-primary text-white py-3 px-4">
    <div class="d-flex align-items-center w-100">
        <!-- Left Icon -->
        <div class="icon-container bg-white bg-opacity-20 p-2 rounded-circle me-3">
            <i class="fas fa-plus-circle text-primary"></i>
        </div>

        <!-- Title + Student Name -->
        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
            <div>
                <h5 class="modal-title text-white fw-semibold mb-1">Add New Application</h5>
                <span class="d-block fw-light text-white-50" style="font-size: 0.75rem;">
                    Std. Name : <span class="fw-semibold text-white">{{ $studentName }}</span>
                </span>
            </div>

            <!-- Student ID -->
            @if($studentUniqueId)
            <div class="ms-3">
                <span class="badge bg-light text-dark px-2 py-1" style="font-size: 0.75rem;">
                    #{{ $studentUniqueId }}
                </span>
            </div>
            @endif
        </div>
    </div>
</div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form wire:submit.prevent="saveNewAdmission">
                            <!-- Section Header -->
                            <div class="section-header  pb-2">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper bg-primary bg-opacity-10 p-2 rounded me-2">
                                        <i class="fas fa-university text-white fa-lg"></i>
                                    </div>
                                    <h6 class="mb-0 text-dark fw-semibold">University & Course Details</h6>
                                </div>
                            </div>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-2" 
                                               id="university_name" placeholder="University Name"
                                               wire:model="university_name" required>
                                        <label for="university_name" class="text-muted">
                                            <span class="required-field">University Name</span>
                                        </label>
                                        @error('university_name') 
                                            <div class="mt-2 text-danger small">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-2" 
                                               id="course_name" placeholder="Course Name"
                                               wire:model="course_name" required>
                                        <label for="course_name" class="text-muted">
                                            <span class="required-field">Course Name</span>
                                        </label>
                                        @error('course_name') 
                                            <div class="mt-2 text-danger small">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-2" 
                                               id="course_intake" placeholder="Course Intake"
                                               wire:model="course_intake" required>
                                        <label for="course_intake" class="text-muted">
                                            <span class="required-field">Course Intake</span>
                                        </label>
                                        @error('course_intake') 
                                            <div class="mt-2 text-danger small">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="url" class="form-control border-2" 
                                               id="course_link" placeholder="Course Link"
                                               wire:model="course_link" required>
                                        <label for="course_link" class="text-muted">
                                            <span class="required-field">Course Link</span>
                                        </label>
                                        @error('course_link') 
                                            <div class="mt-2 text-danger small">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                            </div>
                        </form>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light py-4 px-5 border-top">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4 py-2" wire:click="closeModal">
                            <i class="fas fa-times me-2"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-4 py-2 shadow-sm" 
                                wire:click="saveNewAdmission" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="fas fa-save me-2"></i> Save Admission
                            </span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                Saving...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animation and Custom CSS -->
        <style>
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            @keyframes slideIn {
                from { 
                    opacity: 0;
                    transform: translateY(-20px) scale(0.95);
                }
                to { 
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
            
            .bg-gradient-primary {
                background: linear-gradient(135deg, #7367f0) !important;
            }
            .modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5) !important; /* Standard dark backdrop */
}

.modal-backdrop.fade.show {
    opacity: 1 !important;
}
            
            .modal-footer {
                border-top: 1px solid rgba(0, 0, 0, 0.08);
            }
            
            .form-floating .form-control {
                height: calc(3.5rem + 2px);
                border-color: #e2e8f0;
                transition: all 0.2s ease;
            }
            
            .form-floating .form-control:focus {
                border-color: #7367f0;
                box-shadow: 0 0 0 0.25rem rgba(75, 108, 183, 0.15);
            }
            
            .form-floating label {
                color: #64748b;
                font-weight: 500;
            }
            
            .required-field::after {
                content: " *";
                color: #e53e3e;
            }
            
            .file-upload-card {
                border: 2px dashed #e2e8f0;
                transition: all 0.2s ease;
            }
            
            .file-upload-card:hover {
                border-color: #7367f0;
                background-color: #f8fafc;
            }
            
            .border-dashed {
                border-style: dashed !important;
            }
            
            .section-header {
                border-color: #e2e8f0 !important;
            }
            
            .icon-wrapper {
                transition: all 0.2s ease;
            }
            
            .icon-container {
                backdrop-filter: blur(10px);
            }
            
            .btn {
                transition: all 0.2s ease;
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #7367f0);
                border: none;
            }
            
            .btn-primary:hover {
                background: linear-gradient(135deg, #7367f0 100%);
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(75, 108, 183, 0.25);
            }
            
            .btn-outline-secondary:hover {
                transform: translateY(-1px);
            }
        </style>
    @endif
</div>