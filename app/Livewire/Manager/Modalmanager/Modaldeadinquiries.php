<?php

namespace App\Livewire\Manager\Modalmanager;

use Livewire\Component;
use App\Models\Inquiiry;
use Livewire\Attributes\On;

class Modaldeadinquiries extends Component
{
    public $inquiryId, $name, $email, $type, $phone_number, $phone_number2, $response, $study_course, $country, $budget, $plan, $extra, $inquiry_status;
    public $currentPage = 1;
    public $showModal = false;
    public $newResponse = ''; // Add this new property for fresh responses

    public function mount() {
        $this->currentPage = request()->get('page', 1);  // Get the page from the URL, default to 1
        $this->showModal = false;
    }
    
    #[On('editInquiry')]
    public function editInquiry($id)
    {
        \Log::info('Editing inquiry ID: ' . $id);

        $inquiry = Inquiiry::findOrFail($id);
        $this->inquiryId = $inquiry->id;
        $this->name = $inquiry->name;
        $this->email = $inquiry->email;
        $this->type = $inquiry->type;
        $this->phone_number = $inquiry->phone_number;
        $this->phone_number2 = $inquiry->phone_number2;
        $this->response = $inquiry->response; // Keep existing response for reference
        $this->study_course = $inquiry->study_course;
        $this->country = $inquiry->country;
        $this->budget = $inquiry->budget;
        $this->plan = $inquiry->plan;
        $this->extra = $inquiry->extra;
        $this->inquiry_status = $inquiry->inquiry_status;
        
        // Reset new response field to empty for fresh input
        $this->newResponse = '';

        $this->showModal = true;
    }
    
    public function update()
    {
        $this->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'type' => 'required|in:Referral,Meta Leads W,Google Leads',
            'phone_number' => 'required',
            'phone_number2' => 'nullable',
            'newResponse' => 'nullable', // Validate the new response field
            'study_course' => 'nullable',
            'country' => 'nullable',
            'budget' => 'nullable',
            'plan' => 'nullable',
            'extra' => 'nullable',
            'inquiry_status' => 'nullable',
        ]);

        \Log::info('Updating inquiry ID: ' . $this->inquiryId);

        // Get the inquiry first to access current response
        $inquiry = Inquiiry::find($this->inquiryId);
        
        if ($inquiry) {
            // Get the next follow-up number
            $nextFollowUpNumber = $this->getNextFollowUpNumber($inquiry->response);
            
            // Combine existing response with new response (if new response exists)
            $updatedResponse = $inquiry->response; // Use the original response from database
            if (!empty(trim($this->newResponse))) {
                $timestamp = now()->format('M j, Y g:i A');
                $followUpLabel = "F{$nextFollowUpNumber}";
                $newEntry = "\n\n--- {$followUpLabel} | {$timestamp} ---\n" . trim($this->newResponse);
                
                if (empty(trim($updatedResponse))) {
                    $updatedResponse = "--- {$followUpLabel} | {$timestamp} ---\n" . trim($this->newResponse);
                } else {
                    $updatedResponse .= $newEntry;
                }
            }

            // Update using Eloquent
            $inquiry->update([
                'name' => $this->name,
                'email' => $this->email,
                'type' => $this->type,
                'phone_number' => $this->phone_number,
                'phone_number2' => $this->phone_number2,
                'response' => $updatedResponse, // Use the combined response
                'study_course' => $this->study_course,
                'country' => $this->country,
                'budget' => $this->budget,
                'plan' => $this->plan,
                'extra' => $this->extra,
                'inquiry_status' => $this->inquiry_status,
            ]);

            \Log::info('Inquiry status updated', [
                'previous_status' => $inquiry->previous_inquiry_status,
                'current_status' => $inquiry->inquiry_status,
                'updated_at' => $inquiry->inquiry_status_updated_at,
                'follow_up_number' => $nextFollowUpNumber
            ]);
        }

        session()->flash('message', 'Inquiry updated successfully!');
        $this->showModal = false;

        return redirect()->route('manager.inquiry.dead', [
            'page' => $this->currentPage, 
        ]);
    }

    /**
     * Calculate the next follow-up number based on existing responses
     */
    private function getNextFollowUpNumber($existingResponse)
    {
        if (empty(trim($existingResponse))) {
            return 1; // First follow-up
        }

        // Count existing follow-ups by looking for F1, F2, F3 patterns
        preg_match_all('/F(\d+)/', $existingResponse, $matches);
        
        if (!empty($matches[1])) {
            // Get the highest existing follow-up number and increment it
            $existingNumbers = array_map('intval', $matches[1]);
            return max($existingNumbers) + 1;
        }

        // If no F patterns found but there's content, assume it's F1 and this will be F2
        return 2;
    }

    public function render()
    {
        return view('livewire.manager.modalmanager.modaldeadinquiries');
    }
}