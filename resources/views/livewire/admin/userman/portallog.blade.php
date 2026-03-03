<div>
<div class="portal-logs">
  <!-- Portal Logs Main Card -->
<div class="card border-0 shadow-lg">
    <!-- Card Header -->
    <div class="card-header bg-gradient-primary text-white py-4" style="border-radius: 12px 12px 0 0 !important;">
        <div class="row align-items-center">
            <!-- Left: Title & Description -->
            <div class="col-md-8">
                <h2 class="mb-2 text-white">
                    <i class="fas fa-history me-2"></i>
                    Portal Logs
                </h2>
                <p class="mb-0 opacity-75">
                    Monitor recent logins, track user sessions, and identify currently active users.
                </p>
            </div>

            <!-- Right: Statistics -->
            <div class="col-md-4 text-end">
                <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block">
                    <h3 class="mb-0 text-dark">{{ $logs->where('is_logged_in', true)->count() }}</h3>
                    <small class="opacity-75 text-dark">Active Now</small>
                </div>
            </div>
        </div>
    </div>

   
</div>


   

    <div class="logs-table">
        <div class="table-header">
            <div class="header-cell">User</div>
            <div class="header-cell">Role</div>
            <div class="header-cell">IP Address</div>
            <div class="header-cell">Device</div>
            <div class="header-cell">Status</div>
            <div class="header-cell">Login Time</div>
        </div>

        <div class="table-body">
            @foreach ($logs as $log)
            <div class="table-row">
                <div class="table-cell">
                    <div class="user-info">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ $log->user->username }}</span>
                    </div>
                </div>
                <div class="table-cell">
                    <div class="role-cell-wrapper">
                        @php
                            $roleDisplay = '';
                            $roleClass = '';
                            
                            switch($log->role) {
                                case 'admin':
                                    $roleDisplay = 'Admin';
                                    $roleClass = 'admin';
                                    break;
                                case 'manager':
                                    $roleDisplay = 'Manager';
                                    $roleClass = 'manager';
                                    break;
                                case 'counsellor':
                                    $roleDisplay = 'Counsellor';
                                    $roleClass = 'counsellor';
                                    break;
                                case 'admission':
                                    $roleDisplay = 'Admission Manager';
                                    $roleClass = 'admission';
                                    break;
                                case 'admissionagent':
                                    $roleDisplay = 'Admission Agent';
                                    $roleClass = 'admissionagent';
                                    break;
                                case 'externalagent':
                                    $roleDisplay = 'External Counsellor';
                                    $roleClass = 'externalagent';
                                    break;
                                default:
                                    $roleDisplay = ucfirst($log->role);
                                    $roleClass = $log->role;
                            }
                        @endphp
                        <span class="role-badge {{ $roleClass }}">
                            {{ $roleDisplay }}
                        </span>
                    </div>
                </div>
                <div class="table-cell">
                    <span class="ip-address">{{ $log->ip_address }}</span>
                </div>
                <div class="table-cell">
                    <span class="device">{{ $log->device }}</span>
                </div>
                <div class="table-cell">
                    @if ($log->is_logged_in)
                        <div class="status active">
                            <span class="status-dot"></span>
                            <span>Active</span>
                        </div>
                    @else
                        <div class="status inactive">
                            <span>Logged Out</span>
                            <small>{{ \Carbon\Carbon::parse($log->logout_time)->format('M d, h:i A') }}</small>
                        </div>
                    @endif
                </div>
                <div class="table-cell">
                    <div class="login-time">
                        <span>{{ \Carbon\Carbon::parse($log->login_time)->format('M d, Y') }}</span>
                        <small>{{ \Carbon\Carbon::parse($log->login_time)->format('h:i A') }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-3 ">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
.portal-logs {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    overflow: hidden;
}

.logs-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    background: linear-gradient(135deg, #7367F0, #7367F0);
    color: white;
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.header-main {
    display: flex;
    align-items: center;
    gap: 12px;
}

.header-main i {
    font-size: 1.5rem;
}

.header-main h2 {
    margin: 0;
    font-weight: 600;
}

.header-stats {
    display: flex;
    gap: 1rem;
}

.stat {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
}

.stat-label {
    font-size: 0.85rem;
    opacity: 0.9;
}





.logs-table {
    width: 100%;
}

.table-header {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    gap: 1rem;
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    font-weight: 600;
    font-size: 0.85rem;
    color: #555;
    border-bottom: 1px solid #eaeaea;
}

.table-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.2s;
}

.table-row:hover {
    background: #f8f9fa;
}

.table-cell {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

/* Role Cell Centering */
.role-cell-wrapper {
    display: flex;
    justify-content: center;
    width: 100%;
}

/* Professional Role Badges */
.role-badge {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.2px;
    text-transform: uppercase;
    white-space: nowrap;
    display: inline-block;
    text-align: center;
    min-width: 60px;
    line-height: 1.2;
    border: none;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}

.role-badge:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
}

.role-badge.admin {
    background: #E74C3C;
    color: white;
}

.role-badge.manager {
    background: #28C76F;
    color: white;
}

.role-badge.counsellor {
    background: #7367F0;
    color: white;
}

.role-badge.admission {
    background: #00CFE8;
    color: white;
}

.role-badge.admissionagent {
    background: #4B4B4B;
    color: white;
}

.role-badge.externalagent {
    background: #FFC107;
    color: #212529;
    font-weight: 700;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 8px;
}

.user-info i {
    color: #667eea;
    font-size: 1.2rem;
}

.ip-address {
    font-family: 'Courier New', monospace;
    color: #555;
    font-size: 0.85rem;
}

.status {
    display: flex;
    align-items: center;
    gap: 6px;
}

.status.active {
    color: #28a745;
    font-weight: 500;
}

.status.inactive {
    display: flex;
    flex-direction: column;
    color: #dc3545;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #28a745;
    animation: pulse 2s infinite;
}

.status small, .login-time small {
    font-size: 0.75rem;
    color: #888;
    margin-top: 2px;
}

.login-time {
    display: flex;
    flex-direction: column;
}



@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

/* Responsive */
@media (max-width: 1024px) {
    .table-header,
    .table-row {
        grid-template-columns: 1fr 1fr 1fr;
        gap: 0.75rem;
    }
    
    .table-header .header-cell:nth-child(4),
    .table-row .table-cell:nth-child(4),
    .table-header .header-cell:nth-child(5),
    .table-row .table-cell:nth-child(5) {
        display: none;
    }
}

@media (max-width: 768px) {
    .logs-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .table-header,
    .table-row {
        grid-template-columns: 1fr 1fr;
    }
    
    .table-header .header-cell:nth-child(3),
    .table-row .table-cell:nth-child(3),
    .table-header .header-cell:nth-child(6),
    .table-row .table-cell:nth-child(6) {
        display: none;
    }
    
    .role-badge {
        font-size: 0.65rem;
        padding: 3px 8px;
        min-width: 50px;
    }
}
</style>
</div>
