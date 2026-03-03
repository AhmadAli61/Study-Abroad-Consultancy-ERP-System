<div>
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); animation: fadeIn 0.3s ease-in-out;">
            <div class="modal-dialog modal-dialog-centered modal-xl" style="width: 70vw; max-width: 95vw;">
                <div class="modal-content" style="height: 92vh; animation: slideDown 0.4s ease;">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Inquiry Details - <span class="fw-bold text-primary">{{ ucfirst($name) }}</span>
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>

                    <div class="modal-body" style="overflow-y: auto;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm w-100" style="font-size: 15px; table-layout: fixed;">
                                <tbody>
                                    <!-- Name -->
                                    <tr>
                                        <th style="padding: 6px; width: 50%;"><i class="fas fa-user me-2 text-primary"></i> Name</th>
                                        <td style="padding: 6px; width: 50%;">
                                            {!! !empty($name) ? e($name) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>

                                    <!-- Phone -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-phone me-2 text-primary"></i> Contact</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($phone_number) ? e($phone_number) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>

                                    <!-- Inquiry Status -->
                                    <tr>
                                        <th style="padding: 6px; vertical-align: middle;">
                                            <i class="fas fa-info-circle me-2 text-primary"></i> Status
                                        </th>
                                        <td style="vertical-align: middle; padding: 6px;">
                                            <span class="badge"
                                                style="font-size: 13px; padding: 4px 6px;
                                                    @if ($inquiry_status === 'hot') background-color: #ff5733;
                                                    @elseif($inquiry_status === 'cold') background-color: #00c0ff;
                                                    @elseif($inquiry_status === 'dead') background-color: #6c757d;
                                                    @elseif($inquiry_status === 'open') background-color: #28a745;
                                                    @elseif($inquiry_status === 'pending') background-color: #ffc107;
                                                    @else background-color: #adb5bd; @endif">
                                                @if ($inquiry_status === 'cold')
                                                    <i class="fas fa-snowflake me-1" style="color: white;"></i> Cold
                                                @elseif($inquiry_status === 'hot')
                                                    <i class="fas fa-fire me-1" style="color: white;"></i> Hot
                                                @elseif($inquiry_status === 'dead')
                                                    <i class="fas fa-times-circle me-1" style="color: white;"></i> Dead
                                                @elseif($inquiry_status === 'open')
                                                    <i class="fas fa-folder-open me-1" style="color: black;"></i> Open
                                                    @elseif($inquiry_status === 'pending') 
                                                    <i class="fas fa-hourglass-half me-1" style="color: rgb(9, 9, 9);"></i> 
                                                    <span style="color: black;">Pending</span>
                                                    @else
                                                    {{ ucfirst($inquiry_status ?? 'Null') }}
                                                @endif
                                                
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Assigned Date -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-calendar me-2 text-primary"></i> Assigned Date</th>
                                        <td style="padding: 6px;">
                                            @if ($assigned_at)
                                                {{ \Carbon\Carbon::parse($assigned_at)->format('M d, Y') }}
                                            @else
                                                <span class="badge bg-light text-black">Null</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Additional Fields -->
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-phone-volume me-2 text-primary"></i> Contact (Additional)</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($phone_number2) ? e($phone_number2) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-envelope me-2 text-primary"></i> Email</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($email) ? e($email) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-tags me-2 text-primary"></i> Type</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($type) ? e($type) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-graduation-cap me-2 text-primary"></i> Education</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($study_course) ? e($study_course) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-globe-asia me-2 text-primary"></i> Country</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($country) ? e($country) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-money-bill-wave me-2 text-primary"></i> City</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($budget) ? e($budget) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-calendar-alt me-2 text-primary"></i> Future Plan</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($plan) ? e($plan) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px;"><i class="fas fa-star me-2 text-primary"></i> English Test</th>
                                        <td style="padding: 6px;">
                                            {!! !empty($extra) ? e($extra) : '<span class="badge bg-light text-black">Null</span>' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 6px; vertical-align: top;"><i class="fas fa-comment-dots me-2 text-primary"></i> Remarks</th>
                                        <td style="padding: 6px;">
                                            <div style="height: 80px;">
                                                {!! !empty($response) ? e($response) : '<span class="badge bg-light text-black">Null</span>' !!}
                                            </div>
                                        </td>
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
