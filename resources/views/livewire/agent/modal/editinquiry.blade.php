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
                                <select class="form-control-modern @error('type') is-invalid @enderror" wire:model="type" style="width: 100%; padding: 0.625rem; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s; font-size: 0.95rem; background: white;">
                                    <option value="">Select Type</option>
                                    <option value="Meta Leads W">Meta Leads W</option>
                                    <option value="Google Leads">Google Leads</option>
                                    <option value="Referral">Referral</option>
                                </select>
                                @error('type')
                                    <small class="text-danger" style="display: block; margin-top: 0.5rem; font-size: 0.8rem;">{{ $message }}</small>
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
                            <div class="form-field" style="background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
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
                           <!-- Response History Section (Full Width) -->
@if(!empty($response))
<!-- Divider -->
<div class="d-flex align-items-center my-4" style="grid-column: 1 / -1;">
    <hr class="flex-grow-1" style="border-color: #e9ecef; margin: 0;">
    <span class="px-3 text-muted fw-semibold small" style="color: #6c757d !important; font-weight: 600 !important; font-size: 0.875rem;">
        <i class="fas fa-history me-2"></i>Remark History
    </span>
    <hr class="flex-grow-1" style="border-color: #e9ecef; margin: 0;">
</div>

<div class="form-field" style="grid-column: 1 / -1; background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
    <div class="notes-history-container bg-gray-50 rounded-lg p-3 border" style="max-height: 180px; overflow-y: auto; background: #f8f9fa !important; border: 1px solid #e9ecef !important; border-radius: 8px !important;">
        @php
            // Parse follow-ups with better regex pattern
            $followUpData = [];
            
            // Check if the response contains our F-number format
            if (preg_match('/--- F\d+ \|/', $response)) {
                // Split by the F-number pattern
                $parts = preg_split('/(--- F\d+ \| [^-]+ ---)/', $response, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                
                $currentFollowUp = null;
                
                foreach ($parts as $part) {
                    $part = trim($part);
                    
                    // Check if this part is a header (contains F-number)
                    if (preg_match('/--- (F\d+) \| ([^-]+) ---/', $part, $headerMatches)) {
                        if ($currentFollowUp) {
                            $followUpData[] = $currentFollowUp;
                        }
                        
                        $currentFollowUp = [
                            'number' => $headerMatches[1],
                            'timestamp' => $headerMatches[2],
                            'content' => ''
                        ];
                    } else if ($currentFollowUp) {
                        // This is content for the current follow-up
                        $currentFollowUp['content'] = trim($part);
                    }
                }
                
                // Don't forget the last follow-up
                if ($currentFollowUp) {
                    $followUpData[] = $currentFollowUp;
                }
                
                // Handle the content before the first F-number (if any)
                if (!empty($parts) && !preg_match('/--- F\d+ \|/', $parts[0])) {
                    $initialContent = trim($parts[0]);
                    if (!empty($initialContent)) {
                        array_unshift($followUpData, [
                            'number' => 'F1',
                            'timestamp' => now()->format('M j, Y g:i A'), // Use current time as fallback
                            'content' => $initialContent
                        ]);
                    }
                }
            } else {
                // No F-number format found, treat as single response
                $content = trim($response);
                if (!empty($content)) {
                    $followUpData[] = [
                        'number' => 'F1',
                        'timestamp' => now()->format('M j, Y g:i A'), // Use current time as fallback
                        'content' => $content
                    ];
                }
            }
            
            $followUpData = array_reverse($followUpData); // Show latest first
        @endphp

        @if(count($followUpData) > 0)
            @foreach($followUpData as $index => $followUp)
                <div class="mb-3 pb-3 border-bottom border-gray-200" style="margin-bottom: 1rem !important; padding-bottom: 1rem !important; border-bottom: 1px solid #e9ecef !important; {{ $loop->last ? 'border-bottom: none !important; margin-bottom: 0 !important; padding-bottom: 0 !important;' : '' }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 28px; height: 28px; font-size: 0.7rem; background: linear-gradient(135deg, #7367F0 0%, #9e95f5 100%) !important;">
                                {{ $followUp['number'] }}
                            </div>
                            <div class="ms-2">
                                <span class="text-gray-800 small fw-semibold" style="color: #495057 !important; font-weight: 600 !important; font-size: 0.875rem;">
                                     {{ $followUp['number'] }}
                                </span>
                                <div class="text-muted" style="font-size: 0.75rem; color: #6c757d !important;">
                                    {{ \Carbon\Carbon::parse($followUp['timestamp'])->format('M d, Y h:i A') }}
                                </div>
                            </div>
                        </div>
                        @if($index === 0)
                            <span class="badge bg-success" style="background: #28a745 !important; color: white; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem;">
                                Latest
                            </span>
                        @endif
                    </div>
                    <div class="mt-2 ps-2 ms-4 border-start border-primary" style="margin-top: 0.5rem !important; padding-left: 0.5rem !important; margin-left: 1rem !important; border-left: 2px solid #7367F0 !important; font-size: 0.85rem; color: #495057; line-height: 1.4;">
                        {!! nl2br(htmlspecialchars_decode(trim($followUp['content']))) !!}
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-4 text-muted small" style="padding: 1.5rem 0; color: #6c757d !important;">
                <i class="fas fa-info-circle mb-2" style="font-size: 1.5rem; opacity: 0.5;"></i>
                <p class="mb-0" style="font-size: 0.85rem;">No previous remarks available</p>
            </div>
        @endif
    </div>
</div>
@else
<!-- Divider for empty state -->
<div class="d-flex align-items-center my-4" style="grid-column: 1 / -1;">
    <hr class="flex-grow-1" style="border-color: #e9ecef; margin: 0;">
    <span class="px-3 text-muted fw-semibold small" style="color: #6c757d !important; font-weight: 600 !important; font-size: 0.875rem;">
        <i class="fas fa-history me-2"></i>Remark History
    </span>
    <hr class="flex-grow-1" style="border-color: #e9ecef; margin: 0;">
</div>

<div class="form-field" style="grid-column: 1 / -1; background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
    <div class="notes-history-container bg-gray-50 rounded-lg p-3 border" style="max-height: 180px; overflow-y: auto; background: #f8f9fa !important; border: 1px solid #e9ecef !important; border-radius: 8px !important;">
        <div class="text-center py-4 text-muted small" style="padding: 1.5rem 0; color: #6c757d !important;">
            <i class="fas fa-info-circle mb-2" style="font-size: 1.5rem; opacity: 0.5;"></i>
            <p class="mb-0" style="font-size: 0.85rem;">No previous remarks available</p>
        </div>
    </div>
</div>
@endif
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