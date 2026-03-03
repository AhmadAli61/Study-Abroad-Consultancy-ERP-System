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
                            Comprehensive overview of team performance, assignments, and monthly progress
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
      <div class="row mb-2">
    <div class="col-12 mb-4">
        <!-- Modern Header with Glassmorphism Effect -->
        <div class="d-flex justify-content-between align-items-center p-4 rounded-3" 
             style="background: rgba(115, 103, 240, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(115, 103, 240, 0.1);">
            <div class="d-flex align-items-center">
                <div class="me-3 rounded-2 d-flex align-items-center justify-content-center" 
                     style="width: 54px; height: 54px; background: linear-gradient(135deg, #7367F0 0%, #9B8FFF 100%); box-shadow: 0 8px 15px rgba(115, 103, 240, 0.2);">
                    <i class="fas fa-user-graduate text-white fs-4"></i>
                </div>
                <div>
                    <h4 class="mb-1 fw-bold" style="color: #2d2d3a; font-size: 1.5rem;">Students Overview</h4>
                    <p class="text-muted mb-0 small" style="letter-spacing: 0.3px;">
                        <i class="fas fa-circle me-2" style="color: #7367F0; font-size: 6px;"></i>
                        Parent records and student analytics dashboard
                    </p>
                </div>
            </div>
            <a href="#" 
               class="btn px-4 py-2 fw-semibold rounded-3 d-flex align-items-center"
               style="background: linear-gradient(135deg, #7367F0 0%, #9B8FFF 100%); color: white; border: none; box-shadow: 0 6px 12px rgba(115, 103, 240, 0.25); transition: all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(115, 103, 240, 0.35)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 12px rgba(115, 103, 240, 0.25)';">
               <i class="fas fa-external-link-alt me-2"></i> Manage Students
            </a>
        </div>
    </div>
    
    <!-- Main Students Card - EXACT 200px height -->
<div class="col-12 col-xl-4 mb-4">
    <div class="card border-0" style="border-radius: 24px; background: linear-gradient(145deg, #ffffff 0%, #f8f9ff 100%); box-shadow: 0 25px 40px -12px rgba(115, 103, 240, 0.25); overflow: hidden; height: 200px;">
        
        <!-- Decorative Top Bar -->
        <div style="height: 4px; background: linear-gradient(90deg, #7367F0, #9B8FFF, #B5A8FF, #7367F0); background-size: 300% 100%; animation: gradientShift 3s ease infinite; width: 100%;"></div>
        
        <div class="card-body p-3" style="height: 196px;">
            
            <a href="{{ route('admission.team.all-students') }}" class="text-decoration-none w-100 h-100">
                
                <div class="d-flex flex-column h-100">
                    
                    <!-- Top Row -->
                    <div class="d-flex justify-content-between align-items-center" style="height: 40px;">
                        <div class="position-relative">
                            <div style="position: absolute; top: -3px; left: -3px; right: -3px; bottom: -3px; background: linear-gradient(135deg, #7367F0, #9B8FFF); border-radius: 12px; opacity: 0.15; animation: pulse 2s infinite;"></div>
                            
                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #7367F0 0%, #9B8FFF 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 12px -5px rgba(115, 103, 240, 0.4); position: relative; z-index: 2;">
                                <i class="fas fa-user-graduate text-white" style="font-size: 16px;"></i>
                            </div>
                        </div>

                        <span class="badge px-2 py-1" style="background: rgba(115, 103, 240, 0.1); color: #7367F0; font-weight: 600; border-radius: 20px; font-size: 9px;">
                            <i class="fas fa-database me-1"></i> TOTAL
                        </span>
                    </div>
                    
                    <!-- Count & Title -->
                    <div class="text-center" style="height: 70px;">
                        <h1 class="fw-bold mb-0" style="font-size: 38px; line-height: 1.2; background: linear-gradient(135deg, #2d2d3a, #4a4a5a); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                            {{ $totalParentCount ?? $totalCount }}
                        </h1>
                        <h6 class="fw-semibold mt-0 mb-0" style="color: #2d2d3a; font-size: 14px;">
                            All Students
                        </h6>
                    </div>
                    
                    <!-- Bottom Section -->
                    <div class="mt-auto">
                        <button class="btn w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 border-0"
                                style="background: linear-gradient(135deg, #7367F0 0%, #9B8FFF 100%); color: white; border-radius: 10px; font-size: 11px; box-shadow: 0 4px 8px rgba(115, 103, 240, 0.2); transition: all 0.3s ease;"
                                onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 12px rgba(115, 103, 240, 0.3)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(115, 103, 240, 0.2)';">
                            <span>View All</span>
                            <i class="fas fa-arrow-right" style="font-size: 9px;"></i>
                        </button>
                    </div>

                </div>
            </a>
        </div>
    </div>
</div>

    
    <!-- Stats Cards - ALL EXACT 200px height with IDENTICAL structure -->
    <div class="col-12 col-xl-8 mb-4">
        <div class="row g-3 h-100">
            <!-- Active Students Card -->
            <div class="col-6 col-md-3">
                <div class="card border-0" style="border-radius: 24px; background: white; box-shadow: 0 15px 30px -8px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 200px;">
                    <div class="card-body p-3 d-flex flex-column" style="height: 200px;">
                        <!-- Top Row - Fixed height 40px -->
                        <div class="d-flex justify-content-between align-items-center" style="height: 40px;">
                            <div style="width: 36px; height: 36px; background: rgba(115, 103, 240, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-check" style="color: #7367F0; font-size: 16px;"></i>
                            </div>
                            <span class="badge px-2 py-1" style="background: rgba(115, 103, 240, 0.1); color: #7367F0; font-weight: 600; border-radius: 20px; font-size: 9px;">ACTIVE</span>
                        </div>
                        
                        <!-- Middle - Fixed height 70px -->
                        <div class="text-start" style="height: 70px;">
                            <h2 class="fw-bold mb-0" style="color: #2d2d3a; font-size: 32px;">{{ $totalParentCount ?? $totalCount }}</h2>
                            <p class="text-muted mb-0" style="font-size: 11px;">Active Students</p>
                        </div>
                        
                        <!-- Bottom - Fixed height 70px with mt-auto -->
                        <div class="mt-auto" style="height: 70px;">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted" style="font-size: 8px;">Occupancy</small>
                                <small class="fw-semibold" style="color: #7367F0; font-size: 9px;">100%</small>
                            </div>
                            <div class="progress" style="height: 4px; background: #f0f0f5; border-radius: 10px;">
                                <div class="progress-bar" style="width: 100%; background: linear-gradient(90deg, #7367F0, #9B8FFF); border-radius: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- With Applications Card -->
            <div class="col-6 col-md-3">
                <div class="card border-0" style="border-radius: 24px; background: white; box-shadow: 0 15px 30px -8px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 200px;">
                    <div class="card-body p-3 d-flex flex-column" style="height: 200px;">
                        <!-- Top Row - Fixed height 40px -->
                        <div class="d-flex justify-content-between align-items-center" style="height: 40px;">
                            <div style="width: 36px; height: 36px; background: rgba(40, 167, 69, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-file-alt" style="color: #28a745; font-size: 16px;"></i>
                            </div>
                            <span class="badge px-2 py-1" style="background: rgba(40, 167, 69, 0.1); color: #28a745; font-weight: 600; border-radius: 20px; font-size: 9px;">APPS</span>
                        </div>
                        
                        <!-- Middle - Fixed height 70px -->
                        <div class="text-start" style="height: 70px;">
                            <h2 class="fw-bold mb-0" style="color: #2d2d3a; font-size: 32px;">{{ $totalCount }}</h2>
                            <p class="text-muted mb-0" style="font-size: 11px;">With Applications</p>
                        </div>
                        
                        @php
                            $appPercentage = $totalParentCount > 0 ? round(($totalCount / $totalParentCount) * 100) : 0;
                        @endphp
                        <!-- Bottom - Fixed height 70px with mt-auto -->
                        <div class="mt-auto" style="height: 70px;">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted" style="font-size: 8px;">Coverage</small>
                                <small class="fw-semibold text-success" style="font-size: 9px;">{{ $appPercentage }}%</small>
                            </div>
                            <div class="progress" style="height: 4px; background: #f0f0f5; border-radius: 10px;">
                                <div class="progress-bar bg-success" style="width: {{ $appPercentage }}%; border-radius: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Enrolled Card -->
            <div class="col-6 col-md-3">
                <div class="card border-0" style="border-radius: 24px; background: white; box-shadow: 0 15px 30px -8px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 200px;">
                    <div class="card-body p-3 d-flex flex-column" style="height: 200px;">
                        <!-- Top Row - Fixed height 40px -->
                        <div class="d-flex justify-content-between align-items-center" style="height: 40px;">
                            <div style="width: 36px; height: 36px; background: rgba(23, 162, 184, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-graduate" style="color: #17a2b8; font-size: 16px;"></i>
                            </div>
                            <span class="badge px-2 py-1" style="background: rgba(23, 162, 184, 0.1); color: #17a2b8; font-weight: 600; border-radius: 20px; font-size: 9px;">ENROLL</span>
                        </div>
                        
                        <!-- Middle - Fixed height 70px -->
                        <div class="text-start" style="height: 70px;">
                            <h2 class="fw-bold mb-0" style="color: #2d2d3a; font-size: 32px;">{{ $enrollmentCount }}</h2>
                            <p class="text-muted mb-0" style="font-size: 11px;">Enrolled Students</p>
                        </div>
                        
                        @php
                            $enrollPercentage = $totalCount > 0 ? round(($enrollmentCount / $totalCount) * 100) : 0;
                        @endphp
                        <!-- Bottom - Fixed height 70px with mt-auto -->
                        <div class="mt-auto" style="height: 70px;">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted" style="font-size: 8px;">Rate</small>
                                <small class="fw-semibold text-info" style="font-size: 9px;">{{ $enrollPercentage }}%</small>
                            </div>
                            <div class="progress" style="height: 4px; background: #f0f0f5; border-radius: 10px;">
                                <div class="progress-bar bg-info" style="width: {{ $enrollPercentage }}%; border-radius: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conversion Rate Card -->
            <div class="col-6 col-md-3">
                <div class="card border-0" style="border-radius: 24px; background: white; box-shadow: 0 15px 30px -8px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 200px;">
                    <div class="card-body p-3 d-flex flex-column" style="height: 200px;">
                        <!-- Top Row - Fixed height 40px -->
                        <div class="d-flex justify-content-between align-items-center" style="height: 40px;">
                            <div style="width: 36px; height: 36px; background: rgba(255, 193, 7, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-chart-line" style="color: #ffc107; font-size: 16px;"></i>
                            </div>
                            <span class="badge px-2 py-1" style="background: rgba(255, 193, 7, 0.1); color: #ffc107; font-weight: 600; border-radius: 20px; font-size: 9px;">RATE</span>
                        </div>
                        
                        @php
                            $conversionRate = $totalCount > 0 ? round(($enrollmentCount / $totalCount) * 100, 1) : 0;
                        @endphp
                        <!-- Middle - Fixed height 70px -->
                        <div class="text-start" style="height: 70px;">
                            <h2 class="fw-bold mb-0" style="color: #2d2d3a; font-size: 32px;">{{ $conversionRate }}%</h2>
                            <p class="text-muted mb-0" style="font-size: 11px;">Conversion Rate</p>
                        </div>
                        
                        <!-- Bottom - Fixed height 70px with mt-auto -->
                        <div class="mt-auto" style="height: 70px;">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted" style="font-size: 8px;">Target 50%</small>
                                <small class="fw-semibold text-warning" style="font-size: 9px;">{{ $conversionRate }}%</small>
                            </div>
                            <div class="progress" style="height: 4px; background: #f0f0f5; border-radius: 10px;">
                                <div class="progress-bar bg-warning" style="width: {{ min($conversionRate, 100) }}%; border-radius: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>

<!-- Add enhanced animations -->
<style>
@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 0.15;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.25;
    }
    100% {
        transform: scale(1);
        opacity: 0.15;
    }
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Ensure all cards have equal height */
.row.g-3 > [class*="col-"] {
    display: flex;
}

.row.g-3 > [class*="col-"] > .card {
    width: 100%;
}

/* Smooth transitions */
.card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* Hover effect for cards */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 35px -8px rgba(115, 103, 240, 0.2) !important;
}
</style>
    
    <!-- Divider between Students and Applications sections -->
    <div class="row mb-4">
        <div class="col-12">
            <hr class="border-1 border-secondary opacity-25">
        </div>
    </div>
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

        <a href="{{ route('admission.team.all-applications') }}" 
           class="btn btn-sm fw-semibold d-flex align-items-center"
           style="background-color: #ffffff; color: #7367F0; border: 1px solid #dee2e6; 
                  transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.05);"
           onmouseover="this.style.backgroundColor='#7367F0'; this.style.color='white'; this.style.borderColor='#7367F0';"
           onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#7367F0'; this.style.borderColor='#dee2e6';">
           <i class="fas fa-external-link-alt me-2"></i> Manage All
        </a>
    </div>
</div>
            <!-- Application Status Cards (Your existing cards) -->
            <div class="d-flex flex-wrap justify-content-center" style="gap: 10px;">
                <!-- All Applications Card -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.all-applications') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #34A853; height: 140px; border: none; 
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-clipboard-list" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $totalCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>All Applications</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #34A853; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Under Assessment -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.under-assessment') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #517577; height: 140px; border: none; 
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-hourglass-half" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $underAssessmentCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Under Assessment</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #517577; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Processed -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.processed') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #09122C; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-tasks" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $processedCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Processed</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #09122C; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Conditional Offers -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.conditional-offers') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #27391C; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-file-signature" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $conditionalCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Conditional Offers</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #27391C; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Unconditional Offers -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.unconditional-offers') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #87431D; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-file-contract" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $unconditionalCount }}</h4>
                                </div>
                                <h6 class="mt-2 mb-0 text-white" style="font-size: 16px;"><strong>Unconditional Offers</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #87431D; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Under CAS -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.under-cas') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #C69749; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-passport" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $underCasCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Under CAS</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #C69749; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- CAS Received -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.cas-received') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #828383; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-file-invoice" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $casDocumentCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>CAS Received</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #828383; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Visa Process -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.visa-process') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #673AB7; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-stamp" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $visaProcessCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Visa Process</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #673AB7; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Enrollment -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.enrollment') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #009688; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-user-graduate" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $enrollmentCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Enrollment</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #009688; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Case Closed -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.team.case-closed') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #c01414; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-archive" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $caseClosedCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Case Closed</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #c01414; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Rejection -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.rejection') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #ff0000; height: 140px; border: none;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-times-circle" style="font-size: 20px;"></i>
                                    <h4 class="fw-bold m-0 text-white" style="font-size: 20px;">{{ $rejectedCount }}</h4>
                                </div>
                                <h6 class="mt-3 mb-0 text-white" style="font-size: 16px;"><strong>Rejection</strong></h6>
                                <button class="btn btn-sm mt-3 px-2 py-1"
                                        style="background-color: white; color: #ff0000; font-size: 12px; border: none; border-radius: 4px;">
                                    View All
                                </button>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Withdrawn Applications -->
    <div style="flex: 1 0 14%; min-width: 140px; margin: 0 4px 15px 4px;">
                    <a href="{{ route('admission.withdrawn') }}" class="text-decoration-none">
                        <div class="card d-flex align-items-center justify-content-center text-center"
                             style="background-color: #ff5252; height: 140px; border: none;
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
            <div class="row mb-4">
    <div class="col-12">
        <hr class="border-1 border-secondary opacity-25">
    </div>
</div>
<!-- Staff Performance Dashboard (Your existing staff performance table) -->
            <div class="py-1 mb-3">
                <div class="performance-card">
                    <div class="card-header-gradient d-flex justify-content-between align-items-center py-3 px-4">
                        <div class="d-flex align-items-center">
                            <div class="header-icon-container me-3">
                                <i class="fas fa-chart-line fa-lg text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-white fw-bold">Admission Team Performance Dashboard</h5>
                                <small class="text-white-50">Comprehensive overview of team metrics and achievements</small>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <div class="d-flex mb-2 mb-md-0 me-md-3">
                                <span class="badge bg-light text-dark px-3 py-2 me-2">
                                    <i class="fas fa-trophy me-1 text-warning"></i>Max: {{ max(array_column($staffCounts, 'total')) }}
                                </span>
                                <span class="badge bg-light text-dark px-3 py-2">
                                    <i class="fas fa-chart-bar me-1 text-primary"></i>Avg: {{ round(array_sum(array_column($staffCounts, 'total')) / count($staffCounts)) }}
                                </span>
                            </div>
                            <div class="header-stats-divider d-none d-md-block"></div>
                            <div class="d-flex">
                                <span class="badge bg-white bg-opacity-25 text-dark px-3 py-2">
                                    <i class="fas fa-users me-1 text-dark"></i>{{ count($staffCounts) }} Team Members
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-2">
                        <!-- Compact Table -->
                        <div class="table-container">
                            <table class="table compact-table table-sm table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="staff-name-cell text-center ps-2 ">Staff Member<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Name)</small></th>
                                        <th title="Under Assessment">UA<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Underassessment)</small></th>
                                        <th title="Processed">PR<br><small class="text-muted fw-normal" style="font-size: 0.6rem;">(Processed)</small></th>
                                        <th title="Conditional">CO<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Conditional)</small></th>
                                        <th title="Unconditional">UC<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Unconditional)</small></th>
                                        <th title="Under CAS">UCS<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Undercas)</small></th>
                                        <th title="CAS Received">CR<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Casreceived)</small></th>
                                        <th title="Visa Process">VP<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Visaprocess)</small></th>
                                        <th title="Enrollment">EN<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Enrollment)</small></th>
                                        <th title="Case Closed">CC<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Caseclosed)</small></th>
                                        <th class="total-cell text-center">Total<br><small class="text-muted fw-normal" style="font-size: 0.65rem;">(Numbers)</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($staffCounts as $staff)
                                    <tr>
                                        <td class="staff-name-cell text-start ps-2">
                                            <span class="d-inline-block text-truncate" style="max-width: 110px;" title="{{ $staff['name'] }}">
                                                {{ $staff['name'] }}
                                                @if($staff['role'] === 'admission')
                                                    <small class="badge bg-success ms-1">MGR</small>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="value-cell">{{ $staff['underassessment'] }}</td>
                                        <td class="value-cell">{{ $staff['processed'] }}</td>
                                        <td class="value-cell">{{ $staff['conditional'] }}</td>
                                        <td class="value-cell">{{ $staff['unconditional'] }}</td>
                                        <td class="value-cell">{{ $staff['undercas'] }}</td>
                                        <td class="value-cell">{{ $staff['casreceived'] }}</td>
                                        <td class="value-cell">{{ $staff['visaprocess'] }}</td>
                                        <td class="value-cell">{{ $staff['enrollment'] }}</td>
                                        <td class="value-cell">{{ $staff['caseclosed'] }}</td>
                                        <td class="total-cell text-center fw-bold">{{ $staff['total'] }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center py-3 text-muted">
                                            <i class="fas fa-users me-1"></i> No admission staff found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Summary Stats -->
                        <div class="summary-bar d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i> Showing {{ count($staffCounts) }} team members
                            </small>
                            <div class="d-flex mt-2 mt-md-0">
                                <span class="badge bg-light text-dark badge-custom me-2">
                                    Max: {{ max(array_column($staffCounts, 'total')) }}
                                </span>
                                <span class="badge bg-light text-dark badge-custom">
                                    Avg: {{ round(array_sum(array_column($staffCounts, 'total')) / count($staffCounts)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="mt-2 d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Performance metrics by team member</small>
                    </div>
                    <div>
                        <small class="text-muted me-2">Abbreviations:</small>
                        <small class="badge bg-light text-dark me-1" title="Case Closed">CC</small>
                        <small class="badge bg-light text-dark me-1" title="CAS Received">CR</small>
                        <small class="badge bg-light text-dark me-1" title="Conditional">CO</small>
                        <small class="badge bg-light text-dark me-1" title="Enrollment">EN</small>
                        <small class="badge bg-light text-dark me-1" title="Processed">PR</small>
                        <small class="badge bg-light text-dark me-1" title="Unconditional">UC</small>
                        <small class="badge bg-light text-dark me-1" title="Under Assessment">UA</small>
                        <small class="badge bg-light text-dark me-1" title="Under CAS">UCS</small>
                        <small class="badge bg-light text-dark me-1" title="Visa Process">VP</small>
                    </div>
                </div>
            </div>
                    <div class="row mb-4">
    <div class="col-12">
        <hr class="border-1 border-secondary opacity-25">
    </div>
</div>

            <!-- Enhanced Monthly Progress & Team Performance Section -->
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
                                <h5 class="mb-0 fw-semibold text-dark">Team Performance & Monthly Progress Dashboard</h5>
                            </div>
                          
                        </div>

                        <div class="card-body" id="dashboardSection">
                            <!-- Performance Summary Cards -->
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card border-0 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <div class="card-body text-white text-center">
                                            <div class="d-flex align-items-center justify-content-center mb-2">
                                                <i class="fas fa-users fa-2x me-2"></i>
                                                <h3 class="mb-0 text-white">{{ $teamPerformance['total_agents'] }}</h3>
                                            </div>
                                            <p class="mb-0 fw-semibold">Total Team Members</p>
                                            <small class="opacity-75 text-white">{{ $teamPerformance['active_agents'] }} Active</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card border-0 h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                        <div class="card-body text-white text-center">
                                            <div class="d-flex align-items-center justify-content-center mb-2">
                                                <i class="fas fa-user-check fa-2x me-2"></i>
                                                <h3 class="mb-0 text-white">{{ $assignmentMetrics['total_assigned'] }}</h3>
                                            </div>
                                            <p class="mb-0 fw-semibold">Assigned Applications</p>
                                            <small class="opacity-75">{{ $assignmentMetrics['total_unassigned'] }} Unassigned</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card border-0 h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                        <div class="card-body text-white text-center">
                                            <div class="d-flex align-items-center justify-content-center mb-2">
                                                <i class="fas fa-exchange-alt fa-2x me-2"></i>
                                                <h3 class="mb-0 text-white">{{ $reassignmentStats->total_reassignments ?? 0 }}</h3>
                                            </div>
                                            <p class="mb-0 fw-semibold">Total Reassignments</p>
                                            <small class="opacity-75">{{ $reassignmentStats->affected_agents ?? 0 }} Agents Affected</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card border-0 h-100" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                        <div class="card-body text-white text-center">
                                            <div class="d-flex align-items-center justify-content-center mb-2">
                                                <i class="fas fa-trophy fa-2x me-2"></i>
                                                <h3 class="mb-0 text-white">{{ $teamPerformance['highest_performing_agent']['total'] }}</h3>
                                            </div>
                                            <p class="mb-0 fw-semibold">Top Performer</p>
                                            <small class="opacity-75">{{ $teamPerformance['highest_performing_agent']['name'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly Progress Chart -->
                            @if($monthlyProgress && count($monthlyProgress) > 0)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm">
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
                            @endif

                            <!-- Assignment & Reassignment Metrics -->
                           <div class="row mb-4">
    <!-- Assignment Metrics -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header mb-3 border-0 py-3 d-flex align-items-center justify-content-between"
                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eaf4ff 100%); border-bottom: 2px solid #7367F0;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width: 38px; height: 38px; background-color: rgba(115,103,240,0.1);">
                        <i class="fas fa-tasks text-primary fs-5"></i>
                    </div>
                    <h5 class="mb-0 fw-semibold text-dark">Assignment Metrics</h5>
                </div>
            </div>

            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded">
                            <i class="fas fa-user-check fa-2x text-success mb-2"></i>
                            <h6 class="fw-bold">Assigned</h6>
                            <p class="mb-1 text-success fw-semibold">{{ $assignmentMetrics['total_assigned'] }}</p>
                            <small class="text-muted">Total Applications</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded">
                            <i class="fas fa-user-times fa-2x text-danger mb-2"></i>
                            <h6 class="fw-bold">Unassigned</h6>
                            <p class="mb-1 text-danger fw-semibold">{{ $assignmentMetrics['total_unassigned'] }}</p>
                            <small class="text-muted">Pending Assignment</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded">
                            <i class="fas fa-calendar-plus fa-2x text-info mb-2"></i>
                            <h6 class="fw-bold">This Month</h6>
                            <p class="mb-1 text-info fw-semibold">{{ $assignmentMetrics['assignments_this_month'] }}</p>
                            <small class="text-muted">New Assignments</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded">
                            <i class="fas fa-sync-alt fa-2x text-warning mb-2"></i>
                            <h6 class="fw-bold">Reassignments</h6>
                            <p class="mb-1 text-warning fw-semibold">{{ $assignmentMetrics['reassignments_this_month'] }}</p>
                            <small class="text-muted">This Month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Performance Overview -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header mb-3 border-0 py-3 d-flex align-items-center justify-content-between"
                 style="background: linear-gradient(90deg, #f8f9fa 0%, #eaf4ff 100%); border-bottom: 2px solid #7367F0;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width: 38px; height: 38px; background-color: rgba(115,103,240,0.1);">
                        <i class="fas fa-chart-pie text-primary fs-5"></i>
                    </div>
                    <h5 class="mb-0 fw-semibold text-dark">Team Performance Overview</h5>
                </div>
            </div>

            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded">
                            <i class="fas fa-user-graduate fa-2x text-primary mb-2"></i>
                            <h6 class="fw-bold">Avg. per Agent</h6>
                            <p class="mb-1 text-primary fw-semibold">{{ $teamPerformance['avg_applications_per_agent'] }}</p>
                            <small class="text-muted">Applications</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded">
                            <i class="fas fa-clock fa-2x text-secondary mb-2"></i>
                            <h6 class="fw-bold">Avg. Time</h6>
                            <p class="mb-1 text-secondary fw-semibold">{{ round($reassignmentStats->avg_reassignment_time ?? 0) }} days</p>
                            <small class="text-muted">Reassignment</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded">
                            <i class="fas fa-users-cog fa-2x text-warning mb-2"></i>
                            <h6 class="fw-bold">Active Agents</h6>
                            <p class="mb-1 text-warning fw-semibold">{{ $teamPerformance['active_agents'] }}</p>
                            <small class="text-muted">Currently Working</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded">
                            <i class="fas fa-chart-line fa-2x text-success mb-2"></i>
                            <h6 class="fw-bold">Team Efficiency</h6>
                            <p class="mb-1 text-success fw-semibold">
                                @php
                                    $efficiency = $teamPerformance['active_agents'] > 0 ? 
                                        round(($assignmentMetrics['total_assigned'] / $teamPerformance['active_agents']), 1) : 0;
                                @endphp
                                {{ $efficiency }}
                            </p>
                            <small class="text-muted">Apps per Active Agent</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                            <!-- Top Performers -->
                            @if(count($topPerformers) > 0)
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="fw-semibold mb-3 text-center">
                                                <i class="fas fa-trophy me-2 text-warning"></i>
                                                Top Performers This Month
                                            </h6>
                                            <div class="row">
                                                @foreach($topPerformers as $index => $performer)
                                                <div class="col-md-4 mb-3">
                                                    <div class="p-3 border rounded text-center position-relative">
                                                        @if($index == 0)
                                                        <div class="position-absolute top-0 start-50 translate-middle">
                                                            <i class="fas fa-crown fa-lg text-warning"></i>
                                                        </div>
                                                        @endif
                                                        <div class="avatar mb-2 mx-auto" 
                                                             style="width: 60px; height: 60px; background: linear-gradient(135deg, 
                                                             @if($index == 0) #FFD700 @elseif($index == 1) #C0C0C0 @else #CD7F32 @endif, 
                                                             @if($index == 0) #FFEC8B @elseif($index == 1) #E8E8E8 @else #E8B16F @endif); 
                                                             border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 20px;">
                                                            {{ strtoupper(substr($performer['name'], 0, 1)) }}
                                                        </div>
                                                        <h6 class="fw-bold mb-1">{{ $performer['name'] }}</h6>
                                                        <p class="mb-1 text-primary fw-semibold">{{ $performer['total'] }} Applications</p>
                                                        <small class="text-muted">
                                                            @if($performer['role'] === 'admission')
                                                                Manager
                                                            @else
                                                                Agent
                                                            @endif
                                                        </small>
                                                        <div class="mt-2">
                                                            <small class="text-success">
                                                                <i class="fas fa-check-circle me-1"></i>
                                                                {{ $performer['caseclosed'] ?? 0 }} Completed
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>

<!-- Add CSS Styles -->
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #c8c4fc 100%) !important;
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

/* Collapsible functionality */
.collapsed-view .progress-item {
    margin-bottom: 10px;
}

.collapsed-view .progress-bar {
    height: 20px;
}

/* Performance card styles */
:root {
    --primary: #4e73df;
    --primary-light: #7a98f9;
    --secondary: #6f42c1;
    --success: #1cc88a;
    --info: #36b9cc;
    --warning: #f6c23e;
    --danger: #e74a3b;
    --light: #f8f9fc;
    --dark: #5a5c69;
    --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.performance-card {
    border-radius: 0.5rem;
    box-shadow: var(--card-shadow);
    overflow: hidden;
    background: #fff;
}

.card-header-gradient {
background: linear-gradient(135deg, #7367F0 50%, #9E95F5 100%);
    border: none;
    padding: 0.6rem 1rem;
}

.compact-table {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

.compact-table th {
    font-weight: 600;
    background-color: #f8f9fa;
    position: sticky;
    top: 0;
    z-index: 10;
    padding: 0.5rem 0.4rem;
    border-bottom: 2px solid #eaecf4;
    font-size: 0.75rem;
    text-align: center;
}

.compact-table td {
    padding: 0.4rem;
    vertical-align: middle;
    text-align: center;
    border-bottom: 1px solid #eaecf4;
}

.staff-name-cell {
    position: sticky;
    left: 0;
    background: white;
    z-index: 5;
    min-width: 120px;
    text-align: left;
    padding-left: 0.8rem;
    box-shadow: 2px 0 3px rgba(0,0,0,0.05);
}

.total-cell {
    position: sticky;
    right: 0;
    background: white;
    z-index: 5;
    font-weight: 700;
    background-color: rgba(13, 110, 253, 0.08);
    box-shadow: -2px 0 3px rgba(0,0,0,0.05);
}

.table-container {
    max-height: 400px;
    overflow: auto;
}

.summary-bar {
    background: var(--light);
    border-radius: 0.35rem;
    padding: 0.6rem 1rem;
    margin-top: 0.8rem;
    font-size: 0.8rem;
}

.badge-custom {
    padding: 0.3rem 0.6rem;
    border-radius: 0.3rem;
    font-weight: 600;
    font-size: 0.75rem;
}

.table-hover tbody tr:hover {
    background-color: rgba(78, 115, 223, 0.05);
}

.value-cell {
    font-weight: 500;
    transition: all 0.2s;
}

.value-cell:hover {
    background-color: rgba(78, 115, 223, 0.1);
    transform: scale(1.05);
}

/* Avatar styles */
.avatar {
    transition: all 0.3s ease;
}

.avatar:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(115, 103, 240, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(115, 103, 240, 0); }
    100% { box-shadow: 0 0 0 0 rgba(115, 103, 240, 0); }
}

.current-month {
    animation: pulse 2s infinite;
}

@media (max-width: 768px) {
    .table-container {
        max-height: 350px;
    }
    
    .compact-table th, .compact-table td {
        padding: 0.3rem;
        font-size: 0.7rem;
    }
    
    .staff-name-cell {
        min-width: 100px;
    }
    
    .monthly-progress-chart {
        max-height: 400px;
    }
}
</style>
</div>