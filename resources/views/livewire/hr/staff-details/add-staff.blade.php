<div><div></div>
    <div class="card mb-3 mt-2 shadow-lg border-0">
        <!-- Session Messages -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show rounded-0 border-0 border-start border-5 border-success" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form wire:submit.prevent="save">
            <!-- Header Section -->
            <div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">
    <div class="card-body py-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-2 text-white">
                    <i class="fas fa-user-plus me-2"></i>
                    Add New Staff Member
                </h2>
                <p class="mb-0 opacity-75">
                    Complete all required information for new staff registration
                </p>
            </div>
         
        </div>
    </div>
</div>


            
            <div class="p-4">
                <!-- Personal Information Section -->
<div class="mb-5">
    <div class="card border-0 shadow-sm">
        <!-- Combined Header Section -->
        <div class="d-flex justify-content-between align-items-center p-3 rounded-top" 
             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width: 42px; height: 42px; background-color: rgba(115,103,240,0.1);">
                    <i class="fas fa-user text-primary fs-5"></i>
                </div>
                <div>
                    <h4 class="mb-1 fw-bold text-dark">Personal Information</h4>
                    <p class="text-muted mb-0 small">Enter or update staff personal details</p>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-user text-primary me-2"></i>Full Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" wire:model="full_name" required>
                    @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-user-friends text-primary me-2"></i>Father's Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" wire:model="father_name" required>
                    @error('father_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt text-primary me-2"></i>Date of Birth <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" wire:model="date_of_birth" required>
                    @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-id-card text-primary me-2"></i>CNIC Number <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('cnic_number') is-invalid @enderror" wire:model="cnic_number" required>
                    @error('cnic_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-phone text-primary me-2"></i>Personal Contact Number <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('personal_contact_number') is-invalid @enderror" 
                           wire:model="personal_contact_number" 
                           placeholder="923001234567"
                           pattern="^92\d{10}$"
                           title="Please enter a valid Pakistani number starting with 92 (e.g. 923001234567)"
                           required>
                    @error('personal_contact_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                    @if($personal_contact_number && !preg_match('/^92\d{10}$/', $personal_contact_number))
                        <small class="text-warning mt-1 d-block">Format: 923001234567 (12 digits starting with 92)</small>
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-phone-alt text-primary me-2"></i>Emergency Contact Number <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('emergency_contact_number') is-invalid @enderror" 
                           wire:model="emergency_contact_number" 
                           placeholder="923001234567"
                           pattern="^92\d{10}$"
                           title="Please enter a valid Pakistani number starting with 92 (e.g. 923001234567)"
                           required>
                    @error('emergency_contact_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                    @if($emergency_contact_number && !preg_match('/^92\d{10}$/', $emergency_contact_number))
                        <small class="text-warning mt-1 d-block">Format: 923001234567 (12 digits starting with 92)</small>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>City <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" wire:model="city" required>
                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-home text-primary me-2"></i>Home Address <span class="text-danger">*</span>
                    </label>
                    <textarea rows="1" class="form-control @error('home_address') is-invalid @enderror" wire:model="home_address" required></textarea>
                    @error('home_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

                
                <!-- Documents Upload Section -->
<div class="mb-5">
    <!-- Combined Header and Card -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <!-- Header Section -->
        <div class="card-header p-0 border-0">
            <div class="d-flex justify-content-between align-items-center p-4" 
                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width: 42px; height: 42px; background-color: rgba(115,103,240,0.1);">
                        <i class="fas fa-file-upload text-primary fs-5"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">Documents Upload</h4>
                        <p class="text-muted mb-0 small">Upload and manage all required staff documents</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Content Section -->
        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Column 1 -->
                <div class="col-md-6">
                    <!-- CNIC (Staff) -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">01</span>CNIC (Staff)</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="cnic_staff" id="cnicStaff" class="d-none" accept="*">
                            
                            <label for="cnicStaff" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload CNIC (Staff)</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('cnic_staff') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($cnic_staff)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $cnic_staff->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($cnic_staff->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('cnic_staff', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- CNIC (Father) -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">03</span>CNIC (Father)</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="cnic_father" id="cnicFather" class="d-none" accept="*">
                            
                            <label for="cnicFather" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload CNIC (Father)</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('cnic_father') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($cnic_father)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $cnic_father->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($cnic_father->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('cnic_father', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Result Card (Intermediate) -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">05</span>Result Card (Intermediate)</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="result_card_intermediate" id="resultIntermediate" class="d-none" accept="*">
                            
                            <label for="resultIntermediate" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload Intermediate Result</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('result_card_intermediate') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($result_card_intermediate)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $result_card_intermediate->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($result_card_intermediate->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('result_card_intermediate', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Utility Bill Copy -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">07</span>Utility Bill Copy</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="utility_bill_copy" id="utilityBill" class="d-none" accept="*">
                            
                            <label for="utilityBill" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload Utility Bill</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('utility_bill_copy') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($utility_bill_copy)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $utility_bill_copy->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($utility_bill_copy->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('utility_bill_copy', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- One Original Document -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">09</span>One Original Document (Any)</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="one_original_document" id="originalDoc" class="d-none" accept="*">
                            
                            <label for="originalDoc" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload Original Document</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('one_original_document') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($one_original_document)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $one_original_document->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($one_original_document->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('one_original_document', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Column 2 -->
                <div class="col-md-6">
                    <!-- CNIC (Mother) -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">02</span>CNIC (Mother)</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="cnic_mother" id="cnicMother" class="d-none" accept="*">
                            
                            <label for="cnicMother" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload CNIC (Mother)</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('cnic_mother') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($cnic_mother)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $cnic_mother->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($cnic_mother->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('cnic_mother', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Result Card (Matric) -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">04</span>Result Card (Matric)</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="result_card_matric" id="resultMatric" class="d-none" accept="*">
                            
                            <label for="resultMatric" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload Matric Result</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('result_card_matric') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($result_card_matric)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $result_card_matric->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($result_card_matric->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('result_card_matric', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Result Card (Bachelors) -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">06</span>Result Card (Bachelors)</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="result_card_bachelors" id="resultBachelors" class="d-none" accept="*">
                            
                            <label for="resultBachelors" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload Bachelors Result</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('result_card_bachelors') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($result_card_bachelors)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $result_card_bachelors->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($result_card_bachelors->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('result_card_bachelors', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Resume / CV -->
                    <div class="file-upload-card">
                        <label class="form-label fw-semibold"><span class="badge bg-primary me-2">08</span>Resume / CV</label>
                        
                        <div class="upload-area py-2 mb-1 text-center border-2 border-dashed rounded bg-white"
                             x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            
                            <input type="file" wire:model="resume_cv" id="resumeCv" class="d-none" accept="*">
                            
                            <label for="resumeCv" class="cursor-pointer d-block p-2">
                                <div class="upload-icon mb-1">
                                    <i class="fas fa-file-upload text-primary"></i>
                                </div>
                                <h6 class="mb-1">Upload Resume / CV</h6>
                                <p class="text-muted small mb-1">click to browse</p>
                                <span class="badge bg-light text-dark">Max 10MB</span>
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
                        
                        @error('resume_cv') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($resume_cv)
                            <div class="selected-file alert alert-light mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-primary"></i>
                                        <span class="file-name fw-bold">{{ $resume_cv->getClientOriginalName() }}</span>
                                        <span class="file-size text-muted ms-2">({{ number_format($resume_cv->getSize()/1024, 2) }} KB)</span>
                                    </div>
                                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('resume_cv', null)"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
               <!-- Job Details Section -->
<div class="mb-5">
    <!-- Combined Header and Card -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <!-- Header Section -->
        <div class="card-header p-0 border-0">
            <div class="d-flex justify-content-between align-items-center p-4" 
                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width: 42px; height: 42px; background-color: rgba(115,103,240,0.1);">
                        <i class="fas fa-briefcase text-primary fs-5"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">Job Details</h4>
                        <p class="text-muted mb-0 small">Complete staff employment information</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Details Content Section -->
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-user-tie text-primary me-2"></i>Role <span class="text-danger">*</span>
                    </label>
                    <select class="form-control @error('role') is-invalid @enderror" wire:model="role" required>
                        <option value="">Select Role</option>
                        @foreach($roles as $roleOption)
                            <option value="{{ $roleOption }}">{{ $roleOption }}</option>
                        @endforeach
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-calendar-check text-primary me-2"></i>Date of Joining <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control @error('date_of_joining') is-invalid @enderror" wire:model="date_of_joining" required>
                    @error('date_of_joining') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-money-bill-wave text-primary me-2"></i>Salary Package <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('salary_package') is-invalid @enderror" wire:model="salary_package" placeholder="e.g., 50,000 PKR or Negotiable" required>
                    @error('salary_package') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-percentage text-primary me-2"></i>Commission
                    </label>
                    <input type="text" class="form-control @error('commission') is-invalid @enderror" wire:model="commission" placeholder="e.g., 10% per admission">
                    @error('commission') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-university text-primary me-2"></i>Bank Name
                    </label>
                    <input type="text" class="form-control @error('bank_name') is-invalid @enderror" wire:model="bank_name" placeholder="e.g., HBL, UBL, etc.">
                    @error('bank_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-credit-card text-primary me-2"></i>Account Number
                    </label>
                    <input type="text" class="form-control @error('account_number') is-invalid @enderror" wire:model="account_number" placeholder="e.g., 123456789">
                    @error('account_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>
                
             <!-- Company Assets / Access Section -->
<div class="mb-5">
    <!-- Combined Header and Card -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <!-- Header Section -->
        <div class="card-header p-0 border-0">
            <div class="d-flex justify-content-between align-items-center p-4" 
                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width: 42px; height: 42px; background-color: rgba(115,103,240,0.1);">
                        <i class="fas fa-laptop text-primary fs-5"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">Company Assets / Access</h4>
                        <p class="text-muted mb-0 small">Manage assigned equipment and system access</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assets Content Section -->
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-laptop text-primary me-2"></i>Assigned Laptop
                    </label>
                    <input type="text" class="form-control @error('assigned_laptop') is-invalid @enderror" wire:model="assigned_laptop" placeholder="e.g., Dell Latitude 5420">
                    @error('assigned_laptop') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-network-wired text-primary me-2"></i>Laptop IP Address
                    </label>
                    <input type="text" class="form-control @error('assigned_laptop_ip') is-invalid @enderror" wire:model="assigned_laptop_ip" placeholder="e.g., 192.168.1.100">
                    @error('assigned_laptop_ip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-mobile-alt text-primary me-2"></i>Assigned Phone
                    </label>
                    <input type="text" class="form-control @error('assigned_phone') is-invalid @enderror" wire:model="assigned_phone" placeholder="e.g., Samsung Galaxy A14">
                    @error('assigned_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-wifi text-primary me-2"></i>Phone IP Address
                    </label>
                    <input type="text" class="form-control @error('assigned_phone_ip') is-invalid @enderror" wire:model="assigned_phone_ip" placeholder="e.g., 192.168.1.101">
                    @error('assigned_phone_ip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-phone text-primary me-2"></i>Company Phone Number
                    </label>
                    <input type="text" 
                           class="form-control @error('company_phone_number') is-invalid @enderror" 
                           wire:model="company_phone_number" 
                           placeholder="923001234567"
                           pattern="^92\d{10}$"
                           title="Please enter a valid Pakistani number starting with 92 (e.g. 923001234567)">
                    @error('company_phone_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                    @if($company_phone_number && !preg_match('/^92\d{10}$/', $company_phone_number))
                        <small class="text-warning mt-1 d-block">Format: 923001234567 (12 digits starting with 92)</small>
                    @endif
                </div>
                
                <div class="col-md-6">
    <label class="form-label fw-semibold">
        <i class="fas fa-envelope text-primary me-2"></i>Gmail/Password
    </label>
    <input type="text" 
           class="form-control @error('gmail_password') is-invalid @enderror" 
           wire:model="gmail_password" 
           placeholder="example@gmail.com/yourpassword"
           pattern="^[a-zA-Z0-9._%+-]+@gmail\.com\/.+$"
           title="Please enter in format: example@gmail.com/password">
    @error('gmail_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    <small class="text-muted mt-1 d-block">Format: example@gmail.com/password</small>
</div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-at text-primary me-2"></i>Outlook
                    </label>
                    <input type="text" class="form-control @error('outlook') is-invalid @enderror" wire:model="outlook">
                    @error('outlook') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6">
    <label class="form-label fw-semibold">
        <i class="fas fa-key text-primary me-2"></i>Portal Credentials
    </label>
    <input type="text" 
           class="form-control @error('portal_credentials') is-invalid @enderror" 
           wire:model="portal_credentials" 
           placeholder="username/password"
           pattern="^[a-zA-Z0-9._-]+\/.+$"
           title="Please enter in format: username/password">
    @error('portal_credentials') <div class="invalid-feedback">{{ $message }}</div> @enderror
    <small class="text-muted mt-1 d-block">Format: username/password</small>
</div>
                
                <div class="col-md-12">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-sticky-note text-primary me-2"></i>Remarks
                    </label>
                    <textarea rows="3" class="form-control @error('remarks') is-invalid @enderror" wire:model="remarks" placeholder="Any additional remarks"></textarea>
                    @error('remarks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- Submit Button -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="fas fa-user-plus me-2"></i> Add Staff Member</span>
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
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
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
        border-color: #a1b5f5;
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
</style>
</div>