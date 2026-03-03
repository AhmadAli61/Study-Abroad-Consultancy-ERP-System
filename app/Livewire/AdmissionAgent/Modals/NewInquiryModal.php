<?php

namespace App\Livewire\AdmissionAgent\Modals;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class NewInquiryModal extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $parentId;
    public $studentName;
    public $studentUniqueId;
    
    public $university_name;
    public $course_name;
    public $course_intake;
    public $course_link;
    public $extra_document;

    protected $rules = [
        'university_name' => 'required|string|max:255',
        'course_name' => 'required|string|max:255',
        'course_intake' => 'required|string|max:255',
        'course_link' => 'required|url',
        'extra_document' => 'nullable|file|mimes:pdf|max:5120',
    ];

    #[On('openNewInquiryModal')]
    public function openNewInquiryModal($parentId)
    {
        $this->parentId = $parentId;
        
        // Get student details from parent record
        $parent = RegisteredInquiry::find($this->parentId);
        
        if ($parent) {
            $this->studentName = $parent->student_name;
            $this->studentUniqueId = $parent->unique_id;
        } else {
            // Fallback if parent not found
            $this->studentName = 'Student Not Found';
            $this->studentUniqueId = 'N/A';
        }
        
        // Store the current URL in session
        session(['new_inquiry_referrer' => url()->previous()]);
        $this->showModal = true;
        
        // Reset form fields (but keep student data)
        $this->reset(['university_name', 'course_name', 'course_intake', 'course_link', 'extra_document']);
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset();
        $this->resetValidation();
    }

    // Add this method to generate student initials
    public function getStudentInitials($name)
    {
        $words = explode(' ', trim($name));
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        // Return first 2-3 initials (max 3)
        return substr($initials, 0, 3);
    }

    // Add this method to generate unique ID with student initials and record ID
    public function generateUniqueId($studentName, $recordId)
    {
        $studentInitials = $this->getStudentInitials($studentName);
        $currentYear = date('y');
        
        // Just concatenate without padding - let the ID be as long as needed
        return $studentInitials . $currentYear . $recordId;
    }

    public function saveNewInquiry()
    {
        $this->validate();

        try {
            $parent = RegisteredInquiry::findOrFail($this->parentId);
            
            // Store extra document if provided
            $extraDocPath = $this->extra_document ? $this->extra_document->store('registered-docs') : null;

            // Create new inquiry linked to parent - WITHOUT unique_id first
            $newInquiry = RegisteredInquiry::create([
                'parent_id' => $this->parentId,
                'inquiry_id' => $parent->inquiry_id,
                'users_id' => $parent->users_id,
                'passport_number' => $parent->passport_number,
                'student_name' => $parent->student_name,
                'student_contact' => $parent->student_contact,
                'emergency_contact_1' => $parent->emergency_contact_1,
                'emergency_contact_2' => $parent->emergency_contact_2,
                'course_name' => $this->course_name,
                'course_intake' => $this->course_intake,
                'course_link' => $this->course_link,
                'gmail_password' => $parent->gmail_password,
                'university_name' => $this->university_name,
                
                // Copy ALL document paths from parent
                'matric_dmc_path' => $parent->matric_dmc_path,
                'intermediate_dmc_path' => $parent->intermediate_dmc_path,
                'bs_hons_path' => $parent->bs_hons_path,
                'ba_bsc_path' => $parent->ba_bsc_path,
                'ma_msc_path' => $parent->ma_msc_path,
                'reference_letters_path' => $parent->reference_letters_path,
                'cv_file_path' => $parent->cv_file_path,
                'passport_pages_path' => $parent->passport_pages_path,
                'experience_letter_path' => $parent->experience_letter_path,
                'english_test_path' => $parent->english_test_path,
                'agent_consent_path' => $parent->agent_consent_path,
                'student_consent_path' => $parent->student_consent_path,
                'additional_docs_path' => $parent->additional_docs_path,
                'extra_path' => $parent->extra_path,
                'extra2_path' => $parent->extra2_path,
                'extra3_path' => $parent->extra3_path,
                'extra4_path' => $parent->extra4_path,
                'extra5_path' => $parent->extra5_path,
                'extra6_path' => $parent->extra6_path,
                'extra7_path' => $parent->extra7_path,
                'extra8_path' => $parent->extra8_path,
                'extra9_path' => $parent->extra9_path,
                'extra10_path' => $parent->extra10_path,
                'extra11_path' => $parent->extra11_path,
                'refusal_letter_path' => $parent->refusal_letter_path,
                'has_refusal_letter' => $parent->has_refusal_letter,
                
                // New extra document
                'extra12_path' => $extraDocPath,
                
                // Copy assignment details
                'assigned_to' => $parent->assigned_to,
                'status' => $parent->status,
                'inquiry_status' => 'underassessment',
                'assigned_at' => now(),
                
                // Don't set unique_id here - we'll update it after creation
            ]);

            // Generate unique ID after record creation
            $uniqueId = $this->generateUniqueId($parent->student_name, $newInquiry->id);
            
            // Update the record with the generated unique ID
            $newInquiry->update([
                'unique_id' => $uniqueId
            ]);

            $this->closeModal();
            session()->flash('success', 'New inquiry added successfully! Registration ID: ' . $uniqueId);
            
            // Get the referrer from session
            $referrer = session('new_inquiry_referrer', route('admissionagent.allapplications'));
            
            return redirect()->to($referrer);

        } catch (\Exception $e) {
            session()->flash('error', 'Error creating new inquiry: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admission-agent.modals.new-inquiry-modal');
    }
}