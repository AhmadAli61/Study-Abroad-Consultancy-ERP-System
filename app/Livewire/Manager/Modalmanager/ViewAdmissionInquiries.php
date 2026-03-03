<?php

namespace App\Livewire\Manager\ModalManager;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use Livewire\Attributes\On;

class ViewAdmissionInquiries extends Component
{
    public $showModal = false;
    public $inquiryId, $student_name, $partner,  $student_contact,$unique_id, $emergency_contact_1, $emergency_contact_2, $passport_number, $course_name, $course_intake, $course_link, $gmail_password, $university_name, $inquiry_status, $notes, $created_at, $updated_at, $matric_dmc_path, $intermediate_dmc_path, $bs_hons_path, $ba_bsc_path, $ma_msc_path, $reference_letters_path, $has_refusal_letter, $cv_file_path, $passport_pages_path, $experience_letter_path, $english_test_path, $agent_consent_path, $student_consent_path, $additional_docs_path, $extra_path, $extra2_path, $extra3_path, $extra4_path, $extra5_path, $extra6_path, $extra7_path, $extra8_path, $extra9_path, $extra10_path, $extra11_path, $refusal_letter_path, $notes_history;
    
    #[On('showDetails')]
    public function showDetails($id)
    {
        $inquiry = RegisteredInquiry::with(['inquiry', 'user'])->findOrFail($id);

        // Basic information
        $this->inquiryId = $inquiry->id;
        $this->student_name = $inquiry->student_name;
        $this->student_contact = $inquiry->student_contact;
        $this->emergency_contact_1 = $inquiry->emergency_contact_1;
        $this->partner = $inquiry->partner;
        $this->emergency_contact_2 = $inquiry->emergency_contact_2;
        $this->passport_number = $inquiry->passport_number;
        $this->course_name = $inquiry->course_name;
        $this->course_intake = $inquiry->course_intake;
        $this->course_link = $inquiry->course_link;
        $this->gmail_password = $inquiry->gmail_password;
        $this->university_name = $inquiry->university_name;
        $this->inquiry_status = $inquiry->inquiry_status;
        $this->notes = $inquiry->notes;
        $this->unique_id = $inquiry->unique_id;
        $this->notes_history = $inquiry->notes_history;
        $this->created_at = $inquiry->created_at;
        $this->updated_at = $inquiry->updated_at;
        
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
        $this->additional_docs_path = $inquiry->additional_docs_path;
        $this->refusal_letter_path = $inquiry->refusal_letter_path;
        
        $this->showModal = true;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.manager.modal-manager.view-admission-inquiries');
    }
}