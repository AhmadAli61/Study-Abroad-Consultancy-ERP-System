<div class="row mb-2 d-flex justify-content-between flex-wrap"
    style="display: flex; flex-wrap: wrap; justify-content: space-between;">
    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
        <a href="{{ route('manager.team.inquiry') }}" class="text-decoration-none">
            <div class="card text-center"
                style="background-color: #ffffff; height: 160px; border: 2px solid #4f6dc0; box-shadow: 0 8px 8px rgba(0, 0, 0, 0.4);">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="padding: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-list fa-2x text-primary"></i>
                        <h3 class="fw-bold m-0" style="color: #080808;">{{ $totalLeads ?? 0 }}</h3>
                    </div>
                    <h6 class="mt-2 mb-0 mt-3" style="color: #080808;"><strong>Total Inquiries</strong></h6>
                    <button class="btn btn-sm mt-4 bg-primary"
                        style="color: white; font-size: 11px; padding: 2px 8px; margin-top: 4px;">View All</button>
                </div>
            </div>
        </a>
    </div>
    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
        <a href="{{ route('manager.team.inquiry.hot') }}" class="text-decoration-none">
            <div class="card text-center"
                style="background-color: #ffffff; height: 160px; border: 2px solid #ff5722; box-shadow: 0 8px 8px rgba(0, 0, 0, 0.4);">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="padding: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-fire fa-2x" style="color: #ff5722;"></i>
                        <h3 class="fw-bold m-0" style="color: #080808;">{{ $hotLeads ?? 0 }}</h3>
                    </div>
                    <h6 class="mt-2 mb-0 mt-3" style="color: #080808;"><strong>Hot Leads</strong></h6>
                    <button class="btn btn-sm mt-4"
                        style="background-color: #ff5722; color: white; font-size: 11px; padding: 2px 8px; margin-top: 4px;">View
                        All</button>
                </div>
            </div>
        </a>
    </div>
    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
        <a href="{{ route('manager.team.inquiry.cold') }}" class="text-decoration-none">
            <div class="card text-center"
                style="background-color: #ffffff; height: 160px; border: 2px solid #0dcaf0; box-shadow: 0 8px 8px rgba(0, 0, 0, 0.4);">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="padding: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-snowflake fa-2x" style="color: #0dcaf0;"></i>
                        <h3 class="fw-bold m-0" style="color: #080808;">{{ $coldLeads ?? 0 }}</h3>
                    </div>
                    <h6 class="mt-2 mb-0 mt-3" style="color: #080808;"><strong>Cold Leads</strong></h6>
                    <button class="btn btn-sm mt-4"
                        style="background-color: #0dcaf0; color: white; font-size: 11px; padding: 2px 8px; margin-top: 4px;">View
                        All</button>

                </div>
            </div>
        </a>
    </div>
    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
        <a href="{{ route('manager.team.inquiry.dead') }}" class="text-decoration-none">
            <div class="card text-center"
                style="background-color: #ffffff; height: 160px; border: 2px solid #43474b; box-shadow: 0 8px 8px rgba(0, 0, 0, 0.4);">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="padding: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-times-circle fa-2x" style="color: #43474b;"></i>
                        <h3 class="fw-bold m-0" style="color: #0a0a0a;">{{ $deadLeads ?? 0 }}</h3>
                    </div>
                    <h6 class="mt-2 mb-0 mt-3" style="color: #080808;"><strong>Dead Leads</strong></h6>
                    <button class="btn btn-sm mt-4"
                        style="background-color: #43474b; color: white; font-size: 11px; padding: 2px 8px; margin-top: 4px;">View
                        All</button>
                </div>
            </div>
        </a>
    </div>
    <div style="flex: 1 0 18%; min-width: 170px; margin: 0 5px 15px 5px;">
        <a href="{{ route('manager.team.inquiry.pending') }}" class="text-decoration-none">
            <div class="card text-center"
                style="background-color: #ffffff; height: 160px; border: 2px solid #ffc107; box-shadow: 0 8px 8px rgba(0, 0, 0, 0.4);">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="padding: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-hourglass-half fa-2x" style="color: #ffc107;"></i>
                        <h3 class="fw-bold m-0" style="color: #0a0a0a;">{{ $pendingLeads ?? 0 }}</h3>
                    </div>
                    <h6 class="mt-2 mb-0 mt-4" style="color: #0a0a0a;"><strong>Pending Leads</strong></h6>
                    <button class="btn btn-sm mt-4"
                        style="background-color: #ffc107; color: white; font-size: 11px; padding: 2px 8px; margin-top: 4px;">View
                        All</button>
                </div>
            </div>
        </a>
    </div>
</div>
