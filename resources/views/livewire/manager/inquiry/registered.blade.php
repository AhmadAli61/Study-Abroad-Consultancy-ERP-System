<div>
<div class="card mb-3 mt-2 shadow-lg border-0">
    <!-- Session Messages -->
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-0 border-0 border-start border-5 border-success" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-0 border-0 border-start border-5 border-danger" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

   <form wire:submit.prevent="saveDocuments">
        <input type="hidden" wire:model="inquiryId">
        
        <!-- Header Section -->
        <div class="bg-gradient-primary text-white p-4 rounded-top">
            <div class="d-flex align-items-center">
                <div class="bg-white p-2 rounded me-3" style="display: inline-block;">
                <i class="fas fa-file-alt text-primary"></i>
            </div>
                <div>
                    <h3 class="mb-0 text-white">Student Registration Documents</h3>
                    <p class="mb-0 opacity-75">Complete all required information and upload necessary documents for registration</p>
                </div>
            </div>
        </div>
        
        <div class="p-4">
            <!-- Student Information Section -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                <div class="bg-primary p-2 rounded me-3" style="display: inline-block;">
                        <i class="fas fa-user-graduate text-white"></i>
                    </div>
                    <h5 class="mb-0 text-primary">Student Information</h5>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-user text-primary me-2"></i>Student Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('student_name') is-invalid @enderror" wire:model.defer="student_name" required>
                                @error('student_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-phone text-primary me-2"></i>Student Contact <span class="text-danger">*</span></label>
                                <input type="tel" 
                                       class="form-control @error('student_contact') is-invalid @enderror" 
                                       wire:model.defer="student_contact" 
                                       placeholder="923001234567"
                                       pattern="^92\d{10}$"
                                       title="Please enter a valid Pakistani number starting with 92 (e.g. 923001234567)"
                                       required disabled>
                                @error('student_contact') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                                <small class="text-muted mt-1 d-block">Format: 923001234567 (12 digits starting with 92)</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-phone-alt text-primary me-2"></i>Emergency Contact 1 <span class="text-danger">*</span></label>
                                <input type="tel" 
                                       class="form-control @error('emergency_contact_1') is-invalid @enderror" 
                                       wire:model.defer="emergency_contact_1" 
                                       placeholder="923001234567"
                                       pattern="^92\d{10}$"
                                       title="Please enter a valid Pakistani number starting with 92 (e.g. 923001234567)"
                                       required>
                                @error('emergency_contact_1') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-phone-alt text-primary me-2"></i>Emergency Contact 2</label>
                                <input type="text" class="form-control @error('emergency_contact_2') is-invalid @enderror" wire:model.defer="emergency_contact_2">
                                @error('emergency_contact_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-passport text-primary me-2"></i>Passport Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('passport_number') is-invalid @enderror" wire:model.defer="passport_number" required>
                                @error('passport_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-user-tie text-primary me-2"></i>Course Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('course_name') is-invalid @enderror" wire:model.defer="course_name" required>
                                @error('course_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-link text-primary me-2"></i>Course Link <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('course_link') is-invalid @enderror" wire:model.defer="course_link" required>
                                @error('course_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-graduation-cap text-primary me-2"></i>Course Intake <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('course_intake') is-invalid @enderror" wire:model.defer="course_intake" required>
                                @error('course_intake') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-university text-primary me-2"></i>University Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('university_name') is-invalid @enderror" 
                                    wire:model.defer="university_name" required>
                                @error('university_name') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-envelope text-primary me-2"></i>Student Gmail with Password <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('gmail_password') is-invalid @enderror" 
                                       wire:model.defer="gmail_password" 
                                       placeholder="example@gmail.com/yourpassword" 
                                       pattern="^[a-zA-Z0-9._%+-]+@gmail\.com\/.+$"
                                       title="Please enter in format: example@gmail.com/password"
                                       required>
                                @error('gmail_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <small class="text-muted mt-1 d-block">Format: example@gmail.com/password</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Refusal Letter Section -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                <div class="bg-primary p-2 rounded me-3" style="display: inline-block;">
                        <i class="fas fa-file-circle-xmark text-white"></i>
                    </div>
                    <h5 class="mb-0 text-primary">Refusal Letter Details</h5>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-question-circle text-primary me-2"></i>Has Refusal Letter? <span class="text-danger">*</span>
                        </label>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
                                       wire:model.live="has_refusal_letter" 
                                       id="refusal_yes" 
                                       value="yes"
                                       @checked($has_refusal_letter === 'yes')>
                                <label class="form-check-label" for="refusal_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
                                       wire:model.live="has_refusal_letter" 
                                       id="refusal_no" 
                                       value="no"
                                       @checked($has_refusal_letter === 'no')>
                                <label class="form-check-label" for="refusal_no">No</label>
                            </div>
                            @error('has_refusal_letter') 
                                <div class="text-danger small mt-1">{{ $message }}</div> 
                            @enderror
                        </div>

                        @if($has_refusal_letter === 'yes')
                        <div wire:transition class="mt-4 p-2 bg-light rounded">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-upload text-primary me-2"></i>Upload Refusal Letter (PDF)
                            </label>
                            <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                 x-data="{ isUploading: false, progress: 0 }"
                                 x-on:livewire-upload-start="isUploading = true"
                                 x-on:livewire-upload-finish="isUploading = false"
                                 x-on:livewire-upload-error="isUploading = false"
                                 x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <input type="file" wire:model="refusal_letter" id="refusalLetter" class="d-none" accept=".pdf" required>
                                
                                <label for="refusalLetter" class="cursor-pointer d-block p-2">
                                    <div class="upload-icon mb-1">
                                        <i class="fas fa-file-pdf  text-danger"></i>
                                    </div>
                                    <h6 class="mb-1">Drag & Drop Refusal Letter</h6>
                                    <p class="text-muted small mb-1">or click to browse</p>
                                    <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                </label>
                                
                                <div x-show="isUploading" class="mt-3 px-3">
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
                            @error('refusal_letter') 
                                <div class="invalid-feedback d-block">{{ $message }}</div> 
                            @enderror
                            @if($refusal_letter) 
                                <div class="selected-file alert alert-light mt-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-file-pdf me-2 text-danger"></i>
                                            <span class="file-name fw-bold">{{ $refusal_letter->getClientOriginalName() }}</span>
                                            <span class="file-size text-muted ms-2">({{ number_format($refusal_letter->getSize()/1024, 2) }} KB)</span>
                                        </div>
                                        <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('refusal_letter', null)"></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Document Upload Section -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                <div class="bg-primary p-2 rounded me-3" style="display: inline-block;">
                        <i class="fas fa-file-upload text-white"></i>
                    </div>
                    <h5 class="mb-0 text-primary">Upload Required Documents (PDF only)</h5>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Column 1 -->
                            <div class="col-md-6">
                                <!-- Matric DMC -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">01</span>Matric DMC/Certificate <span class="text-danger">*</span></label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="matric_dmc_path" id="matricDmc" class="d-none" accept=".pdf" required>
                                        
                                        <label for="matricDmc" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Matric DMC</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('matric_dmc_path') 
                                        <div class="invalid-feedback d-block">
                                            {{ str_replace('matric dmc', 'Matric DMC', $message) }}
                                        </div> 
                                    @enderror
                                    
                                    @if($matric_dmc_path)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $matric_dmc_path->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($matric_dmc_path->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('matric_dmc_path', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- BS Hons -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">03</span>BS Hons 4 Years Transcript/Degree</label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="bs_hons" id="bsHons" class="d-none" accept=".pdf">
                                        
                                        <label for="bsHons" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop BS Hons Document</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('bs_hons') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($bs_hons)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $bs_hons->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($bs_hons->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('bs_hons', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- MA/MSC -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">05</span>MA/MSC 2 Years Transcript/Degree</label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="ma_msc" id="maMsc" class="d-none" accept=".pdf">
                                        
                                        <label for="maMsc" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop MA/MSC Document</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('ma_msc') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($ma_msc)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $ma_msc->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($ma_msc->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('ma_msc', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- CV File -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">07</span>Updated CV <span class="text-danger">*</span></label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="cv_file" id="cvFile" class="d-none" accept=".pdf" required>
                                        
                                        <label for="cvFile" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop CV</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('cv_file') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($cv_file)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $cv_file->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($cv_file->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('cv_file', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Experience Letter -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">09</span>Experience Letter <span class="text-danger">*</span></label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="experience_letter" id="experienceLetter" class="d-none" accept=".pdf">
                                        
                                        <label for="experienceLetter" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Experience Letter</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('experience_letter') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($experience_letter)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $experience_letter->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($experience_letter->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('experience_letter', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Agent Consent -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">11</span>Upload Document Checklist <span class="text-danger">*</span></label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="agent_consent" id="agentConsent" class="d-none" accept=".pdf" required>
                                        
                                        <label for="agentConsent" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Document Checklist</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('agent_consent') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($agent_consent)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $agent_consent->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($agent_consent->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('agent_consent', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Additional Docs -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">13</span>Additional Documents Upload</label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="additional_docs" id="additionalDocs" class="d-none" accept=".pdf">
                                        
                                        <label for="additionalDocs" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Additional Documents</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('additional_docs') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($additional_docs)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $additional_docs->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($additional_docs->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('additional_docs', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Extra 2 -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">15</span>Extra 2</label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="extra2" id="extra2" class="d-none" accept=".pdf">
                                        
                                        <label for="extra2" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Extra Document</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('extra2') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($extra2)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $extra2->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($extra2->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('extra2', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Column 2 -->
                            <div class="col-md-6">
                                <!-- Intermediate DMC -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">02</span>Intermediate DMC/Certificate <span class="text-danger">*</span></label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="intermediate_dmc" id="intermediateDmc" class="d-none" accept=".pdf" required>
                                        
                                        <label for="intermediateDmc" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Intermediate DMC</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('intermediate_dmc') 
                                        <div class="invalid-feedback d-block">
                                            {{ str_replace('intermediate dmc', 'Intermediate DMC', $message) }}
                                        </div> 
                                    @enderror
                                    
                                    @if($intermediate_dmc)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $intermediate_dmc->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($intermediate_dmc->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('intermediate_dmc', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- BA/BSC -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">04</span>BA/BSC 2 Years Transcript/Degree</label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="ba_bsc" id="baBsc" class="d-none" accept=".pdf">
                                        
                                        <label for="baBsc" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop BA/BSC Document</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('ba_bsc') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($ba_bsc)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $ba_bsc->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($ba_bsc->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('ba_bsc', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                              <!-- Reference Letter -->
<div class="file-upload-card">
    <label class="form-label fw-semibold">
        <span class="badge bg-primary me-2">06</span>
        Recommendation Letter <span class="text-danger">*</span>
    </label>
    
    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
         x-data="{ isUploading: false, progress: 0 }"
         x-on:livewire-upload-start="isUploading = true"
         x-on:livewire-upload-finish="isUploading = false"
         x-on:livewire-upload-error="isUploading = false"
         x-on:livewire-upload-progress="progress = $event.detail.progress">
        
        <!-- Change to single file input without multiple attribute -->
        <input type="file" wire:model="reference_letter" id="referenceLetter" class="d-none" accept=".pdf">
        
        <label for="referenceLetter" class="cursor-pointer d-block p-2">
            <div class="upload-icon mb-1">
                <i class="fas fa-file-pdf text-danger"></i>
            </div>
            <h6 class="mb-1">Upload Recommendation Letter</h6>
            <p class="text-muted small mb-1">click to browse</p>
            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
        </label>
        
        <div x-show="isUploading" class="mt-3 px-3">
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
    
    @error('reference_letter') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    
    <!-- Show single file instead of multiple -->
    @if($reference_letter)
        <div class="selected-file alert alert-light mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                    <span class="file-name fw-bold">{{ $reference_letter->getClientOriginalName() }}</span>
                    <span class="file-size text-muted ms-2">({{ number_format($reference_letter->getSize()/1024, 2) }} KB)</span>
                </div>
                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('reference_letter', null)"></button>
            </div>
        </div>
    @endif
</div>
                                
                                <!-- Passport Pages -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">08</span>Passport (First 4 pages) <span class="text-danger">*</span></label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="passport_pages" id="passportPages" class="d-none" accept=".pdf" required>
                                        
                                        <label for="passportPages" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Passport Pages</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('passport_pages') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($passport_pages)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $passport_pages->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($passport_pages->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('passport_pages', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- English Test -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">10</span>English Language Test / MOI <span class="text-danger">*</span></label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="english_test" id="englishTest" class="d-none" accept=".pdf">
                                        
                                        <label for="englishTest" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop English Test</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('english_test') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($english_test)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $english_test->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($english_test->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('english_test', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Student Consent -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">12</span>Student Consent Letter <span class="text-danger">*</span></label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="student_consent" id="studentConsent" class="d-none" accept=".pdf" required>
                                        
                                        <label for="studentConsent" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Student Consent</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('student_consent') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($student_consent)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $student_consent->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($student_consent->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('student_consent', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Extra -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">14</span>Extra</label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="extra" id="extra" class="d-none" accept=".pdf">
                                        
                                        <label for="extra" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Extra Document</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('extra') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($extra)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $extra->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($extra->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('extra', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Extra 3 -->
                                <div class="file-upload-card">
                                    <label class="form-label fw-semibold"><span class="badge bg-primary me-2">16</span>Extra 3</label>
                                    
                                    <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                                         x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        
                                        <input type="file" wire:model="extra3" id="extra3" class="d-none" accept=".pdf">
                                        
                                        <label for="extra3" class="cursor-pointer d-block p-2">
                                            <div class="upload-icon mb-1">
                                                <i class="fas fa-file-pdf  text-danger"></i>
                                            </div>
                                            <h6 class="mb-1">Drag & Drop Extra Document</h6>
                                            <p class="text-muted small mb-1">or click to browse</p>
                                            <span class="badge bg-light text-dark">PDF only (Max 5MB)</span>
                                        </label>
                                        
                                        <div x-show="isUploading" class="mt-3 px-3">
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
                                    
                                    @error('extra3') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    
                                    @if($extra3)
                                        <div class="selected-file alert alert-light mt-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                    <span class="file-name fw-bold">{{ $extra3->getClientOriginalName() }}</span>
                                                    <span class="file-size text-muted ms-2">({{ number_format($extra3->getSize()/1024, 2) }} KB)</span>
                                                </div>
                                                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('extra3', null)"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Notes Section -->
            <div class="mb-4">
                <div class="d-flex align-items-center mb-4">
                <div class="bg-primary p-2 rounded me-3" style="display: inline-block;">
                        <i class="fas fa-pen-alt text-white"></i>
                    </div>
                    <h5 class="mb-0 text-primary">Message / Additional Notes</h5>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <textarea 
                            name="notes" 
                            wire:model.defer="notes" 
                            rows="6" 
                            class="form-control"
                            placeholder="Type your message here..."
                        ></textarea>
                        @error('notes') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                        
                        @if(isset($notes_history) && count($notes_history) > 0)
                        <div class="mt-4">
                            <h6 class="text-primary"><i class="fas fa-history me-2"></i> Notes History</h6>
                            <div class="border rounded p-2 bg-light">
                                @foreach(array_reverse($notes_history) as $entry)
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $entry['user_name'] ?? 'System' }}</strong>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($entry['timestamp'])->format('M d, Y h:i A') }}</small>
                                    </div>
                                    <p class="mb-0 mt-1">{{ $entry['note'] }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-end mt-4">
                             <button type="submit" class="btn btn-primary btn-lg px-5 py-2" wire:loading.attr="disabled" onclick="return validateForm()">
    <span wire:loading.remove><i class="fas fa-paper-plane me-2"></i> Submit Application</span>
    <span wire:loading>
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        Processing...
    </span>
</button>
            </div>
        </div>
    </form>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #7367f0 0%, #7367f0 100%);
    }
    
    .file-upload-card {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
    }
    
    .file-upload-card:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .upload-area {
        transition: all 0.3s ease;
        cursor: pointer;
        border-radius: 8px;
        border: 2px dashed #dee2e6;
    }
    .compact-upload-area {
    padding: 0.75rem !important; /* Reduced from py-2 (1rem) */
    margin-bottom: 0.5rem !important; /* Reduced spacing */
}

.compact-upload-label {
    padding: 0.5rem !important; /* Reduced from p-2 (1rem) */
}

.compact-upload-icon {
    font-size: 1.25rem !important; /* Reduced from  */
    margin-bottom: 0.25rem !important;
}

.compact-heading {
    font-size: 0.875rem !important; /* Reduced from h6 */
    margin-bottom: 0.25rem !important;
}

.compact-text {
    font-size: 0.75rem !important;
    margin-bottom: 0.25rem !important;
}

.compact-file-card {
    margin-bottom: 1rem !important; /* Reduced from 1.5rem */
    padding-bottom: 1rem !important; /* Reduced from 1.5rem */
}
    
    .upload-area:hover {
        border-color: #7367f0;
        background-color: rgba(115, 103, 240, 0.05) !important;
    }
    
    .selected-file {
        border-left: 3px solid #7367f0;
        border-radius: 6px;
        background-color: #ffffff;
    }
    
    .cursor-pointer {
        cursor: pointer;
    }
    
    .progress-bar {
        background-color: #7367f0;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(115, 103, 240, 0.25);
        border-color: #7367f0;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #7367f0 0%, #7367f0 100%);
        border: none;
        box-shadow: 0 2px 5px rgba(115, 103, 240, 0.3);
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #7367f0 0%, #7367f0 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(115, 103, 240, 0.4);
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }
</style>
<script>
document.addEventListener('livewire:initialized', function () {
    Livewire.on('validationFailed', (errors) => {
        // Scroll to the first error
        const firstError = Object.keys(errors)[0];
        const errorElement = document.querySelector(`[wire\\:model="${firstError}"]`);
        if (errorElement) {
            errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
});

// Add this to your submit button
window.validateForm = function() {
    const requiredFiles = [
        'matricDmc', 'intermediateDmc', 'cvFile', 'passportPages', 
        'agentConsent', 'studentConsent', 'referenceLetter'
    ];
    
    let hasErrors = false;
    
    requiredFiles.forEach(id => {
        const fileInput = document.getElementById(id);
        if (fileInput && !fileInput.files.length) {
            hasErrors = true;
            // Highlight the upload area
            const uploadArea = fileInput.closest('.upload-area');
            if (uploadArea) {
                uploadArea.style.borderColor = '#dc3545';
                uploadArea.style.backgroundColor = '#fff5f5';
            }
        }
    });
    
    return !hasErrors;
}
</script>

</div>