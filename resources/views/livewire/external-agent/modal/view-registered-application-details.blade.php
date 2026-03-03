<div>
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); animation: fadeIn 0.3s ease-in-out;">
            <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 95vw;">
                <div class="modal-content" style="height: 92vh; animation: slideDown 0.4s ease; border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <!-- Gradient Header -->
                    <div class="modal-header bg-primary" style=" border-bottom: none;">
                        <div class="d-flex align-items-center">
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-user-graduate text-primary" style="font-size: 1.2rem;"></i>
                            </div>
                            <div>
                                <h5 class="modal-title text-white mb-0">
                                    Application Details
                                </h5>
                                <p class="text-white-50 mb-0" style="font-size: 0.85rem; opacity: 0.9;">
                                    {{ $student_name ?? 'Student Record' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body" style="overflow-y: auto; background-color: #f8fafc;">
                        <!-- Student Profile Card -->
                        <div class="card mb-4 border-0 shadow-sm" style="border-radius: 10px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
                            <div class="card-body p-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-xl position-relative bg-primary text-white" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                            <span class="avatar-initials">{{ Str::substr($student_name ?? 'S', 0, 1) }}</span>
                                        </div>

                                    </div>
                                    <div class="col">
    <h5 class="mb-1">{{ $student_name ?? 'No Name' }}</h5>
    <div class="d-flex flex-wrap gap-2">
        @if($student_contact)
        <span class="badge bg-light text-dark">
            <i class="fas fa-phone me-1 text-primary"></i> {{ $student_contact }}
        </span>
        @endif
        
        @if($passport_number)
        <span class="badge bg-light text-dark">
            <i class="fas fa-passport me-1 text-primary"></i> {{ $passport_number }}
        </span>
        @endif
        
        @php
            $statusConfig = [
                'caseclosed' => ['color' => '#c01414', 'icon' => 'fa-archive'],
                'casreceived' => ['color' => '#828383', 'icon' => 'fa-file-invoice'],
                'conditional' => ['color' => '#27391C', 'icon' => 'fa-file-signature'],
                'enrollment' => ['color' => '#009688', 'icon' => 'fa-user-graduate'],
                'processed' => ['color' => '#09122C', 'icon' => 'fa-tasks'],
                'unconditional' => ['color' => '#87431D', 'icon' => 'fa-file-contract'],
                'underassessment' => ['color' => '#517577', 'icon' => 'fa-hourglass-half'],
                'undercas' => ['color' => '#C69749', 'icon' => 'fa-passport'],
                'visaprocess' => ['color' => '#673AB7', 'icon' => 'fa-stamp'],
                'registered' => ['color' => '#28a745', 'icon' => 'fa-clipboard-list'],
            ];
            
            // Default to 'underassessment' if status is not set
            $currentStatus = strtolower($inquiry_status ?? 'underassessment');
            $config = $statusConfig[$currentStatus] ?? $statusConfig['underassessment'];
        @endphp
        
        <span class="badge" style="font-size: 13px; padding: 4px 8px; background-color: {{ $config['color'] }}; color: white;">
            <i class="fas {{ $config['icon'] }} me-1"></i>
            {{ ucfirst($currentStatus) }}
        </span>
                    {{-- Partner Badge --}}
        
    </div>
</div>
                                    <div class="col-auto">
                                        <div class="text-end">
                                            <small class="text-muted">Created</small>
                                            <div class="fw-semibold">
                                                @if($created_at)
                                                    {{ \Carbon\Carbon::parse($created_at)->format('M d, Y') }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Content Tabs -->
                        <div class="mb-4">
                            <ul class="nav nav-tabs nav-justified" id="studentDetailsTab" role="tablist" style="border-bottom: 2px solid #dee2e6;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" style="border: none; color: #495057; font-weight: 500;">
                                        <i class="fas fa-user-circle me-2"></i>Personal
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button" role="tab" style="border: none; color: #495057; font-weight: 500;">
                                        <i class="fas fa-graduation-cap me-2"></i>Academic
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab" style="border: none; color: #495057; font-weight: 500;">
                                        <i class="fas fa-file-alt me-2"></i>Documents
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="remarks-tab" data-bs-toggle="tab" data-bs-target="#remarks" type="button" role="tab" style="border: none; color: #495057; font-weight: 500;">
                                        <i class="fas fa-comments me-2"></i>Remarks
                                    </button>
                                </li>
                            </ul>
                            
                            <div class="tab-content mt-3" id="studentDetailsTabContent">
                                <!-- Personal Information Tab -->
                                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                    <div class="row">
    <div class="col-md-6 d-flex">
        <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
            <div class="card-header bg-transparent border-0" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
                <h6 class="mb-0"><i class="fas fa-id-card me-2 text-primary"></i> Basic Info</h6>
            </div>
            <div class="card-body d-flex flex-column">
                <div class="mb-3 flex-grow-1">
                    <label class="form-label text-muted small mb-1">Full Name</label>
                    <div class="fw-semibold">{{ $student_name ?? 'N/A' }}</div>
                </div>
                <div class="mb-3 flex-grow-1">
                    <label class="form-label text-muted small mb-1">Primary Contact</label>
                    <div class="fw-semibold">{{ $student_contact ?? 'N/A' }}</div>
                </div>
                <div class="mb-3 flex-grow-1">
                    <label class="form-label text-muted small mb-1">Passport Number</label>
                    <div class="fw-semibold">{{ $passport_number ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 d-flex">
        <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
            <div class="card-header bg-transparent border-0" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
                <h6 class="mb-0"><i class="fas fa-phone-alt me-2"></i> Emergency Contacts</h6>
            </div>
            <div class="card-body d-flex flex-column">
                <div class="mb-3 flex-grow-1">
                    <label class="form-label text-muted small mb-1">Contact 1</label>
                    <div class="fw-semibold">{{ $emergency_contact_1 ?? 'N/A' }}</div>
                </div>
                <div class="mb-3 flex-grow-1">
                    <label class="form-label text-muted small mb-1">Contact 2</label>
                    <div class="fw-semibold">{{ $emergency_contact_2 ?? 'N/A' }}</div>
                </div>
                <div class="mb-3 flex-grow-1">
                    <label class="form-label text-muted small mb-1">Gmail & Password</label>
                    @if(!empty($gmail_password))
                        @php
                            $parts = explode('/', $gmail_password, 2);
                            $email = trim($parts[0] ?? '');
                            $password = trim($parts[1] ?? '');
                        @endphp
                        <div class="fw-semibold">{{ $email ? e($email) : 'N/A' }}</div>
                        @if($password)
                            <div class="small text-muted mt-1">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-key me-1"></i> {{ e($password) }}
                                </span>
                            </div>
                        @endif
                    @else
                        <div class="fw-semibold">N/A</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
                                </div>
                                
                                <!-- Academic Information Tab -->
                                <div class="tab-pane fade" id="academic" role="tabpanel" aria-labelledby="academic-tab">
        <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
                                        <div class="card-header bg-transparent border-0" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
                                            <h6 class="mb-0"><i class="fas fa-university me-2 text-primary"></i> University Details</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small mb-1">University Name</label>
                                                        <div class="fw-semibold">{{ $university_name ?? 'N/A' }}</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small mb-1">Course Name</label>
                                                        <div class="fw-semibold">{{ $course_name ?? 'N/A' }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small mb-1">Course Intake</label>
                                                        <div class="fw-semibold">{{ $course_intake ?? 'N/A' }}</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small mb-1">Course Link</label>
                                                        <div>
                                                            @if(!empty($course_link))
                                                                <a href="{{ $course_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-external-link-alt me-1"></i> View Course
                                                                </a>
                                                            @else
                                                                <span class="text-muted">N/A</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
<!-- Documents Tab -->
<div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
    <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
            <h6 class="mb-0"><i class="fas fa-folder-open me-2 text-primary"></i> Student Documents</h6>
            @if($matric_dmc_path || $intermediate_dmc_path || $bs_hons_path || $ba_bsc_path || $ma_msc_path || $reference_letters_path || $cv_file_path || $passport_pages_path || $experience_letter_path || $english_test_path || $agent_consent_path || $student_consent_path || $additional_docs_path || $refusal_letter_path || $extra_path || $extra2_path || $extra3_path || $extra4_path || $extra5_path || $extra6_path || $extra7_path || $extra8_path || $extra9_path || $extra10_path || $extra11_path)
            @php
                $docCount = ($matric_dmc_path?1:0) + ($intermediate_dmc_path?1:0) + ($bs_hons_path?1:0) + 
                           ($ba_bsc_path?1:0) + ($ma_msc_path?1:0) + ($reference_letters_path?1:0) + 
                           ($cv_file_path?1:0) + ($passport_pages_path?1:0) + ($experience_letter_path?1:0) + 
                           ($english_test_path?1:0) + ($agent_consent_path?1:0) + ($student_consent_path?1:0) + 
                           ($additional_docs_path?1:0) + ($refusal_letter_path?1:0) + ($extra_path?1:0) + 
                           ($extra2_path?1:0) + ($extra3_path?1:0) + ($extra4_path?1:0) + ($extra5_path?1:0) + 
                           ($extra6_path?1:0) + ($extra7_path?1:0) + ($extra8_path?1:0) + ($extra9_path?1:0) + 
                           ($extra10_path?1:0) + ($extra11_path?1:0);
            @endphp
            <button wire:click="downloadAllDocuments" 
                    wire:loading.attr="disabled"
                    class="btn btn-sm fw-semibold position-relative d-flex align-items-center"
                    style="
                        background: linear-gradient(135deg, #7367f0 0%, #20c997 100%);
                        color: white;
                        border: none;
                        border-radius: 8px;
                        padding: 8px 16px;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 6px rgba(40, 167, 69, 0.25);
                    "
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(40, 167, 69, 0.35)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(40, 167, 69, 0.25)'">
                <i class="fas fa-download me-1"></i> 
                <span wire:loading.remove>Download All</span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                    Preparing...
                </span>
                <span class="badge bg-white text-dark ms-2 py-1 px-2 rounded-pill" style="font-size: 0.65rem;">
                    {{ $docCount }}
                </span>
            </button>
            @endif
        </div>


        <div class="card-body">
            <div class="row g-3">
                <!-- Document Cards -->
                @if($matric_dmc_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('matricdmc.show', basename($matric_dmc_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-graduation-cap text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Matric DMC</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($intermediate_dmc_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('intermediatedmc.show', basename($intermediate_dmc_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-certificate text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Intermediate DMC</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($bs_hons_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('bshons.show', basename($bs_hons_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-user-graduate text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">BS/Hons</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($ba_bsc_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('babsc.show', basename($ba_bsc_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-book text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">BA/BSc</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($ma_msc_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('mamsc.show', basename($ma_msc_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
<i class="fas fa-graduation-cap text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">MA/MSc</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($reference_letters_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('referenceletters.show', basename($reference_letters_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-signature text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Reference Letters</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($cv_file_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('cv.show', basename($cv_file_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
<i class="fas fa-user text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">CV</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($passport_pages_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('passport.show', basename($passport_pages_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-passport text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Passport Pages</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($experience_letter_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('experience.show', basename($experience_letter_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-briefcase text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Experience Letter</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($english_test_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('englishtest.show', basename($english_test_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-language text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">English Test</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($agent_consent_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('agentconsent.show', basename($agent_consent_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-handshake text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Agent Consent</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($student_consent_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('studentconsent.show', basename($student_consent_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-user-check text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Student Consent</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($additional_docs_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('additionaldocs.show', basename($additional_docs_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Additional Docs</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($has_refusal_letter === 'yes' && $refusal_letter_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('refusalletter.show', basename($refusal_letter_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #dc3545;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-times-circle text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Refusal Letter</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra.show', basename($extra_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 1</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra2_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra2.show', basename($extra2_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 2</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra3_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra3.show', basename($extra3_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 3</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra4_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra4.show', basename($extra4_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 4</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra5_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra5.show', basename($extra5_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 5</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra6_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra6.show', basename($extra6_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 6</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra7_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra7.show', basename($extra7_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 7</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra8_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra8.show', basename($extra8_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 8</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra9_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra9.show', basename($extra9_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 9</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra10_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra10.show', basename($extra10_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 10</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($extra11_path)
                <div class="col-md-4 col-6">
                    <div class="document-card h-100">
                        <a href="{{ route('extra11.show', basename($extra11_path)) }}" target="_blank" class="d-block text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s;">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <h6 class="mb-0" style="font-size: 0.85rem;">Extra 11</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
                                <!-- Remarks Tab -->
                                <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
        <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
                                        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center bg-primary" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
                                            <h6 class="mb-0 text-white"><i class="fas fa-comment-dots me-2 text-white"></i> Remarks History</h6>
                                            
                                        </div>
                                        <div class="card-body mt-4">
                                            <div class="timeline-remarks" style="max-height: 400px; overflow-y: auto;">
                                                @if($notes_history)
            @php
                // Safe notes history processing
                if (is_string($notes_history)) {
                    $history = json_decode($notes_history, true) ?? [];
                } else {
                    $history = $notes_history ?? [];
                }
                
                // Ensure it's an array and reverse for display (newest first)
                $history = is_array($history) ? array_reverse($history) : [];
            @endphp
                                                    
                                                    @foreach($history as $note)
                                                    <div class="timeline-item mb-4 position-relative">
                                                        <div class="timeline-badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; position: absolute; left: 0; top: 0;">
                                                            <i class="fas fa-comment" style="font-size: 0.75rem;"></i>
                                                        </div>
                                                        <div class="ms-5 ps-3">
                                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                                <span class="fw-semibold">{{ $note['user_name'] ?? (Str::contains($note['note'], ':') ? Str::before($note['note'], ':') : 'System') }}</span>
                                                                <small class="text-muted">{{ \Carbon\Carbon::parse($note['timestamp'])->format('M d, Y h:i A') }}</small>
                                                            </div>
                                                            <div class="card border-0 shadow-none bg-light" style="border-radius: 8px; border-left: 3px solid #4b6cb7 !important;">
                                                                <div class="card-body py-2">
                                                                    @if(Str::contains($note['note'], ':'))
                                                                        @php
                                                                            $parts = explode(':', $note['note'], 2);
                                                                            $remainingText = trim($parts[1] ?? '');
                                                                        @endphp
                                                                        <div class="text-dark">{{ nl2br(e($remainingText)) }}</div>
                                                                    @else
                                                                        <div class="text-dark">{{ nl2br(e($note['note'])) }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <div class="text-center py-5">
                                                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                                            <i class="fas fa-comment-slash text-muted" style="font-size: 1.5rem;"></i>
                                                        </div>
                                                        <h6 class="text-muted">No remarks yet</h6>
                                                        <p class="small text-muted mb-0">Add your first remark to get started</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0" style="background-color: #f8fafc;">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">
                             Close
                        </button>
                       
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes slideDown {
                from { transform: scale(0.95) translateY(-10px); opacity: 0; }
                to { transform: scale(1) translateY(0); opacity: 1; }
            }
            
            .document-card:hover .card {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
            }
            
            .nav-tabs .nav-link {
                padding: 12px 0;
                position: relative;
            }
            
            .nav-tabs .nav-link.active {
                color: #4b6cb7 !important;
                font-weight: 600 !important;
            }
            
            .nav-tabs .nav-link.active:after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 100%;
                height: 3px;
                background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
                border-radius: 3px 3px 0 0;
            }
            
            .avatar-initials {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                font-weight: 600;
            }
            
            .timeline-remarks::-webkit-scrollbar {
                width: 6px;
            }
            
            .timeline-remarks::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }
            
            .timeline-remarks::-webkit-scrollbar-thumb {
                background: #c1c1c1;
                border-radius: 10px;
            }
            
            .timeline-remarks::-webkit-scrollbar-thumb:hover {
                background: #a1a1a1;
            }
        </style>
    @endif
</div>