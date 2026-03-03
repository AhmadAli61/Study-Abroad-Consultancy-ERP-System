<div>
<div class="col-12">
    <div class="card border-0 shadow-sm">
        <!-- Page Header -->
       <div class="bg-gradient-primary text-white px-4 py-4" style="border-radius: 12px 12px 0 0;">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-1 text-white fw-bold">
                <i class="fas fa-chart-line me-2"></i> {{ preg_replace('/([a-z])([A-Z])/', '$1 $2', ltrim($user->username, '@')) }} - Performance Report
            </h4>
            <div class="d-flex align-items-center flex-wrap gap-3 mt-2">
                <span class="opacity-75 d-flex align-items-center">
                    <i class="fas fa-user-tag me-1"></i> 
                    Role: <strong class="ms-1 text-capitalize">{{ $user->role }}</strong>
                </span>
                <span class="opacity-75 d-flex align-items-center">
                    <i class="fas fa-calendar me-1"></i> 
                    Report: <strong class="ms-1">{{ now()->format('F Y') }}</strong>
                </span>
            </div>
        </div>
        <div class="text-end">
            <div class="d-flex gap-3">
                <!-- Total Inquiries -->
                <div class="bg-white bg-opacity-20 px-3 py-2 rounded text-center">
                    <h5 class="mb-0 text-dark">{{ $totalInquiries ?? 0 }}</h5>
                    <small class="opacity-75 text-dark">Total Inquiries</small>
                </div>
                <!-- Total Registrations -->
                <div class="bg-white bg-opacity-20 px-3 py-2 rounded text-center">
                    <h5 class="mb-0 text-dark">{{ $totalRegistered ?? 0 }}</h5>
                    <small class="opacity-75 text-dark">Total Applications</small>
                </div>
            </div>
        </div>
    </div>
</div>

  <style>
    /* ✅ Stylish primary glow outline */
    .glow-card {
        border: 1px solid rgba(13, 110, 253, 0.3);
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.25);
        transition: all 0.3s ease;
    }
    .glow-card:hover {
        box-shadow: 0 0 25px rgba(13, 110, 253, 0.4);
        transform: translateY(-2px);
    }
</style>

<style>
    /* ✅ Stylish primary glow outline */
    .glow-card {
        border: 1px solid rgba(13, 110, 253, 0.3);
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.25);
        transition: all 0.3s ease;
    }
    .glow-card:hover {
        box-shadow: 0 0 25px rgba(13, 110, 253, 0.4);
        transform: translateY(-2px);
    }
</style>

<div class="card-body row g-4">

    <!-- ====== OVERALL PERFORMANCE ====== -->
<div class="col-lg-6">
    <div class="card shadow-sm border-0 glow-card h-100">
        
        <!-- 🔹 Header -->
        <div class="card-header mb-4 border-0 py-3 d-flex align-items-center justify-content-between"
             style="background: linear-gradient(90deg, #eaf4ff 0%, #eaf4ff 100%); border-bottom: 2px solid #0d6efd;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width: 38px; height: 38px; background-color: rgba(13, 110, 253, 0.1);">
                    <i class="fas fa-chart-bar text-primary fs-5"></i>
                </div>
                <h5 class="mb-0 fw-semibold text-dark">Overall Performance</h5>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <!-- Total Inquiries -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                         style="border-left: 4px solid #0d6efd; outline: 1.5px solid #dee2e6; outline-offset: -4px; border-radius: 10px;">
                        <div class="card-body text-center">
                            <i class="fas fa-list fa-2x text-primary mb-2"></i>
                            <h4 class="fw-bold text-primary mb-0">{{ $totalInquiries ?? 0 }}</h4>
                            <small class="text-muted d-block mt-1">Total Inquiries</small>
                        </div>
                    </div>
                </div>

                <!-- Total Registered -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                         style="border-left: 4px solid #198754; outline: 1.5px solid #dee2e6; outline-offset: -4px; border-radius: 10px;">
                        <div class="card-body text-center">
                            <i class="fas fa-user-check fa-2x text-success mb-2"></i>
                            <h4 class="fw-bold text-success mb-0">{{ $totalRegistered ?? 0 }}</h4>
                            <small class="text-muted d-block mt-1">Total Registered</small>
                        </div>
                    </div>
                </div>

                <!-- Conversion Rate -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                         style="border-left: 4px solid #0dcaf0; outline: 1.5px solid #dee2e6; outline-offset: -4px; border-radius: 10px;">
                        <div class="card-body text-center">
                            <i class="fas fa-percentage fa-2x text-info mb-2"></i>
                            <h4 class="fw-bold text-info mb-0">{{ $conversionRate ?? 0 }}%</h4>
                            <small class="text-muted d-block mt-1">Conversion Rate</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- ====== MONTHLY PERFORMANCE ====== -->
 <div class="col-lg-6">
    <div class="card shadow-sm border-0 glow-card h-100">
        
        <!-- 🔹 New Header Style -->
        <div class="card-header mb-4 border-0 py-3 d-flex align-items-center justify-content-between"
             style="background: linear-gradient(90deg, #eaf4ff 0%, #eaf4ff 100%); border-bottom: 2px solid #0d6efd;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width: 38px; height: 38px; background-color: rgba(13, 110, 253, 0.1);">
                    <i class="fas fa-calendar-alt text-primary fs-5"></i>
                </div>

                <!-- 🔸 Updated Title with Month Badge -->
                <h5 class="mb-0 fw-semibold text-dark">
                    Monthly Performance 
                    <span class="badge bg-primary-subtle text-primary border border-primary ms-2 px-2 py-1"
                          style="font-size: 0.85rem; border-radius: 8px;">
                        {{ now()->format('F') }}
                    </span>
                </h5>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <!-- Monthly Inquiries -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                         style="border-left: 4px solid #ffc107; outline: 1.5px solid #dee2e6; outline-offset: -4px; border-radius: 10px;">
                        <div class="card-body text-center">
                            <i class="fas fa-list fa-2x text-primary mb-2"></i>
                            <h4 class="fw-bold text-primary mb-0">{{ $monthlyInquiries ?? 0 }}</h4>
                            <small class="text-muted d-block mt-1">Inquiries</small>
                        </div>
                    </div>
                </div>

                <!-- Monthly Registered -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                         style="border-left: 4px solid #6f42c1; outline: 1.5px solid #dee2e6; outline-offset: -4px; border-radius: 10px;">
                        <div class="card-body text-center">
                            <i class="fas fa-user-graduate fa-2x text-success mb-2"></i>
                            <h4 class="fw-bold text-success mb-0">{{ $monthlyRegistered ?? 0 }}</h4>
                            <small class="text-muted d-block mt-1">Registered</small>
                        </div>
                    </div>
                </div>

                <!-- Monthly Conversion -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                         style="border-left: 4px solid #20c997; outline: 1.5px solid #dee2e6; outline-offset: -4px; border-radius: 10px;">
                        <div class="card-body text-center">
                            <i class="fas fa-percentage fa-2x text-info mb-2"></i>
                            <h4 class="fw-bold text-info mb-0">{{ $monthlyConversionRate ?? 0 }}%</h4>
                            <small class="text-muted d-block mt-1">Conversion</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</div>


 <div class="row ">
                    <div class="col-12">
                        <hr class="border-1 border-secondary opacity-25">
                    </div>
                </div>
       <div class="card-body border-bottom">
   <div class="col-12 mb-5">
    <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
         style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                 style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                <i class="fas fa-chart-pie text-primary fs-5"></i>
            </div>
            <div>
                <h4 class="mb-1 fw-bold text-dark">Inquiry Status Distribution</h4>
                <p class="text-muted mb-0 small">Overview of inquiries by current status</p>
            </div>
        </div>

       
    </div>
</div>

    <div class="row g-2 mb-2">
        @foreach($statusDistribution as $status)
        <div class="col">
            <div class="card text-center border-0 shadow-sm h-100 
                @if($status['status'] == 'hot') bg-danger
                @elseif($status['status'] == 'cold') bg-info
                @elseif($status['status'] == 'dead') bg-dark
                @elseif($status['status'] == 'pending') bg-warning
                @elseif($status['status'] == 'registered') bg-success
                @endif"
                style="border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="{{ $status['icon'] }} fa-2x" 
                           @if($status['status'] == 'pending') style="color: black;"
                           @else style="color: white;"
                           @endif></i>
                        <h4 class="fw-bold m-0" 
                            @if($status['status'] == 'pending') style="color: black;"
                            @else style="color: white;"
                            @endif>{{ $status['count'] }}</h4>
                    </div>
                    <h6 class="mb-2 
                        @if($status['status'] == 'pending') text-dark
                        @else text-white
                        @endif">
                        <strong>{{ $status['label'] }}</strong>
                    </h6>
                    <div class="progress w-100" style="height: 6px; 
                        @if($status['status'] == 'pending') background-color: rgba(0,0,0,0.2);
                        @else background-color: rgba(255,255,255,0.3);
                        @endif">
                        <div class="progress-bar 
                            @if($status['status'] == 'pending') bg-dark
                            @else bg-white
                            @endif" 
                             style="width: {{ $status['percentage'] }}%"></div>
                    </div>
                    <small class="mt-2
                        @if($status['status'] == 'pending') text-dark
                        @else text-white
                        @endif">
                        {{ round($status['percentage']) }}% of total
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

        <!-- Monthly Performance Chart -->
        <div class="card-body border-bottom">
            <div class="col-12 mb-4">
    <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm"
         style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                 style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                <i class="fas fa-chart-bar text-primary fs-5"></i>
            </div>
            <div>
                <h4 class="mb-1 fw-bold text-dark">Monthly Performance - Last 6 Months</h4>
                <p class="text-muted mb-0 small">Track inquiries, registrations, and conversion trends</p>
            </div>
        </div>
        
    </div>
</div>

            <div class="row mb-4">
                @foreach($monthlyPerformance as $month)
                <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                    <div class="card border-0 h-100">
                        <div class="card-body text-center p-3">
                            <h6 class="fw-bold text-dark mb-2">{{ $month['month'] }}</h6>
                            <div class="mb-2">
                                <small class="text-muted d-block">Inquiries: {{ $month['inquiries'] }}</small>
                                <small class="text-muted d-block">Registered: {{ $month['registered'] }}</small>
                            </div>
                            <div class="bg-light rounded p-2">
                                <small class="fw-bold {{ $month['conversion_rate'] >= 20 ? 'text-dark' : ($month['conversion_rate'] >= 10 ? 'text-dark' : 'text-dark') }}">
                                    {{ $month['conversion_rate'] }}%
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ====== RECENT INQUIRIES TABLE ====== -->
      <div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="fas fa-list fa-lg text-white"></i>
            <h4 class="mb-0 text-white"><strong>All Inquiries</strong></h4>
        </div>
        <div class="d-flex gap-2 align-items-center">
         
            <span class="badge bg-light text-dark rounded-pill">
                {{ $inquiries->count() }} inquiries
            </span>
        </div>
    </div>
    
    <table class="table table-bordered align-middle text-center" style="font-size: 15px;">
        <thead class="table-light">
            <tr>
                <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
                    <i class="fas fa-list-ol" style="margin-right: 5px;"></i>
                </th>
                <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                    <i class="fas fa-user"></i> Name
                </th>
                <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                    <i class="fas fa-phone"></i> Contact
                </th>
                <th style="vertical-align: middle; padding: 10px; white-space: normal; width: 35%;">
                    <i class="fas fa-reply"></i> Remarks
                </th>
                <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                    <i class="fas fa-book"></i> Education
                </th>
                <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 15%;">
                    <i class="fas fa-plus-circle"></i> English Test
                </th>
                <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
                    <i class="fas fa-check-circle"></i> Status
                </th>
                <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
                    <i class="fas fa-cogs"></i> Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inquiries as $inquiry)
                <tr style="text-align: left" id="inquiry-{{ $inquiry->id }}">
                    <td style="vertical-align: middle; text-align: center;">
                        {{ ($inquiries->currentPage() - 1) * $inquiries->perPage() + $loop->iteration }}
                    </td>
                    
                    <td class="whitespace-normal break-words max-w-[150px]" style="padding: 8px;">
                        <div style="border-left: 3px solid #7367F0; padding-left: 8px;">
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
                                {{-- Response Exists - Chat Message Style --}}
                                <div class="chat-message" style="padding: 16px;">
                                    {{-- Message Header --}}
                                    <div class="message-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                        @php
                                            // Get raw username
                                            $rawUsername = $user->username;

                                            // Remove "@" if exists
                                            $cleaned = ltrim($rawUsername, '@');

                                            // Add space before capital letters (except first letter)
                                            $formattedName = preg_replace('/(?<!^)([A-Z])/', ' $1', $cleaned);

                                            // Capitalize properly (in case)
                                            $formattedName = ucwords($formattedName);

                                            // Extract only first word (first name)
                                            $firstName = strtok($formattedName, ' ');

                                            // First letter for avatar
                                            $avatarLetter = strtoupper(substr($firstName, 0, 1));
                                        @endphp

                                        <div class="user-info" style="display: flex; align-items: center; gap: 8px;">
                                            <div class="avatar" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #a9a3f0 0%, #7367F0 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 14px;">
                                                {{ $avatarLetter }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 600; color: #2d3748; font-size: 14px;">
                                                    {{ $firstName }}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- Time Information on Right Side - Separate Rows --}}
                                        <div class="time-info-right" style="text-align: right;">
                                            {{-- Main Time with Status --}}
                                            <div class="time-with-status" style="display: flex; align-items: center; gap: 8px; justify-content: flex-end; margin-bottom: 4px;">
                                                <div class="status-indicator {{ $dateStatus['updated_at_old'] ? 'urgent' : 'normal' }}" 
                                                    style="width: 8px; height: 8px; border-radius: 50%; {{ $dateStatus['updated_at_old'] ? 'background-color: #dc3545; animation: blink 1s linear infinite;' : 'background-color: #48bb78;' }}">
                                                </div>
                                                <div class="message-time {{ $dateStatus['updated_at_old'] ? 'urgent-text' : '' }}" 
                                                    style="font-size: 11px;
                                                           white-space: nowrap;
                                                           {{ $dateStatus['updated_at_old'] 
                                                                ? 'color:#fff; font-weight:600; background:#dc3545; padding:2px 6px; border-radius:4px; animation: blink 1s linear infinite;' 
                                                                : 'color:#718096;' }}">
                                                    @if($inquiry->updated_at != $inquiry->created_at)
                                                        Updated: {{ $inquiry->updated_at->format('M d, h:i A') }}
                                                    @else
                                                        Created: {{ $inquiry->created_at->format('M d, h:i A') }}
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- Created At - Separate Row --}}
                                            @if($inquiry->updated_at != $inquiry->created_at)
                                                <div style="font-size: 11px; color: #a0aec0; margin-bottom: 4px;">
                                                    Created: {{ $inquiry->created_at->format('M d, h:i A') }}
                                                </div>
                                            @endif

                                            {{-- Time Ago - Separate Row --}}
                                            <div style="font-size: 11px; color: #a0aec0;">
                                                {{ $inquiry->updated_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Full Width Message Content --}}
                                    <div class="message-bubble" style="background: #f7fafc; border-left: 4px solid #7367F0; padding: 16px; border-radius: 8px; width: 100%; box-sizing: border-box;">
                                        <div class="message-text" style="color: #2d3748; line-height: 1.5; white-space: pre-wrap; word-wrap: break-word;">
                                            {!! nl2br(htmlspecialchars_decode(trim($inquiry->response))) !!}
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- No Response - Empty State --}}
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
                            
                            .message-bubble {
                                transition: all 0.2s ease;
                            }
                            
                            .message-bubble:hover {
                                background: #edf2f7 !important;
                                transform: translateX(2px);
                            }
                            
                            .urgent-text {
                                animation: blink 1s linear infinite;
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
                        <!-- Status Badge -->
                        <span class="badge text-white"
                            style="font-size: 13px; padding: 4px 6px;
                            @if ($inquiry->inquiry_status === 'hot') background-color: #ff5733;
                            @elseif($inquiry->inquiry_status === 'cold') background-color: #00c0ff;
                            @elseif($inquiry->inquiry_status === 'dead') background-color: #6c757d;
                            @elseif($inquiry->inquiry_status === 'registered') background-color: #28a745;
                            @elseif($inquiry->inquiry_status === 'open') background-color: #28a745;
                            @elseif($inquiry->inquiry_status === 'pending' || is_null($inquiry->inquiry_status)) background-color: #ffc107; color: #000;
                            @else background-color: #adb5bd; @endif"
                            title="{{ $inquiry->status_updated_at ? \Carbon\Carbon::parse($inquiry->updated_at)->format('M d, Y h:i A') : 'Not updated yet' }}">
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
                                <i class="fas fa-exclamation-circle me-1" style="color: #000;"></i> <strong style="color: #000;">Pending</strong>
                            @else
                                {{ ucfirst($inquiry->inquiry_status) }}
                            @endif
                        </span>
                        
                        <!-- Modern Budget Card -->
                        <div class="mt-1">
                            <div class="d-flex justify-content-center">
                                @if(!empty($inquiry->budget))
                                    @php
                                        $cityText = trim($inquiry->budget);
                                        $words = preg_split('/[\s,]+/', $cityText, 3); // Split into max 3 parts
                                        $wordCount = count($words);
                                        
                                        // Format display text
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
                                    <!-- No City State -->
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
                    
                    <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
                        <div class="d-flex justify-content-center gap-1">
                            <button wire:click="$dispatch('viewDetails', { id: {{ $inquiry->id }} })" 
                                class="btn btn-xs btn-info px-2 py-1" title="Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted" style="padding: 20px;">
                        <div class="text-muted">
                            <i class="fas fa-inbox fa-2x mb-3 opacity-50"></i>
                            <h6>No inquiries found</h6>
                            <p class="mb-0">No inquiries assigned to {{ $user->username }}</p>
                            @if ($statusFilter)
                                <small>with status <strong>{{ ucfirst($statusFilter) }}</strong></small>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    @if($inquiries->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4 p-3">
        <div>
            <p class="text-muted mb-0">
                Showing {{ $inquiries->firstItem() }} to {{ $inquiries->lastItem() }} of {{ $inquiries->total() }} results
            </p>
        </div>
        <div class="mt-2">
            {{ $inquiries->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>
    </div>
</div>
<livewire:admin.inquiries-detail.modal.view-modal />

<style>
.status-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.bg-light-purple { background-color: rgba(147, 51, 234, 0.1) !important; }
.bg-light-teal { background-color: rgba(20, 184, 166, 0.1) !important; }
.text-purple { color: #9333ea !important; }
.text-teal { color: #14b8a6 !important; }

.bg-danger { background: linear-gradient(45deg, #ff5722, #ff8a65) !important; }
.bg-info { background: linear-gradient(45deg, #00c0ff, #42a5f5) !important; }
.bg-warning { background: linear-gradient(45deg, #ffc107, #ffd54f) !important; }
.bg-success { background: linear-gradient(45deg, #28a745, #66bb6a) !important; }
.bg-dark { background: linear-gradient(45deg, #6c757d, #9e9e9e) !important; }

.table-hover tbody tr:hover {
    background-color: rgba(115, 103, 240, 0.04);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}
</style>
</div>