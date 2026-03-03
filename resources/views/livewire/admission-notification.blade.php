<div class="notification-panel" id="notificationPanel">
<div class="panel-header d-flex justify-content-between align-items-center py-4 px-4 bg-dark w-100">
    <h3 class="panel-title text-white mb-0 d-flex align-items-center">
        <i class="fas fa-bell me-2"></i> <!-- Notification Icon -->
        Notifications
    </h3>
    <div class="panel-actions d-flex align-items-center">
        <div class="panel-action text-white ms-3" title="Mark all as read" wire:click="markAllAsRead" style="cursor: pointer;">
            <i class="fas fa-check-double"></i>
        </div>
    </div>
</div>

    
    <div class="notification-list">
        @forelse($notifications as $notification)
        <div class="notification-item {{ is_null($notification->read_at) ? 'unread' : '' }}">
            <div class="notification-icon-container icon-document">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="notification-content">
                <div class="notification-title">New Application Received</div>
                <div class="notification-message">
                    <strong>{{ $this->getStudentName($notification) }}</strong> - 
                    {{ $notification->data['course_name'] }} at 
                    {{ $notification->data['university_name'] }}
                </div>
                <div class="notification-agent">
                    <small>Submitted by: <strong>{{ $this->getAgentName($notification) }}</strong></small>
                </div>
                <div class="notification-app-id">
                    <small>Application ID: <strong>{{ $notification->data['unique_id'] }}</strong></small>
                </div>
                <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                <div class="notification-actions">
                    <button class="action-btn btn-review" 
        wire:click="redirectToApplication({{ $notification->registered_inquiry_id }})">
    View Application
</button>
                    <button class="action-btn btn-dismiss" 
                            wire:click="markAsRead({{ $notification->id }})">
                        Dismiss
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="notification-item">
            <div class="notification-content text-center py-3">
                <i class="fas fa-bell-slash text-muted mb-2" style="font-size: 24px;"></i>
                <div class="text-muted">No notifications</div>
            </div>
        </div>
        @endforelse
    </div>
    
    <div class="panel-footer">
        <a href="{{ route('admission.applications') }}" class="view-all-btn">
            <span>View All Applications</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>