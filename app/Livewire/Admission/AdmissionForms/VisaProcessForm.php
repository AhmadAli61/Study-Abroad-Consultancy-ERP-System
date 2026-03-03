<?php

namespace App\Livewire\Admission\AdmissionForms;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use App\Models\AdmissionForm;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this import


class VisaProcessForm extends Component
{
    use WithFileUploads;

    public $inquiry_id;
    public $registered_inquiry;
    public $cnic_document;
    public $bank_statement;
    public $visa_history;
    // Add the new fields
    public $visa_application;
    public $appointment_letter;
        public $enrollment_logins; // Add this property
    public $existing_enrollment_logins; // Add this property
        public $existing_visa_application_links;
    public $visa_application_links;


    
    // Add these properties to your component class
    public $existing_cnic_document;
    public $existing_bank_statement;
    public $existing_visa_history;
    
    // Add existing fields for the new documents
    public $existing_visa_application;
    public $existing_appointment_letter;
    public $referrer; // To track the referring page

    public function mount($inquiry_id = null)
    {
        $this->inquiry_id = $inquiry_id;
        $this->referrer = url()->previous();
        
        if ($this->inquiry_id) {
            $this->registered_inquiry = RegisteredInquiry::findOrFail($this->inquiry_id);
            
            // Check if form already exists
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $this->inquiry_id)
                ->whereNotNull('cnic_path')
                ->first();
            
            if ($admissionForm) {
                $this->existing_cnic_document = $admissionForm->cnic_path;
                $this->existing_bank_statement = $admissionForm->new_bank_statement_path;
                $this->existing_visa_history = $admissionForm->visa_history_path;
                // Add the new existing fields
                $this->existing_visa_application = $admissionForm->visa_application_path;
                $this->existing_appointment_letter = $admissionForm->appointment_letter_path;
                      $this->existing_enrollment_logins = $admissionForm->enrollment_logins; // Add this line
                $this->enrollment_logins = $admissionForm->enrollment_logins; // Add this line
                                $this->visa_application_links = $admissionForm->visa_application_links;
                $this->existing_visa_application_links = $admissionForm->visa_application_links;

            }
        }
    }

    public function submitVisaDocuments()
    {
      $validator = Validator::make(
            ['enrollment_logins' => $this->enrollment_logins],
            ['enrollment_logins' => 'nullable|regex:/^[^\/]+\/[^\/]+$/']
        );

        if ($validator->fails()) {
            $this->addError('enrollment_logins', 'The enrollment login must be in the format: username_or_email/password');
            return;
        }
        
        // Add validation for visa_application_links (optional but must follow format if provided)
        if (!empty($this->visa_application_links)) {
            $lines = explode("\n", $this->visa_application_links);
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    // Check if the line contains a comma and has content on both sides
                    if (strpos($line, ',') === false) {
                        $this->addError('visa_application_links', 'Each visa application link must be in the format: URL,password');
                        return;
                    }
                    
                    $parts = explode(',', $line, 2);
                    if (empty($parts[0]) || empty($parts[1])) {
                        $this->addError('visa_application_links', 'Each entry must include both a URL and password separated by a comma');
                        return;
                    }
                    
                    // Validate URL format
                    if (!filter_var(trim($parts[0]), FILTER_VALIDATE_URL)) {
                        $this->addError('visa_application_links', 'Invalid URL format: ' . trim($parts[0]));
                        return;
                    }
                }
            }
        }
        $this->validate([
            'cnic_document' => 'required|file|mimes:pdf|max:5120',
            'bank_statement' => 'required|file|mimes:pdf|max:5120',
            'visa_history' => 'required|file|mimes:pdf|max:5120',
            // Add validation for new fields
            'visa_application' => 'required|file|mimes:pdf|max:5120',
            'appointment_letter' => 'required|file|mimes:pdf|max:5120',
        ], [
            'cnic_document.mimes' => 'The CNIC document must be a PDF file.',
            'bank_statement.mimes' => 'The bank statement must be a PDF file.',
            'visa_history.mimes' => 'The visa history must be a PDF file.',
            // Add error messages for new fields
            'visa_application.mimes' => 'The visa application must be a PDF file.',
            'appointment_letter.mimes' => 'The appointment letter must be a PDF file.',
            
        ]);

        // Store required files
        $cnicPath = $this->cnic_document->store('admission-docs');
        $bankStatementPath = $this->bank_statement->store('admission-docs');
        $visaHistoryPath = $this->visa_history->store('admission-docs');
        // Store new files
        $visaApplicationPath = $this->visa_application->store('admission-docs');
        $appointmentLetterPath = $this->appointment_letter->store('admission-docs');
        
        // Update or create admission form
        AdmissionForm::updateOrCreate(
            ['registered_inquiry_id' => $this->inquiry_id],
            [
                'user_id' => Auth::id(),
                'inquiry_id' => $this->registered_inquiry->inquiry_id,
                'cnic_path' => $cnicPath,
                'new_bank_statement_path' => $bankStatementPath,
                'visa_history_path' => $visaHistoryPath,
                // Add the new fields
                'visa_application_path' => $visaApplicationPath,
                'appointment_letter_path' => $appointmentLetterPath,
                                'enrollment_logins' => $this->enrollment_logins, // Add this line
                                                'visa_application_links' => $this->visa_application_links,


            ]
        );

        // Update the inquiry status to visaprocess
        $this->registered_inquiry->update([
            'inquiry_status' => 'visaprocess'
        ]);

        session()->flash('message', 'Documents submitted successfully and status updated to Visa Process!');
        
        // Get the referring URL and add page=1 parameter
        $referrer = $this->referrer ?: route('admission.all-applications');
        $referrer = str_contains($referrer, '?') 
            ? preg_replace('/([?&])page=[^&]*(&|$)/', '$1', $referrer) . 'page=1'
            : $referrer . '?page=1';

        return redirect()->to($referrer);
    }

   
    public function render()
    {
        return view('livewire.admission.admission-forms.visa-process-form')->layout('layouts.admissiondashboard');
    }
}