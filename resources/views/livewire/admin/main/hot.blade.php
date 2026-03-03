<div>
      <div class="d-flex flex-wrap justify-content-start" style="gap: 15px;">
                        <!-- All Inquiries -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.inquiries') }}" class="text-decoration-none">
                                <div class="card text-center bg-primary"
                                     style="height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-list fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $totalLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>All Inquiries</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Hot Leads -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.hot-inquiries') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #ff5722; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-fire fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $hotLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Hot</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #ff5722; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Cold Leads -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.cold-inquiries') }}" class="text-decoration-none">
                                <div class="card text-center bg-info"
                                     style="height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-snowflake fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $coldLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Cold</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #0dcaf0; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Dead Leads -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.dead-inquiries') }}" class="text-decoration-none">
                                <div class="card text-center bg-dark"
                                     style="height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-times-circle fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $deadLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Dead</strong></h6>
                                        <button class="btn btn-sm mt-3 text-dark" style="background-color: white; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Pending Leads -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.pending-inquiries') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #ffc107; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: black;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-hourglass-half fa-2x" style="color: black;"></i>
                                            <h3 class="fw-bold m-0" style="color: black;">{{ $pendingLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0" style="color: black;"><strong>Pending</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: black; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                       
                    </div>
    <div class=card>
     <div class="card-header bg-gradient-hot text-white py-4" style="border-radius: 12px 12px 0 0 !important;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-2 text-white">
                    <i class="fas fa-fire me-2"></i>
                    Hot Inquiries
                </h2>
                <p class="mb-0 opacity-75">
                    View and manage high-priority or time-sensitive inquiries
                </p>
            </div>
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <input type="text" 
                           class="form-control form-control-lg border-0" 
                           placeholder="Search by Name or Phone" 
                           wire:model.defer="search"
                           style="border-radius: 8px 0 0 8px !important;">
                    <button class="btn btn-dark border-0 px-4" 
                            wire:click="searchInquiries"
                            style="border-radius: 0 8px 8px 0 !important;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-hot {
    background: linear-gradient(135deg, #ff5722 70%, #ffb199 100%) !important;
}
</style>

        <div class=card>
            <table class="table table-bordered align-middle text-center" style=font-size:15px>
                <thead class=table-light>
                    <tr>
                          <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
            <i class="fas fa-list-ol" style="margin-right: 5px;"></i>
        </th>
                        <th style=vertical-align:middle;padding:10px;white-space:nowrap;width:12%>
                            <i class="fas fa-user" style=margin-right:5px></i> Name
                        </th>
                        <th style=vertical-align:middle;padding:10px;white-space:nowrap;width:12%>
                            <i class="fas fa-phone" style=margin-right:5px></i> Phone
                        </th>
                        <th style=vertical-align:middle;padding:10px;white-space:nowrap;width:10%>
                            <i class="fas fa-calendar-alt" style=margin-right:5px></i> Type
                        </th>
                        
                        <th style=vertical-align:middle;padding:10px;width:30%;white-space:normal>
                            <i class="fas fa-reply" style=margin-right:5px></i> Response
                        </th>
                        <th style=vertical-align:middle;padding:10px;white-space:nowrap;width:8%>
                            <i class="fas fa-check-circle" style=margin-right:5px></i> Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $hotInquiries = $inquiries->filter(function ($inquiry) {
                            return $inquiry->inquiry_status === 'hot';
                        });
                    @endphp
                
                    @if ($hotInquiries->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted" style="padding: 20px;">
                                No hot inquiries found.
                            </td>
                        </tr>
                    @else
                        @foreach ($hotInquiries as $inquiry)
                            <tr style="text-align:left">
                                 <td style="vertical-align: middle; text-align: center;">
                    {{ ($inquiries->currentPage() - 1) * $inquiries->perPage() + $loop->iteration }}
                </td>
           <td class="whitespace-normal break-words max-w-[150px]" style="padding: 8px;">
                                                <div style="border-left: 3px solid #ff5722; padding-left: 8px;">
                                                    <div
                                                        style="font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">
                                                        Student Name</div>
                                                    <strong style="color: #1f2937; font-size: 13px; display: block; line-height: 1.3;">
                                                        {!! !empty($inquiry->name)
                                                        ? e(Str::title($inquiry->name))
                                                        : '<span style="color: #9ca3af; font-style: italic; font-weight: normal;">Not specified</span>' !!}
                                                    </strong>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle; padding: 8px; white-space: nowrap;">
                                                <div style="display: flex; flex-direction: column; align-items: center; gap: 2px;">
                                                    {{-- Type Display --}}
                                                    @if(!empty($inquiry->type))
                                                        <div
                                                            style="font-size: 9px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                                            {{ e($inquiry->type) }}
                                                        </div>
                                                    @else
                                                        <div style="font-size: 9px; color: #9ca3af; font-weight: 500; font-style: italic;">
                                                            No Type
                                                        </div>
                                                    @endif

                                                    {{-- Phone Number Display --}}
                                                    @if (!empty($inquiry->phone_number))
                                                                <div style="background: #f0f4f8; 
                                                        border: 1px solid #dbe1e7; 
                                                        border-radius: 6px; 
                                                        padding: 4px 10px;
                                                        font-size: 12px;
                                                        font-weight: 600;
                                                        color: #1f2937;
                                                        letter-spacing: 0.3px;
                                                        margin-top: 1px;">
                                                                    {{ e($inquiry->phone_number) }}
                                                                </div>
                                                    @else
                                                                <span style="background: #f8f9fa; 
                                                        border: 1px solid #e2e8f0; 
                                                        border-radius: 6px; 
                                                        padding: 3px 8px;
                                                        font-size: 10px;
                                                        color: #6b7280;
                                                        font-weight: 500;">
                                                                    No Phone
                                                                </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="whitespace-normal break-words max-w-[150px]" style="padding: 8px;">
                                                <div style="border-left: 1px solid #d3d3d6; padding-left: 8px;">
                                                    <div
                                                        style="font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">
                                                        Assigned To</div>
                                                    @if ($inquiry->assignedUser)
                                                        @php
                                                            $role = $inquiry->assignedUser->role;
                                                            // Define role colors
                                                            if ($role === 'counsellor') {
                                                                $color = '#1f2937'; // Dark gray
                                                            } elseif ($role === 'admin') {
                                                                $color = '#0ea5e9'; // Blue
                                                            } elseif ($role === 'manager') {
                                                                $color = '#28C76F'; // Green
                                                            } elseif ($role === 'externalagent') {
                                                                $color = '#1f2937'; // Green
                                                            } else {
                                                                $color = '#6b7280'; // Default gray
                                                            }

                                                            // Format role label
                                                            if ($role === 'admission') {
                                                                $roleLabel = 'Manager';
                                                            } elseif ($role === 'admissionagent') {
                                                                $roleLabel = 'Agent';
                                                            } else {
                                                                $roleLabel = ucfirst($role);
                                                            }
                                                        @endphp
                                                        <div style="display: flex; align-items: center; gap: 6px;">
                                                            <div
                                                                style="width: 8px; height: 8px; border-radius: 50%; background-color: {{ $color }};">
                                                            </div>
                                                            <strong style="color: {{ $color }}; font-size: 13px; line-height: 1.3;">
                                                                {{ ucfirst(e($inquiry->assignedUser->username)) }}
                                                            </strong>
                                                        </div>
                                                        <div style="font-size: 11px; color: #6b7280; padding-left: 18px;">
                                                            {{ ucfirst($role) }}
                                                        </div>
                                                        @if($inquiry->assigned_at)
                                                            <div style="font-size: 10px; color: #9ca3af; padding-left: 18px; margin-top: 2px;">
                                                                {{ \Carbon\Carbon::parse($inquiry->assigned_at)->format('M d, Y') }}
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div
                                                            style="display: inline-block; padding: 4px 8px; background: #fef3cd; border: 1px solid #fde68a; border-radius: 4px;">
                                                            <span style="color: #92400e; font-size: 12px; font-weight: 600;">Unassigned</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
         <td style="vertical-align: top; padding: 8px;">
    <div class="response-container"
        style="height: 120px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0; background: #ffffff; font-size: 13px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);">

        @php
            $dateStatus = $this->getDateStatus($inquiry);
            $showIndicators = in_array($inquiry->inquiry_status, ['hot', 'cold', 'pending']);

            // Format username for display - SHOW COMPLETE FORMATTED NAME
            $displayName = 'Unassigned';
            $avatarLetter = 'U';
            $firstName = 'Unassigned';

            if ($inquiry->assignedUser) {
                $rawUsername = $inquiry->assignedUser->username;

                // Remove "@" if exists
                $cleaned = ltrim($rawUsername, '@');

                // Add space before capital letters (except first letter)
                $formattedName = preg_replace('/(?<!^)([A-Z])/', ' $1', $cleaned);

                // Capitalize properly
                $formattedName = ucwords($formattedName);

                $displayName = $formattedName; // Use complete formatted name
                $firstName = strtok($formattedName, ' '); // Extract first name for display
                $avatarLetter = strtoupper(substr($firstName, 0, 1));
            }
        @endphp

        @if (!empty($inquiry->response))
            {{-- Parse and display follow-ups --}}
            @php
                // Parse follow-ups with better regex pattern
                $followUpData = [];
                
                // Check if the response contains our F-number format
                if (preg_match('/--- F\d+ \|/', $inquiry->response)) {
                    // Split by the F-number pattern
                    $parts = preg_split('/(--- F\d+ \| [^-]+ ---)/', $inquiry->response, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                    
                    $currentFollowUp = null;
                    
                    foreach ($parts as $part) {
                        $part = trim($part);
                        
                        // Check if this part is a header (contains F-number)
                        if (preg_match('/--- (F\d+) \| ([^-]+) ---/', $part, $headerMatches)) {
                            if ($currentFollowUp) {
                                $followUpData[] = $currentFollowUp;
                            }
                            
                            $currentFollowUp = [
                                'number' => $headerMatches[1],
                                'timestamp' => $headerMatches[2],
                                'content' => ''
                            ];
                        } else if ($currentFollowUp) {
                            // This is content for the current follow-up
                            $currentFollowUp['content'] = trim($part);
                        }
                    }
                    
                    // Don't forget the last follow-up
                    if ($currentFollowUp) {
                        $followUpData[] = $currentFollowUp;
                    }
                    
                    // Handle the content before the first F-number (if any)
                    if (!empty($parts) && !preg_match('/--- F\d+ \|/', $parts[0])) {
                        $initialContent = trim($parts[0]);
                        if (!empty($initialContent)) {
                            array_unshift($followUpData, [
                                'number' => 'F1',
                                'timestamp' => $inquiry->created_at->format('M j, Y g:i A'),
                                'content' => $initialContent
                            ]);
                        }
                    }
                } else {
                    // No F-number format found, treat as single response
                    $content = trim($inquiry->response);
                    if (!empty($content)) {
                        $followUpData[] = [
                            'number' => 'F1',
                            'timestamp' => $inquiry->updated_at->format('M j, Y g:i A'),
                            'content' => $content
                        ];
                    }
                }
                
                $followUpData = array_reverse($followUpData); // Show latest first
            @endphp

            {{-- Response Exists - Enhanced Chat Message Style --}}
            <div class="chat-messages" style="padding: 12px;">
                {{-- Message Header --}}
                <div class="message-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                    <div class="user-info" style="display: flex; align-items: center; gap: 6px;">
                        <div class="avatar"
                            style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #a9a3f0 0%, #7367F0 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 11px;">
                            {{ $avatarLetter }}
                        </div>
                        <div>
                            <div style="font-weight: 600; color: #2d3748; font-size: 12px; line-height: 1.2;">
                                {{ $firstName }}
                            </div>
                            <div style="font-size: 10px; color: #718096; line-height: 1.2;">
                                {{ count($followUpData) }} follow-up(s)
                            </div>
                        </div>
                    </div>

                    {{-- Time Information --}}
                    <div class="time-info-right" style="text-align: right;">
                        <div class="time-with-status" style="display: flex; align-items: center; gap: 6px; justify-content: flex-end; margin-bottom: 2px;">
                            <div class="status-indicator {{ $dateStatus['updated_at_old'] ? 'urgent' : 'normal' }}" 
                                style="width: 6px; height: 6px; border-radius: 50%; {{ $dateStatus['updated_at_old'] ? 'background-color: #dc3545; animation: blink 1s linear infinite;' : 'background-color: #48bb78;' }}">
                            </div>
                            <div class="message-time {{ $dateStatus['updated_at_old'] ? 'urgent-text' : '' }}" 
                                style="font-size: 10px; white-space: nowrap; {{ $dateStatus['updated_at_old'] ? 'color:#fff; font-weight:600; background:#dc3545; padding:1px 4px; border-radius:3px; animation: blink 1s linear infinite;' : 'color:#718096;' }}">
                                @if($inquiry->updated_at != $inquiry->created_at)
                                    Updated: {{ $inquiry->updated_at->format('M d, h:i A') }}
                                @else
                                    Created: {{ $inquiry->created_at->format('M d, h:i A') }}
                                @endif
                            </div>
                        </div>

                        {{-- Created At for updated responses --}}
                        @if($inquiry->updated_at != $inquiry->created_at)
                            <div style="font-size: 9px; color: #a0aec0; margin-bottom: 2px; line-height: 1.2;">
                                Created: {{ $inquiry->created_at->format('M d, h:i A') }}
                            </div>
                        @endif

                        <div style="font-size: 9px; color: #a0aec0; line-height: 1.2;">
                            {{ $inquiry->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                {{-- Follow-up Messages - Compact for admin panel --}}
                <div class="follow-up-messages">
                    @foreach($followUpData as $index => $followUp)
                        <div class="follow-up-item {{ $index === 0 ? 'latest' : 'previous' }}" 
                            style="margin-bottom: {{ $index === count($followUpData) - 1 ? '0' : '8px' }}; 
                                   padding: {{ $index === 0 ? '8px' : '6px' }}; 
                                   background: {{ $index === 0 ? '#f7fafc' : 'transparent' }}; 
                                   border-radius: 6px; 
                                   border-left: {{ $index === 0 ? '3px solid #7367F0' : '1px solid #e2e8f0' }};
                                   transition: all 0.2s ease;">
                            
                            {{-- Follow-up Header --}}
                            <div class="follow-up-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                <div class="follow-up-badge" style="display: flex; align-items: center; gap: 4px;">
                                    <span class="follow-up-number" 
                                        style="background: {{ $index === 0 ? 'linear-gradient(135deg, #7367F0 0%, #9e95f5 100%)' : '#e2e8f0' }}; 
                                               color: {{ $index === 0 ? 'white' : '#4a5568' }}; 
                                               padding: 1px 6px; 
                                               border-radius: 10px; 
                                               font-size: 9px; 
                                               font-weight: 600;
                                               text-transform: uppercase;
                                               transition: all 0.2s ease;">
                                        {{ $followUp['number'] }}
                                    </span>
                                    @if($index === 0)
                                        <span style="font-size: 9px; color: #48bb78; font-weight: 600; background: #f0fff4; padding: 1px 4px; border-radius: 6px;">
                                            Latest
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="follow-up-time" style="font-size: 9px; color: #a0aec0;">
                                    {{ \Carbon\Carbon::parse($followUp['timestamp'])->format('M d, h:i A') }}
                                </div>
                            </div>

                            {{-- Follow-up Content --}}
                            <div class="follow-up-content" 
                                style="color: #4a5568; 
                                       line-height: 1.4; 
                                       font-size: 12px; 
                                       white-space: pre-wrap; 
                                       word-wrap: break-word;">
                                {!! nl2br(htmlspecialchars_decode(trim($followUp['content']))) !!}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Quick Stats --}}
                @if(count($followUpData) > 1)
                    <div class="follow-up-stats" style="margin-top: 8px; padding-top: 6px; border-top: 1px dashed #e2e8f0;">
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 10px; color: #718096;">
                            <span>Follow-up progression:</span>
                            <span style="font-weight: 600; color: #7367F0;">
                                {{ $followUpData[count($followUpData)-1]['number'] }} → {{ $followUpData[0]['number'] }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        @else
            {{-- No Response - Compact Empty State --}}
            <div class="empty-state"
                style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px 15px;">
                <div
                    style="width: 40px; height: 40px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 8px;">
                    <svg style="width: 20px; height: 20px; color: #cbd5e0;" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                </div>

                <div style="text-align: center; margin-bottom: 12px;">
                    <div
                        style="font-weight: 600; color: #4a5568; margin-bottom: 2px; font-size: 12px;">
                        No Response</div>
                    <div style="font-size: 10px; color: #718096;">Waiting for remarks</div>
                </div>

                @if($inquiry->assigned_at)
                    <div class="assignment-info" style="text-align: center;">
                        <div class="assigned-badge {{ $dateStatus['assigned_at_pending'] ? 'pending' : 'assigned' }}"
                            style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: {{ $dateStatus['assigned_at_pending'] ? '#fed7d7' : '#e6fffa' }}; border-radius: 12px; font-size: 10px;">
                            <div class="status-dot"
                                style="width: 6px; height: 6px; border-radius: 50%; {{ $dateStatus['assigned_at_pending'] ? 'background-color: #b00020;' : 'background-color: #38a169;' }}">
                            </div>
                            <span
                                style="color: {{ $dateStatus['assigned_at_pending'] ? '#c53030' : '#2f855a' }}; font-weight: 600;">
                                Assigned:
                                {{ \Carbon\Carbon::parse($inquiry->assigned_at)->format('M d, h:i A') }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <style>
        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }

            100% {
                opacity: 1;
            }
        }

        .response-container::-webkit-scrollbar {
            width: 4px;
        }

        .response-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .response-container::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 2px;
        }

        .response-container::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        .urgent-text {
            animation: blink 1s linear infinite;
        }
        
        .follow-up-item:hover {
            background: #f7fafc !important;
            transform: translateX(2px);
        }
        
        .follow-up-item.latest {
            box-shadow: 0 1px 2px rgba(115, 103, 240, 0.1);
        }
        
        .follow-up-item:hover .follow-up-number {
            transform: scale(1.05);
        }
    </style>
</td>
                                            <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
    <!-- Current Inquiry Status Badge -->
    <span class="badge text-white"
        style="font-size: 13px; padding: 4px 6px;
        @if ($inquiry->inquiry_status === 'hot') background-color: #ff5733;
        @elseif($inquiry->inquiry_status === 'cold') background-color: #00c0ff;
        @elseif($inquiry->inquiry_status === 'dead') background-color: #6c757d;
        @elseif($inquiry->inquiry_status === 'registered') background-color: #28a745;
        @elseif($inquiry->inquiry_status === 'open') background-color: #28a745;
        @elseif($inquiry->inquiry_status === 'pending' || is_null($inquiry->inquiry_status)) background-color: #ffc107; color: #000;
        @else background-color: #adb5bd; @endif"
        title="Updated on: {{ $inquiry->updated_at ? \Carbon\Carbon::parse($inquiry->updated_at)->format('M d, Y h:i A') : 'N/A' }}">
        
        @if ($inquiry->inquiry_status === 'cold')
            <i class="fas fa-snowflake me-1"></i> <strong>Cold</strong>
        @elseif($inquiry->inquiry_status === 'hot')
            <i class="fas fa-fire me-1"></i> <strong>Hot</strong>
        @elseif($inquiry->inquiry_status === 'dead')
            <i class="fas fa-times-circle me-1"></i> <strong>Dead</strong>
        @elseif($inquiry->inquiry_status === 'open')
            <i class="fas fa-folder-open me-1"></i> <strong>Open</strong>
        @elseif($inquiry->inquiry_status === 'registered')
            <i class="fas fa-check-circle me-1"></i> <strong>Registered</strong>
        @elseif($inquiry->inquiry_status === 'pending' || is_null($inquiry->inquiry_status))
            <i class="fas fa-exclamation-circle me-1" style="color: #000;"></i> 
            <strong style="color: #000;">Pending</strong>
        @else
            {{ ucfirst($inquiry->inquiry_status) }}
        @endif
    </span>

    <!-- Previous Status + Updated Time -->
    @if($inquiry->previous_inquiry_status || $inquiry->inquiry_status_updated_at)
        <div class="mt-1 text-center">
            @php
                $prevStatus = strtolower($inquiry->previous_inquiry_status ?? 'N/A');
                $bgColor = match($prevStatus) {
                    'hot' => '#ff5733',
                    'cold' => '#00c0ff',
                    'dead' => '#6c757d',
                    'registered', 'open' => '#28a745',
                    'pending' => '#ffc107',
                    default => '#adb5bd',
                };
                $textColor = $prevStatus === 'pending' ? '#000' : '#fff';
            @endphp

            <!-- Smaller Previous Status Badge -->
            <small class="text-muted d-block" style="font-size: 10px;">
                <i class="fas fa-history me-1" style="font-size: 9px; opacity: 0.7;"></i>
                Prev:
                <span class="badge"
                    style="background-color: {{ $bgColor }};
                           color: {{ $textColor }};
                           font-size: 9px;
                           padding: 2px 4px;
                           border-radius: 6px;
                           opacity: 0.6;">
                    {{ ucfirst($prevStatus) }}
                </span>
            </small>

            <!-- Status Updated Time -->
            @if($inquiry->inquiry_status_updated_at)
                <small class="text-secondary d-block mt-1" style="font-size: 9px;">
                    <i class="far fa-clock me-1" style="font-size: 9px;"></i>
                    {{ \Carbon\Carbon::parse($inquiry->inquiry_status_updated_at)->format('M d, Y h:i A') }}
                </small>
            @endif
        </div>
    @endif

    <!-- Modern Location Card -->
    <div class="mt-1">
        <div class="d-flex justify-content-center">
            @if(!empty($inquiry->budget))
                @php
                    $cityText = trim($inquiry->budget);
                    $words = preg_split('/[\s,]+/', $cityText, 3);
                    $wordCount = count($words);
                    
                    if ($wordCount === 1) {
                        $displayHTML = '<strong>'.$words[0].'</strong>';
                        $tooltip = null;
                    } elseif ($wordCount === 2) {
                        $displayHTML = '<strong>'.$words[0].'</strong><br><small>'.$words[1].'</small>';
                        $tooltip = null;
                    } else {
                        $displayHTML = '<strong>'.$words[0].'</strong><br><small>'.$words[1].'...</small>';
                        $tooltip = $cityText;
                    }
                @endphp

                <div class="text-center city-display" 
                     @if($tooltip) title="{{ $tooltip }}" @endif
                     style="transition: all 0.3s ease; cursor: @if($tooltip) pointer @else default @endif;">
                    
                    <!-- Icon -->
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-1 shadow"
                         style="width: 26px; height: 26px;">
                        <i class="fas fa-location-dot text-white" style="font-size: 11px;"></i>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="bg-white rounded px-3 py-1 border shadow-sm"
                         style="font-size: 10px; min-width: 80px; line-height: 1.2;">
                        {!! $displayHTML !!}
                    </div>
                </div>
            @else
                <!-- No Location State -->
                <div class="text-center">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-1"
                         style="width: 24px; height: 24px;">
                        <i class="fas fa-map-marker-alt text-muted" style="font-size: 9px;"></i>
                    </div>
                    <div class="bg-light rounded px-2 py-1 border border-dashed" style="font-size: 9px;">
                        <span class="text-muted">No Location</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</td>


                              
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                
            </table>
             <div class="mt-4 container-fluid">
        {{ $inquiries->links('pagination::bootstrap-5') }}
    </div>
        </div>
    </div>
  
</div>
