<!DOCTYPE html>
<html>
<head>
    <title>Application Status Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
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
        
        .header {
            background: linear-gradient(135deg, #005b9e 0%, #00b2de 100%);
            color: white !important;
            padding: 30px 20px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0 0 10px;
            font-size: 28px;
            font-weight: 600;
        }
        
        .content {
            padding: 30px;
            background: #ffffff;
        }
        
        .greeting {
            margin-bottom: 20px;
            font-size: 16px;
        }
        
        .status-box {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin: 25px 0;
            border-left: 4px solid #005b9e;
        }
        
        .status-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
            text-align: center;
        }
        
        .status-badge {
            display: inline-block;
            padding: 10px 20px;
            background: #005b9e;
            color: white !important;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
            margin: 10px 0;
        }
        
        /* NEW: Active Applications Styles */
        .active-applications {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            padding: 25px;
            border-radius: 10px;
            margin: 25px 0;
            border: 2px solid #90caf9;
        }
        
        .active-applications-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #1565c0;
            text-align: center;
        }
        
        .application-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #2196f3;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .application-university {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .application-course {
            color: #555;
            font-size: 13px;
            margin-bottom: 8px;
        }
        
        .application-status {
            display: inline-block;
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .progress-message {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }
        
        .next-steps {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        
        .next-steps-title {
            font-weight: 600;
            color: #2e7d32;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
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
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .info-table tr {
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-table tr:last-child {
            border-bottom: none;
        }
        
        .info-table td {
            padding: 12px 15px;
            vertical-align: top;
        }
        
        .info-table .label {
            background-color: #f8f9fa;
            font-weight: 600;
            width: 35%;
            color: #495057;
            border-right: 2px solid #e9ecef;
        }
        
        .info-table .value {
            background-color: white;
            color: #212529;
            font-weight: 500;
        }
        
        .contact-section {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: #e3f2fd;
            border-radius: 10px;
            border: 1px solid #bbdefb;
        }
        
        .contact-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #005b9e;
        }
        
        .counsellor-email {
            font-size: 16px;
            font-weight: 700;
            color: #003366;
            margin: 15px 0;
        }
        
        .success-celebration {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white !important;
            border-radius: 12px;
        }
        
        .success-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .restart-notice {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #ff9800 0%, #ffb74d 100%);
            color: white !important;
            border-radius: 12px;
        }
        
        .closure-notice {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #c01414 0%, #c01414 100%);
            color: white;
            border-radius: 12px;
        }
        
        .withdrawal-notice {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #ff5252 0%, #ff5252 100%);
            color: white !important;
            border-radius: 12px;
        }
        
        .rejection-notice {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #ff0000 0%, #ff0000 100%);
            color: white !important;
            border-radius: 12px;
        }
        
        .footer {
            text-align: center;
            padding: 30px 20px;
            background: #2c3e50;
            color: white !important;
        }
        
        .footer p {
            margin: 0 0 10px;
        }
        
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
            
            .info-card {
                padding: 20px;
            }
            
            .info-table td {
                padding: 10px 8px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Application Status Update</h1>
            <p>7 Sky Consultancy</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                <p>Dear <strong>{{ $inquiry->student_name }}</strong>,</p>
            </div>

            @php
                $statusConfig = [
                    'underassessment' => ['label' => 'Under Assessment', 'color' => '#517577'],
                    'processed' => ['label' => 'Processed', 'color' => '#09122C'],
                    'conditional' => ['label' => 'Conditional Offer', 'color' => '#27391C'],
                    'unconditional' => ['label' => 'Unconditional Offer', 'color' => '#87431D'],
                    'undercas' => ['label' => 'Under CAS', 'color' => '#C69749'],
                    'casreceived' => ['label' => 'CAS Received', 'color' => '#828383'],
                    'visaprocess' => ['label' => 'Visa Process', 'color' => '#673AB7'],
                    'enrollment' => ['label' => 'Enrollment', 'color' => '#009688'],
                    'caseclosed' => ['label' => 'Case Closed', 'color' => '#c01414'],
                    'withdrawn' => ['label' => 'Withdrawn', 'color' => '#ff5252'],
                    'rejection' => ['label' => 'Rejected', 'color' => '#ff0000'],
                ];
                
                $newConfig = $statusConfig[$newStatus] ?? ['label' => ucfirst($newStatus), 'color' => '#666'];
                $negativeStatuses = ['caseclosed', 'withdrawn', 'rejection'];
                $isNegativeStatus = in_array($newStatus, $negativeStatuses);
                $isRestarting = in_array($oldStatus, $negativeStatuses) && $newStatus === 'underassessment';
                
                // Define status progression
                $statusProgression = [
                    'underassessment' => 'Processed',
                    'processed' => 'Conditional/Unconditional Offer',
                    'conditional' => 'Unconditional Offer',
                    'unconditional' => 'Under CAS',
                    'undercas' => 'CAS Received',
                    'casreceived' => 'Visa Process',
                    'visaprocess' => 'Enrollment'
                ];
                $nextStep = $statusProgression[$newStatus] ?? null;
            @endphp

            <!-- Special Celebration for Enrollment -->
            @if($newStatus === 'enrollment')
            <div class="success-celebration">
                <div class="success-title">🎓 Congratulations on Your Enrollment! 🎉</div>
                <p><strong>Outstanding achievement!</strong> You have successfully reached the final stage of your admission journey.</p>
                <p>You are now officially enrolled and will be studying at the university. This remarkable accomplishment marks the beginning of an exciting new chapter in your academic career.</p>
                <p>Our entire team celebrates this milestone with you and wishes you tremendous success in your studies!</p>
            </div>
            @endif

            <!-- Restart Notice -->
            @if($isRestarting)
            <div class="restart-notice">
                <div class="success-title">🔄 Welcome Back! Your Application Process Has Restarted</div>
                <p><strong>We're delighted to inform you</strong> that your application process has been successfully reopened and is now active again.</p>
                <p>Our admission team has resumed working on your case, and we're committed to guiding you through every step of this renewed journey. This fresh start brings new opportunities, and we're here to ensure your success.</p>
                <p>Let's work together to achieve your academic goals!</p>
            </div>
            @endif

            <!-- Case Closed Notice -->
            @if($newStatus === 'caseclosed')
            <div class="closure-notice">
                <div class="success-title">📁 Application Case Closed</div>
                <p>We would like to inform you that your application has been closed by our admission team.</p>
                <p>While our formal engagement concludes here, we want to express our sincere appreciation for considering 7 Sky Consultancy for your educational journey. It has been our pleasure to assist you thus far.</p>
                <p>Should your circumstances change or if you wish to explore other educational opportunities in the future, please know that our doors remain open to assist you.</p>
            </div>
            @endif

            <!-- Withdrawn Notice -->
            @if($newStatus === 'withdrawn')
            <div class="withdrawal-notice">
                <div class="success-title">↩️ Application Withdrawn</div>
                <p>We acknowledge your request to withdraw your application from the admission process.</p>
                <p>Your decision has been respected and processed accordingly. We understand that circumstances can change, and we respect your choice at this time.</p>
                <p>If you're facing any challenges or if there's anything we can do to assist you, or if you wish to restart the process in the future, please don't hesitate to reach out. We're here to support your educational aspirations whenever you're ready.</p>
            </div>
            @endif

            <!-- Rejection Notice -->
            @if($newStatus === 'rejection')
            <div class="rejection-notice">
                <div class="success-title">⚠️ Application Rejected</div>
                <p class="text-white">We regret to inform you that the university has made the decision not to proceed with your application at this time.</p>
                <p class="text-white">Please understand that university admissions are highly competitive, and this decision does not reflect on your capabilities or potential. Many factors contribute to admission decisions, and this outcome is specific to this particular institution and intake.</p>
                <p class="text-white">This is not the end of your journey - it's merely a redirection. We have successfully guided many students to excellent alternatives when their first choice didn't work out.</p>
            </div>
            @endif

           <!-- ACTIVE APPLICATIONS SECTION - SHOWS ONLY FOR NEGATIVE STATUSES WITH OTHER ACTIVE APPS -->
@if($isNegativeStatus && count($activeApplications) > 0)
<div style="background: #e9f4ff; border-radius: 8px; padding: 15px; font-family: Arial, sans-serif;">
    <div style="font-size: 18px; font-weight: bold; color: #155fa0; text-align: center; margin-bottom: 10px;">
        💫 Don't Worry! Your Other Applications Are Still Active
    </div>
    <p style="text-align: center; font-size: 14px; color: #333; line-height: 1.5; margin-bottom: 18px;">
        <strong>Good news!</strong> While this particular application has been updated, 
        you have other applications that are still actively being processed. 
        We're continuing to work on these opportunities for you:
    </p>

    @foreach($activeApplications as $application)
    @php
        $appStatusConfig = $statusConfig[$application->inquiry_status] ?? ['label' => ucfirst($application->inquiry_status), 'color' => '#666'];
    @endphp
    <div style="background: #ffffff; border-radius: 8px; padding: 12px; margin-bottom: 12px; border: 1px solid #d5e7ff;">
        <div style="font-size: 15px; font-weight: bold; color: #0a3d62;">
            🎓 {{ $application->university_name }}
        </div>
        <div style="font-size: 13px; color: #333; margin-top: 4px;">
            📚 {{ $application->course_name }}
        </div>
        <div style="font-size: 11px; color: #777; margin-top: 6px;">
            ID: {{ $application->unique_id }}
        </div>
        <div style="margin-top: 6px;">
            <span style="display: inline-block; background-color: {{ $appStatusConfig['color'] }}; color: white; padding: 3px 8px; font-size: 11px; border-radius: 10px;">
                {{ $appStatusConfig['label'] }}
            </span>
        </div>
    </div>
    @endforeach

    <p style="text-align: center; margin-top: 20px; font-size: 13px; color: #333; background: #ffffff; padding: 10px; border-radius: 6px;">
        <strong>Multiple Opportunities:</strong> We believe in keeping your options open. 
        Having multiple applications in process increases your chances of success. 
        Our team is actively working on all your active applications simultaneously.
    </p>
</div>
@endif


            <div class="status-box">
                <div class="status-title">
                    @if($isNegativeStatus)
                    Application Status Update
                    @elseif($isRestarting)
                    Process Successfully Restarted
                    @else
                    🎉 Congratulations! Progress Update
                    @endif
                </div>
                
                <div style="text-align: center;">
                    <div class="status-badge" style="background-color: {{ $newConfig['color'] }};">
                        {{ $newConfig['label'] }}
                    </div>
                </div>
                
                <div class="progress-message">
                    @if($newStatus === 'underassessment' && !$isRestarting)
                    <p><strong>Your application is now under thorough assessment!</strong></p>
                    <p>Our team has begun the detailed review of your documents and qualifications. This is the first crucial step where we ensure all your materials meet the university's requirements.</p>
                    @elseif($newStatus === 'processed')
                    <p><strong>Excellent progress! Your application has been processed successfully.</strong></p>
                    <p>Your documents have been verified and your application has been formally submitted to the university. You're one step closer to receiving an offer!</p>
                    @elseif($newStatus === 'conditional')
                    <p><strong>Wonderful news! You've received a Conditional Offer!</strong></p>
                    <p>This is a significant milestone! The university has shown strong interest in your application. Now we need to work on meeting the specific conditions outlined in your offer letter.</p>
                    @elseif($newStatus === 'unconditional')
                    <p><strong>Outstanding achievement! You've received an Unconditional Offer!</strong></p>
                    <p>This is a moment to celebrate! The university has officially accepted you without any conditions. You're guaranteed a place in your chosen program!</p>
                    @elseif($newStatus === 'undercas')
                    <p><strong>Great progress! Your application is now Under CAS processing.</strong></p>
                    <p>We're working on your Confirmation of Acceptance for Studies (CAS) - the crucial document needed for your visa application. This brings you closer to your study abroad journey!</p>
                    @elseif($newStatus === 'casreceived')
                    <p><strong>Excellent! Your CAS has been received successfully.</strong></p>
                    <p>This is a major accomplishment! With your CAS in hand, we can now proceed to the next exciting phase - your visa application.</p>
                    @elseif($newStatus === 'visaprocess')
                    <p><strong>Fantastic! We've started your Visa Process.</strong></p>
                    <p>You're in the final stages now! We're preparing and submitting your visa application to ensure everything is perfect for this crucial step.</p>
                    @endif
                </div>

                @if($nextStep && !$isNegativeStatus)
                <div class="next-steps">
                    <div class="next-steps-title">📈 What's Next?</div>
                    <p>Your next milestone: <strong>{{ $nextStep }}</strong></p>
                    <p>We're moving steadily toward your goal. Each step brings you closer to beginning your academic journey abroad. Stay positive - you're making excellent progress!</p>
                </div>
                @endif
            </div>

            <div class="info-card">
                <div class="info-card-title">Application Summary</div>
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
                    <tr>
                        <td class="label">Status Updated</td>
                        <td class="value">
                            {{ $inquiry->status_change_time ? $inquiry->status_change_time->format('j F, Y \\a\\t g:i A') : now()->format('j F, Y \\a\\t g:i A') }}
                        </td>
                    </tr>
                </table>
            </div>

           <div class="contact-section">
   <div class="contact-section" style="text-align: center; margin: 0; padding: 0;">
  <!-- Title -->
  <div style="font-size: 16px; font-weight: bold; color: #333; margin: 10px 0 6px 0;">
    📞 Contact Us
  </div>

  <!-- Subtitle -->
  <p style="font-size: 13px; color: #555; margin: 0 0 12px 0; line-height: 1.4;">
    For any questions, concerns, or guidance, contact our admission team:
  </p>

  <!-- Email -->
  <div style="margin: 0 0 10px 0; padding: 0;">
    <div style="font-size: 13px; color: #666; margin-bottom: 3px;">📧 Email</div>
    <div style="font-size: 13px; color: #000; font-weight: 600; white-space: nowrap;">
      {{ $companyEmail }}
    </div>
  </div>

  <!-- Phone -->
  <div style="margin: 6px 0 8px 0; padding: 0;">
    <div style="font-size: 13px; color: #666; margin-bottom: 3px;">📞 Phone</div>
    <div style="font-size: 13px; color: #000; font-weight: 600; white-space: nowrap;">
      {{ $companyPhone }}
    </div>
  </div>
</div>

    
    @if($newStatus === 'rejection')
        @if(count($activeApplications) > 0)
        <p style="margin-top: 15px; font-size: 14px; background: white; padding: 15px; border-radius: 8px;">
            <strong>Continuous Support:</strong> We're managing <strong>{{ count($activeApplications) + 1 }}</strong> application(s) for you in total. 
            While this particular application wasn't successful, your other applications are progressing well. 
            Contact us to discuss alternative options with your active applications.
        </p>
        @else
        <p style="margin-top: 15px; font-size: 14px; background: white; padding: 15px; border-radius: 8px;">
            <strong>Next Steps Recommendation:</strong> Contact our admission team to discuss alternative university options. 
            Many of our students have found even better opportunities when we explored different pathways together.
        </p>
        @endif
    @elseif($newStatus === 'withdrawn')
        @if(count($activeApplications) > 0)
        <p style="margin-top: 15px; font-size: 14px; background: white; padding: 15px; border-radius: 8px;">
            <strong>We're Still Here For You:</strong> Your other applications continue to progress. 
            We're actively working on them and will keep you updated on each one individually.
        </p>
        @else
        <p style="margin-top: 15px; font-size: 14px; background: white; padding: 15px; border-radius: 8px;">
            <strong>We're Here When You're Ready:</strong> If you change your mind or wish to discuss other options, 
            our admission team will be happy to restart your process or explore alternative pathways.
        </p>
        @endif
    @elseif($newStatus === 'caseclosed')
        @if(count($activeApplications) > 0)
        <p style="margin-top: 15px; font-size: 14px; background: white; padding: 15px; border-radius: 8px;">
            <strong>Ongoing Support:</strong> While this application has concluded, we continue to actively work on your other applications. 
            We'll ensure you receive updates on each one as they progress.
        </p>
        @else
        <p style="margin-top: 15px; font-size: 14px; background: white; padding: 15px; border-radius: 8px;">
            <strong>Future Opportunities:</strong> While this particular journey has concluded, we remain available 
            should you wish to explore educational opportunities in the future.
        </p>
        @endif
    @elseif($isRestarting)
    <p style="margin-top: 15px; font-size: 14px; background: white; padding: 15px; border-radius: 8px;">
        <strong>Fresh Start Support:</strong> We're excited to continue supporting your educational journey. 
        Our admission team will guide you through this renewed process.
    </p>
    @else
    <p style="margin-top: 15px; font-size: 14px; background: white; padding: 15px; border-radius: 8px;">
        <strong>Continuous Support:</strong> Remember, we're with you at every step of this journey. 
        Our team is monitoring your progress and will proactively guide you through each upcoming stage.
    </p>
    @endif
</div>
            
            <p style="text-align: center; color: #666; font-style: italic;">
                "Education is the most powerful weapon which you can use to change the world." - Nelson Mandela
            </p>
            
            <p style="text-align: center; color: #666;">
                Thank you for trusting <strong>7 Sky Consultancy</strong> with your educational journey.
            </p>
        </div>
        
        <div class="footer">
            <p>With best wishes for your success,</p>
            <p><strong>The 7 Sky Consultancy Team</strong></p>
            <p style="font-size: 12px; opacity: 0.8; color: white;">
                © 2025 7 Sky Consultancy. All rights reserved.<br>
                Transforming educational aspirations into achievements.
            </p>
        </div>
    </div>
</body>
</html>