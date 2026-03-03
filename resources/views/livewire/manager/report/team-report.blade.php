<div>
    @foreach ($teams as $team)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-user-friends me-2 text-white"></i>
                <span class="fw-bold text-white">{{ $team->name }} Team Report</span>
            </h4>
        </div>
        <div class="bg-light card-body pb-2">
            <div class="mb-3">
                <h4>
                    <i class="fas fa-user-tie me-2 mt-3"></i> Manager:
                    <span class="fw-bold text-white bg-success px-2 py-1 rounded">
                        {{ $team->manager->username ?? 'N/A' }}
                    </span>
                </h4>
            </div>
            <div>
                <h6>
                    <i class="fas fa-users me-2"></i> Team Size:
                    <span class="text-body fw-bold">{{ ($team->counsellors->count() ?? 0) + 1 }}</span>
                </h6>
            </div>
            <div>
    <h6>
        <i class="fas fa-tasks me-2"></i> Total Inquiries:
        <span class="text-body fw-bold">
            {{ ($team->manager->inquiries_count ?? 0) + $team->counsellors->sum('inquiries_count') }}
        </span>
    </h6>
</div>
        </div>
        <div class="pt-0">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fas fa-user me-2"></i>Name</th>
                            <th class="text-center"><i class="fas fa-user-tag me-2"></i>Role</th>
                            <th class="text-center"><i class="fas fa-tasks me-2"></i>Total Inquiries</th>
                            <th style="vertical-align: middle; padding: 5px; white-space: nowrap; text-align: center;">
                                <span class="text-danger"><i class="fas fa-fire"></i> Hot</span> /
                                <span class="text-info"><i class="fas fa-snowflake"></i> Cold</span> /
                                <span class="text-dark"><i class="fas fa-times-circle"></i> Dead</span> /
                                <span class="text-success"><i class="fas fa-exclamation-circle"></i> Pending</span>
                            </th>
                            <th class="text-center"><i class="fas fa-tools me-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {{-- Manager Row --}}
                        @if ($team->manager)
                        <tr>
                            <td>
                                <i class="ti ti-user ti-lg me-3"></i>
                                <strong>{{ $team->manager->username }}</strong>
                            </td>
                            <td class="text-center text-info">Manager</td>
                            <td class="text-center">{{ $team->manager->inquiries_count ?? 0 }}</td>
                            <td class="text-center">
                                <strong>
                                    <span class="text-danger">{{ $team->manager->hot_leads ?? 0 }}</span> /
                                    <span class="text-info">{{ $team->manager->cold_leads ?? 0 }}</span> /
                                    <span class="text-dark">{{ $team->manager->dead_leads ?? 0 }}</span> /
                                    <span class="text-success">{{ $team->manager->pending_leads ?? 0 }}</span>
                                </strong>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('manager.counsellorreport', $team->manager->id) }}" class="btn btn-sm btn-primary">
                                    View Report
                                </a>
                            </td>
                        </tr>
                        @endif

                        {{-- Counselor Rows --}}
                        @foreach ($team->counsellors as $counsellor)
                        <tr>
                            <td>
                                <i class="ti ti-user ti-lg me-3"></i>
                                <strong>{{ $counsellor->username }}</strong>
                            </td>
                            <td class="text-center text-black">Counselor</td>
                            <td class="text-center">{{ $counsellor->inquiries_count ?? 0 }}</td>
                            <td class="text-center">
                                <strong>
                                    <span class="text-danger">{{ $counsellor->hot_leads ?? 0 }}</span> /
                                    <span class="text-info">{{ $counsellor->cold_leads ?? 0 }}</span> /
                                    <span class="text-dark">{{ $counsellor->dead_leads ?? 0 }}</span> /
                                    <span class="text-success">{{ $counsellor->pending_leads ?? 0 }}</span>
                                </strong>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('manager.counsellorreport', $counsellor->id) }}" class="btn btn-sm btn-primary">
                                    View Report
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>
