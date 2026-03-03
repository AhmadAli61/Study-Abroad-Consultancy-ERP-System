<?php

namespace App\Livewire\Admission\AdmissionForms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AdmissionForm;
use App\Models\RegisteredInquiry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this import


class ProcessedForm extends Component
{
    use WithFileUploads;
        public $applicationScreenshot;


    public $sopFile;
    public $admissionForm;
    public $isEditMode = false;
    public $hasExistingSop = false;
        public $applicationPortalLogins;

    public $hasExistingScreenshot = false;

    public $registeredInquiry;
    public $inquiryId;
    public $referrer;
    

    protected $rules = [
        'sopFile' => 'required|file|mimes:pdf|max:5120', // PDF only
        'applicationScreenshot' => 'required|file|mimes:pdf|max:5120', // Image or PDF
                'applicationPortalLogins' => 'nullable|string|max:255',

    ];
      // Add custom validation messages
    protected $messages = [
        'applicationPortalLogins.regex' => 'The application portal logins must be in the format: username_or_email/password',
    ];

    public function mount($inquiry_id = null)
    {
        // Store the referring page URL
        $this->referrer = url()->previous();

        // Get current user
        $user = Auth::user();

        // Find the registered inquiry
        $this->registeredInquiry = RegisteredInquiry::find($inquiry_id);

        if (!$this->registeredInquiry) {
            // Fallback to the latest inquiry for the user if no ID provided
            $this->registeredInquiry = RegisteredInquiry::where('users_id', $user->id)
                ->orWhere('assigned_to', $user->id)
                ->latest()
                ->first();
        }

        if (!$this->registeredInquiry) {
            session()->flash('error', 'No registered inquiry found for your account');
            return;
        }

        // Check for existing admission form with SOP
        $this->admissionForm = AdmissionForm::where('registered_inquiry_id', $this->registeredInquiry->id)
            ->first();
        
         if ($this->admissionForm) {
            $this->isEditMode = true;
            $this->hasExistingSop = !empty($this->admissionForm->sop_path);
            $this->hasExistingScreenshot = !empty($this->admissionForm->application_submission);
            $this->applicationPortalLogins = $this->admissionForm->application_portal_logins;

        }
    }

 public function saveDocuments()
    {
        $this->validate();
         // Custom validation for application portal logins format (only if not empty)
        if (!empty($this->applicationPortalLogins)) {
            $validator = Validator::make(
                ['applicationPortalLogins' => $this->applicationPortalLogins],
                ['applicationPortalLogins' => 'regex:/^[^\/]+\/[^\/]+$/'],
                ['applicationPortalLogins.regex' => 'The application portal logins must be in the format: username_or_email/password']
            );

            if ($validator->fails()) {
                $this->addError('applicationPortalLogins', $validator->errors()->first('applicationPortalLogins'));
                return;
            }
        }

        // Validate that at least one file is uploaded
        if (!$this->sopFile && !$this->applicationScreenshot && 
            !$this->hasExistingSop && !$this->hasExistingScreenshot) {
            session()->flash('error', 'Please upload at least one document');
            return;
        }

        $updateData = [];

        // Handle SOP file upload
        if ($this->sopFile) {
            $sopPath = $this->sopFile->store('admission-docs');
            if ($this->isEditMode && $this->admissionForm->sop_path) {
                Storage::delete($this->admissionForm->sop_path);
            }
            $updateData['sop_path'] = $sopPath;
            $this->hasExistingSop = true;
        }

        // Handle Application Screenshot upload
        if ($this->applicationScreenshot) {
            $screenshotPath = $this->applicationScreenshot->store('admission-docs');
            if ($this->isEditMode && $this->admissionForm->application_submission) {
                Storage::delete($this->admissionForm->application_submission);
            }
            $updateData['application_submission'] = $screenshotPath;
            $this->hasExistingScreenshot = true;
        }
        $updateData['application_portal_logins'] = $this->applicationPortalLogins;

        // Update or create admission form
        if ($this->isEditMode) {
            $this->admissionForm->update(array_merge($updateData, [
                'inquiry_id' => $this->registeredInquiry->inquiry_id,
                'registered_inquiry_id' => $this->registeredInquiry->id,
            ]));
            $message = 'Documents updated successfully!';
        } else {
            $this->admissionForm = AdmissionForm::create(array_merge($updateData, [
                'user_id' => Auth::id(),
                'inquiry_id' => $this->registeredInquiry->inquiry_id,
                'registered_inquiry_id' => $this->registeredInquiry->id,
            ]));
            $this->isEditMode = true;
            $message = 'Documents uploaded successfully!';
        }

        $this->reset(['sopFile', 'applicationScreenshot']);
        $this->registeredInquiry->update(['inquiry_status' => 'processed']);
        session()->flash('message', $message);
        
        return redirect()->to($this->referrer);
    }
   
    public function render()
    {
        return view('livewire.admission.admission-forms.processed-form')->layout('layouts.admissiondashboard');
    }
}