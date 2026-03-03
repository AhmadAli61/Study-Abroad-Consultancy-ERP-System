<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-menu-collapsed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-no-customizer">
    <head>
        
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    
        <title>Affiliate Dashboard</title>
        <meta name="description" content="" />
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('build/assets/img/7skylogo.png') }}" />
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    
        <!-- Icons -->
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/fonts/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/fonts/tabler-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/fonts/flag-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/flatpickr/flatpickr.css') }}" />

        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
    
        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/css/rtl/core.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/css/rtl/theme-default.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/css/demo.css') }}" />
    
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/node-waves/node-waves.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/swiper/swiper.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
        
        <!-- Dropzone, Select2, Tagify -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/dropzone/dropzone.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/select2/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/tagify/tagify.css') }}" />
    
        <!-- Bootstrap Select (Bootstrap 5 Compatible) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" />
    
        <!-- Date/Time Pickers -->
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/pickr/pickr-themes.css') }}" />
    
        <!-- Page Specific CSS -->
        <link rel="stylesheet" href="{{ asset('build/assets/vendor/css/pages/cards-advance.css') }}" />
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    
        <!-- Helpers & Config -->
        <script src="{{ asset('build/assets/vendor/js/helpers.js') }}"></script>
        <script src="{{ asset('build/assets/js/config.js') }}"></script>
    
        <!-- Template Customizer -->
        <script src="{{ asset('build/assets/vendor/js/template-customizer.js') }}"></script>
    
        <!-- Bootstrap Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
        @livewireStyles
    </head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="#" class="app-brand-link">
                        <span class=" demo">
                            <img src="{{ asset('build/assets/img/7skylogo.png') }}" alt="7 Sky Logo" style="width: 50px; height: auto;">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold" style="
                            font-family: 'Lucida Handwriting', cursive; 
                            font-size: 15px; 
                            background: linear-gradient(to right, rgb(12, 32, 97), rgb(6, 156, 6)); 
                            -webkit-background-clip: text; 
                            -webkit-text-fill-color: transparent;">
                            CONSULTANCY
                            </span>
                    </a>
                    <a href="#" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item active open">
                        <a href="{{ route('externalagent.dashboard')}}" class="menu-link">
                            <i class="menu-icon fa-solid fa-house fs-6"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <!-- User Management -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
    <i class="menu-icon fa-solid fa-file-alt fs-6"></i>
    <div>Applications</div>
</a>


                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('externalagent.add-application')}}" class="menu-link">
                                    <i class="fa-solid fa-plus fa-xs me-2" style="color: #6c757d;"></i>
                                    <div style="color: #6c757d;">Add Application</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('externalagent.all-applications')}}" class="menu-link">
                                    <i class="fa-solid fa-list fa-xs me-2" style="color: #6c757d;;"></i>
                                    <div style="color: #6c757d;">All Applications</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href={{route('logout')}} class="menu-link">
                            <i class="menu-icon fa-solid fa-sign-out-alt fs-6"></i>
                            <div>Log Out</div>
                        </a>
                    </li>
                   <li class="menu-item mt-auto">
    <div class="menu-link d-flex align-items-center">
        <div class="avatar avatar-md me-2">
            <span class="avatar-initial rounded-circle bg-warning">
                {{ strtoupper(substr(Auth::user()->username ?? 'A', 1, 2)) }}
            </span>
        </div>
        <div class="d-flex flex-column">
            @if(Auth::check() && Auth::user()->username)
                @php
                    $username = trim(str_replace('@', '', Auth::user()->username));
                    
                    // Smart name splitting logic
                    $mainName = $username;
                    $secondaryName = '';
                    
                    // Strategy 1: Split by common separators first
                    $separators = [' ', '&', 'And', 'and', '+', '|', '/'];
                    foreach ($separators as $sep) {
                        if (str_contains($username, $sep)) {
                            $parts = explode($sep, $username, 2);
                            if (count($parts) === 2) {
                                $mainName = trim($parts[0]);
                                $secondaryName = trim($parts[1]);
                                break;
                            }
                        }
                    }
                    
                    // Strategy 2: Split by camelCase or PascalCase
                    if ($secondaryName === '' && preg_match('/[a-z][A-Z]/', $username)) {
                        $parts = preg_split('/(?=[A-Z])/', $username);
                        $parts = array_filter($parts); // Remove empty elements
                        
                        if (count($parts) > 1) {
                            $mainName = array_shift($parts);
                            $secondaryName = implode(' ', $parts);
                        }
                    }
                    
                    // Strategy 3: Split by common business suffixes
                    $suffixes = [
                        'Consultants', 'Consultancy', 'Consulting', 'Education', 'Migration', 
                        'Services', 'Solutions', 'Group', 'Ltd', 'Limited', 'Pvt', 'Private',
                        'Company', 'Co', 'Corp', 'Corporation', 'International', 'Global',
                        'Associates', 'Partners', 'Agency', 'Advisory', 'Ventures', 'Holdings'
                    ];
                    
                    if ($secondaryName === '') {
                        foreach ($suffixes as $suffix) {
                            $pattern = "/\b(" . preg_quote($suffix, '/') . ")(\.?)$/i";
                            if (preg_match($pattern, $username, $matches)) {
                                $mainName = trim(preg_replace($pattern, '', $username));
                                $secondaryName = $matches[1] . ($matches[2] ?? '');
                                break;
                            }
                        }
                    }
                    
                    // Strategy 4: If name is too long, split by word count
                    if ($secondaryName === '' && strlen($username) > 15) {
                        $words = explode(' ', $username);
                        if (count($words) > 1) {
                            $mainName = array_shift($words);
                            $secondaryName = implode(' ', $words);
                        }
                    }
                    
                    // Final cleanup
                    $mainName = trim($mainName, ' .-');
                    $secondaryName = trim($secondaryName, ' .-');
                    
                    // If all strategies fail, use the full name as main
                    if ($mainName === '') {
                        $mainName = $username;
                    }
                    
                @endphp
                
                <span class="fw-bold">{{ $mainName }}</span>
                @if($secondaryName)
                    <small class="text-muted">{{ $secondaryName }}</small>
                @endif
            @else
                <span class="fw-bold">Agent</span>
            @endif
        </div>
    </div>
</li>
                </ul>
            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page mt-2">
                <!-- Content wrapper -->
                <div class="content-wrapper flex-grow-1">
                    <!-- Content -->  
                    <div class="px-3 ">
                        {{ $slot }}
                    </div>
                </div>
            
                        @include('layouts.externalagentfooter')
                <div class="content-backdrop fade"></div>
                <!-- Content wrapper -->
            </div>
        <!-- / Layout page -->
    </div>
    @livewireScripts
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<script src="{{ asset('build/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('build/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('build/assets/vendor/js/menu.js') }}"></script>

<!-- Vendors JS -->
<script src="{{ asset('build/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/dropzone/dropzone.js') }}"></script>

<!-- Bootstrap Select (Bootstrap 5 Compatible) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

<!-- Page Specific JS -->

<script src="{{ asset('build/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('build/assets/js/forms-file-upload.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/pickr/pickr.js') }}"></script>
<script src="{{ asset('build/assets/js/forms-pickers.js') }}"></script>
<script src="{{ asset('build/assets/js/main.js') }}"></script>
</body>
</html>
