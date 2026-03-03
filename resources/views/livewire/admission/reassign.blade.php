<div class="card" style="border: none; border-radius: 16px; box-shadow: 0 6px 20px rgba(0,0,0,0.1); background-color: #fff;">

    {{-- Session Messages --}}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show m-3" style="border-radius: 50px; box-shadow: 0 4px 12px rgba(40,167,69,0.2);" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" style="border-radius: 50px; box-shadow: 0 4px 12px rgba(220,53,69,0.2);" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card Header --}}
       <div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">
    <div class="card-body py-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-2 text-white">
                    <i class="fas fa-exchange-alt me-2"></i>
                    Reassign Inquiries
                </h2>
                <p class="mb-0 opacity-75">
                    Transfer student applications between team members
                </p>
            </div>
            <div class="col-md-4 text-end">
                <div class="input-group" style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <input type="text"  class="form-control border-0" placeholder="Search..." wire:model.defer="search"
                   style="border-radius: 0; font-size: 14px;">
            <button class="btn" style="background: #4e574e; color: white;" wire:click="searchInquiries">
                <i class="fas fa-search"></i>
            </button>
        </div>
   
        </div>
    </div>
</div>
</div>

<style>
    .bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}
</style>


   <form wire:submit.prevent="reassignSelectedInquiries"
      x-data="{ showBulk: false, count: 0 }"
      x-init="$watch(() => $wire.selectedInquiries, val => { showBulk = val.length >= 2; count = val.length })">
    <div style="padding: 20px 30px; border-bottom: 1px solid #f1f1f1; background-color: #f8f9fa;">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 mb-2">
                <select wire:model="bulkAssignUserId" class="form-select"
                        style="border-radius: 50px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); padding: 10px 20px;">
                    <option value="">Select User for Bulk Reassign</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if ($user->role == 'manager') style="color: green; font-weight: bold;"
                            @elseif ($user->role == 'admission') style="color: black; font-weight: bold;"
                            @endif>
                            {{ ucfirst($user->username) }} — {{ ucfirst($user->role) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 text-center mb-2 d-flex align-items-center justify-content-center gap-2">
                <button type="submit"
                        style="border: none; border-radius: 50px; background: linear-gradient(to right, #28a745, #218838); color: white; padding: 10px 20px;">
                    <i class="fas fa-share-square me-1"></i> Reassign All
                </button>
<span x-show="count > 0"
      style="
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        font-size: 13px;
        font-weight: 600;
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 30px;
        margin-left: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      ">
    <i class="fas fa-check-circle" style="color: #28a745;"></i>
    <span x-text="`${count} selected`"></span>
    <span style="cursor: pointer; color: #155724; font-size: 16px; margin-left: 4px;"
          @click="$wire.set('selectedInquiries', [])"
          title="Clear selected">×</span>
</span>

            </div>
        </div>
    </div>
</form>

    {{-- Table --}}
    <div class="table-responsive" style="padding: 10px;">
        <table class="table align-middle table-hover text-center" style="border-radius: 16px; overflow: hidden;">
            <thead class="bg-primary" style=" border-bottom: 1px solid #dee2e6;">
                <tr>
                    <th class="text-white"><i class="fas fa-list-ol text-white"></i></th>
                    <th class="text-white">
                        <button wire:click="toggleAll" class="btn btn-sm btn-outline-light" 
                                style="border-radius: 50px; padding: 6px 10px;">
                            <i class="fas fa-check-square text-white"></i>
                        </button>
                    </th>
                    <th class="text-white"><i class="fas fa-user me-1 text-white"></i> Student Name</th>
                    <th class="text-white"><i class="fas fa-phone me-1 text-white"></i> Contact</th>
                    <th class="text-white"><i class="fas fa-passport me-1 text-white"></i> Passport</th>
                    <th class="text-white"><i class="fas fa-user-check me-1 text-white"></i> Previous</th>
                    <th class="text-white"><i class="fas fa-user-plus me-1 text-white"></i> Assign To</th>
                    <th class="text-white"><i class="fas fa-play-circle me-1 text-white"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registeredInquiries as $index => $inquiry)
                    <tr style="transition: all 0.2s ease; background-color: #fff;">
                        <td style="font-weight: 600; color: #6c757d;">
                            {{ ($registeredInquiries->currentPage() - 1) * $registeredInquiries->perPage() + $index + 1 }}
                        </td>
                        <td>
                            <input type="checkbox" wire:model="selectedInquiries" value="{{ $inquiry->id }}">
                        </td>
                        <td>{{ $inquiry->student_name }}</td>
                        <td>{{ $inquiry->student_contact }}</td>
                        <td>{{ $inquiry->passport_number }}</td>
                        <td class="text-muted">{{ $inquiry->previousAssignedUser?->username ?? '—' }}</td>
                        <td>
                            <select wire:model="selectedUser.{{ $inquiry->id }}" class="form-select"
                                    style="border-radius: 50px; padding: 5px 10px; font-size: 14px;">
                                <option value="">Select</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button"
                                    wire:click="reassignInquiry({{ $inquiry->id }})"
                                    style="border: none; border-radius: 50px; background: linear-gradient(to right, #28a745, #218838); color: white; padding: 4px 12px; font-size: 12px; font-weight: 500; line-height: 1;">
                                <i class="fas fa-share-square me-1" style="font-size: 12px;"></i> Reassign
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 40px 0;">
                            <div style="opacity: 0.7;">
                                <i class="fas fa-inbox fa-3x mb-2 text-secondary"></i>
                                <h5 style="font-weight: 600;">No Registered Inquiries Found</h5>
                                <p style="font-size: 14px; color: #888;">Try adjusting your search or check back later.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-end mt-3">
            {{ $registeredInquiries->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>