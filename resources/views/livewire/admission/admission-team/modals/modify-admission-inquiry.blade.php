<div>
    @if($showModal)
        <!-- Enhanced Backdrop -->
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); animation: fadeIn 0.3s ease-in-out;">
        
        <!-- Modal Container -->
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 overflow-hidden">
                    <!-- Premium Header -->
                    <div class="modal-header bg-primary-gradient text-white p-4 position-relative">
                        <div class="d-flex align-items-center w-100">
                            <div class="modal-icon-circle bg-white text-primary me-3">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <div>
                                <h5 class="modal-title mb-1 fw-bold text-white">Edit Admission Inquiry</h5>
                                <p class="small opacity-85 mb-0">Update inquiry details and documents</p>
                            </div>
                        </div>
                  <button type="button" class="btn-close position-absolute end-0 me-3" 
        wire:click="closeModal" aria-label="Close"></button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body p-0">
                        @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show m-4 rounded-3 shadow-sm" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <span class="flex-grow-1">{{ session('message') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        
                        <form wire:submit.prevent="update" enctype="multipart/form-data">
                            <!-- Progress Steps -->
                            <div class="steps-progress px-4 pt-3">
                                <div class="d-flex justify-content-between position-relative">
                                    <div class="step active">
                                        <div class="step-badge">1</div>
                                        <span class="step-label">Basic Info</span>
                                    </div>
                                    <div class="step">
                                        <div class="step-badge">2</div>
                                        <span class="step-label">Course</span>
                                    </div>
                                    <div class="step">
                                        <div class="step-badge">3</div>
                                        <span class="step-label">Documents</span>
                                    </div>
                                    <div class="step">
                                        <div class="step-badge">4</div>
                                        <span class="step-label">Remarks</span>
                                    </div>
                                    <div class="progress-bar-track"></div>
                                    <div class="progress-bar-fill" style="width: 25%;"></div>
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <!-- Section 1: Basic Information -->
                                <div class="card-section mb-4">
                                    <div class="section-header">
                                        <i class="fas fa-user-circle section-icon"></i>
                                        <h5 class="section-title">Basic Information</h5>
                                        <span class="required-badge">Required</span>
                                    </div>
                                    <div class="row g-3">
                 
                                        <!-- Student Name -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-user input-icon"></i>
                                                <span>Student Name</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="student_name" required>
                                            </label>
                                            @error('student_name')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        <!-- Passport Number -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-passport input-icon"></i>
                                                <span>Passport Number</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="passport_number" required>
                                            </label>
                                            @error('passport_number')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        <!-- Student Contact -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-phone input-icon"></i>
                                                <span>Student Contact</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="student_contact" required>
                                            </label>
                                            @error('student_contact')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        <!-- Emergency Contact 1 -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-phone-volume input-icon"></i>
                                                <span>Emergency Contact 1</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="emergency_contact_1" required>
                                            </label>
                                            @error('emergency_contact_1')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        <!-- Emergency Contact 2 -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-phone-alt input-icon"></i>
                                                <span>Emergency Contact 2</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="emergency_contact_2">
                                            </label>
                                            @error('emergency_contact_2')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        
                                        <!-- Gmail Password -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-key input-icon"></i>
                                                <span>Gmail Password</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="gmail_password" required>
                                            </label>
                                            @error('gmail_password')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>

  <div class="col-md-12">
    <label class="input-label">
        <i class="fas fa-user-tie input-icon"></i>
        <span>Application By (Agent/Manager)</span>
        <select 
            class="form-input" 
            wire:model="users_id" 
            required
            @if($disableUsersId) disabled @endif
        >
            <option value="">Select Agent/Manager</option>
            @foreach($agents as $agent)
                @php
                    // Convert username from @AhmadAli to Ahmad Ali
                    $displayName = str_replace('@', '', $agent['username']);
                    $displayName = preg_replace('/([a-z])([A-Z])/', '$1 $2', $displayName);
                @endphp

                @if($agent['role'] === 'counsellor')
                    <option value="{{ $agent['id'] }}">{{ $displayName }} - [Counsellor]</option>
                @elseif($agent['role'] === 'manager')
                    <option value="{{ $agent['id'] }}">{{ $displayName }} - [𝗠𝗔𝗡𝗔𝗚𝗘𝗥]</option>
                @else
                    <option value="{{ $agent['id'] }}">{{ $displayName }} - [{{ ucfirst($agent['role']) }}]</option>
                @endif
            @endforeach
        </select>
        
        {{-- Optional: Show a message when field is disabled --}}
        @if($disableUsersId)
            <small class="text-muted">
                <i class="fas fa-info-circle"></i> 
                This field is disabled because the current assigned user is not a counsellor or manager.
            </small>
        @endif
    </label>
    @error('users_id')<div class="input-error">{{ $message }}</div>@enderror
</div>


                                    </div>
                                </div>


                                <!--  Accounts -->
<div class="card-section mb-4">
    <div class="section-header">
        <i class="fas fa-key section-icon"></i>
        <h5 class="section-title">Accounts</h5>
    </div>
    <div class="row g-3">
        <!-- Application Portal Logins -->
        <div class="col-md-6">
            <label class="input-label">
                <i class="fas fa-sign-in-alt input-icon"></i>
                <span>Application Portal Logins</span>
                <input type="text" class="form-input" 
                       wire:model="application_portal_logins"
                       placeholder="username_or_email/password">
                <div class="form-text text-muted small">
                    Format: [username or email]/[password]
                </div>
            </label>
            @error('application_portal_logins')<div class="input-error">{{ $message }}</div>@enderror
        </div>

        <!-- CAS Shield Logins -->
        <div class="col-md-6">
            <label class="input-label">
                <i class="fas fa-shield-alt input-icon"></i>
                <span>CAS Shield Logins</span>
                <input type="text" class="form-input" 
                       wire:model="cas_shield_logins"
                       placeholder="username_or_email/password">
                <div class="form-text text-muted small">
                    Format: [username or email]/[password]
                </div>
            </label>
            @error('cas_shield_logins')<div class="input-error">{{ $message }}</div>@enderror
        </div>

        <!-- Enrollment Logins -->
        <div class="col-md-6">
            <label class="input-label">
                <i class="fas fa-graduation-cap input-icon"></i>
                <span>Enrollment Logins</span>
                <input type="text" class="form-input" 
                       wire:model="enrollment_logins"
                       placeholder="username_or_email/password">
                <div class="form-text text-muted small">
                    Format: [username or email]/[password]
                </div>
            </label>
            @error('enrollment_logins')<div class="input-error">{{ $message }}</div>@enderror
        </div>

        <!-- Visa Application Links -->
        <div class="col-md-6">
            <label class="input-label">
                <i class="fas fa-link input-icon"></i>
                <span>Visa Application Links</span>
                <textarea class="form-input" 
                       wire:model="visa_application_links"
                       placeholder="https://visa-portal.com/app/12345,myPassword"
                       rows="3"></textarea>
                <div class="form-text text-muted small">
                    Format: [URL],[password] - One entry per line
                </div>
            </label>
            @error('visa_application_links')<div class="input-error">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
        <!--  Inquiry Status -->
<div class="card-section mb-4">
    <div class="section-header">
        <i class="fas fa-user-circle section-icon"></i>
        <h5 class="section-title">Inquiry Status</h5>
        <span class="required-badge">Required</span>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Application Status</label>

        @if($original_status === 'enrollment')
            <!-- Read-only display for enrollment status -->
            <div class="alert alert-success py-2">
                <div class="d-flex align-items-center">
                    <i class="fas fa-lock me-2"></i>
                    <span>
                        Final Status:
                        <strong>{{ ucwords(str_replace('_', ' ', $original_status)) }}</strong>
                        <span class="badge ms-2" style="background-color: #009688; color: white;">
                            Enrollment Completed
                        </span>
                    </span>
                </div>
                <small class="d-block mt-1">
                    This application has reached its final status and cannot be modified.
                </small>
            </div>
        @else
            <!-- Editable status dropdown for non-enrollment cases -->
            <div class="dropdown w-100">
                <button class="btn btn-light dropdown-toggle w-100 text-start"
                        type="button"
                        id="statusDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    {{ ucwords(str_replace('_', ' ', $inquiry_status)) }}
                </button>

                <ul class="dropdown-menu"
                    aria-labelledby="statusDropdown"
                    style="white-space: nowrap; padding: 5px 8px; min-width: 100%; overflow-x: auto;">
                    <li class="d-flex flex-row gap-1" style="flex-wrap: nowrap;">
                         @php
                            $statusColors = [
                                'underassessment' => '#517577',

                                'processed'       => '#09122C',
                                'conditional'     => '#27391C',
                                'unconditional'   => '#87431D',
                                'undercas'        => '#C69749',
                                'casreceived'     => '#828383',
                                'visaprocess'     => '#673AB7',
                                'enrollment'      => '#009688',
                                                                'caseclosed'      => '#c01414',
                                'rejection'       => '#ff0000',
                                        'withdrawn'       => '#ff5252', // Add color for withdrawn status

                            ];
                        @endphp

                        @foreach($statusColors as $status => $color)
                                      @php
        $isAllowed    = in_array($status, $this->getAllowedStatuses());
        $isCurrent    = $inquiry_status === $status;
        $isSpecialCase = ($original_status === 'caseclosed' && $status === 'underassessment') ||
                         ($original_status === 'rejection' && $status === 'underassessment') ||
                         ($original_status === 'withdrawn' && $status === 'underassessment'); // Add this line
    @endphp

                            <button type="button"
                                    class="btn text-white position-relative status-button"
                                    style="
                                        background-color: {{ $color }};
                                        font-size: 12px;
                                        padding: 3px 8px;
                                        line-height: 1;
                                        border-radius: 4px;
                                        @if(!$isAllowed && !$isSpecialCase) opacity: 0.5; @endif"
                                    @if(!$isAllowed && !$isSpecialCase) disabled @endif
                                    wire:click="$set('inquiry_status', '{{ $status }}')">
                                {{ ucwords(str_replace('_', ' ', $status)) }}
                                @if($isCurrent)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
                                        ✓
                                    </span>
                                @endif
                            </button>
                        @endforeach
                    </li>
                </ul>
            </div>

            <!-- Status change instructions -->
            @if($inquiry_status !== $original_status)
                <div class="alert alert-success mt-2 py-1 small">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    Status change will be applied after saving the form
                </div>
            @endif

            <!-- Current status info -->
            <div class="mt-2 small text-muted">
                <div>
                    <strong>Current Status:</strong>
                    <span class="badge"
                          style="background-color: {{ $statusColors[$original_status] ?? '#6c757d' }};
                                 color: white;">
                        {{ ucwords(str_replace('_', ' ', $original_status)) }}
                    </span>
                </div>
                <div class="mt-1">
                    <strong>Allowed Changes:</strong>
                    @foreach($this->getAllowedStatuses() as $status)
                        @if($status !== $original_status)
                            <span class="badge me-1"
                                  style="background-color: {{ $statusColors[$status] ?? '#6c757d' }};
                                         color: white;">
                                {{ ucwords(str_replace('_', ' ', $status)) }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

                                <!-- Section 2: Course Information -->
                                <div class="card-section mb-4">
                                    <div class="section-header">
                                        <i class="fas fa-graduation-cap section-icon"></i>
                                        <h5 class="section-title">Course Information</h5>
                                        <span class="required-badge">Required</span>
                                    </div>
                                    <div class="row g-3">
                                        <!-- Course Name -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-book input-icon"></i>
                                                <span>Course Name</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="course_name" required>
                                            </label>
                                            @error('course_name')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        <!-- Course Intake -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-calendar-alt input-icon"></i>
                                                <span>Course Intake</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="course_intake" required>
                                            </label>
                                            @error('course_intake')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        <!-- Course Link -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-link input-icon"></i>
                                                <span>Course Link</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="course_link" required>
                                            </label>
                                            @error('course_link')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        <!-- University Name -->
                                        <div class="col-md-6">
                                            <label class="input-label">
                                                <i class="fas fa-university input-icon"></i>
                                                <span>University Name</span>
                                                <input type="text" class="form-input" 
                                                       wire:model="university_name" required>
                                            </label>
                                            @error('university_name')<div class="input-error">{{ $message }}</div>@enderror
                                        </div>
                                            <div class="col-md-12">
    <label class="input-label">
    <i class="fas fa-handshake input-icon"></i>
    <span>Partner Info.</span>
    <input 
        type="text" 
        class="form-input @if($partner) bg-gray-100 @endif" 
        wire:model="partner"
        placeholder="Enter partner name">
</label>

@error('partner')<div class="input-error">{{ $message }}</div>@enderror
</div>
       
                                    </div>
                                </div>
                                
                                <!-- Section 3: Document Uploads -->
                                <div class="card-section mb-4">
                                    <div class="section-header">
                                        <i class="fas fa-file-upload section-icon"></i>
                                        <h5 class="section-title">Document Uploads</h5>
                                    </div>
                                    <div class="row g-3">
                                        @php
                                            $documentFields = [
                                                'matric_dmc' => ['label' => 'Matric DMC', 'icon' => 'fa-graduation-cap'],
                                                'intermediate_dmc' => ['label' => 'Intermediate DMC', 'icon' => 'fa-graduation-cap'],
                                                'cv_file' => ['label' => 'CV/Resume', 'icon' => 'fa-id-card'],
                                                'passport_pages' => ['label' => 'Passport Pages', 'icon' => 'fa-passport'],
                                                'agent_consent' => ['label' => 'Agent Consent', 'icon' => 'fa-file-signature'],
                                                'student_consent' => ['label' => 'Student Consent', 'icon' => 'fa-file-signature'],
                                                'bs_hons' => ['label' => 'BS/Hons Degree', 'icon' => 'fa-scroll'],
                                                'ba_bsc' => ['label' => 'BA/BSc Degree', 'icon' => 'fa-scroll'],
                                                'ma_msc' => ['label' => 'MA/MSc Degree', 'icon' => 'fa-scroll'],
                                                'experience_letter' => ['label' => 'Experience Letter', 'icon' => 'fa-briefcase'],
                                                'english_test' => ['label' => 'English Test', 'icon' => 'fa-language'],
                                                'additional_docs' => ['label' => 'Additional Documents', 'icon' => 'fa-file-alt'],
                                                'refusal_letter' => ['label' => 'Refusal Letter', 'icon' => 'fa-ban'],
                                                'extra' => ['label' => 'Extra Document 1', 'icon' => 'fa-file'],
                                                'extra2' => ['label' => 'Extra Document 2', 'icon' => 'fa-file'],
                                                'extra3' => ['label' => 'Extra Document 3', 'icon' => 'fa-file'],
                                                'extra4' => ['label' => 'Extra Document 4', 'icon' => 'fa-file'],
                                                'extra5' => ['label' => 'Extra Document 5', 'icon' => 'fa-file'],
                                                'extra6' => ['label' => 'Extra Document 6', 'icon' => 'fa-file'],
                                                'extra7' => ['label' => 'Extra Document 7', 'icon' => 'fa-file'],
                                                'extra8' => ['label' => 'Extra Document 8', 'icon' => 'fa-file'],
                                                'extra9' => ['label' => 'Extra Document 9', 'icon' => 'fa-file'],
                                                'extra10' => ['label' => 'Extra Document 10', 'icon' => 'fa-file'],
                                                'extra11' => ['label' => 'Extra Document 11', 'icon' => 'fa-file']
                                            ];
                                        @endphp
                                        
                                        @foreach($documentFields as $field => $data)
                                        <div class="col-md-6">
                                            <div class="file-upload-wrapper" wire:key="{{ $field }}-{{ ${$field.'_path'} ? 'has-file' : 'no-file' }}">
                                                <label class="file-upload-label">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas {{ $data['icon'] }} text-dark me-2"></i> <!-- Changed from text-primary to text-dark -->
                                                        <span class="file-label-text">{{ $data['label'] }}</span>
                                                        <small class="text-muted ms-2">(PDF only)</small>
                                                    </div>
                                                    
                                                    @if(${"{$field}_path"})
                                                    <div class="file-preview uploaded">
                                                        <div class="file-info">
                                                            <i class="fas fa-check-circle text-success me-2"></i>
                                                            <span class="file-name">{{ basename(${"{$field}_path"}) }}</span>
                                                        </div>
                                                        <button type="button" class="file-delete-btn" 
                                                                x-data
                                                                @click="
                                                                    if(confirm('Are you sure you want to remove this document?')) {
                                                                        $wire.deleteFile('{{ $field }}')
                                                                    }
                                                                ">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                    @else
                                                    <div class="no-file-tag mb-2">
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            No file uploaded
                                                        </span>
                                                    </div>
                                                    @endif
                                                    
                                                    <div class="file-input-container {{ ${$field.'_path'} ? 'disabled' : '' }}">
                                                        <input type="file" class="file-input" 
                                                            wire:model="{{ $field }}" 
                                                            accept=".pdf"
                                                            {{ ${$field.'_path'} ? 'disabled' : '' }}>
                                                        <div class="file-input-mask">
                                                            <i class="fas fa-cloud-upload-alt me-2"></i>
                                                            <span>
                                                                @if(${$field.'_path'})
                                                                    Document Uploaded
                                                                @else
                                                                    Choose file
                                                                @endif
                                                            </span>
                                                        </div>
                                                        @if(${$field.'_path'})
                                                        <div class="file-replace-overlay">
                                                            <span>Remove current file to upload new one</span>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Show temporary upload file name -->
                                                    @if(${$field} && !${$field.'_path'})
                                                    <div class="file-preview uploading mt-2">
                                                        <div class="file-info">
                                                            <i class="fas fa-upload text-primary me-2"></i>
                                                            <span class="file-name">{{ ${$field}->getClientOriginalName() }}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </label>
                                                @error($field)<div class="input-error">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <!-- Section 4: Remarks -->
                                <div class="card-section mb-0">
                                    <div class="section-header">
                                        <i class="fas fa-sticky-note section-icon"></i>
                                        <h5 class="section-title">Remarks and History</h5>
                                    </div>
                                    
                                    <!-- New Remark -->
                                    <div class="remark-input-wrapper mb-4">
                                        <label class="remark-input-label">
                                            <span>Add New Remark</span>
                                            <textarea class="remark-textarea" wire:model="notes" 
                                                      placeholder="Type your remark here..."></textarea>
                                        </label>
                                        @error('notes')<div class="input-error">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <!-- Remarks History -->
                                  <div class="remarks-history">
    <div class="history-divider">
        <span class="divider-text">
            <i class="fas fa-history me-2"></i>Remark History
        </span>
    </div>
    
    @if($notes_history)
    @php
        // Safe notes history processing
        if (is_string($notes_history)) {
            $history = json_decode($notes_history, true) ?? [];
        } else {
            $history = $notes_history ?? [];
        }
        
        // Ensure it's an array and reverse for display
        $history = is_array($history) ? array_reverse($history) : [];
    @endphp
        
        <div class="history-items">
            @foreach($history as $note)
            <div class="history-item">
                <div class="history-avatar">
                    <div class="avatar-circle">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="history-content">
                    <div class="history-header">
                        <span class="history-user">
                            {{ $note['user_name'] ?? (Str::contains($note['note'], ':') ? Str::before($note['note'], ':') : 'System') }}
                        </span>
                        <span class="history-date">
                            {{ \Carbon\Carbon::parse($note['timestamp'])->format('M d, Y h:i A') }}
                        </span>
                    </div>
                    <div class="history-text">
                        @if(Str::contains($note['note'], ':'))
                            @php
                                $parts = explode(':', $note['note'], 2);
                                $remainingText = trim($parts[1] ?? '');
                            @endphp
                            {!! nl2br(htmlspecialchars_decode(trim($remainingText))) !!}
                        @else
                            {!! nl2br(htmlspecialchars_decode(trim($note['note']))) !!}
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="history-empty">
            <i class="fas fa-comment-slash"></i>
            <span>No remarks history available</span>
        </div>
    @endif
</div>
                                </div>
                            </div>
                            
                            <!-- Modal Footer -->
                            <div class="modal-footer bg-light border-top px-4 py-3">
                                <button type="button" class="btn btn-outline-secondary" wire:click="$set('showModal', false)">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Custom CSS -->
        <style>
              @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes slideIn {
                from { 
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to { 
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .no-file-tag .badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
    font-weight: 500;
}
/* Card outline styles */
.card-section {
    position: relative;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    background-color: white;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.card-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 8px;
    border: 2px solid transparent;
    transition: border-color 0.2s ease;
    pointer-events: none;
}

.card-section:hover::before {
    border-color: var(--primary); /* Use your primary color variable */
}

/* If you need to specify exact color */
.card-section:hover::before {
    border-color: #3b82f6; /* Blue-500 as example */
}

/* Section header adjustments */
.section-header {
    position: relative;
    z-index: 1; /* Ensure header stays above the outline */
}
            /* Enhanced File Upload Styles */
.file-preview.uploaded {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 0.375rem;
    padding: 0.5rem;
    margin-bottom: 0.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.file-info {
    display: flex;
    align-items: center;
    flex-grow: 1;
}

.file-delete-btn {
    background: none;
    border: none;
    color: #dc3545;
    padding: 0.25rem;
    cursor: pointer;
    margin-left: 0.5rem;
}

.file-delete-btn:hover {
    color: #a71d2a;
}

.file-input-container.disabled {
    position: relative;
    opacity: 0.7;
}

.file-input-container.disabled .file-input-mask {
    background: #e9ecef;
    border-style: solid;
    color: #6c757d;
}

.file-replace-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    color: #6c757d;
    border-radius: 0.375rem;
    text-align: center;
    padding: 0 1rem;
}

/* Success state for uploaded files */
.text-success {
    color: #28a745;
}
            /* Base Styles */
            .modal-backdrop {
                opacity: 1;
                background: rgba(0,0,0,0.5);
            }
            
            .modal-content {
                border-radius: 0.5rem;
                overflow: hidden;
            }
            
            /* Header Styles */
            .bg-primary-gradient {
                background: linear-gradient(135deg, #7367f0 0%);
            }
            
            .modal-icon-circle {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.1rem;
            }
            
            /* Progress Steps */
            .steps-progress {
                background: #f8f9fa;
                border-bottom: 1px solid #e9ecef;
            }
            
            .steps-progress .step {
                position: relative;
                text-align: center;
                z-index: 2;
                flex: 1;
            }
            
            .steps-progress .step-badge {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #e9ecef;
                color: #6c757d;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 5px;
                font-weight: 600;
            }
            
            .steps-progress .step.active .step-badge {
                background: #7367f0;
                color: white;
            }
            
            .steps-progress .step-label {
                font-size: 0.75rem;
                color: #6c757d;
                font-weight: 500;
            }
            
            .steps-progress .step.active .step-label {
                color: #7367f0;
                font-weight: 600;
            }
            
            .progress-bar-track {
                position: absolute;
                top: 15px;
                left: 0;
                right: 0;
                height: 2px;
                background: #e9ecef;
                z-index: 1;
            }
            
            .progress-bar-fill {
                position: absolute;
                top: 15px;
                left: 0;
                height: 2px;
                background: #7367f0;
                z-index: 1;
                transition: width 0.3s ease;
            }
            
            /* Card Sections */
            .card-section {
                background: white;
                border-radius: 0.5rem;
                box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .section-header {
                display: flex;
                align-items: center;
                margin-bottom: 1.5rem;
                position: relative;
            }
            
            .section-icon {
                font-size: 1.25rem;
                color: #7367f0;
                margin-right: 0.75rem;
            }
            
            .section-title {
                font-weight: 600;
                color: #495057;
                margin-bottom: 0;
                flex-grow: 1;
            }
            
            .required-badge, .pdf-badge {
                font-size: 0.65rem;
                font-weight: 600;
                padding: 0.25rem 0.5rem;
                border-radius: 0.25rem;
                margin-left: 0.5rem;
            }
            
            .required-badge {
                background: rgba(58,123,213,0.1);
                color: #7367f0;
            }
            .status-button {
    margin: 2px;
    font-size: 12px;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.status-button:disabled {
    cursor: not-allowed;
    pointer-events: none;
}

.status-button:hover:not(:disabled) {
    filter: brightness(1.1);
    transform: scale(1.03);
}

/* Remove any conflicting Bootstrap styles */
.dropdown-menu .btn {
    border-radius: 4px !important;
    margin: 2px !important;
}
            
            .pdf-badge {
                background: rgba(220,53,69,0.1);
                color: #dc3545;
            }
            
            /* Input Fields */
            .input-label {
                position: relative;
                display: block;
                margin-bottom: 1rem;
            }
            
            .input-label > span {
                display: block;
                font-size: 0.8rem;
                font-weight: 600;
                color: #495057;
                margin-bottom: 0.25rem;
            }
            
            .input-icon {
                position: absolute;
                left: 0.75rem;
                top: 2.25rem;
                color: #6c757d;
                font-size: 0.9rem;
            }
            
            .form-input {
                width: 100%;
                padding: 0.5rem 0.75rem 0.5rem 2.25rem;
                border: 1px solid #ced4da;
                border-radius: 0.375rem;
                transition: all 0.2s;
                height: calc(2.25rem + 2px);
            }
            
            .form-input:focus {
                border-color: #7367f0;
                box-shadow: 0 0 0 0.2rem rgba(58,123,213,0.25);
                outline: none;
            }
            
            .input-error {
                font-size: 0.75rem;
                color: #dc3545;
                margin-top: 0.25rem;
            }
            
            /* File Uploads */
            .file-upload-wrapper {
                margin-bottom: 1rem;
            }
            
            .file-upload-label {
                display: block;
            }
            
            .file-icon {
                color: #dc3545;
                margin-right: 0.5rem;
            }
            
            .file-label-text {
                font-size: 0.8rem;
                font-weight: 600;
                color: #495057;
                display: block;
                margin-bottom: 0.25rem;
            }
            
            .file-preview {
                display: flex;
                align-items: center;
                background: #f8f9fa;
                border-radius: 0.25rem;
                padding: 0.25rem 0.5rem;
                margin-bottom: 0.5rem;
            }
            
            .file-name {
                flex-grow: 1;
                font-size: 0.8rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            .file-delete-btn {
                background: none;
                border: none;
                color: #dc3545;
                padding: 0 0.25rem;
                cursor: pointer;
            }
            
            .file-input-container {
                position: relative;
            }
            
            .file-input {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                cursor: pointer;
            }
            
            .file-input-mask {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0.5rem;
                background: #f8f9fa;
                border: 1px dashed #ced4da;
                border-radius: 0.375rem;
                color: #6c757d;
                font-size: 0.8rem;
                transition: all 0.2s;
            }
            
            .file-input-mask:hover {
                background: #e9ecef;
            }
            
            /* Remarks */
            .remark-input-wrapper {
                margin-bottom: 1.5rem;
            }
            
            .remark-input-label {
                position: relative;
                display: block;
            }
            
            .remark-input-label > span {
                display: block;
                font-size: 0.8rem;
                font-weight: 600;
                color: #495057;
                margin-bottom: 0.25rem;
            }
            
            .remark-textarea {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #ced4da;
                border-radius: 0.375rem;
                min-height: 100px;
                transition: all 0.2s;
            }
            
            .remark-textarea:focus {
                border-color: #7367f0;
                box-shadow: 0 0 0 0.2rem rgba(58,123,213,0.25);
                outline: none;
            }
            
            /* History */
            .history-divider {
                display: flex;
                align-items: center;
                margin: 1.5rem 0;
            }
            
            .history-divider::before, .history-divider::after {
                content: '';
                flex: 1;
                border-bottom: 1px solid #e9ecef;
            }
            
            .divider-text {
                padding: 0 1rem;
                font-size: 0.75rem;
                font-weight: 600;
                color: #6c757d;
            }
            
            .history-items {
                max-height: 250px;
                overflow-y: auto;
                padding-right: 0.5rem;
            }
            
            .history-item {
                display: flex;
                margin-bottom: 1rem;
            }
            
            .history-avatar {
                margin-right: 1rem;
            }
            
            .avatar-circle {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: #7367f0;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.9rem;
            }
            
            .history-content {
                flex: 1;
                background: #f8f9fa;
                border-radius: 0.375rem;
                padding: 0.75rem;
            }
            
            .history-header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 0.25rem;
            }
            
            .history-user {
                font-size: 0.8rem;
                font-weight: 600;
                color: #495057;
            }
            
            .history-date {
                font-size: 0.7rem;
                color: #6c757d;
            }
            
            .history-text {
                font-size: 0.8rem;
                color: #495057;
                white-space: pre-line;
            }
            
            .history-empty {
                text-align: center;
                padding: 2rem;
                color: #6c757d;
            }
            
            .history-empty i {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
                display: block;
            }
            
            /* Responsive Adjustments */
            @media (max-width: 768px) {
                .modal-dialog {
                    margin: 0.5rem;
                }
                
                .steps-progress .step-label {
                    display: none;
                }
                
                .card-section {
                    padding: 1rem;
                }
                
                .section-header {
                    flex-wrap: wrap;
                }
                
                .section-title {
                    font-size: 1rem;
                }
            }
        </style>
    @endif
</div>