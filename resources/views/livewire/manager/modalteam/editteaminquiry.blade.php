<div>
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" 
            style="background: rgba(0,0,0,0.5); animation: fadeIn 0.2s ease-out;">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" 
                style="animation: fadeInModal 0.5s ease-out;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-pen-square me-2"></i> Edit - 
                            <span class="fw-bold text-primary" style="font-size: 1.1rem;">{{ ucfirst($name) }}</span>
                        </h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-user me-1"></i> Name
                                    </label>
                                    <input type="text" class="form-control" wire:model="name">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-envelope me-1"></i> Email
                                    </label>
                                    <input type="email" class="form-control" wire:model.defer="email">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-tags me-1"></i> Type
                                    </label>
                                    <select class="form-control" wire:model.defer="type">
                                        <option value="">Select Type</option>
                                        <option value="Meta Leads W">Meta Leads W</option>
                                        <option value="Google Leads">Google Leads</option>
                                        <option value="Referral">Referral</option>
                                    </select>                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-phone me-1"></i> Contact
                                    </label>
                                    <input type="text" class="form-control" wire:model="phone_number" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-phone-alt me-1"></i> Contact (Additional)
                                    </label>
                                    <input type="text" class="form-control" wire:model.defer="phone_number2">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-info-circle me-1"></i> Inquiry Status
                                    </label>
                                    <select class="form-control" wire:model="inquiry_status">
                                        <option value="" selected>Select Inquiry Status</option>
                                        <option value="Hot">Hot</option>
                                        <option value="Cold">Cold</option>
                                        <option value="Dead">Dead</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-graduation-cap me-1"></i> Education
                                    </label>
                                    <input type="text" class="form-control" wire:model.defer="study_course">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-map-marker-alt me-1"></i> Country
                                    </label>
                                    <input type="text" class="form-control" wire:model.defer="country">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">
                                        <i class="fas fa-city me-1"></i> City
                                    </label>
                                    <input type="text" class="form-control" wire:model.defer="budget">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-lightbulb me-1"></i> Future Plan
                                    </label>
                                    <input type="text" class="form-control" wire:model.defer="plan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-language me-1"></i> English Test
                                    </label>
                                    <input type="text" class="form-control" wire:model.defer="extra">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        <i class="fas fa-comment-dots me-1"></i> Remarks
                                    </label>
                                    <textarea class="form-control" rows="3" wire:model.defer="response"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" wire:click="$set('showModal', false)">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="update" wire:loading.attr="disabled">
                            <i class="fas fa-save me-1"></i> Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inline Keyframes for Fade-In Animations -->
        <style>
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes fadeInModal {
                from { transform: scale(0.9); opacity: 0; }
                to { transform: scale(1); opacity: 1; }
            }
        </style>
    @endif
</div>
