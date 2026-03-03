<div>
    @if ($showModal)
    <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); z-index: 1050; display: flex; align-items: center; justify-content: center; animation: fadeIn 0.3s ease-in-out;">
        <div style="width: 85vw; max-width: 1000px; height: 85vh; background: #fff; border-radius: 12px; overflow: hidden; animation: slideDown 0.4s ease; box-shadow: 0 10px 40px rgba(0,0,0,0.2); display: flex; flex-direction: column;">
            
            <!-- Header -->
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #e9ecef; display: flex; align-items: center; justify-content: space-between; background: linear-gradient(90deg, #7367f0, #7367f0); color: white;">
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
                            <!-- Name -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-user mr-2" style="color: #7367f0;"></i> Name
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($name) ? e($name) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- Contact -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-phone mr-2" style="color: #7367f0;"></i> Contact
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($phone_number) ? e($phone_number) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- Status -->
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
                                            {{ ucfirst($inquiry_status ?? 'Null') }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            
                            <!-- Assigned Date -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-calendar-alt mr-2" style="color: #7367f0;"></i> Assigned Date
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    @if ($assigned_at)
                                        {{ \Carbon\Carbon::parse($assigned_at)->format('M d, Y') }}
                                    @else
                                        <span class="badge bg-light text-black-50">Null</span>
                                    @endif
                                </td>
                            </tr>
                            
                            <!-- Additional Contact -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-phone-square-alt mr-2" style="color: #7367f0;"></i> Additional Contact
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($phone_number2) ? e($phone_number2) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- Email -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-envelope mr-2" style="color: #7367f0;"></i> Email
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($email) ? e($email) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- Type -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-list mr-2" style="color: #7367f0;"></i> Type
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($type) ? e($type) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- Education -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-graduation-cap mr-2" style="color: #7367f0;"></i> Education
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($study_course) ? e($study_course) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- Country -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-globe mr-2" style="color: #7367f0;"></i> Country
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($country) ? e($country) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- City -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-city mr-2" style="color: #7367f0;"></i> City
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($budget) ? e($budget) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- Future Plan -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-bullseye mr-2" style="color: #7367f0;"></i> Future Plan
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($plan) ? e($plan) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- English Test -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-language mr-2" style="color: #7367f0;"></i> English Test
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($extra) ? e($extra) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                            
                            <!-- Assigned At -->
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #495057;">
                                    <i class="fas fa-calendar-check mr-2" style="color: #7367f0;"></i> Assigned At
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #e9ecef; color: #212529;">
                                    {!! !empty($assigned_at) ? e($assigned_at) : '<span class="badge bg-light text-black-50">Null</span>' !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Divider -->
                    <div style="display: flex; align-items: center; margin: 1rem 0;">
                        <hr style="flex-grow: 1; border-color: #dee2e6;">
                        <span style="padding: 0 0.75rem; color: #6c757d; font-weight: 500; font-size: 0.875rem;">
                            <i class="fas fa-comment-dots me-2" style="color: #7367f0;"></i>Remarks
                        </span>
                        <hr style="flex-grow: 1; border-color: #dee2e6;">
                    </div>

                    <!-- Remarks Section -->
                    <div style="background-color: #f8f9fa; border-radius: 0.5rem; padding: 0.75rem; border: 1px solid #dee2e6; box-shadow: 0 1px 3px rgba(0,0,0,0.05); max-height: 150px; overflow-y: auto;">
                        @if(!empty($response))
                            <div style="display: flex; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #dee2e6; align-items: start;">
                                <div style="display: flex; align-items: start; width: 100%;">
                                    <div style="background-color: #7367f0; color: white; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; margin-right: 0.5rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div style="flex-grow: 1;">
                                        <div style="font-weight: 600; color: #212529; font-size: 0.875rem;">Counsellor</div>
                                        <div style="color: #6c757d; font-size: 0.75rem; margin-bottom: 0.25rem;">{{ now()->format('M d, Y h:i A') }}</div>
                                        <div style="padding-left: 0.5rem; margin-left: 0.25rem; border-left: 2px solid #7367f0; font-size: 0.875rem; color: #495057;">
                                            {!! nl2br(e($response)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div style="text-align: center; padding: 0.75rem; color: #6c757d;">
                                <i class="fas fa-info-circle mb-1"></i>
                                <p style="margin: 0; font-size: 0.85rem;">No remarks available</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    
            <!-- Footer -->
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #e9ecef; text-align: right; background: white;">
                <button wire:click="closeModal" type="button" style="background: linear-gradient(90deg, #7367f0, #7367f0); color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 6px; cursor: pointer; font-weight: 500; transition: all 0.2s;">
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
    .badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    .text-black-50 {
        color: rgba(0, 0, 0, 0.5) !important;
    }
    </style>
    
    @endif
</div>