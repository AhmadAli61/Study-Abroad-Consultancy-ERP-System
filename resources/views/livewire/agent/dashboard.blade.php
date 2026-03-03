<div><div class="card border-0 shadow-lg">
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
                            Here's your complete overview - inquiries, applications, and performance metrics
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block me-3">
                            <h3 class="mb-0 text-dark">{{ $totalLeads }}</h3>
                            <small class="opacity-75 text-dark">Total Inquiries</small>
                        </div>
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
            <!-- Inquiry Management Cards -->
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
                <p class="text-muted mb-0 small">Manage student inquiries and leads</p>
            </div>
        </div>
        <a href="{{ route('agent.inquiries') }}" 
           class="btn btn-sm fw-semibold"
           style="background-color: #ffffff; color: #7367F0; border: 1px solid #dee2e6; transition: all 0.3s ease;"
           onmouseover="this.style.backgroundColor='#7367F0'; this.style.color='white'; this.style.borderColor='#0d6efd';"
           onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#7367F0'; this.style.borderColor='#dee2e6';">
           <i class="fas fa-external-link-alt me-1"></i> Manage All
        </a>
    </div>
</div>

                
                <!-- Your existing inquiry cards (unchanged) -->
                <div class="row mb-2 d-flex justify-content-between flex-wrap" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                    {{-- Total Inquiries --}}
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.inquiries') }}" class="text-decoration-none">
                            <div class="card text-center bg-primary"
                                 style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-list fa-2x" style="color: white;"></i>
                                        <h3 class="fw-bold m-0" style="color: white;">{{ $totalLeads }}</h3>
                                    </div>
                                    <h6 class="mt-3 mb-0 text-white"><strong>All Inquiries</strong></h6>
                                    <button class="btn btn-sm mt-3 text-primary"
                                            style="background-color: white; font-size: 11px;">View All</button>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Hot Leads --}}
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.inquiry.hot') }}" class="text-decoration-none">
                            <div class="card text-center"
                                 style="background-color: #ff5722; height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-fire fa-2x" style="color: white;"></i>
                                        <h3 class="fw-bold m-0" style="color: white;">{{ $hotLeads }}</h3>
                                    </div>
                                    <h6 class="mt-3 mb-0 text-white"><strong>Hot</strong></h6>
                                    <button class="btn btn-sm mt-3"
                                            style="background-color: white; color: #ff5722; font-size: 11px;">View All</button>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Cold Leads --}}
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.inquiry.cold') }}" class="text-decoration-none">
                            <div class="card text-center bg-info"
                                 style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-snowflake fa-2x" style="color: white;"></i>
                                        <h3 class="fw-bold m-0" style="color: white;">{{ $coldLeads }}</h3>
                                    </div>
                                    <h6 class="mt-3 mb-0 text-white"><strong>Cold</strong></h6>
                                    <button class="btn btn-sm mt-3"
                                            style="background-color: white; color: #0dcaf0; font-size: 11px;">View All</button>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Dead Leads --}}
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.inquiry.dead') }}" class="text-decoration-none">
                            <div class="card text-center bg-dark"
                                 style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-times-circle fa-2x" style="color: white;"></i>
                                        <h3 class="fw-bold m-0" style="color: white;">{{ $deadLeads }}</h3>
                                    </div>
                                    <h6 class="mt-3 mb-0 text-white"><strong>Dead</strong></h6>
                                    <button class="btn btn-sm mt-3 text-dark"
                                            style="background-color: white; font-size: 11px;">View All</button>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Pending Leads --}}
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.inquiry.pending') }}" class="text-decoration-none">
                            <div class="card text-center"
                                 style="background-color: #ffc107; height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-hourglass-half fa-2x" style="color: black;"></i>
                                        <h3 class="fw-bold m-0" style="color: black;">{{ $pendingLeads }}</h3>
                                    </div>
                                    <h6 class="mt-3 mb-0" style="color: black;"><strong>Pending</strong></h6>
                                    <button class="btn btn-sm mt-3"
                                            style="background-color: white; color: black; font-size: 11px;">View All</button>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Registered Leads --}}
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission-dashboard')}}" class="text-decoration-none">
                            <div class="card text-center bg-success"
                                 style="height: 160px; border: none; box-shadow: 0 8px 8px rgba(0,0,0,0.4); color: white;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-user-check fa-2x" style="color: white;"></i>
                                        <h3 class="fw-bold m-0" style="color: white;">{{ $registeredLeads }}</h3>
                                    </div>
                                    <h6 class="mt-3 mb-0 text-white"><strong>Registered</strong></h6>
                                    <button class="btn btn-sm mt-3 text-success"
                                            style="background-color: white; font-size: 11px;">View All</button>
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

            <!-- Application Management Cards -->
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
                <p class="text-muted mb-0 small">Track application progress and status</p>
            </div>
        </div>
        <a href="{{ route('agent.admission-dashboard') }}" 
           class="btn btn-sm fw-semibold"
           style="background-color: #ffffff; color: #28a745; border: 1px solid #dee2e6; transition: all 0.3s ease;"
           onmouseover="this.style.backgroundColor='#28a745'; this.style.color='white'; this.style.borderColor='#28a745';"
           onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#28a745'; this.style.borderColor='#dee2e6';">
           <i class="fas fa-external-link-alt me-1"></i> Manage All
        </a>
    </div>
</div>

                
                <!-- Application status cards -->
                <div class="d-flex flex-wrap justify-content-start" style="gap: 15px;">
                    <!-- All Applications Card - Blue -->
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission-dashboard') }}" class="text-decoration-none">
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
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.under-assessment') }}" class="text-decoration-none">
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

                    <!-- Applications Processed Card - Green -->
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.processed') }}" class="text-decoration-none">
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
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.conditional-offers') }}" class="text-decoration-none">
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
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.unconditional-offers') }}" class="text-decoration-none">
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

                    <!-- Under CAS Card - Light Gray -->
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.under-cas') }}" class="text-decoration-none">
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
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.cas-received') }}" class="text-decoration-none">
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
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.visa-process') }}" class="text-decoration-none">
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
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.enrollment') }}" class="text-decoration-none">
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
                    <div style="flex: 1 0 15.5%; min-width: 150px; margin: 0 4px 15px 4px;">
                        <a href="{{ route('agent.admission.case-closed') }}" class="text-decoration-none">
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
            </div>
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
                <a href="{{ route('agent.inquiries') }}" class="btn btn-sm btn-outline-primary">
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
                <a href="{{ route('agent.admission-dashboard') }}" class="btn btn-sm btn-outline-success">
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




          <!-- Reports Section -->
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-primary border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">
                <i class="fas fa-chart-line me-2"></i>
                Recent Performance Reports
            </h5>
           <a href="{{ route('agent.allreports') }}" class="btn btn-sm custom-report-btn">
    <i class="fas fa-external-link-alt me-1"></i> View All Reports
</a>

<style>
.custom-report-btn {
    background-color: #f8f9fa;
    color: #7367F0;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.custom-report-btn:hover {
    background-color: #efeff5;
    color: rgb(103, 104, 104);
    border-color: #96969b;
    transform: translateY(-1px);
}
</style>
        </div>
    </div>
    <div class="card-body p-0">
        @if($reports->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="border-collapse: collapse;">
                    <thead class="bg-light">
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
                                                <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->total_inquiries_received ?? 0 }}</div>
                                                <small class="text-muted" style="font-size: 0.55rem;">Inquiries</small>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->inbound_calls ?? 0 }}</div>
                                                <small class="text-muted" style="font-size: 0.55rem;">Inbound</small>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->dial_calls ?? 0 }}</div>
                                                <small class="text-muted" style="font-size: 0.55rem;">Dial Calls</small>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->connect_calls ?? 0 }}</div>
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
                                                <div style="font-weight: 800; color: #2c3e50; font-size: 0.85rem; line-height: 1.1;">{{ $report->interested_followups ?? 0 }}</div>
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
                                                <span style="font-weight: 700; color: #e74c3c; font-size: 0.8rem;">{{ $report->hot_leads ?? 0 }}</span>
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
                                                <span style="font-weight: 700; color: #3498db; font-size: 0.8rem;">{{ $report->cold_leads ?? 0 }}</span>
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
                                                <span style="font-weight: 700; color: #95a5a6; font-size: 0.8rem;">{{ $report->dead_leads ?? 0 }}</span>
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
                                                <span style="font-weight: 700; color: #FFC107; font-size: 0.8rem;">{{ $report->pending_leads ?? 0 }}</span>
                                            </div>
                                            <div class="progress mt-1" style="height: 4px; background: rgba(253, 252, 171, 0.2);">
                                                <div class="progress-bar" style="background: #FFC107; width: {{ $report->total_leads > 0 ? ($report->pending_leads / $report->total_leads * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Total Summary -->
                                        <div class="mt-2 pt-2" style="border-top: 1px dashed #e0e0e0;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small style="font-size: 0.7rem; font-weight: 700; color: #2c3e50;">TOTAL</small>
                                                <span style="font-weight: 800; color: #2c3e50; font-size: 0.85rem;">{{ $report->total_leads ?? 0 }}</span>
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
        @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-chart-bar fa-3x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted mb-2">No Reports Available</h5>
                <p class="text-muted mb-3">Start creating reports to track your performance</p>
                <a href="{{ route('agent.allreports') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Create Report
                </a>
            </div>
        @endif
    </div>
    
    @if($reports->count() > 0)
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing latest {{ $reports->count() }} reports</small>
                <a href="{{ route('agent.allreports') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-list me-1"></i> View All Reports
                </a>
            </div>
        </div>
    @endif
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

.card {
    border-radius: 12px;
}
</style>
            <livewire:agent.modal.view-report-details />
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
</style>
</div>