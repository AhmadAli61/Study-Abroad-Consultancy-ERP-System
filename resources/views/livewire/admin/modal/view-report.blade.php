<div>
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); animation: fadeIn 0.3s ease-in-out;">
            <div class="modal-dialog modal-dialog-centered modal-xl" style="width: 70vw; max-width: 95vw;">
                <div class="modal-content" style="height: 92vh; animation: slideDown 0.4s ease;">
                    <div class="modal-header">
                        <h5 class="modal-title">Report Details - <span class="fw-bold text-primary"> {{ $date }}</span></h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>

                    <div class="modal-body" style="overflow-y: auto;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm w-100" style="font-size: 15px; table-layout: fixed;">
                                <tbody>
                                    <!-- Basic Details -->
                                
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-calendar-alt me-2 text-primary"></i> Date</th>
                                        <td style="padding: 6px;">{{ $date ?? 'N/A' }}</td>
                                    </tr>

                                    <!-- Inquiry Statistics -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-question-circle me-2 text-primary"></i> Total Inquiries Received</th>
                                        <td style="padding: 6px;">{{ $total_inquiries_received ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-phone-alt me-2 text-primary"></i> Inbound Calls</th>
                                        <td style="padding: 6px;">{{ $inbound_calls ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-phone-volume me-2 text-primary"></i> Dial Calls</th>
                                        <td style="padding: 6px;">{{ $dial_calls ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-handshake me-2 text-primary"></i> Connect Calls</th>
                                        <td style="padding: 6px;">{{ $connect_calls ?? 'N/A' }}</td>
                                    </tr>

                                    <!-- Follow-Ups -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-thumbs-up me-2 text-primary"></i> Interested Follow-Ups</th>
                                        <td style="padding: 6px;">{{ $interested_followups ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-thumbs-down me-2 text-primary"></i> Weak Follow-Ups</th>
                                        <td style="padding: 6px;">{{ $weak_followups ?? 'N/A' }}</td>
                                    </tr>

                                    <!-- Registrations -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-user-plus me-2 text-primary"></i> Today’s Registration</th>
                                        <td style="padding: 6px;">{{ $today_registration ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-user-clock me-2 text-primary"></i> Expected Registration</th>
                                        <td style="padding: 6px;">{{ $expected_registration ?? 'N/A' }}</td>
                                    </tr>

                                    <!-- Students -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-users me-2 text-primary"></i> Total Students</th>
                                        <td style="padding: 6px;">{{ $total_students ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-user-slash me-2 text-primary"></i> On-Hold Students</th>
                                        <td style="padding: 6px;">{{ $on_hold_students ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-folder-open me-2 text-primary"></i> Applications Processed</th>
                                        <td style="padding: 6px;">{{ $applications_processed ?? 'N/A' }}</td>
                                    </tr>

                                    <!-- Offers -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-gift me-2 text-primary"></i> Conditional Offers</th>
                                        <td style="padding: 6px;">{{ $total_conditional_offers ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-check-circle me-2 text-primary"></i> Unconditional Offers</th>
                                        <td style="padding: 6px;">{{ $total_unconditional_offers ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-tasks me-2 text-primary"></i> Students Processed</th>
                                        <td style="padding: 6px;">{{ $total_students_processed ?? 'N/A' }}</td>
                                    </tr>

                                    <!-- Other Details -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-envelope me-2 text-primary"></i> Gmail Check</th>
                                        <td style="padding: 6px;">{{ $gmail_check ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-sync me-2 text-primary"></i> Gmail Chase-Up</th>
                                        <td style="padding: 6px;">{{ $gmail_chase_up ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-tasks me-2 text-primary"></i> Miscellaneous Tasks</th>
                                        <td style="padding: 6px;">{{ $miscellaneous_tasks ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" wire:click="closeModal">Close</button>
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
                from { transform: scale(0.95) translateY(-10px); opacity: 0; }
                to { transform: scale(1) translateY(0); opacity: 1; }
            }
        </style>
    @endif
</div>
