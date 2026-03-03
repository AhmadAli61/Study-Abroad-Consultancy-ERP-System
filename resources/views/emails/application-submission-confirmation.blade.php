<!DOCTYPE html>
<html>
<head>
    <title>Application Registered Successfully</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 95%;
            width: 650px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .header {
            background: linear-gradient(135deg, #005b9e 0%, #00b2de 100%);
            color: #fff;
            text-align: center;
            padding: 40px 20px 30px;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 8px;
            font-weight: 700;
        }
        .header p {
            font-size: 15px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            text-align: center;
            font-size: 17px;
            margin-bottom: 25px;
        }
        .confirmation-box {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #fff;
            text-align: center;
            padding: 28px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        }
        .confirmation-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .confirmation-message {
            font-size: 15px;
            opacity: 0.95;
        }
        .application-details {
            background: #f8f9fa;
            border-left: 5px solid #004e92;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }
        .details-title {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #004e92;
            margin-bottom: 15px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .details-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e0e0e0;
            word-wrap: break-word;
        }
        .details-table .label {
            font-weight: 600;
            color: #495057;
            width: 38%;
        }
        .details-table .value {
            color: #212529;
            font-weight: 500;
        }
        .contact-info {
            text-align: center;
            background: #e3f2fd;
            padding: 22px;
            border-radius: 10px;
            border: 1px solid #bbdefb;
        }
        .contact-title {
            color: #004e92;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .counsellor-email {
            font-size: 16px;
            font-weight: 700;
            color: #003366;
            margin-bottom: 5px;
        }
        .footer {
            background: #00264d;
            color: #ffffff !important;
            text-align: center;
            padding: 25px 15px;
            font-size: 13px;
        }
        .footer p {
            margin: 4px 0;
        }
        .footer small {
            opacity: 0.8;
        }
        @media (max-width: 600px) {
            .container { 
                margin: 15px; 
                max-width: calc(100% - 30px);
            }
            .content { padding: 20px; }
            .details-table td { padding: 8px 10px; font-size: 12px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
<!-- Success Circle with Centered Tick (Gmail Safe) -->
<table align="center" width="85" height="85" style="margin: 0 auto 18px; border-collapse: collapse;">
  <tr>
    <td align="center" valign="middle" bgcolor="#fff"
        style="border-radius:50%; width:85px; height:85px; box-shadow:0 6px 15px rgba(40,167,69,0.4);">
      <span style="color:#28a745; font-size:45px; font-weight:bold; line-height:1; display:inline-block;">✓</span>
    </td>
  </tr>
</table>
            <h1>Application Registered Successfully</h1>
            <p>our company</p>
        </div>
        <div class="content">
            <div class="greeting">Dear <strong>{{ $inquiry->student_name }}</strong>,</div>
            <div class="confirmation-box">
                <div class="confirmation-title">Congratulations!</div>
                <div class="confirmation-message">
                    Your application has been successfully registered with <strong>our company</strong>. Your admission process has officially started.
                </div>
            </div>
            <div class="application-details">
                <div class="details-title">Application Summary</div>
                <table class="details-table">
                    <tr><td class="label">Name</td><td class="value">{{ $inquiry->student_name }}</td></tr>
                    <tr><td class="label">University</td><td class="value">{{ $inquiry->university_name ?? 'N/A' }}</td></tr>
                    <tr><td class="label">Course</td><td class="value">{{ $inquiry->course_name ?? 'N/A' }}</td></tr>
                    <tr><td class="label">Intake</td><td class="value">{{ $inquiry->course_intake ?? 'N/A' }}</td></tr>
                    <tr><td class="label">Reg. Date</td><td class="value">{{ $inquiry->created_at->format('j M, Y') }}</td></tr>
                </table>
            </div>
            <div class="contact-info" style="text-align: center; margin: 0; padding: 0; overflow-x: auto;">
  <!-- Title -->
  <div class="contact-title" style="text-align: center; margin: 0; padding: 0;">
      <div style="font-size: 16px; font-weight: bold; color: #333; margin: 10px 0 6px 0;">
    📞 Contact Us
  </div>
  <p style="font-size: 13px; color: #555; margin: 0 0 12px 0; line-height: 1.4;">
    For any questions, concerns, or guidance, contact our admission team:
  </p>
  </div>

  <!-- Email (single centered line) -->
  <div style="margin: 0 0 8px 0; padding: 0;">
    <div style="font-size: 14px; color: #004e92; margin-bottom: 4px;">📧 Email</div>
    <div style="display: inline-block; white-space: nowrap; font-size: 13px; color: #000; font-weight: 600; margin: 0; padding: 0;">
      {{ $companyEmail }}
    </div>
  </div>

  <!-- Phone (single centered line) -->
  <div style="margin: 0 0 10px 0; padding: 0;">
    <div style="font-size: 14px; color: #004e92; margin-bottom: 4px;">📞 Phone</div>
    <div style="display: inline-block; white-space: nowrap; font-size: 13px; color: #000; font-weight: 600; margin: 0; padding: 0;">
      {{ $companyPhone }}
    </div>
  </div>

  <p style="font-size: 13px; color: #555; margin: 0; padding: 0; line-height: 1.4;">
    Our admission team will guide you through the next steps of your admission process.
  </p>
</div>

            <p style="text-align: center; color: #666; margin-top: 25px; font-size: 13px;">
                <strong>Note:</strong> Please keep this confirmation for your records.
            </p>
        </div>
        <div class="footer">
            <p>Best regards,</p>
            <p><strong>our company Team</strong></p>
            <small>© 2025 our company. All rights reserved.<br>This is an automated confirmation message — please do not reply.</small>
        </div>
    </div>
</body>
</html>