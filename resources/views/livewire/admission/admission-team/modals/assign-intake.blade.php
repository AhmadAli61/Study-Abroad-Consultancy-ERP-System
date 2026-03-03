<div>
    @if($show)
        <!-- Animation wrapper -->
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); animation: fadeIn 0.3s ease-in-out;">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="animation: slideIn 0.3s ease-in-out;">
                <div class="modal-content border-0 shadow-lg">
                    <!-- Modal Header - Centered and Clean -->
                    <div class="modal-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                        <div class="d-flex align-items-center w-100">
                            <i class="fas fa-paper-plane fa-lg me-3"></i>
                            <h5 class="modal-title mb-0 flex-grow-1 text-white">Send Student to Intake</h5>
                            <div style="width: 24px;"></div> <!-- Spacer for balance -->
                        </div>
                        <button type="button" class="btn-close position-absolute end-3 top-3 btn-close-light" wire:click="closeModal" aria-label="Close"></button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body p-4">
                        @if($inquiryData)
                            <!-- Student Information Section - Professional Compact Layout -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user-graduate me-2 text-primary" style="font-size: 0.9rem;"></i>
                                    <h6 class="mb-0 fw-semibold text-gray-700" style="font-size: 0.95rem;">STUDENT INFORMATION</h6>
                                </div>
                                <div class="bg-light rounded p-3 border" style="padding: 0.75rem !important;">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <div class="d-flex flex-column">
                                                <span class="text-muted small" style="font-size: 0.75rem; font-weight: 500;">STUDENT NAME</span>
                                                <span class="fw-semibold text-dark" style="font-size: 0.85rem;">{{ $inquiryData['student_name'] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex flex-column">
                                                <span class="text-muted small" style="font-size: 0.75rem; font-weight: 500;">PASSPORT NUMBER</span>
                                                <span class="fw-semibold text-dark" style="font-size: 0.85rem;">{{ $inquiryData['passport_number'] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex flex-column">
                                                <span class="text-muted small" style="font-size: 0.75rem; font-weight: 500;">UNIVERSITY</span>
                                                <span class="fw-semibold text-dark" style="font-size: 0.85rem;">{{ $inquiryData['university_name'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Divider -->
                            <div class="d-flex align-items-center my-4">
                                <hr class="flex-grow-1 border-gray-300">
                                <span class="px-3 text-muted fw-semibold small" style="font-size: 0.8rem;">
                                    <i class="fas fa-calendar-alt me-2"></i>AVAILABLE INTAKES
                                </span>
                                <hr class="flex-grow-1 border-gray-300">
                            </div>
                            
                            <!-- Intake Selection Section -->
                            <div class="mb-3">
                                <label for="intakeSelect" class="form-label fw-semibold text-gray-700 d-flex align-items-center" style="font-size: 0.9rem;">
                                    <i class="fas fa-list-alt me-2 text-primary"></i>Select Intake
                                </label>
                                <select class="form-select border-2 border-gray-300 focus:border-primary focus:shadow-sm focus:ring-0" 
                                        id="intakeSelect" 
                                        wire:model="selectedIntakeId">
                                    <option value="">-- Choose an Intake --</option>
                                    @foreach($intakes as $intake)
                                        <option value="{{ $intake->id }}">
                                            {{ $intake->display_name }} ({{ $intake->inquiries_count }} students)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="alert alert-danger d-flex align-items-center py-2" style="font-size: 0.85rem;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>Student inquiry not found!</div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-gray-100 border-top py-3">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" wire:click="closeModal" style="font-size: 0.85rem;">
                            <i class="fas fa-times me-2"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" wire:click="saveAssignment" style="font-size: 0.85rem;">
                            <i class="fas fa-paper-plane me-2"></i> Send to Intake
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animation CSS -->
        <style>
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes slideIn {
                from { 
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to { 
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Improved modal header centering */
            .modal-header h5 {
                position: relative;
                left: -12px; /* Compensate for icon space */
            }
            
            /* Custom styling for form elements */
            .bg-light {
                background-color: #f8f9fa !important;
            }
            
            .rounded-lg {
                border-radius: 0.5rem !important;
            }
            
            .border-gray-300 {
                border-color: #dee2e6 !important;
            }
            
            .text-gray-700 {
                color: #495057 !important;
            }
            
            .bg-gray-100 {
                background-color: #f8f9fa !important;
            }
        </style>
    @endif
</div>