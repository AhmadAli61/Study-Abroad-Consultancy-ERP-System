<div>
    @if ($showModal)
        <div class="modal-overlay" style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(5px); z-index: 1050; display: flex; align-items: center; justify-content: center; animation: fadeIn 0.1s ease-in-out;">
            <div class="modal-container" style="width: 90vw; max-width: 1000px; max-height: 90vh; background: #fff; border-radius: 12px; overflow: hidden; animation: slideIn 0.4s ease; box-shadow: 0 10px 40px rgba(0,0,0,0.2); display: flex; flex-direction: column;">
                
                <!-- Header -->
                <div class="modal-header" style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #e9ecef; display: flex; align-items: center; justify-content: space-between; background: linear-gradient(90deg, #7367f0 0%, #9e95f5 100%); color: white;">
                    <h5 style="margin: 0; font-weight: 600; font-size: 1.25rem; color: #ffffff;">
                        <i class="fas fa-user-edit mr-2 text-white"></i> 
                        Edit - 
                        @if(!empty($name))
            <span style="color: #ffffff;">{{ ucfirst($name) }}</span>
        @else
            <span style="display: inline-block; background: #f1f3f4; color: #333; padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                Null
            </span>
        @endif
                    </h5>
                    <button wire:click="$set('showModal', false)" type="button" style="background: rgba(255,255,255,0.2); border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 1.25rem; line-height: 1; cursor: pointer; color: white; display: flex; align-items: center; justify-content: center;">
                        &times;
                    </button>
                </div>
        
                <!-- Content Area -->
                <div class="modal-body" style="padding: 1.5rem; overflow: auto; flex: 1; background: #f8f9fa;">
                    <form>
                        <div class="form-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.25rem;">
                            
                            <!-- Name Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-user me-1" style="color: #7367f0;"></i> Name
                                </label>
                                <input type="text" class="form-control-modern" wire:model="name" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem;">
                            </div>
                            
                            <!-- Email Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-envelope me-1" style="color: #7367f0;"></i> Email
                                </label>
                                <input type="email" class="form-control-modern" wire:model.defer="email" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem;">
                            </div>
                            
                                                                              <!-- Type Field -->
<div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
    <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
        <i class="fas fa-tags me-1" style="color: #7367f0;"></i> Type
    </label>
    
    <select class="form-control-modern @error('type') is-invalid @enderror" 
            wire:model.defer="type" 
            style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem; background: white;">
        <option value="">Select Type</option>
        <option value="Meta Leads W">Meta Leads W</option>
        <option value="Google Leads">Google Leads</option>
        <option value="Referral">Referral</option>
    </select>

    {{-- Error Message --}}
    @error('type')
        <small class="text-danger" style="display: block; margin-top: 0.5rem; font-size: 0.8rem;">
            {{ $message }}
        </small>
    @enderror
</div>
                            
                            <!-- Contact Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-phone me-1" style="color: #7367f0;"></i> Contact
                                </label>
                                <input type="text" class="form-control-modern" wire:model="phone_number" disabled style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem; background-color: #f8f9fa;">
                            </div>
                            
                            <!-- Additional Contact Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-phone-alt me-1" style="color: #7367f0;"></i> Contact (Additional)
                                </label>
                                <input type="text" class="form-control-modern" wire:model.defer="phone_number2" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem;">
                            </div>
                            
                            <!-- Inquiry Status Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-info-circle me-1" style="color: #7367f0;"></i> Inquiry Status
                                </label>
                                <select class="form-control-modern" wire:model="inquiry_status" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem; background: white;">
                                    <option value="" selected>Select Inquiry Status</option>
                                    <option value="Hot">Hot</option>
                                    <option value="Cold">Cold</option>
                                    <option value="Dead">Dead</option>
                                </select>
                            </div>
                            
                            <!-- Education Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-graduation-cap me-1" style="color: #7367f0;"></i> Education
                                </label>
                                <input type="text" class="form-control-modern" wire:model.defer="study_course" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem;">
                            </div>
                            
                            <!-- Country Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-map-marker-alt me-1" style="color: #7367f0;"></i> Country
                                </label>
                                <input type="text" class="form-control-modern" wire:model.defer="country" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem;">
                            </div>
                            
                            <!-- City Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-city me-1" style="color: #7367f0;"></i> City
                                </label>
                                <input type="text" class="form-control-modern" wire:model.defer="budget" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem;">
                            </div>
                            
                            <!-- English Test Field -->
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 极速6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-language me-1" style="color: #7367f0;"></i> English Test
                                </label>
                                <input type="text" class="form-control-modern" wire:model.defer="extra" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem;">
                            </div>
                            
                            <!-- Future Plan Field (Full Width) -->
                            <div class="form-field" style="grid-column: 1 / -1; background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                                <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
                                    <i class="fas fa-lightbulb me-1" style="color: #7367f0;"></i> Future Plan
                                </label>
                                <input type="text" class="form-control-modern" wire:model.defer="plan" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem;">
                            </div>
                            
                            <!-- Remarks Field (Full Width) -->
                           <!-- Remarks Field (Full Width) -->
<div class="form-field" style="grid-column: 1 / -1; background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
    <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #495057;">
        <i class="fas fa-comment-dots me-1" style="color: #7367f0;"></i> 
        Add New Remarks 
        @if(!empty($response))
            @php
                // Calculate next follow-up number for display
                preg_match_all('/F(\d+)/', $response, $matches);
                $nextFollowUp = !empty($matches[1]) ? max(array_map('intval', $matches[1])) + 1 : 1;
            @endphp
            <span style="background: #7367f0; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; margin-left: 0.5rem;">
                F{{ $nextFollowUp }}
            </span>
        @else
            <span style="background: #7367f0; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; margin-left: 0.5rem;">
                F1
            </span>
        @endif
    </label>
    
    <textarea 
        class="form-control-modern" 
        rows="3" 
        wire:model.defer="newResponse" 
        placeholder="Enter follow-up remarks here. This will be saved as F{{ !empty($response) ? $nextFollowUp ?? 2 : 1 }} with timestamp."
        style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem; min-height: 100px;"
    ></textarea>
    
    <!-- Show follow-up history summary -->
    @if(!empty($response))
    <div style="margin-top: 0.75rem; padding: 0.75rem; background: #f8f9fa; border-radius: 6px; border-left: 4px solid #7367f0;">
        <small style="color: #495057; font-weight: 500;">
            <i class="fas fa-history me-1" style="color: #7367f0;"></i>
            Follow-up History: 
            @php
                preg_match_all('/F(\d+)/', $response, $matches);
                $followUps = !empty($matches[1]) ? $matches[1] : [];
                $totalFollowUps = count($followUps);
            @endphp
            @if($totalFollowUps > 0)
                <span style="color: #7367f0; font-weight: 600;">
                    {{ $totalFollowUps }} follow-up(s) recorded
                </span>
                (Latest: F{{ max($followUps) }})
            @else
                <span style="color: #6c757d;">
                    Initial response recorded
                </span>
            @endif
        </small>
    </div>
    @else
    <div style="margin-top: 0.75rem; padding: 0.75rem; background: #f8f9fa; border-radius: 6px; border-left: 4px solid #28a745;">
        <small style="color: #495057; font-weight: 500;">
            <i class="fas fa-plus-circle me-1" style="color: #28a745;"></i>
            This will be the first follow-up (F1)
        </small>
    </div>
    @endif
</div>
                        </div>
                    </form>
                </div>
        
                <!-- Footer -->
                <div class="modal-footer" style="padding: 1rem 1.5rem; border-top: 1px solid #e9ecef; display: flex; justify-content: flex-end; gap: 0.75rem; background: white;">
                    <button type="button" class="btn-secondary" wire:click="$set('showModal', false)" style="background: #6c757d; color: white; border: none; padding: 0.5rem 1.25rem; border-radius: 6px; cursor: pointer; font-weight: 500; transition: all 0.2s;">
                        Close
                    </button>
                    <button type="button" class="btn-primary" wire:click="update" wire:loading.attr="disabled" style="background: linear-gradient(90deg, #7367f0 0%, #9e95f5 100%); color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 6px; cursor: pointer; font-weight: 500; transition: all 0.2s; display: flex; align-items: center;">
                        <i class="fas fa-save me-2"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>

        <!-- Inline Keyframes -->
        <style>
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes slideIn {
                from { transform: scale(0.95) translateY(-20px); opacity: 0; }
                to { transform: scale(1) translateY(0); opacity: 1; }
            }
            
            /* Hover effects for better UX */
            .form-control-modern:focus {
                border-color: #7367f0;
                box-shadow: 0 0 0 3px rgba(115, 103, 240, 0.2);
                outline: none;
            }
            
            .btn-primary:hover {
                opacity: 0.9;
                transform: translateY(-1px);
                box-shadow: 0 4px 8px rgba(115, 103, 240, 0.3);
            }
            
            .btn-secondary:hover {
                opacity: 0.9;
                transform: translateY(-1px);
            }
        </style>
    @endif
</div>