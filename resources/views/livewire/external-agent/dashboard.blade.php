<div>
<div class="card border-0 shadow-lg">
    <div class="card-body p-0">
        <!-- Welcome Header -->
<div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">            <div class="card-body py-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2 text-white">
    <i class="fas fa-tachometer-alt me-2"></i>
    Welcome Back, 
    {{ preg_replace('/([a-z])([A-Z])/', '$1 $2', ltrim(Auth::user()->username, '@')) }} !
</h2>

                        <p class="mb-0 opacity-75">
                            Here's your application overview and recent activity
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block">
                            <h3 class="mb-0 text-dark">{{ $totalApplications }}</h3>
                            <small class="opacity-75 text-dark">Total Applications</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Container -->
        <div class="p-4">
            <!-- Status Cards Grid -->
            <div class="d-flex flex-wrap justify-content-start mb-4" style="gap: 15px;">
                <!-- All Applications Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.all-applications') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #34A853; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-clipboard-list fa-2x"></i>
                                    <h3 class="fw-bold m-0 text-white">{{ $totalApplications }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0 text-white"><strong>All Applications</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Applications Under-Assessment Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.underassessment') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #517577; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: black;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-hourglass-half fa-2x text-white"></i>
                                    <h3 class="fw-bold m-0 text-white">{{ $underAssessmentCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0 text-white"><strong>Under Assessment</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Applications Processed Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.processed') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #09122C; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-tasks fa-2x"></i>
                                    <h3 class="fw-bold m-0 text-white">{{ $processedCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0 text-white"><strong>Processed</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Conditional Offers Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.conditionaloffers') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #27391C; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-file-signature fa-2x" style="color: rgb(248, 246, 246)"></i>
                                    <h3 class="fw-bold m-0" style="color: rgb(250, 248, 248)">{{ $conditionalCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0" style="color: rgb(248, 247, 247)"><strong>Conditional Offers</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Unconditional Offers Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.unconditionaloffers') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #87431D; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-file-contract fa-2x"></i>
                                    <h3 class="fw-bold m-0 text-white">{{ $unconditionalCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0 text-white"><strong>Unconditional Offers</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Under CAS Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.undercas') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #C69749; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: black;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-passport fa-2x text-white"></i>
                                    <h3 class="fw-bold m-0" style=" color: rgb(247, 246, 246) ">{{ $underCasCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0" style="color: rgb(253, 251, 251)"><strong>Under CAS</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- CAS Document Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.casreceived') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #828383; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-file-invoice fa-2x"></i>
                                    <h3 class="fw-bold m-0 text-white">{{ $casDocumentCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0 text-white text-white"><strong>CAS Received</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Visa Process Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.visaprocess') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #673AB7; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-stamp fa-2x"></i>
                                    <h3 class="fw-bold m-0 text-white">{{ $visaProcessCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0 text-white"><strong>Visa Process</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Enrollment Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.enrollment') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #009688; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-user-graduate fa-2x"></i>
                                    <h3 class="fw-bold m-0 text-white">{{ $enrollmentCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0 text-white"><strong>Enrollment</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Case Closed Card -->
                <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('externalagent.caseclosed') }}" class="text-decoration-none">
                        <div class="card text-center" style="background-color: #c01414; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-archive fa-2x"></i>
                                    <h3 class="fw-bold m-0 text-white">{{ $caseClosedCount }}</h3>
                                </div>
                                <h6 class="mt-3 mb-0 text-white"><strong>Case Closed</strong></h6>
                                <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Applications & Quick Actions Row -->
            <div class="row mb-4">
                <!-- Recent Applications -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-2">
                                <i class="fas fa-clock me-2 text-primary"></i>
                                Recent Applications
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($recentApplications->count() > 0)
                                @foreach($recentApplications as $application)
                                    @php
                                        $statusInfo = $getStatusInfo($application->inquiry_status);
                                    @endphp
                                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        <div class="flex-shrink-0">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas {{ $statusInfo['icon'] }} text-muted"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $application->student_name }}</h6>
                                            <small class="text-muted">
                                                {{ $application->university_name }} • 
                                                {{ \Carbon\Carbon::parse($application->created_at)->diffForHumans() }}
                                            </small>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span class="badge d-flex align-items-center gap-1" 
                                                  style="background-color: {{ $statusInfo['color'] }}; color: white;">
                                                <i class="fas {{ $statusInfo['icon'] }} fa-xs"></i>
                                                {{ ucfirst($application->inquiry_status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">No applications yet</p>
                                </div>
                            @endif
                            
                            @if($recentApplications->count() > 0)
                                <div class="text-center mt-3">
                                    <a href="{{ route('externalagent.all-applications') }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        View All Applications
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-4">
                                <i class="fas fa-rocket me-2 text-success"></i>
                                Quick Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('externalagent.add-application') }}" 
                                       class="card action-card h-100 text-decoration-none">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-plus fa-lg text-white"></i>
                                            </div>
                                            <h6 class="mb-1">New Application</h6>
                                            <small class="text-muted">Submit new student application</small>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-md-6">
                                    <a href="{{ route('externalagent.all-applications') }}" 
                                       class="card action-card h-100 text-decoration-none">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-list fa-lg text-white"></i>
                                            </div>
                                            <h6 class="mb-1">View All</h6>
                                            <small class="text-muted">Manage all applications</small>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-md-6">
                                    <a href="{{ route('externalagent.underassessment') }}" 
                                       class="card action-card h-100 text-decoration-none">
                                        <div class="card-body text-center p-4">
                                           <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                             style="width: 60px; height: 60px; background-color: #517577;">
                                            <i class="fas fa-hourglass-half fa-lg text-white"></i>
                                        </div>
                                            <h6 class="mb-1">Under Assessment</h6>
                                            <small class="text-muted">Review pending applications</small>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-md-6">
                                    <a href="{{ route('externalagent.processed') }}" 
                                       class="card action-card h-100 text-decoration-none">
                                        <div class="card-body text-center p-4">
                                            <div class=" bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                                 style="width: 60px; height: 60px; background-color: #09122C;">
                                                <i class="fas fa-tasks fa-lg text-white"></i>
                                            </div>
                                            <h6 class="mb-1">Processed</h6>
                                            <small class="text-muted">View processed applications</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Overview and Top Universities -->
            <div class="row mb-4">
                <!-- Status Distribution -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-pie me-2 text-info"></i>
                                Application Status Distribution
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($totalApplications > 0)
                                @foreach($statusDistribution as $status)
                                    @php
                                        $percentage = ($status['count'] / $totalApplications) * 100;
                                        $color = $this->getStatusColor($status['inquiry_status']);
                                    @endphp
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-capitalize">
                                                {{ str_replace('_', ' ', $status['inquiry_status']) }}
                                            </span>
                                            <span class="fw-bold">{{ $status['count'] }} ({{ round($percentage, 1) }}%)</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar" 
                                                 style="width: {{ $percentage }}%; background-color: {{ $color }};">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-chart-pie fa-2x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">No data available</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Top Universities -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-university me-2 text-warning"></i>
                                Top Universities
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($topUniversities->count() > 0)
                                @foreach($topUniversities as $university)
                                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        <div class="flex-shrink-0">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-graduation-cap text-muted"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $university->university_name }}</h6>
                                            <small class="text-muted">{{ $university->count }} applications</small>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary">{{ $university->count }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-university fa-2x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">No university data available</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-line me-2 text-success"></i>
                                Performance Overview
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="p-3">
                                        <h3 class="text-primary mb-1">{{ $totalApplications }}</h3>
                                        <small class="text-muted">Total Submitted</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="p-3">
                                        <h3 class="text-success mb-1">{{ $enrollmentCount }}</h3>
                                        <small class="text-muted">Successfully Enrolled</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="p-3">
                                        <h3 class="text-info mb-1">
                                            {{ $totalApplications > 0 ? round(($enrollmentCount / $totalApplications) * 100, 1) : 0 }}%
                                        </h3>
                                        <small class="text-muted">Success Rate</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="p-3">
                                        <h3 class="text-warning mb-1">{{ $underAssessmentCount }}</h3>
                                        <small class="text-muted">In Progress</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #c8c4fc 100%) !important;
}

.action-card {
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.action-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    border-color: #7367F0;
}

.progress {
    background-color: #f8f9fa;
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}

.card {
    border-radius: 12px;
}

.rounded-top {
    border-top-left-radius: 12px !important;
    border-top-right-radius: 12px !important;
}
</style>
</div>