<div>
    @if($showModal)
        <!-- Modal Backdrop -->
        <div class="modal-backdrop fade show" style="z-index: 1040;"></div>

        <!-- Modal -->
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="z-index: 1050;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            Status Change: {{ ucfirst($currentStatus) }} to {{ ucfirst($newStatus) }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeModal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        @switch($currentStatus . '_to_' . $newStatus)
                            @case('underassessment_to_processed')
                                <div class="mb-3">
                                    <label for="sop_file" class="form-label">Upload Statement of Purpose (SOP)</label>
                                    <input type="file" class="form-control" id="sop_file" wire:model="sop_file" required>
                                    @error('sop_file') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                @break
                                
                            @case('processed_to_conditional')
                                <div class="alert alert-info">
                                    <p>Please confirm the following checkpoints before changing status to Conditional:</p>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="partner_checked" wire:model="partner_checked">
                                    <label class="form-check-label" for="partner_checked">Partner Requirements Completed</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="application_portal_checked" wire:model="application_portal_checked">
                                    <label class="form-check-label" for="application_portal_checked">Application Portal Completed</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="student_gmail_checked" wire:model="student_gmail_checked">
                                    <label class="form-check-label" for="student_gmail_checked">Student Gmail Setup Completed</label>
                                </div>
                                @break
                                
                            @case('conditional_to_unconditional')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fee_voucher_file" class="form-label">Fee Voucher</label>
                                        <input type="file" class="form-control" id="fee_voucher_file" wire:model="fee_voucher_file" required>
                                        @error('fee_voucher_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bank_statement_file" class="form-label">Bank Statement</label>
                                        <input type="file" class="form-control" id="bank_statement_file" wire:model="bank_statement_file" required>
                                        @error('bank_statement_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="interview_pass_file" class="form-label">Interview Pass</label>
                                        <input type="file" class="form-control" id="interview_pass_file" wire:model="interview_pass_file" required>
                                        @error('interview_pass_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tb_test_file" class="form-label">TB Test</label>
                                        <input type="file" class="form-control" id="tb_test_file" wire:model="tb_test_file" required>
                                        @error('tb_test_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                @break
                                
                            @case('unconditional_to_undercas')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fee_payment_file" class="form-label">Fee Payment Receipt</label>
                                        <input type="file" class="form-control" id="fee_payment_file" wire:model="fee_payment_file" required>
                                        @error('fee_payment_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="extra_undercas_file" class="form-label">Additional Documents (Optional)</label>
                                        <input type="file" class="form-control" id="extra_undercas_file" wire:model="extra_undercas_file">
                                        @error('extra_undercas_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                @break
                                
                            @case('undercas_to_casreceived')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cas_document_file" class="form-label">CAS Document</label>
                                        <input type="file" class="form-control" id="cas_document_file" wire:model="cas_document_file" required>
                                        @error('cas_document_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="visa_history_file" class="form-label">Visa History</label>
                                        <input type="file" class="form-control" id="visa_history_file" wire:model="visa_history_file" required>
                                        @error('visa_history_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                @break
                                
                            @case('visaprocess_to_enrollment')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="visa_application_file" class="form-label">Visa Application</label>
                                        <input type="file" class="form-control" id="visa_application_file" wire:model="visa_application_file" required>
                                        @error('visa_application_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="appointment_letter_file" class="form-label">Appointment Letter</label>
                                        <input type="file" class="form-control" id="appointment_letter_file" wire:model="appointment_letter_file" required>
                                        @error('appointment_letter_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="decision_letter_file" class="form-label">Decision Letter</label>
                                        <input type="file" class="form-control" id="decision_letter_file" wire:model="decision_letter_file" required>
                                        @error('decision_letter_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="e_visa_file" class="form-label">E-Visa</label>
                                        <input type="file" class="form-control" id="e_visa_file" wire:model="e_visa_file" required>
                                        @error('e_visa_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="student_id_card_file" class="form-label">Student ID Card</label>
                                        <input type="file" class="form-control" id="student_id_card_file" wire:model="student_id_card_file" required>
                                        @error('student_id_card_file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                @break
                                
                            @default
                                @if($newStatus === 'caseclosed')
                                    <div class="alert alert-warning">
                                        <p>Are you sure you want to close this case? This action cannot be undone.</p>
                                        <textarea class="form-control mt-2" wire:model="confirmation_message" placeholder="Add any final remarks..."></textarea>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <p>No additional information required for this status change.</p>
                                    </div>
                                @endif
                        @endswitch
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="submitForm">
                            Confirm Status Change
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>