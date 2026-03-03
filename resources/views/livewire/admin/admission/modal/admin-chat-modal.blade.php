<div>
    @if($showModal)
        <!-- Animation wrapper -->
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); animation: fadeIn 0.3s ease-in-out;">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="animation: slideIn 0.3s ease-in-out;">
                <div class="modal-content border-0 shadow-lg">
                    <!-- Modal Header - Centered and Clean -->
                    <div class="modal-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                        <div class="d-flex align-items-center w-100">
                            <i class="fas fa-clipboard-list fa-lg me-3"></i>
                            <h5 class="modal-title mb-0 flex-grow-1 text-white">Update Inquiry Remarks</h5>
                            <div style="width: 24px;"></div> <!-- Spacer for balance -->
                        </div>
                        <button type="button" class="btn-close position-absolute end-3 top-3" wire:click="$set('showModal', false)" aria-label="Close"></button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body p-4">
                        <form wire:submit.prevent="update">
                            <!-- New Remark Section -->
                            <div class="mb-4">
                                <label for="notes" class="form-label fw-semibold text-gray-700 d-flex align-items-center">
                                    <i class="fas fa-plus-circle me-2 text-primary"></i>Add New Remark
                                </label>
                              <textarea class="form-control chat-modal-textarea" 
          id="notes" wire:model="notes" rows="4" 
          placeholder="Type your new remark here..."></textarea>
                                @error('notes') 
                                    <div class="mt-1 text-danger small">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Divider -->
                            <div class="d-flex align-items-center my-4">
                                <hr class="flex-grow-1 border-gray-300">
                                <span class="px-3 text-muted fw-semibold small">
                                    <i class="fas fa-history me-2"></i>Remark History
                                </span>
                                <hr class="flex-grow-1 border-gray-300">
                            </div>
                            
                            <!-- Notes History Section - Compact -->
                           <div class="notes-history-container bg-gray-50 rounded-lg p-2 border" style="max-height: 180px; overflow-y: auto;">
    @if($notes_history)
        @php
            $history = json_decode($notes_history, true);
            $history = array_reverse($history);
        @endphp
        
        @foreach($history as $note)
            <div class="mb-2 pb-2 border-bottom border-gray-200 last:border-0 last:mb-0 last:pb-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 28px; height: 28px; font-size: 0.7rem;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="ms-2">
                            <span class="text-gray-800 small fw-semibold">
                                {{ $note['user_name'] ?? (Str::contains($note['note'], ':') ? Str::before($note['note'], ':') : 'System' )}}
                            </span>
                            <div class="text-muted" style="font-size: 0.75rem;">
                                {{ \Carbon\Carbon::parse($note['timestamp'])->format('M d, Y h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-1 ps-2 ms-4 border-start border-primary" style="font-size: 0.85rem;">
                    @if(Str::contains($note['note'], ':'))
                        @php
                            $parts = explode(':', $note['note'], 2);
                            $remainingText = trim($parts[1] ?? '');
                        @endphp
                        {!! nl2br(htmlspecialchars_decode(trim($remainingText))) !!}
                    @else
                        {!! nl2br(htmlspecialchars_decode(trim($note['note']))) !!}
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-3 text-muted small">
            <i class="fas fa-info-circle mb-1"></i>
            <p class="mb-0" style="font-size: 0.85rem;">No previous remarks available</p>
        </div>
    @endif
</div>
                        </form>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-gray-100 border-top">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" wire:click="$set('showModal', false)">
                            <i class="fas fa-times me-2"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" wire:click="update">
                            <i class="fas fa-save me-2"></i> Save Changes
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
               /* Add this to your existing style section */
    .chat-modal-textarea {
        border: 2px solid #d1d5db !important;
    }
    .chat-modal-textarea:focus {
        border-color: #7367F0 !important; /* Green color */
        box-shadow: 0 0 0 0.2rem rgba(167, 137, 236, 0.25) !important;
        outline: none !important;
    }
        </style>
    @endif
</div>