<!DOCTYPE html>
<html>
<head>
    <title>New Message Notification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            font-family: 'Segoe UI', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%);
            color: white;
            padding: 35px 20px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #FFD700, #FF6B6B, #4ECDC4, #45B7D1);
        }
        
        .header h1 {
            margin: 0 0 8px;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .header p {
            margin: 0;
            opacity: 0.9;
            font-size: 16px;
            font-weight: 400;
        }
        
        .header-icon {
            font-size: 40px;
            margin-bottom: 15px;
            display: block;
        }
        
        .content {
            padding: 40px 35px;
            background: #ffffff;
        }
        
        .greeting {
            margin-bottom: 25px;
            font-size: 16px;
            color: #555;
        }
        
        .greeting strong {
            color: #2c3e50;
        }
        
        .info-card {
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f2f8 100%);
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
            box-shadow: 0 4px 12px rgba(115, 103, 240, 0.08);
            border: 1px solid #eaeefa;
        }
        
        .info-card-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .info-card-title i {
            color: #7367F0;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .info-table tr {
            border-bottom: 1px solid #eaeefa;
        }
        
        .info-table tr:last-child {
            border-bottom: none;
        }
        
        .info-table td {
            padding: 12px 15px;
        }
        
        .info-table .label {
            font-weight: 600;
            width: 35%;
            color: #495057;
            background: rgba(255,255,255,0.7);
        }
        
        .info-table .value {
            background: white;
            color: #212529;
            font-weight: 500;
            border-left: 2px solid #eaeefa;
        }
        
        .message-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #eaeaea;
            border-top: 4px solid #7367F0;
        }
        
        .message-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .message-sender {
            font-weight: 700;
            color: #2c3e50;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .message-time {
            font-size: 12px;
            color: #666;
            background: #f8f9fa;
            padding: 4px 10px;
            border-radius: 20px;
        }
        
        .message-content {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 3px solid #7367F0;
            font-size: 14px;
            line-height: 1.7;
            color: #444;
        }
        
        .cta-section {
            text-align: center;
            margin: 35px 0;
            padding: 25px;
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f2f8 100%);
            border-radius: 12px;
            border: 2px dashed #d1d9ff;
        }
        
        .cta-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .cta-description {
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .portal-link {
            display: inline-block;
            background: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%);
            color: white !important;
            padding: 14px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 4px 15px rgba(115, 103, 240, 0.3);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .portal-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(115, 103, 240, 0.4);
        }
        
        .footer {
            text-align: center;
            padding: 35px 20px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
        }
        
        .footer p {
            margin: 0 0 12px;
        }
        
        .footer-links {
            font-size: 12px;
            margin-top: 20px;
            opacity: 0.8;
        }
        
        .footer-links a {
            color: #fff;
            text-decoration: underline;
        }
        
        .signature {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        
        /* Mobile Responsive */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                border-radius: 0;
            }
            
            .content {
                padding: 25px 20px;
            }
            
            .header {
                padding: 25px 15px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .info-card {
                padding: 20px;
                margin: 20px 0;
            }
            
            .message-box {
                padding: 20px;
            }
            
            .message-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .info-table td {
                padding: 10px 12px;
                font-size: 13px;
            }
            
            .portal-link {
                padding: 12px 25px;
                font-size: 14px;
            }
            
            .cta-section {
                padding: 20px;
                margin: 25px 0;
            }
        }
        
        @media only screen and (max-width: 400px) {
            .content {
                padding: 20px 15px;
            }
            
            .info-table {
                display: block;
            }
            
            .info-table tr {
                display: block;
                margin-bottom: 10px;
                border-bottom: 1px solid #eaeefa;
            }
            
            .info-table td {
                display: block;
                width: 100% !important;
                border-left: none;
                border-bottom: none;
            }
            
            .info-table .value {
                border-left: none;
                padding-top: 5px;
            }
        }
    </style>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">
                <i class="fas fa-comment-dots"></i>
            </div>
            <h1>New Message Notification</h1>
            <p>Application ID: {{ $inquiry->unique_id }}</p>
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

<p>Dear <strong>{{ $formattedUsername }}</strong>,</p>                <p>A new message has been posted for application <strong>{{ $inquiry->unique_id }}</strong>:</p>
            </div>
         <div class="message-box" style="border: 1px solid #e2e8f0; border-radius: 8px; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.08); padding: 10px; margin-bottom: 10px;">
    @php
        use App\Models\User;
        use Illuminate\Support\Str;
        use Carbon\Carbon;

        $username = $messageData['user_name'] ?? 'System';
        $user = User::where('username', $username)->first();
        $userRole = $user->role ?? 'system';

        $roleStyles = [
            'counsellor'     => ['bg' => '#7367F0', 'color' => '#7367F0', 'display_name' => 'Counsellor'],
            'manager'        => ['bg' => '#28C76F', 'color' => '#28C76F', 'display_name' => 'Counsellor Manager'],
            'admission'      => ['bg' => '#00A2B8', 'color' => '#00CFE8', 'display_name' => 'Admission Manager'],
            'admissionagent' => ['bg' => '#4B4B4B', 'color' => '#4B4B4B', 'display_name' => 'Admission Agent'],
            'externalagent'  => ['bg' => '#FF9800', 'color' => '#FF9800', 'display_name' => 'External Agent'],
            'admin'          => ['bg' => '#d32f2f', 'color' => '#b71c1c', 'display_name' => 'Admin'],
            'system'         => ['bg' => '#616161', 'color' => '#616161', 'display_name' => 'System']
        ];

        $userStyle = $roleStyles[$userRole] ?? $roleStyles['system'];

        // Remove @ and clean username
        $cleanUsername = ltrim($username, '@');

        // Format username nicely
        $formattedName = preg_replace('/(?<!\ )[A-Z]/', ' $0', $cleanUsername); // Add space before uppercase letters
        $formattedName = str_replace('.', ' ', $formattedName); // Replace dots with spaces
        $formattedName = trim($formattedName);
        $formattedName = ucwords($formattedName); // Capitalize each word

        // Always show first letter after '@' in uppercase
        $avatarLetter = strtoupper(substr($cleanUsername, 0, 1));
    @endphp

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
        <tr>
            <td align="left" valign="top" style="padding-bottom: 6px;">
                <table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                    <tr>
                        {{-- Avatar --}}
                        <td align="center" valign="middle" 
                            style="width:30px; height:30px; border-radius:50%; background:{{ $userStyle['bg'] }}; color:#fff; text-align:center; font-weight:600; font-size:13px; line-height:30px;">
                            {{ $avatarLetter }}
                        </td>

                        {{-- Username and Badge --}}
                        <td style="padding-left:8px; vertical-align:middle;">
                            <div style="font-weight:600; color:#2d3748; font-size:13px; line-height:15px;">
                                {{ $formattedName }}
                            </div>
                            <div style="display:inline-block; background:{{ $userStyle['bg'] }}; color:#fff; font-size:10px; font-weight:600; padding:3px 10px; border-radius:12px; text-align:center; line-height:1.2;">
                                {{ $userStyle['display_name'] }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>

            {{-- Time --}}
            <td align="right" valign="middle" style="font-size:11px; font-weight:600; color:#4a5568;">
                <i class="far fa-clock"></i>
                {{ isset($messageData['timestamp']) ? Carbon::parse($messageData['timestamp'])->format('M d, h:i A') : now()->format('M d, h:i A') }}
            </td>
        </tr>
    </table>

    {{-- Message --}}
    <div style="background:#f8fafc; border-left:3px solid {{ $userStyle['color'] }}; padding:8px 12px; border-radius:6px; color:#2d3748; font-size:13px; line-height:1.5;">
        {!! nl2br(e($messageData['note'] ?? ($messageData['message'] ?? ''))) !!}
    </div>
</div>


            <div class="info-card">
                <div class="info-card-title">
                    <i class="fas fa-file-alt"></i>
                    Application Details
                </div>
                <table class="info-table">
                    <tr>
                        <td class="label">Application ID</td>
                        <td class="value">{{ $inquiry->unique_id }}</td>
                    </tr>
                    <tr>
                        <td class="label">Student Name</td>
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
                </table>
            </div>

           

            <div class="cta-section">
                <div class="cta-title">View Full Conversation</div>
                <div class="cta-description">
                    Check the complete message thread and respond in the portal
                </div>
                <a href="https://7skyportal.ramadanumrah2025.co.uk/" class="portal-link text-white">
                    <i class="fas fa-external-link-alt"></i> View Application in Portal
                </a>
            </div>
            
            <p style="text-align: center; color: #666; font-size: 14px;">
                Thank you for using 7Sky Portal.
            </p>
        </div>
        
        <div class="footer">
            <p class="text-white">Best regards,</p>
            <p style="font-weight: 700; font-size: 16px;" class="text-white">7Sky Admission Team</p>
            
            <div class="signature">
                <div class="footer-links text-white">
                    <p>© 2025 7Sky Portal. All rights reserved.</p>
                    <p>
                        <a href="https://7skyportal.ramadanumrah2025.co.uk/">
                            7skyportal.ramadanumrah2025.co.uk
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>