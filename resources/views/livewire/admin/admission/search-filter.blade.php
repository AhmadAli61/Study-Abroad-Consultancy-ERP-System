<div>
    <!-- Enhanced Search Filter Card -->
    <div class="card mb-2 border-0 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center"
     style="background-color: #28a745; color: rgb(253, 252, 252);">
    <div class="d-flex align-items-center gap-2">
        <i class="fas fa-clipboard-list fa-lg" style="color: #fdfcfc"></i>
        <h4 class="mb-0" style="color: #fcfcfc"><strong>All Registered Applications</strong></h4>
    </div>
    <div class="d-flex align-items-center gap-2">
        <!-- Results Count Button -->
        @if($this->hasActiveFilters())
            <button class="btn btn-dark btn-sm d-flex align-items-center shadow-sm" style="cursor: default;">
                <i class="fas fa-filter me-1"></i>Filtered: {{ $filteredCount }}
            </button>
        @else
            <button class="btn btn-light btn-sm d-flex align-items-center shadow-sm" style="cursor: default;">
                <i class="fas fa-database me-1"></i>Total: {{ $filteredCount }}
            </button>
        @endif
        
        <!-- Reset Button -->
    <button class="btn btn-sm btn-light d-flex align-items-center" 
        wire:click="resetFilters">
    <i class="fas fa-refresh me-1"></i>Reset All
</button>
    </div>
</div>
        
        <div class="card-body p-4">
            <!-- Main Filter Row -->
            <div class="filter-container">
                <!-- Quick Search -->
                <div class="filter-item">
                    <label class="form-label fw-semibold text-dark mb-2">
                        <i class="fas fa-search me-1 text-dark"></i>Quick Search
                    </label>
                    <div class="input-group input-group-sm shadow-sm">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" 
                               class="form-control border-start-0 ps-0" 
                               placeholder="Search by name, contact, passport..."
                               wire:model.debounce.500ms="search">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="filter-item">
                    <label class="form-label fw-semibold text-dark mb-2">
                        <i class="fas fa-tasks me-1 text-dark"></i>Application Status
                    </label>
                    <select class="form-select form-select-sm shadow-sm" wire:model="statusFilter">
                        <option value="all">All Status</option>
                        <option value="underassessment">Under Assessment</option>
                        <option value="processed">Processed</option>
                        <option value="conditional">Conditional Offer</option>
                        <option value="unconditional">Unconditional Offer</option>
                        <option value="undercas">Under CAS</option>
                        <option value="casreceived">CAS Received</option>
                        <option value="visaprocess">Visa Process</option>
                        <option value="enrollment">Enrollment</option>
                        <option value="caseclosed">Case Closed</option>
                                <option value="rejection">Rejected</option> <!-- ADD THIS -->
        <option value="withdrawn">Withdrawn</option> <!-- ADD THIS -->
                    </select>
                </div>

                <!-- Date Range Picker -->
               <div class="filter-item">
    <label class="form-label fw-semibold text-dark mb-2">
        <i class="fas fa-calendar-alt me-1 text-dark"></i>Date Range
    </label>
    <div class="d-flex gap-2">
        <div class="flex-fill">
            <input type="date" 
                   class="form-control form-control-sm shadow-sm"
                   wire:model="startDate" />
        </div>
        <div class="flex-fill">
            <input type="date" 
                   class="form-control form-control-sm shadow-sm"
                   wire:model="endDate" />
        </div>
    </div>
</div>

                <!-- Partner Filter -->
                <div class="filter-item">
                    <label class="form-label fw-semibold text-dark mb-2">
                        <i class="fas fa-handshake me-1 text-dark"></i>Partner
                    </label>
                    <select class="form-select form-select-sm shadow-sm" wire:model="partnerFilter">
                        <option value="">All Partners</option>
                        @foreach($partners as $partner)
                            <option value="{{ $partner }}">{{ $partner }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Assigned To Filter -->
                <div class="filter-item">
                    <label class="form-label fw-semibold text-dark mb-2">
                        <i class="fas fa-user-tie me-1 text-dark"></i>Assigned To
                    </label>
                    <select class="form-select form-select-sm shadow-sm" wire:model="assignedToFilter">
                        <option value="">All Team Members</option>
                        @foreach($teamMembers as $id => $username)
                            <option value="{{ $id }}">{{ $username }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Counsellor Filter -->
                <div class="filter-item">
                    <label class="form-label fw-semibold text-dark mb-2">
                        <i class="fas fa-user-graduate me-1 text-dark"></i>Counsellor
                    </label>
                    <select class="form-select form-select-sm shadow-sm" wire:model="counsellorFilter">
                        <option value="">All Counsellors</option>
                        @foreach($counsellors as $id => $username)
                            <option value="{{ $id }}">{{ $username }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
   <div class="filter-button-row">
    <div class="d-flex gap-2 align-items-center">
        <!-- Apply Filters Button -->
        <button class="btn btn-success btn-sm d-flex align-items-center justify-content-center shadow-sm flex-grow-1" 
                wire:click="applyFilters">
            <i class="fas fa-check-circle me-2"></i>Apply Filters
        </button>
    </div>
</div>

          <!-- Active Filters Display -->
@if($this->hasActiveFilters())
    <div class="mt-4 p-3 bg-light rounded border">
        <h6 class="mb-2 fw-semibold text-dark d-flex align-items-center">
            <i class="fas fa-tags me-2 text-success fa-xs"></i>
            <span class="small">Active Filters:</span>
        </h6>
        <div class="d-flex flex-wrap gap-1">
            @if($search)
                <span class="badge bg-dark text-white border border-dark border-opacity-25 d-flex align-items-center py-0 px-2" style="border-radius:4px; font-size:0.7rem; line-height:1.2;">
                    <i class="fas fa-search me-1 fa-xs"></i> 
                    "{{ $search }}"
                    <button class="btn-close btn-close-white ms-1" style="font-size:0.6rem;" wire:click="$set('search', '')"></button>
                </span>
            @endif

            {{-- Status Badge with color & icon --}}
            @if($statusFilter !== 'all')
                {{-- Your existing status badge code --}}
                @php
                    $statusStyles = [
                        'caseclosed'       => ['color' => '#c01414', 'icon' => 'fa-archive'],
                               'rejection'        => ['color' => '#ff0000', 'icon' => 'fa-times-circle'],
        'withdrawn'        => ['color' => '#800000', 'icon' => 'fa-user-slash'],
                        'casreceived'      => ['color' => '#828383', 'icon' => 'fa-file-invoice'],
                        'conditional'      => ['color' => '#27391C', 'icon' => 'fa-file-signature'],
                        'enrollment'       => ['color' => '#009688', 'icon' => 'fa-user-graduate'],
                        'processed'        => ['color' => '#09122C', 'icon' => 'fa-tasks'],
                        'unconditional'    => ['color' => '#87431D', 'icon' => 'fa-file-contract'],
                        'underassessment'  => ['color' => '#517577', 'icon' => 'fa-hourglass-half'],
                        'undercas'         => ['color' => '#C69749', 'icon' => 'fa-passport'],
                        'visaprocess'      => ['color' => '#673AB7', 'icon' => 'fa-stamp'],
                        'registered'       => ['color' => '#28a745', 'icon' => 'fa-clipboard-list'],
                    ];
                    $statusKey = strtolower($statusFilter);
                    $statusColor = $statusStyles[$statusKey]['color'] ?? '#6c757d';
                    $statusIcon  = $statusStyles[$statusKey]['icon'] ?? 'fa-tag';
                @endphp

                <span class="badge text-white d-flex align-items-center py-0 px-2"
                      style="background-color: {{ $statusColor }}; border-radius:4px; font-size:0.7rem; line-height:1.2;">
                    <i class="fas {{ $statusIcon }} me-1 fa-xs"></i>
                    {{ ucfirst($statusFilter) }}
                    <button class="btn-close btn-close-white ms-1" style="font-size:0.6rem;" wire:click="$set('statusFilter', 'all')"></button>
                </span>
            @endif

            {{-- Date Range Badge (Updated) --}}
            @if($startDate || $endDate)
                @php
                    $dateDisplay = '';
                    if ($startDate && $endDate) {
                        $dateDisplay = $startDate . ' to ' . $endDate;
                    } elseif ($startDate) {
                        $dateDisplay = 'From ' . $startDate;
                    } elseif ($endDate) {
                        $dateDisplay = 'To ' . $endDate;
                    }
                @endphp
                
                <span class="badge bg-dark text-white border border-dark border-opacity-25 d-flex align-items-center py-0 px-2" style="border-radius:4px; font-size:0.7rem; line-height:1.2;">
                    <i class="fas fa-calendar me-1 fa-xs"></i> 
                    {{ $dateDisplay }}
                    <button class="btn-close btn-close-white ms-1" style="font-size:0.6rem;" 
                            wire:click="$set(['startDate' => '', 'endDate' => ''])"></button>
                </span>
            @endif

            @if($partnerFilter)
                <span class="badge bg-dark text-white border border-dark border-opacity-25 d-flex align-items-center py-0 px-2" style="border-radius:4px; font-size:0.7rem; line-height:1.2;">
                    Partner: {{ $partnerFilter }}
                    <button class="btn-close btn-close-white ms-1" style="font-size:0.6rem;" wire:click="$set('partnerFilter', '')"></button>
                </span>
            @endif

            @if($assignedToFilter && isset($teamMembers[$assignedToFilter]))
                <span class="badge bg-dark text-white border border-dark border-opacity-25 d-flex align-items-center py-0 px-2" style="border-radius:4px; font-size:0.7rem; line-height:1.2;">
                    Assigned: {{ $teamMembers[$assignedToFilter] }}
                    <button class="btn-close btn-close-white ms-1" style="font-size:0.6rem;" wire:click="$set('assignedToFilter', '')"></button>
                </span>
            @endif

            @if($counsellorFilter && isset($counsellors[$counsellorFilter]))
                <span class="badge bg-dark text-white border border-dark border-opacity-25 d-flex align-items-center py-0 px-2" style="border-radius:4px; font-size:0.7rem; line-height:1.2;">
                    Counsellor: {{ $counsellors[$counsellorFilter] }}
                    <button class="btn-close btn-close-white ms-1" style="font-size:0.6rem;" wire:click="$set('counsellorFilter', '')"></button>
                </span>
            @endif
        </div>
    </div>
@endif

        </div>
    </div>

    @assets
    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endassets

    @script
    <script>
        let adminFlatpickrInstance;

        // Initialize Flatpickr when component mounts
        Livewire.on('loadAdminFlatpickr', () => {
            adminFlatpickrInstance = flatpickr("#admin-flatpickr-range", {
                mode: "range",
                dateFormat: "Y-m-d",
                allowInput: true,
                clickOpens: true,
                placeholder: "Select date range",
                onClose: function(selectedDates, dateStr, instance) {
                    // Update Livewire property with the selected date range
                    $wire.tempDateRange = dateStr;
                }
            });

            // Set initial value if it exists
            if ($wire.tempDateRange) {
                adminFlatpickrInstance.setDate($wire.tempDateRange);
            }
        });

        // Listen for reset filters to clear the date picker
        Livewire.on('resetAdminDatePicker', () => {
            if (adminFlatpickrInstance) {
                adminFlatpickrInstance.clear();
            }
        });

        // Initialize when component is loaded
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.dispatch('loadAdminFlatpickr');
        });

        // Re-initialize when Livewire updates the component
        Livewire.hook('element.updated', (el, component) => {
            if (el.id === 'admin-flatpickr-range' && !adminFlatpickrInstance) {
                Livewire.dispatch('loadAdminFlatpickr');
            }
        });
    </script>
    @endscript

    <style>
        .card {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .card-header {
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        
        .form-control, .form-select {
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
            border-color: #28a745;
        }
        
        /* Reduce font size of the selected date text only */
        #admin-flatpickr-range.form-control {
            font-size: 11px;
        }
        
        .input-group-text {
        }
        
        .btn {
            transition: all 0.3s ease;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #28a745 100%);
            border: none;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }
        
        .badge {
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .btn-close {
            opacity: 0.7;
        }
        
        .btn-close:hover {
            opacity: 1;
        }
        
        .shadow-sm {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
        }
        
        /* New CSS for the filter layout */
        .filter-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .filter-item {
            display: flex;
            flex-direction: column;
        }
        
        .filter-button-row {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        
        .filter-button-row .btn {
            width: 200px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .filter-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .filter-container {
                grid-template-columns: 1fr;
            }
            
            .card-body {
                padding: 1.5rem !important;
            }
        }
    </style>
</div>