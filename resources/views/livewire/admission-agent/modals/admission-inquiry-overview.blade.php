<div>
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); animation: fadeIn 0.2s ease-in-out;">
            <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 95vw;">
                <div class="modal-content" style="height: 92vh; animation: slideDown 0.4s ease; border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                      <div class="modal-header bg-primary d-flex justify-content-between align-items-center" style="border-bottom: none;">
    <!-- Left Side (icon + title + student name) -->
    <div class="d-flex align-items-center">
        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
            <i class="fas fa-user-graduate text-primary" style="font-size: 1.2rem;"></i>
        </div>
        <div>
            <h5 class="modal-title text-white mb-0">
                Admission Inquiry Details
            </h5>
            <p class="text-white-50 mb-0" style="font-size: 0.85rem; opacity: 0.9;">
                {{ $student_name ?? 'Student Record' }}
            </p>
        </div>
    </div>

    <!-- Right Side (Unique ID Badge) -->
    <div>
        <span class="badge bg-white text-dark px-3 py-2 fs-6  shadow-sm">
            <i class="fas fa-hashtag me-1"></i> {{ $unique_id ?? 'N/A' }}
        </span>
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
                                                    'rejection' => ['color' => '#ff0000', 'icon' => 'fa-times-circle'],
                        'withdrawn' => ['color' => '#ff5252', 'icon' => 'fa-user-slash'],
                                                    'visaprocess' => ['color' => '#673AB7', 'icon' => 'fa-stamp'],
                                                    'registered' => ['color' => '#28a745', 'icon' => 'fa-clipboard-list'],
                                                ];
                                                
                                                $currentStatus = strtolower($inquiry_status ?? 'underassessment');
                                                $config = $statusConfig[$currentStatus] ?? $statusConfig['underassessment'];
                                            @endphp
                                            
                                            <span class="badge" style="font-size: 13px; padding: 4px 8px; background-color: {{ $config['color'] }}; color: white;">
                                                <i class="fas {{ $config['icon'] }} me-1"></i>
                                                {{ ucfirst($currentStatus) }}
                                            </span>
                                                      {{-- Partner Badge --}}
                @if($partner)
<span class="badge" style="font-size: 13px; padding: 4px 8px; background-color: #f0eeff; color: #5a4fd6; border: 1px solid #d9d4ff;">
    <i class="fas fa-handshake me-1"></i>
    {{ $partner }}
</span>
@endif
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
    <button class="nav-link" id="accounts-tab" data-bs-toggle="tab" data-bs-target="#accounts" type="button" role="tab" style="border: none; color: #495057; font-weight: 500;">
        <i class="fas fa-key me-2"></i>Accounts
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
                                    <button class="nav-link" id="assignment-tab" data-bs-toggle="tab" data-bs-target="#assignment" type="button" role="tab" style="border: none; color: #495057; font-weight: 500;">
                                        <i class="fas fa-users me-2"></i>Assignment
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
                    
                    <!-- ADD STATUS FIELDS HERE -->
                    <div class="mb-3 flex-grow-1">
                        <label class="form-label text-muted small mb-1">Status Changed At</label>
                        <div class="fw-semibold">
                            {{ $status_change_time ? \Carbon\Carbon::parse($status_change_time)->format('M d, Y h:i A') : 'N/A' }}
                        </div>
                    </div>
                    <div class="mb-3 flex-grow-1">
                        <label class="form-label text-muted small mb-1">Previous Status</label>
                        <div class="fw-semibold text-capitalize">{{ $last_inquiry_status ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Accounts Information Tab -->
<div class="tab-pane fade" id="accounts" role="tabpanel" aria-labelledby="accounts-tab">
    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
                <div class="card-header bg-transparent border-0" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
                    <h6 class="mb-0"><i class="fas fa-lock me-2 text-primary"></i> Account Logins</h6>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="mb-3 flex-grow-1">
                        <label class="form-label text-muted small mb-1">Application Portal Logins</label>
                        @if(!empty($application_portal_logins))
                            @php
                                $parts = explode('/', $application_portal_logins, 2);
                                $username = trim($parts[0] ?? '');
                                $password = trim($parts[1] ?? '');
                            @endphp
                            <div class="fw-semibold">{{ $username ? e($username) : 'N/A' }}</div>
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
                    
                    <div class="mb-3 flex-grow-1">
                        <label class="form-label text-muted small mb-1">CAS Shield Logins</label>
                        @if(!empty($cas_shield_logins))
                            @php
                                $parts = explode('/', $cas_shield_logins, 2);
                                $username = trim($parts[0] ?? '');
                                $password = trim($parts[1] ?? '');
                            @endphp
                            <div class="fw-semibold">{{ $username ? e($username) : 'N/A' }}</div>
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
                    
                    <div class="mb-3 flex-grow-1">
                        <label class="form-label text-muted small mb-1">Enrollment Logins</label>
                        @if(!empty($enrollment_logins))
                            @php
                                $parts = explode('/', $enrollment_logins, 2);
                                $username = trim($parts[0] ?? '');
                                $password = trim($parts[1] ?? '');
                            @endphp
                            <div class="fw-semibold">{{ $username ? e($username) : 'N/A' }}</div>
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
        
        <div class="col-md-6 d-flex">
            <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
                <div class="card-header bg-transparent border-0" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
                    <h6 class="mb-0"><i class="fas fa-link me-2"></i>Visa Application Links</h6>
                </div>
               <div class="card-body d-flex flex-column">
    <div class="mb-3 flex-grow-1">
        <label class="form-label text-muted small mb-1">Visa Application Links</label>
        @if(!empty($visa_application_links))
            @php
                $parts = explode(',', $visa_application_links, 2);
                $link = trim($parts[0] ?? '');
                $description = trim($parts[1] ?? '');
            @endphp
            <div class="fw-semibold">{{ $link ? e($link) : 'N/A' }}</div>
            <div>
                <a href="{{ $link }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                    <i class="fas fa-external-link-alt me-1"></i> View Visa Application
                </a>
            </div>
            @if($description)
                <div class="small text-muted mt-2">
                    <span class="badge bg-light text-dark">
                        <i class="fas fa-key me-1"></i> {{ e($description) }}
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
                                                                <!-- Documents Tab -->
<div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
    <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
            <h6 class="mb-0"><i class="fas fa-folder-open me-2 text-primary"></i> Student Documents</h6>
            @php
                // Calculate total available documents
                $totalDocs = 0;
                $documentFields = [
                    'matric_dmc_path', 'intermediate_dmc_path', 'bs_hons_path', 'ba_bsc_path', 'ma_msc_path',
                    'reference_letters_path', 'cv_file_path', 'passport_pages_path', 'experience_letter_path',
                    'english_test_path', 'agent_consent_path', 'student_consent_path', 'additional_docs_path',
                    'refusal_letter_path', 'sop_path', 'fee_voucher_path', 'bank_statement_path', 'interview_pass_path',
                    'tb_test_path', 'fee_payment_path', 'cas_document_path', 'cnic_path', 'new_bank_statement_path',
                    'visa_history_path', 'visa_application_path', 'appointment_letter_path', 'decision_letter_path',
                    'e_visa_path', 'student_id_card_path', 'birth_certificate', 'parental_consent_letter', 'funds_source',
                    'application_submission', 'conditional_document','extra_undercas', 'extra_path', 'extra2_path', 'extra3_path',
                    'extra4_path', 'extra5_path', 'extra6_path', 'extra7_path', 'extra8_path', 'extra9_path',
                    'extra10_path', 'extra11_path',            'extra_undercas_path'

                ];
                
                foreach ($documentFields as $field) {
                    if (!empty($$field)) {
                        $totalDocs++;
                    }
                }
            @endphp
            
            @if($totalDocs > 0)
            <button wire:click="downloadAllDocuments" 
                    wire:loading.attr="disabled"
                    class="btn btn-sm fw-semibold position-relative d-flex align-items-center"
                    style="
                        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
                    {{ $totalDocs }}
                </span>
            </button>
            @endif
        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <!-- Document Cards - Similar to your sample but with all your document paths -->
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
                                                @if($sop_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('sop.show', basename($sop_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #17a2b8;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-file-alt text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Statement of Purpose</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Fee Voucher -->
                                                @if($fee_voucher_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('fee-voucher.show', basename($fee_voucher_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #fd7e14;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-file-invoice-dollar text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Fee Voucher</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Bank Statement -->
                                                @if($bank_statement_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('bank-statement.show', basename($bank_statement_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #20c997;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-piggy-bank text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Bank Statement</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Interview Pass -->
                                                @if($interview_pass_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('interview-pass.show', basename($interview_pass_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6f42c1;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-user-check text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Interview Pass</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                                                                <!-- Birth Certificate -->
                                                @if($birth_certificate)
                                                <div class="col-md-4 col-6 mb-3">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('birth-certificate.show', basename($birth_certificate)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6f42c1;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-baby text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Birth Certificate</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Parental Consent Letter -->
                                                @if($parental_consent_letter)
                                                <div class="col-md-4 col-6 mb-3">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('parental-consent-letter.show', basename($parental_consent_letter)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6f42c1;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-user-shield text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Parental Consent Letter</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Funds Source -->
                                                @if($funds_source)
                                                <div class="col-md-4 col-6 mb-3">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('funds-source.show', basename($funds_source)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6f42c1;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-piggy-bank text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Source of Funds</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Application Submission -->
                                                @if($application_submission)
                                                <div class="col-md-4 col-6 mb-3">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('application-submission.show', basename($application_submission)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6f42c1;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-file-upload text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Application Submission Document</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Conditional Document -->
                                                @if($conditional_document)
                                                <div class="col-md-4 col-6 mb-3">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('conditional-document.show', basename($conditional_document)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6f42c1;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-file-contract text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Conditional Document</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif
                                                                                                <!-- Extra Under CAS Document -->
@if($extra_undercas_path)
<div class="col-md-4 col-6">
    <div class="document-card h-100">
        <a href="{{ route('extra-undercas.show', basename($extra_undercas_path)) }}" target="_blank" class="d-block text-decoration-none">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6f42c1;">
                <div class="card-body text-center py-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
<i class="fas fa-check-circle text-white" style="font-size: 1.25rem;"></i>
                    </div>
                    <h6 class="mb-0" style="font-size: 0.85rem;">Unconditional Document</h6>
                </div>
            </div>
        </a>
    </div>
</div>
@endif

                                                <!-- TB Test -->
                                                @if($tb_test_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('tb-test.show', basename($tb_test_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #dc3545;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-file-medical text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">TB Test</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Fee Payment -->
                                                @if($fee_payment_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('fee-payment.show', basename($fee_payment_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #0dcaf0;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-money-check-alt text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Fee Payment</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- CAS Document -->
                                                @if($cas_document_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('cas-document.show', basename($cas_document_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6610f2;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-graduation-cap text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">CAS Document</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- CNIC -->
                                                @if($cnic_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('cnic.show', basename($cnic_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #ffc107;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-id-card text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">CNIC</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- New Bank Statement -->
                                                @if($new_bank_statement_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('new-bank-statement.show', basename($new_bank_statement_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #198754;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-university text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">New Bank Statement</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Visa History -->
                                                @if($visa_history_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('visa-history.show', basename($visa_history_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6f42c1;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-history text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Visa History</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Visa Application -->
                                                @if($visa_application_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('visa-application.show', basename($visa_application_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #0d6efd;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-file-signature text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Visa Application</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Appointment Letter -->
                                                @if($appointment_letter_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('appointment-letter.show', basename($appointment_letter_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #d63384;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-calendar-check text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Appointment Letter</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Decision Letter -->
                                                @if($decision_letter_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('decision-letter.show', basename($decision_letter_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #fd7e14;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-file-contract text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Decision Letter</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- E-Visa -->
                                                @if($e_visa_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('e-visa.show', basename($e_visa_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #20c997;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-stamp text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">E-Visa</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Student ID Card -->
                                                @if($student_id_card_path)
                                                <div class="col-md-4 col-6">
                                                    <div class="document-card h-100">
                                                        <a href="{{ route('student-id-card.show', basename($student_id_card_path)) }}" target="_blank" class="d-block text-decoration-none">
                                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px; transition: all 0.3s; border-left: 3px solid #6610f2;">
                                                                <div class="card-body text-center py-4">
                                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                                                        <i class="fas fa-id-card-alt text-white" style="font-size: 1.25rem;"></i>
                                                                    </div>
                                                                    <h6 class="mb-0" style="font-size: 0.85rem;">Student ID Card</h6>
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
                
                                                    

                                                <!-- Add all other document cards similarly -->
                                                <!-- ... -->

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
                                                                              <!-- Enhanced Missing Documents Section - Appears at the end -->
                      @if(count($missingDocuments) > 0)
<div class="document-status-panel mt-5">
    <div class="status-header d-flex align-items-center mb-4">
        <div class="status-icon me-3">
            <i class="fas fa-clipboard-list fa-2x text-primary"></i>
        </div>
        <div>
            <h5 class="mb-0">Document Requirements Status</h5>
            <p class="text-muted mb-0">Review pending documents for this student</p>
        </div>
    </div>

    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex">
            <i class="fas fa-info-circle me-3 mt-1"></i>
            <div>
                <strong>Action Required</strong>
                <p class="mb-0">The following documents need to be uploaded to complete this student's file.</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Missing Documents</h5>
            <div class="row">
                @foreach(array_chunk($missingDocuments, ceil(count($missingDocuments) / 3)) as $chunk)
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        @foreach($chunk as $missingDoc)
                        <li class="list-group-item d-flex align-items-center px-0">
                            <span class="badge bg-danger me-2">
                                <i class="fas fa-times fa-xs"></i>
                            </span>
                            <span>{{ $missingDoc }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="progress-section">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Document Completion</h6>
            @php
                $totalDocuments = count($missingDocuments) + (
                    (!empty($matric_dmc_path) ? 1 : 0) +
                    (!empty($intermediate_dmc_path) ? 1 : 0) +
                    (!empty($bs_hons_path) ? 1 : 0) +
                    (!empty($ba_bsc_path) ? 1 : 0) +
                    (!empty($ma_msc_path) ? 1 : 0) +
                    (!empty($reference_letters_path) ? 1 : 0) +
                    (!empty($cv_file_path) ? 1 : 0) +
                    (!empty($passport_pages_path) ? 1 : 0) +
                    (!empty($experience_letter_path) ? 1 : 0) +
                    (!empty($english_test_path) ? 1 : 0) +
                    (!empty($agent_consent_path) ? 1 : 0) +
                    (!empty($student_consent_path) ? 1 : 0) +
                    (!empty($additional_docs_path) ? 1 : 0) +
                    (!empty($refusal_letter_path) ? 1 : 0) +
                    (!empty($sop_path) ? 1 : 0) +
                    (!empty($fee_voucher_path) ? 1 : 0) +
                    (!empty($bank_statement_path) ? 1 : 0) +
                    (!empty($interview_pass_path) ? 1 : 0) +
                    (!empty($tb_test_path) ? 1 : 0) +
                    (!empty($fee_payment_path) ? 1 : 0) +
                    (!empty($cas_document_path) ? 1 : 0) +
                    (!empty($cnic_path) ? 1 : 0) +
                    (!empty($new_bank_statement_path) ? 1 : 0) +
                    (!empty($visa_history_path) ? 1 : 0) +
                    (!empty($visa_application_path) ? 1 : 0) +
                    (!empty($appointment_letter_path) ? 1 : 0) +
                    (!empty($decision_letter_path) ? 1 : 0) +
                    (!empty($e_visa_path) ? 1 : 0) +
                    (!empty($student_id_card_path) ? 1 : 0) +
                    (!empty($birth_certificate) ? 1 : 0) +
                    (!empty($parental_consent_letter) ? 1 : 0) +
                    (!empty($funds_source) ? 1 : 0) +
                    (!empty($application_submission) ? 1 : 0) +
                    (!empty($conditional_document) ? 1 : 0) +
                                                                            (!empty($extra_undercas_path) ? 1 : 0) +

                    (!empty($extra_path) ? 1 : 0) +
                    (!empty($extra2_path) ? 1 : 0) +
                    (!empty($extra3_path) ? 1 : 0) +
                    (!empty($extra4_path) ? 1 : 0) +
                    (!empty($extra5_path) ? 1 : 0) +
                    (!empty($extra6_path) ? 1 : 0) +
                    (!empty($extra7_path) ? 1 : 0) +
                    (!empty($extra8_path) ? 1 : 0) +
                    (!empty($extra9_path) ? 1 : 0) +
                    (!empty($extra10_path) ? 1 : 0) +
                    (!empty($extra11_path) ? 1 : 0)
                );
                $uploadedDocuments = $totalDocuments - count($missingDocuments);
                $completionPercentage = $totalDocuments > 0 ? ($uploadedDocuments / $totalDocuments) * 100 : 100;
            @endphp
            <span class="text-muted">{{ $uploadedDocuments }}/{{ $totalDocuments }} ({{ round($completionPercentage) }}%)</span>
        </div>
        <div class="progress mb-3" style="height: 8px;">
            <div class="progress-bar" role="progressbar" 
                 style="width: {{ $completionPercentage }}%;" 
                 aria-valuenow="{{ $completionPercentage }}" 
                 aria-valuemin="0" 
                 aria-valuemax="100"></div>
        </div>
    </div>
</div>

<style>
.document-status-panel {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #343a40;
}

.status-header {
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.status-icon {
    background-color: #f8f9fa;
    width: 50px;
    height: 50px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.card-title {
    font-weight: 600;
    color: #495057;
}

.list-group-item {
    border: none;
    padding: 0.5rem 0;
    font-size: 0.9rem;
}

.progress {
    border-radius: 4px;
    background-color: #f0f0f0;
}

.progress-bar {
    background-color: #7367f0;
    border-radius: 4px;
}

.alert-info {
    background-color: #e8f4ff;
    border-color: #b8daff;
    color: #004085;
    border-radius: 6px;
}

.badge {
    padding: 0.35em 0.5em;
    border-radius: 4px;
}
</style>
@else
<div class="document-complete-panel text-center mt-5 py-5">
    <div class="complete-icon mb-3">
        <i class="fas fa-check-circle fa-3x text-success"></i>
    </div>
    <h4 class="text-success mb-2">All Documents Uploaded</h4>
    <p class="text-muted mb-4">Great job! This student's file is complete with all required documents.</p>
    
    @php
        $totalDocuments = (
            (!empty($matric_dmc_path) ? 1 : 0) +
            (!empty($intermediate_dmc_path) ? 1 : 0) +
            (!empty($bs_hons_path) ? 1 : 0) +
            (!empty($ba_bsc_path) ? 1 : 0) +
            (!empty($ma_msc_path) ? 1 : 0) +
            (!empty($reference_letters_path) ? 1 : 0) +
            (!empty($cv_file_path) ? 1 : 0) +
            (!empty($passport_pages_path) ? 1 : 0) +
            (!empty($experience_letter_path) ? 1 : 0) +
            (!empty($english_test_path) ? 1 : 0) +
            (!empty($agent_consent_path) ? 1 : 0) +
            (!empty($student_consent_path) ? 1 : 0) +
            (!empty($additional_docs_path) ? 1 : 0) +
            (!empty($refusal_letter_path) ? 1 : 0) +
            (!empty($sop_path) ? 1 : 0) +
            (!empty($fee_voucher_path) ? 1 : 0) +
            (!empty($bank_statement_path) ? 1 : 0) +
            (!empty($interview_pass_path) ? 1 : 0) +
            (!empty($tb_test_path) ? 1 : 0) +
            (!empty($fee_payment_path) ? 1 : 0) +
            (!empty($cas_document_path) ? 1 : 0) +
            (!empty($cnic_path) ? 1 : 0) +
            (!empty($new_bank_statement_path) ? 1 : 0) +
            (!empty($visa_history_path) ? 1 : 0) +
            (!empty($visa_application_path) ? 1 : 0) +
            (!empty($appointment_letter_path) ? 1 : 0) +
            (!empty($decision_letter_path) ? 1 : 0) +
            (!empty($e_visa_path) ? 1 : 0) +
            (!empty($student_id_card_path) ? 1 : 0) +
            (!empty($birth_certificate) ? 1 : 0) +
            (!empty($parental_consent_letter) ? 1 : 0) +
            (!empty($funds_source) ? 1 : 0) +
            (!empty($application_submission) ? 1 : 0) +
            (!empty($conditional_document) ? 1 : 0) +
                                                                    (!empty($extra_undercas_path) ? 1 : 0) +

            (!empty($extra_path) ? 1 : 0) +
            (!empty($extra2_path) ? 1 : 0) +
            (!empty($extra3_path) ? 1 : 0) +
            (!empty($extra4_path) ? 1 : 0) +
            (!empty($extra5_path) ? 1 : 0) +
            (!empty($extra6_path) ? 1 : 0) +
            (!empty($extra7_path) ? 1 : 0) +
            (!empty($extra8_path) ? 1 : 0) +
            (!empty($extra9_path) ? 1 : 0) +
            (!empty($extra10_path) ? 1 : 0) +
            (!empty($extra11_path) ? 1 : 0)
        );
    @endphp
    
    <div class="stats-box bg-light rounded p-3 mx-auto" style="max-width: 300px;">
        <p class="mb-1"><small class="text-muted">TOTAL DOCUMENTS</small></p>
        <h3 class="mb-0 text-primary">{{ $totalDocuments }}</h3>
    </div>
</div>

<style>
.document-complete-panel {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.complete-icon {
    opacity: 0.9;
}

.stats-box {
    border: 1px solid #e9ecef;
}
</style>
@endif
                                        </div>
                                    </div>
                                </div>
                                
                                                                <!-- Assignment Tab -->
<div class="tab-pane fade" id="assignment" role="tabpanel" aria-labelledby="assignment-tab">
    <div class="card mb-3 border-0 w-100" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.08);">
        <div class="card-header bg-transparent border-0" style="background-color: #f1f5f9; border-radius: 10px 10px 0 0 !important;">
            <h6 class="mb-0"><i class="fas fa-users me-2 text-primary"></i> Assignment Details</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-muted small mb-1">Current Status</label>
                        <div class="fw-semibold text-capitalize">{{ $status ?? 'N/A' }}</div>
                    </div>
                    <div class="mb-3">
    <label class="form-label text-muted small mb-1">Assigned To</label>
    <div class="fw-semibold">
        @if($assigned_user_name)
            {{ $assigned_user_name }}
        @else
            Not assigned
        @endif
    </div>
</div>
<!-- ADD REGISTERED BY FIELD HERE -->
<div class="mb-3">
    <label class="form-label text-muted small mb-1">Registered By</label>
    <div class="fw-semibold">
        @if($registered_by_user_name)
            <div class="d-flex align-items-center gap-2">
                <span>{{ $registered_by_user_name }}</span>
                @if($registered_by_user_role)
                    <span class="badge bg-primary bg-opacity-10 text-white px-2 py-1" style="font-size: 0.7rem;">
                        {{ $this->getRoleDisplayText($registered_by_user_role) }}
                    </span>
                @endif
            </div>
        @else
            User #{{ $users_id }}
        @endif
    </div>
</div>
<div class="mb-3">
                        <label class="form-label text-muted small mb-1">Previous Status</label>
                        <div class="fw-semibold text-capitalize">{{ $last_inquiry_status ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-muted small mb-1">Assigned At</label>
                        <div class="fw-semibold">
                            @if($assigned_at)
                                {{ \Carbon\Carbon::parse($assigned_at)->format('M d, Y h:i A') }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
    <label class="form-label text-muted small mb-1">Previously Assigned To</label>
    <div class="fw-semibold">
        @if($previous_assigned_user_name)
            {{ $previous_assigned_user_name }}
        @else
            N/A
        @endif
    </div>
</div>
                    <!-- ADD STATUS FIELDS HERE -->
                    <div class="mb-3">
                        <label class="form-label text-muted small mb-1">Status Changed At</label>
                        <div class="fw-semibold">
                            {{ $status_change_time ? \Carbon\Carbon::parse($status_change_time)->format('M d, Y h:i A') : 'N/A' }}
                        </div>
                    </div>
                    
                </div>
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
                                        <div class="text-dark">{!! nl2br(htmlspecialchars_decode(trim($remainingText))) !!}</div>
                                    @else
                                        <div class="text-dark">{!! nl2br(htmlspecialchars_decode(trim($note['note']))) !!}</div>
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
            .border-dashed {
    border-style: dashed !important;
}

.list-group-item {
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa !important;
}
            
            .nav-tabs .nav-link {
                padding: 12px 0;
                position: relative;
            }
            
            .nav-tabs .nav-link.active {
                color: #4b6cb7 !important;
                font-weight: 600 !important;
            }
            .border-dashed {
                border-style: dashed !important;
            }

            .list-group-item {
                transition: all 0.2s ease;
            }

            .list-group-item:hover {
                background-color: #f8f9fa !important;
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