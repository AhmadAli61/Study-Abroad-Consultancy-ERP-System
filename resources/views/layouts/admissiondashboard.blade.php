<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-menu-collapsed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-no-customizer">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    
        <title>Admission Dashboard</title>
        <meta name="description" content="" />
    
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('build/assets/img/7skylogo.png') }}" />
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet" />
    
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
        <!-- Make sure you have this in your layout file -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
                    <!-- Admission Portal -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon fa-solid fa-user-graduate fs-6"></i>
                            <div>Agent Portal</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('admission.dashboard') }}" class="menu-link">
                                    <i class="menu-icon fa-solid fa-plus fs-6"></i>
                                    <div class="text-primary">
                                        <i class="fas fa-home me-2"></i><strong>Dashboard</strong>
                                    </div>
                                </a>
                            </li>
                          
                        </ul>
                    </li>
                     <!-- Team Portal -->
<li class="menu-item">
    <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-people-group fs-6"></i>
        <div>Team Portal</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{ route('admission.team.dashboard') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-plus fs-6"></i>
                <div class="text-primary">
                    <i class="fas fa-home me-2"></i><strong>Dashboard</strong>
                </div>
            </a>
        </li>
        <li class="menu-item">
    <a href="{{ route('admission.rejection') }}" class="menu-link">
        <!-- change the leading icon -->
        <i class="menu-icon fa-solid fa-circle-xmark fs-6"></i>
        <div>
            <!-- remove <strong> so it's not bold -->
            <i class="fas fa-circle-xmark  me-2"></i>Rejected
        </div>
    </a>
</li>
 <li class="menu-item">
    <a href="{{ route('admission.withdrawn') }}" class="menu-link">
        <!-- change the leading icon -->
        <i class="menu-icon fa-solid fa-user-slash fs-6"></i>
        <div>
            <!-- remove <strong> so it's not bold -->
            <i class="fas fa-user-slash  me-2"></i>Withdrawn
        </div>
    </a>
</li>
    </ul>
</li>
 <li class="menu-item">
    <a href={{ route('admission.assign-application') }} class="menu-link">
        <i class="menu-icon fa-solid fa-user-check fs-6"></i>
        <div>Assign Application</div>
    </a>
</li>

 <li class="menu-item">
                    <a href={{ route('admission.reassign-application') }} class="menu-link">
                        <i class="menu-icon fa-solid fa-list fs-6"></i>
                        <div>Reassign Applications</div>
                    </a>
                </li>

               <li class="menu-item">
    <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-graduation-cap fs-6"></i>
        <div>Intakes</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{ route('admission.add-intake') }}" class="menu-link">
                <!-- main left icon -->
                <i class="menu-icon fa-solid fa-plus-circle fs-6"></i>
                <div>
                    <!-- internal small icon -->
                    <i class="fas fa-calendar-plus me-2"></i>Add Intake
                </div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admission.all-intakes') }}" class="menu-link">
                <!-- main left icon -->
                <i class="menu-icon fa-solid fa-list-ul fs-6"></i>
                <div>
                    <!-- internal small icon -->
                    <i class="fas fa-file-alt me-2"></i>All Intakes
                </div>
            </a>
        </li>
    </ul>
</li>



                    

                    <!-- Reminders -->
                    <li class="menu-item">
                        <a href="{{route('admission.reminders')}}" class="menu-link">
                            <i class="menu-icon fa-solid fa-bell fs-6"></i>
                            <div>Reminders</div>
                        </a>
                    </li>

                    <!-- Log Out -->
                    <li class="menu-item">
                        <a href="{{ route('logout') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-sign-out-alt fs-6"></i>
                            <div>Log Out</div>
                        </a>
                    </li>
                    <!-- User Profile -->
                    <li class="menu-item mt-auto">
                        <div class="menu-link d-flex align-items-center">
                            <div class="avatar avatar-md me-2">
                                <span class="avatar-initial rounded-circle bg-info">
                                    {{ strtoupper(substr(Auth::user()->username ?? 'A', 1, 2)) }}
                                </span>
                            </div>
                            @if(Auth::check() && Auth::user()->username)
                                <span>{{ Auth::user()->username }}</span>
                            @else
                                <span>Agent</span>
                            @endif
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
                                <livewire:admission.reminder-checker wire:poll.30s />

            
                @include('layouts.admissionfooter')
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
<script>
    Livewire.on('showMultipleReminders', ({ reminders }) => {
        if (reminders.length === 0) return;
        
        // Show each reminder as a separate notification with a delay
        showRemindersSequentially(reminders, 0);
    });

    // Function to show reminders one by one with a delay
    function showRemindersSequentially(reminders, index) {
        if (index >= reminders.length) return;
        
        const reminder = reminders[index];
        
        Swal.fire({
            title: 'Reminder Notification',
            html: `
                <div class="reminder-container">
                    <div class="reminder-header">
                        <i class="fas fa-bell text-primary"></i>
                        <span class="reminder-title">Scheduled Reminder</span>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-time">
                            <i class="fas fa-clock me-2"></i>
                            <strong>${reminder.time}</strong>
                        </div>
                        <div class="reminder-reason">
                            <i class="fas fa-sticky-note me-2"></i>
                            ${reminder.reason}
                        </div>
                    </div>
                </div>
            `,
            icon: 'info',
            confirmButtonText: index < reminders.length - 1 ? 'Next Reminder' : 'Done',
            confirmButtonColor: '#3085d6',
            showCancelButton: true,
            cancelButtonText: 'Dismiss All',
            customClass: {
                popup: 'reminder-popup',
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary'
            },
            didClose: () => {
                // Continue with next reminder when this one is closed
                if (index < reminders.length - 1) {
                    setTimeout(() => {
                        showRemindersSequentially(reminders, index + 1);
                    }, 500); // Small delay before showing next reminder
                }
            }
        });
    }

    // Single reminder handler with improved styling
    Livewire.on('showReminderPopup', ({ time, reason }) => {
        Swal.fire({
            title: 'Reminder Notification',
            html: `
                <div class="reminder-container">
                    <div class="reminder-header">
                        <i class="fas fa-bell text-primary"></i>
                        <span class="reminder-title">Scheduled Reminder</span>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-time">
                            <i class="fas fa-clock me-2"></i>
                            <strong>${time}</strong>
                        </div>
                        <div class="reminder-reason">
                            <i class="fas fa-sticky-note me-2"></i>
                            ${reason}
                        </div>
                    </div>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'Dismiss',
            confirmButtonColor: '#3085d6',
            customClass: {
                popup: 'reminder-popup',
                confirmButton: 'btn btn-primary'
            }
        });
    });
</script>

<style>
    .reminder-popup {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .reminder-container {
        padding: 10px 0;
    }
    
    .reminder-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .reminder-header .fas {
        font-size: 1.5rem;
        margin-right: 10px;
    }
    
    .reminder-title {
        font-weight: 600;
        color: #495057;
        font-size: 1.1rem;
    }
    
    .reminder-content {
        margin-left: 10px;
    }
    
    .reminder-time, .reminder-reason {
        display: flex;
        align-items: flex-start;
        margin-bottom: 12px;
        padding: 8px 12px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border-left: 3px solid #007bff;
    }
    
    .reminder-time .fas, .reminder-reason .fas {
        margin-top: 2px;
        color: #6c757d;
    }
    
    .reminder-time {
        border-left-color: #17a2b8;
    }
    
    .reminder-reason {
        border-left-color: #28a745;
    }
    
    .swal2-confirm.btn {
        border-radius: 6px;
        padding: 8px 20px;
        font-weight: 500;
    }
    
    .swal2-cancel.btn {
        border-radius: 6px;
        padding: 8px 20px;
        font-weight: 500;
    }
</style>
</body>
</html>