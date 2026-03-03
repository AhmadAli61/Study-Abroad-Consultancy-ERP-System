<?php

namespace App\Livewire\AdmissionAgent\Modals;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use App\Models\AdmissionForm;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
class AdmissionInquiryOverview extends Component
{
     public $showModal = false;
    public $inquiryId, $student_name, $student_contact, $emergency_contact_1, $emergency_contact_2, 
           $passport_number, $course_name, $course_intake, $course_link, $gmail_password, 
           $university_name, $inquiry_status, $notes, $created_at, $updated_at, $matric_dmc_path, 
           $intermediate_dmc_path, $bs_hons_path, $ba_bsc_path, $ma_msc_path, $reference_letters_path, 
           $has_refusal_letter, $cv_file_path, $passport_pages_path, $experience_letter_path, 
           $english_test_path, $agent_consent_path, $student_consent_path, $additional_docs_path, 
           $extra_path, $extra2_path, $extra3_path, $extra4_path, $extra5_path, $extra6_path, 
           $extra7_path, $extra8_path, $extra9_path, $extra10_path, $extra11_path, $refusal_letter_path, 
           $notes_history, $assigned_at, $assigned_to, $status, $status_updated_at, $previous_assigned_to, $funds_source, $application_submission, $conditional_document, $parental_consent_letter, $birth_certificate,
           $previous_assigned_at, $unique_id;
                                 public $application_portal_logins, $cas_shield_logins, $enrollment_logins, $visa_application_links;

    
    // Add these properties for admission form documents
    public $sop_path;
    public $fee_voucher_path;
    public $partner;
    public $bank_statement_path;
    public $interview_pass_path;
    public $tb_test_path;
    public $fee_payment_path;
    public $extra_undercas_path;
    public $cas_document_path;
    public $cnic_path;
    public $new_bank_statement_path;
    public $visa_history_path;
    public $visa_application_path;
    public $appointment_letter_path;
    public $decision_letter_path;
    public $e_visa_path;
    public $student_id_card_path;
    public $users_id; // Missing user reference
    public $registered_by_user_name; // Add this
    public $registered_by_user_role; // Add this
public $status_change_time; // Missing status change time
public $last_inquiry_status; // Missing previous status
public $parent_id; // Missing parent inquiry reference
public $assigned_user_name; // Add this
public $previous_assigned_user_name; // Add this
    
    // Add property for missing documents
    public $missingDocuments = [];

       #[On('showAdmissionDetails')]
    public function showDetails($id)
    {
    $inquiry = RegisteredInquiry::with(['assignedUser','registeredByUser',  'previousAssignedUser', 'inquiry', 'user'])->findOrFail($id);     
       $admissionForm = AdmissionForm::where('registered_inquiry_id', $id)->first();

        // Basic information
        $this->inquiryId = $inquiry->id;
            $this->users_id = $inquiry->users_id;
    $this->registered_by_user_name = $inquiry->registeredByUser->username ?? null;
       $this->registered_by_user_role = $inquiry->registeredByUser->role ?? null; // Add this
        $this->unique_id = $inquiry->unique_id;
        $this->student_name = $inquiry->student_name;
        $this->student_contact = $inquiry->student_contact;
        $this->emergency_contact_1 = $inquiry->emergency_contact_1;
        $this->emergency_contact_2 = $inquiry->emergency_contact_2;
        $this->passport_number = $inquiry->passport_number;
        $this->course_name = $inquiry->course_name;
        $this->course_intake = $inquiry->course_intake;
        $this->course_link = $inquiry->course_link;
        $this->gmail_password = $inquiry->gmail_password;
        $this->university_name = $inquiry->university_name;
        $this->inquiry_status = $inquiry->inquiry_status;
        $this->notes = $inquiry->notes;
        $this->notes_history = $inquiry->notes_history;
        $this->created_at = $inquiry->created_at;
        $this->updated_at = $inquiry->updated_at;
        $this->partner = $inquiry->partner;

        

            // ADD THESE MISSING FIELDS:
    $this->users_id = $inquiry->users_id; // User who registered
    $this->status_change_time = $inquiry->status_change_time; // Status change timestamp
    $this->last_inquiry_status = $inquiry->last_inquiry_status; // Previous status
    $this->parent_id = $inquiry->parent_id; // Parent inquiry reference
        
        // Assignment information
        $this->assigned_at = $inquiry->assigned_at;
        $this->assigned_to = $inquiry->assigned_to;
        $this->assigned_user_name = $inquiry->assignedUser->username ?? null; // Add this property
        $this->status = $inquiry->status;
        $this->status_updated_at = $inquiry->status_updated_at;
        $this->previous_assigned_to = $inquiry->previous_assigned_to;
        $this->previous_assigned_user_name = $inquiry->previousAssignedUser->username ?? null; // Add this property
        $this->previous_assigned_at = $inquiry->previous_assigned_at;
        
        // Document paths
        $this->matric_dmc_path = $inquiry->matric_dmc_path;
        $this->intermediate_dmc_path = $inquiry->intermediate_dmc_path;
        $this->bs_hons_path = $inquiry->bs_hons_path;
        $this->ba_bsc_path = $inquiry->ba_bsc_path;
        $this->ma_msc_path = $inquiry->ma_msc_path;
        $this->reference_letters_path = $inquiry->reference_letters_path;
        $this->has_refusal_letter = $inquiry->has_refusal_letter;
        $this->cv_file_path = $inquiry->cv_file_path;
        $this->passport_pages_path = $inquiry->passport_pages_path;
        $this->experience_letter_path = $inquiry->experience_letter_path;
        $this->english_test_path = $inquiry->english_test_path;
        $this->agent_consent_path = $inquiry->agent_consent_path;
        $this->student_consent_path = $inquiry->student_consent_path;
        $this->additional_docs_path = $inquiry->additional_docs_path;
        $this->extra_path = $inquiry->extra_path;
        $this->extra2_path = $inquiry->extra2_path;
        $this->extra3_path = $inquiry->extra3_path;
        $this->extra4_path = $inquiry->extra4_path;
        $this->extra5_path = $inquiry->extra5_path;
        $this->extra6_path = $inquiry->extra6_path;
        $this->extra7_path = $inquiry->extra7_path;
        $this->extra8_path = $inquiry->extra8_path;
        $this->extra9_path = $inquiry->extra9_path;
        $this->extra10_path = $inquiry->extra10_path;
        $this->extra11_path = $inquiry->extra11_path;
        $this->refusal_letter_path = $inquiry->refusal_letter_path;
        
        if ($admissionForm) {
            $this->sop_path = $admissionForm->sop_path;
            $this->fee_voucher_path = $admissionForm->fee_voucher_path;
            $this->bank_statement_path = $admissionForm->bank_statement_path;
            $this->interview_pass_path = $admissionForm->interview_pass_path;
            $this->tb_test_path = $admissionForm->tb_test_path;
            $this->fee_payment_path = $admissionForm->fee_payment_path;
            $this->extra_undercas_path = $admissionForm->extra_undercas_path;
            $this->cas_document_path = $admissionForm->cas_document_path;
            $this->cnic_path = $admissionForm->cnic_path;
            $this->new_bank_statement_path = $admissionForm->new_bank_statement_path;
            $this->visa_history_path = $admissionForm->visa_history_path;
            $this->visa_application_path = $admissionForm->visa_application_path;
            $this->appointment_letter_path = $admissionForm->appointment_letter_path;
            $this->decision_letter_path = $admissionForm->decision_letter_path;
            $this->e_visa_path = $admissionForm->e_visa_path;
            $this->student_id_card_path = $admissionForm->student_id_card_path;
            $this->funds_source = $admissionForm->funds_source;
            $this->application_submission = $admissionForm->application_submission;
            $this->conditional_document = $admissionForm->conditional_document;
            $this->parental_consent_letter = $admissionForm->parental_consent_letter;
            $this->birth_certificate = $admissionForm->birth_certificate;
              $this->application_portal_logins = $admissionForm->application_portal_logins;
    $this->cas_shield_logins = $admissionForm->cas_shield_logins;
    $this->enrollment_logins = $admissionForm->enrollment_logins;
    $this->visa_application_links = $admissionForm->visa_application_links;
        }
        
        // Calculate missing documents
        $this->calculateMissingDocuments();
        
        $this->showModal = true;
    }

    // Add this method to your component
private function getRoleDisplayText($role)
{
    return match($role) {
        'counsellor' => 'Counsellor',
        'manager' => "Counsellor's Manager",
        'admission' => 'Admission Manager',
        'admissionagent' => 'Admission Agent',
        default => ucfirst($role)
    };
}
    
    private function calculateMissingDocuments()
    {
        $this->missingDocuments = [];
        
        // Define all possible documents with their display names
        $allDocuments = [
            'matric_dmc_path' => 'Matric DMC',
            'intermediate_dmc_path' => 'Intermediate DMC',
            'bs_hons_path' => 'BS/Hons',
            'ba_bsc_path' => 'BA/BSc',
            'ma_msc_path' => 'MA/MSc',
            'reference_letters_path' => 'Reference Letters',
            'cv_file_path' => 'CV',
            'passport_pages_path' => 'Passport Pages',
            'experience_letter_path' => 'Experience Letter',
            'english_test_path' => 'English Test',
            'agent_consent_path' => 'Agent Consent',
            'student_consent_path' => 'Student Consent',
            'additional_docs_path' => 'Additional Docs',
            'refusal_letter_path' => 'Refusal Letter',
            'sop_path' => 'Statement of Purpose',
            'fee_voucher_path' => 'Fee Voucher',
            'bank_statement_path' => 'Bank Statement',
            'interview_pass_path' => 'Interview Pass',
            'tb_test_path' => 'TB Test',
            'fee_payment_path' => 'Fee Payment',
            'cas_document_path' => 'CAS Document',
            'cnic_path' => 'CNIC',
            'new_bank_statement_path' => 'New Bank Statement',
            'visa_history_path' => 'Visa History',
            'visa_application_path' => 'Visa Application',
            'appointment_letter_path' => 'Appointment Letter',
            'decision_letter_path' => 'Decision Letter',
            'e_visa_path' => 'E-Visa',
            'student_id_card_path' => 'Student ID Card',
            'birth_certificate' => 'Birth Certificate',
            'parental_consent_letter' => 'Parental Consent Letter',
            'funds_source' => 'Source of Funds',
            'application_submission' => 'Application Submission',
            'conditional_document' => 'Conditional Document',
                        'extra_undercas_path' => 'Unconditional Document',
            'extra_path' => 'Extra 1',
            'extra2_path' => 'Extra 2',
            'extra3_path' => 'Extra 3',
            'extra4_path' => 'Extra 4',
            'extra5_path' => 'Extra 5',
            'extra6_path' => 'Extra 6',
            'extra7_path' => 'Extra 7',
            'extra8_path' => 'Extra 8',
            'extra9_path' => 'Extra 9',
            'extra10_path' => 'Extra 10',
            'extra11_path' => 'Extra 11',
        ];
        
        // Check each document and add to missingDocuments if not uploaded
        foreach ($allDocuments as $property => $displayName) {
            if (empty($this->$property)) {
                $this->missingDocuments[] = $displayName;
            }
        }
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset();
        $this->missingDocuments = [];
    }
    public function downloadAllDocuments()
{
    $inquiry = RegisteredInquiry::findOrFail($this->inquiryId);
    $admissionForm = AdmissionForm::where('registered_inquiry_id', $this->inquiryId)->first();
    
    // Create a unique filename for the zip
    $folderName = $this->generateFolderName($inquiry);
    $zipFileName = $folderName . '.zip';
    $zipPath = storage_path('app/temp/' . $zipFileName);
    
    // Ensure the temp directory exists
    if (!file_exists(storage_path('app/temp'))) {
        mkdir(storage_path('app/temp'), 0755, true);
    }
    
    // Create a new zip archive
    $zip = new ZipArchive();
    
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        // Define all document fields from both RegisteredInquiry and AdmissionForm
        $documentFields = [
            // From RegisteredInquiry
            'matric_dmc_path',
            'intermediate_dmc_path',
            'bs_hons_path',
            'ba_bsc_path',
            'ma_msc_path',
            'reference_letters_path',
            'cv_file_path',
            'passport_pages_path',
            'experience_letter_path',
            'english_test_path',
            'agent_consent_path',
            'student_consent_path',
            'additional_docs_path',
            'refusal_letter_path',
            'extra_path',
            'extra2_path',
            'extra3_path',
            'extra4_path',
            'extra5_path',
            'extra6_path',
            'extra7_path',
            'extra8_path',
            'extra9_path',
            'extra10_path',
            'extra11_path',
            
            // From AdmissionForm
            'sop_path',
            'fee_voucher_path',
            'bank_statement_path',
            'interview_pass_path',
            'tb_test_path',
            'fee_payment_path',
            'cas_document_path',
            'cnic_path',
            'new_bank_statement_path',
            'visa_history_path',
            'visa_application_path',
            'appointment_letter_path',
            'decision_letter_path',
            'e_visa_path',
            'student_id_card_path',
            'birth_certificate',
            'parental_consent_letter',
            'funds_source',
            'application_submission',
            'conditional_document',
                        'extra_undercas_path'

        ];
        
        $addedFiles = 0;
        
        // Add each document to the zip
        foreach ($documentFields as $field) {
            $filePath = null;
            
            // Check if the field exists in RegisteredInquiry
            if (!empty($inquiry->$field) && Storage::exists($inquiry->$field)) {
                $filePath = $inquiry->$field;
            }
            // Check if the field exists in AdmissionForm
            elseif ($admissionForm && !empty($admissionForm->$field) && Storage::exists($admissionForm->$field)) {
                $filePath = $admissionForm->$field;
            }
            
            if ($filePath) {
                // Get file contents
                $fileContents = Storage::get($filePath);
                
                // Get original filename
                $originalFilename = basename($filePath);
                
                // Add to zip
                $zip->addFromString($originalFilename, $fileContents);
                $addedFiles++;
            }
        }
        
        $zip->close();
        
        if ($addedFiles > 0) {
            // Return the file as a download response
            return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
        } else {
            // No documents found
            $this->dispatch('showToast', 'error', 'No documents available for download.');
        }
    } else {
        $this->dispatch('showToast', 'error', 'Failed to create zip file.');
    }
}

// Helper method to generate folder name
private function generateFolderName($inquiry)
{
    $nameParts = [];
    
    if (!empty($inquiry->student_name)) {
        $nameParts[] = preg_replace('/[^A-Za-z0-9]/', '_', $inquiry->student_name);
    }
    
    if (!empty($inquiry->passport_number)) {
        $nameParts[] = $inquiry->passport_number;
    }
    
    if (!empty($inquiry->unique_id)) {
        $nameParts[] = $inquiry->unique_id;
    }
    
    // If we have no identifying information, use a generic name
    if (empty($nameParts)) {
        return 'student_documents_' . $inquiry->id;
    }
    
    return implode('_', $nameParts);
}

    public function render()
    {
        return view('livewire.admission-agent.modals.admission-inquiry-overview');
    }
}