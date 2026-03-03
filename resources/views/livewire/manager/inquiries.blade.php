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
        <table class="table table-bordered align-middle text-center" style="font-size: 15px; table-layout: fixed; width: 100%;">
            <thead class="table-light">
                <tr>
                    <th style="width: 4%; vertical-align: middle; padding: 10px;">
                        <i class="fas fa-list-ol me-1"></i>
                    </th>
                    <th style="width: 8%; vertical-align: middle; padding: 10px;">
                        <i class="fas fa-user me-1"></i> Name
                    </th>
                    <th style="width: 10%; vertical-align: middle; padding: 10px;">
                        <i class="fas fa-phone me-1"></i> Contact
                    </th>
                    <!-- Increased Remarks width -->
                    <th style="width: 25%; vertical-align: middle; padding: 15px;">
                        <i class="fas fa-reply me-1"></i> Remarks
                    </th>
                    <!-- Decreased Education width -->
                    <th style="width: 9%; vertical-align: middle; padding: 10px;">
                        <i class="fas fa-book me-1"></i> Edu.
                    </th>
                    <th style="width: 9%; vertical-align: middle; padding: 10px;">
                        <i class="fas fa-plus-circle me-1"></i> Eng. Test
                    </th>
                    <th style="width: 9%; vertical-align: middle; padding: 10px;">
                        <i class="fas fa-check-circle me-1"></i> Status
                    </th>
                    <th style="width: 8%; vertical-align: middle; padding: 10px;">
                        <i class="fas fa-info-circle me-1"></i> Unassign
                    </th>
                    <th style="width: 8%; vertical-align: middle; padding: 10px;">
                        <i class="fas fa-cogs me-1"></i> Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($managerInquiries as $inquiry)
                <tr style="text-align: left" id="inquiry-{{ $inquiry->id }}">
                    <td style="vertical-align: middle; text-align: center;">
                        {{ ($managerInquiries->currentPage() - 1) * $managerInquiries->perPage() + $loop->iteration }}
                    </td>
                    <td style="padding: 6px; overflow: hidden; text-overflow: ellipsis;">
                        <strong>
                            @if (!empty($inquiry->name))
                                {{ ucfirst($inquiry->name) }}
                            @else
                                <span class="badge bg-light text-black">Null</span>
                            @endif
                        </strong>
                    </td>
                    <td style="vertical-align: middle; padding: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        @if (!empty($inquiry->phone_number))
                            {{ $inquiry->phone_number }}
                        @else
                            <span class="badge bg-light text-black">Null</span>
                        @endif
                    </td>
                     <td style="vertical-align: top; padding: 6px;">
    <div class="response-container" 
         style="height: 120px; overflow-y: auto; border: 1px solid #e0e0e0; border-radius: 6px; padding: 8px; background: #f8f9fa; font-size: 13px;">

        @php
            $dateStatus = $this->getDateStatus($inquiry);
        @endphp

        @if (!empty($inquiry->response))
            {{-- Response Exists --}}
            <div class="mb-2 pb-2 border-bottom" style="border-bottom: 1px dashed #ddd !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>Response</strong>
                    <small class="{{ $dateStatus['updated_at_old'] ? 'text-white rounded px-2' : 'text-muted' }}"
                           style="{{ $dateStatus['updated_at_old'] ? 'background-color: #dc3545; animation: blink 1s linear infinite;' : '' }} font-size: 10px;">
                        @if($inquiry->updated_at != $inquiry->created_at)
                            Last Updated: {{ $inquiry->updated_at->format('d M Y h:i A') }}
                        @else
                            Created: {{ $inquiry->created_at->format('d M Y h:i A') }}
                        @endif
                    </small>
                </div>
                <div class="mt-1">
                    {{ nl2br(e($inquiry->response)) }}
                </div>
            </div>
        @else
            {{-- No Response --}}
            <div class="text-center mb-2">
                <span class="badge bg-light text-black">Null</span>
            </div>

            @if($inquiry->assigned_at)
    <div class="d-flex justify-content-center mt-1">
        <small class="{{ $dateStatus['assigned_at_pending'] ? 'text-white rounded px-2' : 'text-muted' }}"
               style="{{ $dateStatus['assigned_at_pending'] ? 'background-color: #b00020; animation: blink 1s linear infinite;' : '' }} font-size: 10px;">
            Assigned At: {{ \Carbon\Carbon::parse($inquiry->assigned_at)->format('d M Y h:i A') }}
        </small>
    </div>
@endif

        @endif
    </div>

    <style>
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
    </style>
</td>
                    <td style="padding: 8px; overflow: hidden; text-overflow: ellipsis;">
                        @if (!empty($inquiry->study_course))
                            {{ $inquiry->study_course }}
                        @else
                            <span class="badge bg-light text-black">Null</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle; padding: 8px; white-space: normal; overflow: hidden; text-overflow: ellipsis;">
                        @if (!empty($inquiry->extra))
                            {{ $inquiry->extra }}
                        @else
                            <span class="badge bg-light text-black">Null</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
                        <span class="badge text-white" style="font-size: 13px; padding: 4px 6px;
                            @if($inquiry->inquiry_status === 'hot') background-color: #ff5733;
                            @elseif($inquiry->inquiry_status === 'cold') background-color: #00c0ff;
                            @elseif($inquiry->inquiry_status === 'dead') background-color: #6c757d;
                            @elseif($inquiry->inquiry_status === 'registered') background-color: #28a745;
                            @elseif($inquiry->inquiry_status === 'open') background-color: #28a745;
                            @elseif($inquiry->inquiry_status === 'pending' || is_null($inquiry->inquiry_status)) background-color: #ffc107; color: #000;
                            @else background-color: #adb5bd;
                            @endif"
                            title="Updated at: {{ $inquiry->updated_at ? \Carbon\Carbon::parse($inquiry->updated_at)->format('M d, Y h:i A') : 'N/A' }}">

                            @if($inquiry->inquiry_status === 'cold')
                                <i class="fas fa-snowflake me-1"></i> <strong>Cold</strong>
                            @elseif($inquiry->inquiry_status === 'hot')
                                <i class="fas fa-fire me-1"></i> <strong>Hot</strong>
                            @elseif($inquiry->inquiry_status === 'dead')
                                <i class="fas fa-times-circle me-1"></i> <strong>Dead</strong>
                            @elseif($inquiry->inquiry_status === 'open')
                                <i class="fas fa-folder-open me-1"></i> <strong>Open</strong>
                            @elseif($inquiry->inquiry_status === 'registered')
                                <i class="fas fa-check-circle me-1"></i> <strong>Registered</strong>
                            @elseif($inquiry->inquiry_status === 'pending' || is_null($inquiry->inquiry_status))
                                <i class="fas fa-exclamation-circle me-1" style="color: black"></i> <strong style="color: black">Pending</strong>
                            @else
                                {{ ucfirst($inquiry->inquiry_status) }}
                            @endif
                        </span>
                    </td>
       <td style="vertical-align: middle; padding: 8px; white-space: nowrap;">
    @if($inquiry->status === 'assigned')
        <span wire:click="{{ $inquiry->inquiry_status !== 'registered' ? 'unassignInquiry('.$inquiry->id.')' : '' }}"
              @if($inquiry->inquiry_status !== 'registered')
                  wire:confirm="Are you sure you want to unassign this inquiry?"
              @endif
              class="badge bg-label-info"
              style="font-size: 13px; padding: 4px 6px; cursor: {{ $inquiry->inquiry_status !== 'registered' ? 'pointer' : 'not-allowed' }}; opacity: {{ $inquiry->inquiry_status === 'registered' ? '0.6' : '1' }};"
              title="{{ $inquiry->inquiry_status === 'registered' ? 'Cannot unassign registered inquiries' : 'Click to unassign' }}">
            {{ ucfirst($inquiry->status) }}
        </span>
    @else
        <span class="badge bg-secondary"
              style="font-size: 13px; padding: 4px 6px;">
            {{ ucfirst($inquiry->status) }}
        </span>
    @endif
</td>
                    <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
                        <div class="d-flex justify-content-center gap-1">
                            <button wire:click="$dispatch('editInquiry', { id: {{ $inquiry->id }} })"
                                class="btn btn-xs px-2 py-1 {{ $inquiry->inquiry_status === 'registered' ? 'btn-secondary disabled' : 'btn-success' }}"
                                {{ $inquiry->inquiry_status === 'registered' ? 'disabled' : '' }}>
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="$dispatch('viewDetails', { id: {{ $inquiry->id }} })"
                                class="btn btn-xs btn-info px-2 py-1" title="Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <livewire:manager.modalmanager.modalinquiries/>
    <livewire:manager.modalmanager.modalviewinquiries />

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
    <div class="mt-2">
        {{ $managerInquiries->links('pagination::bootstrap-5') }}
    </div>
</div>