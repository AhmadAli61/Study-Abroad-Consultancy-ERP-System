<?php

namespace App\Livewire\Agent\Modal;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Editadmissioninquiry extends Component
{
    public $inquiryId, $registered_inquiry_id, $notes, $notes_history;
    public $currentPage = 1;
    public $showModal = false;
        public $referrer; // Add this property to track the referring page


    public function mount() {
        $this->currentPage = request()->get('page', 1);
    }

    #[On('editAdmissionInquiry')]
    public function editAdmissionInquiry($id, $referrer = null)
    {
        $inquiry = RegisteredInquiry::findOrFail($id);
        $this->inquiryId = $inquiry->inquiry_id;
        $this->registered_inquiry_id = $inquiry->id;
        $this->notes = '';
        $this->notes_history = $inquiry->notes_history;
        $this->referrer = $referrer ?? url()->previous(); // Store the referring page
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'notes' => 'required|string',
        ]);

        $inquiry = RegisteredInquiry::findOrFail($this->registered_inquiry_id);
        $user = Auth::user();
        
        // Prepare the new note entry with username prefix
        $newNote = [
            'user_name' => $user->username,
            'note' => $user->username . ': ' . $this->notes,
            'timestamp' => now()->toDateTimeString()
        ];
        
        // Get existing notes history
        $existingHistory = $inquiry->notes_history ? json_decode($inquiry->notes_history, true) : [];
        
        // Add new note to history
        $existingHistory[] = $newNote;
        
        // Update the inquiry
        $inquiry->update([
            'notes_history' => json_encode($existingHistory),
            'updated_at' => now()
        ]);

        session()->flash('message', 'Note added successfully.');
        $this->showModal = false;
        $this->notes = '';
        
                // Redirect back to the referring page or fallback
        return $this->referrer 
            ? redirect()->to($this->referrer)
            : redirect()->route('agent.admission-dashboard');

    }

    public function render()
    {
        return view('livewire.agent.modal.editadmissioninquiry');
    }
}