<div>
<div class="">
    <div class="content-wrapper">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <div class="header-content">
                    <div class="">
                        <div class="title-background">
                            <i class="fas fa-chart-pie"></i>
                            <h2>Daily Report Status</h2>
                        </div>
                    </div>
                    <div class="date-display">
                        <i class="fas fa-calendar-day"></i>
                        <span id="current-date">{{ now()->format('F j, Y') }}</span>
                    </div>
                </div>
            </div>

          <div class="stats-overview">
    <div class="stat-card total-staff">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $activeStaffCount = $submittedUsers->count() + $notSubmittedUsers->count() }}</h3>
            <p>Total Active Staff</p>
        </div>
    </div>
    
    <div class="stat-card submitted">
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $activeSubmittedCount = $submittedUsers->count() }}</h3>
            <p>Submitted</p>
        </div>
    </div>
    
    <div class="stat-card pending">
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $activePendingCount = $notSubmittedUsers->count() }}</h3>
            <p>Pending</p>
        </div>
    </div>
    
    <div class="stat-card completion">
        <div class="stat-icon">
            <i class="fas fa-percentage"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $activeStaffCount > 0 ? round(($activeSubmittedCount / $activeStaffCount) * 100) : 0 }}%</h3>
            <p>Completion Rate</p>
        </div>
    </div>
</div>

            <div class="reports-container">
                <div class="report-section submitted-reports">
                    <div class="section-header">
                        <div class="header-title">
                            <i class="fas fa-check-circle text-white"></i>
                            <h3 class="text-white">Submitted Reports</h3>
                        </div>
                        <div class="count-badge">
                            <span>{{ count($submittedUsers) }}</span>
                        </div>
                    </div>
                    
                    <div class="section-content">
                        @if($submittedUsers->isEmpty())
                            <div class="empty-state">
                                <i class="fas fa-file-export"></i>
                                <p>No reports submitted today</p>
                            </div>
                        @else
                            <div class="users-grid">
                                @foreach($submittedUsers as $user)
                                    <div class="user-card">
                                        <div class="user-avatar submitted">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="user-info">
                                            <a href="{{ route('admin.counsellorreport', ['user' => $user->id]) }}" class="user-name">
                                                {{ $user->username }}
                                            </a>
                                            <div class="user-status">
                                                <span class="status submitted">Submitted</span>
                                            </div>
                                        </div>
                                        <div class="user-action">
                                            <a href="{{ route('admin.counsellorreport', ['user' => $user->id]) }}" class="view-btn">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="report-section pending-reports">
                    <div class="section-header " style="background-color: #ffc107;">
                        <div class="header-title">
                            <i class="fas fa-clock text-dark"></i>
                            <h3 class="">Pending Reports</h3>
                        </div>
                        <div class="count-badge">
                            <span>{{ count($notSubmittedUsers) }}</span>
                        </div>
                    </div>
                    
                    <div class="section-content">
                        @if($notSubmittedUsers->isEmpty())
                            <div class="empty-state">
                                <i class="fas fa-check-double"></i>
                                <p>All reports submitted today!</p>
                            </div>
                        @else
                            <div class="users-grid">
                                @foreach($notSubmittedUsers as $user)
                                    <div class="user-card">
                                        <div class="user-avatar pending">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="user-info">
                                            <a href="{{ route('admin.counsellorreport', ['user' => $user->id]) }}" class="user-name">
                                                {{ $user->username }}
                                            </a>
                                            <div class="user-status">
                                                <span class="status pending">Pending</span>
                                            </div>
                                        </div>
                                        <div class="user-action">
                                            <a href="{{ route('admin.counsellorreport', ['user' => $user->id]) }}" class="view-btn">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.main-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
    min-height: 100vh;
    padding: 20px;
}

.content-wrapper {
    max-width: 1400px;
    margin: 0 auto;
}

.dashboard-container {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.dashboard-header {
    background: linear-gradient(135deg, #7367F0 0%, #dddbfc 500%);
    padding: 25px 30px;
    position: relative;
    overflow: hidden;
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transform: translate(30%, -30%);
}

.dashboard-header::after {
    content: '';
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 150px;
    height: 150px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 1;
}



.title-background {
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.title-background i {
    font-size: 35px;
    color: white;
}

.title-background h2 {
    margin: 0;
    color: white;
    font-weight: 600;
    font-size: 24px;
}

.date-display {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.2);
    padding: 10px 18px;
    border-radius: 10px;
    color: white;
    font-weight: 500;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 24px;
    margin: 30px;
}

.stat-card {
    background: white;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
}

.stat-icon {
    width: 65px;
    height: 65px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.total-staff .stat-icon {
    background: linear-gradient(135deg, #7367F0 50%, #e4e3f7 100%);
}

.submitted .stat-icon {
    background: linear-gradient(135deg, #28C76F 50%, #cbfde2 100%);
}

.pending .stat-icon {
    background: linear-gradient(135deg, #FFC107 50%, #f8ebc5 100%);
}

.completion .stat-icon {
    background: linear-gradient(135deg, #00CFE8 50%, #d2f9fd 100%);
}

.stat-info h3 {
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    color: #2d3748;
}

.stat-info p {
    margin: 4px 0 0;
    color: #718096;
    font-weight: 500;
    font-size: 15px;
}

.reports-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin: 0 30px 30px;
}

.report-section {
    background: white;
    border-radius: 14px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid #f0f0f0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.report-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #e2e8f0;
    background: #28C76F;
}

.header-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.header-title i {
    font-size: 22px;
}

.submitted-reports .header-title i {
    color: #28C76F;
}

.pending-reports .header-title i {
    color: #FFC107;
}

.header-title h3 {
    margin: 0;
    color: #2d3748;
    font-weight: 600;
    font-size: 18px;
}

.count-badge {
    background: white;
    border-radius: 20px;
    padding: 6px 16px;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
}

.submitted-reports .count-badge {
    color: #28C76F;
    background: #ecfdf5;
}

.pending-reports .count-badge {
    color: #FFC107;
    background: #fffbeb;
}

.section-content {
    padding: 24px;
    min-height: 320px;
    max-height: 500px;
    overflow-y: auto;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 220px;
    color: #a0aec0;
}

.empty-state i {
    font-size: 52px;
    margin-bottom: 16px;
    opacity: 0.7;
}

.empty-state p {
    margin: 0;
    font-size: 16px;
    font-weight: 500;
}

.users-grid {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.user-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px;
    border-radius: 12px;
    transition: all 0.2s ease;
    border: 1px solid #f1f5f9;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

.user-card:hover {
    background: #f8fafc;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.user-avatar.submitted {
    background: linear-gradient(135deg, #28C76F 0%, #28C76F 100%);
}

.user-avatar.pending {
    background: linear-gradient(135deg, #FFC107 0%, #FFC107 100%);
    color: black;
}

.user-info {
    flex: 1;
}

.user-name {
    font-weight: 600;
    color: #2d3748;
    text-decoration: none;
    display: block;
    margin-bottom: 6px;
    transition: color 0.2s ease;
    font-size: 16px;
}

.user-name:hover {
    color: #4361ee;
}

.user-status .status {
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 12px;
    font-weight: 600;
    display: inline-block;
}

.status.submitted {
    background: #d1fae5;
    color: #065f46;
}

.status.pending {
    background: #fef3c7;
    color: #92400e;
}

.user-action .view-btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: #edf2f7;
    color: #4a5568;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.user-action .view-btn:hover {
    background: #4361ee;
    color: white;
    transform: scale(1.05);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .reports-container {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .stats-overview {
        grid-template-columns: repeat(2, 1fr);
        margin: 20px;
    }
    
    .header-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .reports-container {
        margin: 0 20px 20px;
        gap: 20px;
    }
    
    .dashboard-header {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .stats-overview {
        grid-template-columns: 1fr;
    }
    
    .main-container {
        padding: 10px;
    }
    

    
    .title-background h2 {
        font-size: 20px;
    }
    
    .stat-card {
        padding: 20px;
    }
}
</style>
</div>
<script>
// Simple script to update the date display
document.addEventListener('DOMContentLoaded', function() {
    const dateElement = document.getElementById('current-date');
    if (dateElement) {
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        dateElement.textContent = now.toLocaleDateString('en-US', options);
    }
});
</script>