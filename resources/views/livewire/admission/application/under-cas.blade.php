<div>
    <div class="d-flex flex-wrap justify-content-start" style="gap: 15px;">
        <!-- All Applications Card - Blue -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.all-applications') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #34A853; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-clipboard-list fa-2x"></i>
                            <h3 class="fw-bold m-0 text-white">{{ $totalCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 text-white"><strong>All Applications</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Applications Under-Assessment Card - Yellow -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.under-assessment') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #517577; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: black;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-hourglass-half fa-2x text-white"></i>
                            <h3 class="fw-bold m-0 text-white">{{ $underAssessmentCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 text-white"><strong>Under Assessment</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Applications Processed Card - Green -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.processed') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #09122C; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-tasks fa-2x"></i>
                            <h3 class="fw-bold m-0 text-white">{{ $processedCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 text-white"><strong>Processed</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Conditional Offers Card - Sky Blue -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.conditional-offers') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #27391C; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-file-signature fa-2x" style="color: rgb(248, 246, 246)"></i>
                            <h3 class="fw-bold m-0 " style="color: rgb(250, 248, 248)">{{ $conditionalCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 " style="color: rgb(248, 247, 247)"><strong>Conditional Offers</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Unconditional Offers Card - Purple -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.unconditional-offers') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #87431D; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-file-contract fa-2x"></i>
                            <h3 class="fw-bold m-0 text-white">{{ $unconditionalCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 text-white"><strong>Unconditional Offers</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Under CAS Card - Light Gray -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.under-cas') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #C69749; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: black;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-passport fa-2x text-white"></i>
                            <h3 class="fw-bold m-0" style=" color: rgb(247, 246, 246) ">{{ $underCasCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0" style="color: rgb(253, 251, 251)"><strong>Under CAS</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- CAS Document Card - Red -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.cas-received') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #828383; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-file-invoice fa-2x"></i>
                            <h3 class="fw-bold m-0 text-white">{{ $casDocumentCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 text-white text-white"><strong>CAS Received</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Visa Process Card - Deep Purple -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.visa-process') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #673AB7; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-stamp fa-2x"></i>
                            <h3 class="fw-bold m-0 text-white">{{ $visaProcessCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 text-white"><strong>Visa Process</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Enrollment Card - Teal -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.enrollment') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #009688; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user-graduate fa-2x"></i>
                            <h3 class="fw-bold m-0 text-white">{{ $enrollmentCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 text-white"><strong>Enrollment</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Case Closed Card - Gray -->
        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
            <a href="{{ route('admission.case-closed') }}" class="text-decoration-none">
                <div class="card text-center" style="background-color: #c01414; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-archive fa-2x"></i>
                            <h3 class="fw-bold m-0 text-white">{{ $caseClosedCount }}</h3>
                        </div>
                        <h6 class="mt-3 mb-0 text-white"><strong>Case Closed</strong></h6>
                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="card mt-2">
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background-color: #C69749; color: rgb(253, 252, 252);">
        <div class="d-flex align-items-center gap-2">
            <i class="fas fa-passport fa-lg" style="color: #fdfcfc"></i>
            <h4 class="mb-0" style="color: #fcfcfc"><strong>Under CAS Processing</strong></h4>
        </div>
         <!-- Updated search input group -->
         <div class="input-group" style="width: 300px;" wire:key="search-container-{{ $search }}">
        <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-search text-muted"></i>
        </span>
        <input type="text" 
               class="form-control border-start-0 ps-0" 
               placeholder="Search applications" 
               wire:model.defer="search"
               style="box-shadow: none !important;">
        <button wire:click="searches" 
                class="btn btn-dark d-flex align-items-center gap-2">
            <i class="fas fa-search"></i>
            <span></span>
        </button>
    </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center" style="font-size: 15px;">
                <thead class="table-light">
                    <tr>
                        <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 2%;">
                            <i class="fas fa-list-ol" style="margin-right: 5px;"></i>
                        </th>
                        <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 10%;">
                            <i class="fas fa-user" style="margin-right: 5px;"></i> Name
                        </th>
                        <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 8%;">
                            <i class="fas fa-phone" style="margin-right: 5px;"></i> Contact
                        </th>
                        <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                            <i class="fas fa-passport" style="margin-right: 5px;"></i> Gmail & Password
                        </th>
                        <th style="vertical-align: middle; padding: 10px; white-space: normal; width: 17%;">
                            <i class="fas fa-university" style="margin-right: 5px;"></i> University & Course
                        </th>
                        <th style="vertical-align: middle; padding: 10px; white-space: normal; width: 25%;">
                            <i class="fas fa-sticky-note" style="margin-right: 5px;"></i> Remarks
                        </th>
                        <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 2%;">
                            <i class="fas fa-cogs" style="margin-right: 5px;"></i> Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registeredInquiries as $inquiry)
                    <tr style="text-align: left" id="inquiry-{{ $inquiry->id }}">
                        <td style="vertical-align: middle; text-align: center;">
                            {{ ($registeredInquiries->currentPage() - 1) * $registeredInquiries->perPage() + $loop->iteration }}
                        </td>
<td class="whitespace-normal break-words max-w-[150px] leading-snug"
    style="padding: 8px; word-break: break-word;">
    
    <div class="dashboard-card" style="background: white; border-radius: 6px; padding: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 3px solid #C69749;">
        {{-- Unique ID --}}
        @if(!empty($inquiry->unique_id))
            <div style="text-align: center; margin-bottom: 12px;">
                <span style="font-size: 10px; color: #374151; font-weight: 600; background: white; padding: 5px 14px; border: 1.5px solid #d1d5db; border-radius: 3px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    {{ e($inquiry->unique_id) }}
                </span>
            </div>
        @endif

        {{-- Student Name --}}
        @if(!empty($inquiry->student_name))
            @php
                $parts = explode(' ', $inquiry->student_name);
                $firstThree = array_slice($parts, 0, 3);
                $remaining = array_slice($parts, 3);
            @endphp
            <div style="text-align: center; margin-bottom: 10px;">
                <strong style="font-size: 13px; color: #212529; display: block; line-height: 1.4;"
                        @if(count($remaining)) title="{{ implode(' ', $remaining) }}" @endif>
                    @foreach($firstThree as $part)
                        {{ e($part) }}<br>
                    @endforeach
                </strong>
            </div>

            {{-- Assignment Info --}}
            <div style="font-size: 10px; color: #495057;">
                {{-- Counsellor Section --}}
                @if(!empty($inquiry->user))
                    @php
                        $parts = explode(' ', $inquiry->user->username);
                        $firstThree = array_slice($parts, 0, 3);
                        $remaining = array_slice($parts, 3);
                    @endphp
                    <div style="margin-bottom: 8px;">
                        <div style="color: #6c757d; margin-bottom: 2px; display: flex; align-items: center;">
                            <span style="display: inline-block; width: 5px; height: 5px; background: #A8AAAE; border-radius: 50%; margin-right: 6px;"></span>
                            COUNSELLOR
                        </div>
                        <div style="font-weight: 500; color: #070707; padding-left: 10px; line-height: 1.4;"
                            @if(count($remaining)) title="{{ implode(' ', $remaining) }}" @endif>
                            @foreach($firstThree as $part)
                                {{ e($part) }}<br>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Separator Line --}}
                @if(!empty($inquiry->user) && !empty($inquiry->assignedTo))
                    <div style="border-top: 1px solid #e9ecef; margin: 8px 0;"></div>
                @endif

                {{-- Agent/Manager Section --}}
                @if(!empty($inquiry->assignedTo))
                    @php
                        $parts = explode(' ', $inquiry->assignedTo->username);
                        $firstThree = array_slice($parts, 0, 3);
                        $remaining = array_slice($parts, 3);
                    @endphp
                    <div style="margin-bottom: 3px;">
                        <div style="color: #6c757d; margin-bottom: 2px; display: flex; align-items: center;">
                            <span style="display: inline-block; width: 5px; height: 5px; background: #A8AAAE; border-radius: 50%; margin-right: 6px;"></span>
                            @php
                                $role = strtolower($inquiry->assignedTo->role);
                                if ($role === 'admission') {
                                    $roleLabel = 'MANAGER';
                                } elseif ($role === 'admissionagent') {
                                    $roleLabel = 'AGENT';
                                } else {
                                    $roleLabel = strtoupper($inquiry->assignedTo->role);
                                }
                            @endphp
                            {{ $roleLabel }}
                        </div>
                        <div style="font-weight: 500; color: #070707; padding-left: 10px; line-height: 1.4;"
                            @if(count($remaining)) title="{{ implode(' ', $remaining) }}" @endif>
                            @foreach($firstThree as $part)
                                {{ e($part) }}<br>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div style="text-align: center;">
                        <span style="color: #fa0505; font-weight: 500; font-size: 9px;">
                            ⚠ Not Assigned Yet
                        </span>
                    </div>
                @endif
            </div>
        @else
            <div style="text-align: center; color: #6c757d; font-size: 11px; padding: 8px 0;">
                NO STUDENT DATA AVAILABLE
            </div>
        @endif
    </div>
</td>


                            <td style="vertical-align: middle; padding: 6px; white-space: nowrap;" class="text-center">
    <div>
        {{-- Student Contact --}}
        <div style="margin-bottom: 8px;">
            {!! !empty($inquiry->student_contact)
                ? '<div style="font-size: 13px; font-weight: 600; color: #111827; letter-spacing: 0.2px;">' . e($inquiry->student_contact) . '</div>'
                : '<span class="badge bg-light text-black">Null</span>' !!}
        </div>

        {{-- Emergency Contact --}}
        @if(!empty($inquiry->emergency_contact_1))
            <div style="margin-bottom: 8px; padding-bottom: 8px; border-bottom: 1px solid #f3f4f6;">
                <div style="font-size: 9px; color: #dc2626; font-weight: 600; letter-spacing: 0.4px; margin-bottom: 3px; display: flex; align-items: center; justify-content: center; gap: 4px;">
                    <span style="width: 3px; height: 3px; background: #dc2626; border-radius: 50%;"></span>
                    EMERGENCY
                </div>
                <div style="font-size: 11px; color: #374151; font-weight: 600;">{{ $inquiry->emergency_contact_1 }}</div>
            </div>
        @endif

        {{-- Passport Number --}}
        @if(!empty($inquiry->passport_number))
            <div>
                <div style="font-size: 9px; background: linear-gradient(135deg, #797b7c, #797b7c); color: white; padding: 3px 8px; border-radius: 6px; font-weight: 600; letter-spacing: 0.4px; display: inline-block; margin-bottom: 4px;">
                    PASSPORT
                </div>
                <div style="font-size: 12px; font-weight: 700; color: #1a1b1d; letter-spacing: 0.6px;">
                    {{ $inquiry->passport_number }}
                </div>
            </div>
        @endif
    </div>
</td>

                                                          <td class="whitespace-normal break-words max-w-[150px] text-center"
    style="padding: 8px; word-break: break-word; overflow-wrap: break-word;">
    @if(!empty($inquiry->gmail_password))
        @php
            $parts = explode('/', $inquiry->gmail_password, 2);
            $email = trim($parts[0] ?? '');
            $password = trim($parts[1] ?? '');
        @endphp
        
        <div>
            {{-- Gmail Label --}}
            <div style="font-size: 9px; color: #6b7280; font-weight: 600; margin-bottom: 2px;">
                GMAIL
            </div>
            
            {{-- Email --}}
            <div style="font-size: 12px; font-weight: 700; color: #111827; margin-bottom: 8px; word-break: break-all;">
                {{ $email ? e($email) : 'N/A' }}
            </div>
            
            {{-- Password Section --}}
            @if($password)
                <div style="display: inline-flex; align-items: center; background: #dedee0; color: rgb(27, 27, 27); 
                          border-radius: 12px; padding: 2px 8px; font-size: 9px; font-weight: 600; 
                          margin-bottom: 6px;">
                    <i class="fas fa-key me-1" style="font-size: 8px;"></i>
                    PASSWORD
                </div>
                
                <br>
                
                {{-- Password with dynamic outline --}}
                <div style="display: inline-flex; justify-content: center; width: 100%;">
                    <div style="font-size: 11px; color: #374151; background: white; 
                              border-radius: 4px; padding: 4px 10px; border: 1px solid #d1d5db; 
                              display: inline-block; max-width: fit-content;">
                        {{ e($password) }}
                    </div>
                </div>
            @endif
        </div>
    @else
        <div style="background: #f8fafc; border-radius: 4px; padding: 6px;">
            <span style="font-size: 11px; color: #9ca3af;">—</span>
        </div>
    @endif
</td>

               <td style="vertical-align: middle; padding: 6px;" class="text-center">
    <div style="background: white; border-radius: 6px; padding: 8px; ">
        {{-- University Name --}}
        <div style="margin-bottom: 6px;">
            <strong 
                style="
                    font-size: 13px; 
                    color: #111827; 
                    font-weight: 700; 
                    display: -webkit-box;
                    -webkit-line-clamp: 2; 
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    max-height: 2.8em; /* ~2 lines */
                "
                title="{{ $inquiry->university_name ?? 'N/A' }}"
            >
                {{ $inquiry->university_name ?? 'N/A' }}
            </strong>
        </div>

        {{-- Course Name --}}
        <div style="margin-bottom: 8px;">
            <small 
                style="
                    font-size: 11px; 
                    color: #6b7280; 
                    font-weight: 500; 
                    display: -webkit-box;
                    -webkit-line-clamp: 3; 
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    max-height: 4.2em; /* ~3 lines */
                "
                title="{{ $inquiry->course_name ?? 'N/A' }}"
            >
                {{ $inquiry->course_name ?? 'N/A' }}
            </small>
        </div>

        {{-- Partner --}}
        <div style="padding-top: 6px; border-top: 1px solid #f3f4f6;">
            <div style="font-size: 9px; background: linear-gradient(135deg, #e1f5fe, #b3e5fc); color: #0288d1; padding: 3px 8px; border-radius: 10px; font-weight: 700; letter-spacing: 0.3px; display: inline-block; margin-bottom: 4px;">
                PARTNER
            </div>
            <div style="font-size: 11px; font-weight: 700; color: {{ $inquiry->partner ? '#01579b' : '#6b7280' }};">
                {{ $inquiry->partner ?: 'No Partner' }}
            </div>
        </div>
    </div>
</td>

      <td style="vertical-align: top; padding: 6px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    <div class="notes-container" 
         style="height: 200px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0; background: #ffffff; font-size: 12px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
        
        @if(!empty($inquiry->notes_history))
            @php
                $notesHistory = json_decode($inquiry->notes_history, true);
                $notesHistory = array_reverse($notesHistory);
            @endphp
            
            @foreach($notesHistory as $note)
                <div class="chat-message" style="padding: 12px; border-bottom: 1px solid #f1f5f9;">
                    {{-- Message Header --}}
                    <div class="message-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                        @php
                            $username = $note['user_name'] ?? (\Illuminate\Support\Str::contains($note['note'], ':') ? \Illuminate\Support\Str::before($note['note'], ':') : 'System');
                            $user = \App\Models\User::where('username', $username)->first();
                            $userRole = $user->role ?? 'system';
                            
                            // Enhanced role styles with avatars
                            $roleStyles = [
                                'counsellor'     => [
                                    'bg' => 'linear-gradient(135deg, #7367F0 0%, #7367F0 100%)', 
                                    'color' => '#7367F0', 
                                    'badge' => ' color: #7367F0; border: 1px solid #7367F0;',
                                    'display_name' => 'Counsellor'
                                ],
                                'manager'        => [
                                    'bg' => 'linear-gradient(135deg, #28C76F 0%, #28C76F 100%)', 
                                    'color' => '#28C76F', 
                                    'badge' => 'color: #28C76F; border: 1px solid #28C76F;',
                                    'display_name' => 'Counsellor Manager'
                                ],
                                'admission'      => [
                                    'bg' => 'linear-gradient(135deg, #00A2B8 0%, #00A2B8 100%)', 
                                    'color' => '#00CFE8', 
                                    'badge' => 'color: #00A2B8; border: 1px solid #00CFE8;',
                                    'display_name' => 'Admission Manager'
                                ],
                                'admissionagent' => [
                                    'bg' => 'linear-gradient(135deg, #4B4B4B 0%, #4B4B4B 100%)', 
                                    'color' => '#4B4B4B', 
                                    'badge' => ' color: #4B4B4B; border: 1px solid #4B4B4B;',
                                    'display_name' => 'Admission Agent'
                                ],
                                'externalagent'  => [
                                    'bg' => 'linear-gradient(135deg, #FF9800 0%, #FF9800 100%)', 
                                    'color' => '#FFC107', 
                                    'badge' => ' color: #FF8F00; border: 1px solid #FFC107;',
                                    'display_name' => 'External Agent'
                                ],
                                'admin'          => [
                                    'bg' => 'linear-gradient(135deg, #b71c1c 0%, #d32f2f 100%)', 
                                    'color' => '#d32f2f', 
                                    'badge' => 'background: linear-gradient(90deg, #b71c1c, #d32f2f); color: #fff; border: 1px solid #d32f2f;',
                                    'display_name' => 'Admin'
                                ],
                                'system'         => [
                                    'bg' => 'linear-gradient(135deg, #718096 0%, #4a5568 100%)', 
                                    'color' => '#616161', 
                                    'badge' => 'background: #f5f5f5; color: #616161; border: 1px solid #616161;',
                                    'display_name' => 'System'
                                ]
                            ];
                            
                            $userStyle = $roleStyles[$userRole] ?? $roleStyles['system'];
                            
                            // Get first letter of username (remove @ if exists)
                            $cleanUsername = ltrim($username, '@');
                            $avatarLetter = strtoupper(substr($cleanUsername, 0, 1));
                        @endphp

                        {{-- User Info with Avatar --}}
                        <div class="user-info" style="display: flex; align-items: center; gap: 6px;">
                            <div class="avatar" style="width: 24px; height: 24px; border-radius: 50%; background: {{ $userStyle['bg'] }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 10px;">
                                {{ $avatarLetter }}
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                <div style="font-weight: 600; color: #2d3748; font-size: 11px; margin-bottom: 2px;">
                                    {{ $username }}
                                </div>
                                <div style="font-size: 9px; {{ $userStyle['badge'] }} padding: 1px 6px; border-radius: 8px; font-weight: 600; display: inline-block; white-space: nowrap;">
                                    {{ $userStyle['display_name'] }}
                                </div>
                            </div>
                        </div>

                        {{-- Time Information --}}
                        <div class="time-info" style="text-align: right;">
                            <div style="font-size: 10px; font-weight: 600; color: #4a5568; margin-bottom: 1px;">
                                {{ \Carbon\Carbon::parse($note['timestamp'])->format('M d, h:i A') }}
                            </div>
                            <div style="font-size: 9px; color: #718096;">
                                {{ \Carbon\Carbon::parse($note['timestamp'])->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    {{-- Message Content - FIXED --}}
<div class="message-bubble" style="background: #f7fafc; border-left: 3px solid {{ $userStyle['color'] }}; padding: 8px 12px; border-radius: 6px; margin-top: 6px; max-width: 100%;">
    <div class="message-text" style="color: #2d3748; line-height: 1.4; white-space: normal; word-wrap: break-word; word-break: break-word; font-size: 11px; max-width: 100%; overflow-wrap: break-word;">
        @if(\Illuminate\Support\Str::contains($note['note'], ':'))
            @php
                $parts = explode(':', $note['note'], 2);
                $remainingText = trim($parts[1] ?? '');
            @endphp
            {!! nl2br(e(trim($remainingText))) !!}
        @else
            {!! nl2br(e(trim($note['note']))) !!}
        @endif
    </div>
</div>
                </div>
            @endforeach
        @elseif(!empty($inquiry->notes))
            <div class="chat-message" style="padding: 12px;">
                {{-- Message Header --}}
                <div class="message-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                    @php
                        $username = \Illuminate\Support\Str::contains($inquiry->notes, ':') ? \Illuminate\Support\Str::before($inquiry->notes, ':') : 'System';
                        $user = \App\Models\User::where('username', $username)->first();
                        $userRole = $user->role ?? 'system';
                        
                        $userStyle = $roleStyles[$userRole] ?? $roleStyles['system'];
                        
                        // Get first letter of username (remove @ if exists)
                        $cleanUsername = ltrim($username, '@');
                        $avatarLetter = strtoupper(substr($cleanUsername, 0, 1));
                    @endphp

                    {{-- User Info with Avatar --}}
                    <div class="user-info" style="display: flex; align-items: center; gap: 6px;">
                        <div class="avatar" style="width: 24px; height: 24px; border-radius: 50%; background: {{ $userStyle['bg'] }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 10px;">
                            {{ $avatarLetter }}
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                            <div style="font-weight: 600; color: #2d3748; font-size: 11px; margin-bottom: 2px;">
                                {{ $username }}
                            </div>
                            <div style="font-size: 9px; {{ $userStyle['badge'] }} padding: 1px 6px; border-radius: 8px; font-weight: 600; display: inline-block; white-space: nowrap;">
                                {{ $userStyle['display_name'] }}
                            </div>
                        </div>
                    </div>

                    {{-- Time Information --}}
                    <div class="time-info" style="text-align: right;">
                        <div style="font-size: 10px; font-weight: 600; color: #4a5568; margin-bottom: 1px;">
                            {{ $inquiry->updated_at->format('M d, h:i A') }}
                        </div>
                        <div style="font-size: 9px; color: #718096;">
                            {{ $inquiry->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                {{-- Message Content - FIXED --}}
                <div class="message-bubble" style="background: #f7fafc; border-left: 3px solid {{ $userStyle['color'] }}; padding: 8px 12px; border-radius: 6px; margin-top: 6px;">
                    <div class="message-text" style="color: #2d3748; line-height: 1.4; white-space: normal; word-wrap: break-word; font-size: 11px;">
                        @if(\Illuminate\Support\Str::contains($inquiry->notes, ':'))
                            @php
                                $parts = explode(':', $inquiry->notes, 2);
                                $remainingText = trim($parts[1] ?? '');
                            @endphp
                            {!! nl2br(e(trim($remainingText))) !!}
                        @else
                            {!! nl2br(e(trim($inquiry->notes))) !!}
                        @endif
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="empty-state" style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 30px 16px;">
                <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                    <svg style="width: 24px; height: 24px; color: #cbd5e0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                
                <div style="text-align: center; margin-bottom: 12px;">
                    <div style="font-weight: 600; color: #4a5568; margin-bottom: 3px; font-size: 12px;">No Notes Yet</div>
                    <div style="font-size: 10px; color: #718096;">No conversation history available</div>
                </div>

                <div style="background: #f8fafc; padding: 6px 12px; border-radius: 16px; border: 1px dashed #e2e8f0;">
                    <span style="font-size: 10px; color: #718096; font-weight: 500;">Start the conversation</span>
                </div>
            </div>
        @endif
    </div>

    <style>
    .notes-container {
        max-width: 400px; /* Adjust this value as needed */
        width: 100%;
    }
    
    .notes-container::-webkit-scrollbar {
        width: 4px;
    }
    
    .notes-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 1px;
    }
    
    .notes-container::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 1px;
    }
    
    .notes-container::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
    
    .message-bubble {
        transition: all 0.2s ease;
        max-width: 100%;
    }
    
    .message-bubble:hover {
        background: #edf2f7 !important;
        transform: translateX(1px);
    }
    
    .chat-message:last-child {
        border-bottom: none !important;
    }
    
    /* Additional CSS for better text control */
    .message-text {
        max-width: 100%;
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
    }
</style>
</td>
                        
                        <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
                            <div class="d-flex flex-column gap-1 align-items-center">
                                <span class="badge"
                                    style="font-size: 13px; padding: 4px 6px; background-color: #C69749; 
                                    color: #fff;"
                                    title="Updated on: {{ $inquiry->updated_at ? \Carbon\Carbon::parse($inquiry->updated_at)->format('M d, Y h:i A') : 'N/A' }}">
                                    <i class="fas fa-file-invoice me-1"></i>
                                    <strong>Under CAS</strong>
                                </span>
                                <div class="d-flex gap-1">
    <button class="btn btn-sm btn-success" 
            wire:click="$dispatch('editAdmissionInquiry', { id: {{ $inquiry->id }} })" 
            style="font-size: 12px; padding: 3px 6px; white-space: nowrap;">
        <i class="fas fa-edit me-1"></i> Edit
    </button>
    <button class="btn btn-sm btn-info" 
            wire:click="$dispatch('showAdmissionDetails', {id: {{ $inquiry->id }}})"
            style="font-size: 12px; padding: 3px 6px; white-space: nowrap;">
        <i class="fas fa-info-circle me-1"></i> Details
    </button>
</div>
                                           <div class="d-flex gap-1">

                                <button class="btn btn-sm btn-primary"
                                        wire:click="$dispatch('editAdmissionInquiryChat', { id: {{ $inquiry->id }} })" 
                                        style="font-size: 12px; padding: 3px 6px; white-space: nowrap;">
                                    <i class="fas fa-comment me-1"></i> Chat
                                </button>
          <button class="btn btn-sm"
        wire:click="$dispatch('openNewAdmissionModal', { parentId: {{ $inquiry->id }} })"
        style="font-size: 12px; padding: 3px 6px; white-space: nowrap; background: linear-gradient(45deg, #04423d, #16bb00); color: white; border: none;"
        title="Add New Application for Same Student">
    <i class="fas fa-plus "></i>
</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No applications under CAS processing.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($registeredInquiries->count() > 0)
        <div class="mt-2">
            {{ $registeredInquiries->links('pagination::bootstrap-5') }}
        </div>
    @endif
    
      <!-- CORRECTED MODALS: Using the exact same syntax as before -->
    <livewire:admission.modal.update-admission-inquiry-chat 
        wire:key="chat-modal-{{ time() }}" />
    
    <livewire:admission.modal.show-admission-inquiry-details 
        wire:key="details-modal-{{ time() }}" />
    
    <livewire:admission.modal.update-admission-inquiry 
        wire:key="update-modal-{{ time() }}" />
    
    <livewire:admission.modal.new-admission-modal 
        wire:key="new-modal-{{ $search }}" />

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const inquiryId = urlParams.get("inquiryId");
    
            if (inquiryId) {
                const row = document.getElementById(`inquiry-${inquiryId}`);
                if (row) {
                    row.scrollIntoView({ behavior: "smooth", block: "center" });
                    row.style.transition = "background-color 1s ease";
                    row.style.backgroundColor = "#ffffcc";
    
                    setTimeout(() => {  
                        row.style.backgroundColor = "";
                    }, 3000);
    
                    window.history.replaceState({}, document.title, window.location.pathname + "?page=" + urlParams.get("page"));
                }
            }
        });
    </script>
</div>
</div>