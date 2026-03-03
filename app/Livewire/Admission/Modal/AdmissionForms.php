<?php

namespace App\Livewire\Admission\Modal;

use App\Models\RegisteredInquiry;
use Livewire\Component;
use App\Models\AdmissionForm;
use Livewire\WithFileUploads;

class AdmissionForms extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $inquiryId;
    public $registeredInquiryId;
    public $currentStatus;
    public $newStatus;
    
    // Fields for different status transitions
    public $sop_file;
    public $partner_checked = false;
    public $application_portal_checked = false;
    public $student_gmail_checked = false;
    public $fee_voucher_file;
    public $bank_statement_file;
    public $interview_pass_file;
    public $tb_test_file;
    public $fee_payment_file;
    public $extra_undercas_file;
    public $cas_document_file;
    public $visa_history_file;
    public $visa_application_file;
    public $appointment_letter_file;
    public $decision_letter_file;
    public $e_visa_file;
    public $student_id_card_file;
    public $confirmation_message = '';

    protected $rules = [
        'sop_file' => 'nullable|file|mimes:pdf|max:5120',
        'partner_checked' => 'nullable|boolean',
        'application_portal_checked' => 'nullable|boolean',
        'student_gmail_checked' => 'nullable|boolean',
        'fee_voucher_file' => 'nullable|file|mimes:pdf|max:5120',
        'bank_statement_file' => 'nullable|file|mimes:pdf|max:5120',
        'interview_pass_file' => 'nullable|file|mimes:pdf|max:5120',
        'tb_test_file' => 'nullable|file|mimes:pdf|max:5120',
        'fee_payment_file' => 'nullable|file|mimes:pdf|max:5120',
        'extra_undercas_file' => 'nullable|file|mimes:pdf|max:5120',
        'cas_document_file' => 'nullable|file|mimes:pdf|max:5120',
        'visa_history_file' => 'nullable|file|mimes:pdf|max:5120',
        'visa_application_file' => 'nullable|file|mimes:pdf|max:5120',
        'appointment_letter_file' => 'nullable|file|mimes:pdf|max:5120',
        'decision_letter_file' => 'nullable|file|mimes:pdf|max:5120',
        'e_visa_file' => 'nullable|file|mimes:pdf|max:5120',
        'student_id_card_file' => 'nullable|file|mimes:pdf|max:5120',
    ];

    #[On('showAdmissionFormModal')]
    public function showModal($inquiryId, $registeredInquiryId, $currentStatus, $newStatus)
    {
        $this->inquiryId = $inquiryId;
        $this->registeredInquiryId = $registeredInquiryId;
        $this->currentStatus = $currentStatus;
        $this->newStatus = $newStatus;
        
        // Check if we need to show the modal (e.g., for SOP upload if it's null)
        $shouldShowModal = true;
        
        if ($newStatus === 'processed') {
            $existingForm = AdmissionForm::where('registered_inquiry_id', $registeredInquiryId)->first();
            if ($existingForm && $existingForm->sop_path) {
                $shouldShowModal = false;
            }
        }
        
        if ($shouldShowModal) {
            $this->showModal = true;
        } else {
            // If no modal needed, just update the status
            $this->dispatch('updateStatusDirectly', $registeredInquiryId, $newStatus);
        }
    }

    public function closeModal()
    {
        $this->reset();
        $this->showModal = false;
    }

    public function submitForm()
    {
        $this->validate();
        
        $data = [
            'user_id' => auth()->id(),
            'inquiry_id' => $this->inquiryId,
            'registered_inquiry_id' => $this->registeredInquiryId,
        ];

        // Handle file uploads and data based on status transition
        switch ($this->currentStatus . '_to_' . $this->newStatus) {
            case 'underassessment_to_processed':
                $data['sop_path'] = $this->sop_file->store('admission-forms');
                break;
                
            case 'processed_to_conditional':
                $data['partner_info'] = $this->partner_checked ? 'Completed' : null;
                $data['application_portal_info'] = $this->application_portal_checked ? 'Completed' : null;
                $data['student_gmail_info'] = $this->student_gmail_checked ? 'Completed' : null;
                $data['conditional_marked_read'] = true;
                break;
                
            case 'conditional_to_unconditional':
                $data['fee_voucher_path'] = $this->fee_voucher_file->store('admission-forms');
                $data['bank_statement_path'] = $this->bank_statement_file->store('admission-forms');
                $data['interview_pass_path'] = $this->interview_pass_file->store('admission-forms');
                $data['tb_test_path'] = $this->tb_test_file->store('admission-forms');
                break;
                
            case 'unconditional_to_undercas':
                $data['fee_payment_path'] = $this->fee_payment_file->store('admission-forms');
                $data['extra_undercas_path'] = $this->extra_undercas_file ? $this->extra_undercas_file->store('admission-forms') : null;
                break;
                
            case 'undercas_to_casreceived':
                $data['cas_document_path'] = $this->cas_document_file->store('admission-forms');
                $data['visa_history_path'] = $this->visa_history_file->store('admission-forms');
                break;
                
            case 'visaprocess_to_enrollment':
                $data['visa_application_path'] = $this->visa_application_file->store('admission-forms');
                $data['appointment_letter_path'] = $this->appointment_letter_file->store('admission-forms');
                $data['decision_letter_path'] = $this->decision_letter_file->store('admission-forms');
                $data['e_visa_path'] = $this->e_visa_file->store('admission-forms');
                $data['student_id_card_path'] = $this->student_id_card_file->store('admission-forms');
                break;
        }

        // Update or create admission form
        AdmissionForm::updateOrCreate(
            ['registered_inquiry_id' => $this->registeredInquiryId],
            $data
        );

        // Update the inquiry status
        $this->dispatch('updateStatus', $this->registeredInquiryId, $this->newStatus);
        
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admission.modal.admission-forms');
    }
}