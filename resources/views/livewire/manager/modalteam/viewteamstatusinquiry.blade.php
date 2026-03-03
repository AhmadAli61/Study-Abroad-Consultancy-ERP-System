<div>
    @if ($showModal)
    <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); z-index: 1050; display: flex; align-items: center; justify-content: center; animation: fadeIn 0.3s ease-in-out;">
        <div style="width: 70vw; max-width: 95vw; height: 92vh; background: #fff; border-radius: 0.5rem; overflow: hidden; animation: slideDown 0.4s ease; box-shadow: 0 0 20px rgba(0,0,0,0.3); display: flex; flex-direction: column;">
            
            <div style="padding: 1rem; border-bottom: 1px solid #dee2e6; display: flex; align-items: center; justify-content: space-between;">
                <h5 style="margin: 0; font-weight: bold;">Inquiry Details - <span style="color: #007bff;">{{ ucfirst($name) }}</span></h5>
                <button wire:click="closeModal" type="button" style="background: none; border: none; font-size: 1.5rem; line-height: 1; cursor: pointer;">&times;</button>
            </div>
    
            <div style="padding: 1rem; overflow: auto; flex: 1;">
                <table class="table table-bordered" style="table-layout: fixed; width: 100%;">
                    <colgroup>
                        <col style="width: 50%;">
                        <col style="width: 50%;">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th><i class="fas fa-user"></i> Name</th>
                            <td>{!! !empty($name) ? e($name) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-phone"></i> Contact</th>
                            <td>{!! !empty($phone_number) ? e($phone_number) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                            <td>
                                <span class="badge"
                                    style="font-size: 13px; padding: 4px 6px;
                                    @if ($inquiry_status === 'hot') background-color: #ff5733;
                                    @elseif($inquiry_status === 'cold') background-color: #00c0ff;
                                    @elseif($inquiry_status === 'dead') background-color: #6c757d;
                                    @elseif($inquiry_status === 'open') background-color: #28a745;
                                    @elseif($inquiry_status === 'pending') background-color: #ffc107;
                                    @else background-color: #adb5bd; @endif">
                                    {{ ucfirst($inquiry_status ?? 'Null') }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-alt"></i> Assigned Date</th>
                            <td>
                                @if ($assigned_at)
                                    {{ \Carbon\Carbon::parse($assigned_at)->format('M d, Y') }}
                                @else
                                    <span class="badge bg-light text-black">Null</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-phone-square-alt"></i> Additional Contact</th>
                            <td>{!! !empty($phone_number2) ? e($phone_number2) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <td>{!! !empty($email) ? e($email) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-list"></i> Type</th>
                            <td>{!! !empty($type) ? e($type) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-graduation-cap"></i> Education</th>
                            <td>{!! !empty($study_course) ? e($study_course) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-globe"></i> Country</th>
                            <td>{!! !empty($country) ? e($country) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-city"></i> City</th>
                            <td>{!! !empty($budget) ? e($budget) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-bullseye"></i> Future Plan</th>
                            <td>{!! !empty($plan) ? e($plan) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-language"></i> English Test</th>
                            <td>{!! !empty($extra) ? e($extra) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-check"></i> Assigned At</th>
                            <td>{!! !empty($assigned_at) ? e($assigned_at) : '<span class="badge bg-light text-black">Null</span>' !!}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-comment-dots"></i> Remarks</th>
                            <td>
                                <div style="height: 80px; overflow-y: auto;">
                                    {!! !empty($response) ? e($response) : '<span class="badge bg-light text-black">Null</span>' !!}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    
            <div style="padding: 1rem; border-top: 1px solid #dee2e6; text-align: right;">
                <button wire:click="closeModal" type="button" style="background-color: #f6f6f6; border: 1px solid #ced4da; padding: 0.5rem 1rem; border-radius: 0.375rem; cursor: pointer;">
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
        from { transform: scale(0.95) translateY(-10px); opacity: 0; }
        to { transform: scale(1) translateY(0); opacity: 1; }
    }
    </style>
    
    @endif
    </div>
    