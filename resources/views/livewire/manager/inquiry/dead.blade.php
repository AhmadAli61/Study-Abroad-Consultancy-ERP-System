<div>
    <div class="card">
        <div>
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-times-circle fa-lg text-white"></i>
                    <h4 class="mb-0 text-white"><strong>Dead Inquiries</strong></h4>
                </div>
                  <!-- UPDATED: Search input group with exact same layout as admission portal -->
    <div class="input-group" style="width: 300px;" wire:key="search-container-{{ $search }}">
        <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-search text-muted"></i>
        </span>
        <input type="text" 
               class="form-control border-start-0 ps-0" 
               placeholder="Search by Name, Phone" 
               wire:model.defer="search"
               style="box-shadow: none !important;">
        <button class="btn btn-dark d-flex align-items-center gap-2" wire:click="searchInquiries">
            <i class="fas fa-search"></i>
            <span></span>
        </button>
    </div>
            </div>
            <div class="card ">
                <table class="table table-bordered align-middle text-center" style="font-size: 15px;">
                    <thead class="table-light">
                        <tr>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
            <i class="fas fa-list-ol" style="margin-right: 5px;"></i>
        </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                                <i class="fas fa-user" style="margin-right: 5px;"></i> Name
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                                <i class="fas fa-phone" style="margin-right: 5px;"></i> Contact
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: normal; width: 35%;">
                                <i class="fas fa-reply" style="margin-right: 5px;"></i> Remarks
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 12%;">
                                <i class="fas fa-book" style="margin-right: 5px;"></i> Education
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 20%;">
                                <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Extra
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
                                <i class="fas fa-check-circle" style="margin-right: 5px;"></i> Status
                            </th>
                            <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 5%;">
                                <i class="fas fa-cogs" style="margin-right: 5px;"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($managerInquiries as $inquiry)
                        <tr style="text-align: left" id="inquiry-{{ $inquiry->id }}">
                            <td style="vertical-align: middle; text-align: center;">
            {{ ($managerInquiries->currentPage() - 1) * $managerInquiries->perPage() + $loop->iteration }}
        </td>
                                <td class="whitespace-normal break-words max-w-[150px] {{ empty($inquiry->name) ? 'text-center' : '' }}"
                                    style="padding: 6px;">
                                    @if (!empty($inquiry->name))
                                        <strong>{{ ucfirst($inquiry->name) }}</strong>
                                    @else
                                        <span class="badge bg-light text-black">Null</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle; padding: 3px; white-space: nowrap;">
                                    @if (!empty($inquiry->phone_number))
                                        {{ $inquiry->phone_number }}
                                    @else
                                        <span class="badge bg-light text-black">Null</span>
                                    @endif
                                </td>
      <td style="vertical-align: top; padding: 6px;">
    <div class="notes-container"
         style="height: 120px; overflow-y: auto; border: 1px solid #e0e0e0; border-radius: 6px; padding: 8px; background: #f8f9fa; font-size: 13px;">

        @if (!empty($inquiry->response))
            {{-- Response --}}
            <div class="mb-2 pb-2 border-bottom" style="border-bottom: 1px dashed #ddd !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>Response</strong>
                    <small class="text-muted" style="font-size: 10px;">
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
                <div class="d-flex justify-content-between align-items-center mt-1">
                    <strong>Assigned</strong>
                    <small class="text-muted" style="font-size: 10px;">
                        Assigned At: {{ \Carbon\Carbon::parse($inquiry->assigned_at)->format('d M Y h:i A') }}
                    </small>
                </div>
            @endif
        @endif
    </div>
</td>

                                
                                <td class="whitespace-normal break-words max-w-[150px] {{ empty($inquiry->study_course) ? 'text-center' : '' }}"
                                    style="padding: 6px; word-break: break-word; overflow-wrap: break-word;">
                                    @if (!empty($inquiry->study_course))
                                        {{ ucfirst($inquiry->study_course) }}
                                    @else
                                        <span class="badge bg-light text-black">Null</span>
                                    @endif
                                </td>
                                <td class="whitespace-normal break-words max-w-[150px] {{ empty($inquiry->extra) ? 'text-center' : '' }}"
                                    style="padding: 6px; word-break: break-word; overflow-wrap: break-word;">
                                    @if (!empty($inquiry->extra))
                                        {{ ucfirst($inquiry->extra) }}
                                    @else
                                        <span class="badge bg-light text-black">Null</span>
                                    @endif
                                </td>
                                <td
                                    style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
                                    <span class="badge text-white"
                                        style="font-size: 13px; padding: 4px 6px; background-color: #6c757d;"
                                        title="Updated at: {{ $inquiry->updated_at ? \Carbon\Carbon::parse($inquiry->updated_at)->format('M d, Y h:i A') : 'N/A' }}">
                                        <i class="fas fa-times-circle me-1"></i> <strong>Dead</strong>
                                    </span>
                                </td>
                                <td
                                    style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
      <!-- UPDATED MODALS: Added unique keys and wire:key attributes -->
    <livewire:manager.modalmanager.modaldeadinquiries 
        wire:key="modal-dead-inquiries-{{ time() }}" />
    
    <livewire:manager.modalmanager.modalviewstatusinquiries 
        wire:key="modal-view-status-{{ time() }}" />

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
</div>
