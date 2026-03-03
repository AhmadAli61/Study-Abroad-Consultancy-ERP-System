<div><div>
    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2 rounded" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Set Reminder Form --}}
   <div class="card border-0 shadow-lg mb-4">
    <div class="card-body p-0">
        <!-- Form Header with Gradient -->
        <div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">
            <div class="card-body py-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2 text-white">
                            <i class="fas fa-calendar-check me-2"></i>
                            Set New Reminder
                        </h2>
                        <p class="mb-0 opacity-75">
                            Create reminders to stay organized and never miss important follow-ups
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-4">
            <form wire:submit.prevent="saveReminder">
                @csrf
                <div class="row g-4">
                    <!-- Date & Time Fields in Single Row -->
                    <div class="col-12">
                        <div class="row g-3">
                            <!-- Date Input -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Reminder Date
                                </label>
                                <input
                                    type="date"
                                    class="form-control"
                                    wire:model="reminder_date"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                />
                                <div class="form-text text-muted small mt-1">
                                    Select a future date for your reminder
                                </div>
                                @error('reminder_date') 
                                <span class="text-danger small">{{ $message }}</span> 
                                @enderror
                            </div>
                            
                            <!-- Time Input -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Reminder Time
                                </label>
                                <input
                                    type="time"
                                    class="form-control"
                                    wire:model="reminder_time_only"
                                    required
                                />
                                <div class="form-text text-muted small mt-1">
                                    Use 24-hour format • Example: 14:30 for 2:30 PM
                                </div>
                                @error('reminder_time_only') 
                                <span class="text-danger small">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Reason Field - Full Width -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Reminder Reason
                        </label>
                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Enter the reason for this reminder..."
                            wire:model.defer="reminder_reason"
                            required
                        ></textarea>
                        <div class="form-text text-muted small mt-1">
                            Provide a clear description of what you need to be reminded about
                        </div>
                        @error('reminder_reason') 
                        <span class="text-danger small">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                        <i class="fas fa-save me-2"></i> Save Reminder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.card {
    border-radius: 12px;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
    padding: 10px 12px;
}

.form-control:focus {
    border-color: #7367F0;
    box-shadow: 0 0 0 0.2rem rgba(115, 103, 240, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #7367F0 0%, #9e95f5 100%);
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(115, 103, 240, 0.3);
}

.border-top {
    border-color: #e6e4fd !important;
}

/* Form text styling */
.form-text {
    font-size: 0.75rem;
}

/* Placeholder styling */
textarea::placeholder {
    color: #6c757d;
}
</style>

    {{-- All Reminders Table --}}
    <div class="card border-0 shadow-lg">
        <div class="card-body p-0">
            <!-- Table Header with Gradient -->
            <div class="card mb-0 border-0 shadow-sm bg-gradient-primary text-white" style="border-radius: 12px 12px 0 0 !important;">
                <div class="card-body py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2 text-white">
                                <i class="fas fa-bell me-2"></i>
                                All Reminders
                            </h2>
                            <p class="mb-0 opacity-75">
                                Manage and track all your scheduled reminders
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block me-3">
                                <h3 class="mb-0 text-dark">{{ $reminders->count() }}</h3>
                                <small class="opacity-75 text-dark">Total Reminders</small>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded d-inline-block">
                                <h3 class="mb-0 text-dark">{{ $reminders->where('is_active', true)->count() }}</h3>
                                <small class="opacity-75 text-dark">Active</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold" style="border: none; padding: 15px; width: 25%;">
                                    <i class="fas fa-clock me-2 text-primary"></i>Reminder Date & Time
                                </th>
                                <th class="fw-semibold" style="border: none; padding: 15px; width: 50%;">
                                    <i class="fas fa-comment-dots me-2 text-primary"></i>Reason
                                </th>
                                <th class="fw-semibold text-center" style="border: none; padding: 15px; width: 25%;">
                                    <i class="fas fa-cogs me-2 text-primary"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reminders as $reminder)
                                <tr class="border-bottom">
                                    <td style="padding: 15px; vertical-align: middle; width: 25%;">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-calendar text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark">
                                                    {{ \Carbon\Carbon::parse($reminder->reminder_time)->format('Y-m-d') }}
                                                </div>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($reminder->reminder_time)->format('h:i A') }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Scrollable Reason Box - Reduced Width -->
                                    <td style="vertical-align: top; padding: 12px; width: 50%;">
                                        <div class="reason-container" 
                                             style="height: 120px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; background: #ffffff; font-size: 13px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 400px;">
                                            
                                            @if (!empty($reminder->reminder_reason))
                                                <!-- Reason Content -->
                                                <div class="reason-content" style="color: #2d3748; line-height: 1.5; white-space: pre-wrap; word-wrap: break-word; font-size: 12px;">
                                                    {!! nl2br(htmlspecialchars_decode(trim($reminder->reminder_reason))) !!}
                                                </div>
                                            @else
                                                <!-- Empty State -->
                                                <div class="empty-state" style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 10px;">
                                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 8px;">
                                                        <i class="fas fa-comment-slash text-muted" style="font-size: 14px;"></i>
                                                    </div>
                                                    
                                                    <div style="text-align: center;">
                                                        <div style="font-weight: 600; color: #4a5568; margin-bottom: 2px; font-size: 11px;">No Reason</div>
                                                        <div style="font-size: 10px; color: #718096;">No description provided</div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <style>
                                            .reason-container::-webkit-scrollbar {
                                                width: 4px;
                                            }
                                            
                                            .reason-container::-webkit-scrollbar-track {
                                                background: #f8f9fa;
                                                border-radius: 2px;
                                            }
                                            
                                            .reason-container::-webkit-scrollbar-thumb {
                                                background: #dee2e6;
                                                border-radius: 2px;
                                            }
                                            
                                            .reason-container::-webkit-scrollbar-thumb:hover {
                                                background: #adb5bd;
                                            }
                                        </style>
                                    </td>
                                    
                                    <td style="padding: 15px; vertical-align: middle; text-align: center; width: 25%;">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <!-- Enable/Disable Toggle -->
                                            <div class="form-check form-switch" style="transform: scale(1.1);">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    wire:click="toggleStatus({{ $reminder->id }})"
                                                    @if ($reminder->is_active) checked @endif
                                                    style="cursor: pointer;">
                                            </div>
                                            <!-- Delete Button -->
                                            <button class="btn btn-sm btn-danger px-2 py-1 rounded" 
                                                    wire:click="deleteReminder({{ $reminder->id }})"
                                                    onclick="return confirm('Are you sure you want to delete this reminder?')">
                                                <i class="fas fa-trash-alt" style="font-size: 12px;"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-bell-slash fa-3x mb-3 opacity-50"></i>
                                            <h5 class="mb-2">No Reminders Set</h5>
                                            <p class="mb-0">Create your first reminder to get started</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #7367F0 70%, #e6e4fd 100%) !important;
}

.card {
    border-radius: 12px;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #7367F0;
    box-shadow: 0 0 0 0.2rem rgba(115, 103, 240, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #7367F0 0%, #9e95f5 100%);
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(115, 103, 240, 0.3);
}

.table-hover tbody tr:hover {
    background-color: rgba(115, 103, 240, 0.05);
}

.form-check-input:checked {
    background-color: #7367F0;
    border-color: #7367F0;
}
</style>
</div>