<div>
<div class="col-12">
    <div class="card border-0 shadow-sm">
        <!-- Page Header -->
       <div class="bg-gradient-primary text-white px-4 py-4" style="border-radius: 12px 12px 0 0;">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-1 text-white fw-bold">
                <i class="fas fa-users me-2"></i>{{ $team->name }} - Team Performance
            </h4>
            <div class="d-flex align-items-center flex-wrap gap-3 mt-2">
                <span class="opacity-75 d-flex align-items-center">
                    <i class="fas fa-user-tie me-1"></i> 
                    Manager: <strong class="ms-1">{{ $team->manager->username }}</strong>
                </span>
                <span class="opacity-75 d-flex align-items-center">
                    <i class="fas fa-user-friends me-1"></i> 
                    Team Size: <strong class="ms-1">{{ count($team->counsellors) + 1 }}</strong>
                </span>
            </div>
        </div>
        <div class="text-end">
            <div class="d-flex gap-3">
                <!-- Total Inquiries -->
                <div class="bg-white bg-opacity-20 px-3 py-2 rounded text-center">
                    <h5 class="mb-0 text-dark">{{ $teamStats['total_inquiries'] ?? 0 }}</h5>
                    <small class="opacity-75 text-dark">Total Inquiries</small>
                </div>
                <!-- Total Registrations -->
                <div class="bg-white bg-opacity-20 px-3 py-2 rounded text-center">
                    <h5 class="mb-0 text-dark">{{ $teamStats['total_registrations'] ?? 0 }}</h5>
                    <small class="opacity-75 text-dark">Total Applications</small>
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="card-body border-bottom">
    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light-primary border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-center p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold text-primary mb-1" style="font-size: 28px;">
                                {{ $teamStats['total_inquiries'] ?? 0 }}
                            </div>
                            <small class="text-muted">Total Inquiries</small>
                        </div>
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-layer-group text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light-success border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-center p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold text-success mb-1" style="font-size: 28px;">
                                {{ $teamStats['total_registrations'] ?? 0 }}
                            </div>
                            <small class="text-muted">Total Applications</small>
                        </div>
                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light-info border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-center p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold text-info mb-1" style="font-size: 28px;">
                                {{ $teamStats['overall_conversion_rate'] ?? 0 }}%
                            </div>
                            <small class="text-muted">Overall Conversion Rate</small>
                        </div>
                        <div class="bg-info rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light-warning border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-center p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold text-warning mb-1" style="font-size: 28px;">
                                {{ $teamStats['active_counsellors'] ?? 0 }}
                            </div>
                            <small class="text-muted">Active Counselors</small>
                        </div>
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Team Members Table -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
    <thead class="table-light">
        <tr>
            <th class="ps-4 border-end" style="width: 25%;">
                <i class="fas fa-user me-2 text-primary"></i>Team Member
            </th>
            <th class="text-center border-end" style="width: 15%;">
                <i class="fas fa-chart-line me-2 text-primary"></i>Performance
            </th>
            <th class="text-center border-end" style="width: 15%;">
                <i class="fas fa-user-check me-2 text-primary"></i>Registered
            </th>
            <th class="text-center border-end" style="width: 30%;">
                <i class="fas fa-tasks me-2 text-primary"></i>Inquiry Status
            </th>
            
            <th class="text-center" style="width: 15%;">
                <i class="fas fa-cog me-2 text-primary"></i>Actions
            </th>
        </tr>
    </thead>
    <tbody>
        <!-- Manager Row -->
        <tr class="manager-row">
            <td class="ps-4 border-end">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-md me-3">
                        <div class="avatar-initial bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-crown text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $team->manager->username }}</h6>
                        <small class="text-muted">Team Manager</small>
                    </div>
                </div>
            </td>
            <td class="text-center border-end align-middle">
    <div class="d-flex flex-column align-items-center justify-content-center py-2 px-2">

        <!-- 🔹 Total Inquiries -->
        <div class="w-100 text-center pb-2 mb-2 border-bottom border-2" style="border-color: #e0e0e0;">
            <div class="d-flex align-items-center justify-content-center mb-1">
                <i class="fas fa-layer-group me-2" 
                   style="color: #7367F0; font-size: 16px;"></i>
                <span class="fw-bold text-dark fs-5">
                    {{ $team->manager->inquiries_count ?? 0 }}
                </span>
            </div>
            <small class="text-secondary fw-semibold" style="font-size: 12px; letter-spacing: 0.2px;">
                Total Inquiries
            </small>
        </div>

        <!-- 🔸 Monthly Inquiries -->
        <div class="text-center">
            <div class="d-flex align-items-center justify-content-center mb-1">
                <i class="fas fa-calendar-check me-2" 
                   style="color: #7367F0; font-size: 15px;"></i>
                <span class="fw-semibold text-dark fs-6">
                    {{ $team->manager->monthly_inquiries ?? 0 }}
                </span>
            </div>
            <span class="badge  px-3 py-1 fw-semibold shadow-sm" 
                  style="background: linear-gradient(90deg, #7367F0 70%, #b6b0ff 100%);; color: #fff; font-size: 11px;">
                {{ now()->format('F') }}
            </span>
        </div>

    </div>
</td>

            <td class="text-center border-end align-middle">
    <div class="d-flex flex-column align-items-center justify-content-center py-2 px-2">

        <!-- 🟩 Total Registered -->
        <div class="w-100 text-center pb-2 mb-2 border-bottom border-2" style="border-color: #e0e0e0;">
            <div class="d-flex align-items-center justify-content-center mb-1">
                <i class="fas fa-user-check me-2" 
                   style="color: #28a745; font-size: 16px;"></i>
                <span class="fw-bold text-dark fs-5">
                    {{ $team->manager->registered_count ?? 0 }}
                </span>
            </div>
            <small class="text-secondary fw-semibold" style="font-size: 12px; letter-spacing: 0.2px;">
                Total Registered
            </small>
        </div>

        <!-- 🟦 Monthly Registered -->
        <div class="text-center">
            <div class="d-flex align-items-center justify-content-center mb-1">
                <i class="fas fa-calendar-plus me-2" 
                   style="color: #28a745; font-size: 15px;"></i>
                <span class="fw-semibold text-dark fs-6">
                    {{ $team->manager->monthly_registered ?? 0 }}
                </span>
            </div>
            <span class="badge px-3 py-1 fw-semibold shadow-sm" 
                  style="background: linear-gradient(90deg, #28a745 70%, #99f5ae 100%); color: #fff; font-size: 11px;">
                {{ now()->format('F') }}
            </span>
        </div>

    </div>
</td>

            <td class="border-end">
                <div class="status-bars-small">
                    <!-- Hot -->
                    <div class="d-flex align-items-center mb-1">
                        <div class="status-dot bg-danger me-2"></div>
                        <small class="text-muted me-2" style="width: 60px;">Hot:</small>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-danger" style="width: {{ $team->manager->hot_percent ?? 0 }}%"></div>
                        </div>
                        <small class="text-danger fw-bold ms-2" style="min-width: 20px;">{{ $team->manager->hot_leads ?? 0 }}</small>
                    </div>
                    <!-- Cold -->
                    <div class="d-flex align-items-center mb-1">
                        <div class="status-dot bg-info me-2"></div>
                        <small class="text-muted me-2" style="width: 60px;">Cold:</small>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-info" style="width: {{ $team->manager->cold_percent ?? 0 }}%"></div>
                        </div>
                        <small class="text-info fw-bold ms-2" style="min-width: 20px;">{{ $team->manager->cold_leads ?? 0 }}</small>
                    </div>
                    <!-- Pending -->
                    <div class="d-flex align-items-center mb-1">
                        <div class="status-dot bg-warning me-2"></div>
                        <small class="text-muted me-2" style="width: 60px;">Pending:</small>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: {{ $team->manager->pending_percent ?? 0 }}%"></div>
                        </div>
                        <small class="text-warning fw-bold ms-2" style="min-width: 20px;">{{ $team->manager->pending_leads ?? 0 }}</small>
                    </div>
                    <!-- Dead -->
                    <div class="d-flex align-items-center">
                        <div class="status-dot bg-secondary me-2"></div>
                        <small class="text-muted me-2" style="width: 60px;">Dead:</small>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-secondary" style="width: {{ $team->manager->dead_percent ?? 0 }}%"></div>
                        </div>
                        <small class="text-secondary fw-bold ms-2" style="min-width: 20px;">{{ $team->manager->dead_leads ?? 0 }}</small>
                    </div>
                </div>
            </td>
           
            <td class="text-center">
                <a href="{{ route('admin.inquiries-detail', $team->manager->id) }}" 
                   class="btn btn-primary btn-sm view-inquiries-btn">
                    <i class="fas fa-eye me-1"></i> View
                </a>
            </td>
        </tr>

        <!-- Counselor Rows -->
        @foreach ($team->counsellors as $counsellor)
        <tr class="counsellor-row">
            <td class="ps-4 border-end">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-md me-3">
                        <div class="avatar-initial bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $counsellor->username }}</h6>
                        <small class="text-muted">Counselor</small>
                    </div>
                </div>
            </td>
          <td class="text-center border-end align-middle">
    <div class="d-flex flex-column align-items-center justify-content-center py-2 px-2">

        <!-- 🔹 Total Inquiries -->
        <div class="w-100 text-center pb-2 mb-2 border-bottom border-2" style="border-color: #e0e0e0;">
            <div class="d-flex align-items-center justify-content-center mb-1">
                <i class="fas fa-layer-group me-2" 
                   style="color: #7367F0; font-size: 16px;"></i>
                <span class="fw-bold text-dark fs-5">
                    {{ $counsellor->inquiries_count ?? 0 }}
                </span>
            </div>
            <small class="text-secondary fw-semibold" style="font-size: 12px; letter-spacing: 0.2px;">
                Total Inquiries
            </small>
        </div>

        <!-- 🔸 Monthly Inquiries -->
        <div class="text-center">
            <div class="d-flex align-items-center justify-content-center mb-1">
                <i class="fas fa-calendar-check me-2" 
                   style="color: #7367F0; font-size: 15px;"></i>
                <span class="fw-semibold text-dark fs-6">
                    {{ $counsellor->monthly_inquiries ?? 0 }}
                </span>
            </div>
            <span class="badge px-3 py-1 fw-semibold shadow-sm" 
                  style="background: linear-gradient(90deg, #7367F0 70%, #b6b0ff 100%);; color: #fff; font-size: 11px;">
                {{ now()->format('F') }}
            </span>
        </div>

    </div>
</td>

           <td class="text-center border-end align-middle">
    <div class="d-flex flex-column align-items-center justify-content-center py-2 px-2 mt-2">

        <!-- 🟩 Total Registered -->
        <div class="w-100 text-center pb-2 mb-2 border-bottom border-2" style="border-color: #e0e0e0;">
            <div class="d-flex align-items-center justify-content-center mb-1">
                <i class="fas fa-user-check me-2" 
                   style="color: #28a745; font-size: 16px;"></i>
                <span class="fw-bold text-dark fs-5">
                    {{ $counsellor->registered_count ?? 0 }}
                </span>
            </div>
            <small class="text-secondary fw-semibold" style="font-size: 12px; letter-spacing: 0.2px;">
                Total Registered
            </small>
        </div>

        <!-- 🟦 Monthly Registered -->
        <div class="text-center mb-2">
            <div class="d-flex align-items-center justify-content-center mb-1">
                <i class="fas fa-calendar-plus me-2" 
                   style="color: #28a745; font-size: 15px;"></i>
                <span class="fw-semibold text-dark fs-6">
                    {{ $counsellor->monthly_registered ?? 0 }}
                </span>
            </div>
            <span class="badge px-3 py-1 fw-semibold shadow-sm" 
                  style="background: linear-gradient(90deg, #28a745 70%, #99f5ae 100%); color: #fff; font-size: 11px;">
                {{ now()->format('F') }}
            </span>
        </div>

        <!-- 🟧 Conversion Rate -->
        @if($counsellor->conversion_rate > 0)
        <div class="text-center mt-1">
            <div class="d-flex align-items-center justify-content-center">
                <i class="fas fa-chart-line me-2" 
                   style="color: #28a745; font-size: 14px;"></i>
                <span class="badge 
                    {{ $counsellor->conversion_rate >= 20 ? 'bg-success' : 
                       ($counsellor->conversion_rate >= 10 ? 'bg-warning text-dark' : 'bg-danger') }} 
                    rounded-pill px-3 py-1 fw-semibold shadow-sm" 
                    style="font-size: 10px;">
                    {{ $counsellor->conversion_rate }}% Conv.
                </span>
            </div>
        </div>
        @endif

    </div>
</td>

            <td class="border-end">
                <div class="status-bars-small">
                    <!-- Hot -->
                    <div class="d-flex align-items-center mb-1">
                        <div class="status-dot bg-danger me-2"></div>
                        <small class="text-muted me-2" style="width: 60px;">Hot:</small>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-danger" style="width: {{ $counsellor->hot_percent ?? 0 }}%"></div>
                        </div>
                        <small class="text-danger fw-bold ms-2" style="min-width: 20px;">{{ $counsellor->hot_leads ?? 0 }}</small>
                    </div>
                    <!-- Cold -->
                    <div class="d-flex align-items-center mb-1">
                        <div class="status-dot bg-info me-2"></div>
                        <small class="text-muted me-2" style="width: 60px;">Cold:</small>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-info" style="width: {{ $counsellor->cold_percent ?? 0 }}%"></div>
                        </div>
                        <small class="text-info fw-bold ms-2" style="min-width: 20px;">{{ $counsellor->cold_leads ?? 0 }}</small>
                    </div>
                    <!-- Pending -->
                    <div class="d-flex align-items-center mb-1">
                        <div class="status-dot bg-warning me-2"></div>
                        <small class="text-muted me-2" style="width: 60px;">Pending:</small>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: {{ $counsellor->pending_percent ?? 0 }}%"></div>
                        </div>
                        <small class="text-warning fw-bold ms-2" style="min-width: 20px;">{{ $counsellor->pending_leads ?? 0 }}</small>
                    </div>
                    <!-- Dead -->
                    <div class="d-flex align-items-center">
                        <div class="status-dot bg-secondary me-2"></div>
                        <small class="text-muted me-2" style="width: 60px;">Dead:</small>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-secondary" style="width: {{ $counsellor->dead_percent ?? 0 }}%"></div>
                        </div>
                        <small class="text-secondary fw-bold ms-2" style="min-width: 20px;">{{ $counsellor->dead_leads ?? 0 }}</small>
                    </div>
                </div>
            </td>
           
            <td class="text-center">
                <a href="{{ route('admin.inquiries-detail', $counsellor->id) }}" 
                   class="btn btn-primary btn-sm view-inquiries-btn">
                    <i class="fas fa-eye me-1"></i> View
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>

            <!-- Empty State -->
            @if($team->counsellors->count() === 0)
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-user-friends fa-3x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted mb-3">No Counselors in Team</h5>
                <p class="text-muted mb-4">Add counselors to this team to start tracking their performance</p>
                <a href="{{ route('admin.teams') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Manage Team Members
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.manager-row {
    background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
    border-left: 4px solid #7367f0;
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}
.counsellor-row:hover {
    background-color: #f8f9fa;
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.status-bars-small .progress {
    background-color: #f8f9fa;
    border-radius: 3px;
}

.status-bars-small .progress-bar {
    border-radius: 3px;
    transition: width 0.5s ease;
}

.view-inquiries-btn {
    transition: all 0.3s ease;
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 12px;
}

.view-inquiries-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(115, 103, 240, 0.3);
}

.avatar-initial {
    font-size: 14px;
}

.bg-light-primary { background-color: rgba(115, 103, 240, 0.1) !important; }
.bg-light-success { background-color: rgba(40, 199, 111, 0.1) !important; }
.bg-light-info { background-color: rgba(0, 207, 232, 0.1) !important; }
.bg-light-warning { background-color: rgba(255, 159, 67, 0.1) !important; }
</style>
</div>