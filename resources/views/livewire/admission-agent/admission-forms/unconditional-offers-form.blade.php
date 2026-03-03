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
                            Document Submission
                        </h4>
                        @if($registered_inquiry)
                        <small class="text-white-50">For: {{ $registered_inquiry->student_name }} ({{ $registered_inquiry->passport_number }})</small>
                        @endif
                    </div>
                    <div class="card-body mt-4 bg-light">
                        <form wire:submit.prevent="submitDocuments" enctype="multipart/form-data">
                            <!-- Additional Document Upload (Optional) -->
                            <div class="mb-4 document-section p-3 rounded">
                                <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-file-alt me-2" style="color: #87431D;"></i>Upload Unconditional Offer</h6>
                                
                                <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
                                     x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                     wire:ignore>
                                    <input type="file" wire:model="extra_document" id="extraDocument" class="d-none" accept=".pdf">
                                    
                                    <label for="extraDocument" class="cursor-pointer">
                                        <div class="upload-icon mb-2">
                                            <i class="fas fa-file-alt fa-2x" style="color: #87431D;"></i>
                                        </div>
                                        <h6 class="mb-1">Drag & Drop Unconditional Document</h6>
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
                                @error('extra_document') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                                
                                @if($extra_document)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ $extra_document->getClientOriginalName() }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('extra_document', null)"></button>
                                        </div>
                                    </div>
                                @elseif($existing_extra_document)
                                    <div class="selected-file alert alert-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                                <span class="file-name fw-bold">{{ basename($existing_extra_document) }}</span>
                                            </div>
                                            <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('extra_document')"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- Fee Payment Upload -->
                             <!-- Fee Payment Upload -->
    <div class="mb-4 document-section p-3 rounded mt-3">
        <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-money-bill-wave me-2" style="color: #87431D;"></i> Fee Payment Receipt (Optional)</h6> <!-- Changed from (Required) -->
        
        <div class="upload-area py-4 mb-2 text-center border-2 border-dashed rounded bg-white"
             x-data="{ isUploading: false, progress: 0 }"
             x-on:livewire-upload-start="isUploading = true"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             x-on:livewire-upload-progress="progress = $event.detail.progress"
             wire:ignore>
            <input type="file" wire:model="fee_payment" id="feePayment" class="d-none" accept=".pdf">
            
            <label for="feePayment" class="cursor-pointer">
                <div class="upload-icon mb-2">
                    <i class="fas fa-money-bill-wave fa-2x" style="color: #87431D;"></i>
                </div>
                <h6 class="mb-1">Drag & Drop Fee Payment Receipt</h6>
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
        
        <!-- Remove the required validation error message -->
        {{-- @error('fee_payment') <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror --}}
        
        @if($fee_payment)
            <div class="selected-file alert alert-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-file-pdf me-2 text-danger"></i>
                        <span class="file-name fw-bold">{{ $fee_payment->getClientOriginalName() }}</span>
                    </div>
                    <button type="button" class="btn-close" aria-label="Remove" wire:click="$set('fee_payment', null)"></button>
                </div>
            </div>
        @elseif($existing_fee_payment)
            <div class="selected-file alert alert-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-file-pdf me-2 text-danger"></i>
                        <span class="file-name fw-bold">{{ basename($existing_fee_payment) }}</span>
                    </div>
                    <button type="button" class="btn-close" aria-label="Remove" wire:click="deleteDocument('fee_payment')"></button>
                </div>
            </div>
        @endif
    </div>

                            

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-dark py-2" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="submitDocuments">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Submit Documents
                                    </span>
                                    <span wire:loading wire:target="submitDocuments">
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
                radial-gradient(circle at 10% 20%, rgba(13, 110, 253, 0.03) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(2, 2, 2, 0.03) 0%, transparent 20%);
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
            background: linear-gradient(135deg, #87431D, #6a3416) !important;
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
            border-color: #87431D;
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
            border-color: #87431D;
            background-color: rgba(135, 67, 29, 0.05) !important;
        }
        
        .selected-file {
            border-left: 3px solid #87431D;
            border-radius: 6px;
            background-color: #ffffff;
        }
        
        .decorative-element {
            position: fixed;
            opacity: 0.05;
            z-index: 1;
            color: #87431D;
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
            background-color: #87431D;
            border-color: #87431D;
            letter-spacing: 0.5px;
        }
        
        .btn-dark:hover {
            background-color: #6a3416;
            border-color: #6a3416;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .progress-bar {
            background-color: #87431D;
        }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fee Payment Dropzone
        const feePaymentDropzone = document.querySelector('[wire\\:model="fee_payment"]').parentElement;
        const feePaymentInput = document.getElementById('feePayment');
        
        // Extra Document Dropzone
        const extraDocDropzone = document.querySelector('[wire\\:model="extra_document"]').parentElement;
        const extraDocInput = document.getElementById('extraDocument');
        
        // Setup dropzone for fee payment
        setupDropzone(feePaymentDropzone, feePaymentInput);
        
        // Setup dropzone for extra document
        setupDropzone(extraDocDropzone, extraDocInput);
        
        function setupDropzone(dropzone, fileInput) {
            // Drag and drop events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropzone.classList.add('active');
            }
            
            function unhighlight() {
                dropzone.classList.remove('active');
            }
            
            dropzone.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length) {
                    fileInput.files = files;
                    // Trigger Livewire file upload
                    const event = new Event('change', { bubbles: true });
                    fileInput.dispatchEvent(event);
                }
            }
        }
    });
    </script>
</div>