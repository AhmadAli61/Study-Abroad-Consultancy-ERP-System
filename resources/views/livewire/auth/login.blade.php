<div>
<div class="container-xxl d-flex align-items-center justify-content-center"
    style="
    height: 100vh; 
    overflow: hidden;
    position: relative;
    background: #ffffff;">  {{-- Changed from transparent to white --}}
    
    <!-- Floating Icons Container -->
    <div class="floating-icons-container" style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;">
        
        <!-- Study Abroad Related Icons -->
        @php
            $icons = [
                ['icon' => 'fas fa-graduation-cap', 'size' => 'fa-2x', 'color' => '#40c3e3', 'top' => '15%', 'left' => '8%', 'animation-delay' => '0s'],
                ['icon' => 'fas fa-plane', 'size' => 'fa-3x', 'color' => '#377db1', 'top' => '25%', 'left' => '85%', 'animation-delay' => '1s'],
                ['icon' => 'fas fa-passport', 'size' => 'fa-lg', 'color' => '#82bf54', 'top' => '70%', 'left' => '5%', 'animation-delay' => '2s'],
                ['icon' => 'fas fa-globe-americas', 'size' => 'fa-4x', 'color' => '#40c3e3', 'top' => '10%', 'left' => '75%', 'animation-delay' => '3s'],
                ['icon' => 'fas fa-university', 'size' => 'fa-2x', 'color' => '#377db1', 'top' => '80%', 'left' => '90%', 'animation-delay' => '4s'],
                ['icon' => 'fas fa-book-open', 'size' => 'fa-lg', 'color' => '#82bf54', 'top' => '40%', 'left' => '3%', 'animation-delay' => '5s'],
                ['icon' => 'fas fa-language', 'size' => 'fa-3x', 'color' => '#40c3e3', 'top' => '85%', 'left' => '15%', 'animation-delay' => '6s'],
                ['icon' => 'fas fa-landmark', 'size' => 'fa-2x', 'color' => '#377db1', 'top' => '20%', 'left' => '92%', 'animation-delay' => '7s'],
                ['icon' => 'fas fa-map-marked-alt', 'size' => 'fa-lg', 'color' => '#82bf54', 'top' => '60%', 'left' => '95%', 'animation-delay' => '8s'],
                ['icon' => 'fas fa-user-graduate', 'size' => 'fa-4x', 'color' => '#40c3e3', 'top' => '75%', 'left' => '80%', 'animation-delay' => '9s'],
                ['icon' => 'fas fa-certificate', 'size' => 'fa-2x', 'color' => '#377db1', 'top' => '35%', 'left' => '10%', 'animation-delay' => '10s'],
                ['icon' => 'fas fa-graduation-cap', 'size' => 'fa-3x', 'color' => '#82bf54', 'top' => '90%', 'left' => '70%', 'animation-delay' => '11s'],
                ['icon' => 'fas fa-comments-dollar', 'size' => 'fa-lg', 'color' => '#40c3e3', 'top' => '5%', 'left' => '20%', 'animation-delay' => '12s'],
                ['icon' => 'fas fa-hands-helping', 'size' => 'fa-2x', 'color' => '#377db1', 'top' => '50%', 'left' => '88%', 'animation-delay' => '13s'],
                ['icon' => 'fas fa-file-contract', 'size' => 'fa-lg', 'color' => '#82bf54', 'top' => '65%', 'left' => '25%', 'animation-delay' => '14s'],
            ];
        @endphp
        
        @foreach($icons as $icon)
            <div class="floating-icon" style="
                position: absolute;
                top: {{ $icon['top'] }};
                left: {{ $icon['left'] }};
                color: {{ $icon['color'] }};
                opacity: 0.15;
                animation: floatIcon 15s ease-in-out infinite;
                animation-delay: {{ $icon['animation-delay'] }};
                z-index: 1;">
                <i class="{{ $icon['icon'] }} {{ $icon['size'] }}"></i>
            </div>
        @endforeach
        
        <!-- Animated lines/connections between icons -->
        <div class="connection-line" style="
            position: absolute;
            top: 20%;
            left: 10%;
            width: 30%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #40c3e3, transparent);
            opacity: 0.1;
            animation: lineFlow 8s linear infinite;"></div>
            
        <div class="connection-line" style="
            position: absolute;
            top: 60%;
            left: 60%;
            width: 25%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #377db1, transparent);
            opacity: 0.1;
            animation: lineFlow 10s linear infinite;
            animation-delay: 2s;"></div>
            
        <div class="connection-line" style="
            position: absolute;
            top: 40%;
            left: 30%;
            width: 40%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #82bf54, transparent);
            opacity: 0.1;
            animation: lineFlow 12s linear infinite;
            animation-delay: 4s;"></div>
    </div>
    
    <div style="
        width: 100%;
        max-width: 1000px;
        height: 100%;
        max-height: 600px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        display: flex;
        position: relative;
        z-index: 10;">  {{-- Added z-index to bring content above icons --}}
        
        <!-- Left Side - Brand & Info -->
        <div style="
            flex: 1;
            background: linear-gradient(135deg, #40c3e3 0%,#377db1 50%, #82bf54 100%);
            padding: 25px 25px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;">
            
            <!-- Background Pattern -->
            <div style="
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);
                z-index: 0;"></div>
            
            <div class="left-panel" style="
                position: relative; 
                z-index: 1;
                max-height: 100%;
                overflow-y: hidden;
                padding-right: 10px;">
                
                <!-- Custom scrollbar -->
                <style>
                    .left-panel::-webkit-scrollbar {
                        width: 4px;
                    }
                    .left-panel::-webkit-scrollbar-track {
                        background: rgba(255, 255, 255, 0.1);
                        border-radius: 2px;
                    }
                    .left-panel::-webkit-scrollbar-thumb {
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 2px;
                    }
                    .left-panel::-webkit-scrollbar-thumb:hover {
                        background: rgba(255, 255, 255, 0.4);
                    }
                </style>
                
                <!-- Brand Logo -->
                <div class="brand-logo animated-element delay-1" style="
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    margin-bottom: 20px;">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: white;
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 10px;
                        flex-shrink: 0;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                        <img 
                            src="{{ asset('build/assets/img/companylogo.png') }}" 
                            alt="company Logo" 
                            style="
                                width: 100%;
                                height: 100%;
                                object-fit: contain;"/>
                    </div>
                    <div style="min-width: 0;">
                        <h1 style="
                            margin: 0;
                            font-size: clamp(24px, 2.5vw, 32px);
                            font-weight: 800;
                            letter-spacing: 0.5px;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            background: linear-gradient(90deg, #ffffff, #ffffff, #ffffff, #82bf54, #ffffff);
                            background-size: 300% 100%;
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            background-clip: text;
                            animation: brandGradient 5s ease-in-out infinite;
                            font-family: 'Segoe UI', 'Roboto', sans-serif;">
                            our company
                        </h1>
                        <p style="
                            margin: 5px 0 0 0;
                            opacity: 0.9;
                            font-size: clamp(12px, 1.2vw, 14px);
                            font-weight: 500;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;">
                            Your Gateway to Global Education
                        </p>
                    </div>
                </div>

                <!-- Welcome Message -->
                <h2 style="
                color: white;
                    font-size: clamp(18px, 1.8vw, 24px); 
                    font-weight: 700;
                    margin-bottom: 10px; 
                    line-height: 1.3;
                    opacity: 0;
                    animation: fadeIn 0.8s ease 0.2s forwards;
                    ">
                    Welcome to Your CRM Dashboard
                </h2>
                
                <!-- Description -->
                <p style="
                    font-size: clamp(13px, 1.1vw, 14px);
                    opacity: 0.9;
                    line-height: 1.3;
                    margin-bottom: 20px;
                    opacity: 0;
                    animation: fadeIn 0.8s ease 0.3s forwards;
                    ">
                    Manage student applications, university partnerships, visa processing, 
                    and client communications all in one powerful platform. Streamline your 
                    study abroad consultancy operations with our comprehensive CRM solution.
                </p>

                <!-- Features -->
                <div class="features animated-element delay-4" style="
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
                    gap: 10px;
                    margin-bottom: 20px;">
                    @php
                        $features = [
                            ['icon' => 'fas fa-user-graduate', 'text' => 'Student Management'],
                            ['icon' => 'fas fa-university', 'text' => 'University Portal'],
                            ['icon' => 'fas fa-file-alt', 'text' => 'Visa Processing'],
                            ['icon' => 'fas fa-comments', 'text' => 'Client Communication'],
                            ['icon' => 'fas fa-chart-bar', 'text' => 'Analytics Dashboard'],
                            ['icon' => 'fas fa-database', 'text' => 'Secure Database']
                        ];
                    @endphp
                    
                    @foreach($features as $feature)
                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            flex-shrink: 0;
                            opacity: 0;
                            animation: fadeIn 0.8s ease {{ 0.4 + ($loop->index * 0.1) }}s forwards;">
                            <div style="
                                width: 32px;
                                height: 32px;
                                background: rgba(255, 255, 255, 0.2);
                                border-radius: 8px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 16px;
                                flex-shrink: 0;
                                color: white;">
                                <i class="{{ $feature['icon'] }}"></i>
                            </div>
                            <span style="
                                font-size: clamp(12px, 1.1vw, 14px);
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;">
                                {{ $feature['text'] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Stats -->
                <div class="stats animated-element delay-7" style="
                    display: flex;
                    justify-content: space-between;
                    gap: 12px;
                    border-top: 1px solid rgba(255, 255, 255, 0.2);
                    padding-top: 15px;
                    flex-wrap: wrap;">
                    @php
                        $stats = [
                            ['value' => '500+', 'label' => 'Students'],
                            ['value' => '50+', 'label' => 'Universities'],
                            ['value' => '99%', 'label' => 'Success Rate']
                        ];
                    @endphp
                    
                    @foreach($stats as $stat)
                        <div style="
                            text-align: center; 
                            flex: 1; 
                            min-width: 70px;
                            opacity: 0;
                            animation: fadeIn 0.8s ease {{ 0.7 + ($loop->index * 0.1) }}s forwards;">
                            <div style="
                                font-size: clamp(18px, 1.8vw, 24px); 
                                font-weight: 700;
                                line-height: 1;">
                                {{ $stat['value'] }}
                            </div>
                            <div style="
                                font-size: clamp(9px, 0.9vw, 11px); 
                                opacity: 0.8;
                                margin-top: 5px;">
                                {{ $stat['label'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div style="
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;">
            
            <div style="
                max-width: 380px;
                margin: 0 auto; 
                width: 100%;">
                
                <!-- Logo Section -->
                <div style="
                    text-align: center; 
                    margin-bottom: 25px;">
                    <img 
                        src="{{ asset('build/assets/img/companylogo.png') }}" 
                        alt="our company Logo" 
                        style="
                            width: 200px;
                            height: auto;
                            max-width: 75%; 
                            object-fit: contain;
                            display: block;
                            margin: 0 auto 15px auto;
                            opacity: 0;
                            animation: fadeIn 0.8s ease 0.1s forwards;"/>
                    
                    <div style="
                        margin-top: 15px;">
                        <h2 style="
                            margin: 0 0 6px 0;
                            font-size: clamp(22px, 2.2vw, 28px);
                            font-weight: 700;
                            line-height: 1.1;
                            letter-spacing: 0.6px;
                            background: linear-gradient(135deg, #40c3e3 0%,#377db1 50%, #82bf54 100%);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            background-clip: text;
                            animation: flowingGradient 4s ease-in-out infinite;
                            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif">
                            Login Dashboard
                        </h2>
                        <p style="
                            margin: 0;
                            color: #6b7280;
                            font-size: clamp(12px, 1.1vw, 14px);
                            line-height: 1.4;
                            opacity: 0.9;">
                            Sign in to access the CRM dashboard
                        </p>
                    </div>
                </div>

                <!-- Error Message -->
              <!-- General Error Message -->
@if (session()->has('error'))
    <div style="
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 18px;
        font-size: clamp(11px, 1vw, 13px);
        display: flex;
        align-items: center;
        gap: 8px;
        opacity: 0;
        animation: fadeIn 0.8s ease 0.3s forwards;">
        <div style="font-size: 14px;"><i class="fas fa-exclamation-triangle"></i></div>
        {{ session('error') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
            aria-label="Close" style="font-size: 9px;"></button>
    </div>
@endif

                <!-- Login Form -->
                <form id="formAuthentication" wire:submit.prevent="login">
                    @csrf
                    
                    <!-- Username Field -->
                    <!-- Username Field -->
<div class="mb-3" style="opacity: 0; animation: fadeIn 0.8s ease 0.4s forwards;">
    <label for="username" class="form-label" style="
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #374151;
        font-size: clamp(12px, 1.1vw, 14px);">
        Username
    </label>
    <div style="position: relative;">
        <div style="
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;">
            <i class="fas fa-user"></i>
        </div>
        <input 
            type="text" 
            wire:model="username" 
            class="form-control" 
            id="username"
            name="username" 
            placeholder="Enter your username" 
            required
            style="
                width: 100%;
                padding: 12px 14px 12px 44px;
                border: 1.5px solid {{ $errors->has('username') || isset($fieldErrors['username']) ? '#dc2626' : '#e5e7eb' }};
                border-radius: 8px;
                font-size: clamp(13px, 1.1vw, 15px);
                transition: all 0.3s;
                outline: none;
                background-color: white;"/>
    </div>
    @if($errors->has('username') || isset($fieldErrors['username']))
        <span class="text-danger small" style="
            display: block;
            margin-top: 4px;
            font-size: 11px;
            padding-left: 4px;">
            {{ $errors->first('username') ?: $fieldErrors['username'] ?? '' }}
        </span>
    @endif
</div>
                    <!-- Password Field -->
                    <!-- Password Field -->
<div class="mb-4" style="opacity: 0; animation: fadeIn 0.8s ease 0.5s forwards;">
    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;">
        <label class="form-label" for="password" style="
            font-weight: 600;
            color: #374151;
            font-size: clamp(12px, 1.1vw, 14px);">
            Password
        </label>
    </div>
    <div style="position: relative;">
        <div style="
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;">
            <i class="fas fa-lock"></i>
        </div>
        <input 
            wire:model="password" 
            type="password" 
            id="password" 
            class="form-control"
            name="password" 
            placeholder="••••••••••••" 
            required
            style="
                width: 100%;
                padding: 12px 44px 12px 44px;
                border: 1.5px solid {{ $errors->has('password') || isset($fieldErrors['password']) ? '#dc2626' : '#e5e7eb' }};
                border-radius: 8px;
                font-size: clamp(13px, 1.1vw, 15px);
                transition: all 0.3s;
                outline: none;
                background-color: white;"/>
        <span style="
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #40c3e3;
            cursor: pointer;
            font-size: 16px;"
            onclick="togglePasswordVisibility()">
            <i class="fas fa-eye" id="passwordToggleIcon"></i>
        </span>
    </div>
    @if($errors->has('password') || isset($fieldErrors['password']))
        <span class="text-danger small" style="
            display: block;
            margin-top: 4px;
            font-size: 11px;
            padding-left: 4px;">
            {{ $errors->first('password') ?: $fieldErrors['password'] ?? '' }}
        </span>
    @endif
</div>

                    <!-- Submit Button -->
                    <div style="opacity: 0; animation: fadeIn 0.8s ease 0.6s forwards;">
                        <button 
                            class="btn btn-primary w-100" 
                            type="submit"
                            style="
                                padding: 14px;
                                background: linear-gradient(135deg, #40c3e3 0%,#377db1 50%, #82bf54 100%);
                                color: white;
                                border: none;
                                border-radius: 8px;
                                font-size: clamp(13px, 1.1vw, 15px);
                                font-weight: 600;
                                cursor: pointer;
                                transition: all 0.3s;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                gap: 8px;">
                            @if($isLoading)
                                <div style="
                                    width: 18px;
                                    height: 18px;
                                    border: 2px solid rgba(255,255,255,0.3);
                                    border-top-color: white;
                                    border-radius: 50%;
                                    animation: spin 1s linear infinite;"></div>
                                Signing In...
                            @else
                                <i class="fas fa-key"></i> Sign In to Dashboard
                            @endif
                        </button>
                    </div>
                </form>

                <!-- Security Notice -->
                <div style="
                    margin-top: 20px;
                    padding-top: 15px;
                    border-top: 1px solid #e5e7eb;
                    text-align: center;
                    opacity: 0;
                    animation: fadeIn 0.8s ease 0.7s forwards;">
                    <p style="
                        margin: 0;
                        color: #6b7280;
                        font-size: clamp(10px, 0.9vw, 11px);
                        line-height: 1.4;">
                        <i class="fas fa-shield-alt" style="margin-right: 5px;"></i>
This system is restricted to authorized users only, and all activities are monitored.                       
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    // Prevent scrollbar flash
    document.addEventListener('DOMContentLoaded', function() {
        // Hide overflow initially
        document.body.style.overflow = 'hidden';
        
        // Show left panel scrollbar after page loads
        setTimeout(function() {
            const leftPanel = document.querySelector('.left-panel');
            if (leftPanel) {
                leftPanel.style.overflowY = 'auto';
            }
            document.body.style.overflow = '';
        }, 300);
    });

    function togglePasswordVisibility() {
        let passwordField = document.getElementById("password");
        let toggleIcon = document.getElementById("passwordToggleIcon");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

<style>
    /* Prevent scrollbar flash */
    html, body {
        overflow-x: hidden;
        background: #ffffff;  /* Added white background */
    }
    
    .container-xxl > div {
        overflow: hidden !important;
    }
    
    /* Smooth transition for left panel */
    .left-panel {
        transition: overflow-y 0.3s ease;
    }
    
    /* New animations for floating icons */
    @keyframes floatIcon {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
            opacity: 0.15;
        }
        25% {
            transform: translateY(-20px) rotate(5deg);
            opacity: 0.2;
        }
        50% {
            transform: translateY(-10px) rotate(-5deg);
            opacity: 0.1;
        }
        75% {
            transform: translateY(-15px) rotate(3deg);
            opacity: 0.18;
        }
    }
    
    @keyframes lineFlow {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }
    
    /* Floating icons hover effect */
    .floating-icon:hover {
        opacity: 0.25 !important;
        transform: scale(1.1);
        transition: all 0.3s ease;
    }
    
    /* Animation keyframes */
    @keyframes fadeIn {
        from { 
            opacity: 0; 
            transform: translateY(20px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    @keyframes brandGradient {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }
    
    @keyframes flowingGradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
    
    .animated-element {
        opacity: 0;
        animation: fadeIn 0.8s ease forwards;
    }
    
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }
    .delay-6 { animation-delay: 0.6s; }
    .delay-7 { animation-delay: 0.7s; }
    
    .form-control:focus {
        border-color: #40c3e3 !important;
        box-shadow: 0 0 0 3px rgba(0, 0, 128, 0.1) !important;
    }
    
    button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 128, 0.3);
    }
    
    button[type="submit"]:active {
        transform: translateY(0);
    }
    
    /* Responsive adjustments for floating icons */
    @media (max-width: 992px) {
        .floating-icon {
            opacity: 0.1 !important;
        }
        
        .container-xxl > div {
            flex-direction: column !important;
            max-height: 90vh !important;
            margin: 20px !important;
        }
        
        .container-xxl > div > div {
            flex: none !important;
            max-height: 50vh !important;
            padding: 30px 20px !important;
        }
    }
    
    @media (max-width: 768px) {
        .floating-icon {
            display: none !important; /* Hide icons on mobile for better performance */
        }
        
        .connection-line {
            display: none !important;
        }
        
        .container-xxl {
            padding: 10px !important;
        }
        
        .container-xxl > div {
            max-height: 95vh !important;
            border-radius: 16px !important;
        }
        
        .features {
            grid-template-columns: 1fr !important;
        }
        
        .stats > div {
            min-width: 70px !important;
        }
    }
    
    @media (max-height: 600px) {
        .floating-icon {
            opacity: 0.08 !important;
        }
        
        .container-xxl > div {
            max-height: 95vh !important;
            margin: 10px 0 !important;
        }
        
        .brand-logo {
            margin-bottom: 15px !important;
        }
        
        h2 {
            margin-bottom: 10px !important;
        }
        
        .features {
            margin-bottom: 20px !important;
        }
        
        .container-xxl > div > div:first-child {
            padding: 20px 15px !important;
        }
        
        .container-xxl > div > div:last-child {
            padding: 20px 15px !important;
        }
    }
</style>
</div>