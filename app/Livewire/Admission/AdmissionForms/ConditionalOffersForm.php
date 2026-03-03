<?php

namespace App\Livewire\Admission\AdmissionForms;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use App\Models\AdmissionForm;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ConditionalOffersForm extends Component
{
    use WithFileUploads;

    public $inquiryId;
    public $partner_info = false;
    public $application_portal_info = false;
    public $student_gmail_info = false;
    public $conditional_marked_read = false;
    public $referrer;
    public $conditional_document;
    public $admissionForm;
    public $hasExistingConditionalDocument = false;

    public function mount($inquiry_id)
    {
        $this->inquiryId = $inquiry_id;
        $this->referrer = url()->previous();
        
        // Check if form already exists
        $this->admissionForm = AdmissionForm::where('registered_inquiry_id', $this->inquiryId)->first();
        
        if ($this->admissionForm) {
            $this->partner_info = (bool)$this->admissionForm->partner_info;
            $this->application_portal_info = (bool)$this->admissionForm->application_portal_info;
            $this->student_gmail_info = (bool)$this->admissionForm->student_gmail_info;
            $this->conditional_marked_read = (bool)$this->admissionForm->conditional_marked_read;
            $this->hasExistingConditionalDocument = !empty($this->admissionForm->conditional_document);
        }
    }

    public function submitForm()
    {
          // Custom validation messages
    $messages = [
        'conditional_document.required' => 'The conditional document is required.',
        'conditional_document.mimes' => 'The conditional document must be a PDF file.',
        'conditional_document.max' => 'The conditional document may not be larger than 5MB.',
    ];
        // Plain validation - all must be true
        if (!$this->partner_info || !$this->application_portal_info || !$this->student_gmail_info) {
            session()->flash('error', 'Please confirm all the options before submitting.');
            return;
        }

        // Validate file if it's being uploaded
        if ($this->conditional_document) {
            $this->validate([
                'conditional_document' => 'required|file|mimes:pdf|max:5120',
            ]);
        }

        // Update the inquiry status to 'conditional'
        $inquiry = RegisteredInquiry::findOrFail($this->inquiryId);
        $inquiry->update(['inquiry_status' => 'conditional']);

        // Prepare data for update or create
        $formData = [
            'user_id' => Auth::id(),
            'inquiry_id' => $inquiry->inquiry_id,
            'partner_info' => 'confirmed',
            'application_portal_info' => 'confirmed',
            'student_gmail_info' => 'confirmed',
            'conditional_marked_read' => true,
        ];

        // Handle file upload if present
        if ($this->conditional_document) {
            // Delete existing file if any
            if ($this->admissionForm && $this->admissionForm->conditional_document) {
                Storage::delete($this->admissionForm->conditional_document);
            }
            
            $filePath = $this->conditional_document->store('admission-docs');
            $formData['conditional_document'] = $filePath;
        }

        // Save form data
        AdmissionForm::updateOrCreate(
            ['registered_inquiry_id' => $this->inquiryId],
            $formData
        );

        session()->flash('message', 'Conditional offer form submitted successfully!');
        return redirect()->to($this->referrer);
    }

    public function render()
    {
        return view('livewire.admission.admission-forms.conditional-offers-form')->layout('layouts.admissiondashboard');
    }
}