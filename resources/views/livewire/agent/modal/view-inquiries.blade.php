<div>
    @if ($showModal)
    <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); z-index: 1050; display: flex; align-items: center; justify-content: center; animation: fadeIn 0.3s ease-in-out;">
        <div style="width: 85vw; max-width: 1000px; height: 85vh; background: #fff; border-radius: 12px; overflow: hidden; animation: slideDown 0.4s ease; box-shadow: 0 10px 40px rgba(0,0,0,0.2); display: flex; flex-direction: column;">
            
            <!-- Header -->
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #e9ecef; display: flex; align-items: center; justify-content: space-between; background: linear-gradient(90deg, #7367f0); color: white;">
                <h5 style="margin: 0; font-weight: 600; font-size: 1.25rem; color: #ffffff;">
                    <i class="fas fa-info-circle mr-2 text-white"></i> Inquiry Details - <span style="color: #ffffff;">{{ ucfirst($name) }}</span>
                </h5>
                <button wire:click="closeModal" type="button" style="background: rgba(255,255,255,0.2); border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 1.25rem; line-height: 1; cursor: pointer; color: white; display: flex; align-items: center; justify-content: center;">
                    &times;
                </button>
            </div>
    
            <!-- Content Area -->
            <div style="padding: 1.5rem; overflow: auto; flex: 1; background: #f8f9fa;">
                <div style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <colgroup>
                            <col style="width: 30%; background: #f8f9fa;">
                            <col style="width: 70%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-user mr-2" style="color: #7367f0;"></i> Name
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($name) ? e($name) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-phone mr-2" style="color: #7367f0;"></i> Contact
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($phone_number) ? e($phone_number) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-info-circle mr-2" style="color: #7367f0;"></i> Status
                                </td>
                               <td style="padding: 1rem; border-bottom: 1px solid #e9ecef;">
    <span class="badge"
        style="font-size: 0.8rem; padding: 0.35rem 0.7rem; border-radius: 4px; font-weight: 500;
        @if ($inquiry_status === 'hot') background-color: #ff5722; color: white;
        @elseif($inquiry_status === 'cold') background-color: #00cfe8; color: white;
        @elseif($inquiry_status === 'dead') background-color: #6c757d; color: white;
        @elseif($inquiry_status === 'open') background-color: #4caf50; color: white;
        @elseif($inquiry_status === 'pending') background-color: #f1bf28; color: rgb(10, 10, 10);
        @else background-color: #e9ecef; color: #495057; @endif">
        
        @if ($inquiry_status === 'cold')
            <i class="fas fa-snowflake me-1"></i> Cold
        @elseif($inquiry_status === 'hot')
            <i class="fas fa-fire me-1"></i> Hot
        @elseif($inquiry_status === 'dead')
            <i class="fas fa-times-circle me-1"></i> Dead
        @elseif($inquiry_status === 'open')
            <i class="fas fa-folder-open me-1"></i> Open
        @elseif($inquiry_status === 'pending')
            <i class="fas fa-hourglass-half me-1"></i> Pending
        @else
            {{ ucfirst($inquiry_status ?? 'Not set') }}
        @endif
    </span>
</td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-calendar-alt mr-2" style="color: #7367f0;"></i> Assigned Date
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    @if ($assigned_at)
                                        {{ \Carbon\Carbon::parse($assigned_at)->format('M d, Y') }}
                                    @else
                                        <span class="badge bg-light text-black-50">Not assigned</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-phone-square-alt mr-2" style="color: #7367f0;"></i> Additional Contact
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($phone_number2) ? e($phone_number2) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-envelope mr-2" style="color: #7367f0;"></i> Email
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($email) ? e($email) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-list mr-2" style="color: #7367f0;"></i> Type
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($type) ? e($type) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-graduation-cap mr-2" style="color: #7367f0;"></i> Education
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($study_course) ? e($study_course) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-globe mr-2" style="color: #7367f0;"></i> Country
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($country) ? e($country) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-city mr-2" style="color: #7367f0;"></i> City
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($budget) ? e($budget) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-bullseye mr-2" style="color: #7367f0;"></i> Future Plan
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($plan) ? e($plan) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-language mr-2" style="color: #7367f0;"></i> English Test
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($extra) ? e($extra) : '<span class="badge bg-light text-black-50">Not provided</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-calendar-check mr-2" style="color: #7367f0;"></i> Assigned At
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($assigned_at) ? e($assigned_at) : '<span class="badge bg-light text-black-50">Not assigned</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                    <!-- Divider -->
<!-- Response History Section (Full Width) -->
@if(!empty($response))
<!-- Divider 1 - Compact Format -->
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

<!-- Empty Remarks Section -->
<div class="d-flex align-items-center my-3" style="grid-column: 1 / -1;">
    <hr class="flex-grow-1" style="border-color: #dee2e6; margin: 0;">
    <span class="px-3 text-muted fw-semibold small" style="color: #6c757d !important; font-weight: 600 !important; font-size: 0.875rem;">
        <i class="fas fa-comment-dots me-2" style="color: #7367F0 !important;"></i>Remarks
    </span>
    <hr class="flex-grow-1" style="border-color: #dee2e6; margin: 0;">
</div>

<div class="form-field" style="grid-column: 1 / -1; background: white; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
    <div class="bg-light rounded-lg p-3 border shadow-sm" style="max-height: 150px; overflow-y: auto; background: #f8f9fa !important; border: 1px solid #e9ecef !important; border-radius: 8px !important;">
        <div class="text-center py-3 text-muted small" style="padding: 1rem 0; color: #6c757d !important;">
            <i class="fas fa-info-circle mb-1"></i>
            <p class="mb-0" style="font-size: 0.85rem;">No remarks available</p>
        </div>
    </div>
</div>
@endif

                </div>
            </div>
    
            <!-- Footer -->
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #e9ecef; text-align: right; background: white;">
                <button wire:click="closeModal" type="button" style="background: linear-gradient(90deg, #7367f0); color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 6px; cursor: pointer; font-weight: 500; transition: all 0.2s;">
                    Close
                </button>
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
    </style>
    
    @endif
</div>