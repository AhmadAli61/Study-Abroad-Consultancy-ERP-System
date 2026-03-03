<?php

namespace App\Livewire\Admission\AdmissionTeam\Modals;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use App\Models\Intake;
use Illuminate\Support\Facades\DB;

class AssignIntake extends Component
{
    public $show = false;
    public $inquiryId = null;
    public $selectedIntakeId = null;
    public $intakes = [];
    public $inquiryData = null;

    protected $listeners = [
        'openAssignIntakeModal' => 'openModal',
        'refreshIntakes' => 'loadIntakes'
    ];

    public function mount()
    {
        $this->loadIntakes();
    }

    public function loadIntakes()
    {
        $this->intakes = Intake::active()
            ->withCount(['inquiries' => function($query) {
                $query->where('inquiry_status', 'enrollment');
            }])
            ->orderBy('year', 'desc')
            ->orderBy('name')
            ->get();
    }

    public function openModal($inquiryId)
    {
        $this->inquiryId = $inquiryId;
        $this->selectedIntakeId = null;
        $this->show = true;
        
        // Load inquiry data
        $this->loadInquiryData();
    }

    public function loadInquiryData()
    {
        if ($this->inquiryId) {
            $inquiry = RegisteredInquiry::find($this->inquiryId);
            if ($inquiry) {
                $this->inquiryData = [
                    'student_name' => $inquiry->student_name,
                    'passport_number' => $inquiry->passport_number,
                    'university_name' => $inquiry->university_name,
                ];
            } else {
                $this->inquiryData = null;
            }
        }
    }

    public function closeModal()
    {
        $this->show = false;
        $this->inquiryId = null;
        $this->selectedIntakeId = null;
        $this->inquiryData = null;
    }

    public function saveAssignment()
    {
        // Save to database
        DB::table('registered_inquiries')
            ->where('id', $this->inquiryId)
            ->update([
                'intake_id' => $this->selectedIntakeId,
                'added_to_intake_at' => now(),
                'updated_at' => now(),
            ]);

        // Add note
        $inquiry = RegisteredInquiry::find($this->inquiryId);
        $intake = Intake::find($this->selectedIntakeId);
        
        if ($inquiry && $intake) {
            $note = auth()->user()->username . ': Assigned to intake ' . $intake->display_name;
            $this->addNoteToHistory($inquiry, $note);
        }

        // Close modal
        $this->closeModal();

        // Reload the page - simplest solution
        $this->js('window.location.reload();');
    }

    protected function addNoteToHistory($inquiry, $note)
    {
        $notesHistory = $inquiry->notes_history ?? [];
        
        if (is_string($notesHistory)) {
            $decodedHistory = json_decode($notesHistory, true);
            $notesHistory = (json_last_error() === JSON_ERROR_NONE && is_array($decodedHistory)) 
                ? $decodedHistory 
                : [];
        }
        
        if (!is_array($notesHistory)) {
            $notesHistory = [];
        }

        $notesHistory[] = [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->username,
            'note' => $note,
            'timestamp' => now()->toISOString(),
        ];

        $inquiry->update([
            'notes_history' => $notesHistory,
            'notes' => $note,
        ]);
    }

    public function render()
    {
        return view('livewire.admission.admission-team.modals.assign-intake');
    }
}