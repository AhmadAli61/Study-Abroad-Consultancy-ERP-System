<div>
    <!-- Decorative Elements -->
    <i class="fas fa-file-alt decorative-element decor-1"></i>
    <i class="fas fa-cloud-upload-alt decorative-element decor-2"></i>
    <i class="fas fa-file-pdf decorative-element decor-3"></i>
    <i class="fas fa-file-word decorative-element decor-4"></i>
    <i class="fas fa-camera decorative-element decor-5"></i>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
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
                            {{ $isEditMode ? 'Update Documents' : 'Upload Documents' }}
                        </h4>
                        @if($registeredInquiry)
                        <small class="text-white-50">For: {{ $registeredInquiry->student_name }} ({{ $registeredInquiry->passport_number }})</small>
                        @endif
                    </div>
                    <div class="card-body mt-4 bg-light">
                        <form wire:submit.prevent="saveDocuments" enctype="multipart/form-data">
                            <!-- SOP File Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-pdf me-2" style="color:#09122C;"></i>SOP Document</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white" 
                                     id="sopDropzone"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="sopFile" id="sopFile" class="d-none" accept=".pdf" @if($hasExistingSop && !$sopFile) disabled @endif>
                                    
                                    <label for="sopFile" class="cursor-pointer" @if($hasExistingSop && !$sopFile) style="opacity: 0.6; cursor: not-allowed;" @endif>
                                        <div class="upload-icon mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#09122C" viewBox="0 0 16 16">
                                                <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z"/>
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                            </svg>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop your SOP file here</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
                                        <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                    </label>
                                    
                                    @if($hasExistingSop && !$sopFile)
                                        <div class="alert alert-danger mt-2 p-1 small text-white bg-danger d-inline-block">
                                            <i class="fas fa-exclamation-circle me-1" style="font-size: 0.75rem;"></i>
                                            <span style="font-size: 0.75rem;">SOP exists. Delete first to upload new.</span>
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
                                
                                <!-- Selected SOP File Info -->
                                @if($sopFile)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2" style="color:#09122C;"></i>
                                                <span class="file-name fw-bold">{{ $sopFile->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($sopFile->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('sopFile', null)"></button>
                                        </div>
                                    </div>
                                @elseif($admissionForm && $admissionForm->sop_path)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
<i class="fas fa-file-pdf me-2" style="color:#09122C;"></i>
                                                <span class="file-name fw-bold">{{ basename($admissionForm->sop_path) }}</span>
                                                <span class="file-size text-muted ms-2">
                                                    @php
                                                        $size = Storage::size($admissionForm->sop_path);
                                                        echo round($size / 1024, 2) . ' KB';
                                                    @endphp
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                @error('sopFile') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>

                            <!-- Application Submission Screenshot Upload -->
                            <!-- Application Submission Screenshot Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-camera me-2" style="color:#09122C;"></i>Application Submission Screenshot</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white" 
                                     id="screenshotDropzone"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="applicationScreenshot" id="applicationScreenshot" class="d-none" accept=".pdf" @if($hasExistingScreenshot && !$applicationScreenshot) disabled @endif>
                                    
                                    <label for="applicationScreenshot" class="cursor-pointer" @if($hasExistingScreenshot && !$applicationScreenshot) style="opacity: 0.6; cursor: not-allowed;" @endif>
                                        <div class="upload-icon mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#09122C" viewBox="0 0 16 16">
                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                            </svg>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop your screenshot here</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
                                        <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                    </label>
                                    
                                    @if($hasExistingScreenshot && !$applicationScreenshot)
                                        <div class="alert alert-danger mt-2 p-1 small text-white bg-danger d-inline-block">
                                            <i class="fas fa-exclamation-circle me-1" style="font-size: 0.75rem;"></i>
                                            <span style="font-size: 0.75rem;">Screenshot exists. Delete first to upload new.</span>
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
                                
                                <!-- Selected Screenshot Info -->
                                @if($applicationScreenshot)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
<i class="fas fa-file-image me-2" style="color:#09122C;"></i>
                                                <span class="file-name fw-bold">{{ $applicationScreenshot->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($applicationScreenshot->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('applicationScreenshot', null)"></button>
                                        </div>
                                    </div>
                                @elseif($admissionForm && $admissionForm->application_submission)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
<i class="fas fa-file-image me-2" style="color:#09122C;"></i>
                                                <span class="file-name fw-bold">{{ basename($admissionForm->application_submission) }}</span>
                                                <span class="file-size text-muted ms-2">
                                                    @php
                                                        $size = Storage::size($admissionForm->application_submission);
                                                        echo round($size / 1024, 2) . ' KB';
                                                    @endphp
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                @error('applicationScreenshot') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>
                            

                            <!-- Add this section after the Application Submission Screenshot Upload section -->
<div class="mb-4 document-section p-3 rounded">
    <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-key me-2" style="color:#09122C;"></i>Application Portal Logins (Optional)</h6>
    
    <div class="form-group">
        <label for="applicationPortalLogins" class="form-label small text-muted">
            Enter login credentials (format: username_or_email/password)
        </label>
        <input type="text" 
               wire:model="applicationPortalLogins" 
               id="applicationPortalLogins" 
               class="form-control @error('applicationPortalLogins') is-invalid @enderror" 
               placeholder="e.g., email@gmail.com/password123 or username123/password123"
               aria-describedby="loginHelp">
        <div id="loginHelp" class="form-text text-muted small">
            Format: [username or email]/[password] - If provided, must include a forward slash (/).
        </div>
        @error('applicationPortalLogins') 
            <div class="invalid-feedback d-block small mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </div> 
        @enderror
    </div>
</div>
                            
                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-dark py-2" 
                                        wire:loading.attr="disabled"
                                        {{ ((!$sopFile && !($admissionForm && $admissionForm->sop_path)) || ($hasExistingSop && !$sopFile)) && 
                                           ((!$applicationScreenshot && !($admissionForm && $admissionForm->application_submission)) || ($hasExistingScreenshot && !$applicationScreenshot)) ? 'disabled' : '' }}>
                                    <span wire:loading wire:target="saveDocuments" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                    <i class="fas fa-upload me-2"></i>
                                    {{ $isEditMode ? 'Update Documents' : 'Upload Documents' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Styles + Script --}}
    <style>
        body { 
            background-color: #f8fafc; 
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(67, 97, 238, 0.05) 0%, transparent 20%), 
                radial-gradient(circle at 90% 80%, rgba(67, 97, 238, 0.05) 0%, transparent 20%); 
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); 
            overflow: hidden; 
            position: relative; 
            z-index: 2; 
        }
        
        .card-header { 
            background-color: #09122C !important; 
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
            border-color: #09122C;
        }
        
        .upload-area { 
            background-color: #f8f9fa; 
            border: 2px dashed #dee2e6; 
            transition: all 0.3s ease; 
            cursor: pointer; 
            border-radius: 8px; 
        }
        
        .upload-area.bg-white {
            background-color: #ffffff !important;
        }
        
        .upload-area:hover { 
            border-color: #09122C; 
            background-color: rgba(67, 97, 238, 0.05) !important; 
        }
        
        .selected-file { 
            border-left: 3px solid #09122C; 
            border-radius: 6px; 
            background-color: #ffffff;
        }
        
        .decorative-element { 
            position: fixed; 
            opacity: 0.1; 
            z-index: 1; 
        }
        
        .decor-1 { 
            top: 10%; 
            left: 5%; 
            font-size: 10rem; 
            color: #09122C; 
        }
        
        .decor-2 { 
            bottom: 15%; 
            right: 8%; 
            font-size: 8rem; 
            color: #09122C; 
            transform: rotate(30deg); 
        }
        
        .decor-3 { 
            top: 25%; 
            right: 10%; 
            font-size: 6rem; 
            color: #09122C; 
            transform: rotate(-15deg); 
        }
        
        .decor-4 { 
            bottom: 20%; 
            left: 12%; 
            font-size: 7rem; 
            color: #09122C; 
            transform: rotate(45deg); 
        }
        
        .decor-5 { 
            top: 60%; 
            left: 15%; 
            font-size: 5rem; 
            color: #09122C; 
            transform: rotate(-20deg); 
        }
        
        .btn-dark { 
            background-color: #09122C; 
            border-color: #09122C; 
        }
        
        .btn-dark:hover { 
            background-color: #09122C; 
            border-color: #09122C; 
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .progress-bar {
            background-color: #09122C;
        }
    </style>
</div>
