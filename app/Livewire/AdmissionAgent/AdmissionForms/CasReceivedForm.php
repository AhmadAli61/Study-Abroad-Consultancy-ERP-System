<?php

namespace App\Livewire\AdmissionAgent\AdmissionForms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AdmissionForm;
use App\Models\RegisteredInquiry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CasReceivedForm extends Component
{
    use WithFileUploads;

    public $casDocument;
    public $admissionForm;
    public $registeredInquiry;
    public $interviewPass; // Add this
    public $inquiryId;
    public $referrer;
    public $existingCasDocument;
    public $showInterviewPass = false; // Add this
    public $existingInterviewPass; // Add this
    public $hasExistingCas = false;

    protected $rules = [
        'casDocument' => 'required|file|mimes:pdf,doc,docx|max:5120',
        'interviewPass' => 'sometimes|required|file|mimes:pdf|max:5120', // Add this
    ];

    protected $messages = [
        'casDocument.required' => 'The CAS document is required to proceed.',
        'casDocument.mimes' => 'Only PDF, DOC, and DOCX files are allowed.',
        'casDocument.max' => 'The file size must not exceed 5MB.',
        'interviewPass.required' => 'The interview confirmation document is required.', // Add this
        'interviewPass.mimes' => 'Only PDF files are allowed for interview confirmation.', // Add this
        'interviewPass.max' => 'The interview confirmation file size must not exceed 5MB.', // Add this
    ];

    public function mount($inquiry_id = null)
    {
        $this->referrer = url()->previous();
        $user = Auth::user();

        $this->registeredInquiry = RegisteredInquiry::find($inquiry_id) ?? 
            RegisteredInquiry::where('users_id', $user->id)
                ->orWhere('assigned_to', $user->id)
                ->latest()
                ->first();

        if (!$this->registeredInquiry) {
            session()->flash('error', 'No registered inquiry found for your account');
            return redirect()->to($this->referrer);
        }

        // Always get or create the admission form record
        $this->admissionForm = AdmissionForm::firstOrCreate(
            ['registered_inquiry_id' => $this->registeredInquiry->id],
            [
                'user_id' => $user->id,
                'inquiry_id' => $this->registeredInquiry->inquiry_id
            ]
        );

        // Check if interview pass exists and needs to be shown
        if (!$this->admissionForm->interview_pass_path) {
            $this->showInterviewPass = true;
        } else {
            $this->existingInterviewPass = $this->admissionForm->interview_pass_path;
        }

        if ($this->admissionForm->cas_document_path) {
            $this->existingCasDocument = $this->admissionForm->cas_document_path;
            $this->hasExistingCas = true;
            session()->flash('message', 'CAS document already exists for this inquiry.');
            return redirect()->to($this->referrer);
        }
    }

    public function saveCasDocument()
    {
        $validationRules = ['casDocument' => 'required|file|mimes:pdf|max:5120'];
        if ($this->showInterviewPass && !$this->existingInterviewPass) {
            $validationRules['interviewPass'] = 'required|file|mimes:pdf|max:5120';
        }
        $this->validate($validationRules);

        $casPath = $this->casDocument->store('admission-docs');
         // Store interview pass if needed
        $interviewPassPath = null;
        if ($this->interviewPass) {
            $interviewPassPath = $this->interviewPass->store('admission-docs');
        }
                $updateData = ['cas_document_path' => $casPath];
          if ($interviewPassPath) {
            $updateData['interview_pass_path'] = $interviewPassPath;
        }
                $this->admissionForm->update($updateData);

        $this->existingCasDocument = $casPath;
        $this->hasExistingCas = true;
         $this->registeredInquiry->update(['inquiry_status' => 'casreceived']);

        
        session()->flash('message', 'CAS document uploaded successfully!');
        return redirect()->to($this->referrer);
    }
   
    public function render()
    {
        return view('livewire.admission-agent.admission-forms.cas-received-form')
            ->layout('layouts.admissionagentdashboard');
    }
}