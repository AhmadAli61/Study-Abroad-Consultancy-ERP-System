<?php

namespace App\Livewire\ExternalAgent\Modal;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ViewRegisteredApplicationDetails extends Component
{
     public $showModal = false;
    public $inquiryId, $student_name, $partner, $student_contact, $emergency_contact_1, $emergency_contact_2, $passport_number, $course_name, $course_intake, $course_link, $gmail_password, $university_name, $inquiry_status, $notes, $created_at, $updated_at, $matric_dmc_path, $intermediate_dmc_path, $bs_hons_path, $ba_bsc_path, $ma_msc_path, $reference_letters_path, $has_refusal_letter, $cv_file_path, $passport_pages_path, $experience_letter_path, $english_test_path, $agent_consent_path, $student_consent_path, $additional_docs_path, $extra_path, $extra2_path, $extra3_path, $extra4_path, $extra5_path, $extra6_path, $extra7_path, $extra8_path, $extra9_path, $extra10_path, $extra11_path, $refusal_letter_path, $notes_history;
    #[On('showDetailsExternal')]
    public function showDetailsExternal($id)
    {
        $inquiry = RegisteredInquiry::with(['inquiry', 'user'])->findOrFail($id);

        // Basic information
        $this->inquiryId = $inquiry->id;
        $this->student_name = $inquiry->student_name;
        $this->partner = $inquiry->partner;
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
        $this->notes_history = $inquiry->notes_history; // Add this line
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
        $this->extra11_path = $inquiry->extra11_path; // Add this line
        $this->additional_docs_path = $inquiry->additional_docs_path;
        $this->refusal_letter_path = $inquiry->refusal_letter_path;
        $this->showModal = true;
    }
    public function downloadAllDocuments()
    {
        $inquiry = RegisteredInquiry::findOrFail($this->inquiryId);
        
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
            // Define all document fields
            $documentFields = [
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
                'extra11_path'
            ];
            
            $addedFiles = 0;
            
            // Add each document to the zip
            foreach ($documentFields as $field) {
                if (!empty($inquiry->$field) && Storage::exists($inquiry->$field)) {
                    // Get file contents
                    $fileContents = Storage::get($inquiry->$field);
                    
                    // Get original filename
                    $originalFilename = basename($inquiry->$field);
                    
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
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.external-agent.modal.view-registered-application-details');
    }
}
