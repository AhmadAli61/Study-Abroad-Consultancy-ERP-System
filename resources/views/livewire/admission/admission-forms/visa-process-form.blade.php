<div>
    <!-- Decorative Elements -->
    <i class="fas fa-id-card decorative-element decor-1"></i>
    <i class="fas fa-file-invoice-dollar decorative-element decor-2"></i>
    <i class="fas fa-passport decorative-element decor-3"></i>
    <i class="fas fa-file-upload decorative-element decor-4"></i>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="upload-card card shadow-lg">
                    <div class="card-header text-white">
                        <h4 class="mb-0 text-white"><i class="fas fa-file-upload me-2"></i> 
                            Visa Process Documents
                        </h4>
                        @if($registered_inquiry)
                        <small class="text-white-50">For: {{ $registered_inquiry->student_name }} ({{ $registered_inquiry->passport_number }})</small>
                        @endif
                    </div>
                    <div class="card-body mt-4 bg-light">
                        <form wire:submit.prevent="submitVisaDocuments" enctype="multipart/form-data">
                            <!-- CNIC Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-id-card me-2" style="color: #673AB7;"></i> CNIC Document of Mother , Father & Applicant</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="cnic_document" id="cnicDocument" class="d-none" accept=".pdf">
                                    
                                    <label for="cnicDocument" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-id-card fa-2x" style="color: #673AB7;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop CNIC Document</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
<span class="badge bg-light text-dark">PDF only (Max 5MB)</span> <!-- Changed from "PDF, JPG, PNG" -->
                                    </label>
                                    
                                    <div x-show="isUploading" class="mt-3">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                 role="progressbar" 
                                                 :style="`width: ${progress}%`" 
                                                 :aria-valuenow="progress" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <span x-text="progress + '%'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('cnic_document') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($cnic_document)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ $cnic_document->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($cnic_document->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('cnic_document', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_cnic_document)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_cnic_document) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('cnic_document')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Bank Statement Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-landmark me-2" style="color: #673AB7;"></i> New Bank Statement</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="bank_statement" id="bankStatement" class="d-none" accept=".pdf">
                                    <label for="bankStatement" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-landmark fa-2x" style="color: #673AB7;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Bank Statement</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
                                        <span class="badge bg-light text-dark">PDF (Max 5MB)</span>
                                    </label>
                                    
                                    <div x-show="isUploading" class="mt-3">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                 role="progressbar" 
                                                 :style="`width: ${progress}%`" 
                                                 :aria-valuenow="progress" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <span x-text="progress + '%'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('bank_statement') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($bank_statement)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ $bank_statement->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($bank_statement->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('bank_statement', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_bank_statement)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_bank_statement) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('bank_statement')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Visa History Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-passport me-2" style="color: #673AB7;"></i> Visa History</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="visa_history" id="visaHistory" class="d-none" accept=".pdf">
                                    <label for="visaHistory" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-passport fa-2x" style="color: #673AB7;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Visa History</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
<span class="badge bg-light text-dark">PDF only (Max 5MB)</span> <!-- Changed from "PDF, JPG, PNG" -->
                                    </label>
                                    
                                    <div x-show="isUploading" class="mt-3">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                 role="progressbar" 
                                                 :style="`width: ${progress}%`" 
                                                 :aria-valuenow="progress" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <span x-text="progress + '%'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('visa_history') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($visa_history)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ $visa_history->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($visa_history->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('visa_history', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_visa_history)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_visa_history) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('visa_history')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                             <!-- Visa Application Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-alt me-2" style="color: #673AB7;"></i> Visa Application</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="visa_application" id="visaApplication" class="d-none" accept=".pdf">
                                    
                                    <label for="visaApplication" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-file-alt fa-2x" style="color: #673AB7;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Visa Application</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
                                        <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                    </label>
                                    
                                    <div x-show="isUploading" class="mt-3">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                 role="progressbar" 
                                                 :style="`width: ${progress}%`" 
                                                 :aria-valuenow="progress" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <span x-text="progress + '%'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('visa_application') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($visa_application)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ $visa_application->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($visa_application->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('visa_application', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_visa_application)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_visa_application) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('visa_application')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Appointment Letter Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-calendar-check me-2" style="color: #673AB7;"></i> Appointment Letter</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="appointment_letter" id="appointmentLetter" class="d-none" accept=".pdf">
                                    
                                    <label for="appointmentLetter" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-calendar-check fa-2x" style="color: #673AB7;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Appointment Letter</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
                                        <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                    </label>
                                    
                                    <div x-show="isUploading" class="mt-3">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                 role="progressbar" 
                                                 :style="`width: ${progress}%`" 
                                                 :aria-valuenow="progress" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <span x-text="progress + '%'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('appointment_letter') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($appointment_letter)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ $appointment_letter->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($appointment_letter->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('appointment_letter', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_appointment_letter)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_appointment_letter) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('appointment_letter')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>
<!-- Add this section before the submit button -->
<div class="mb-4 document-section p-3 rounded">
    <h6 class="mb-3 fw-bold text-dark">
        <i class="fas fa-user-lock me-2" style="color: #673AB7;"></i> Enrollment Logins (Optional)
    </h6>
   
    <div class="form-group">
        <label for="enrollmentLogins" class="form-label small text-muted">
            Enter login credentials (format: username_or_email/password)
        </label>
        <input 
            type="text" 
            wire:model="enrollment_logins" 
            class="form-control @error('enrollment_logins') is-invalid @enderror" 
            placeholder="e.g., email@gmail.com/password123 or username123/password123"
        >
        <div id="loginHelp" class="form-text text-muted small">
            Format: [username or email]/[password] - If provided, must include a forward slash (/).
        </div>
        @error('enrollment_logins') 
            <div class="invalid-feedback d-block small mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </div> 
        @enderror
    </div>
</div>
<!-- Add this section after the Enrollment Logins field -->
<div class="mb-4 document-section p-3 rounded">
    <h6 class="mb-3 fw-bold text-dark">
        <i class="fas fa-link me-2" style="color: #673AB7;"></i> Visa Application Links (Optional)
    </h6>
   
    <div class="form-group">
        <label for="visaApplicationLinks" class="form-label small text-muted">
            Enter visa application links with password (format: URL,password)
        </label>
        <textarea 
            wire:model="visa_application_links" 
            class="form-control @error('visa_application_links') is-invalid @enderror" 
            placeholder="e.g., https://visa-application-portal.com/application/12345,password123"
            rows="3"
        ></textarea>
        <div id="linksHelp" class="form-text text-muted small">
            Format: [URL],[password] - One entry per line. Example: https://visa-portal.com/app/12345,myPassword
        </div>
        @error('visa_application_links') 
            <div class="invalid-feedback d-block small mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </div> 
        @enderror
    </div>
</div>
                           
                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary py-2" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="submitVisaDocuments">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Submit Documents
                                    </span>
                                    <span wire:loading wire:target="submitVisaDocuments">
                                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                        Processing...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(103, 58, 183, 0.03) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(103, 58, 183, 0.03) 0%, transparent 20%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        .is-invalid {
    border-color: #dc3545 !important;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
}

.badge.bg-secondary {
    background-color: #6c757d !important;
    font-size: 0.7rem;
}
        .upload-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        
        .card-header {
            background: linear-gradient(135deg, #673AB7, #512DA8, #673AB7) !important;
            padding: 1.5rem;
        }
        
        .card-body.bg-light {
            background-color: #f8f9fa !important;
            padding: 2rem;
        }
        
        .document-section {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .document-section:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-color: #673AB7;
        }
        
        .upload-area {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }
        
        .upload-area.bg-white {
            background-color: #ffffff !important;
        }
        
        .upload-area:hover {
            border-color: #673AB7;
            background-color: rgba(103, 58, 183, 0.05) !important;
        }
        
        .selected-file {
            border-left: 3px solid #673AB7;
            border-radius: 6px;
            background-color: #ffffff;
        }
        
        .decorative-element {
            position: fixed;
            opacity: 0.05;
            z-index: 1;
            color: #673AB7;
        }
        
        .decor-1 {
            top: 15%;
            left: 5%;
            font-size: 12rem;
        }
        
        .decor-2 {
            bottom: 10%;
            right: 5%;
            font-size: 10rem;
            transform: rotate(15deg);
        }
        
        .decor-3 {
            top: 20%;
            right: 8%;
            font-size: 8rem;
            transform: rotate(-10deg);
        }
        
        .decor-4 {
            bottom: 25%;
            left: 10%;
            font-size: 9rem;
            transform: rotate(25deg);
        }
        
        .btn-primary {
            background-color: #673AB7;
            border-color: #673AB7;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            background-color: #5E35B1;
            border-color: #5E35B1;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .progress-bar {
            background-color: #673AB7;
        }
    </style>

   
</div>