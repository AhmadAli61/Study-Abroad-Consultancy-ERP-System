<div>
    @if (session()->has('message'))
        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-3 mt-2">
        <div>
            <form wire:submit.prevent="saveIp">
                @csrf
                <div class="bg-primary text-white p-3 rounded-top">
                    <h3 class="mb-0 text-white">
                        <i class="ti ti-network me-2 text-white"></i> Add Authorized IP
                    </h3>
                </div>
                <div class="p-4">
                    <!-- IP Address Field -->
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">
                            <i class="ti ti-globe me-1"></i> IP Address
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="192.168.1.1" wire:model="ip_address" />
                            @error('ip_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Description Field -->
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">
                            <i class="ti ti-info-circle me-1"></i> Description
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Office Network" wire:model="description" />
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-save me-1"></i> {{ $editingIp ? 'Update' : 'Add' }} IP
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
    <h5 class="card-header bg-primary text-white">
        <i class="ti ti-list me-1 text-white"></i> Authorized IPs
    </h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover w-100">
            <thead>
                <tr class="bg-light">
                    <th class="text-center"><i class="ti ti-globe me-1"></i> IP Address</th>
                    <th class="text-center"><i class="ti ti-info-circle me-1"></i> Description</th>
                    <th class="text-center"><i class="ti ti-settings me-1"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($ips->isNotEmpty())
                    @foreach ($ips as $ip)
                        <tr>
                            <td class="text-center"><strong>{{ $ip->ip_address }}</strong></td>
                            <td class="text-center">
                                @if ($ip->description)
                                    {{ $ip->description }}
                                @else
                                    <span class="badge bg-secondary text-white">Null</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button
                                    class="btn btn-sm btn-success"
                                    wire:click="editIp({{ $ip->id }})">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button
                                    class="btn btn-sm btn-danger"
                                    wire:click="deleteIp({{ $ip->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center text-muted">No authorized IPs found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

</div>
