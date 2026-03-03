<div class="content-footer-container">
  <!-- Footer -->
  <footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
      <div class=" d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
        <div>
          ©
          <script>
            document.write(new Date().getFullYear());
          </script>
          , made with ❤️ by <a href="https://www.companyconsultancy.com/" target="_blank" class="fw-semibold">our company</a>
        </div>
        
        <!-- Notification Bell -->
        @livewire('agent.notification.notification-bell')
      </div>
    </div>
  </footer>
  
  <!-- Notification Panel -->
  @livewire('agent.notification.counsellor-notification')
</div>
    <livewire:agent.modal.viewadmissioninquiry />


  <style>
    /* Footer Styles */
    .content-footer {
      position: relative;
      z-index: 10;
    }
    
    .footer-container {
      position: relative;
    }
    
   
    
    /* Enhanced Notification Styles */
    .notification-icon {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 1000;
      cursor: pointer;
    }
    .notification-app-id {
    margin: 3px 0;
    font-size: 11px;
    color: #95a5a6;
}

.notification-app-id strong {
    color: #2c3e50;
}
    
    .bell-container {
      position: relative;
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #7367f0, #e83e8c);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
      transition: all 0.3s ease;
    }
    
    .bell-container:hover {
      transform: scale(1.1);
      box-shadow: 0 8px 25px rgba(2, 2, 2, 0.5);
    }
    
    .bell-icon {
      color: white;
      font-size: 24px;
    }
    
    .notification-count {
      position: absolute;
      top: -5px;
      right: -5px;
      background: #e74c3c;
      color: white;
      font-size: 12px;
      font-weight: 600;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px solid white;
    }
    
    .notification-panel {
      position: fixed;
      bottom: 100px;
      right: 30px;
      width: 380px;
      background: white;
      border-radius: 14px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
      z-index: 999;
      display: none;
      overflow: hidden;
      max-height: 70vh;
    }
    
    .notification-panel.active {
      display: block;
      animation: slideIn 0.3s ease;
    }
    
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .panel-header {
      padding: 20px;
      background: linear-gradient(135deg, #7367f0, #e83e8c);
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .panel-title {
      font-weight: 600;
      font-size: 18px;
    }
    
    .panel-actions {
      display: flex;
      gap: 15px;
    }
    
    .panel-action {
      color: white;
      background: rgba(255, 255, 255, 0.2);
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.2s;
    }
    
    .panel-action:hover {
      background: rgba(255, 255, 255, 0.3);
    }
    
    .notification-list {
      padding: 0;
      max-height: 50vh;
      overflow-y: auto;
    }
    
    .notification-item {
      padding: 16px 20px;
      border-bottom: 1px solid #f1f1f1;
      display: flex;
      gap: 12px;
      transition: background 0.2s;
    }
    
    .notification-item:hover {
      background: #f9f9f9;
    }
    
    .notification-item.unread {
      background: #f0f7ff;
    }
    
    .notification-icon-container {
      flex-shrink: 0;
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .icon-document {
  background: linear-gradient(135deg, #7367f0, #e83e8c);
  color: #fff;   /* white icon inside gradient */
}

    
    .icon-interview {
      background: #d6eaf8;
      color: #7367f0;
    }
    
    .icon-payment {
      background: #d5f5e3;
      color: #27ae60;
    }
    
    .icon-deadline {
      background: #fadbd8;
      color: #e74c3c;
    }
    
    .notification-content {
      flex: 1;
    }
    
    .notification-title {
      font-weight: 600;
      margin-bottom: 4px;
      color: #2c3e50;
    }
    
    .notification-message {
      font-size: 14px;
      color: #7f8c8d;
      margin-bottom: 6px;
      line-height: 1.4;
    }
    
    .notification-time {
      font-size: 12px;
      color: #95a5a6;
    }
    
    .notification-actions {
      display: flex;
      gap: 10px;
      margin-top: 8px;
    }
    
    .action-btn {
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 500;
      cursor: pointer;
      border: none;
      transition: all 0.2s;
    }
    
    .btn-review {
      background: #7367f0;
      color: white;
    }
    
    .btn-review:hover {
      background: #e83e8c;
    }
    
    .btn-dismiss {
      background: #f8f9fa;
      color: #7f8c8d;
    }
    
    .btn-dismiss:hover {
      background: #e9ecef;
    }
    
    .panel-footer {
      padding: 15px 20px;
      text-align: center;
      border-top: 1px solid #f1f1f1;
    }
    
    .view-all-btn {
      color: #7367f0;
      text-decoration: none;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    
    .view-all-btn:hover {
      text-decoration: underline;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1100px) {
      .notification-panel {
        width: 350px;
        right: 20px;
      }
    }
    
    @media (max-width: 768px) {
      .notification-panel {
        width: 320px;
        right: 10px;
      }
      
      .bell-container {
        width: 55px;
        height: 55px;
      }
    }
    
    @media (max-width: 576px) {
      .notification-panel {
        width: 100%;
        right: 0;
        bottom: 100%;
        border-radius: 0;
        max-height: 80vh;
      }
      
      .footer-container {
        flex-direction: column;
        gap: 15px;
      }
    }
  </style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bell = document.getElementById('notificationBell');
    const panel = document.getElementById('notificationPanel');
    
    if (bell && panel) {
        // Toggle notification panel
        bell.addEventListener('click', function(e) {
            e.stopPropagation();
            panel.classList.toggle('active');
        });
        
        // Close panel when clicking outside
        document.addEventListener('click', function(e) {
            if (!panel.contains(e.target) && e.target !== bell && !bell.contains(e.target)) {
                panel.classList.remove('active');
            }
        });
        
        // Prevent panel close when clicking inside
        panel.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // Check for new notifications every 30 seconds
    setInterval(() => {
        Livewire.dispatch('refreshNotifications');
    }, 30000);
});
</script>
</div>