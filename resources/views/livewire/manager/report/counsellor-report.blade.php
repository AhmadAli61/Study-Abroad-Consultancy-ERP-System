<div>
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-user fa-lg text-white"></i>
                <h4 class="mb-0 text-white"><strong>Detailed Report for {{ $user->username }}</strong></h4>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <input type="date" class="form-control" placeholder="Search by Date"
       wire:model.defer="searchDate" 
       style="width: 250px; max-width: 100%;">

                <button wire:click="searchReports" class="btn btn-dark">Search</button>
            </div>
        </div>
        <table class="table table-bordered align-middle text-center" style="font-size: 15px;">
            <thead class="table-light">
                <tr>
                    <th style="vertical-align: middle; padding: 15px; white-space: nowrap;">
                        <i class="fas fa-calendar-alt me-1"></i> Date
                    </th>
                    <th style="vertical-align: middle; padding: 5px; white-space: nowrap;">
                        <i class="fas fa-list-alt me-1"></i> Total Inquiries
                    </th>
                    <th style="vertical-align: middle; padding: 5px; white-space: nowrap;">
                        <i class="fas fa-phone-alt me-1"></i> Inbound Calls
                    </th>
                    <th style="vertical-align: middle; padding: 5px; white-space: nowrap;">
                        <i class="fas fa-phone-volume me-1"></i> Dial Calls
                    </th>
                    <th style="vertical-align: middle; padding: 5px; white-space: nowrap;">
                        <i class="fas fa-user-check me-1"></i> Interested Follow-ups
                    </th>
                    <th style="vertical-align: middle; padding: 5px; white-space: nowrap;">
                        <span class="text-danger"><i class="fas fa-fire"></i> Hot</span> / 
                        <span class="text-info"><i class="fas fa-snowflake"></i> Cold</span> / 
                        <span class="text-dark"><i class="fas fa-times-circle"></i> Dead</span> /
                        <span class="text-success"><i class="fas fa-exclamation-circle"></i> Pending</span>
                    </th>
                    <th style="vertical-align: middle; padding: 5px; white-space: nowrap;">
                        <i class="fas fa-cogs me-1"></i> Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                    <tr id="report-{{ $report->id }}">
                        <td><strong>{{ $report->date }}</strong></td>
                        <td>{{ $report->total_inquiries_received }}</td>
                        <td>{{ $report->inbound_calls }}</td>
                        <td>{{ $report->dial_calls }}</td>
                        <td>{{ $report->interested_followups }}</td>
                        <td>
                            <strong>
                                <span class="text-danger">{{ $report->hot_leads }}</span> /
                                <span class="text-info">{{ $report->cold_leads }}</span> /
                                <span class="text-dark">{{ $report->dead_leads }}</span> /
                                <span class="text-success">{{ $report->pending_leads }}</span>

                            </strong>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button wire:click="$dispatch('viewDetails', { id: {{ $report->id }} })"
                                    class="btn btn-xs btn-info px-2 py-1" title="Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted" style="padding: 20px;">
                            No reports found for this user.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        <livewire:agent.modal.view-report-details />

</div>
