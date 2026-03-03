<div class="notification-icon">
    <div class="bell-container" id="notificationBell">
        <i class="fas fa-bell bell-icon"></i>
        @if($unreadCount > 0)
            <span class="notification-count">{{ $unreadCount }}</span>
        @endif
    </div>
</div>