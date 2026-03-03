<div>
    <div class="card">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-times-circle fa-lg text-white"></i>
                <h4 class="mb-0 text-white"><strong>Dead Inquiries</strong></h4>
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
                        <i class="fas fa-book" style="margin-right: 5px;"></i> Education
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: normal; width:15%">
                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> English Test
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap;">
                        <i class="fas fa-tags" style="margin-right: 5px;"></i> Assigned To
                    </th>
                    <th style="vertical-align: middle; padding: 10px; white-space: nowrap; width: 100px;">
                        <i class="fas fa-check-circle" style="margin-right: 5px;"></i> Status
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
                        {!! !empty($inquiry->name) 
                            ? '<strong>' . e(ucfirst($inquiry->name)) . '</strong>' 
                            : '<span class="badge bg-light text-black">Null</span>' !!}
                    </td>
                    
                    <td style="vertical-align: middle; padding: 3px; white-space: nowrap;">
                        {!! !empty($inquiry->phone_number) ? e($inquiry->phone_number) : '<span class="badge bg-light text-black">Null</span>' !!}
                    </td>
                                        <td class="whitespace-normal break-words max-w-[150px] {{ empty($inquiry->response) ? 'text-center' : '' }}"
    style="padding: 6px; word-break: break-word; overflow-wrap: break-word;">
    
    @if (!empty($inquiry->response))
        <div>
            {{ $inquiry->response }}
            <div class="text-muted small mt-1">
                @if($inquiry->updated_at != $inquiry->created_at)
                    Last updated: {{ $inquiry->updated_at->format('d M Y h:i A') }}
                @else
                    Created: {{ $inquiry->created_at->format('d M Y h:i A') }}
                @endif
            </div>
        </div>
    @else
        <div class="text-center">
            <span class="badge bg-light text-black">Null</span>
            @if($inquiry->assigned_at)
                <div class="text-muted small mt-1">
                    Assigned at: {{ \Carbon\Carbon::parse($inquiry->assigned_at)->format('d M Y h:i A') }}
                </div>
            @endif
        </div>
    @endif
</td>
                
                    <td class="whitespace-normal break-words max-w-[200px]" style="padding: 8px;">
                        {!! !empty($inquiry->study_course) ? e(ucfirst($inquiry->study_course)) : '<span class="badge bg-light text-black">Null</span>' !!}
                    </td>
                    <td style="vertical-align: middle; padding: 8px; white-space: normal;">
                        {!! !empty($inquiry->extra) ? e($inquiry->extra) : '<span class="badge bg-light text-black">Null</span>' !!}
                    </td>
                    <td style="vertical-align: middle; padding: 8px; white-space: normal;">
                        <strong 
                            title="Assigned at: {{ $inquiry->assigned_at ? \Carbon\Carbon::parse($inquiry->assigned_at)->format('M d, Y h:i A') : 'N/A' }}">
                            {{ !empty($inquiry->assignedUser->username) ? $inquiry->assignedUser->username : '<span class="badge bg-light text-black">Null</span>' }}
                        </strong>
                    </td>
                    <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center;">
                        <span 
                            class="badge text-white" 
                            title="Last updated: {{ $inquiry->updated_at ? \Carbon\Carbon::parse($inquiry->updated_at)->format('M d, Y h:i A') : 'N/A' }}" 
                            style="font-size: 13px; padding: 4px 6px; background-color: #6c757d;">
                            <i class="fas fa-times-circle me-1"></i> <strong>Dead</strong>
                        </span>
                    </td>
                    <td style="vertical-align: middle; padding: 8px; white-space: nowrap; text-align: center; width: 100px;">
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
                        <td colspan="7" class="text-center">No inquiries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


        <livewire:manager.modalteam.editteamdeadinquiry />
        <livewire:manager.modalteam.viewteamstatusinquiry />

        <div class="mt-2">
            {{ $allInquiries->links('pagination::bootstrap-5') }}
        </div>



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
