<div>
    <div class="row mb-2 d-flex justify-content-between flex-wrap" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
    
    {{-- Total Inquiries --}}
    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
        <a href="{{ route('agent.inquiries') }}" class="text-decoration-none">
            <div class="card text-center bg-primary"
                 style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-list fa-2x" style="color: white;"></i>
                        <h3 class="fw-bold m-0" style="color: white;">{{ $totalLeads }}</h3>
                    </div>
                    <h6 class="mt-3 mb-0 text-white"><strong>All Inquiries</strong></h6>
                    <button class="btn btn-sm mt-3 text-primary"
                            style="background-color: white; font-size: 11px;">View All</button>
                </div>
            </div>
        </a>
    </div>

    {{-- Hot Leads --}}
    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
        <a href="{{ route('agent.inquiry.hot') }}" class="text-decoration-none">
            <div class="card text-center"
                 style="background-color: #ff5722; height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-fire fa-2x" style="color: white;"></i>
                        <h3 class="fw-bold m-0" style="color: white;">{{ $hotLeads }}</h3>
                    </div>
                    <h6 class="mt-3 mb-0 text-white"><strong>Hot</strong></h6>
                    <button class="btn btn-sm mt-3"
                            style="background-color: white; color: #ff5722; font-size: 11px;">View All</button>
                </div>
            </div>
        </a>
    </div>

    {{-- Cold Leads --}}
    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
        <a href="{{ route('agent.inquiry.cold') }}" class="text-decoration-none">
            <div class="card text-center bg-info"
                 style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-snowflake fa-2x" style="color: white;"></i>
                        <h3 class="fw-bold m-0" style="color: white;">{{ $coldLeads }}</h3>
                    </div>
                    <h6 class="mt-3 mb-0 text-white"><strong>Cold</strong></h6>
                    <button class="btn btn-sm mt-3"
                            style="background-color: white; color: #0dcaf0; font-size: 11px;">View All</button>
                </div>
            </div>
        </a>
    </div>

    {{-- Dead Leads --}}
    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
        <a href="{{ route('agent.inquiry.dead') }}" class="text-decoration-none">
            <div class="card text-center bg-dark"
                 style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-times-circle fa-2x" style="color: white;"></i>
                        <h3 class="fw-bold m-0" style="color: white;">{{ $deadLeads }}</h3>
                    </div>
                    <h6 class="mt-3 mb-0 text-white"><strong>Dead</strong></h6>
                    <button class="btn btn-sm mt-3 text-dark"
                            style="background-color: white; font-size: 11px;">View All</button>
                </div>
            </div>
        </a>
    </div>

    {{-- Pending Leads --}}
    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
        <a href="{{ route('agent.inquiry.pending') }}" class="text-decoration-none">
            <div class="card text-center"
                 style="background-color: #ffc107; height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-hourglass-half fa-2x" style="color: black;"></i>
                        <h3 class="fw-bold m-0" style="color: black;">{{ $pendingLeads }}</h3>
                    </div>
                    <h6 class="mt-3 mb-0" style="color: black;"><strong>Pending</strong></h6>
                    <button class="btn btn-sm mt-3"
                            style="background-color: white; color: black; font-size: 11px;">View All</button>
                </div>
            </div>
        </a>
    </div>

    {{-- Registered Leads --}}
    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
        <a href="{{ route('agent.admission-dashboard')}}" class="text-decoration-none">
            <div class="card text-center bg-success"
                 style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-user-check fa-2x" style="color: white;"></i>
                        <h3 class="fw-bold m-0" style="color: white;">{{ $registeredLeads }}</h3>
                    </div>
                    <h6 class="mt-3 mb-0 text-white"><strong>Registered</strong></h6>
                    <button class="btn btn-sm mt-3 text-success"
                            style="background-color: white; font-size: 11px;">View All</button>
                </div>
            </div>
        </a>
    </div>
</div>
    <div class="card">
        <div>
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
                <div class="input-group input-group-sm" style="width: 100%;" wire:key="search-container-{{ $search }}">
                    <input type="text" 
                           class="form-control form-control-lg border-0" 
                           placeholder="Search by Name or Phone" 
                           wire:model.defer="search"
                           style="border-radius: 8px 0 0 8px !important; box-shadow: none !important;">
                    <button class="btn btn-dark border-0 px-4" 
                            wire:click="searches"
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
    background: linear-gradient(135deg, #ff5733 70%, #ffb199 100%) !important;
}
</style>

            <div class="card">
                <table class="table table-bordered align-middle text-center" style="font-size: 15px;">
                    <thead class="table-light">
                        <tr>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
            <i class="fas fa-list-ol" style="margin-right: 5px;"></i>
        </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                                <i class="fas fa-user" style="margin-right: 5px;"></i> Name
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                                <i class="fas fa-phone" style="margin-right: 5px;"></i> Contact
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: normal; width: 35%;">
                                <i class="fas fa-reply" style="margin-right: 5px;"></i> Remarks
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                                <i class="fas fa-book" style="margin-right: 5px;"></i> Education
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 20%;">
                                <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> English Test
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
                                <i class="fas fa-check-circle" style="margin-right: 5px;"></i> Status
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
                                <i class="fas fa-cogs" style="margin-right: 5px;"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $hotInquiries = $inquiries->filter(function ($inquiry) {
                                return strtolower($inquiry->inquiry_status) === 'hot';
                            });
                        @endphp
                    
                        @if ($hotInquiries->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted" style="padding: 20px;">
                                    No hot inquiries found.
                                </td>
                            </tr>
                        @else
                            @foreach ($hotInquiries as $inquiry)
                            <tr style="text-align: left" id="inquiry-{{ $inquiry->id }}">
                                <td style="vertical-align: middle; text-align: center;">
                    {{ ($inquiries->currentPage() - 1) * $inquiries->perPage() + $loop->iteration }}
                </td>
                                      <td class="whitespace-normal break-words max-w-[150px]" style="padding: 8px;">
    <div style="border-left: 3px solid #ff5722; padding-left: 8px;">
        <div style="font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Student Name</div>
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
            <div style="font-size: 9px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
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

       <td style="vertical-align: top; padding: 12px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    <div class="response-container" 
        style="height: 180px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 12px; padding: 0; background: #ffffff; font-size: 13px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
        
        @php
            $dateStatus = $this->getDateStatus($inquiry);
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
            <div class="chat-messages" style="padding: 16px;">
                {{-- Message Header --}}
                <div class="message-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                    @php
                        $rawUsername = Auth::user()->username;
                        $cleaned = ltrim($rawUsername, '@');
                        $formattedName = preg_replace('/(?<!^)([A-Z])/', ' $1', $cleaned);
                        $formattedName = ucwords($formattedName);
                        $firstName = strtok($formattedName, ' ');
                        $avatarLetter = strtoupper(substr($firstName, 0, 1));
                    @endphp

                    <div class="user-info" style="display: flex; align-items: center; gap: 6px;">
                        <div class="avatar" style="width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, #a9a3f0 0%, #7367F0 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 12px;">
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

                {{-- Follow-up Messages - Plain chat without inner scroll --}}
                <div class="follow-up-messages">
                    @foreach($followUpData as $index => $followUp)
                        <div class="follow-up-item {{ $index === 0 ? 'latest' : 'previous' }}" 
                            style="margin-bottom: {{ $index === count($followUpData) - 1 ? '0' : '12px' }}; 
                                   padding: {{ $index === 0 ? '12px' : '8px' }}; 
                                   background: {{ $index === 0 ? '#f7fafc' : 'transparent' }}; 
                                   border-radius: 8px; 
                                   border-left: {{ $index === 0 ? '3px solid #7367F0' : '1px solid #e2e8f0' }};
                                   transition: all 0.2s ease;">
                            
                            {{-- Follow-up Header --}}
                            <div class="follow-up-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <div class="follow-up-badge" style="display: flex; align-items: center; gap: 6px;">
                                    <span class="follow-up-number" 
                                        style="background: {{ $index === 0 ? 'linear-gradient(135deg, #7367F0 0%, #9e95f5 100%)' : '#e2e8f0' }}; 
                                               color: {{ $index === 0 ? 'white' : '#4a5568' }}; 
                                               padding: 2px 8px; 
                                               border-radius: 12px; 
                                               font-size: 10px; 
                                               font-weight: 600;
                                               text-transform: uppercase;
                                               transition: all 0.2s ease;">
                                        {{ $followUp['number'] }}
                                    </span>
                                    @if($index === 0)
                                        <span style="font-size: 10px; color: #48bb78; font-weight: 600; background: #f0fff4; padding: 1px 6px; border-radius: 8px;">
                                            Latest
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="follow-up-time" style="font-size: 10px; color: #a0aec0;">
                                    {{ \Carbon\Carbon::parse($followUp['timestamp'])->format('M d, h:i A') }}
                                    <span style="color: #cbd5e0; margin-left: 4px;">
                                        ({{ \Carbon\Carbon::parse($followUp['timestamp'])->diffForHumans() }})
                                    </span>
                                </div>
                            </div>

                            {{-- Follow-up Content - Full content for all messages --}}
                            <div class="follow-up-content" 
                                style="color: #4a5568; 
                                       line-height: 1.4; 
                                       font-size: {{ $index === 0 ? '13px' : '12px' }}; 
                                       white-space: pre-wrap; 
                                       word-wrap: break-word;">
                                {!! nl2br(htmlspecialchars_decode(trim($followUp['content']))) !!}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Quick Stats --}}
                @if(count($followUpData) > 1)
                    <div class="follow-up-stats" style="margin-top: 12px; padding-top: 8px; border-top: 1px dashed #e2e8f0;">
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 11px; color: #718096;">
                            <span>Follow-up progression:</span>
                            <span style="font-weight: 600; color: #7367F0;">
                                {{ $followUpData[count($followUpData)-1]['number'] }} → {{ $followUpData[0]['number'] }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        @else
            {{-- No Response - Empty State (Keep existing) --}}
            <div class="empty-state" style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px 20px;">
                <div style="width: 64px; height: 64px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg style="width: 32px; height: 32px; color: #cbd5e0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                
                <div style="text-align: center; margin-bottom: 16px;">
                    <div style="font-weight: 600; color: #4a5568; margin-bottom: 4px;">No Response Yet</div>
                    <div style="font-size: 12px; color: #718096;">Waiting for counsellor's remarks</div>
                </div>

                @if($inquiry->assigned_at)
                    <div class="assignment-info" style="text-align: center;">
                        <div class="assigned-badge {{ $dateStatus['assigned_at_pending'] ? 'pending' : 'assigned' }}" 
                            style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; background: {{ $dateStatus['assigned_at_pending'] ? '#fed7d7' : '#e6fffa' }}; border-radius: 20px; font-size: 12px;">
                            <div class="status-dot" style="width: 8px; height: 8px; border-radius: 50%; {{ $dateStatus['assigned_at_pending'] ? 'background-color: #b00020; animation: blink 1s linear infinite;' : 'background-color: #38a169;' }}"></div>
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <span style="color: {{ $dateStatus['assigned_at_pending'] ? '#c53030' : '#2f855a' }}; font-weight: 600; font-size: 11px;">
                                    Assigned: {{ \Carbon\Carbon::parse($inquiry->assigned_at)->format('M d, h:i A') }}
                                </span>
                                <span style="font-size: 10px; color: {{ $dateStatus['assigned_at_pending'] ? '#e53e3e' : '#38a169' }};">
                                    {{ \Carbon\Carbon::parse($inquiry->assigned_at)->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <style>
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.3; }
            100% { opacity: 1; }
        }
        
        .response-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .response-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        .response-container::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 3px;
        }
        
        .response-container::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
        
        .follow-up-item:hover {
            background: #f7fafc !important;
            transform: translateX(2px);
        }
        
        .follow-up-item.latest {
            box-shadow: 0 2px 4px rgba(115, 103, 240, 0.1);
        }
        
        .urgent-text {
            animation: blink 1s linear infinite;
        }
        
        .follow-up-item:hover .follow-up-number {
            transform: scale(1.05);
        }
    </style>
</td>
                                    
                                    <td style="padding: 8px; word-break: break-word; overflow-wrap: break-word; max-width: 150px;">
    <div style="min-height: 36px; display: flex; align-items: center; {{ empty($inquiry->study_course) ? 'justify-content: center;' : '' }}">
        @if (!empty($inquiry->study_course))
            <div style="font-size: 13px; color: #1f2937; font-weight: 400; line-height: 1.4; 
                      border-left: 2px solid #e5e7eb; padding-left: 8px;">
                {{ ucfirst(e($inquiry->study_course)) }}
            </div>
        @else
            <span class="badge bg-light text-black" style="font-size: 12px; padding: 4px 8px; border-radius: 4px; background: #f8f9fa; color: #000; border: 1px solid #dee2e6;">
                Null
            </span>
        @endif
    </div>
</td>

<td style="padding: 8px; word-break: break-word; overflow-wrap: break-word; max-width: 150px;">
    <div style="min-height: 36px; display: flex; align-items: center; {{ empty($inquiry->extra) ? 'justify-content: center;' : '' }}">
        @if (!empty($inquiry->extra))
            <div style="font-size: 13px; color: #1f2937; font-weight: 400; line-height: 1.4; 
                      border-left: 2px solid #e5e7eb; padding-left: 8px;">
                {{ ucfirst(e($inquiry->extra)) }}
            </div>
        @else
            <span class="badge bg-light text-black" style="font-size: 12px; padding: 4px 8px; border-radius: 4px; background: #f8f9fa; color: #000; border: 1px solid #dee2e6;">
                Null
            </span>
        @endif
    </div>
</td>
                                   <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
    <!-- Current Inquiry Status Badge -->
    <span class="badge text-white"
        style="font-size: 13px; padding: 4px 6px; background-color: #ff5733;"
        title="Updated on: {{ $inquiry->updated_at ? $inquiry->updated_at->format('M d, Y h:i A') : 'N/A' }}">
        <i class="fas fa-fire me-1"></i> <strong>Hot</strong>
    </span>

    <!-- Previous Status + Updated Time -->
    @if($inquiry->previous_inquiry_status || $inquiry->inquiry_status_updated_at)
        <div class="mt-1 text-center">
            <small class="text-muted d-block" style="font-size: 11px;">
                <i class="fas fa-history me-1"></i>
                Prev:
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
                <span class="badge"
                    style="background-color: {{ $bgColor }};
                           color: {{ $textColor }};
                           font-size: 9.5px;
                           padding: 2px 4px;
                           opacity: 0.6;">
                    {{ ucfirst($prevStatus) }}
                </span>
            </small>

            @if($inquiry->inquiry_status_updated_at)
                <small class="text-secondary" style="font-size: 10px;">
                    <i class="far fa-clock me-1"></i>
                    {{ \Carbon\Carbon::parse($inquiry->inquiry_status_updated_at)->format('M d, Y h:i A') }}
                </small>
            @endif
        </div>
    @endif

    <!-- Modern Budget Card -->
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
                    
                    <!-- Location Icon -->
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-1 shadow"
                         style="width: 26px; height: 26px;">
                        <i class="fas fa-location-dot text-white" style="font-size: 11px;"></i>
                    </div>

                    <!-- City Text -->
                    <div class="bg-white rounded px-3 py-1 border shadow-sm"
                         style="font-size: 10px; min-width: 80px; line-height: 1.2;">
                        {!! $displayHTML !!}
                    </div>
                </div>
            @else
                <!-- No City Case -->
                <div class="text-center">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-1"
                         style="width: 24px; height: 24px;">
                        <i class="fas fa-map-marker-alt text-muted" style="font-size: 9px;"></i>
                    </div>
                    <div class="bg-light rounded px-2 py-1 border border-dashed" style="font-size: 9px;">
                        <span class="text-muted">No City</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</td>

                                    <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center; width: 80px;">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button wire:click="$dispatch('editInquiry', { id: {{ $inquiry->id }} })"
                                                class="btn btn-xs btn-success px-2 py-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="$dispatch('viewDetails', { id: {{ $inquiry->id }} })"
                                                class="btn btn-xs btn-info px-2 py-1" title="Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    
                </table>
            </div>
            <div class="container mt-2">
        {{ $inquiries->links('pagination::bootstrap-5') }}
    </div>
        <div>
            <!-- Edit Modal -->
 <!-- UPDATED MODALS: Added unique keys and wire:key attributes -->
            <livewire:agent.modal.editInquiries 
                wire:key="edit-modal-{{ time() }}" />
            
            <livewire:agent.modal.viewInquiries 
                wire:key="view-modal-{{ time() }}" />


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
