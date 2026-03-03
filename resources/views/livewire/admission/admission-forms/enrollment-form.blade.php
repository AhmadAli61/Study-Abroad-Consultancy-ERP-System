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
                            Enrollment Documents Upload
                        </h4>
                        @if($registered_inquiry)
                        <small class="text-white-50">For: {{ $registered_inquiry->student_name }} ({{ $registered_inquiry->passport_number }})</small>
                        @endif
                    </div>
                    <div class="card-body mt-4 bg-light">
                        <form wire:submit.prevent="submitEnrollmentDocuments" enctype="multipart/form-data">
                           

                            <!-- Decision Letter Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-signature me-2" style="color: #009688;"></i> Decision Letter</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="decision_letter" id="decisionLetter" class="d-none" accept=".pdf">
                                    
                                    <label for="decisionLetter" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-file-signature fa-2x" style="color: #009688;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Decision Letter</h6>
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
                                @error('decision_letter') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($decision_letter)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ $decision_letter->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($decision_letter->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('decision_letter', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_decision_letter)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_decision_letter) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('decision_letter')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- E-Visa Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-invoice me-2" style="color: #009688;"></i> E-Visa</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="e_visa" id="eVisa" class="d-none" accept=".pdf">
                                    
                                    <label for="eVisa" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-file-invoice fa-2x" style="color: #009688;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop E-Visa</h6>
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
                                @error('e_visa') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($e_visa)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ $e_visa->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($e_visa->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('e_visa', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_e_visa)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_e_visa) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('e_visa')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Student ID Card Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-id-card me-2" style="color: #009688;"></i> Student ID Card</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:model="student_id_card" id="studentIdCard" class="d-none" accept=".pdf,.jpg,.jpeg,.png">
                                    
                                    <label for="studentIdCard" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-id-card fa-2x" style="color: #009688;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Student ID Card</h6>
                                        <p class="text-muted small mb-2">or click to browse</p>
                                        <span class="badge bg-light text-dark">PDF, JPG, PNG (Max 5MB)</span>
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
                                @error('student_id_card') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($student_id_card)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ $student_id_card->getClientOriginalName() }}</span>
                                                <span class="file-size text-muted ms-2">{{ round($student_id_card->getSize() / 1024, 2) }} KB</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('student_id_card', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_student_id_card)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file me-2 text-primary"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_student_id_card) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('student_id_card')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-dark py-2" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="submitEnrollmentDocuments">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Submit Documents
                                    </span>
                                    <span wire:loading wire:target="submitEnrollmentDocuments">
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
                radial-gradient(circle at 10% 20%, rgba(0, 150, 136, 0.03) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(0, 150, 136, 0.03) 0%, transparent 20%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .upload-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        
        .card-header {
            background: linear-gradient(135deg, #009688, #00796b, #009688) !important;
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
            border-color: #009688;
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
            border-color: #009688;
            background-color: rgba(0, 150, 136, 0.05) !important;
        }
        
        .selected-file {
            border-left: 3px solid #009688;
            border-radius: 6px;
            background-color: #ffffff;
        }
        
        .decorative-element {
            position: fixed;
            opacity: 0.05;
            z-index: 1;
            color: #009688;
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
        
        .btn-dark {
            background-color: #009688;
            border-color: #009688;
            letter-spacing: 0.5px;
        }
        
        .btn-dark:hover {
            background-color: #00897b;
            border-color: #00897b;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .progress-bar {
            background-color: #009688;
        }
    </style>
</div>