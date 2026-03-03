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
                                System Overview - Complete administration dashboard with team management
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block me-3">
                                <h3 class="mb-0 text-dark">{{ $totalLeads }}</h3>
                                <small class="opacity-75 text-dark">Total Inquiries</small>
                            </div>
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

                <!-- Inquiry Management Section -->
                <div class="row mb-4">
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                                    <i class="fas fa-headset text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold text-dark">Inquiry Management</h4>
                                    <p class="text-muted mb-0 small">Manage all student inquiries and leads</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.inquiries') }}" 
                               class="btn btn-sm fw-semibold"
                               style="background-color: #ffffff; color: #7367F0; border: 1px solid #dee2e6; transition: all 0.3s ease;"
                               onmouseover="this.style.backgroundColor='#7367F0'; this.style.color='white'; this.style.borderColor='#0d6efd';"
                               onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#7367F0'; this.style.borderColor='#dee2e6';">
                               <i class="fas fa-external-link-alt me-1"></i> Manage All
                            </a>
                        </div>
                    </div>

                    <!-- Inquiry status cards -->
                    <div class="d-flex flex-wrap justify-content-start" style="gap: 15px;">
                        <!-- All Inquiries -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.inquiries') }}" class="text-decoration-none">
                                <div class="card text-center bg-primary"
                                     style="height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-list fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $totalLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>All Inquiries</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Hot Leads -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.hot-inquiries') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #ff5722; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-fire fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $hotLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Hot</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #ff5722; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Cold Leads -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.cold-inquiries') }}" class="text-decoration-none">
                                <div class="card text-center bg-info"
                                     style="height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-snowflake fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $coldLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Cold</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #0dcaf0; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Dead Leads -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.dead-inquiries') }}" class="text-decoration-none">
                                <div class="card text-center bg-dark"
                                     style="height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-times-circle fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $deadLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Dead</strong></h6>
                                        <button class="btn btn-sm mt-3 text-dark" style="background-color: white; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Pending Leads -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.pending-inquiries') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #ffc107; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: black;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-hourglass-half fa-2x" style="color: black;"></i>
                                            <h3 class="fw-bold m-0" style="color: black;">{{ $pendingLeads }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0" style="color: black;"><strong>Pending</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: black; font-size: 11px; border: none;">View All</button>
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

                <!-- Application Management Section -->
                <div class="row mb-4">
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                             style="background: linear-gradient(90deg, #f8f9fa 0%, #f1fff3 100%); border-left: 4px solid #28a745;">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 42px; height: 42px; background-color: rgba(40,167,69,0.1);">
                                    <i class="fas fa-file-alt text-success fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold text-dark">Application Management</h4>
                                    <p class="text-muted mb-0 small">Track all application progress and status</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.all-applications') }}" 
                               class="btn btn-sm fw-semibold"
                               style="background-color: #ffffff; color: #28a745; border: 1px solid #dee2e6; transition: all 0.3s ease;"
                               onmouseover="this.style.backgroundColor='#28a745'; this.style.color='white'; this.style.borderColor='#28a745';"
                               onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#28a745'; this.style.borderColor='#dee2e6';">
                               <i class="fas fa-external-link-alt me-1"></i> Manage All
                            </a>
                        </div>
                    </div>

                    <!-- Application status cards -->
<div class="d-flex flex-wrap justify-content-center" style="gap: 10px;">
                        <!-- All Applications -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.all-applications') }}" class="text-decoration-none">
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

                        <!-- Under Assessment -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.underassessment') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #517577; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-hourglass-half fa-2x text-white"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $underAssessmentCount }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>U Assessment</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Processed -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.processed') }}" class="text-decoration-none">
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

                        <!-- Conditional Offers -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.conditional-offers') }}" class="text-decoration-none">
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

                        <!-- Unconditional Offers -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.unconditional-offers') }}" class="text-decoration-none">
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

                        <!-- Under CAS -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.under-cas') }}" class="text-decoration-none">
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

                        <!-- CAS Received -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.cas-received') }}" class="text-decoration-none">
                                <div class="card text-center" style="background-color: #828383; height: 160px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-file-invoice fa-2x"></i>
                                            <h3 class="fw-bold m-0 text-white">{{ $casReceivedCount }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white text-white"><strong>CAS Received</strong></h6>
                                        <button class="btn btn-sm mt-3" style="background-color: white; color: #080808; font-size: 11px; border: none;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Visa Process -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.visa-process') }}" class="text-decoration-none">
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

                        <!-- Enrollment -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.enrollment') }}" class="text-decoration-none">
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

                        <!-- Case Closed -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.case-closed') }}" class="text-decoration-none">
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
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
        <a href="{{ route('admin.rejected') }}" class="text-decoration-none">
            <div class="card d-flex align-items-center justify-content-center text-center"
                 style="background-color: #ff0000; height: 160px; border: none;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-times-circle" style="font-size: 20px;"></i>
                        <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $rejectedCount }}</h4>
                    </div>
                    <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Rejected</strong></h6>
                    <button class="btn btn-sm mt-3 px-2 py-1"
                            style="background-color: white; color: #ff0000; font-size: 12px; border: none; border-radius: 4px;">
                        View All
                    </button>
                </div>
            </div>
        </a>
    </div>

    <!-- Withdrawn -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
        <a href="{{ route('admin.withdrawn') }}" class="text-decoration-none">
            <div class="card d-flex align-items-center justify-content-center text-center"
                 style="background-color: #ff5252; height: 160px; border: none;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-user-slash" style="font-size: 20px;"></i>
                        <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $withdrawnCount }}</h4>
                    </div>
                    <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Withdrawn</strong></h6>
                    <button class="btn btn-sm mt-3 px-2 py-1"
                            style="background-color: white; color: #ff5252; font-size: 12px; border: none; border-radius: 4px;">
                        View All
                    </button>
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

                <!-- System Overview Cards -->
                <div class="row mb-4">
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                                    <i class="fas fa-chart-line text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold text-dark">System Overview</h4>
                                    <p class="text-muted mb-0 small">Complete system statistics and analytics</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <span class="badge bg-primary">{{ $userStats['total_users'] }} Users</span>
                                <span class="badge bg-success">{{ $teams->count() }} Teams</span>
                            </div>
                        </div>
                    </div>

                    <!-- System Stats Cards -->
                    <div class="row mb-2 d-flex justify-content-between flex-wrap" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                        <!-- Total Users -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                                <div class="card text-center bg-info"
                                     style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-users fa-2x" style="color: white;"></i>
                                            <h3 class="fw-bold m-0" style="color: white;">{{ $userStats['total_users'] }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Total Users</strong></h6>
                                        <button class="btn btn-sm mt-3 text-info"
                                                style="background-color: white; font-size: 11px;">Manage</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Active Teams -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.teams') }}" class="text-decoration-none">
                                <div class="card text-center"
                                     style="background-color: #8d1010; height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-layer-group fa-2x" style="color: white;"></i>
                                            <h3 class="fw-bold m-0" style="color: white;">{{ $teams->count() }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>Active Teams</strong></h6>
                                        <button class="btn btn-sm mt-3"
                                                style="background-color: white; color: #8d1010; font-size: 11px;">View All</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Monthly Conversion Rate -->
<div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
    <div class="card text-center bg-warning"
         style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: black;">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-chart-pie fa-2x" style="color: black;"></i>
                <h3 class="fw-bold m-0" style="color: black;">{{ $systemOverview['conversion_rate'] }}%</h3>
            </div>
            <h6 class="mt-3 mb-0" style="color: black;"><strong>Conversion Rate</strong></h6>
            <small class="text-dark">{{ $systemOverview['month_name'] }} Performance</small>
            <div class="mt-1 small text-dark">
                {{ $systemOverview['monthly_inquiries'] }} Inquiries <div></div> {{ $systemOverview['monthly_registered'] }} Registered
            </div>
        </div>
    </div>
</div>
                        

                        <!-- Total Inquiries -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.inquiries') }}" class="text-decoration-none">
                                <div class="card text-center bg-primary"
                                     style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-inbox fa-2x" style="color: white;"></i>
                                            <h3 class="fw-bold m-0" style="color: white;">{{ $systemOverview['total_inquiries'] }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>All Inquiries</strong></h6>
                                        <button class="btn btn-sm mt-3 text-primary"
                                                style="background-color: white; font-size: 11px;">Manage</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Applications -->
                        <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                            <a href="{{ route('admin.admission.allstudents') }}" class="text-decoration-none">
                                <div class="card text-center" 
                                     style="background-color: #0d47a1; height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-file-alt fa-2x" style="color: white;"></i>
                                            <h3 class="fw-bold m-0" style="color: white;">{{ $systemOverview['total_applications'] }}</h3>
                                        </div>
                                        <h6 class="mt-3 mb-0 text-white"><strong>All Students</strong></h6>
                                        <button class="btn btn-sm mt-3"
                                                style="background-color: white; font-size: 11px; color: #0d47a1;">Manage</button>
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

               <!-- Assignment Management Section -->
<div class="row mb-4">
    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width: 42px; height: 42px; background-color: rgba(13,110,253,0.1);">
                    <i class="fas fa-users text-primary fs-5"></i>
                </div>
                <div>
                    <h4 class="mb-1 fw-bold text-dark">Assignment Management</h4>
                    <p class="text-muted mb-0 small">Manage unassigned and reassigned inquiries</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <span class="badge bg-danger">{{ $unassignedLeads }} Unassigned</span>
                <span class="badge bg-warning text-dark">{{ $reassignedLeads }} Reassigned</span>
            </div>
        </div>
    </div>

    <!-- Unassigned Inquiries Card -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-gradient-danger text-white border-0 py-3" 
                 style="border-radius: 12px 12px 0 0 !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 text-dark fw-bold">
                            <i class="fas fa-user-times me-2 text-dark"></i>Unassigned Inquiries
                        </h5>
                        <small class="opacity-75 text-dark">These inquiries haven't been assigned yet</small>
                    </div>
                    <div class="bg-danger bg-opacity-20 px-3 py-2 rounded text-center">
                        <h4 class="mb-0 text-white">{{ $unassignedLeads }}</h4>
                        <small class="opacity-75 text-white">Total</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3 text-center">
                    <!-- HOT -->
                    <div class="col-6 col-sm-3">
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ff5722, #ff8a65);">
                            <div class="card-body p-3 text-white">
                                <div class="mb-2">
                                    <i class="fas fa-fire fa-2x text-white"></i>
                                </div>
                                <h6 class="fw-semibold text-white mb-1">HOT</h6>
                                <h4 class="fw-bold text-white mb-2">{{ $hotLeads }}</h4>
                                <div class="progress" style="height: 6px; background: rgba(255,255,255,0.3);">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $hotLeadsPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- COLD -->
                    <div class="col-6 col-sm-3">
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #00c0ff, #4fc3f7);">
                            <div class="card-body p-3 text-white">
                                <div class="mb-2">
                                    <i class="fas fa-snowflake fa-2x text-white"></i>
                                </div>
                                <h6 class="fw-semibold text-white mb-1">COLD</h6>
                                <h4 class="fw-bold text-white mb-2">{{ $coldLeads }}</h4>
                                <div class="progress" style="height: 6px; background: rgba(255,255,255,0.3);">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $coldLeadsPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DEAD -->
                    <div class="col-6 col-sm-3">
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6c757d, #9e9e9e);">
                            <div class="card-body p-3 text-white">
                                <div class="mb-2">
                                    <i class="fas fa-ban fa-2x text-white"></i>
                                </div>
                                <h6 class="fw-semibold text-white mb-1">DEAD</h6>
                                <h4 class="fw-bold text-white mb-2">{{ $deadLeads }}</h4>
                                <div class="progress" style="height: 6px; background: rgba(255,255,255,0.3);">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $deadLeadsPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PENDING -->
                    <div class="col-6 col-sm-3">
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ffc107, #ffd54f);">
                            <div class="card-body p-3 text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-hourglass-half fa-2x text-dark"></i>
                                </div>
                                <h6 class="fw-semibold text-dark mb-1">PENDING</h6>
                                <h4 class="fw-bold text-dark mb-2">{{ $pendingLeads }}</h4>
                                <div class="progress" style="height: 6px; background: rgba(0,0,0,0.2);">
                                    <div class="progress-bar bg-dark" role="progressbar"
                                         style="width: {{ $pendingLeadsPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3" style="border-radius: 0 0 12px 12px !important;">
                <a href="{{ route('admin.assign') }}" 
                   class="btn btn-danger w-100 fw-semibold d-flex align-items-center justify-content-center"
                   style="transition: all 0.3s ease;"
                   onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(220,53,69,0.3)';"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <i class="fas fa-user-check me-2"></i> Assign Inquiries
                </a>
            </div>
        </div>
    </div>

    <!-- Reassigned Inquiries Card -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-gradient-warning text-dark border-0 py-3" 
                 style="border-radius: 12px 12px 0 0 !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 text-dark fw-bold">
                            <i class="fas fa-random me-2 text-dark"></i>Reassigned Inquiries
                        </h5>
                        <small class="opacity-75">Inquiries previously assigned but now unassigned</small>
                    </div>
                    <div class="bg-warning bg-opacity-10 px-3 py-2 rounded text-center">
                        <h4 class="mb-0 text-dark">{{ $reassignedLeads }}</h4>
                        <small class="opacity-75 text-dark">Total</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3 text-center">
                    <!-- HOT -->
                    <div class="col-6 col-sm-3">
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ff5722, #ff8a65);">
                            <div class="card-body p-3 text-white">
                                <div class="mb-2">
                                    <i class="fas fa-fire fa-2x text-white"></i>
                                </div>
                                <h6 class="fw-semibold text-white mb-1">HOT</h6>
                                <h4 class="fw-bold text-white mb-2">{{ $reassignedHot }}</h4>
                                <div class="progress" style="height: 6px; background: rgba(255,255,255,0.3);">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $reassignedHotPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- COLD -->
                    <div class="col-6 col-sm-3">
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #00c0ff, #4fc3f7);">
                            <div class="card-body p-3 text-white">
                                <div class="mb-2">
                                    <i class="fas fa-snowflake fa-2x text-white"></i>
                                </div>
                                <h6 class="fw-semibold text-white mb-1">COLD</h6>
                                <h4 class="fw-bold text-white mb-2">{{ $reassignedCold }}</h4>
                                <div class="progress" style="height: 6px; background: rgba(255,255,255,0.3);">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $reassignedColdPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DEAD -->
                    <div class="col-6 col-sm-3">
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6c757d, #9e9e9e);">
                            <div class="card-body p-3 text-white">
                                <div class="mb-2">
                                    <i class="fas fa-ban fa-2x text-white"></i>
                                </div>
                                <h6 class="fw-semibold text-white mb-1">DEAD</h6>
                                <h4 class="fw-bold text-white mb-2">{{ $reassignedDead }}</h4>
                                <div class="progress" style="height: 6px; background: rgba(255,255,255,0.3);">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $reassignedDeadPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PENDING -->
                    <div class="col-6 col-sm-3">
                        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ffc107, #ffd54f);">
                            <div class="card-body p-3 text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-hourglass-half fa-2x text-dark"></i>
                                </div>
                                <h6 class="fw-semibold text-dark mb-1">PENDING</h6>
                                <h4 class="fw-bold text-dark mb-2">{{ $reassignedPending }}</h4>
                                <div class="progress" style="height: 6px; background: rgba(0,0,0,0.2);">
                                    <div class="progress-bar bg-dark" role="progressbar"
                                         style="width: {{ $reassignedPendingPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3" style="border-radius: 0 0 12px 12px !important;">
                <a href="{{ route('admin.reassign') }}" 
                   class="btn btn-warning w-100 fw-semibold d-flex align-items-center justify-content-center text-dark"
                   style="transition: all 0.3s ease;"
                   onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(255,193,7,0.3)';"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <i class="fas fa-random me-2"></i> Reassign Inquiries
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
                    <div class="col-12">
                        <hr class="border-1 border-secondary opacity-25">
                    </div>
                </div>

               <!-- Teams Overview Section -->
<div class="row mb-4">
    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center p-3 rounded shadow-sm" 
                             style="background: linear-gradient(90deg, #f8f9fa 0%, #eef3ff 100%); border-left: 4px solid #7367F0;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width: 42px; height: 42px; background-color:rgba(13,110,253,0.1);">
                    <i class="fas fa-layer-group text-primary fs-5"></i>
                </div>
                <div>
                    <h4 class="mb-1 fw-bold text-dark">Teams Reports Overview</h4>
                    <p class="text-muted mb-0 small">Monitor team performance and counselor distribution</p>
                </div>
            </div>
            <a href="{{ route('admin.teams') }}" 
               class="btn btn-sm fw-semibold"
               style="background-color: #ffffff; color: #7367F0; border: 1px solid #dee2e6; transition: all 0.3s ease;"
               onmouseover="this.style.backgroundColor='#7367F0'; this.style.color='white'; this.style.borderColor='#7367F0';"
               onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#7367F0'; this.style.borderColor='#dee2e6';">
               <i class="fas fa-external-link-alt me-1"></i> Manage Teams
            </a>
        </div>
    </div>

   <div class="col-12">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="row g-3 px-4 py-3">
                @foreach ($teams as $team)
            @php
    $counsellorIds = $team->counsellors->pluck('id')->toArray();
    $managerId = $team->manager_id;
    $allUserIds = array_merge($counsellorIds, [$managerId]);

    // TOTAL INQUIRIES (ALL-TIME) - for card header (from inquiiries table)
    $inquiryCount = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)->count();

    // MONTHLY COUNTS - for performance summary
    $currentMonth = now()->month;
    $currentYear = now()->year;
    
    // Monthly inquiries count (from inquiiries table)
    $monthlyInquiryCount = \App\Models\Inquiiry::whereIn('assigned_to', $allUserIds)
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->count();
        
    // Monthly registered count (from registered_inquiries table) - FIXED: using users_id
   $monthlyRegisteredCount = \App\Models\RegisteredInquiry::whereIn('users_id', $allUserIds)
        ->whereNull('parent_id')
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->count();

    // Status counts for current month (for progress bars) - from inquiiries table
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

    // Get month name for display
    $monthName = now()->format('F');
@endphp

                    <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                        <div class="card border-0 shadow-sm h-100">
                            <!-- Team Header -->
                            <div class="card-header bg-gradient-primary text-white border-0 py-3" 
                                 style="border-radius: 12px 12px 0 0 !important;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1 text-white fw-bold">
                                            <i class="fas fa-layer-group me-2 text-white"></i>{{ $team->name }}
                                        </h5>
                                        <small class="opacity-75">
                                            <i class="fas fa-user-tie me-1"></i> 
                                            {{ $team->manager->username }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <div class="bg-white bg-opacity-20 px-2 py-1 rounded">
                                            <h6 class="mb-0 text-dark">{{ $inquiryCount }}</h6>
                                            <small class="opacity-75 text-dark">Inquiries</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column py-3 px-3">
                                <!-- Counselors Section -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-bold mb-0 text-primary">
                                            <i class="fas fa-user-friends me-2"></i>Counselors
                                        </h6>
                                        <span class="badge bg-primary">{{ $team->counsellors->count() }}</span>
                                    </div>
                                    <div style="max-height: 80px; overflow-y: auto; border: 1px solid #f1f3f4; border-radius: 8px; padding: 8px;">
                                        @forelse ($team->counsellors as $counsellor)
                                            <div class="d-flex align-items-center mb-1 pb-1 border-bottom" style="border-color: #f8f9fa !important;">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                         style="width: 28px; height: 28px;">
                                                        <i class="fas fa-user text-muted" style="font-size: 12px;"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <div class="fw-semibold text-dark" style="font-size: 12px;">
                                                        {{ $counsellor->username }}
                                                    </div>
                                                    <small class="text-muted" style="font-size: 10px;">
                                                        {{ $counsellor->role }}
                                                    </small>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center py-1">
                                                <i class="fas fa-users text-muted mb-1" style="font-size: 12px;"></i>
                                                <p class="text-muted mb-0" style="font-size: 11px;">No counselors</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Inquiry Status Distribution -->
                                <div class="mb-3">
                                    <h6 class="fw-bold mb-2 text-center text-dark" style="font-size: 14px;">
                                        <i class="fas fa-chart-pie me-2"></i>Inquiry Status
                                    </h6>
                                    
                                    <!-- Status Progress Bars -->
                                    <div class="status-bars">
                                        <!-- Hot -->
                                        <div class="status-item mb-2">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="status-indicator" style="background-color: #ff5722; width: 6px; height: 6px; border-radius: 50%; margin-right: 6px;"></div>
                                                    <small class="fw-semibold" style="color: #ff5722; font-size: 10px;">HOT</small>
                                                </div>
                                                <span class="fw-bold" style="font-size: 11px; color: #ff5722;">{{ $hot }}</span>
                                            </div>
                                            <div class="progress" style="height: 4px; background-color: rgba(255, 87, 34, 0.1);">
                                                <div class="progress-bar" style="background-color: #ff5722; width: {{ $hotPercent }}%"></div>
                                            </div>
                                        </div>

                                        <!-- Cold -->
                                        <div class="status-item mb-2">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="status-indicator" style="background-color: #00c0ff; width: 6px; height: 6px; border-radius: 50%; margin-right: 6px;"></div>
                                                    <small class="fw-semibold" style="color: #00c0ff; font-size: 10px;">COLD</small>
                                                </div>
                                                <span class="fw-bold" style="font-size: 11px; color: #00c0ff;">{{ $cold }}</span>
                                            </div>
                                            <div class="progress" style="height: 4px; background-color: rgba(0, 192, 255, 0.1);">
                                                <div class="progress-bar" style="background-color: #00c0ff; width: {{ $coldPercent }}%"></div>
                                            </div>
                                        </div>

                                        <!-- Dead -->
                                        <div class="status-item mb-2">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="status-indicator" style="background-color: #6c757d; width: 6px; height: 6px; border-radius: 50%; margin-right: 6px;"></div>
                                                    <small class="fw-semibold" style="color: #6c757d; font-size: 10px;">DEAD</small>
                                                </div>
                                                <span class="fw-bold" style="font-size: 11px; color: #6c757d;">{{ $dead }}</span>
                                            </div>
                                            <div class="progress" style="height: 4px; background-color: rgba(108, 117, 125, 0.1);">
                                                <div class="progress-bar" style="background-color: #6c757d; width: {{ $deadPercent }}%"></div>
                                            </div>
                                        </div>

                                        <!-- Pending -->
                                        <div class="status-item mb-2">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="status-indicator" style="background-color: #ffc107; width: 6px; height: 6px; border-radius: 50%; margin-right: 6px;"></div>
                                                    <small class="fw-semibold" style="color: #ffc107; font-size: 10px;">PENDING</small>
                                                </div>
                                                <span class="fw-bold" style="font-size: 11px; color: #ffc107;">{{ $pending }}</span>
                                            </div>
                                            <div class="progress" style="height: 4px; background-color: rgba(255, 193, 7, 0.1);">
                                                <div class="progress-bar" style="background-color: #ffc107; width: {{ $pendingPercent }}%"></div>
                                            </div>
                                        </div>

                                        <!-- Registered -->
                                        <div class="status-item">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="status-indicator" style="background-color: #28a745; width: 6px; height: 6px; border-radius: 50%; margin-right: 6px;"></div>
                                                    <small class="fw-semibold" style="color: #28a745; font-size: 10px;">REGISTERED</small>
                                                </div>
                                                <span class="fw-bold" style="font-size: 11px; color: #28a745;">{{ $registered }}</span>
                                            </div>
                                            <div class="progress" style="height: 4px; background-color: rgba(40, 167, 69, 0.1);">
                                                <div class="progress-bar" style="background-color: #28a745; width: {{ $registeredPercent }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Performance Summary -->
                                <!-- Performance Summary -->
<div class="mt-auto pt-2 border-top" style="border-color: #f1f3f4 !important;">
    <div class="row text-center">
        <div class="col-6">
            <div class="border-end" style="border-color: #f1f3f4 !important;">
                <div class="fw-bold text-primary" style="font-size: 16px;">{{ $monthlyInquiryCount }}</div>
                <small class="text-muted" style="font-size: 11px;">{{ $monthName }} Inquiries</small>
            </div>
        </div>
        <div class="col-6">
            <div class="fw-bold text-success" style="font-size: 16px;">{{ $monthlyRegisteredCount }}</div>
            <small class="text-muted" style="font-size: 11px;">{{ $monthName }} Registered</small>
        </div>
    </div>
</div>
                            </div>

                            <!-- View Button -->
                            <div class="card-footer bg-white border-0 py-2" style="border-radius: 0 0 12px 12px !important;">
                                <a href="{{ route('admin.teamreports', ['team' => $team->id]) }}" 
                                   class="btn btn-primary w-100 fw-semibold d-flex align-items-center justify-content-center"
                                   style="transition: all 0.3s ease; font-size: 13px; padding: 6px 12px;"
                                   onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(115, 103, 240, 0.3)';"
                                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                    <i class="fas fa-chart-line me-2"></i> View Report
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($teams->count() === 0)
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-layer-group fa-3x text-muted opacity-50"></i>
                    </div>
                    <h5 class="text-muted mb-2">No Teams Available</h5>
                    <p class="text-muted mb-3">Create teams to organize your counselors</p>
                    <a href="{{ route('admin.teams') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Create Team
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.card {
    border-radius: 12px;
}

.status-bars .progress {
    border-radius: 2px;
}

.status-bars .progress-bar {
    border-radius: 2px;
    transition: width 0.6s ease;
}

/* Custom scrollbar for counselors list */
.card-body div[style*="overflow-y: auto"]::-webkit-scrollbar {
    width: 3px;
}

.card-body div[style*="overflow-y: auto"]::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.card-body div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 2px;
}

.card-body div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

/* Smooth hover effects */
.card:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.card {
    border-radius: 12px;
}

.status-bars .progress {
    border-radius: 3px;
}

.status-bars .progress-bar {
    border-radius: 3px;
    transition: width 0.6s ease;
}

/* Custom scrollbar for counselors list */
.card-body div[style*="overflow-y: auto"]::-webkit-scrollbar {
    width: 4px;
}

.card-body div[style*="overflow-y: auto"]::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.card-body div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 2px;
}

.card-body div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

/* Smooth hover effects */
.card:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>
<div class="row mb-4">
                    <div class="col-12">
                        <hr class="border-1 border-secondary opacity-25">
                    </div>
                </div>

                <!-- Quick Overview Section -->
                <div class="row">
                    <!-- Recent Inquiries -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header mb-4 border-0 py-3 d-flex align-items-center justify-content-between"
                                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eaf4ff 100%); border-bottom: 2px solid #7367F0;">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                         style="width: 38px; height: 38px; background-color: rgba(40, 70, 167, 0.1);">
                                        <i class="fas fa-headset text-primary fs-5"></i>
                                    </div>
                                    <h5 class="mb-0 fw-semibold text-dark">Recent Inquiries</h5>
                                </div>
                                <a href="{{ route('admin.inquiries') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt me-1"></i> View All
                                </a>
                            </div>

                            <div class="card-body">
                                @if($recentInquiries->count() > 0)
                                    @foreach($recentInquiries as $inquiry)
                                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    @if(!empty($inquiry->name))
                                                        <h6 class="mb-1 fw-semibold">{{ $inquiry->name }}</h6>
                                                    @else
                                                        <span class="badge bg-secondary text-uppercase" 
                                                              style="font-size: 0.7rem;">NULL</span>
                                                    @endif
                                                </div>
                                                <small class="text-muted">
                                                    {{ $inquiry->phone_number ?? '—' }} • 
                                                    {{ \Carbon\Carbon::parse($inquiry->created_at)->diffForHumans() }}
                                                </small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                @if($inquiry->inquiry_status === 'pending' || is_null($inquiry->inquiry_status))
                                                    <span class="badge" 
                                                          style="background-color: {{ $this->getInquiryStatusColor($inquiry->inquiry_status) }}; color: black;">
                                                        <i class="fas {{ $this->getInquiryStatusIcon($inquiry->inquiry_status) }} me-1"></i>
                                                        {{ ucfirst($inquiry->inquiry_status ?? 'pending') }}
                                                    </span>
                                                @else
                                                    <span class="badge" 
                                                          style="background-color: {{ $this->getInquiryStatusColor($inquiry->inquiry_status) }}; color: white;">
                                                        <i class="fas {{ $this->getInquiryStatusIcon($inquiry->inquiry_status) }} me-1"></i>
                                                        {{ ucfirst($inquiry->inquiry_status) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No inquiries yet</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Recent Applications -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header mb-4 border-0 py-3 d-flex align-items-center justify-content-between"
                                 style="background: linear-gradient(90deg, #f8f9fa 0%, #f1fff3 100%); border-bottom: 2px solid #28a745;">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                         style="width: 38px; height: 38px; background-color: rgba(40,167,69,0.1);">
                                        <i class="fas fa-file-alt text-success fs-5"></i>
                                    </div>
                                    <h5 class="mb-0 fw-semibold text-dark">Recent Applications</h5>
                                </div>
                                <a href="{{ route('admin.all-applications') }}" class="btn btn-sm btn-outline-success">
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
                                                <div class="d-flex align-items-center gap-2">
                                                    @if(!empty($application->student_name))
                                                        <h6 class="mb-1 fw-semibold">{{ $application->student_name }}</h6>
                                                    @else
                                                        <span class="badge bg-secondary text-uppercase" 
                                                              style="font-size: 0.7rem;">NULL</span>
                                                    @endif
                                                </div>
                                                <small class="text-muted">
                                                    {{ $application->university_name ?? '—' }} • 
                                                    {{ \Carbon\Carbon::parse($application->created_at)->diffForHumans() }}
                                                </small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="badge" 
                                                      style="background-color: {{ $this->getApplicationStatusColor($application->inquiry_status) }}; color: white;">
                                                    <i class="fas {{ $this->getApplicationStatusIcon($application->inquiry_status) }} me-1"></i>
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
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.card {
    border-radius: 12px;
}

.badge {
    font-size: 11px;
    padding: 4px 8px;
}

.progress {
    border-radius: 2px;
}

.progress-bar {
    border-radius: 2px;
    transition: width 0.6s ease;
}
</style>
</div>