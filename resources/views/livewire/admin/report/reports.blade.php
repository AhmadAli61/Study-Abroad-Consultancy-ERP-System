<div>
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <!-- Page Header -->
                <div class="bg-gradient-primary text-white px-4 py-4" style="border-radius: 12px 12px 0 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 text-white fw-bold">
                                <i class="fas fa-users me-2"></i>Team Daily Reports
                            </h4>
                            <p class="mb-0 opacity-75">Monitor team daily and overall reports</p>
                        </div>
                        <div class="text-end">
                            <div class="bg-white bg-opacity-20 px-3 py-2 rounded">
                                <h5 class="mb-0 text-dark">{{ $teams->count() }}</h5>
                                <small class="opacity-75 text-dark">Active Teams</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teams Grid -->
                <div class="row g-3 px-4 py-4">
                    @foreach ($teams as $team)
                        @php
                            $teamStats = $this->getTeamMonthlyStats($team->id);
                            $monthlyProgress = $this->calculateMonthlyProgress($teamStats);
                            $performanceScore = $this->calculatePerformanceScore($teamStats);
                            $performanceLevel = $performanceScore >= 80 ? 'high' : ($performanceScore >= 60 ? 'medium' : 'low');
                        @endphp

                        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100 team-card">

                                <!-- Modern Team Header -->
                                <div class="d-flex justify-content-between align-items-center p-3 rounded-top"
                                     style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                                     
                                    <!-- Left: Team Info -->
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                             style="width: 42px; height: 42px; background-color:  rgba(13,110,253,0.1);">
                                            <i class="fas fa-layer-group text-primary fs-5"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold text-dark text-truncate">
                                                {{ $team->name }}
                                            </h5>
                                            <p class="text-muted mb-0 small d-flex align-items-center">
                                                <i class="fas fa-user-tie me-1 text-secondary"></i> 
                                                <span class="text-truncate">{{ $team->manager->username }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Right: Performance Score -->
                                    <div class="text-end">
                                        <div class="performance-badge {{ $performanceLevel }}-performance text-center" style="min-width: 70px;">
                                            <h6 class="mb-0 fw-bold text-white">{{ $performanceScore }}%</h6>
                                            <small class="text-white opacity-75">Score</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body d-flex flex-column py-3 px-3">
                                    <!-- Monthly Performance -->
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-3 text-center text-dark" style="font-size: 14px;">
                                            <i class="fas fa-chart-bar me-2 text-primary"></i>{{ now()->format('F') }} Performance
                                        </h6>
                                        <div class="row text-center mb-3">
                                            <div class="col-4">
                                                <div class="border-end border-light">
                                                    <div class="fw-bold text-dark" style="font-size: 18px;">{{ $teamStats['inquiries'] }}</div>
                                                    <small class="text-muted" style="font-size: 11px;">Inquiries</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="border-end border-light">
                                                    <div class="fw-bold text-dark" style="font-size: 18px;">{{ $teamStats['registered'] }}</div>
                                                    <small class="text-muted" style="font-size: 11px;">Registered</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="fw-bold text-dark" style="font-size: 18px;">
                                                    {{ $teamStats['conversion_rate'] }}%
                                                </div>
                                                <small class="text-muted" style="font-size: 11px;">Conversion</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Call Analytics -->
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-2 text-center text-dark" style="font-size: 14px;">
                                            <i class="fas fa-phone me-2 text-primary"></i>Call Analytics
                                        </h6>
                                        
                                        <div class="call-stats">
                                            <div class="row text-center mb-2">
                                                <div class="col-4">
                                                    <div class="border-end border-light">
                                                        <div class="fw-bold text-primary" style="font-size: 16px;">{{ $teamStats['dialed_calls'] }}</div>
                                                        <small class="text-muted" style="font-size: 11px;">Dialed</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="border-end border-light">
                                                        <div class="fw-bold text-success" style="font-size: 16px;">{{ $teamStats['connected_calls'] }}</div>
                                                        <small class="text-muted" style="font-size: 11px;">Connected</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="fw-bold text-info" style="font-size: 16px;">
                                                        {{ $teamStats['inbound_calls'] }}
                                                    </div>
                                                    <small class="text-muted" style="font-size: 11px;">Inbound</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Distribution -->
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-2 text-center text-dark" style="font-size: 14px;">
                                            <i class="fas fa-chart-pie me-2 text-primary"></i>Lead Status
                                        </h6>
                                        
                                        <!-- Status Progress Bars - Compact Version -->
                                        <div class="status-bars">
                                            <!-- Hot -->
                                            <div class="status-item mb-2">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-indicator bg-danger" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                                        <small class="fw-semibold text-dark" style="font-size: 11px;">HOT</small>
                                                    </div>
                                                    <span class="fw-bold text-dark" style="font-size: 12px;">{{ $teamStats['hot_leads'] }}</span>
                                                </div>
                                            </div>

                                            <!-- Cold -->
                                            <div class="status-item mb-2">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-indicator bg-info" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                                        <small class="fw-semibold text-dark" style="font-size: 11px;">COLD</small>
                                                    </div>
                                                    <span class="fw-bold text-dark" style="font-size: 12px;">{{ $teamStats['cold_leads'] }}</span>
                                                </div>
                                            </div>

                                            <!-- Pending -->
                                            <div class="status-item mb-2">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-indicator bg-warning" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                                        <small class="fw-semibold text-dark" style="font-size: 11px;">PENDING</small>
                                                    </div>
                                                    <span class="fw-bold text-dark" style="font-size: 12px;">{{ $teamStats['pending_leads'] }}</span>
                                                </div>
                                            </div>

                                            <!-- Dead -->
                                            <div class="status-item">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-indicator bg-secondary" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                                        <small class="fw-semibold text-dark" style="font-size: 11px;">DEAD</small>
                                                    </div>
                                                    <span class="fw-bold text-dark" style="font-size: 12px;">{{ $teamStats['dead_leads'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Monthly Progress -->
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-2 text-center text-dark" style="font-size: 14px;">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Monthly Progress
                                        </h6>
                                        
                                        <div class="progress mb-2" style="height: 8px;">
                                            <div class="progress-bar bg-primary" style="width: {{ $monthlyProgress['days_elapsed_percent'] }}%">
                                                <small class="progress-text">{{ $monthlyProgress['days_elapsed'] }}/{{ $monthlyProgress['total_days'] }} days</small>
                                            </div>
                                        </div>
                                        
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <small class="text-muted" style="font-size: 11px;">
                                                    <i class="fas fa-chart-line me-1 text-primary"></i>
                                                    {{ $monthlyProgress['daily_avg_inquiries'] }}/day
                                                </small>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted" style="font-size: 11px;">
                                                    <i class="fas fa-phone me-1 text-success"></i>
                                                    {{ $monthlyProgress['daily_avg_calls'] }} calls/day
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- View Button -->
                                <div class="card-footer bg-white border-0 py-3 rounded-bottom">
                                    <a href="{{ route('admin.teamreports', ['team' => $team->id]) }}" 
                                       class="btn btn-primary w-100 fw-semibold d-flex align-items-center justify-content-center view-report-btn"
                                       style="transition: all 0.3s ease; font-size: 14px; padding: 10px 16px; border-radius: 8px;"
                                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(115, 103, 240, 0.3)';"
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        <i class="fas fa-chart-line me-2"></i> View Reports
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                @if($teams->count() === 0)
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-users fa-4x text-muted opacity-50"></i>
                        </div>
                        <h5 class="text-muted mb-3">No Teams Available</h5>
                        <p class="text-muted mb-4">Create teams to organize your counselors and track performance</p>
                        <a href="{{ route('admin.teams') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i> Create Your First Team
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
    .team-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
    }

    .view-report-btn {
        background: linear-gradient(45deg, #7367f0, #9e95f5);
        border: none;
        position: relative;
        overflow: hidden;
    }

    .view-report-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .view-report-btn:hover::before {
        left: 100%;
    }

    .performance-badge {
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: bold;
    }

    .high-performance {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .medium-performance {
        background: linear-gradient(135deg, #ffc107, #fd7e14);
    }

    .low-performance {
        background: linear-gradient(135deg, #dc3545, #e83e8c);
    }

    .progress-text {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        font-weight: bold;
        font-size: 10px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .status-bars .progress {
        border-radius: 3px;
    }

    .status-bars .progress-bar {
        border-radius: 3px;
        transition: width 0.8s ease-in-out;
    }
    </style>
</div>