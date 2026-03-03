<?php
namespace App\Livewire\Manager;

use Livewire\Component;
use App\Models\Reminder as ReminderModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Reminder extends Component
{
    public $reminder_date, $reminder_time_only, $reminder_reason;
    public $reminders = [];

    public function mount()
    {
        $this->fetchReminders();
    }
    
    public function fetchReminders()
    {
        $this->reminders = ReminderModel::where('user_id', Auth::id())->latest()->get();
    }

    public function saveReminder()
    {
        $this->validate([
            'reminder_date' => 'required|date|after_or_equal:today',
            'reminder_time_only' => 'required',
            'reminder_reason' => 'required|string',
        ]);

        // Combine date and time
        $reminder_time = Carbon::createFromFormat('Y-m-d H:i', $this->reminder_date . ' ' . $this->reminder_time_only);
        
        // Validate that the combined datetime is in the future
        if ($reminder_time->lte(now())) {
            session()->flash('error', 'Reminder time must be in the future.');
            return;
        }

        ReminderModel::create([
            'user_id' => Auth::id(),
            'reminder_time' => $reminder_time,
            'reminder_reason' => $this->reminder_reason,
        ]);

        $this->reset(['reminder_date', 'reminder_time_only', 'reminder_reason']);
        $this->fetchReminders();
        session()->flash('success', 'Reminder saved!');
        return redirect()->route('manager.inquiry.reminder');
    }

    public function toggleStatus($id)
    {
        $reminder = ReminderModel::find($id);
        if ($reminder && $reminder->user_id == Auth::id()) {
            $reminder->is_active = !$reminder->is_active;
            $reminder->save();
            $this->fetchReminders();
        }
    }

    public function deleteReminder($id)
    {
        $reminder = ReminderModel::find($id);
        if ($reminder && $reminder->user_id == Auth::id()) {
            $reminder->delete();
            $this->fetchReminders();
        }
    }
    
    public function render()
    {
        return view('livewire.manager.reminder')->layout('layouts.managerdashboard');
    }
}