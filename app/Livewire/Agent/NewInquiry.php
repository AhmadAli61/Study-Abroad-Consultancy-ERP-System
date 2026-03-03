<?php

namespace App\Livewire\Agent;

use Livewire\Component;
use App\Models\Inquiiry;
use Illuminate\Support\Facades\Auth;

class NewInquiry extends Component
{
    public $name, $email, $type, $phone_number, $phone_number2;
    public $newResponse, $study_course, $country, $budget, $plan, $extra; // Changed from response to newResponse

    public function saveInquiry()
    {
        // Basic validation with strict phone number format
        $this->validate([
            'name' => 'required',
            'phone_number' => ['required', 'regex:/^92[0-9]{10}$/'],
            'type' => 'required|in:Referral,Meta Leads W,Google Leads',
            'newResponse' => 'nullable', // Validate the new response field
        ], [
            'phone_number.regex' => 'Phone number must start with 92 and be exactly 12 digits (e.g., 923001234567).',
        ]);

        // Remove all non-digit characters (just in case)
        $cleanedPhone = preg_replace('/\D+/', '', $this->phone_number);

        // Final fail-safe to make sure the number starts with 92 and is 12 digits
        if (!preg_match('/^92[0-9]{10}$/', $cleanedPhone)) {
            $this->addError('phone_number', 'Invalid format. Must be 92 followed by 10 digits.');
            return;
        }

        // Check for duplicates (ignoring spaces or formatting)
        $exists = Inquiiry::whereRaw("REPLACE(phone_number, ' ', '') = ?", [$cleanedPhone])->exists();

        if ($exists) {
            $this->addError('phone_number', 'This phone number already exists.');
            return;
        }

        // Format the response with F1 and timestamp if remarks are provided
        $formattedResponse = '';
        if (!empty(trim($this->newResponse))) {
            $timestamp = now()->format('M j, Y g:i A');
            $formattedResponse = "--- F1 | {$timestamp} ---\n" . trim($this->newResponse);
        }

        // Save inquiry
        Inquiiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'phone_number' => $cleanedPhone,
            'phone_number2' => $this->phone_number2,
            'response' => $formattedResponse, // Use the formatted response
            'study_course' => $this->study_course,
            'country' => $this->country,
            'budget' => $this->budget,
            'plan' => $this->plan,
            'extra' => $this->extra,
            'assigned_to' => Auth::id(),
            'status' => 'assigned',
            'assigned_at' => now(),
            'inquiry_status' => 'pending', // Set default inquiry status
        ]);

        session()->flash('success', 'Inquiry added successfully!');
        
        $this->reset([
            'name', 'email', 'type', 'phone_number', 'phone_number2',
            'newResponse', 'study_course', 'country', 'budget', 'plan', 'extra'
        ]);
    }

    public function render()
    {
        return view('livewire.agent.new-inquiry')
            ->layout('layouts.agentdashboard');
    }
}