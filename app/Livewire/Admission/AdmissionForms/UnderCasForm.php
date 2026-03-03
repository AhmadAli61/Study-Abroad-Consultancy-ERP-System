<?php

namespace App\Livewire\Admission\AdmissionForms;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use App\Models\AdmissionForm;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this import

class UnderCasForm extends Component
{
    use WithFileUploads;

    public $inquiry_id;
    public $registered_inquiry;
    public $fee_voucher;
    public $bank_statement;
    public $interview_pass;
    public $tb_test;
        public $cas_shield_logins;
    public $existing_cas_shield_logins;

        public $birth_certificate;
    public $parental_consent_letter;
    public $funds_source;
    
    public $existing_fee_voucher;
    public $existing_bank_statement;
    public $existing_interview_pass;
    public $existing_tb_test;
        public $existing_birth_certificate;
    public $existing_parental_consent_letter;
    public $existing_funds_source;
    public $referrer;

    public function mount($inquiry_id = null)
    {
        $this->inquiry_id = $inquiry_id;
        $this->referrer = url()->previous();
        
        if ($this->inquiry_id) {
            $this->registered_inquiry = RegisteredInquiry::findOrFail($this->inquiry_id);
            
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $this->inquiry_id)->first();
            
            if ($admissionForm) {
                $this->existing_fee_voucher = $admissionForm->fee_voucher_path;
                $this->existing_bank_statement = $admissionForm->bank_statement_path;
                $this->existing_interview_pass = $admissionForm->interview_pass_path;
                $this->existing_tb_test = $admissionForm->tb_test_path;
                $this->existing_birth_certificate = $admissionForm->birth_certificate;
                $this->existing_parental_consent_letter = $admissionForm->parental_consent_letter;
                $this->existing_funds_source = $admissionForm->funds_source;
                                $this->existing_cas_shield_logins = $admissionForm->cas_shield_logins;

                                $this->cas_shield_logins = $admissionForm->cas_shield_logins;

            }
        }
    }

    public function saveCasDocuments()
    {
             $validator = Validator::make(
            ['cas_shield_logins' => $this->cas_shield_logins],
            ['cas_shield_logins' => 'nullable|regex:/^[^\/]+\/[^\/]+$/']
        );

        if ($validator->fails()) {
            $this->addError('cas_shield_logins', 'The CAS sheild login must be in the format: username_or_email/password');
            return;
        }
        $this->validate([
            'fee_voucher' => 'required|file|mimes:pdf|max:5120',
            'bank_statement' => 'required|file|mimes:pdf|max:5120',
            'interview_pass' => 'nullable|file|mimes:pdf|max:5120',
            'tb_test' => 'required|file|mimes:pdf|max:5120',
            'birth_certificate' => 'nullable|file|mimes:pdf|max:5120',
            'parental_consent_letter' => 'nullable|file|mimes:pdf|max:5120',
            'funds_source' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        // Store files
        $feeVoucherPath = $this->fee_voucher->store('admission-docs');
        $bankStatementPath = $this->bank_statement->store('admission-docs');
        $tbTestPath = $this->tb_test->store('admission-docs');
                $birthCertificatePath = $this->birth_certificate ? $this->birth_certificate->store('admission-docs') : null;
        $parentalConsentPath = $this->parental_consent_letter ? $this->parental_consent_letter->store('admission-docs') : null;
        $fundsSourcePath = $this->funds_source ? $this->funds_source->store('admission-docs') : null;
        // Only store interview_pass if it exists
    $interviewPassPath = null;
    if ($this->interview_pass) {
        $interviewPassPath = $this->interview_pass->store('admission-docs');
    }

        // Update or create admission form
        AdmissionForm::updateOrCreate(
            ['registered_inquiry_id' => $this->inquiry_id],
            [
                'user_id' => Auth::id(),
                'inquiry_id' => $this->registered_inquiry->inquiry_id,
                'fee_voucher_path' => $feeVoucherPath,
                'bank_statement_path' => $bankStatementPath,
                'interview_pass_path' => $interviewPassPath,
                'tb_test_path' => $tbTestPath,
                'birth_certificate' => $birthCertificatePath,
                'parental_consent_letter' => $parentalConsentPath,
                'funds_source' => $fundsSourcePath,
                                'cas_shield_logins' => $this->cas_shield_logins,

            ]
        );

        // Update the inquiry status to undercas
        $this->registered_inquiry->update([
            'inquiry_status' => 'undercas'
        ]);

        session()->flash('message', 'CAS documents submitted successfully!');
        
        // Get the referring URL and add page=1 parameter
        $referrer = $this->referrer ?: route('admission.all-applications');
        $referrer = str_contains($referrer, '?') 
            ? preg_replace('/([?&])page=[^&]*(&|$)/', '$1', $referrer) . 'page=1'
            : $referrer . '?page=1';

        return redirect()->to($referrer);
    }

  

    public function render()
    {
        return view('livewire.admission.admission-forms.under-cas-form')->layout('layouts.admissiondashboard');
    }
}