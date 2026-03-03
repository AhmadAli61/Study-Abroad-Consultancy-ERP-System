<div>
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-list fa-lg text-white"></i>
                <h4 class="mb-0 text-white"><strong>All Inquiries</strong></h4>
            </div>
            <div class="d-flex gap-3 align-items-center" style="width: 250px; max-width: 100%;">
                <input type="text" class="form-control" placeholder="Search by Name, Phone, Course..."
                       wire:model.defer="search">
                <button class="btn btn-primary" wire:click="searchInquiries">
                    <i class="fas fa-search"></i>
                </button>
            </div>

        </div>
        <table class="table table-bordered align-middle text-center" style="font-size: 15px;">
            <thead class="table-light">
                <tr>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
            <i class="fas fa-list-ol" style="margin-right: 5px;"></i>
        </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap;">
                        <i class="fas fa-user" style="margin-right: 5px;"></i> Name
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 120px;">
                        <i class="fas fa-phone" style="margin-right: 5px;"></i> Contact
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: normal; width: 25%;">
                        <i class="fas fa-reply" style="margin-right: 5px;"></i> Remarks
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap;">
                        <i class="fas fa-book" style="margin-right: 5px;"></i> Edu.
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: normal; width:15%">
                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Eng. Test
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap;">
                        <i class="fas fa-tags" style="margin-right: 5px;"></i> Assigned To
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 100px;">
                        <i class="fas fa-check-circle" style="margin-right: 5px;"></i> Status
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 8%;">
                        <i class="fas fa-info-circle me-1"></i> Unassign
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 80px;">
                        <i class="fas fa-cogs" style="margin-right: 5px;"></i> Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($allInquiries as $inquiry)
                <tr style="text-align: left" id="inquiry-{{ $inquiry->id }}">
                    <td style="vertical-align: middle; text-align: center;">
            {{ ($allInquiries->currentPage() - 1) * $allInquiries->perPage() + $loop->iteration }}
        </td>
                        <td class="whitespace-normal break-words max-w-[150px]" style="padding: 6px;">
                            <strong>
                                {!! !empty($inquiry->name) ? ucfirst(e($inquiry->name)) : '<span class="badge bg-light text-black">Null</span>' !!}
                            </strong>
                        </td>
                        <td style="vertical-align: middle; padding: 3px; white-space: nowrap;">
                            {!! !empty($inquiry->phone_number)
                                ? e($inquiry->phone_number)
                                : '<span class="badge bg-light text-black">Null</span>' !!}
                        </td>
           <td class="whitespace-normal break-words max-w-[150px] {{ empty($inquiry->response) ? 'text-center' : '' }}"
    style="padding: 6px; word-break: break-word; overflow-wrap: break-word;">
    
    @php
        $dateStatus = $this->getDateStatus($inquiry);
        $showIndicators = in_array($inquiry->inquiry_status, ['hot', 'cold', 'pending']);
    @endphp
    
    @if (!empty($inquiry->response))
        <!-- Response content in first row -->
        <div style="margin-bottom: 4px;">
            {{ $inquiry->response }}
        </div>
        
        <!-- Dates in separate row below -->
        <div class="d-block">
            @if($showIndicators)
                <div class="d-inline-block text-nowrap 
                    {{ $dateStatus['updated_at_old'] ? 'text-white rounded' : 'text-muted' }}"
                    style="{{ $dateStatus['updated_at_old'] ? 'background-color: #dc3545; animation: blink 1s linear infinite;' : '' }} 
                        padding: 2px 6px; font-size: 12px; max-width: fit-content;">
                    @if($inquiry->updated_at != $inquiry->created_at)
                        Last updated: {{ $inquiry->updated_at->format('d M Y h:i A') }}
                    @else
                        Created: {{ $inquiry->created_at->format('d M Y h:i A') }}
                    @endif
                </div>
            @else
                <div class="text-muted small d-inline-block">
                    @if($inquiry->updated_at != $inquiry->created_at)
                        Last updated: {{ $inquiry->updated_at->format('d M Y h:i A') }}
                    @else
                        Created: {{ $inquiry->created_at->format('d M Y h:i A') }}
                    @endif
                </div>
            @endif
        </div>
    @else
        <!-- No response case -->
        <div class="text-center">
            <span class="badge bg-light text-black">Null</span>
            @if($inquiry->assigned_at)
                <div class="mt-1 d-block">
                    @if($showIndicators)
                        <div class="d-inline-block text-nowrap 
                            {{ $dateStatus['assigned_at_pending'] ? 'text-white rounded' : 'text-muted' }}"
                            style="{{ $dateStatus['assigned_at_pending'] ? 'background-color: #b00020; animation: blink 1s linear infinite;' : '' }} 
                                padding: 2px 6px; font-size: 12px; max-width: fit-content;">
                            Assigned at: {{ \Carbon\Carbon::parse($inquiry->assigned_at)->format('d M Y h:i A') }}
                        </div>
                    @else
                        <div class="text-muted small d-inline-block">
                            Assigned at: {{ \Carbon\Carbon::parse($inquiry->assigned_at)->format('d M Y h:i A') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @endif

    @if($showIndicators)
        <style>
            @keyframes blink {
                0% { opacity: 1; }
                50% { opacity: 0.5; }
                100% { opacity: 1; }
            }
        </style>
    @endif
</td>

                        <td class="whitespace-normal break-words max-w-[200px]" style="padding: 8px;">
                            {!! !empty($inquiry->study_course)
                                ? e($inquiry->study_course)
                                : '<span class="badge bg-light text-black">Null</span>' !!}
                        </td>
                        <td style="vertical-align: middle; padding: 8px; white-space: normal;">
                            {!! !empty($inquiry->extra) ? e($inquiry->extra) : '<span class="badge bg-light text-black">Null</span>' !!}
                        </td>
                        <td style="vertical-aligh: middle; padding; 8px; white-space; normal;">
                            <strong>{{ $inquiry->assignedUser->username ?? 'Counsellor' }}</strong>
                        </td>
                        <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
                            <span class="badge text-white"
                                title="Updated at: {{ $inquiry->updated_at ? \Carbon\Carbon::parse($inquiry->updated_at)->format('M d, Y h:i A') : 'N/A' }}"
                                style="font-size: 13px; padding: 4px 6px;
                                @if ($inquiry->inquiry_status === 'hot') background-color: #ff5733;
                                @elseif($inquiry->inquiry_status === 'cold') background-color: #00c0ff;
                                @elseif($inquiry->inquiry_status === 'dead') background-color: #6c757d;
                                @elseif($inquiry->inquiry_status === 'open') background-color: #28a745;
                                @elseif($inquiry->inquiry_status === 'pending' || is_null($inquiry->inquiry_status)) background-color: #ffc107; color: #000;
                                @else background-color: #adb5bd; @endif">
                                @if ($inquiry->inquiry_status === 'cold')
                                    <i class="fas fa-snowflake me-1"></i> <strong>Cold</strong>
                                @elseif($inquiry->inquiry_status === 'hot')
                                    <i class="fas fa-fire me-1"></i> <strong>Hot</strong>
                                @elseif($inquiry->inquiry_status === 'dead')
                                    <i class="fas fa-times-circle me-1"></i> <strong>Dead</strong>
                                @elseif($inquiry->inquiry_status === 'open')
                                    <i class="fas fa-folder-open me-1"></i> <strong>Open</strong>
                                @elseif($inquiry->inquiry_status === 'pending' || is_null($inquiry->inquiry_status))
                                    <i class="fas fa-exclamation-circle me-1 text-black"></i> <strong
                                        class="text-black">Pending</strong>
                                @else
                                    {{ ucfirst($inquiry->inquiry_status) }}
                                @endif
                            </span>
                        </td>
                        <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
                            @if ($inquiry->status === 'assigned')
                                <span wire:click="unassignInquiry({{ $inquiry->id }})" class="badge bg-label-info"
                                    style="font-size: 13px; padding: 4px 6px; cursor: pointer;"
                                    title="Click to unassign">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            @else
                                <span class="badge bg-secondary" style="font-size: 13px; padding: 4px 6px;">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            @endif
                        </td>
                        <td
                            style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center; width: 100px;">
                            <div class="d-flex justify-content-center gap-1">
                                <button wire:click="$dispatch('editInquiry', { id: {{ $inquiry->id }} })"
                                    class="btn btn-xs btn-success px-2 py-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="$dispatch('viewDetails', { id: {{ $inquiry->id }} })"
                                    class="btn btn-xs btn-info px-2 py-1" title="Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No inquiries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-2">
            {{ $allInquiries->links('pagination::bootstrap-5') }}
        </div>
        <livewire:manager.modalteam.editteaminquiry/>
        <livewire:manager.modalteam.viewteaminquiry />
    
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const urlParams = new URLSearchParams(window.location.search);
                const inquiryId = urlParams.get("inquiryId");
    
                if (inquiryId) {
                    const row = document.getElementById(`inquiry-${inquiryId}`);
                    if (row) {
                        row.scrollIntoView({ behavior: "smooth", block: "center" });
                        row.style.transition = "background-color 1s ease";
                        row.style.backgroundColor = "#ffffcc";
    
                        setTimeout(() => {
                            row.style.backgroundColor = "";
                        }, 3000);
    
                        window.history.replaceState({}, document.title, window.location.pathname + "?page=" + urlParams.get("page"));
                    }
                }
            });
    </script>
</div>
