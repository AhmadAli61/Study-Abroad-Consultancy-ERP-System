<div class="card mb-3 mt-2">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form wire:submit.prevent="submitReport">
        <div class="bg-primary text-white p-3 rounded-top">
            <h3 class="mb-0 text-white">
                <i class="fas fa-file-alt me-2 text-white"></i> Daily Work Report
            </h3>
        </div>
        
        <div class="p-4">
            <div class="row g-3">
            
                
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-chart-bar me-1 text-secondary"></i> Total Inquiries Received Today</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-phone me-1 text-secondary"></i> Inbound Calls</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-phone-alt me-1 text-secondary"></i> Outbound Calls (Dial/Connect)</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Dial">
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Connect">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-reply me-1 text-secondary"></i> Interested Follow-ups</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-reply me-1 text-secondary"></i> Weak Follow-ups</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-user-plus me-1 text-secondary"></i> Today's Registration</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-clock me-1 text-secondary"></i> Expected Registration</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-users me-1 text-secondary"></i> Total Students</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-user-clock me-1 text-secondary"></i> On Hold Students</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-paperclip me-1 text-secondary"></i> Applications Processed Today</label>
                    <input type="number" class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-clipboard-check me-1 text-secondary"></i> Total Conditional Offers till Today</label>
                    <input type="number" class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-user-graduate me-1 text-secondary"></i> Total Students Processed</label>
                    <input type="number" class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-award me-1 text-secondary"></i> Total Unconditional Offers Till Today</label>
                    <input type="number" class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-user-edit me-1 text-secondary"></i> Total No. of Cas Stage Students</label>
                    <input type="number" class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-passport me-1 text-secondary"></i> Total No. of Visa Stage Students</label>
                    <input type="number" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-envelope me-1 text-secondary"></i> Gmail Check</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-envelope-open me-1 text-secondary"></i> Gmail Chase-up</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-12">
                    <label class="form-label"><i class="fas fa-tasks me-1 text-secondary"></i> Miscellaneous Tasks</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Submit Report
                </button>
            </div>
        </div>
    </form>
</div>