<?php

namespace App\Livewire\Manager\ModalManager;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EditAdmissionInquiries extends Component
{
    use WithFileUploads;
    public $inquiryId, $registered_inquiry_id, $currentPage = 1;
    public $showModal = false;
    public $referrer; // Add this property to track the referring page

    public $passport_number, $student_name, $student_contact, $emergency_contact_1, $emergency_contact_2, $course_name, $course_intake, $course_link, $gmail_password, $university_name, $inquiry_status, $status, $assigned_to, $has_refusal_letter, $notes, $notes_history, $matric_dmc, $intermediate_dmc, $bs_hons, $ba_bsc, $ma_msc, $cv_file, $passport_pages, $experience_letter, $english_test, $agent_consent, $student_consent, $additional_docs, $refusal_letter, $extra, $extra2, $extra3, $extra4, $extra5, $extra6, $extra7, $extra8, $extra9, $extra10, $extra11, $matric_dmc_path, $intermediate_dmc_path, $bs_hons_path, $ba_bsc_path, $ma_msc_path, $cv_file_path, $passport_pages_path, $experience_letter_path, $english_test_path, $agent_consent_path, $student_consent_path, $additional_docs_path, $refusal_letter_path, $extra_path, $extra2_path, $extra3_path, $extra4_path, $extra5_path, $extra6_path, $extra7_path, $extra8_path, $extra9_path, $extra10_path ,$extra11_path;
    
    public function mount() {
        $this->currentPage = request()->get('page', 1);
    }
    
    #[On('editAdmissionInquiry')]
    public function editAdmissionInquiry($id, $referrer = null)
    {
        $inquiry = RegisteredInquiry::findOrFail($id);
        $this->registered_inquiry_id = $inquiry->id;
        $this->passport_number = $inquiry->passport_number;
        $this->student_name = $inquiry->student_name;
        $this->student_contact = $inquiry->student_contact;
        $this->emergency_contact_1 = $inquiry->emergency_contact_1;
        $this->emergency_contact_2 = $inquiry->emergency_contact_2;
        $this->referrer = $referrer ?? url()->previous(); // Store the referring page
        $this->course_name = $inquiry->course_name;
        $this->course_intake = $inquiry->course_intake;
        $this->course_link = $inquiry->course_link;
        $this->gmail_password = $inquiry->gmail_password;
        $this->university_name = $inquiry->university_name;
        $this->inquiry_status = $inquiry->inquiry_status;
        $this->status = $inquiry->status;
        $this->assigned_to = $inquiry->assigned_to;
        $this->has_refusal_letter = $inquiry->has_refusal_letter;
        $this->notes = '';
        $this->notes_history = $inquiry->notes_history;
        $this->matric_dmc_path = $inquiry->matric_dmc_path;
        $this->intermediate_dmc_path = $inquiry->intermediate_dmc_path;
        $this->bs_hons_path = $inquiry->bs_hons_path;
        $this->ba_bsc_path = $inquiry->ba_bsc_path;
        $this->ma_msc_path = $inquiry->ma_msc_path;
        $this->cv_file_path = $inquiry->cv_file_path;
        $this->passport_pages_path = $inquiry->passport_pages_path;
        $this->experience_letter_path = $inquiry->experience_letter_path;
        $this->english_test_path = $inquiry->english_test_path;
        $this->agent_consent_path = $inquiry->agent_consent_path;
        $this->student_consent_path = $inquiry->student_consent_path;
        $this->additional_docs_path = $inquiry->additional_docs_path;
        $this->refusal_letter_path = $inquiry->refusal_letter_path;
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
        $this->showModal = true;
    }
    
    public function update()
    {
        $validated = $this->validate([
            'passport_number' => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'student_contact' => 'required|string|max:255',
            'emergency_contact_1' => 'required|string|max:255',
            'emergency_contact_2' => 'nullable|string|max:255',
            'course_name' => 'required|string|max:255',
            'course_intake' => 'required|string|max:255',
            'course_link' => 'required|string|max:255',
            'gmail_password' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'inquiry_status' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'has_refusal_letter' => 'required|in:yes,no',
            'notes' => 'nullable|string',
            'matric_dmc' => 'nullable|file|mimes:pdf|max:5120',
            'intermediate_dmc' => 'nullable|file|mimes:pdf|max:5120',
            'bs_hons' => 'nullable|file|mimes:pdf|max:5120',
            'ba_bsc' => 'nullable|file|mimes:pdf|max:5120',
            'ma_msc' => 'nullable|file|mimes:pdf|max:5120',
            'cv_file' => 'nullable|file|mimes:pdf|max:5120',
            'passport_pages' => 'nullable|file|mimes:pdf|max:5120',
            'experience_letter' => 'nullable|file|mimes:pdf|max:5120',
            'english_test' => 'nullable|file|mimes:pdf|max:5120',
            'agent_consent' => 'nullable|file|mimes:pdf|max:5120',
            'student_consent' => 'nullable|file|mimes:pdf|max:5120',
            'additional_docs' => 'nullable|file|mimes:pdf|max:5120',
            'refusal_letter' => 'nullable|file|mimes:pdf|max:5120',
            'extra' => 'nullable|file|mimes:pdf|max:5120',
            'extra2' => 'nullable|file|mimes:pdf|max:5120',
            'extra3' => 'nullable|file|mimes:pdf|max:5120',
            'extra4' => 'nullable|file|mimes:pdf|max:5120',
            'extra5' => 'nullable|file|mimes:pdf|max:5120',
            'extra6' => 'nullable|file|mimes:pdf|max:5120',
            'extra7' => 'nullable|file|mimes:pdf|max:5120',
            'extra8' => 'nullable|file|mimes:pdf|max:5120',
            'extra9' => 'nullable|file|mimes:pdf|max:5120',
            'extra10' => 'nullable|file|mimes:pdf|max:5120',
            'extra11' => 'nullable|file|mimes:pdf|max:5120',
        ]);
        
        $inquiry = RegisteredInquiry::findOrFail($this->registered_inquiry_id);
        $user = Auth::user();
        $updateData = $validated;
        
        // Handle file uploads
        $fileFields = [
            'matric_dmc', 'intermediate_dmc', 'bs_hons', 'ba_bsc', 'ma_msc',
            'cv_file', 'passport_pages', 'experience_letter', 'english_test',
            'agent_consent', 'student_consent', 'additional_docs', 'refusal_letter',
            'extra', 'extra2', 'extra3', 'extra4', 'extra5', 'extra6', 'extra7',
            'extra8', 'extra9', 'extra10' , 'extra11'
        ];
        
        foreach ($fileFields as $field) {
            if ($this->$field) {
                $updateData[$field.'_path'] = $this->$field->store('registered-docs');
                
                // Automatically set has_refusal_letter to 'yes' if refusal_letter is uploaded
                if ($field === 'refusal_letter') {
                    $updateData['has_refusal_letter'] = 'yes';
                }
            }
            unset($updateData[$field]);
        }

        // Handle notes update
        if (!empty($this->notes)) {
            $newNote = [
                'user_name' => $user->username,
                'note' => $user->username . ': ' . $this->notes,
                'timestamp' => now()->toDateTimeString()
            ];
            
            $existingHistory = $inquiry->notes_history ? json_decode($inquiry->notes_history, true) : [];
            $existingHistory[] = $newNote;
            $updateData['notes_history'] = json_encode($existingHistory);
        }
        unset($updateData['notes']);

        $inquiry->update($updateData);

        session()->flash('message', 'Admission lead updated successfully.');
        $this->showModal = false;
        $this->notes = '';

        // Get the referring URL and add page=1 parameter
        $referrer = $this->referrer ?: route('manager.admission-dashboard');
        $referrer = str_contains($referrer, '?') 
            ? preg_replace('/([?&])page=[^&]*(&|$)/', '$1', $referrer) . 'page=1'
            : $referrer . '?page=1';

        return redirect()->to($referrer);
    }

    public function deleteFile($field)
    {
        // Reset the file input
        $this->$field = null;
        
        // If you want to also remove the file path from the database, uncomment below:
        // $inquiry = RegisteredInquiry::find($this->registered_inquiry_id);
        // if ($inquiry) {
        //     $inquiry->update([$field.'_path' => null]);
        // }
    }

    public function render()
    {
        // Status options for dropdown
        $statusOptions = [
            'registered' => 'Registered',
            'underassessment' => 'Under Assessment',
            'undercas' => 'Under CAS',
            'conditional' => 'Conditional',
            'unconditional' => 'Unconditional',
            'visaprocess' => 'Visa Process',
            'enrollment' => 'Enrollment',
            'caseclosed' => 'Case Closed',
            'casreceived' => 'CAS Received',
            'processed' => 'Processed',
        ];
        
        $agents = \App\Models\User::where('role', 'agent')->get();

        return view('livewire.manager.modal-manager.edit-admission-inquiries', [
            'statusOptions' => $statusOptions,
            'agents' => $agents,
        ]);
    }
}