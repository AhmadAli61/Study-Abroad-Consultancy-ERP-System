<div>
<div class="col-12">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <!-- Page Header -->
            <div class="bg-gradient-primary text-white px-4 py-4" style="border-radius: 12px 12px 0 0;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-white fw-bold">
                            <i class="fas fa-users me-2"></i>Team Performance Dashboard
                        </h4>
                        <p class="mb-0 opacity-75">Monitor team performance and inquiry distribution</p>
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
                        $counsellorIds = $team->counsellors->pluck('id')->toArray();
                        $managerId = $team->manager_id;
                        $allUserIds = array_merge($counsellorIds, [$managerId]);

                        // TOTAL INQUIRIES (ALL-TIME)
                        $inquiryCount = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)->count();

                        // MONTHLY COUNTS
                        $currentMonth = now()->month;
                        $currentYear = now()->year;
                        
                        // Monthly inquiries count
                        $monthlyInquiryCount = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)
                            ->whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->count();
                            
                        // Monthly registered count
                        $monthlyRegisteredCount = \App\Models\RegisteredInquiry::whereIn('users_id', $allUserIds)
                            ->whereNull('parent_id')
                            ->whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->count();

                        // Status counts for current month
                        $hot = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)
                            ->where('inquiry_status', 'hot')
                            ->whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->count();
                            
                        $cold = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)
                            ->where('inquiry_status', 'cold')
                            ->whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->count();
                            
                        $dead = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)
                            ->where('inquiry_status', 'dead')
                            ->whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->count();
                            
                        $pending = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)
                            ->where('inquiry_status', 'pending')
                            ->whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->count();
                            
                        $registered = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)
                            ->where('inquiry_status', 'registered')
                            ->whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->count();
                        
                        // Calculate percentages for progress bars
                        $hotPercent = $monthlyInquiryCount > 0 ? ($hot / $monthlyInquiryCount) * 100 : 0;
                        $coldPercent = $monthlyInquiryCount > 0 ? ($cold / $monthlyInquiryCount) * 100 : 0;
                        $deadPercent = $monthlyInquiryCount > 0 ? ($dead / $monthlyInquiryCount) * 100 : 0;
                        $pendingPercent = $monthlyInquiryCount > 0 ? ($pending / $monthlyInquiryCount) * 100 : 0;
                        $registeredPercent = $monthlyInquiryCount > 0 ? ($registered / $monthlyInquiryCount) * 100 : 0;

                        // Calculate conversion rate
                        $conversionRate = $monthlyInquiryCount > 0 ? round(($monthlyRegisteredCount / $monthlyInquiryCount) * 100, 1) : 0;

                        // Get month name for display
                        $monthName = now()->format('F');
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

            <!-- Right: Inquiry Count -->
            <div class="text-end">
                <div class="bg-white px-3 py-2 rounded shadow-sm text-center" style="min-width: 70px;">
                    <h6 class="mb-0 fw-bold text-dark">{{ $inquiryCount }}</h6>
                    <small class="text-muted">Total</small>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body d-flex flex-column py-3 px-3">
            <!-- Counselors Section -->
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-user-friends me-2"></i>Team Members
                    </h6>
                    <span class="badge bg-primary rounded-pill">{{ $team->counsellors->count() + 1 }}</span>
                </div>
                <div class="team-members-container" style="max-height: 100px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 8px; padding: 10px; background: #f8f9fa;">
                    <!-- Manager -->
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 32px; height: 32px;">
                                <i class="fas fa-crown" style="font-size: 12px;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-semibold text-dark" style="font-size: 13px;">
                                {{ $team->manager->username }}
                            </div>
                            <small class="text-muted" style="font-size: 11px;">
                                Manager
                            </small>
                        </div>
                    </div>
                    
                    <!-- Counselors -->
                    @forelse ($team->counsellors as $counsellor)
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 32px; height: 32px;">
                                    <i class="fas fa-user text-muted" style="font-size: 12px;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-semibold text-dark" style="font-size: 13px;">
                                    {{ $counsellor->username }}
                                </div>
                                <small class="text-muted" style="font-size: 11px;">
                                    {{ ucfirst($counsellor->role) }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-2">
                            <i class="fas fa-users text-muted mb-2" style="font-size: 16px;"></i>
                            <p class="text-muted mb-0" style="font-size: 12px;">No counselors assigned</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Monthly Performance -->
            <div class="mb-3">
                <h6 class="fw-bold mb-3 text-center text-dark" style="font-size: 14px;">
                    <i class="fas fa-chart-bar me-2 text-primary"></i>{{ $monthName }} Performance
                </h6>
                <div class="row text-center mb-3">
                    <div class="col-4">
                        <div class="border-end border-light">
                            <div class="fw-bold text-primary" style="font-size: 18px;">{{ $monthlyInquiryCount }}</div>
                            <small class="text-muted" style="font-size: 11px;">Inquiries</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border-end border-light">
                            <div class="fw-bold text-success" style="font-size: 18px;">{{ $monthlyRegisteredCount }}</div>
                            <small class="text-muted" style="font-size: 11px;">Registered</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="fw-bold {{ $conversionRate >= 20 ? 'text-dark' : ($conversionRate >= 10 ? 'text-dark' : 'text-dark') }}" 
                             style="font-size: 18px;">
                            {{ $conversionRate }}%
                        </div>
                        <small class="text-muted" style="font-size: 11px;">Conversion</small>
                    </div>
                </div>
            </div>

            <!-- Status Distribution -->
            <div class="mb-3">
                <h6 class="fw-bold mb-3 text-center text-dark" style="font-size: 14px;">
                    <i class="fas fa-chart-pie me-2 text-primary"></i>Status Distribution
                </h6>
                
                <!-- Status Progress Bars -->
                <div class="status-bars">
                    <!-- Hot -->
                    <div class="status-item mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="status-indicator bg-danger" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                <small class="fw-semibold text-danger" style="font-size: 11px;">HOT</small>
                            </div>
                            <span class="fw-bold text-dark" style="font-size: 12px;">{{ $hot }} <small class="text-muted">({{ round($hotPercent) }}%)</small></span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: rgba(255, 87, 34, 0.1);">
                            <div class="progress-bar bg-danger" style="width: {{ $hotPercent }}%"></div>
                        </div>
                    </div>

                    <!-- Cold -->
                    <div class="status-item mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="status-indicator bg-info" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                <small class="fw-semibold text-info" style="font-size: 11px;">COLD</small>
                            </div>
                            <span class="fw-bold text-dark" style="font-size: 12px;">{{ $cold }} <small class="text-muted">({{ round($coldPercent) }}%)</small></span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: rgba(0, 192, 255, 0.1);">
                            <div class="progress-bar bg-info" style="width: {{ $coldPercent }}%"></div>
                        </div>
                    </div>

                    <!-- Registered -->
                    <div class="status-item mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="status-indicator bg-success" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                <small class="fw-semibold text-success" style="font-size: 11px;">REGISTERED</small>
                            </div>
                            <span class="fw-bold text-dark" style="font-size: 12px;">{{ $registered }} <small class="text-muted">({{ round($registeredPercent) }}%)</small></span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: rgba(40, 167, 69, 0.1);">
                            <div class="progress-bar bg-success" style="width: {{ $registeredPercent }}%"></div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="status-item mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="status-indicator bg-warning" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                <small class="fw-semibold text-warning" style="font-size: 11px;">PENDING</small>
                            </div>
                            <span class="fw-bold text-dark" style="font-size: 12px;">{{ $pending }} <small class="text-muted">({{ round($pendingPercent) }}%)</small></span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: rgba(255, 193, 7, 0.1);">
                            <div class="progress-bar bg-warning" style="width: {{ $pendingPercent }}%"></div>
                        </div>
                    </div>

                    <!-- Dead -->
                    <div class="status-item">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="status-indicator bg-secondary" style="width: 8px; height: 8px; border-radius: 50%; margin-right: 8px;"></div>
                                <small class="fw-semibold text-secondary" style="font-size: 11px;">DEAD</small>
                            </div>
                            <span class="fw-bold text-dark" style="font-size: 12px;">{{ $dead }} <small class="text-muted">({{ round($deadPercent) }}%)</small></span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: rgba(108, 117, 125, 0.1);">
                            <div class="progress-bar bg-secondary" style="width: {{ $deadPercent }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Button -->
        <div class="card-footer bg-white border-0 py-3 rounded-bottom">
            <a href="{{ route('admin.select-counsellor', ['team' => $team->id]) }}" 
               class="btn btn-primary w-100 fw-semibold d-flex align-items-center justify-content-center view-report-btn"
               style="transition: all 0.3s ease; font-size: 14px; padding: 10px 16px; border-radius: 8px;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(115, 103, 240, 0.3)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <i class="fas fa-eye me-2"></i> View Team Inquiries
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

.team-members-container::-webkit-scrollbar {
    width: 4px;
}

.team-members-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.team-members-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.team-members-container::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
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

.status-bars .progress {
    border-radius: 3px;
}

.status-bars .progress-bar {
    border-radius: 3px;
    transition: width 0.8s ease-in-out;
}
</style>
</div>