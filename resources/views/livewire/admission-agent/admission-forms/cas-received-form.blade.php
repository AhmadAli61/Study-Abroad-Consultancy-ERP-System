<div>
    <!-- Decorative Elements -->
    <i class="fas fa-file-alt decorative-element decor-1"></i>
    <i class="fas fa-cloud-upload-alt decorative-element decor-2"></i>
    <i class="fas fa-file-pdf decorative-element decor-3"></i>
    <i class="fas fa-file-word decorative-element decor-4"></i>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="upload-card card shadow-lg">
                    <div class="card-header text-white">
                        <h4 class="mb-0 text-white"><i class="fas fa-file-upload me-2 text-white"></i> 
                            CAS Document Upload
                        </h4>
                        @if($registeredInquiry)
                        <small class="text-white-50">For: {{ $registeredInquiry->student_name }} ({{ $registeredInquiry->passport_number }})</small>
                        @endif
                    </div>
                    <div class="card-body mt-4">
                        <form wire:submit.prevent="saveCasDocument" enctype="multipart/form-data">
                                 <!-- Interview Pass Upload Section - Conditionally Show -->
                           @if($showInterviewPass && !$existingInterviewPass)
    <div class="mb-4 document-section p-3 rounded mt-3">
        <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-user-check me-2" style="color: #828383;"></i> Interview Confirmation Document (Required)</h6>
        
        <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
             id="interviewPassDropzone"
             x-data="{ isUploading: false, progress: 0 }"
             x-on:livewire-upload-start="isUploading = true"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             x-on:livewire-upload-progress="progress = $event.detail.progress"
             wire:ignore>
            <input type="file" wire:model="interviewPass" id="interviewPass" class="d-none" accept=".pdf">
            
            <label for="interviewPass" class="cursor-pointer">
                <div class="upload-icon mb-2">
                    <i class="fas fa-user-check fa-2x" style="color: #828383;"></i>
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
        @error('interviewPass') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
        
        @if($interviewPass)
            <div class="selected-file alert alert-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-file-pdf me-2 text-secondary"></i>
                        <span class="file-name fw-bold">{{ $interviewPass->getClientOriginalName() }}</span>
                    </div>
                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('interviewPass', null)"></button>
                </div>
            </div>
        @endif
    </div>
@elseif($existingInterviewPass)
    <div class="mb-4 document-section p-3 rounded mt-3">
        <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-user-check me-2" style="color: #828383;"></i> Interview Confirmation Document</h6>
        <div class="selected-file alert alert-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-file-pdf me-2 text-secondary"></i>
                    <span class="file-name fw-bold">{{ basename($existingInterviewPass) }}</span>
                </div>
            </div>
        </div>
    </div>
@endif

                            <!-- File Upload Dropzone -->
                            <div class="mb-4 document-section p-3 rounded mt-3">
    <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-alt me-2" style="color: #828383;"></i> CAS Document (Required)</h6>
    
    <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
         id="dropzone"
         x-data="{ isUploading: false, progress: 0 }"
         x-on:livewire-upload-start="isUploading = true"
         x-on:livewire-upload-finish="isUploading = false"
         x-on:livewire-upload-error="isUploading = false"
         x-on:livewire-upload-progress="progress = $event.detail.progress"
         wire:ignore>
        <input type="file" wire:model="casDocument" id="casDocument" class="d-none" accept=".pdf,.doc,.docx" @if($hasExistingCas && !$casDocument) disabled @endif>
        
        <label for="casDocument" class="cursor-pointer" @if($hasExistingCas && !$casDocument) style="opacity: 0.5; pointer-events: none;" @endif>
            <div class="upload-icon mb-2">
                <i class="fas fa-file-alt fa-2x" style="color: #828383;"></i>
            </div>
            <h6 class="mb-1">Drag & Drop your CAS document here</h6>
            <p class="text-muted small mb-2">or click to browse</p>
            <span class="badge bg-light text-dark">PDF, DOC, DOCX (Max 5MB)</span>
        </label>
        
        @if($hasExistingCas && !$casDocument)
            <div class="alert alert-danger mt-2 p-1 small text-white bg-danger d-inline-block">
                <i class="fas fa-exclamation-circle me-1" style="font-size: 0.75rem;"></i>
                <span style="font-size: 0.75rem;">CAS document exists. Delete first to upload new.</span>
            </div>
        @endif
        
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
    
    @if($casDocument)
        <div class="selected-file alert alert-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-file me-2 text-secondary"></i>
                    <span class="file-name fw-bold">{{ $casDocument->getClientOriginalName() }}</span>
                    <span class="file-size text-muted ms-2">{{ round($casDocument->getSize() / 1024, 2) }} KB</span>
                </div>
                <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('casDocument', null)"></button>
            </div>
        </div>
    @elseif($existingCasDocument)
        <div class="selected-file alert alert-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-file me-2 text-secondary"></i>
                    <span class="file-name fw-bold">{{ basename($existingCasDocument) }}</span>
                    <span class="file-size text-muted ms-2">
                        @php
                            $size = Storage::size($existingCasDocument);
                            echo round($size / 1024, 2) . ' KB';
                        @endphp
                    </span>
                </div>
                <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteCasDocument"></button>
            </div>
        </div>
    @endif
</div>
                            
                            <!-- Error Message -->
                            @error('casDocument') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-secondary py-2" 
                                        wire:loading.attr="disabled"
                                        {{ (!$casDocument && !$existingCasDocument) || ($hasExistingCas && !$casDocument) ? 'disabled' : '' }}>
                                    <span wire:loading wire:target="saveCasDocument" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                    <i class="fas fa-upload me-2"></i>
                                    {{ $existingCasDocument ? 'Update CAS Document' : 'Upload CAS Document' }}
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
                radial-gradient(circle at 10% 20%, rgba(130, 131, 131, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(130, 131, 131, 0.05) 0%, transparent 20%);
            min-height: 100vh;
            overflow-x: hidden;
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
            background: linear-gradient(45deg, transparent 65%, rgba(130, 131, 131, 0.03) 65%);
            z-index: -1;
            transform: rotate(15deg);
        }
        
        .upload-area {
            background-color: #f8f9fa;
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 8px;
        }
        
        .upload-area:hover {
            border-color: #828383;
            background-color: rgba(130, 131, 131, 0.05);
        }
        
        .upload-area.active {
            border-color: #828383;
            background-color: rgba(130, 131, 131, 0.1);
        }
        
        .selected-file {
            border-left: 3px solid #828383;
            border-radius: 6px;
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
            color: #828383;
        }
        
        .decor-2 {
            bottom: 15%;
            right: 8%;
            font-size: 8rem;
            color: #828383;
            transform: rotate(30deg);
        }
        
        .decor-3 {
            top: 25%;
            right: 10%;
            font-size: 6rem;
            color: #6c757d;
            transform: rotate(-15deg);
        }
        
        .decor-4 {
            bottom: 20%;
            left: 12%;
            font-size: 7rem;
            color: #495057;
            transform: rotate(45deg);
        }
        
        .btn-secondary {
            background-color: #828383;
            border-color: #828383;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #6c6d6d;
            border-color: #6c6d6d;
            color: white;
        }
        
        .btn-outline-secondary {
            border-color: #828383;
            color: #828383;
        }
        
        .btn-outline-secondary:hover {
            background-color: #828383;
            color: white;
        }
        
        .card-header {
            background-color: #828383 !important;
        }
        
        .progress-bar {
            background-color: #828383;
        }
    </style>
    

    

</div>