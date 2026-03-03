<div>
    @if($showReminder)
    <!-- Fullscreen Overlay -->
    <div class="overlay" wire:ignore.self></div>

    <!-- Reminder Pop-up -->
    <div class="reminder-popup shadow-lg">
        <div class="popup-content">
            <!-- Icon Section -->
            <div class="icon-wrapper">
                <i class="fas fa-calendar-check"></i>
            </div>
            <!-- Text Content -->
            <h3 class="title">Daily Report Reminder</h3>
            <p class="message" wire:ignore>
                {!! $reminderMessage !!}
            </p>
            <!-- Buttons -->
            <div class="button-group">
                <a href="{{ route('manager.addreport', ['date' => $missingReportDate]) }}" class="btn-submit">
                    Submit Now
                </a>
                <button type="button" class="btn-dismiss" wire:click="$set('showReminder', false)">
                    Dismiss
                </button>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        /* Fullscreen overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9998;
        }

        /* Reminder Pop-up */
        .reminder-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            z-index: 9999;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .popup-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .icon-wrapper {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #6c63ff, #896cff);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 15px rgba(108, 99, 255, 0.4);
        }

        .icon-wrapper i {
            font-size: 1.5rem;
            color: #fff;
        }

        .title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .message {
            font-size: 0.95rem;
            color: #555;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn-submit {
    background: linear-gradient(135deg, #6c63ff, #896cff);
    color: white; /* Ensure text color is white */
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #896cff, #6c63ff);
    box-shadow: 0 4px 12px rgba(108, 99, 255, 0.4);
    color: white; /* Keep the text color white on hover */
}


        .btn-dismiss {
            background: #ddd;
            color: #333;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-dismiss:hover {
            background: #ccc;
            color: #000;
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
    @endif
</div>
