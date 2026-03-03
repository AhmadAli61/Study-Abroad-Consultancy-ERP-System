<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RemindersChecker extends Component
{
    public function render()
    {
        $now = Carbon::now();
        \Log::info('Polling at: ' . now());
    
        $reminders = Reminder::where('user_id', Auth::id())
            ->where('is_active', true)
            ->where('reminder_shown', false)
            ->where('reminder_time', '<=', $now)
            ->orderBy('reminder_time', 'asc')
            ->get();
    
        \Log::info('Reminders found: ' . $reminders->count());
    
        // Show all pending reminders at once (like in counsellor portal)
        if ($reminders->count() > 0) {
            $reminderData = [];
            
            foreach ($reminders as $reminder) {
                $reminderData[] = [
                    'time' => Carbon::parse($reminder->reminder_time)->format('Y-m-d h:i A'),
                    'reason' => $reminder->reminder_reason
                ];
                
                // Mark as shown after adding to the list
                $reminder->update(['reminder_shown' => true]);
            }
            
            // Dispatch all reminders at once
            $this->dispatch('showMultipleReminders', reminders: $reminderData);
        }
    
        return view('livewire.manager.reminders-checker')->layout('layouts.managerdashboard');
    }
}