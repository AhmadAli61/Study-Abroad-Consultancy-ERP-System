<div>
    @if(session()->has('application_success'))
    <div class="alert-container position-fixed top-0 end-0 m-3" style="z-index: 9999; max-width: 420px;">
        <div class="alert alert-success alert-dismissible fade show p-0" role="alert" style="border: none; background: transparent;">
            <div class="success-card">
                <div class="success-header">
                    <div class="success-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 class="success-title">Application Created Successfully!</h3>
                    <button type="button" class="success-close" data-bs-dismiss="alert" aria-label="Close">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
                <div class="success-body">
                    <p class="success-message">{{ session('application_success.message') }}</p>
                    
                    <div class="success-details">
                        <div class="detail-item">
                            <span class="detail-label">Student:</span>
                            <span class="detail-value">{{ session('application_success.student_name') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Registration ID:</span>
                            <span class="detail-value id-highlight">{{ session('application_success.unique_id') }}</span>
                        </div>
                    </div>
                    
                    <div class="status-indicator">
                        <div class="status-dot"></div>
                        <span class="status-text">The application is now in Under Assessment</span>
                    </div>
                </div>
                <div class="success-progress">
                    <div class="progress-bar-success"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .alert-container {
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    .success-card {
        background: linear-gradient(135deg, #f8fff9 0%, #fff 100%);
        border: 1px solid rgba(40, 167, 69, 0.15);
        border-left: 4px solid #28a745;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.15);
        overflow: hidden;
        animation: slideInRight 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
    }

    .success-header {
        display: flex;
        align-items: center;
        padding: 20px 20px 0;
        gap: 12px;
    }

    .success-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(40, 167, 69, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #28a745;
        flex-shrink: 0;
        animation: successPulse 2s infinite;
    }

    .success-title {
        font-size: 18px;
        font-weight: 600;
        color: #28a745;
        margin: 0;
        flex: 1;
    }

    .success-close {
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .success-close:hover {
        background: rgba(108, 117, 125, 0.1);
        color: #495057;
        transform: rotate(90deg);
    }

    .success-body {
        padding: 16px 20px 20px;
    }

    .success-message {
        color: #495057;
        margin: 0 0 16px;
        line-height: 1.5;
        font-weight: 500;
    }

    .success-details {
        background: rgba(40, 167, 69, 0.05);
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 16px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-label {
        font-weight: 600;
        color: #2d3748;
        font-size: 14px;
    }

    .detail-value {
        color: #4a5568;
        font-size: 14px;
    }

    .id-highlight {
        background: rgba(40, 167, 69, 0.1);
        padding: 2px 8px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #28a745;
    }

    .status-indicator {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        background: rgba(255, 193, 7, 0.08);
        border: 1px solid rgba(255, 193, 7, 0.2);
        border-radius: 8px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ffc107;
        animation: statusPulse 1.5s infinite;
    }

    .status-text {
        color: #856404;
        font-size: 13px;
        font-weight: 500;
    }

    .success-progress {
        height: 4px;
        background: rgba(40, 167, 69, 0.1);
        overflow: hidden;
    }

    .progress-bar-success {
        height: 100%;
        width: 100%;
        background: linear-gradient(90deg, #28a745, #34ce57);
        animation: progressSuccess 5s linear forwards;
        transform-origin: left;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes successPulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
        }
    }

    @keyframes statusPulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }

    @keyframes progressSuccess {
        from {
            transform: scaleX(1);
        }
        to {
            transform: scaleX(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .alert-container {
            max-width: calc(100vw - 24px) !important;
            margin: 12px !important;
        }
        
        .success-header {
            padding: 16px 16px 0;
        }
        
        .success-body {
            padding: 12px 16px 16px;
        }
        
        .detail-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
    }
    </style>

    <script>
    // Auto-dismiss after 5 seconds with progress bar
    setTimeout(function() {
        const alert = document.querySelector('.alert.alert-success');
        if (alert) {
            // Trigger Bootstrap's close method
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);

    // Pause progress bar on hover
    document.addEventListener('DOMContentLoaded', function() {
        const successCard = document.querySelector('.success-card');
        const progressBar = document.querySelector('.progress-bar-success');
        
        if (successCard && progressBar) {
            let animationPaused = false;
            
            successCard.addEventListener('mouseenter', function() {
                if (!animationPaused) {
                    progressBar.style.animationPlayState = 'paused';
                    animationPaused = true;
                }
            });
            
            successCard.addEventListener('mouseleave', function() {
                if (animationPaused) {
                    progressBar.style.animationPlayState = 'running';
                    animationPaused = false;
                }
            });
        }
    });

    // Update the auto-dismiss animation to target the correct element
    document.querySelector('.success-close')?.addEventListener('click', function() {
        const progressBar = document.querySelector('.progress-bar-success');
        if (progressBar) {
            progressBar.style.animationPlayState = 'paused';
        }
    });
    </script>
    @endif

    @if(session()->has('application_error'))
    <div class="alert-container position-fixed top-0 end-0 m-3" style="z-index: 9999; max-width: 420px;">
        <div class="alert alert-danger alert-dismissible fade show p-0" role="alert" style="border: none; background: transparent;">
            <div class="alert-card">
                <div class="alert-header">
                    <div class="alert-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="alert-title">Application Limit Reached</h3>
                    <button type="button" class="alert-close" data-bs-dismiss="alert" aria-label="Close">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
                <div class="alert-body">
                    <p class="alert-message">{{ session('application_error') }}</p>
                    <div class="alert-info">
                        <div class="info-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M8 5.5V8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M8 10.5H8.005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="info-text">Maximum 3 applications allowed per student</span>
                    </div>
                </div>
                <div class="alert-progress">
                    <div class="progress-bar"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .alert-container {
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    .alert-card {
        background: linear-gradient(135deg, #fff9f9 0%, #fff 100%);
        border: 1px solid rgba(220, 53, 69, 0.15);
        border-left: 4px solid #dc3545;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(220, 53, 69, 0.15);
        overflow: hidden;
        animation: slideInRight 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
    }

    .alert-header {
        display: flex;
        align-items: center;
        padding: 20px 20px 0;
        gap: 12px;
    }

    .alert-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(220, 53, 69, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dc3545;
        flex-shrink: 0;
        animation: pulse 2s infinite;
    }

    .alert-title {
        font-size: 18px;
        font-weight: 600;
        color: #dc3545;
        margin: 0;
        flex: 1;
    }

    .alert-close {
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .alert-close:hover {
        background: rgba(108, 117, 125, 0.1);
        color: #495057;
        transform: rotate(90deg);
    }

    .alert-body {
        padding: 16px 20px 20px;
    }

    .alert-message {
        color: #495057;
        margin: 0 0 16px;
        line-height: 1.5;
    }

    .alert-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        background: rgba(255, 193, 7, 0.08);
        border: 1px solid rgba(255, 193, 7, 0.2);
        border-radius: 8px;
    }

    .info-icon {
        color: #ffc107;
        flex-shrink: 0;
    }

    .info-text {
        color: #856404;
        font-size: 14px;
        font-weight: 500;
    }

    .alert-progress {
        height: 4px;
        background: rgba(220, 53, 69, 0.1);
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        width: 100%;
        background: linear-gradient(90deg, #dc3545, #e4606d);
        animation: progress 10s linear forwards;
        transform-origin: left;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
        }
    }

    @keyframes progress {
        from {
            transform: scaleX(1);
        }
        to {
            transform: scaleX(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .alert-container {
            max-width: calc(100vw - 24px) !important;
            margin: 12px !important;
        }
            
        
        .alert-header {
            padding: 16px 16px 0;
        }
        
        .alert-body {
            padding: 12px 16px 16px;
        }
    }
    </style>

    <script>
    // Auto-dismiss after 10 seconds with progress bar
    setTimeout(function() {
        const alert = document.querySelector('.alert.alert-danger');
        if (alert) {
            // Trigger Bootstrap's close method
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 10000);

    // Pause progress bar on hover
    document.addEventListener('DOMContentLoaded', function() {
        const alertCard = document.querySelector('.alert-card');
        const progressBar = document.querySelector('.progress-bar');
        
        if (alertCard && progressBar) {
            let animationPaused = false;
            
            alertCard.addEventListener('mouseenter', function() {
                if (!animationPaused) {
                    progressBar.style.animationPlayState = 'paused';
                    animationPaused = true;
                }
            });
            
            alertCard.addEventListener('mouseleave', function() {
                if (animationPaused) {
                    progressBar.style.animationPlayState = 'running';
                    animationPaused = false;
                }
            });
        }
    });

    // Update the auto-dismiss animation to target the correct element
    document.querySelector('.alert-close')?.addEventListener('click', function() {
        const progressBar = document.querySelector('.progress-bar');
        if (progressBar) {
            progressBar.style.animationPlayState = 'paused';
        }
    });
    </script>
    @endif

    @if($showModal)
        <div class="modal-backdrop fade show" style="background-color: rgba(0, 0, 0, 0.5)"></div>

        <!-- Backdrop with subtle animation -->
        <div class="modal-backdrop fade show" style="animation: fadeIn 0.3s ease-in-out;"></div>
        
        <!-- Modal container -->
        <div class="modal fade show d-block" tabindex="-1" style="animation: slideIn 0.3s ease-in-out;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg overflow-hidden">
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
                        <form wire:submit.prevent="saveNewApplication">
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
                                wire:click="saveNewApplication" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="fas fa-save me-2"></i> Save Application
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

    <style>
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #28a745;
        }

        .alert-success .btn-close {
            color: #155724;
        }
    </style>
</div>