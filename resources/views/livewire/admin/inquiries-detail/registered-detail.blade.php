<div>
<div class="col-12">
    <div class="card border-0 shadow-sm">
        <!-- Page Header -->
        <div class="bg-gradient-primary text-white px-4 py-4" style="border-radius: 12px 12px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 text-white fw-bold">
                        <i class="fas fa-user-check me-2"></i>All Counselors - Registered Students Analysis
                    </h4>
                    <div class="d-flex align-items-center flex-wrap gap-3 mt-2">
                        <span class="opacity-75 d-flex align-items-center">
                            <i class="fas fa-users me-1"></i> 
                            Active Counselors: <strong class="ms-1">{{ $overallStats['total_counsellors'] ?? 0 }}</strong>
                        </span>
                        <span class="opacity-75 d-flex align-items-center">
                            <i class="fas fa-calendar-alt me-1"></i> 
                            Month: <strong class="ms-1">{{ $currentMonth }}</strong>
                        </span>
                    </div>
                </div>
                <div class="text-end">
                    <div class="d-flex gap-3">
                        <!-- Total Registered -->
                        <div class="bg-white bg-opacity-20 px-3 py-2 rounded text-center">
                            <h5 class="mb-0 text-dark">{{ $overallStats['total_registered'] ?? 0 }}</h5>
                            <small class="opacity-75 text-dark">Total Registered</small>
                        </div>
                        <!-- This Month Registered -->
                        <div class="bg-white bg-opacity-20 px-3 py-2 rounded text-center">
                            <h5 class="mb-0 text-dark">{{ $overallStats['monthly_registered'] ?? 0 }}</h5>
                            <small class="opacity-75 text-dark">This Month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall Stats Cards -->
        <div class="card-body border-bottom">
            <div class="row g-2">
                <!-- Active Counselors Card -->
                <div class="col-xl">
                    <div class="card bg-light-primary border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-2">
                            <div class="text-center">
                                <div class="fw-bold text-primary mb-1" style="font-size: 20px;">
                                    {{ $overallStats['total_counsellors'] ?? 0 }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Active Counselors</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Total Registered Card -->
                <div class="col-xl">
                    <div class="card bg-light-success border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-2">
                            <div class="text-center">
                                <div class="fw-bold text-success mb-1" style="font-size: 20px;">
                                    {{ $overallStats['total_registered'] ?? 0 }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Total Registered</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Active Std Card -->
                <div class="col-xl">
                    <div class="card bg-light-warning border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-2">
                            <div class="text-center">
                                <div class="fw-bold text-warning mb-1" style="font-size: 20px;">
                                    {{ $overallStats['total_active_std'] ?? 0 }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Active Std</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Case Closed Card -->
                <div class="col-xl">
                    <div class="card bg-light-danger border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-2">
                            <div class="text-center">
                                <div class="fw-bold text-danger mb-1" style="font-size: 20px;">
                                    {{ $overallStats['total_caseclosed'] ?? 0 }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Case Closed</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Withdrawn Card -->
                <div class="col-xl">
                    <div class="card bg-light-maroon border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-2">
                            <div class="text-center">
                                <div class="fw-bold mb-1" style="font-size: 20px; color: #800000;">
                                    {{ $overallStats['total_withdrawn'] ?? 0 }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Withdrawn</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Rejected Card -->
                <div class="col-xl">
                    <div class="card bg-light-red border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-2">
                            <div class="text-center">
                                <div class="fw-bold mb-1" style="font-size: 20px; color: #ff0000;">
                                    {{ $overallStats['total_rejected'] ?? 0 }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Rejected</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Visa Process Card -->
                <div class="col-xl">
                    <div class="card bg-light-purple border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-2">
                            <div class="text-center">
                                <div class="fw-bold mb-1" style="font-size: 20px; color: #673AB7;">
                                    {{ $overallStats['total_visaprocess'] ?? 0 }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Visa Process</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Enrolled Card -->
                <div class="col-xl">
                    <div class="card bg-light-teal border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-2">
                            <div class="text-center">
                                <div class="fw-bold mb-1" style="font-size: 20px; color: #009688;">
                                    {{ $overallStats['total_enrolled'] ?? 0 }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Enrolled</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Counselors Table with Sticky Header -->
        <div class="card-body p-0">
            <div class="table-container" style="max-height: 100vh; overflow-y: auto;">
                <table class="table table-hover mb-0" style="table-layout: fixed; width: 100%;">
                    <thead class="sticky-table-header">
                        <tr>
                            <!-- Counselor Name -->
                            <th class="ps-3 border-end text-start" 
                                style="width: 18%; background: linear-gradient(135deg, #667eea 0%, #667eea 100%); white-space: nowrap; vertical-align: middle;">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper bg-white bg-opacity-20 p-1 rounded-circle me-2">
                                        <i class="fas fa-user-tie text-primary" style="font-size: 0.7rem;"></i>
                                    </div>
                                    <span class="fw-semibold text-white" style="font-size: 0.8rem;">Counselor Name</span>
                                </div>
                            </th>

                            <!-- Total Reg. -->
                            <th class="text-center border-end text-white" 
                                style="width: 10%; background: linear-gradient(135deg, #34A853 0%, #0f9d58 100%); white-space: nowrap; vertical-align: middle;">
                                <div class="d-flex flex-column align-items-center justify-content-center py-1">
                                    <i class="fas fa-user-check mb-1" style="font-size: 0.7rem;"></i>
                                    <span class="fw-medium" style="font-size: 0.75rem;">Total Reg.</span>
                                </div>
                            </th>

                            <!-- Active Std -->
                            <th class="text-center border-end text-white" 
                                style="width: 10%; background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%); white-space: nowrap; vertical-align: middle;">
                                <div class="d-flex flex-column align-items-center justify-content-center py-1">
                                    <i class="fas fa-user-clock mb-1" style="font-size: 0.7rem;"></i>
                                    <span class="fw-medium" style="font-size: 0.75rem;">Active Std</span>
                                </div>
                            </th>

                            <!-- Case Closed -->
                            <th class="text-center border-end text-white" 
                                style="width: 10%; background: linear-gradient(135deg, #EA4335 0%, #d23d31 100%); white-space: nowrap; vertical-align: middle;">
                                <div class="d-flex flex-column align-items-center justify-content-center py-1">
                                    <i class="fas fa-times-circle mb-1" style="font-size: 0.7rem;"></i>
                                    <span class="fw-medium" style="font-size: 0.75rem;">Case Closed</span>
                                </div>
                            </th>

                            <!-- Withdrawn -->
                            <th class="text-center border-end text-white" 
                                style="width: 10%; background: linear-gradient(135deg, #800000 0%, #5a0000 100%); white-space: nowrap; vertical-align: middle;">
                                <div class="d-flex flex-column align-items-center justify-content-center py-1">
                                    <i class="fas fa-sign-out-alt mb-1" style="font-size: 0.7rem;"></i>
                                    <span class="fw-medium" style="font-size: 0.75rem;">Withdrawn</span>
                                </div>
                            </th>

                            <!-- Rejection -->
                            <th class="text-center border-end text-white" 
                                style="width: 10%; background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); white-space: nowrap; vertical-align: middle;">
                                <div class="d-flex flex-column align-items-center justify-content-center py-1">
                                    <i class="fas fa-calendar-times mb-1" style="font-size: 0.7rem;"></i>
                                    <span class="fw-medium" style="font-size: 0.75rem;">Rejected</span>
                                </div>
                            </th>

                            <!-- Visa Process -->
                            <th class="text-center border-end text-white" 
                                style="width: 10%; background: linear-gradient(135deg, #673AB7 0%, #512DA8 100%); white-space: nowrap; vertical-align: middle;">
                                <div class="d-flex flex-column align-items-center justify-content-center py-1">
                                    <i class="fas fa-passport mb-1" style="font-size: 0.7rem;"></i>
                                    <span class="fw-medium" style="font-size: 0.75rem;">Visa Process</span>
                                </div>
                            </th>

                            <!-- Enrollment -->
                            <th class="text-center border-end text-white" 
                                style="width: 12%; background: linear-gradient(135deg, #009688 0%, #00796B 100%); white-space: nowrap; vertical-align: middle;">
                                <div class="d-flex flex-column align-items-center justify-content-center py-1">
                                    <i class="fas fa-graduation-cap mb-1" style="font-size: 0.7rem;"></i>
                                    <span class="fw-medium" style="font-size: 0.75rem;">Enrolled</span>
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($counsellors as $counsellor)
                        <tr class="counsellor-row">
                            <td class="ps-3 border-end" style="width: 18%;">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        <div class="avatar-initial bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 32px; height: 32px;">
                                            <i class="fas fa-user-tie text-white" style="font-size: 0.8rem;"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold" style="font-size: 0.85rem;">{{ $counsellor->username }}</h6>
                                        <small class="text-muted" style="font-size: 0.7rem;">ID: {{ $counsellor->id }}</small>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Total Registered -->
                            <td class="text-center border-end align-middle" style="width: 10%;">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="fw-bold text-dark" style="font-size: 18px;">
                                        {{ $counsellor->total_registered ?? 0 }}
                                    </div>
                                    <small class="text-muted" style="font-size: 0.7rem;">Students</small>
                                </div>
                            </td>
                            
                            <!-- Active Std -->
                            <td class="text-center border-end align-middle" style="width: 10%;">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="fw-bold text-dark" style="font-size: 16px;">
                                        {{ $counsellor->active_std_count ?? 0 }}
                                    </div>
                                    <div class="small text-muted" style="font-size: 0.65rem;">
                                        @if($counsellor->total_registered > 0)
                                            {{ round(($counsellor->active_std_count / $counsellor->total_registered) * 100, 1) }}%
                                        @else
                                            0%
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Case Closed -->
                            <td class="text-center border-end align-middle" style="width: 10%;">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="fw-bold text-dark" style="font-size: 16px;">
                                        {{ $counsellor->caseclosed_count ?? 0 }}
                                    </div>
                                    <div class="small text-muted" style="font-size: 0.65rem;">
                                        @if($counsellor->total_registered > 0)
                                            {{ round(($counsellor->caseclosed_count / $counsellor->total_registered) * 100, 1) }}%
                                        @else
                                            0%
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Withdrawn -->
                            <td class="text-center border-end align-middle" style="width: 10%;">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="fw-bold text-dark" style="font-size: 16px;">
                                        {{ $counsellor->withdrawn_count ?? 0 }}
                                    </div>
                                    <div class="small text-muted" style="font-size: 0.65rem;">
                                        @if($counsellor->total_registered > 0)
                                            {{ round(($counsellor->withdrawn_count / $counsellor->total_registered) * 100, 1) }}%
                                        @else
                                            0%
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Rejected -->
                            <td class="text-center border-end align-middle" style="width: 10%;">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="fw-bold text-dark" style="font-size: 16px;">
                                        {{ $counsellor->rejected_count ?? 0 }}
                                    </div>
                                    <div class="small text-muted" style="font-size: 0.65rem;">
                                        @if($counsellor->total_registered > 0)
                                            {{ round(($counsellor->rejected_count / $counsellor->total_registered) * 100, 1) }}%
                                        @else
                                            0%
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Visa Process -->
                            <td class="text-center border-end align-middle" style="width: 10%;">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="fw-bold text-dark" style="font-size: 16px;">
                                        {{ $counsellor->visaprocess_count ?? 0 }}
                                    </div>
                                    <div class="small text-muted" style="font-size: 0.65rem;">
                                        @if($counsellor->total_registered > 0)
                                            {{ round(($counsellor->visaprocess_count / $counsellor->total_registered) * 100, 1) }}%
                                        @else
                                            0%  
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Enrolled -->
                            <td class="text-center border-end align-middle" style="width: 12%;">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="fw-bold text-dark" style="font-size: 16px;">
                                        {{ $counsellor->enrolled_count ?? 0 }}
                                    </div>
                                    <div class="small text-muted" style="font-size: 0.65rem;">
                                        @if($counsellor->total_registered > 0)
                                            {{ round(($counsellor->enrolled_count / $counsellor->total_registered) * 100, 1) }}%
                                        @else
                                            0%
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-user-friends fa-2x text-muted opacity-50"></i>
                                </div>
                                <h6 class="text-muted mb-2" style="font-size: 0.9rem;">No Active Counselors Found</h6>
                                <p class="text-muted mb-0" style="font-size: 0.8rem;">There are no active counselors with status = 1 in the system.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 70%, #f8f4fc 100%) !important;
}

.counsellor-row:hover {
    background-color: #f8f9fa;
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

/* Modern gradient backgrounds for stats cards */
.bg-light-primary { 
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%) !important; 
}
.bg-light-success { 
    background: linear-gradient(135deg, rgba(52, 168, 83, 0.1) 0%, rgba(15, 157, 88, 0.1) 100%) !important; 
}
.bg-light-warning { 
    background: linear-gradient(135deg, rgba(255, 152, 0, 0.1) 0%, rgba(245, 124, 0, 0.1) 100%) !important; 
}
.bg-light-danger { 
    background: linear-gradient(135deg, rgba(234, 67, 53, 0.1) 0%, rgba(210, 61, 49, 0.1) 100%) !important; 
}
.bg-light-maroon { 
    background: linear-gradient(135deg, rgba(128, 0, 0, 0.1) 0%, rgba(90, 0, 0, 0.1) 100%) !important; 
}
.bg-light-red { 
    background: linear-gradient(135deg, rgba(255, 0, 0, 0.1) 0%, rgba(204, 0, 0, 0.1) 100%) !important; 
}
.bg-light-purple { 
    background: linear-gradient(135deg, rgba(103, 58, 183, 0.1) 0%, rgba(81, 45, 168, 0.1) 100%) !important; 
}
.bg-light-teal { 
    background: linear-gradient(135deg, rgba(0, 150, 136, 0.1) 0%, rgba(0, 121, 107, 0.1) 100%) !important; 
}

/* Table header improvements */
.table thead th {
    border-bottom: none;
    padding: 8px 4px;
    border-top: none;
}

/* Remove default borders and add subtle ones */
.table th, .table td {
    border-color: rgba(0,0,0,0.05) !important;
}

/* Compact table cells */
.table td {
    padding: 10px 4px !important;
}

/* Smooth transitions for icons */
.icon-wrapper {
    transition: all 0.3s ease;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Subtle shadow for cards */
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.08);
}

/* Reduce font sizes throughout */
.table th, .table td {
    font-size: 0.85rem;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .col-xl {
        min-width: 120px;
    }
}

/* Avatar improvements */
.avatar-initial {
    transition: all 0.3s ease;
}

.counsellor-row:hover .avatar-initial {
    transform: scale(1.05);
}

/* Table header gradient effects */
.table thead th:first-child {
    border-radius: 8px 0 0 0;
}

.table thead th:last-child {
    border-radius: 0 8px 0 0;
}

/* Make percentages more subtle */
.text-muted {
    opacity: 0.8;
}

/* STICKY HEADER STYLES - FIXED */
.table-container {
    position: relative;
    max-height: 70vh;
    overflow-y: auto;
    border-radius: 0 0 8px 8px;
}

.sticky-table-header {
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Ensure proper table layout */
.table-container table {
    table-layout: fixed !important;
    width: 100% !important;
    margin-bottom: 0;
}

/* Ensure columns align properly */
.table-container th,
.table-container td {
    width: auto !important;
}

/* Force equal column widths based on th widths */
.table-container th:nth-child(1),
.table-container td:nth-child(1) {
    width: 18% !important;
}

.table-container th:nth-child(2),
.table-container td:nth-child(2) {
    width: 10% !important;
}

.table-container th:nth-child(3),
.table-container td:nth-child(3) {
    width: 10% !important;
}

.table-container th:nth-child(4),
.table-container td:nth-child(4) {
    width: 10% !important;
}

.table-container th:nth-child(5),
.table-container td:nth-child(5) {
    width: 10% !important;
}

.table-container th:nth-child(6),
.table-container td:nth-child(6) {
    width: 10% !important;
}

.table-container th:nth-child(7),
.table-container td:nth-child(7) {
    width: 10% !important;
}

.table-container th:nth-child(8),
.table-container td:nth-child(8) {
    width: 12% !important;
}

/* Scrollbar styling */
.table-container::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Fix borders for sticky header */
.sticky-table-header th {
    position: relative;
    border-right: 1px solid rgba(255, 255, 255, 0.2) !important;
}

/* Ensure content doesn't overflow */
.table-container td {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Fix for empty state */
.table-container .text-center {
    position: relative;
    z-index: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableContainer = document.querySelector('.table-container');
    const stickyHeader = document.querySelector('.sticky-table-header');
    
    if (tableContainer && stickyHeader) {
        // Add shadow on scroll
        tableContainer.addEventListener('scroll', function() {
            if (tableContainer.scrollTop > 0) {
                stickyHeader.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.15)';
            } else {
                stickyHeader.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            }
        });
        
        // Ensure column widths match
        const thCells = stickyHeader.querySelectorAll('th');
        const firstRow = document.querySelector('.counsellor-row');
        
        if (firstRow) {
            const tdCells = firstRow.querySelectorAll('td');
            thCells.forEach((th, index) => {
                if (tdCells[index]) {
                    tdCells[index].style.width = th.style.width;
                }
            });
        }
    }
});
</script>
</div>