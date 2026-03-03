<div>
    <!-- Decorative Elements -->
    <i class="fas fa-file-alt decorative-element decor-1"></i>
    <i class="fas fa-cloud-upload-alt decorative-element decor-2"></i>
    <i class="fas fa-file-pdf decorative-element decor-3"></i>
    <i class="fas fa-file-word decorative-element decor-4"></i>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="upload-card card shadow-lg">
                    <div class="card-header text-white">
                        <h4 class="mb-0 text-white"><i class="fas fa-file-upload me-2 text-white"></i> 
                            Upload CAS Documents
                        </h4>
                    </div>
                    <div class="card-body bg-light">
                        <form wire:submit.prevent="saveCasDocuments" enctype="multipart/form-data">
                            <!-- Fee Voucher Upload -->
                            <div class="mb-4 document-section p-3 rounded mt-3">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-receipt me-2" style="color: #C69749;"></i> Fee Payment Voucher</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     id="feeVoucherDropzone"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                     wire:ignore>
                                    <input type="file" wire:model="fee_voucher" id="feeVoucher" class="d-none" accept=".pdf">
                                    
                                    <label for="feeVoucher" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-receipt fa-2x" style="color: #C69749;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Fee Voucher</h6>
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
                                @error('fee_voucher') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($fee_voucher)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ $fee_voucher->getClientOriginalName() }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('fee_voucher', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_fee_voucher)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_fee_voucher) }}</span>
                                            </div>
                                            <div>
                                                <a href="{{ Storage::url($existing_fee_voucher) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deleteDocument('fee_voucher')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Bank Statement Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-landmark me-2" style="color: #C69749;"></i> Bank Statement</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     id="bankStatementDropzone"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                     wire:ignore>
                                    <input type="file" wire:model="bank_statement" id="bankStatement" class="d-none" accept=".pdf">
                                    
                                    <label for="bankStatement" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-landmark fa-2x" style="color: #C69749;"></i>
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
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ $bank_statement->getClientOriginalName() }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('bank_statement', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_bank_statement)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_bank_statement) }}</span>
                                            </div>
                                            <div>
                                                <a href="{{ Storage::url($existing_bank_statement) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deleteDocument('bank_statement')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Interview Pass Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-user-check me-2" style="color: #C69749;"></i> Interview Confirmation Document</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     id="interviewPassDropzone"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                     wire:ignore>
                                    <input type="file" wire:model="interview_pass" id="interviewPass" class="d-none" accept=".pdf">
                                    
                                    <label for="interviewPass" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-user-check fa-2x" style="color: #C69749;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Interview Confirmation</h6>
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
                                @error('interview_pass') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($interview_pass)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ $interview_pass->getClientOriginalName() }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('interview_pass', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_interview_pass)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_interview_pass) }}</span>
                                            </div>
                                            <div>
                                                <a href="{{ Storage::url($existing_interview_pass) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deleteDocument('interview_pass')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- TB Test Upload -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-medical me-2" style="color: #C69749;"></i> TB Test Results</h6>
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     id="tbTestDropzone"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                     wire:ignore>
                                    <input type="file" wire:model="tb_test" id="tbTest" class="d-none" accept=".pdf">
                                    
                                    <label for="tbTest" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-file-medical fa-2x" style="color: #C69749;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop TB Test Results</h6>
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
                                @error('tb_test') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($tb_test)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ $tb_test->getClientOriginalName() }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('tb_test', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_tb_test)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_tb_test) }}</span>
                                            </div>
                                            <div>
                                                <a href="{{ Storage::url($existing_tb_test) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deleteDocument('tb_test')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                                                            <div class="mb-4 document-section p-3 rounded">
                                    <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-certificate me-2" style="color: #C69749;"></i> Birth Certificate (Optional)</h6>
                                    <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                        id="birthCertificateDropzone"
                                        x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        wire:ignore>
                                        <input type="file" wire:model="birth_certificate" id="birthCertificate" class="d-none" accept=".pdf">
                                        
                                        <label for="birthCertificate" class="cursor-pointer">
                                            <div class="upload-icon mb-2">
                                                <i class="fas fa-certificate fa-2x" style="color: #C69749;"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Birth Certificate</h6>
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
                                    @error('birth_certificate') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                    
                                    @if($birth_certificate)
                                        <div class="selected-file alert alert-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $birth_certificate->getClientOriginalName() }}</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('birth_certificate', null)"></button>
                                            </div>
                                        </div>
                                    @elseif($existing_birth_certificate)
                                        <div class="selected-file alert alert-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ basename($existing_birth_certificate) }}</span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Parental Consent Letter Upload -->
                                <div class="mb-4 document-section p-3 rounded">
                                    <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-contract me-2" style="color: #C69749;"></i> Parental Consent Letter (Optional)</h6>
                                    <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                        id="parentalConsentDropzone"
                                        x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        wire:ignore>
                                        <input type="file" wire:model="parental_consent_letter" id="parentalConsent" class="d-none" accept=".pdf">
                                        
                                        <label for="parentalConsent" class="cursor-pointer">
                                            <div class="upload-icon mb-2">
                                                <i class="fas fa-file-contract fa-2x" style="color: #C69749;"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Parental Consent Letter</h6>
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
                                    @error('parental_consent_letter') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                    
                                    @if($parental_consent_letter)
                                        <div class="selected-file alert alert-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $parental_consent_letter->getClientOriginalName() }}</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('parental_consent_letter', null)"></button>
                                            </div>
                                        </div>
                                    @elseif($existing_parental_consent_letter)
                                        <div class="selected-file alert alert-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ basename($existing_parental_consent_letter) }}</span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Funds Source Upload -->
                                <div class="mb-4 document-section p-3 rounded">
                                    <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-money-bill-wave me-2" style="color: #C69749;"></i> Funds Source Document (Optional)</h6>
                                    <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                        id="fundsSourceDropzone"
                                        x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        wire:ignore>
                                        <input type="file" wire:model="funds_source" id="fundsSource" class="d-none" accept=".pdf">
                                        
                                        <label for="fundsSource" class="cursor-pointer">
                                            <div class="upload-icon mb-2">
                                                <i class="fas fa-money-bill-wave fa-2x" style="color: #C69749;"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Funds Source Document</h6>
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
                                    @error('funds_source') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                    
                                    @if($funds_source)
                                        <div class="selected-file alert alert-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $funds_source->getClientOriginalName() }}</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('funds_source', null)"></button>
                                            </div>
                                        </div>
                                    @elseif($existing_funds_source)
                                        <div class="selected-file alert alert-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ basename($existing_funds_source) }}</span>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Add this section before the submit button -->
<div class="mb-4 document-section p-3 rounded">
    <h6 class="mb-3 fw-bold text-dark">
        <i class="fas fa-shield-alt me-2" style="color: #C69749;"></i> CAS Shield Logins (Optional)
    </h6>
   
    <div class="form-group">
          <label for="applicationPortalLogins" class="form-label small text-muted">
            Enter login credentials (format: username_or_email/password)
        </label>
        <input 
            type="text" 
            wire:model="cas_shield_logins" 
               class="form-control @error('applicationPortalLogins') is-invalid @enderror" 
            placeholder="e.g., email@gmail.com/password123 or username123/password123"
        >
        <div id="loginHelp" class="form-text text-muted small">
            Format: [username or email]/[password] - If provided, must include a forward slash (/).
        </div>
        @error('cas_shield_logins') 
           <div class="invalid-feedback d-block small mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </div> 
        @enderror
      
    </div>
</div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-dark py-2" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="saveCasDocuments">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        @if($existing_fee_voucher || $existing_bank_statement || $existing_interview_pass || $existing_tb_test)
                                            Update Documents
                                        @else
                                            Submit All Documents
                                        @endif
                                    </span>
                                    <span wire:loading wire:target="saveCasDocuments">
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
            background-color: #f8fafc;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(198, 151, 73, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(198, 151, 73, 0.05) 0%, transparent 20%);
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
        
        .upload-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 65%, rgba(198, 151, 73, 0.03) 65%);
            z-index: -1;
            transform: rotate(15deg);
        }
        
        .card-header {
            background-color: #C69749 !important;
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
        }
        
        .document-section:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-color: #C69749;
        }
        
        .upload-area {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }
        
        .upload-area:hover, .upload-area.active {
            border-color: #C69749;
            background-color: rgba(198, 151, 73, 0.05) !important;
        }
        
        .selected-file {
            border-left: 3px solid #C69749;
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
            color: #C69749;
        }
        
        .decor-2 {
            bottom: 15%;
            right: 8%;
            font-size: 8rem;
            color: #C69749;
            transform: rotate(30deg);
        }
        
        .decor-3 {
            top: 25%;
            right: 10%;
            font-size: 6rem;
            color: #D4AD7B;
            transform: rotate(-15deg);
        }
        
        .decor-4 {
            bottom: 20%;
            left: 12%;
            font-size: 7rem;
            color: #B88B4A;
            transform: rotate(45deg);
        }
        
        .btn-dark {
            background-color: #C69749;
            border-color: #C69749;
            letter-spacing: 0.5px;
        }
        
        .btn-dark:hover {
            background-color: #B88B4A;
            border-color: #B88B4A;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .progress-bar {
            background-color: #C69749;
        }
    </style>
   
</div>