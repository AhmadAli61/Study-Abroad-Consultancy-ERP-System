<div>
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); animation: fadeIn 0.3s ease-in-out;">
            <div class="modal-dialog modal-dialog-centered modal-xl" style="width: 85vw; max-width: 95vw;">
                <div class="modal-content" style="height: 95vh; animation: slideDown 0.4s ease; border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                    <!-- Modal Header -->
                    <div class="modal-header border-0" style="background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%); border-radius: 20px 20px 0 0; padding: 1.5rem 2rem;">
                        <div class="d-flex align-items-center w-100">
                            <div class="me-3" style="background: rgba(255,255,255,0.2); padding: 12px; border-radius: 12px;">
                                <i class="fas fa-file-alt fa-lg text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="modal-title mb-0 text-white" style="font-weight: 700; font-size: 1.5rem;">
                                    Report Details
                                </h4>
                                <p class="mb-0 text-white opacity-75" style="font-size: 1rem;">
                                    <i class="fas fa-calendar me-2"></i>{{ $date ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body p-0" style="overflow-y: auto; background: #f8f9fa;">
                        <div class="container-fluid py-4">
                            <!-- Summary Cards -->
                            <div class="row mb-4">
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #3498db;">
                                        <div class="card-body py-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-title text-muted mb-1" style="font-size: 0.75rem; font-weight: 600;">TOTAL INQUIRIES</h6>
                                                    <h4 class="mb-0" style="font-weight: 800; font-size: 1.25rem;">
                                                        {{ $total_inquiries_received ?? 0 }}
                                                    </h4>
                                                </div>
                                                <div style="background: rgba(52, 152, 219, 0.1); padding: 8px; border-radius: 10px;">
                                                    <i class="fas fa-list-alt" style="color: #3498db;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #27ae60;">
                                        <div class="card-body py-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-title text-muted mb-1" style="font-size: 0.75rem; font-weight: 600;">TOTAL CALLS</h6>
                                                    <h4 class="mb-0" style="font-weight: 800; font-size: 1.25rem;">
                                                        {{ ($inbound_calls ?? 0) + ($dial_calls ?? 0) }}
                                                    </h4>
                                                </div>
                                                <div style="background: rgba(39, 174, 96, 0.1); padding: 8px; border-radius: 10px;">
                                                    <i class="fas fa-phone-alt" style="color: #27ae60;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #9b59b6;">
                                        <div class="card-body py-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-title text-muted mb-1" style="font-size: 0.75rem; font-weight: 600;">REGISTRATIONS</h6>
                                                    <h4 class="mb-0" style="font-weight: 800; font-size: 1.25rem;">
                                                        {{ $today_registration ?? 0 }}
                                                    </h4>
                                                </div>
                                                <div style="background: rgba(155, 89, 182, 0.1); padding: 8px; border-radius: 10px;">
                                                    <i class="fas fa-user-check" style="color: #9b59b6;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #e67e22;">
                                        <div class="card-body py-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-title text-muted mb-1" style="font-size: 0.75rem; font-weight: 600;">ACTIVE LEADS</h6>
                                                    <h4 class="mb-0" style="font-weight: 800; font-size: 1.25rem;">
                                                        {{ ($hot_leads ?? 0) + ($pending_leads ?? 0) }}
                                                    </h4>
                                                </div>
                                                <div style="background: rgba(230, 126, 34, 0.1); padding: 8px; border-radius: 10px;">
                                                    <i class="fas fa-fire" style="color: #e67e22;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Table -->
                            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                                <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px 15px 0 0;">
                                    <h5 class="mb-0" style="font-weight: 700;">
                                        <i class="fas fa-list-ul me-2 text-primary"></i>Detailed Breakdown
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <tbody>
                                                <!-- Inquiry Statistics -->
                                                <tr class="category-header">
                                                    <td colspan="2" class="py-3" style="background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%); color: white; font-weight: 700; font-size: 1rem;">
                                                        <i class="fas fa-chart-bar me-2"></i>Inquiry Statistics
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; width: 40%; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-question-circle me-2 text-dark"></i>Total Inquiries Received
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $total_inquiries_received ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-phone-alt me-2 text-dark"></i>Inbound Calls
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $inbound_calls ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-phone-volume me-2 text-dark"></i>Dial Calls
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $dial_calls ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-handshake me-2 text-dark"></i>Connect Calls
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $connect_calls ?? 'N/A' }}</td>
                                                </tr>

                                                <!-- Follow-Ups -->
                                                <tr class="category-header">
                                                    <td colspan="2" class="py-3" style="background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%); color: white; font-weight: 700; font-size: 1rem;">
                                                        <i class="fas fa-users me-2"></i>Follow-Ups
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-thumbs-up me-2 text-dark"></i>Interested Follow-Ups
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $interested_followups ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-thumbs-down me-2 text-dark"></i>Weak Follow-Ups
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $weak_followups ?? 'N/A' }}</td>
                                                </tr>

                                                <!-- Registrations & Students -->
                                                <tr class="category-header">
                                                    <td colspan="2" class="py-3" style="background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%); color: white; font-weight: 700; font-size: 1rem;">
                                                        <i class="fas fa-user-graduate me-2"></i>Registrations & Students
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-user-plus me-2 text-dark"></i>Today's Registration
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $today_registration ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-user-clock me-2 text-dark"></i>Expected Registration
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $expected_registration ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-users me-2 text-dark"></i>Total Students
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $total_students ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-user-slash me-2 text-dark"></i>On-Hold Students
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $on_hold_students ?? 'N/A' }}</td>
                                                </tr>

                                                <!-- Applications & Offers -->
                                                <tr class="category-header">
                                                    <td colspan="2" class="py-3" style="background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%); color: white; font-weight: 700; font-size: 1rem;">
                                                        <i class="fas fa-file-contract me-2"></i>Applications & Offers
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-folder-open me-2 text-dark"></i>Applications Processed
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $applications_processed ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-gift me-2 text-dark"></i>Conditional Offers
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $total_conditional_offers ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-check-circle me-2 text-dark"></i>Unconditional Offers
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $total_unconditional_offers ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-tasks me-2 text-dark"></i>Students Processed
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $total_students_processed ?? 'N/A' }}</td>
                                                </tr>

                                                <!-- Lead Status -->
                                                <tr class="category-header">
                                                    <td colspan="2" class="py-3" style="background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%); color: white; font-weight: 700; font-size: 1rem;">
                                                        <i class="fas fa-chart-pie me-2"></i>Lead Status
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-database me-2 text-dark"></i>Total Inquiries
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $total_leads ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-fire me-2 text-dark"></i>Hot Inquiries
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $hot_leads ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-snowflake me-2 text-dark"></i>Cold Inquiries
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $cold_leads ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-times-circle me-2 text-dark"></i>Dead Inquiries
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $dead_leads ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-hourglass-half me-2 text-dark"></i>Pending Inquiries
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $pending_leads ?? 'N/A' }}</td>
                                                </tr>

                                                <!-- Other Details -->
                                                <tr class="category-header">
                                                    <td colspan="2" class="py-3" style="background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%); color: white; font-weight: 700; font-size: 1rem;">
                                                        <i class="fas fa-cogs me-2"></i>Other Activities
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-envelope me-2 text-dark"></i>Gmail Check
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $gmail_check ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-sync me-2 text-dark"></i>Gmail Chase-Up
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600; ">{{ $gmail_chase_up ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 12px 20px; border-right: 1px solid #f1f3f4;">
                                                        <i class="fas fa-tasks me-2 text-dark"></i>Miscellaneous Tasks
                                                    </th>
                                                    <td style="padding: 12px 20px; font-weight: 600;">{{ $miscellaneous_tasks ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer border-0" style="border-radius: 0 0 20px 20px; background: #f8f9fa;">
                        <button type="button" class="btn btn-label-secondary px-4 py-2 border-0" wire:click="closeModal" 
                                style="border-radius: 10px; background: linear-gradient(135deg, #7367F0 0%, #7367F0 100%); color: white; font-weight: 600;">
                            <i class="fas fa-times me-2"></i>Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes slideDown {
                from { transform: scale(0.95) translateY(-20px); opacity: 0; }
                to { transform: scale(1) translateY(0); opacity: 1; }
            }
            
            .modal-content {
                scrollbar-width: thin;
                scrollbar-color: #c1c1c1 #f1f1f1;
            }
            
            .modal-content::-webkit-scrollbar {
                width: 6px;
            }
            
            .modal-content::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }
            
            .modal-content::-webkit-scrollbar-thumb {
                background: #c1c1c1;
                border-radius: 10px;
            }
            
            .modal-content::-webkit-scrollbar-thumb:hover {
                background: #a8a8a8;
            }
            
            .category-header {
                position: sticky;
                top: 0;
                z-index: 10;
            }
            
            .table-hover tbody tr:hover {
                background-color: rgba(115, 103, 240, 0.05);
                transition: all 0.3s ease;
            }
        </style>
    @endif
</div>