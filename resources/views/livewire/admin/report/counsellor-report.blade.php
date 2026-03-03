<div>
<div style=" background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="">
        <!-- Single Main Card -->
        <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            
            <!-- Header Section -->
            <div class="card-header border-0" style="background: linear-gradient(135deg, #7367F0 50%, #cac5fa 100%); padding: 2rem;">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="background: rgba(255,255,255,0.2); padding: 15px; border-radius: 15px;">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-white mb-1" style="font-weight: 800; font-size: 1.8rem;">Performance Dashboard</h2>
                                <p class="text-white mb-0 opacity-75" style="font-size: 1.1rem;">
                                    <i class="fas fa-user-circle me-2"></i>{{ $user->username }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column flex-md-row justify-content-end align-items-stretch align-items-md-center gap-3">
                            <div class="position-relative flex-grow-1" style="max-width: 250px;">
                                <i class="fas fa-calendar position-absolute text-muted" style="left: 15px; top: 50%; transform: translateY(-50%); z-index: 10;"></i>
                                <input 
                                    type="date" 
                                    class="form-control ps-5 py-2 border-0 shadow-sm" 
                                    style="border-radius: 12px; height: 45px;"
                                    wire:model.defer="searchDate"
                                    placeholder="Select date"
                                >
                            </div>
                            <button 
                                wire:click="searchReports"
                                class="btn btn-dark px-4 py-2 d-flex align-items-center gap-2 border-0 shadow-sm"
                                style="border-radius: 12px; height: 45px; background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);"
                            >
                                <i class="fas fa-search"></i>
                                <span>Search</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Body - Contains all content -->
            <div class="card-body p-4">
                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #3498db;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">TOTAL INQUIRIES</h6>
                                        <h3 class="mb-0" style="font-weight: 800; color: #2c3e50;">
                                            {{ $reports->sum('total_inquiries_received') }}
                                        </h3>
                                    </div>
                                    <div style="background: rgba(52, 152, 219, 0.1); padding: 10px; border-radius: 12px;">
                                        <i class="fas fa-list-alt fa-lg" style="color: #3498db;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #27ae60;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">TOTAL CALLS</h6>
                                        <h3 class="mb-0" style="font-weight: 800; color: #2c3e50;">
                                            {{ $reports->sum('inbound_calls') + $reports->sum('dial_calls') }}
                                        </h3>
                                    </div>
                                    <div style="background: rgba(39, 174, 96, 0.1); padding: 10px; border-radius: 12px;">
                                        <i class="fas fa-phone-alt fa-lg" style="color: #27ae60;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #9b59b6;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">INTERESTED FOLLOWUP</h6>
                                        <h3 class="mb-0" style="font-weight: 800; color: #2c3e50;">
                                            {{ $reports->sum('interested_followups') }}
                                        </h3>
                                    </div>
                                    <div style="background: rgba(155, 89, 182, 0.1); padding: 10px; border-radius: 12px;">
                                        <i class="fas fa-user-check fa-lg" style="color: #9b59b6;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #e67e22;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">ACTIVE LEADS</h6>
                                        <h3 class="mb-0" style="font-weight: 800; color: #2c3e50;">
                                            {{ $reports->sum('hot_leads') + $reports->sum('pending_leads') }}
                                        </h3>
                                    </div>
                                    <div style="background: rgba(230, 126, 34, 0.1); padding: 10px; border-radius: 12px;">
                                        <i class="fas fa-fire fa-lg" style="color: #e67e22;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Section -->
                <div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <!-- Table Header -->
            <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #7367F0 0%, #7367F0 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0" style="font-weight: 700; color: #fcfcfd;">
                        <i class="fas fa-chart-line me-2"></i>Daily Performance Reports
                    </h4>
                    <span class="badge bg-primary px-3 py-2" style="font-size: 0.8rem; border-radius: 10px;">
                        {{ $reports->total() }} Records
                    </span>
                </div>
            </div>
            
            <!-- Desktop Table -->
            <div class="card-body p-0 d-none d-lg-block">
                <div class="">
                    <table class="table table-hover mb-0" style="border-collapse: collapse;">
                        <thead style="background: linear-gradient(135deg, #c7c6c6 0%, #c7c6c6 100%);">
                            <tr>
                                <th class="text-dark text-center" style="padding: 15px; font-weight: 600; border: none; vertical-align: middle; font-size: 0.85rem; border-bottom: 2px solid #a5a5a5;">
                                    <i class="fas fa-calendar me-2"></i>Date
                                </th>
                                <th class="text-dark text-center" style="padding: 15px; font-weight: 600; border: none; vertical-align: middle; font-size: 0.85rem; border-bottom: 2px solid #a5a5a5;">
                                    <i class="fas fa-chart-bar me-2"></i>Activity Metrics
                                </th>
                                <th class="text-dark text-center" style="padding: 15px; font-weight: 600; border: none; vertical-align: middle; font-size: 0.85rem; border-bottom: 2px solid #a5a5a5;">
                                    <i class="fas fa-users me-2"></i>Lead Status
                                </th>
                                <th class="text-dark text-center" style="padding: 8px; font-weight: 600; border: none; vertical-align: middle; text-align: center; font-size: 0.85rem; border-bottom: 2px solid #a5a5a5;">
                                    <i class="fas fa-cogs me-2"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr id="report-{{ $report->id }}" style="transition: all 0.3s ease; border-bottom: 1px solid #e0e0e0;">
                                    <!-- Date Column -->
                                    <td style="padding: 15px; vertical-align: middle; border-right: 1px solid #f1f3f4;">
                                        <div class="text-center">
                                            <div style="font-weight: 700; color: #2c3e50; font-size: 0.9rem; margin-bottom: 2px;">{{ $report->date }}</div>
                                            <small class="text-muted" style="font-size: 0.75rem;">
                                                {{ \Carbon\Carbon::parse($report->date)->format('l') }}
                                            </small>
                                        </div>
                                    </td>
                                    
                                    <!-- Activity Metrics Column -->
                                    <td style="padding: 8px; vertical-align: middle; border-right: 1px solid #f1f3f4;">
                                        <div class="compact-metrics">
                                            <!-- Main Metrics - Top Row -->
                                            <div class="d-flex justify-content-between text-center" style="gap: 2px; margin-bottom: 4px;">
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->total_inquiries_received }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Inquiries</small>
                                                </div>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->inbound_calls }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Inbound</small>
                                                </div>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->dial_calls }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Dial Calls</small>
                                                </div>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->connect_calls }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Connected</small>
                                                </div>
                                            </div>

                                            <!-- Secondary Metrics - Middle Row -->
                                            <div class="d-flex justify-content-between text-center" style="gap: 2px; margin-bottom: 4px;">
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.8rem; line-height: 1.1;">{{ $report->today_registration ?? 0 }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Today Reg</small>
                                                </div>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.8rem; line-height: 1.1;">{{ $report->expected_registration ?? 0 }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Expected Reg</small>
                                                </div>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.8rem; line-height: 1.1;">{{ $report->total_students ?? 0 }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Total Students</small>
                                                </div>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.8rem; line-height: 1.1;">{{ $report->on_hold_students ?? 0 }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">On Hold</small>
                                                </div>
                                            </div>

                                            <!-- Application Metrics - Bottom Row -->
                                            <div class="d-flex justify-content-between text-center" style="gap: 2px;">
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.8rem; line-height: 1.1;">{{ $report->applications_processed ?? 0 }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Applications</small>
                                                </div>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.8rem; line-height: 1.1;">{{ $report->total_conditional_offers ?? 0 }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Conditional</small>
                                                </div>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.8rem; line-height: 1.1;">{{ $report->total_unconditional_offers ?? 0 }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem;">Unconditional</small>
                                                </div>
                                                <div style="flex: 1; background: rgba(52, 152, 219, 0.1); padding: 2px 0; border-radius: 4px;">
                                                    <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->interested_followups }}</div>
                                                    <small class="text-muted" style="font-size: 0.55rem; font-weight: 600;">Follow-ups</small>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Lead Status Column -->
                                    <td style="padding: 15px; vertical-align: middle; border-right: 1px solid #f1f3f4;">
                                        <div class="lead-status-grid">
                                            <!-- Hot Leads -->
                                            <div class="lead-item mb-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="lead-indicator" style="background: #e74c3c; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                        <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">HOT</small>
                                                    </div>
                                                    <span style="font-weight: 700; color: #e74c3c; font-size: 0.8rem;">{{ $report->hot_leads }}</span>
                                                </div>
                                                <div class="progress mt-1" style="height: 4px; background: rgba(231, 76, 60, 0.2);">
                                                    <div class="progress-bar" style="background: #e74c3c; width: {{ $report->total_leads > 0 ? ($report->hot_leads / $report->total_leads * 100) : 0 }}%"></div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cold Leads -->
                                            <div class="lead-item mb-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="lead-indicator" style="background: #3498db; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                        <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">COLD</small>
                                                    </div>
                                                    <span style="font-weight: 700; color: #3498db; font-size: 0.8rem;">{{ $report->cold_leads }}</span>
                                                </div>
                                                <div class="progress mt-1" style="height: 4px; background: rgba(52, 152, 219, 0.2);">
                                                    <div class="progress-bar" style="background: #3498db; width: {{ $report->total_leads > 0 ? ($report->cold_leads / $report->total_leads * 100) : 0 }}%"></div>
                                                </div>
                                            </div>
                                            
                                            <!-- Dead Leads -->
                                            <div class="lead-item mb-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="lead-indicator" style="background: #95a5a6; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                        <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">DEAD</small>
                                                    </div>
                                                    <span style="font-weight: 700; color: #95a5a6; font-size: 0.8rem;">{{ $report->dead_leads }}</span>
                                                </div>
                                                <div class="progress mt-1" style="height: 4px; background: rgba(149, 165, 166, 0.2);">
                                                    <div class="progress-bar" style="background: #95a5a6; width: {{ $report->total_leads > 0 ? ($report->dead_leads / $report->total_leads * 100) : 0 }}%"></div>
                                                </div>
                                            </div>
                                            
                                            <!-- Pending Leads -->
                                            <div class="lead-item">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="lead-indicator" style="background: #FFC107; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;"></div>
                                                        <small style="font-size: 0.7rem; font-weight: 600; color: #7f8c8d;">PENDING</small>
                                                    </div>
                                                    <span style="font-weight: 700; color: #FFC107; font-size: 0.8rem;">{{ $report->pending_leads }}</span>
                                                </div>
                                                <div class="progress mt-1" style="height: 4px; background: rgba(253, 252, 171, 0.2);">
                                                    <div class="progress-bar" style="background: #FFC107; width: {{ $report->total_leads > 0 ? ($report->pending_leads / $report->total_leads * 100) : 0 }}%"></div>
                                                </div>
                                            </div>
                                            
                                            <!-- Total Summary -->
                                            <div class="mt-2 pt-2" style="border-top: 1px dashed #e0e0e0;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small style="font-size: 0.7rem; font-weight: 700; color: #2c3e50;">TOTAL</small>
                                                    <span style="font-weight: 800; color: #2c3e50; font-size: 0.85rem;">{{ $report->total_leads }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Actions Column -->
                                   <td style="padding: 8px; vertical-align: middle; text-align: center;">
    <button 
        wire:click="$dispatch('viewDetails', { id: {{ $report->id }} })"
        class="btn btn-primary px-2 py-1 d-inline-flex align-items-center gap-1 border-0"
        style="border-radius: 6px; background: linear-gradient(135deg, #7367F0 0%, #7367F0 100%); transition: all 0.3s ease; font-size: 0.7rem; min-width: 80px;"
        onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 2px 8px rgba(52, 152, 219, 0.3)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
    >
        <i class="fas fa-eye" style="font-size: 0.65rem;"></i>
        <span>View</span>
    </button>
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding: 40px 20px; text-align: center; border-bottom: 1px solid #f1f3f4;">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-clipboard-list fa-2x mb-3" style="color: #bdc3c7;"></i>
                                            <h6 style="color: #7f8c8d; font-weight: 600; font-size: 0.9rem;">No Reports Found</h6>
                                            <p class="mb-0" style="font-size: 0.8rem;">No reports available for the selected criteria.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Cards -->
            <div class="d-block d-lg-none">
                @forelse ($reports as $report)
                    <div class="card m-3 border-0 shadow-sm" style="border-radius: 15px; border-left: 4px solid #3498db;">
                        <div class="card-body">
                            <!-- Header -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title mb-1" style="color: #2c3e50; font-weight: 700;">{{ $report->date }}</h5>
                                </div>
                                <button 
                                    wire:click="$dispatch('viewDetails', { id: {{ $report->id }} })"
                                    class="btn btn-sm btn-primary d-flex align-items-center gap-1 border-0"
                                    style="border-radius: 8px; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);"
                                >
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                </button>
                            </div>

                            <!-- Activity Metrics -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Inquiries</small>
                                        <strong style="color: #2c3e50;">{{ $report->total_inquiries_received }}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Inbound Calls</small>
                                        <strong style="color: #2c3e50;">{{ $report->inbound_calls }}</strong>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Dial Calls</small>
                                        <strong style="color: #2c3e50;">{{ $report->dial_calls }}</strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Connect Calls</small>
                                        <strong style="color: #2c3e50;">{{ $report->connect_calls }}</strong>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Follow-ups</small>
                                        <strong style="color: #3498db;">{{ $report->interested_followups }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Lead Status -->
                            <div>
                                <small class="text-muted d-block mb-2" style="font-weight: 600;">Lead Status</small>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <span class="badge w-100 px-2 py-2" style="background: rgba(231, 76, 60, 0.1); color: #c0392b; border: 1px solid rgba(231, 76, 60, 0.3); border-radius: 6px; font-size: 0.75rem;">
                                            <i class="fas fa-fire me-1"></i>Hot: {{ $report->hot_leads }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge w-100 px-2 py-2" style="background: rgba(52, 152, 219, 0.1); color: #2980b9; border: 1px solid rgba(52, 152, 219, 0.3); border-radius: 6px; font-size: 0.75rem;">
                                            <i class="fas fa-snowflake me-1"></i>Cold: {{ $report->cold_leads }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge w-100 px-2 py-2" style="background: rgba(149, 165, 166, 0.1); color: #7f8c8d; border: 1px solid rgba(149, 165, 166, 0.3); border-radius: 6px; font-size: 0.75rem;">
                                            <i class="fas fa-times-circle me-1"></i>Dead: {{ $report->dead_leads }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge w-100 px-2 py-2" style="background: rgba(46, 204, 113, 0.1); color: #27ae60; border: 1px solid rgba(46, 204, 113, 0.3); border-radius: 6px; font-size: 0.75rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>Pending: {{ $report->pending_leads }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-3x mb-3" style="color: #bdc3c7;"></i>
                        <h5 style="color: #7f8c8d; font-weight: 600;">No Reports Found</h5>
                        <p class="text-muted">No reports available for the selected criteria.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($reports->hasPages())
                <div class="card-footer border-0 py-3" style="background: #f8f9fa; border-top: 1px solid #e0e0e0;">
                    <div class="mt-2">
    {{ $reports->links('pagination::bootstrap-5') }}
</div>
                </div>
            @endif
        </div>
    </div>
</div>
            </div> <!-- End of card-body -->
        </div> <!-- End of main card -->
    </div>

    <livewire:agent.modal.view-report-details />
</div>

<style>
    .metric-item {
        padding: 4px 0;
    }
    
    .lead-item {
        padding: 2px 0;
    }
    
    .lead-status-grid {
        max-width: 180px;
        margin: 0 auto;
    }
    
    .progress {
        border-radius: 2px;
    }
    
    .progress-bar {
        border-radius: 2px;
        transition: width 0.6s ease;
    }
    
    .table-responsive {
        border-radius: 0 0 15px 15px;
    }
</style>
</div>