<!DOCTYPE html>
<html>
<head>
    <title>Application Status Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Base Styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-radius: 12px;
            overflow: hidden;
        }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        
        .header h1 {
            margin: 0 0 10px;
            font-size: 28px;
            font-weight: 600;
        }
        
        .header p {
            margin: 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        /* Content */
        .content {
            padding: 30px;
            background: #ffffff;
        }
        
        .greeting {
            margin-bottom: 20px;
            font-size: 16px;
        }
        
        .status-update {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #7367F0;
        }
        
        .status-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
            text-align: left !important;
        }
        
        .status-change-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
            gap: 8px;
            width: 100%;
            margin: 0 auto;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            white-space: nowrap;
        }
        
        .arrow {
            font-size: 16px;
            color: #7367F0;
            font-weight: bold;
            margin: 0 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Improved Info Card */
        .info-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin: 25px 0;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            border: 1px solid #eaeaea;
        }
        
        .info-card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .compact-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .compact-table tr {
            border-bottom: 1px solid #f0f0f0;
        }
        
        .compact-table tr:last-child {
            border-bottom: none;
        }
        
        .compact-table td {
            padding: 12px 15px;
            vertical-align: top;
        }
        
        .compact-table .label {
            background-color: #f8f9fa;
            font-weight: 600;
            width: 35%;
            color: #495057;
            border-right: 2px solid #e9ecef;
            white-space: nowrap;
        }
        
        .compact-table .value {
            background-color: white;
            color: #212529;
            font-weight: 500;
        }
        
        /* CTA Section */
        .cta-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(to right, #f9fafb, #ffffff);
            border-radius: 10px;
            border: 1px dashed #e0e0e0;
        }
        
        .cta-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .portal-link {
            display: inline-block;
            background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%);
            color: white !important;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            margin: 15px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(115, 103, 240, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .portal-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(115, 103, 240, 0.4);
        }
        
        /* Success Celebration Section */
        .success-celebration {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        
        .success-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .success-message {
            font-size: 16px;
            margin-bottom: 15px;
            opacity: 0.95;
        }
        
        .success-icon {
            font-size: 24px;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-10px);}
            60% {transform: translateY(-5px);}
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 30px 20px;
            background: #2c3e50;
            color: white;
        }
        
        .footer p {
            margin: 0 0 10px;
        }
        
        .footer-links {
            font-size: 12px;
            margin-top: 15px;
            opacity: 0.8;
        }
        
        .footer-links a {
            color: #fff;
            text-decoration: underline;
        }
        
        /* Mobile Responsive */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                border-radius: 0;
            }
            
            .content {
                padding: 20px;
            }
            
            .header {
                padding: 25px 15px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .status-change-container {
                flex-wrap: wrap;
                gap: 5px;
                justify-content: center;
            }
            
            .status-badge {
                padding: 3px 8px;
                font-size: 11px;
            }
            
            .arrow {
                margin: 0 5px;
                font-size: 14px;
            }
            
            .info-card {
                padding: 20px;
                margin: 20px 0;
            }
            
            .compact-table td {
                padding: 10px 8px;
                font-size: 13px;
            }
            
            .portal-link {
                padding: 12px 25px;
                font-size: 14px;
            }
            
            .success-celebration {
                padding: 20px 15px;
                margin: 20px 0;
            }
            
            .success-title {
                font-size: 20px;
            }
            
            .success-message {
                font-size: 14px;
            }
        }
        
        @media only screen and (max-width: 400px) {
            .content {
                padding: 15px;
            }
            
            .header {
                padding: 20px 15px;
            }
            
            .header h1 {
                font-size: 22px;
            }
            
            .status-change-container {
                flex-direction: row;
                justify-content: center;
                flex-wrap: nowrap;
            }
            
            .arrow {
                transform: none;
                margin: 0 5px;
            }
            
            .info-card {
                padding: 15px;
            }
            
            .compact-table {
                display: block;
            }
            
            .compact-table tr {
                display: block;
                margin-bottom: 10px;
            }
            
            .compact-table td {
                display: block;
                width: 100% !important;
                border-right: none;
                border-bottom: 1px solid #f0f0f0;
            }
            
            .compact-table tr:last-child td:last-child {
                border-bottom: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Application Status Update</h1>
            <p>Status Changed Notification</p>
        </div>
        
        <div class="content">
            <div class="greeting">
@php
    // Format username same as before
    $rawUsername = $user->username ?? 'Agent';
    $cleanUsername = ltrim($rawUsername, '@');
    $formattedUsername = preg_replace('/(?<!\ )[A-Z]/', ' $0', $cleanUsername);
    $formattedUsername = str_replace('.', ' ', $formattedUsername);
    $formattedUsername = trim($formattedUsername);
    $formattedUsername = ucwords($formattedUsername);
@endphp

<p>Dear <strong>{{ $formattedUsername }}</strong>,</p>
                <p>The status of your application has been updated:</p>
            </div>
            
            <!-- Special Success Message for Enrollment Status -->
            @if($newStatus === 'enrollment')
            <div class="success-celebration">
                <div class="success-title">
                    <span class="success-icon">🎓</span>
                    Congratulations! Mission Accomplished
                    <span class="success-icon">🎉</span>
                </div>
                <div class="success-message">
                    <strong>Excellent news!</strong> The application has reached its final successful destination. 
                    The student is now officially enrolled and will be studying at the university.
                </div>
                <div class="success-message">
                    This marks the successful completion of the admission journey. Well done!
                </div>
            </div>
            @endif
            
            <div class="status-update">
                <div class="status-title">Status Changed From</div>
                
                @php
                    $statusConfig = [
                        'caseclosed' => ['color' => '#c01414', 'icon' => 'fas fa-archive', 'label' => 'Case Closed'],
                        'casreceived' => ['color' => '#828383', 'icon' => 'fas fa-file-invoice', 'label' => 'CAS Received'],
                        'conditional' => ['color' => '#27391C', 'icon' => 'fas fa-file-signature', 'label' => 'Conditional'],
                        'enrollment' => ['color' => '#009688', 'icon' => 'fas fa-user-graduate', 'label' => 'Enrollment'],
                        'processed' => ['color' => '#09122C', 'icon' => 'fas fa-tasks', 'label' => 'Processed'],
                        'unconditional' => ['color' => '#87431D', 'icon' => 'fas fa-file-contract', 'label' => 'Unconditional'],
                        'underassessment' => ['color' => '#517577', 'icon' => 'fas fa-hourglass-half', 'label' => 'Under Assessment'],
                        'undercas' => ['color' => '#C69749', 'icon' => 'fas fa-passport', 'label' => 'Under CAS'],
                        'visaprocess' => ['color' => '#673AB7', 'icon' => 'fas fa-stamp', 'label' => 'Visa Process'],
                        'rejection' => ['color' => '#ff0000', 'icon' => 'fas fa-times-circle', 'label' => 'Rejection'],
                        'withdrawn' => ['color' => '#ff5252', 'icon' => 'fas fa-user-slash', 'label' => 'Withdrawn'],
                        'registered' => ['color' => '#28a745', 'icon' => 'fas fa-clipboard-list', 'label' => 'Registered'],
                    ];
                    
                    $oldConfig = $statusConfig[$oldStatus] ?? ['color' => '#666', 'icon' => 'fas fa-flag', 'label' => ucfirst($oldStatus)];
                    $newConfig = $statusConfig[$newStatus] ?? ['color' => '#666', 'icon' => 'fas fa-flag', 'label' => ucfirst($newStatus)];
                @endphp
                
                <div class="status-change-container">
                    <div class="status-badge" style="background-color: {{ $oldConfig['color'] }}; color: #fff;">
                        {{ $oldConfig['label'] }}
                    </div>
                    
                    <span class="arrow">→</span>
                    
                    <div class="status-badge" style="background-color: {{ $newConfig['color'] }}; color: #fff;">
                        {{ $newConfig['label'] }}
                    </div>
                </div>
            </div>
            
            <div class="info-card">
                <div class="info-card-title">Application Details</div>
                <table class="compact-table">
                    <tr>
                        <td class="label">App. ID</td>
                        <td class="value">{{ $inquiry->unique_id }}</td>
                    </tr>
                    <tr>
                        <td class="label">Student</td>
                        <td class="value">{{ $inquiry->student_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">University</td>
                        <td class="value">{{ $inquiry->university_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Course</td>
                        <td class="value">{{ $inquiry->course_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status Changed At</td>
                        <td class="value">
                            {{ $inquiry->status_change_time ? $inquiry->status_change_time->format('j F, Y \\a\\t g:i A') : now()->format('j F, Y \\a\\t g:i A') }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="cta-section">
                <div class="cta-title">Track Application Progress</div>
                <p>Check complete application details and track progress in your dashboard:</p>
                <a href="https://companyportal.ramadanumrah2025.co.uk/" class="portal-link">
                    Go to company Portal
                </a>
            </div>
            
            <p>Thank you for using company Portal.</p>
        </div>
        
        <div style="text-align: center; margin: 20px 0; padding: 15px; background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px;">
            <p style="margin: 0; color: #856404; font-size: 12px;">
                <strong>⚠️ Automated Notification:</strong> This email was sent automatically for notification. Please do not reply. 
            </p>
        </div>
        
        <div class="footer">
            <p>Best regards,<br><strong>company Admission Team</strong></p>
            <div class="footer-links">
                <p>© 2025 company Portal. All rights reserved.</p>
                <p>
                    <a href="https://companyportal.ramadanumrah2025.co.uk/">
                        companyportal.ramadanumrah2025.co.uk
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>