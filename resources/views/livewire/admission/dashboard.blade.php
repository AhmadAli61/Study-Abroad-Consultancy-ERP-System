<div>
<div>
    <div class="card border-0 shadow-lg">
        <div class="card-body p-0">
            <!-- Welcome Header -->
            <div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">
                <div class="card-body py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2 text-white">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Welcome Back, 
                                {{ preg_replace('/([a-z])([A-Z])/', '$1 $2', ltrim(Auth::user()->username, '@')) }} !
                            </h2>
                            <p class="mb-0 opacity-75">
                                Here's your application management overview and recent activity
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block">
                                <h3 class="mb-0 text-dark">{{ $totalCount }}</h3>
                                <small class="opacity-75 text-dark">Total Applications</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Container -->
            <div class="p-4">
                <!-- Application Management Cards -->
                <div class="row mb-4">
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef1ff 100%); border-left: 4px solid #7367F0;">
                             
                            <div class="d-flex align-items-center">
                                <div class="me-3 rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 40px; height: 40px; background-color: rgba(40, 95, 167, 0.1);">
                                    <i class="fas fa-file-alt text-primary fs-5"></i>
                                </div>
                                <h4 class="mb-0 fw-bold text-dark">
                                    Application Management
                                </h4>
                            </div>

                            <a href="{{ route('admission.all-applications') }}" 
                               class="btn btn-sm fw-semibold d-flex align-items-center"
                               style="background-color: #ffffff; color: #7367F0; border: 1px solid #dee2e6; 
                                      transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.05);"
                               onmouseover="this.style.backgroundColor='#7367F0'; this.style.color='white'; this.style.borderColor='#7367F0';"
                               onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#7367F0'; this.style.borderColor='#dee2e6';">
                               <i class="fas fa-external-link-alt me-2"></i> Manage All
                            </a>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-wrap justify-content-start" style="gap: 15px;">
                        <!-- All Applications Card - Blue -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.all-applications') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #34A853; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-clipboard-list fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $totalCount }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>All Applications</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Applications Under-Assessment Card - Yellow -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.under-assessment') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #517577; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: black;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-hourglass-half fa-2x text-white"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $underAssessmentCount }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Underassessment</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Applications Processed Card - Green -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.processed') }}" class="text-decoration-none">
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

                        <!-- Conditional Offers Card - Sky Blue -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.conditional-offers') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #27391C; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-file-signature fa-2x" style="color: rgb(248, 246, 246)"></i>
                                            <h3 class="fw-bold m-0 " style="color: rgb(250, 248, 248)">{{ $conditionalCount }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 " style="color: rgb(248, 247, 247)"><strong>Conditional Offers</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Unconditional Offers Card - Purple -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.unconditional-offers') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #87431D; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-file-contract fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $unconditionalCount }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Unconditional</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Under CAS Card - Light Gray -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.under-cas') }}" class="text-decoration-none">
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

                        <!-- CAS Document Card - Red -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.cas-received') }}" class="text-decoration-none">
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

                        <!-- Visa Process Card - Deep Purple -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.visa-process') }}" class="text-decoration-none">
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

                        <!-- Enrollment Card - Teal -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.enrollment') }}" class="text-decoration-none">
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

                        <!-- Case Closed Card - Gray -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.case-closed') }}" class="text-decoration-none">
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
                        
                        <!-- Rejection Card -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.rejection') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #ff0000; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-times-circle fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $rejectedCount }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Rejection</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Withdrawn Applications Card -->
                        <div style="flex: 0 0 calc(16.66% - 15px); min-width: 150px; margin: 0 0 15px 0;">
                            <a href="{{ route('admission.withdrawn') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #ff5252; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-user-slash fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $withdrawnCount }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Withdrawn</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <hr class="border-1 border-secondary opacity-25">
                    </div>
                </div>

                <!-- Quick Overview Section -->
                <div class="row">
                    <!-- Recent Applications -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header mb-3 border-0 py-3 d-flex align-items-center justify-content-between"
                                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eaf4ff 100%); border-bottom: 2px solid #7367F0;">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                         style="width: 38px; height: 38px; background-color: rgba(40, 70, 167, 0.1);">
                                        <i class="fas fa-clock text-primary fs-5"></i>
                                    </div>
                                    <h5 class="mb-0 fw-semibold text-dark">Recent Applications</h5>
                                </div>
                                <a href="{{ route('admission.all-applications') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt me-1"></i> View All
                                </a>
                            </div>

                            <div class="card-body">
                                @if($recentApplications->count() > 0)
                                    @foreach($recentApplications as $application)
                                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user-graduate text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 fw-semibold">{{ $application->student_name }}</h6>
                                                <small class="text-muted">
                                                    {{ $application->university_name }} • 
                                                    {{ \Carbon\Carbon::parse($application->created_at)->diffForHumans() }}
                                                </small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="badge" 
                                                      style="background-color: {{ $getApplicationStatusColor($application->inquiry_status) }}; color: white;">
                                                    <i class="fas {{ $getApplicationStatusIcon($application->inquiry_status) }} me-1"></i>
                                                    {{ ucfirst($application->inquiry_status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-file-alt fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No applications yet</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Status Distribution -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header mb-4 border-0 py-3 d-flex align-items-center"
                                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eaf4ff 100%); border-bottom: 2px solid #7367F0;">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 38px; height: 38px; background-color: rgba(40, 70, 167, 0.1);">
                                    <i class="fas fa-chart-pie text-primary fs-5"></i>
                                </div>
                                <h5 class="mb-0 fw-semibold text-dark">Application Status Distribution</h5>
                            </div>

                            <div class="card-body">
                                @if($totalCount > 0)
                                    @foreach($statusDistribution as $status)
                                        @php
                                            $percentage = ($status['count'] / $totalCount) * 100;
                                            $statusInfo = $getApplicationStatusInfo($status['inquiry_status']);
                                        @endphp
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span class="text-capitalize d-flex align-items-center gap-2">
                                                    <i class="fas {{ $statusInfo['icon'] }}" 
                                                       style="color: {{ $statusInfo['color'] }}; font-size: 12px;"></i>
                                                    {{ str_replace('_', ' ', $status['inquiry_status']) }}
                                                </span>
                                                <span class="fw-bold">{{ $status['count'] }} ({{ round($percentage, 1) }}%)</span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar" 
                                                     style="width: {{ $percentage }}%; background-color: {{ $statusInfo['color'] }};">
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
                </div>

                <!-- Monthly Progress Tracking Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header mb-4 border-0 py-3 d-flex align-items-center justify-content-between"
                                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eaf4ff 100%); border-bottom: 2px solid #7367F0;">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                         style="width: 38px; height: 38px; background-color: rgba(40, 70, 167, 0.1);">
                                        <i class="fas fa-chart-line text-primary fs-5"></i>
                                    </div>
                                    <h5 class="mb-0 fw-semibold text-dark">Monthly Performance Progress</h5>
                                </div>
                            </div>

                            <div class="card-body" id="monthlyProgressSection">
                                @if($monthlyProgress && count($monthlyProgress) > 0)
                                    <div class="row">
                                        <!-- Performance Summary Cards -->
                                        <div class="col-lg-3 col-md-6 mb-4">
                                            <div class="card border-0 h-100" style="background: linear-gradient(135deg, #7367F0 50%, #2b274b 100%);">
                                                <div class="card-body text-white text-center">
                                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                                        <i class="fas fa-rocket fa-2x me-2"></i>
                                                        <h3 class="mb-0 text-white">{{ $monthlyProgress->sum('total_applications') }}</h3>
                                                    </div>
                                                    <p class="mb-0 fw-semibold">Total Applications This Year</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 mb-4">
                                            <div class="card border-0 h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                                <div class="card-body text-white text-center">
                                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                                        <i class="fas fa-check-circle fa-2x me-2"></i>
                                                        <h3 class="mb-0 text-white">{{ $monthlyProgress->sum('completed_applications') }}</h3>
                                                    </div>
                                                    <p class="mb-0 fw-semibold">Completed Cases</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 mb-4">
                                            <div class="card border-0 h-100" style="background: linear-gradient(135deg, #009688 50%, #1f2c2b 100%);">
                                                <div class="card-body text-white text-center">
                                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                                        <i class="fas fa-user-graduate fa-2x me-2"></i>
                                                        <h3 class="mb-0 text-white">{{ $monthlyProgress->sum('enrolled_applications') }}</h3>
                                                    </div>
                                                    <p class="mb-0 fw-semibold">Students Enrolled</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 mb-4">
                                            @php
                                                $avgCompletion = $monthlyProgress->avg('completion_rate');
                                            @endphp
                                            <div class="card border-0 h-100" style="background: linear-gradient(135deg, #34A853 50%, #142418 100%);">
                                                <div class="card-body text-white text-center">
                                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                                        <i class="fas fa-trophy fa-2x me-2"></i>
                                                        <h3 class="mb-0 text-white">{{ round($avgCompletion, 1) }}%</h3>
                                                    </div>
                                                    <p class="mb-0 fw-semibold">Avg. Completion Rate</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Monthly Progress Chart -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body">
                                                    <h6 class="fw-semibold mb-3 text-center">
                                                        <i class="fas fa-chart-bar me-2 text-primary"></i>
                                                        Monthly Application Progress - {{ now()->format('Y') }}
                                                    </h6>
                                                    <div class="monthly-progress-chart">
                                                        @foreach($monthlyProgress->reverse() as $month)
                                                            <div class="progress-item mb-3">
                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                    <span class="fw-semibold text-dark">{{ $month->month_name }}</span>
                                                                    <div class="d-flex gap-3">
                                                                        <small class="text-muted">
                                                                            <i class="fas fa-paper-plane me-1 text-info"></i>
                                                                            {{ $month->total_applications }} Total
                                                                        </small>
                                                                        <small class="text-muted">
                                                                            <i class="fas fa-check me-1 text-success"></i>
                                                                            {{ $month->completed_applications }} Completed
                                                                        </small>
                                                                        <small class="text-muted">
                                                                            <i class="fas fa-graduation-cap me-1 text-primary"></i>
                                                                            {{ $month->enrolled_applications }} Enrolled
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Main Progress Bar -->
                                                                <div class="progress mb-2" style="height: 25px; border-radius: 12px;">
                                                                    <!-- Completed Applications -->
                                                                    <div class="progress-bar" 
                                                                         style="width: {{ $month->completion_rate }}%; background: linear-gradient(90deg, #28a745, #20c997);"
                                                                         data-bs-toggle="tooltip" 
                                                                         title="{{ $month->completion_rate }}% Completion Rate">
                                                                        <span class="progress-text">{{ $month->completion_rate }}%</span>
                                                                    </div>
                                                                    
                                                                    <!-- Enrollment Applications -->
                                                                    <div class="progress-bar" 
                                                                         style="width: {{ $month->enrollment_rate }}%; background: linear-gradient(90deg, #007bff, #17a2b8);"
                                                                         data-bs-toggle="tooltip" 
                                                                         title="{{ $month->enrollment_rate }}% Enrollment Rate">
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Progress Labels -->
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <small class="text-success">
                                                                        <i class="fas fa-chart-line me-1"></i>
                                                                        Completion: {{ $month->completion_rate }}%
                                                                    </small>
                                                                    <small class="text-primary">
                                                                        <i class="fas fa-user-graduate me-1"></i>
                                                                        Enrollment: {{ $month->enrollment_rate }}%
                                                                    </small>
                                                                    <small class="text-info">
                                                                        <i class="fas fa-bullseye me-1"></i>
                                                                        Success Rate: {{ max($month->completion_rate, $month->enrollment_rate) }}%
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No Monthly Data Available</h5>
                                        <p class="text-muted">Your monthly progress will appear here as you process applications.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Universities -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header mb-3 border-0 py-3 d-flex align-items-center justify-content-between"
                                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eaf4ff 100%); border-bottom: 2px solid #7367F0;">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                         style="width: 38px; height: 38px; background-color: rgba(40, 70, 167, 0.1);">
                                        <i class="fas fa-university text-primary fs-5"></i>
                                    </div>
                                    <h5 class="mb-0 fw-semibold text-dark">Top Universities</h5>
                                </div>
                                <a href="{{ route('admission.all-applications') }}" class="btn btn-sm btn-outline-primary fw-semibold">
                                    <i class="fas fa-external-link-alt me-1"></i> View All
                                </a>
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
                                                <h6 class="mb-1 fw-semibold">{{ $university->university_name }}</h6>
                                                <small class="text-muted">{{ $university->count }} applications</small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="badge" 
                                                      style="background-color: #7367F0; color: #f9fafa; font-weight: 600;">
                                                    {{ $university->count }}
                                                </span>
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
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #c8c4fc 100%) !important;
}
.monthly-progress-chart {
    max-height: 500px;
    overflow-y: auto;
    padding-right: 10px;
}

.monthly-progress-chart::-webkit-scrollbar {
    width: 6px;
}

.monthly-progress-chart::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.monthly-progress-chart::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.monthly-progress-chart::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

.progress-item {
    padding: 15px;
    border-radius: 10px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.progress-item:hover {
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.progress-bar {
    position: relative;
    transition: width 1s ease-in-out;
}

.progress-text {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-weight: bold;
    font-size: 11px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

/* Animation for progress bars */
.progress-bar {
    animation: slideIn 1s ease-out;
}

@keyframes slideIn {
    from {
        width: 0% !important;
    }
}

.card {
    border-radius: 12px;
}

.badge {
    font-size: 11px;
    padding: 4px 8px;
}

.progress {
    background-color: #f8f9fa;
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}
</style>
</div>