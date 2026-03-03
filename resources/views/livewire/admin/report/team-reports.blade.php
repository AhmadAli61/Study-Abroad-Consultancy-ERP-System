<div><div class="container-fluid p-0">
    <div class="card border-0 shadow-sm">
        <!-- Enhanced Header -->
        <div class="card-header bg-gradient-primary text-white py-4" style="border-radius: 12px 12px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1 text-white fw-bold">
                        <i class="fas fa-users me-2"></i>{{ $team->name }} - Team Performance Report
                    </h3>
                    <p class="mb-0 opacity-75">
                        <i class="fas fa-calendar me-1"></i>
                        {{ now()->startOfMonth()->format('M d') }} - {{ now()->format('M d, Y') }} 
                        ({{ now()->format('F') }} Performance)
                    </p>
                </div>
                <div class="text-end">
                    <div class="bg-white bg-opacity-20 px-3 py-2 rounded">
                        <h5 class="mb-0 text-dark">{{ count($team->counsellors) + 1 }}</h5>
                        <small class="opacity-75 text-dark">Team Members</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Overview Cards -->
<div class="bg-white p-4">
    <div class="row g-3">
        <!-- Manager Overview -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-manager rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 45px; height: 45px; background-color: #0d6efd;">
                            <i class="fas fa-user-tie text-white fs-5"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">{{ $team->manager->username }}</h5>
                            <small class="text-muted">Team Manager</small>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="fw-bold text-primary fs-5">{{ $team->manager->monthly_inquiries ?? 0 }}</div>
                            <small class="text-muted">Inquiries</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-success fs-5">{{ $team->manager->monthly_registrations ?? 0 }}</div>
                            <small class="text-muted">Registered</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-dark fs-5">{{ $team->manager->monthly_conversion ?? 0 }}%</div>
                            <small class="text-muted">Conversion</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Performance -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-performance rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 45px; height: 45px; background-color: #7367F0;">
                            <i class="fas fa-chart-line text-white fs-5"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">Team Performance</h6>
                    </div>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="fw-bold text-primary fs-5">{{ $this->getTeamTotalInquiries($team) }}</div>
                            <small class="text-muted">Total Inquiries</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-success fs-5">{{ $this->getTeamConversionRate($team) }}%</div>
                            <small class="text-muted">Conversion</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-dark fs-5">{{ $this->getTeamAveragePerformance($team) }}%</div>
                            <small class="text-muted">Avg Score</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Activity -->
        <div class="col-lg-4 col-md-12">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-activity rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 45px; height: 45px; background-color: #00CFE8;">
                            <i class="fas fa-calendar-alt text-white fs-5"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">Monthly Activity</h6>
                    </div>
                    <div class="row text-center">
                        <div class="col-3">
                            <div class="fw-bold text-dark fs-5">{{ $this->getTeamMonthlyCalls($team) }}</div>
                            <small class="text-muted">Calls</small>
                        </div>
                        <div class="col-3">
                            <div class="fw-bold text-dark fs-5">{{ $this->getTeamActiveLeads($team) }}</div>
                            <small class="text-muted">Active</small>
                        </div>
                        <div class="col-3">
                            <div class="fw-bold text-success fs-5">{{ $this->getTeamTotalRegistrations($team) }}</div>
                            <small class="text-muted">Registered</small>
                        </div>
                        <div class="col-3">
                            <div class="fw-bold text-info fs-5">{{ $this->getTeamCompletionRate($team) }}%</div>
                            <small class="text-muted">Complete</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Performance Table -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="border-collapse: collapse;">
                   <thead class="table-light small">
    <tr class="text-secondary" style="font-size: 0.78rem;">
        <th class="ps-4 fw-semibold" style="width: 15%; border: 1px solid #dee2e6;">
            <i class="fas fa-user fa-sm me-1 text-dark"></i>Member
        </th>
        <th class="text-center fw-semibold" style="width: 10%; border: 1px solid #dee2e6;">
            <i class="fas fa-chart-line fa-sm me-1 text-dark"></i>Perf.
        </th>
        <th class="text-center fw-semibold" style="width: 15%; border: 1px solid #dee2e6;">
            <i class="fas fa-phone-alt fa-sm me-1 text-dark"></i>Calls
        </th>
        <th class="text-center fw-semibold" style="width: 15%; border: 1px solid #dee2e6;">
            <i class="fas fa-tasks fa-sm me-1 text-dark"></i>Status
        </th>
        <th class="text-center fw-semibold" style="width: 15%; border: 1px solid #dee2e6;">
            <i class="fas fa-chart-bar fa-sm me-1 text-dark"></i>Progress
        </th>
        <th class="text-center fw-semibold" style="width: 12%; border: 1px solid #dee2e6;">
            <i class="fas fa-calendar-day fa-sm me-1 text-dark"></i>Today
        </th>
        <th class="text-center fw-semibold" style="width: 15%; border: 1px solid #dee2e6;">
            <i class="fas fa-cogs fa-sm me-1 text-dark"></i>Action
        </th>
    </tr>
</thead>

                    <tbody>
                        <!-- Manager Row -->
                        <tr class="manager-row">
                            <td class="ps-4" style="border: 1px solid #dee2e6;">
    <div class="d-flex align-items-center">
        <div class="avatar-manager-sm rounded-circle d-flex align-items-center justify-content-center me-3">
            <i class="fas fa-user-tie text-white fs-6"></i>
        </div>
        <div>
            <h6 class="mb-0 fw-bold text-dark">{{ $team->manager->username }}</h6>
            <small class="text-muted">Manager</small>
            <div class="mt-1">
                <span class="badge rounded-pill" 
                      style="background-color: #e6f4ea; color: #198754; font-size: 11px; padding: 4px 8px; font-weight: 500;">
                      Team Lead
                </span>
            </div>
        </div>
    </div>
</td>

                            
                            <!-- Performance Score -->
                            <td class="text-center" style="border: 1px solid #dee2e6;">
                                <div class="performance-widget">
                                    <div class="circular-progress" data-score="{{ $this->calculateUserPerformance($team->manager) }}">
                                        <span class="progress-value fw-bold">{{ $this->calculateUserPerformance($team->manager) }}%</span>
                                    </div>
                                    <small class="text-muted d-block mt-1">Performance</small>
                                </div>
                            </td>
                            
                            <!-- Call Analytics -->
                           <td style="border: 1px solid #dee2e6;">
    <div class="call-analytics">
        <div class="analytics-row">
            <small class="text-muted">Dialed:</small>
            <span class="fw-bold text-dark">{{ $team->manager->monthly_dialed_calls ?? 0 }}</span>
        </div>
        <hr class="analytics-separator">

        <div class="analytics-row">
            <small class="text-muted">Connected:</small>
            <span class="fw-bold text-dark">{{ $team->manager->monthly_connected_calls ?? 0 }}</span>
        </div>
        <hr class="analytics-separator">

        <div class="analytics-row">
            <small class="text-muted">Inbound:</small>
            <span class="fw-bold text-dark">{{ $team->manager->monthly_inbound_calls ?? 0 }}</span>
        </div>
        <hr class="analytics-separator">

        <div class="analytics-row">
            <small class="text-muted">Connection:</small>
            <span class="fw-bold text-dark {{ $this->getConnectionRateColor($team->manager) }}">
                {{ $this->getConnectionRate($team->manager) }}%
            </span>
        </div>
    </div>
</td>

                            
                            <!-- Lead Status -->
                            <td style="vertical-align: middle; border: 1px solid #dee2e6;">
                                <div class="lead-status-grid text-center">
                                    <!-- Hot Leads -->
                                    <div class="lead-item mb-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="lead-indicator bg-danger" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">HOT</small>
                                            </div>
                                            <span style="font-weight: 700; color: #e74c3c; font-size: 0.8rem;">{{ $team->manager->hot_leads ?? 0 }}</span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; background: rgba(231, 76, 60, 0.2);">
                                            @php
                                                $totalLeads = ($team->manager->hot_leads ?? 0) + ($team->manager->cold_leads ?? 0) + 
                                                             ($team->manager->dead_leads ?? 0) + ($team->manager->pending_leads ?? 0);
                                                $hotPercentage = $totalLeads > 0 ? (($team->manager->hot_leads ?? 0) / $totalLeads * 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-danger" style="width: {{ $hotPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Cold Leads -->
                                    <div class="lead-item mb-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="lead-indicator bg-info" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">COLD</small>
                                            </div>
                                            <span style="font-weight: 700; color: #3498db; font-size: 0.8rem;">{{ $team->manager->cold_leads ?? 0 }}</span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; background: rgba(52, 152, 219, 0.2);">
                                            @php
                                                $coldPercentage = $totalLeads > 0 ? (($team->manager->cold_leads ?? 0) / $totalLeads * 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-info" style="width: {{ $coldPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Pending Leads -->
                                    <div class="lead-item mb-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="lead-indicator bg-warning" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">PENDING</small>
                                            </div>
                                            <span style="font-weight: 700; color: #FFC107; font-size: 0.8rem;">{{ $team->manager->pending_leads ?? 0 }}</span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; background: rgba(255, 193, 7, 0.2);">
                                            @php
                                                $pendingPercentage = $totalLeads > 0 ? (($team->manager->pending_leads ?? 0) / $totalLeads * 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-warning" style="width: {{ $pendingPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Dead Leads -->
                                    <div class="lead-item">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="lead-indicator bg-secondary" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">DEAD</small>
                                            </div>
                                            <span style="font-weight: 700; color: #95a5a6; font-size: 0.8rem;">{{ $team->manager->dead_leads ?? 0 }}</span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; background: rgba(149, 165, 166, 0.2);">
                                            @php
                                                $deadPercentage = $totalLeads > 0 ? (($team->manager->dead_leads ?? 0) / $totalLeads * 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-secondary" style="width: {{ $deadPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Total Summary -->
                                    <div class="mt-2 pt-2" style="border-top: 1px dashed #e0e0e0;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small style="font-size: 0.7rem; font-weight: 700; color: #2c3e50;">TOTAL</small>
                                            <span style="font-weight: 800; color: #2c3e50; font-size: 0.85rem;">{{ $totalLeads }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Monthly Progress -->
                            <td style="border: 1px solid #dee2e6;">
                                <div class="monthly-progress text-center">
                                    <div class="mb-1">
                                        <small class="text-muted d-inline-block" style="width: 110px;">Inquiries:</small>
                                        <span class="fw-bold">{{ $team->manager->monthly_inquiries ?? 0 }}</span>
                                    </div>

                                    <div class="mb-1">
                                        <small class="text-muted d-inline-block" style="width: 110px;">Registered:</small>
                                        <span class="fw-bold text-success">{{ $team->manager->monthly_registrations ?? 0 }}</span>
                                    </div>

                                    <div class="progress mt-2" style="height: 6px;">
                                        <div class="progress-bar bg-success"
                                             style="width: {{ $team->manager->monthly_conversion ?? 0 }}%">
                                        </div>
                                    </div>
                                    <div class="">
                                      <small class="text-muted text-center d-block"> Conversion: {{ $team->manager->monthly_conversion ?? 0 }}% </small>
                                    </div>
                                </div>
                            </td>

                            <!-- Today's Activity -->
                            <td class="text-center" style="border: 1px solid #dee2e6;">
                                <div class="today-activity">
                                    <div class="fw-bold text-primary fs-5">{{ $team->manager->today_inquiries ?? 0 }}</div>
                                    <small class="text-muted d-block">Inquiries</small>
                                    <div class="mt-1">
                                        <span class="badge bg-success">{{ $team->manager->today_registrations ?? 0 }} Registered</span>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Actions -->
                            <td class="text-center" style="border: 1px solid #dee2e6;">
                                <a href="{{ route('admin.counsellorreport', $team->manager->id) }}" 
                                   class="btn btn-sm btn-outline-primary d-inline-flex align-items-center">
                                    <i class="fas fa-chart-line me-1"></i> View Details
                                </a>
                                <div class="mt-1">
                                    <small class="text-muted">Last active: {{ $this->getLastActive($team->manager) }}</small>
                                </div>
                            </td>
                        </tr>

                        <!-- Counselor Rows -->
                        @foreach ($team->counsellors as $counsellor)
                        <tr>
                            <td class="ps-4" style="border: 1px solid #dee2e6;">
    <div class="d-flex align-items-center">
        <div class="avatar-counsellor-sm rounded-circle d-flex align-items-center justify-content-center me-3">
            <i class="fas fa-user text-white fs-6"></i>
        </div>
        <div>
            <h6 class="mb-0 fw-bold text-dark">{{ $counsellor->username }}</h6>
            <small class="text-muted">Counselor</small>
            <div class="mt-1">
                <span class="badge rounded-pill"
                      style="background-color: #e8f0fe; color: #7367F0; font-size: 11px; padding: 4px 8px; font-weight: 500;">
                      Team Member
                </span>
            </div>
        </div>
    </div>
</td>

                            
                            <!-- Performance Score -->
                            <td class="text-center" style="border: 1px solid #dee2e6;">
                                <div class="performance-widget">
                                    <div class="circular-progress" data-score="{{ $this->calculateUserPerformance($counsellor) }}">
                                        <span class="progress-value fw-bold">{{ $this->calculateUserPerformance($counsellor) }}%</span>
                                    </div>
                                    <small class="text-muted d-block mt-1">Performance</small>
                                </div>
                            </td>
                            
                            <!-- Call Analytics -->
                           <td style="border: 1px solid #dee2e6;">
    <div class="call-analytics">
        <div class="analytics-row">
            <small class="text-muted">Dialed:</small>
            <span class="fw-bold text-dark">{{ $counsellor->monthly_dialed_calls ?? 0 }}</span>
        </div>
        <hr class="analytics-separator">

        <div class="analytics-row">
            <small class="text-muted">Connected:</small>
            <span class="fw-bold text-dark">{{ $counsellor->monthly_connected_calls ?? 0 }}</span>
        </div>
        <hr class="analytics-separator">

        <div class="analytics-row">
            <small class="text-muted">Inbound:</small>
            <span class="fw-bold text-dark">{{ $counsellor->monthly_inbound_calls ?? 0 }}</span>
        </div>
        <hr class="analytics-separator">

        <div class="analytics-row">
            <small class="text-muted">Connection:</small>
            <span class="fw-bold text-dark {{ $this->getConnectionRateColor($counsellor) }}">
                {{ $this->getConnectionRate($counsellor) }}%
            </span>
        </div>
    </div>
</td>


                            <!-- Lead Status -->
                            <td style="vertical-align: middle; border: 1px solid #dee2e6;">
                                <div class="lead-status-grid text-center">
                                    <!-- Hot Leads -->
                                    <div class="lead-item mb-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="lead-indicator bg-danger" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">HOT</small>
                                            </div>
                                            <span style="font-weight: 700; color: #e74c3c; font-size: 0.8rem;">{{ $counsellor->hot_leads ?? 0 }}</span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; background: rgba(231, 76, 60, 0.2);">
                                            @php
                                                $counsellorTotalLeads = ($counsellor->hot_leads ?? 0) + ($counsellor->cold_leads ?? 0) + 
                                                                       ($counsellor->dead_leads ?? 0) + ($counsellor->pending_leads ?? 0);
                                                $counsellorHotPercentage = $counsellorTotalLeads > 0 ? (($counsellor->hot_leads ?? 0) / $counsellorTotalLeads * 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-danger" style="width: {{ $counsellorHotPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Cold Leads -->
                                    <div class="lead-item mb-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="lead-indicator bg-info" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">COLD</small>
                                            </div>
                                            <span style="font-weight: 700; color: #3498db; font-size: 0.8rem;">{{ $counsellor->cold_leads ?? 0 }}</span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; background: rgba(52, 152, 219, 0.2);">
                                            @php
                                                $counsellorColdPercentage = $counsellorTotalLeads > 0 ? (($counsellor->cold_leads ?? 0) / $counsellorTotalLeads * 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-info" style="width: {{ $counsellorColdPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Pending Leads -->
                                    <div class="lead-item mb-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="lead-indicator bg-warning" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">PENDING</small>
                                            </div>
                                            <span style="font-weight: 700; color: #FFC107; font-size: 0.8rem;">{{ $counsellor->pending_leads ?? 0 }}</span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; background: rgba(255, 193, 7, 0.2);">
                                            @php
                                                $counsellorPendingPercentage = $counsellorTotalLeads > 0 ? (($counsellor->pending_leads ?? 0) / $counsellorTotalLeads * 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-warning" style="width: {{ $counsellorPendingPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Dead Leads -->
                                    <div class="lead-item">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="lead-indicator bg-secondary" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">DEAD</small>
                                            </div>
                                            <span style="font-weight: 700; color: #95a5a6; font-size: 0.8rem;">{{ $counsellor->dead_leads ?? 0 }}</span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; background: rgba(149, 165, 166, 0.2);">
                                            @php
                                                $counsellorDeadPercentage = $counsellorTotalLeads > 0 ? (($counsellor->dead_leads ?? 0) / $counsellorTotalLeads * 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-secondary" style="width: {{ $counsellorDeadPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Total Summary -->
                                    <div class="mt-2 pt-2" style="border-top: 1px dashed #e0e0e0;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small style="font-size: 0.7rem; font-weight: 700; color: #2c3e50;">TOTAL</small>
                                            <span style="font-weight: 800; color: #2c3e50; font-size: 0.85rem;">{{ $counsellorTotalLeads }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Monthly Progress -->
                            <td style="border: 1px solid #dee2e6;">
                                <div class="monthly-progress text-center">
                                    <div class="mb-1">
                                        <small class="text-muted d-inline-block" style="width: 110px;">Inquiries:</small>
                                        <span class="fw-bold">{{ $counsellor->monthly_inquiries ?? 0 }}</span>
                                    </div>

                                    <div class="mb-1">
                                        <small class="text-muted d-inline-block" style="width: 110px;">Registered:</small>
                                        <span class="fw-bold text-success">{{ $counsellor->monthly_registrations ?? 0 }}</span>
                                    </div>

                                    <div class="progress mt-2" style="height: 6px;">
                                        <div class="progress-bar bg-success"
                                             style="width: {{ $counsellor->monthly_conversion ?? 0 }}%">
                                        </div>
                                    </div>
                                    <small class="text-muted text-center d-block"> Conversion: {{ $counsellor->monthly_conversion ?? 0 }}% </small>
                                </div>
                            </td>

                            <!-- Today's Activity -->
                            <td class="text-center" style="border: 1px solid #dee2e6;">
                                <div class="today-activity">
                                    <div class="fw-bold text-primary fs-5">{{ $counsellor->today_inquiries ?? 0 }}</div>
                                    <small class="text-muted d-block">Inquiries</small>
                                    <div class="mt-1">
                                        <span class="badge bg-success">{{ $counsellor->today_registrations ?? 0 }} Registered</span>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Actions -->
                            <td class="text-center" style="border: 1px solid #dee2e6;">
                                <a href="{{ route('admin.counsellorreport', $counsellor->id) }}" 
                                   class="btn btn-sm btn-outline-primary d-inline-flex align-items-center">
                                    <i class="fas fa-chart-line me-1"></i> View Details
                                </a>
                                <div class="mt-1">
                                    <small class="text-muted">Last active: {{ $this->getLastActive($counsellor) }}</small>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.manager-row {
    background-color: rgba(40, 167, 69, 0.03) !important;
    border-left: 4px solid #28a745;
}

.avatar-manager {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #28a745, #20c997);
}

.avatar-manager-sm {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #28a745, #20c997);
}

.avatar-counsellor-sm {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #7367F0, #9e95f5);
}
/* Fix Call Analytics Alignment */
.call-analytics {
    font-size: 12px;
    display: flex;
    flex-direction: column;
    gap: 4px;
    text-align: left; /* Ensures text alignment */
    padding: 4px 8px;
}

.analytics-row {
    display: flex;
    justify-content: space-between; /* Label left, number right */
    align-items: center;
    width: 100%;
}

.analytics-separator {
    border: none;
    border-bottom: 1px solid #e9ecef;
    margin: 2px 0;
}


.performance-widget {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.circular-progress {
    position: relative;
    height: 50px;
    width: 50px;
    border-radius: 50%;
    background: conic-gradient(#7367F0 calc(var(--score) * 3.6deg), #f0f0f0 0deg);
    display: flex;
    align-items: center;
    justify-content: center;
}

.circular-progress::before {
    content: "";
    position: absolute;
    height: 40px;
    width: 40px;
    border-radius: 50%;
    background-color: #fff;
}

.progress-value {
    position: relative;
    font-size: 12px;
    color: #7367F0;
}

.circular-progress.high-performance {
    background: conic-gradient(#28a745 calc(var(--score) * 3.6deg), #f0f0f0 0deg);
}

.circular-progress.medium-performance {
    background: conic-gradient(#ffc107 calc(var(--score) * 3.6deg), #f0f0f0 0deg);
}

.circular-progress.low-performance {
    background: conic-gradient(#dc3545 calc(var(--score) * 3.6deg), #f0f0f0 0deg);
}

.call-analytics {
    font-size: 12px;
}

.lead-status {
    font-size: 11px;
}

.monthly-progress {
    font-size: 12px;
}

.today-activity {
    font-size: 13px;
}

.table th {
    border-top: none;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.table td {
    vertical-align: middle;
    padding: 12px 8px;
}

.card {
    border-radius: 12px;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 0%, #9e95f5 100%) !important;
}

.connection-high { color: #28a745; }
.connection-medium { color: #ffc107; }
.connection-low { color: #dc3545; }

/* Grid lines for table */
.table {
    border: 1px solid #dee2e6;
}

.table th, .table td {
    border: 1px solid #dee2e6;
}

/* Center all content except Team Member column */
.table td:not(:first-child) {
    text-align: center;
}

.table th:not(:first-child) {
    text-align: center;
}

/* Ensure content in cells is centered */
.call-analytics, .lead-status-grid, .monthly-progress, .today-activity {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* Ensure progress bars are centered */
.progress {
    margin: 0 auto;
}

/* Center the lead status items */
.lead-item {
    width: 100%;
}
</style>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const circularProgresses = document.querySelectorAll('.circular-progress');
    
    circularProgresses.forEach(progress => {
        const score = progress.getAttribute('data-score');
        progress.style.setProperty('--score', score);
        
        // Add performance level class
        if (score >= 80) {
            progress.classList.add('high-performance');
            progress.querySelector('.progress-value').style.color = '#28a745';
        } else if (score >= 60) {
            progress.classList.add('medium-performance');
            progress.querySelector('.progress-value').style.color = '#ffc107';
        } else {
            progress.classList.add('low-performance');
            progress.querySelector('.progress-value').style.color = '#dc3545';
        }
    });
});
</script>