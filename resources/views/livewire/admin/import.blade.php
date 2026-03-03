<div>
<div>
    <div class="col-12">
    <div class="modern-import-card">
        <!-- Header Section -->
     <div class="card-header bg-gradient-primary text-white py-4" style="border-radius: 12px 12px 0 0 !important;">
    <div class="container row align-items-center">
        <div class=" col-md-8">
            <h2 class="mb-2 text-white">
                <i class="fas fa-file-import me-2"></i>
                Import CSV Data
            </h2>
            <p class="mb-0 opacity-75">
                Upload and process CSV files to add inquiries to your system
            </p>
        </div>
    </div>
</div>


        <div class="import-body">
            <!-- Success & Error Alerts -->
            <!-- Success & Error Alerts -->
<div class="alert-section">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <span>{{ session('message') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($successMessage)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <span>{{ $successMessage }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" wire:click="$set('successMessage', '')"></button>
        </div>
    @endif
</div>

            <!-- Upload Section -->
            <div class="upload-section">
                <div class="upload-area" id="uploadArea">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h4>Drag & Drop CSV Files</h4>
                    <p class="text-muted">or click to browse your files</p>
                    <input type="file" id="csvUpload" wire:model="csv_files" multiple accept=".csv"
                        class="upload-input @error('csv_files.*') is-invalid @enderror" wire:loading.attr="disabled">
                    
                    @error('csv_files.*')
                        <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- File Preview -->
                <div class="file-preview mt-4" wire:loading.remove wire:target="csv_files">
                    @if (count($csv_files) > 0)
                        <h5 class="mb-3">Selected Files ({{ count($csv_files) }})</h5>
                        <div class="file-list">
                            @foreach ($csv_files as $index => $file)
                                <div class="file-item">
                                    <i class="fas fa-file-csv text-primary"></i>
                                    <span class="file-name">{{ $file->getClientOriginalName() }}</span>
                                    <span class="file-size">{{ round($file->getSize() / 1024, 2) }} KB</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Loading Spinner -->
                <div wire:loading wire:target="csv_files" class="loading-section text-center my-4">
                    <div class="spinner-container">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <h5 class="mt-3">Processing Files</h5>
                    <p class="text-muted">Validating your CSV files, please wait...</p>
                </div>
            </div>

            <!-- Action Section -->
            <div class="action-section">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="upload-info">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Maximum file size: 512MB per file
                        </small>
                    </div>
                   <button wire:click="uploadCsv" wire:loading.attr="disabled" wire:target="uploadCsv"
    class="btn btn-primary btn-lg px-4" @if ($isUploading) disabled @endif>
    <i class="fas fa-cloud-upload-alt me-2"></i> 
    <span wire:loading.remove wire:target="uploadCsv">Import Data</span>
    <span wire:loading wire:target="uploadCsv">Importing...</span>
</button>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Duplicate Modal -->
 @if ($showDuplicateModal)
<div class="modal-overlay">
    <div class="modern-modal">
        <!-- Modal Header with Gradient -->
        <div class="modal-header-gradient">
            <div class="d-flex align-items-center">
                <div class="modal-icon-wrapper">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="modal-title-content">
                    <h3 class="modal-main-title text-white">Duplicate Records Detected</h3>
                    <p class="modal-subtitle">The following phone numbers already exist.</p>
                </div>
            </div>
            <div class="duplicate-count-badge">
                <span class="count-number">{{ count((array)$duplicates) }}</span>
                <span class="count-text">Duplicates</span>
            </div>
        </div>
        
        <!-- Modal Body -->
        <div class="modal-body">
            <div class="duplicates-container">
                <div class="duplicates-header">
                    <h6>Duplicate Phone Numbers</h6>
                    <small class="text-muted">Showing {{ count((array)$duplicates) }} items</small>
                </div>
                
                <div class="duplicates-list-scroll">
                    @foreach ((array) $duplicates as $index => $phone)
                    <div class="duplicate-item">
                        <div class="duplicate-number">
                            <span class="item-index">#{{ $index + 1 }}</span>
                            <span class="phone-value">{{ is_string($phone) ? $phone : json_encode($phone) }}</span>
                        </div>
                        <div class="duplicate-actions">
                            <span class="badge bg-dark">Duplicate</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="modal-footer-actions">
           <button wire:click="skipDuplicates" class="btn btn-success btn-action">
    <i class="fas fa-play-circle me-2"></i>
    Skip Duplicates & Continue
</button>
            <div class="action-info">
                <i class="fas fa-lightbulb me-1"></i>
                <small>This will import all non-duplicate records</small>
            </div>
        </div>
    </div>
</div>
@endif
<style>
     .bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1050;
    padding: 1rem;
    animation: overlayFadeIn 0.3s ease;
}

.modern-modal {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 700px;
    max-height: 85vh;
    overflow: hidden;
    animation: modalSlideIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Header with Gradient */
.modal-header-gradient {
    background: linear-gradient(135deg, #7367F0 0%, #7367F0 100%);
    color: white;
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    position: relative;
}

.modal-header-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #7367F0, #7367F0, #7367F0);
}

.modal-icon-wrapper {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    backdrop-filter: blur(10px);
}

.modal-icon-wrapper i {
    font-size: 1.5rem;
}

.modal-main-title {
    font-weight: 700;
    margin: 0;
    font-size: 1.5rem;
}

.modal-subtitle {
    margin: 0.25rem 0 0 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

.duplicate-count-badge {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 0.5rem 1rem;
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.count-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
}

.count-text {
    font-size: 0.75rem;
    opacity: 0.9;
}

/* Modal Body */
.modal-body {
    padding: 2rem;
    max-height: 50vh;
    overflow-y: auto;
}

.duplicates-container {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    overflow: hidden;
}

.duplicates-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.duplicates-header h6 {
    margin: 0;
    color: #495057;
    font-weight: 600;
}

.duplicates-list-scroll {
    max-height: 300px;
    overflow-y: auto;
    padding: 0.5rem;
}

.duplicate-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    background: #f8f9fa;
    transition: all 0.2s ease;
    border-left: 3px solid #7367F0;
}

.duplicate-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.duplicate-number {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.item-index {
    background: #7367F0;
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
}

.phone-value {
    font-weight: 500;
    color: #495057;
}

.duplicate-actions .badge {
    font-size: 0.7rem;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
}

/* Footer */
.modal-footer-actions {
    padding: 1.5rem 2rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    text-align: center;
}

.btn-action {
    background: linear-gradient(135deg, #7367F0 0%, #cecbf5 100%);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

.action-info {
    margin-top: 0.75rem;
    color: #6c757d;
    font-size: 0.85rem;
}

/* Animations */
@keyframes overlayFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes modalSlideIn {
    from { 
        opacity: 0;
        transform: translateY(-50px) scale(0.9);
    }
    to { 
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Scrollbar Styling */
.duplicates-list-scroll::-webkit-scrollbar {
    width: 6px;
}

.duplicates-list-scroll::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.duplicates-list-scroll::-webkit-scrollbar-thumb {
    background: #7367F0;
    border-radius: 10px;
}

.duplicates-list-scroll::-webkit-scrollbar-thumb:hover {
    background: #7367F0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal {
        margin: 1rem;
        max-height: 90vh;
    }
    
    .modal-header-gradient {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .modal-header-gradient .d-flex {
        flex-direction: column;
        text-align: center;
    }
    
    .modal-icon-wrapper {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .duplicate-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
   
    
    .btn-action {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality for duplicates
    const searchInput = document.getElementById('duplicateSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const duplicateItems = document.querySelectorAll('.duplicate-item');
            
            duplicateItems.forEach(item => {
                const phoneText = item.querySelector('.phone-value').textContent.toLowerCase();
                if (phoneText.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Add animation to duplicate items
    const duplicateItems = document.querySelectorAll('.duplicate-item');
    duplicateItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.05}s`;
        item.classList.add('animate__animated', 'animate__fadeInUp');
    });
});
</script>
</div>

<style>
.modern-import-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-bottom: 2rem;
}

.import-header {
    background: linear-gradient(135deg, #7367F0 0%, #7367F0 100%);
    color: white;
    padding: 2rem;
    display: flex;
    align-items: center;
}

.header-icon {
    font-size: 2.5rem;
    margin-right: 1.5rem;
    opacity: 0.9;
}

.header-content h1 {
    margin: 0;
    font-weight: 600;
    font-size: 1.75rem;
}

.header-content p {
    margin: 0.25rem 0 0 0;
    opacity: 0.9;
}

.import-body {
    padding: 2rem;
}

.upload-section {
    margin-bottom: 2rem;
}

.upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 12px;
    padding: 3rem 2rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    background: #f8f9fa;
}

.upload-area:hover {
    border-color: #7367F0;
    background: #f0f4ff;
}

.upload-icon {
    font-size: 3rem;
    color: #6c757d;
    margin-bottom: 1rem;
}

.upload-area h4 {
    margin-bottom: 0.5rem;
    color: #495057;
    font-weight: 600;
}

.upload-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.file-preview {
    animation: fadeIn 0.5s ease;
}

.file-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.file-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #7367F0;
}

.file-item i {
    margin-right: 0.75rem;
    font-size: 1.25rem;
}

.file-name {
    flex: 1;
    font-weight: 500;
}

.file-size {
    color: #6c757d;
    font-size: 0.875rem;
}

.loading-section {
    animation: fadeIn 0.5s ease;
}

.spinner-container {
    margin-bottom: 1rem;
}

.action-section {
    padding-top: 1.5rem;
    border-top: 1px solid #e9ecef;
}

.btn-primary {
    background: linear-gradient(135deg, #7367F0 0%, #7367F0 100%);
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.alert {
    border-radius: 10px;
    border: none;
    padding: 1rem 1.25rem;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
}

.alert-danger {
    background: #fee2e2;
    color: #991b1b;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .import-header {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem;
    }
    
    .header-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .import-body {
        padding: 1.5rem;
    }
    
    .upload-area {
        padding: 2rem 1rem;
    }
    
    .action-section .d-flex {
        flex-direction: column;
        gap: 1rem;
    }
    
    .upload-info {
        text-align: center;
    }
}
</style>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('csvUpload');
    
    // Add drag and drop visual feedback
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        uploadArea.style.borderColor = '#4361ee';
        uploadArea.style.background = '#f0f4ff';
    }
    
    function unhighlight() {
        uploadArea.style.borderColor = '#dee2e6';
        uploadArea.style.background = '#f8f9fa';
    }
    
    // Handle file drop
    uploadArea.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        
        // Trigger Livewire file upload
        const event = new Event('change', { bubbles: true });
        fileInput.dispatchEvent(event);
    }
});
</script>