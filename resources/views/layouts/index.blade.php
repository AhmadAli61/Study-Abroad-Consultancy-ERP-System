<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Vuexy - Bootstrap Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('build/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />


    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/css/pages/cards-advance.css') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles

    <!-- Helpers -->
    <script src="{{ asset('build/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('build/assets/js/config.js') }}"></script>
</head>


  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                    fill="#7367F0" />
                  <path
                    opacity="0.06"
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                    fill="#161616" />
                  <path
                    opacity="0.06"
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                    fill="#161616" />
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                    fill="#7367F0" />
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bold">7 Continental</span>
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
                <a href="{{ route ('dashboard') }}" class="menu-link">
                  <i class="menu-icon fa-solid fa-house fs-6"></i>
                  <div>Dashboards</div>
                </a>
              </li>

              <!-- Inquiry -->
              <li class="menu-item">
                <a href="#" class="menu-link menu-toggle">
                  <i class="menu-icon fa-solid fa-briefcase fs-6"></i>
                  <div>Inquiry</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-plus fs-6"></i>
                      <div>Inquiry Sent Pending</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="# " class="menu-link">
                      <i class="menu-icon fa-solid fa-list fs-6"></i>
                      <div>Inquiry View Pending</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="# " class="menu-link">
                      <i class="menu-icon fa-solid fa-list fs-6"></i>
                      <div>Response Waiting</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="# " class="menu-link">
                      <i class="menu-icon fa-solid fa-list fs-6"></i>
                      <div>Duplicate Inquiry</div>
                    </a>
                  </li>
                </ul>
              </li>


              <!-- Status -->
              <li class="menu-item">
                <a href="#" class="menu-link ">
                  <i class="menu-icon fa-solid fa-house fa-lg fs-6"></i>
                  <div>Status</div>
                </a>


              <!-- Projects -->
              <li class="menu-item">
                <a href="#" class="menu-link">
                  <i class="menu-icon fa-solid fa-building fa-lg fs-6"></i>
                  <div>Report Catalog</div>
                </a>

              <!-- Projects -->
              <li class="menu-item">
                <a href="#" class="menu-link">
                  <i class="menu-icon fa-solid fa-digging fs-6"></i>
                  <div>Client Subscriptions</div>
                </a>
              </li>

              <!-- Contact Us -->
              <li class="menu-item">
                <a href="#" class="menu-link">
                  <i class="menu-icon fa-solid fa-file-contract fs-6"></i>
                  <div>Contact Us</div>
                </a>
              </li>

              <!-- Complaints -->
              <li class="menu-item">
                <a href="#" class="menu-link menu-toggle">
                  <i class="menu-icon fa-solid fa-user fs-6"></i>
                  <div>Complaints</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-plus fs-6"></i>
                      <div>New Complaint</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-list fs-6"></i>
                      <div>Complaint List</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-list fs-6"></i>
                      <div>Convert Complaint List</div>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Staff Management -->
              <li class="menu-item">
                <a href="#" class="menu-link menu-toggle">
                  <i class="menu-icon fa-solid fa-users fs-6"></i>
                  <div>Staff Management</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-plus fs-6"></i>
                      <div>New Staff</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-list fs-6"></i>
                      <div>All Staff</div>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- User Management -->
              <li class="menu-item">
                <a href="#" class="menu-link menu-toggle">
                  <i class="menu-icon fa-solid fa-users-cog fs-6" style="font-size: 18px;"></i>
                  <div>User Management</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-user-plus fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Add User</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-users fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>All Users</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-users fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Team</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-users fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Statistics</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-users fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Portal Log</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-users fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Pin Log</div>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Others -->
              <li class="menu-item">
                <a href="#" class="menu-link menu-toggle">
                  <i class="menu-icon fa-solid fa-users-cog fs-6" style="font-size: 18px;"></i>
                  <div>Others</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-user-plus fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Export Report</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-users fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Import Inquirers</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-users fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Report Import Inquirers</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <i class="menu-icon fa-solid fa-users fs-6" style="font-size: 16px; margin-right: 8px;"></i>
                      <div>Webs & Type</div>
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
            </ul>
        </aside>
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                  <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                    <i class="ti ti-search ti-md me-2"></i>
                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                  </a>
                </div>
              </div>
              <!-- /Search -->
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language -->
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="en">
                        <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                        <span class="align-middle">English</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
                        <i class="fi fi-fr fis rounded-circle me-1 fs-3"></i>
                        <span class="align-middle">French</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="de">
                        <i class="fi fi-de fis rounded-circle me-1 fs-3"></i>
                        <span class="align-middle">German</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="pt">
                        <i class="fi fi-pt fis rounded-circle me-1 fs-3"></i>
                        <span class="align-middle">Portuguese</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ Language -->

                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                  <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="ti ti-md"></i>
                  </a>
                </li>
                <!--/ Style Switcher -->

                <!-- Quick links  -->
                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                  <a
                    class="nav-link dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="ti ti-layout-grid-add ti-md"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end py-0">
                    <div class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                        <a
                          href="javascript:void(0)"
                          class="dropdown-shortcuts-add text-body"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title="Add shortcuts"
                          ><i class="ti ti-sm ti-apps"></i
                        ></a>
                      </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container">
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-calendar fs-4"></i>
                          </span>
                          <a href="app-calendar.html" class="stretched-link">Calendar</a>
                          <small class="text-muted mb-0">Appointments</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-file-invoice fs-4"></i>
                          </span>
                          <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                          <small class="text-muted mb-0">Manage Accounts</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-users fs-4"></i>
                          </span>
                          <a href="app-user-list.html" class="stretched-link">User App</a>
                          <small class="text-muted mb-0">Manage Users</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-lock fs-4"></i>
                          </span>
                          <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                          <small class="text-muted mb-0">Permission</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-chart-bar fs-4"></i>
                          </span>
                          <a href="index.html" class="stretched-link">Dashboard</a>
                          <small class="text-muted mb-0">User Profile</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-settings fs-4"></i>
                          </span>
                          <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                          <small class="text-muted mb-0">Account Settings</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-help fs-4"></i>
                          </span>
                          <a href="pages-help-center-landing.html" class="stretched-link">Help Center</a>
                          <small class="text-muted mb-0">FAQs & Articles</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-square fs-4"></i>
                          </span>
                          <a href={{route('logout')}} class="stretched-link">Modals</a>
                          <small class="text-muted mb-0">Useful Popups</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- Quick links -->


                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3"> 
                            <div class="avatar avatar-online">
                              <img src="{{ asset('build/assets/img/avatars/1.png') }}" alt="Avatar" class="h-auto rounded-circle" />                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-profile-user.html">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <i class="ti ti-settings me-2 ti-sm"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-billing.html">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20"
                            >2</span
                          >
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-help-center-landing.html">
                        <i class="ti ti-lifebuoy me-2 ti-sm"></i>
                        <span class="align-middle">Help</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-faq.html">
                        <i class="ti ti-help me-2 ti-sm"></i>
                        <span class="align-middle">FAQ</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-pricing.html">
                        <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                        <span class="align-middle">Pricing</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" target="_blank">
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..." />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container mt-1">
              {{$slot}}
            </div>
          @livewireScripts
          @include('layouts.footer')
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('build/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('build/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

<script src="{{ asset('build/assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

<script src="{{ asset('build/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('build/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('build/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('build/assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('build/assets/js/dashboards-analytics.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
</script>



  </body>
</html>
