<?php

namespace App\Livewire\AdmissionAgent\AdmissionForms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AdmissionForm;
use App\Models\RegisteredInquiry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProcessedForm extends Component
{
    use WithFileUploads;

    public $sopFile;
    public $applicationScreenshot;
    public $admissionForm;
    public $isEditMode = false;
    public $hasExistingSop = false;
    public $hasExistingScreenshot = false;
    public $registeredInquiry;
    public $applicationPortalLogins;

    public $inquiryId;
    public $referrer;

    protected $rules = [
        'sopFile' => 'nullable|file|mimes:pdf|max:5120',
        'applicationScreenshot' => 'nullable|file|mimes:pdf|max:5120',
        'applicationPortalLogins' => 'nullable|string|max:255', // Changed from required to nullable
    ];

    // Update custom validation messages
    protected $messages = [
        'applicationPortalLogins.regex' => 'The application portal logins must be in the format: username_or_email/password',
    ];

    public function mount($inquiry_id = null)
    {
        $this->referrer = url()->previous();
        $user = Auth::user();

        $this->registeredInquiry = RegisteredInquiry::find($inquiry_id);

        if (!$this->registeredInquiry) {
            $this->registeredInquiry = RegisteredInquiry::where('users_id', $user->id)
                ->orWhere('assigned_to', $user->id)
                ->latest()
                ->first();
        }

        if (!$this->registeredInquiry) {
            session()->flash('error', 'No registered inquiry found for your account');
            return;
        }

        $this->admissionForm = AdmissionForm::where('registered_inquiry_id', $this->registeredInquiry->id)->first();
        
        if ($this->admissionForm) {
            $this->isEditMode = true;
            $this->hasExistingSop = !empty($this->admissionForm->sop_path);
            $this->hasExistingScreenshot = !empty($this->admissionForm->application_submission);
            $this->applicationPortalLogins = $this->admissionForm->application_portal_logins;
        }
    }

    public function saveDocuments()
    {
        // Validate only if files are present
        $this->validate();

        // Custom validation for application portal logins format (only if provided)
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

        // Validate that at least one file is uploaded or portal logins are provided
        if (!$this->sopFile && !$this->applicationScreenshot && 
            !$this->hasExistingSop && !$this->hasExistingScreenshot &&
            empty($this->applicationPortalLogins)) {
            session()->flash('error', 'Please upload at least one document or provide application portal logins');
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

        // Add application portal logins to update data
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
        return view('livewire.admission-agent.admission-forms.processed-form')
            ->layout('layouts.admissionagentdashboard');
    }
}