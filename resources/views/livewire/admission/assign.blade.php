<div class="card" style="border: none; border-radius: 16px; box-shadow: 0 6px 20px rgba(0,0,0,0.1); background-color: #fff;">
    
    {{-- Card Header --}}
    <div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">
        <div class="card-body py-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2 text-white">
                        <i class="fas fa-tasks me-2"></i>
                        Assign Inquiries
                    </h2>
                    <p class="mb-0 opacity-75">
                        Manage and assign student applications to team members
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="input-group" style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <input type="text" 
                            class="form-control border-0" placeholder="Search inquiries..." 
                            wire:model.debounce.300ms="search" wire:keyup="searches"
                            style="border-radius: 0; font-size: 14px;">
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

    <form wire:submit.prevent="assignSelectedInquiries" 
          x-data="{ showBulk: false, count: 0 }"
          x-init="$watch(() => $wire.selectedInquiries, val => { showBulk = val.length >= 2; count = val.length })">
        
        {{-- Bulk Assign Section --}}
        <div style="padding: 20px 30px; border-bottom: 1px solid #f1f1f1; background-color: #f8f9fa;">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5 mb-2">
                    <select wire:model="bulkAssignUserId" class="form-select"
                            style="border-radius: 50px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); padding: 10px 20px;">
                        <option value="">Select Admission Agent</option>
                        @foreach ($users as $user)
                            @if(in_array($user->role, ['admission', 'admissionagent']))
                                <option value="{{ $user->id }}"
                                    @if ($user->role == 'admission') style="color: green; font-weight: bold;"
                                    @elseif ($user->role == 'admissionagent') style="color: black; font-weight: bold;"
                                    @endif>
                                    {{ ucfirst($user->username) }} — {{ ucfirst(str_replace('agent', ' agent', $user->role)) }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 text-center mb-2 d-flex align-items-center justify-content-center gap-2">
                    <button type="submit"
                            style="border: none; border-radius: 50px; background: linear-gradient(to right, #28a745, #218838); color: white; padding: 10px 20px;">
                        <i class="fas fa-share-square me-1"></i> Assign Multiple
                    </button>
                    
                    <span x-show="count > 0"
                          style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px;
                                 font-size: 13px; font-weight: 600; color: #155724; background-color: #d4edda;
                                 border: 1px solid #c3e6cb; border-radius: 30px; margin-left: 12px;
                                 box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                        <i class="fas fa-check-circle" style="color: #28a745;"></i>
                        <span x-text="`${count} selected`"></span>
                        <span style="cursor: pointer; color: #155724; font-size: 16px; margin-left: 4px;"
                              @click="$wire.set('selectedInquiries', [])"
                              title="Clear selected">×</span>
                    </span>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive" style="padding: 10px;">
            <table class="table align-middle table-hover text-center" style="border-radius: 16px; overflow: hidden;">
                <thead class="bg-primary" style="border-bottom: 1px solid #dee2e6;">
                    <tr>
                        <th class="text-white"><i class="fas fa-list-ol text-white"></i></th>
                        <th class="text-white">
                            <button wire:click="toggleAll" class="btn btn-sm btn-outline-light" 
                                    style="border-radius: 50px; padding: 6px 10px;">
                                <i class="fas fa-check-square text-white"></i>
                            </button>
                        </th>
                        <th class="text-white"><i class="fas fa-user me-1 text-white"></i> Std. Name</th>
                        <th class="text-white"><i class="fas fa-phone me-1 text-white"></i> Contact</th>
                        <th class="text-white"><i class="fas fa-graduation-cap me-1 text-white"></i> Course</th>
                        <th class="text-white"><i class="fas fa-user-tag me-1 text-white"></i> Assign To</th>
                        <th class="text-white"><i class="fas fa-check me-1 text-white"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $index => $inquiry)
                        <tr style="transition: all 0.2s ease; background-color: #fff;">
                            <td style="font-weight: 600; color: #6c757d;">
                                {{ ($inquiries->currentPage() - 1) * $inquiries->perPage() + $index + 1 }}
                            </td>
                            <td>
                                <input type="checkbox" wire:model="selectedInquiries" value="{{ $inquiry->id }}">
                            </td>
                            <td class="whitespace-normal break-words text-center" style="padding: 8px; word-break: break-word; overflow-wrap: break-word;">
                                @if (!empty($inquiry->student_name))
                                    {{-- First Row: Student Name --}}
                                    <div style="margin-bottom: 8px;">
                                        <strong style="font-size: 14px; color: #2c5282; font-weight: 600;">{{ ucfirst($inquiry->student_name) }}</strong>
                                    </div>
                                    
                                    {{-- Second Row: Parent Application Info --}}
                                    <div style="margin-bottom: 6px; display: flex; justify-content: center; gap: 4px;">
                                        @if($inquiry->parent_id && $inquiry->parentInquiry && $inquiry->parentInquiry->assignedUser)
                                            <div style="display: inline-flex; align-items: center; background: #fff3cd; 
                                                        padding: 3px 8px; border-radius: 6px; border: 1px solid #ffeaa7;">
                                                <i class="fas fa-user-friends" style="color: #e67e22; font-size: 10px; margin-right: 4px;"></i>
                                                <span style="font-size: 11px; color: #856404; font-weight: 500;">
                                                    Main App: {{ e($inquiry->parentInquiry->assignedUser->username) }}
                                                </span>
                                            </div>
                                        @elseif(!$inquiry->parent_id)
                                            <div style="display: inline-flex; align-items: center; background: #d1ecf1; 
                                                        padding: 3px 8px; border-radius: 6px; border: 1px solid #bee5eb;">
                                                <i class="fas fa-home" style="color: #0c5460; font-size: 10px; margin-right: 4px;"></i>
                                                <span style="font-size: 11px; color: #0c5460; font-weight: 500;">Main Application</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    {{-- Third Row: Counsellor/Manager Info --}}
                                    <div style="display: flex; justify-content: center; gap: 4px;">
                                        @if($inquiry->user)
                                            @php
                                                $isManager = $inquiry->user->role === 'manager';
                                                $bgColor = $isManager ? '#f0fdf4' : '#f8fafc';
                                                $borderColor = $isManager ? '#bbf7d0' : '#e2e8f0';
                                                $iconColor = $isManager ? '#16a34a' : '#3b82f6';
                                                $textColor = $isManager ? '#166534' : '#475569';
                                            @endphp
                                            
                                            <div style="display: inline-flex; align-items: center; background: {{ $bgColor }}; 
                                                        padding: 3px 8px; border-radius: 6px; border: 1px solid {{ $borderColor }};">
                                                <i class="fas {{ $isManager ? 'fa-user-tie' : 'fa-user-edit' }}" 
                                                   style="color: {{ $iconColor }}; font-size: 10px; margin-right: 4px;"></i>
                                                <span style="font-size: 11px; color: {{ $textColor }}; font-weight: 500;">
                                                    By: {{ e($inquiry->user->username) }}
                                                </span>
                                            </div>
                                        @else
                                            <div style="display: inline-flex; align-items: center; background: #f8fafc; 
                                                        padding: 3px 8px; border-radius: 6px; border: 1px dashed #cbd5e1;">
                                                <i class="fas fa-question-circle" style="color: #94a3b8; font-size: 10px; margin-right: 4px;"></i>
                                                <span style="font-size: 11px; color: #64748b; font-weight: 500;">Registrant unknown</span>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span style="display: inline-block; padding: 4px 10px; font-size: 12px;
                                          font-weight: 600; color: #6c757d; background-color: #e2e3e5;
                                          border-radius: 30px; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
                                          text-transform: uppercase; letter-spacing: 0.5px;">
                                        Null
                                    </span>
                                @endif
                            </td>
                            <td>{{ $inquiry->student_contact }}</td>
                            <td>{{ $inquiry->course_name }}</td>
                            <td>
                                <select wire:model="selectedUser.{{ $inquiry->id }}" class="form-select"
                                        style="border-radius: 50px; padding: 5px 10px; font-size: 14px;">
                                    <option value="">Select Agent</option>
                                    @foreach ($users as $user)
                                        @if(in_array($user->role, ['admission', 'admissionagent']))
                                            <option value="{{ $user->id }}">{{ $user->username }} ({{ ucfirst(str_replace('agent', ' agent', $user->role)) }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <!-- Assign Button -->
                                    <button type="button"
                                            wire:click="assignInquiry({{ $inquiry->id }})"
                                            style="border: none; border-radius: 50px; 
                                                   background: linear-gradient(to right, #28a745, #218838); 
                                                   color: white; padding: 4px 12px; font-size: 12px; 
                                                   font-weight: 500; line-height: 1;">
                                        <i class="fas fa-check me-1" style="font-size: 12px;"></i> Assign
                                    </button>
                                    
                                    <!-- Details Button -->
                                    <button type="button"
                                        wire:click="$dispatch('showAdmissionDetails', {id: {{ $inquiry->id }}})"
                                            style="border: none; border-radius: 50px; 
                                                   background: linear-gradient(to right, #17a2b8, #138496); 
                                                   color: white; padding: 4px 12px; font-size: 12px; 
                                                   font-weight: 500; line-height: 1;">
                                        <i class="fas fa-info-circle me-1" style="font-size: 12px;"></i> Details
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center" style="padding: 40px 0;">
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
            
            <livewire:admission.modal.show-admission-inquiry-details 
                wire:key="details-modal-{{ time() }}" />

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-3">
                {{ $inquiries->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </form>
</div>