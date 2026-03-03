<div>
    <!-- Decorative Elements -->
    <i class="fas fa-check-circle decorative-element decor-1"></i>
    <i class="fas fa-envelope decorative-element decor-2"></i>
    <i class="fas fa-laptop decorative-element decor-3"></i>
    <i class="fas fa-handshake decorative-element decor-4"></i>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="options-card card shadow-lg">
                    <div class="card-header text-white">
                        <h4 class="mb-0 text-white"><i class="fas fa-bell me-2 text-white"></i> 
                            Confirm Notification Channels
                        </h4>
                    </div>
                    <div class="card-body mt-4">
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form wire:submit.prevent="submitForm">
                            <!-- Checkbox Options -->
                            <div class="mb-4">
                                <h5 class="mb-3 text-teal-800">Verify conditional offer notification channels:</h5>
                                
                                <div class="option-item p-3 mb-3 rounded">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               wire:model="partner_info" 
                                               id="partnerCheck">
                                        <label class="form-check-label" for="partnerCheck">
                                            <i class="fas fa-handshake me-2 text-teal-600"></i> Partner
                                        </label>
                                        <p class="text-muted small ms-4 mt-1">The offer is shared with partner ?</p>
                                    </div>
                                </div>
                                
                                <div class="option-item p-3 mb-3 rounded">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               wire:model="application_portal_info" 
                                               id="portalCheck">
                                        <label class="form-check-label" for="portalCheck">
                                            <i class="fas fa-laptop me-2 text-blue-600"></i> Application Portal
                                        </label>
                                        <p class="text-muted small ms-4 mt-1">Applicant portal created & outstanding documents uploaded ?</p>
                                    </div>
                                </div>
                                
                                <div class="option-item p-3 mb-3 rounded">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               wire:model="student_gmail_info" 
                                               id="gmailCheck">
                                        <label class="form-check-label" for="gmailCheck">
                                            <i class="fas fa-envelope me-2 text-cyan-600"></i> Student Gmail
                                        </label>
                                        <p class="text-muted small ms-4 mt-1">Outstanding documents sent to university ? </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Conditional Document Upload Field -->
<div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-upload me-2 text-teal-600"></i>Conditional Document Upload</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white" 
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="conditional_document" id="conditionalDocument" class="d-none" accept=".pdf" @if($hasExistingConditionalDocument && !$conditional_document) disabled @endif>
                                    
                                    <label for="conditionalDocument" class="cursor-pointer" @if($hasExistingConditionalDocument && !$conditional_document) style="opacity: 0.6; cursor: not-allowed;" @endif>
                                        <div class="upload-icon mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#27391C" viewBox="0 0 16 16">
                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                            </svg>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop your document here</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
                                        <span class="badge bg-light text-dark">PDF Only (Max 5MB)</span>
                                    </label>
                                    
                                    @if($hasExistingConditionalDocument && !$conditional_document)
                                        <div class="alert alert-danger mt-2 p-1 small text-white bg-danger d-inline-block">
                                            <i class="fas fa-exclamation-circle me-1" style="font-size: 0.75rem;"></i>
                                            <span style="font-size: 0.75rem;">Document exists. Delete first to upload new.</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Upload Progress -->
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
                                
                                <!-- Selected Document Info -->
                                @if($conditional_document)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-teal-600"></i>
                                                <span class="file-name fw-bold">{{ $conditional_document->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($conditional_document->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('conditional_document', null)"></button>
                                        </div>
                                    </div>
                                @elseif($admissionForm && $admissionForm->conditional_document)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-teal-600"></i>
                                                <span class="file-name fw-bold">{{ basename($admissionForm->conditional_document) }}</span>
                                                <span class="file-size text-muted ms-2">
                                                    @php
                                                        $size = Storage::size($admissionForm->conditional_document);
                                                        echo round($size / 1024, 2) . ' KB';
                                                    @endphp
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                @error('conditional_document') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>
                            <!-- Application Portal Logins Section -->
<!-- Application Portal Logins Section -->
<div class="mb-4 document-section p-3 rounded">
    <h6 class="mb-3 fw-bold text-dark">
        <i class="fas fa-key me-2 text-teal-600"></i>Application Portal Logins 
        @if(!$hasExistingPortalLogins)
            <span class="text-danger">*</span>
        @endif
    </h6>
    
    <div class="form-group">
        <label for="applicationPortalLogins" class="form-label small text-muted">
            Enter login credentials (format: username_or_email/password)
        </label>
        <input type="text" 
               wire:model="applicationPortalLogins" 
               id="applicationPortalLogins" 
               class="form-control @error('applicationPortalLogins') is-invalid @enderror" 
               placeholder="e.g., email@gmail.com/password123 or username123/password123"
               aria-describedby="loginHelp"
               @if($hasExistingPortalLogins) disabled @else required @endif>
        <div id="loginHelp" class="form-text text-muted small">
            Format: [username or email]/[password] - Must include a forward slash (/).
        </div>
        @if($hasExistingPortalLogins)
            <p class="text-dark small mt-1">
                <i class="fas fa-info-circle me-1"></i>
                Portal logins already provided and cannot be modified.
            </p>
        @endif
        @error('applicationPortalLogins') 
            <div class="invalid-feedback d-block small mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </div> 
        @enderror
    </div>
</div>
                            
                            <!-- Submit Button -->
                           <!-- Submit Button -->
<div class="d-grid mt-4">
    <button type="submit" class="btn btn-teal py-2" 
            wire:loading.attr="disabled">
        <span wire:loading wire:target="submitForm" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        <i class="fas fa-save me-2"></i>
        Save Preferences
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
            background-color: #f0fdfa;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(13, 148, 136, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(8, 145, 178, 0.05) 0%, transparent 20%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .options-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.95);
        }
        
        .options-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 65%, rgba(13, 148, 136, 0.03) 65%);
            z-index: -1;
            transform: rotate(15deg);
        }
        
        .card-header {
            background: linear-gradient(135deg, #506643, #27391C) !important;
        }
        
        .option-item {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .option-item:hover {
            background-color: rgba(204, 251, 241, 0.3);
            border-left-color: #27391C;
        }
        
        .form-check-input:checked {
            background-color: #27391C;
            border-color: #27391C;
        }
        
        .btn-teal {
            background-color: #27391C;
            border-color: #27391C;
            color: white;
        }
        
        .btn-teal:hover {
            background-color: #27391C;
            border-color: #27391C;
            color: white;
        }
        
        .decorative-element {
            position: fixed;
            opacity: 0.08;
            z-index: 1;
            color: #27391C;
        }
        
        .decor-1 {
            top: 10%;
            left: 5%;
            font-size: 10rem;
        }
        
        .decor-2 {
            bottom: 15%;
            right: 8%;
            font-size: 8rem;
            color: #27391C;
            transform: rotate(30deg);
        }
        
        .decor-3 {
            top: 25%;
            right: 10%;
            font-size: 6rem;
            color: #27391C;
            transform: rotate(-15deg);
        }
        
        .decor-4 {
            bottom: 20%;
            left: 12%;
            font-size: 7rem;
            color: #27391C;
            transform: rotate(45deg);
        }
        
        .text-teal-600 {
            color: #27391C;
        }
        
        .text-blue-600 {
            color: #27391C;
        }
        
        .text-cyan-600 {
            color: #27391C;
        }
        
        .text-teal-800 {
            color: #27391C;
        }
        
        .form-check-label {
            font-weight: 500;
            font-size: 1.05rem;
        }
        
        /* New styles for upload section */
        .document-section {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }
        
        .document-section:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-color: #27391C;
        }
        
        .upload-area { 
            background-color: #f8f9fa; 
            border: 2px dashed #dee2e6; 
            transition: all 0.3s ease; 
            cursor: pointer; 
            border-radius: 8px; 
        }
        
        .upload-area:hover { 
            border-color: #27391C; 
            background-color: rgba(39, 57, 28, 0.05) !important; 
        }
        
        .selected-file { 
            border-left: 3px solid #27391C; 
            border-radius: 6px; 
            background-color: #ffffff;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .progress-bar {
            background-color: #27391C;
        }
    </style>
</div>