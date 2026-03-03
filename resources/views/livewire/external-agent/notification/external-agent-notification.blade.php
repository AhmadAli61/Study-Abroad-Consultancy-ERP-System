<div>
    <div class="notification-panel" id="notificationPanel">
        <div class="panel-header d-flex justify-content-between align-items-center py-4 px-4 bg-dark w-100">
            <h3 class="panel-title text-white mb-0 d-flex align-items-center">
                <i class="fas fa-bell me-2"></i>
                Notifications
            </h3>
            <div class="panel-actions d-flex align-items-center">
                <div class="panel-action text-white ms-3" title="Mark all as read" style="cursor: pointer;" wire:click="markAllAsRead">
                    <i class="fas fa-check-double"></i>
                </div>
            </div>
        </div>
        
        <div class="notification-list">
            @php
                $statusStyles = [
                    'caseclosed'     => ['color' => '#c01414', 'icon' => 'fa-archive'],
                    'rejection' => ['color' => '#ff0000', 'icon' => 'fa-times-circle'],
                    'withdrawn' => ['color' => '#ff5252', 'icon' => 'fa-user-slash'],
                    'casreceived'    => ['color' => '#828383', 'icon' => 'fa-file-invoice'],
                    'conditional'    => ['color' => '#27391C', 'icon' => 'fa-file-signature'],
                    'enrollment'     => ['color' => '#009688', 'icon' => 'fa-user-graduate'],
                    'processed'      => ['color' => '#09122C', 'icon' => 'fa-tasks'],
                    'unconditional'  => ['color' => '#87431D', 'icon' => 'fa-file-contract'],
                    'underassessment'=> ['color' => '#517577', 'icon' => 'fa-hourglass-half'],
                    'undercas'       => ['color' => '#C69749', 'icon' => 'fa-passport'],
                    'visaprocess'    => ['color' => '#673AB7', 'icon' => 'fa-stamp'],
                    'registered'     => ['color' => '#28a745', 'icon' => 'fa-clipboard-list'],
                ];

                function renderStatusBtn($status, $styles) {
                    $s = strtolower($status);
                    if(isset($styles[$s])) {
                        return '<span class="badge status-btn" style="background:'.$styles[$s]['color'].'; color:#fff; font-size:10px; padding:4px 8px; border-radius:6px; margin:0 3px; display:inline-flex; align-items:center;">
                                    <i class="fas '.$styles[$s]['icon'].' me-1" style="font-size:10px;"></i> '.ucfirst($status).'
                                </span>';
                    }
                    return '<span class="badge bg-secondary">'.$status.'</span>';
                }
            @endphp

            @forelse($notifications as $notification)
                <div class="notification-item {{ is_null($notification->read_at) ? 'unread' : '' }}">
                    <div class="notification-icon-container icon-document">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">Status Changed</div>
                        <div class="notification-message">
                            <strong>{{ $notification->registeredInquiry->student_name ?? $notification->data['student_name'] }}</strong> - 
                            Status changed from 
                            {!! renderStatusBtn($notification->data['old_status'], $statusStyles) !!} 
                            to 
                            {!! renderStatusBtn($notification->data['new_status'], $statusStyles) !!}
                        </div>

                        <div class="notification-app-id">
                            <small>
                                Application ID: <strong>{{ $notification->registeredInquiry->unique_id ?? 'N/A' }}</strong>
                            </small>
                        </div>

                        <div>
                            <small>
                                University: <strong>{{ $notification->registeredInquiry->university_name ?? 'N/A' }}</strong>
                            </small>
                        </div>
                
                        <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                        <div class="notification-actions">
                            <button class="action-btn btn-review" wire:click="$dispatch('showDetails', { id: '{{ $notification->registered_inquiry_id }}' })">
                                View Application
                            </button>
                            <button class="action-btn btn-dismiss" wire:click="markAsRead('{{ $notification->id }}')">
                                Dismiss
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="fas fa-bell-slash fa-2x text-muted mb-2"></i>
                    <p class="text-muted">No notifications yet</p>
                </div>
            @endforelse
        </div>
        
        <div class="panel-footer">
            <a href="#" class="view-all-btn">
                <span>View All Inquiries</span>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <script>
    document.addEventListener('livewire:init', () => {
        setInterval(() => {
            @this.loadNotifications();
        }, 30000);
    });
    </script>
</div>