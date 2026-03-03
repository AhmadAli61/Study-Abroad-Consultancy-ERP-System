<?php

namespace App\Livewire\Agent\Inquiry;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\RegisteredInquiry;
use App\Models\Inquiiry;
use App\Models\Notification;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Registered extends Component
{
    use WithFileUploads;
 
    public $inquiryId;
    public $users_id;
    public $passport_number;
    public $student_name;
    public $student_contact;
    public $emergency_contact_1;
    public $emergency_contact_2;
    public $course_name;
    public $course_intake;
    public $course_link;
    public $gmail_password;
    public $notes;
    public $has_refusal_letter = null;
    
    // File uploads
    public $matric_dmc_path;
    public $intermediate_dmc;
    public $bs_hons;
    public $ba_bsc;
    public $ma_msc;
    public $reference_letter;
    public $cv_file;
    public $passport_pages;
    public $experience_letter;
    public $english_test;
    public $agent_consent;
    public $student_consent;
    public $additional_docs;
    public $university_name;

    public $extra;
    public $extra2;
    public $extra3;
    public $extra4;
    public $extra5;
    public $extra6;
    public $extra7;
    public $extra8;
    public $extra9;
    public $extra10;
    public $extra11;
    public $refusal_letter;

    protected $messages = [
        '*.mimes' => 'Only PDF files are allowed for documents.',
        'gmail_password.regex' => 'Please enter in the format: example@gmail.com/password',
        '*.max' => 'File size must be less than 5MB.',
        'student_contact.regex' => 'The student contact must be a valid Pakistani number (e.g. 923001234567)',
        'emergency_contact_1.regex' => 'The emergency contact must be a valid Pakistani number (e.g. 923001234567)',
    ];

    public function updatedHasRefusalLetter($value)
    {
        if ($value === 'no') {
            $this->reset('refusal_letter');
            $this->dispatch('clearRefusalLetter');
        }
        $this->dispatch('refreshComponent');
    }

    public function mount()
    {
        // Get inquiry ID from session or query parameter
        $this->inquiryId = session('registering_inquiry_id') ?? request()->query('inquiry_id');
        
        if (!$this->inquiryId) {
            session()->flash('error', 'No inquiry specified for registration');
            return redirect()->route('agent.inquiry.hot');
        }

        // Fetch the inquiry data
        $inquiry = Inquiiry::find($this->inquiryId);
        
        if ($inquiry) {
            // Pre-fill the fields with inquiry data
            $this->student_name = $inquiry->name;
            $this->student_contact = $inquiry->phone_number;
        }
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

    public function getAgentPrefix()
    {
        return '' . auth()->user()->username . ' : ';
    }

    public function saveDocuments()
    {
        $this->validate([
            'passport_number' => 'required',
            'course_name' => 'required',
            'course_link' => 'required|url',
            'student_name' => 'required',
            'student_contact' => [
                'required',
                'regex:/^92\d{10}$/',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value === $this->emergency_contact_1) {
                        $fail('Student Contact and Emergency Contact 1 cannot be the same.');
                    }
                    
                    $exists = RegisteredInquiry::where('student_contact', $value)
                        ->orWhere('emergency_contact_1', $value)
                        ->exists();
                        
                    if ($exists) {
                        $fail('This contact number is already registered.');
                    }
                }
            ],
            
            'emergency_contact_1' => [
                'required',
                'regex:/^92\d{10}$/',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value === $this->student_contact) {
                        $fail('Emergency Contact 1 and Student Contact cannot be the same.');
                    }
                    
                    $exists = RegisteredInquiry::where('student_contact', $value)
                        ->orWhere('emergency_contact_1', $value)
                        ->exists();
                        
                    if ($exists) {
                        $fail('This contact number is already registered.');
                    }
                }
            ],
            'course_intake' => 'required',
            'university_name' => 'required|string|max:255',
            'gmail_password' => [
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com\/.+$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('/', $value);
                    if (count($parts) !== 2) {
                        $fail('Please enter both email and password separated by a slash (/)');
                        return;
                    }
                    
                    $email = trim($parts[0]);
                    $password = trim($parts[1]);
                    
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $fail('Please enter a valid Gmail address before the slash');
                        return;
                    }
                    
                    if (empty($password)) {
                        $fail('Password is required after the slash');
                        return;
                    }
                    
                    $exists = RegisteredInquiry::where('gmail_password', 'like', $email . '%')->exists();
                    
                    if ($exists) {
                        $fail('This Gmail address is already registered.');
                    }
                }
            ],
            'has_refusal_letter' => 'required|in:yes,no',
            'refusal_letter' => ['nullable','file','mimes:pdf','max:5120',
                function ($attribute, $value, $fail) {
                    if ($this->has_refusal_letter === 'yes' && !$value) {
                    $fail('The refusal letter is required when "Yes" is selected.');
                }
            },
            ],
            
            // Required PDF documents
            'matric_dmc_path' => 'required|file|mimes:pdf|max:5120',
            'intermediate_dmc' => 'required|file|mimes:pdf|max:5120',
            'cv_file' => 'required|file|mimes:pdf|max:5120',
            'passport_pages' => 'required|file|mimes:pdf|max:5120',
            'agent_consent' => 'required|file|mimes:pdf|max:5120',
            'student_consent' => 'required|file|mimes:pdf|max:5120',
            'reference_letter' => 'required|file|mimes:pdf|max:5120',

            
            // Optional PDF documents
            'bs_hons' => 'nullable|file|mimes:pdf|max:5120',
            'ba_bsc' => 'nullable|file|mimes:pdf|max:5120',
            'ma_msc' => 'nullable|file|mimes:pdf|max:5120',
            'experience_letter' => 'nullable|file|mimes:pdf|max:5120',
            'english_test' => 'nullable|file|mimes:pdf|max:5120',
            'additional_docs' => 'nullable|file|mimes:pdf|max:5120',
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

        try {
            // Store all files
            $matricDmcPath = $this->matric_dmc_path->store('registered-docs');
            $intermediateDmcPath = $this->intermediate_dmc->store('registered-docs');
            $cvFilePath = $this->cv_file->store('registered-docs');
            $passportPagesPath = $this->passport_pages->store('registered-docs');
            $agentConsentPath = $this->agent_consent->store('registered-docs');
            $studentConsentPath = $this->student_consent->store('registered-docs');
            
            // Store optional files if they exist
            $bsHonsPath = $this->bs_hons ? $this->bs_hons->store('registered-docs') : null;
            $baBscPath = $this->ba_bsc ? $this->ba_bsc->store('registered-docs') : null;
            $maMscPath = $this->ma_msc ? $this->ma_msc->store('registered-docs') : null;
            $experienceLetterPath = $this->experience_letter ? $this->experience_letter->store('registered-docs') : null;
            $englishTestPath = $this->english_test ? $this->english_test->store('registered-docs') : null;
            $additionalDocsPath = $this->additional_docs ? $this->additional_docs->store('registered-docs') : null;
            $extraPath = $this->extra ? $this->extra->store('registered-docs') : null;
            $extra2Path = $this->extra2 ? $this->extra2->store('registered-docs') : null;
            $extra3Path = $this->extra3 ? $this->extra3->store('registered-docs') : null;
            $extra4Path = $this->extra4 ? $this->extra4->store('registered-docs') : null;
            $extra5Path = $this->extra5 ? $this->extra5->store('registered-docs') : null;
            $extra6Path = $this->extra6 ? $this->extra6->store('registered-docs') : null;
            $extra7Path = $this->extra7 ? $this->extra7->store('registered-docs') : null;
            $extra8Path = $this->extra8 ? $this->extra8->store('registered-docs') : null;
            $extra9Path = $this->extra9 ? $this->extra9->store('registered-docs') : null;
            $extra10Path = $this->extra10 ? $this->extra10->store('registered-docs') : null;
            $extra11Path = $this->extra11 ? $this->extra11->store('registered-docs') : null;
            $referenceLetterPath = $this->reference_letter->store('registered-docs');

            $refusalLetterPath = null;
            
            if ($this->has_refusal_letter === 'yes') {
                if (!$this->refusal_letter) {
                    session()->flash('error', 'Refusal letter is required when "Yes" is selected.');
                    return;
                }
                $refusalLetterPath = $this->refusal_letter->store('registered-docs');
            }
            
           
            
            $currentNote = $this->getAgentPrefix() . $this->notes;
            $timestamp = now()->toDateTimeString();
            
            // Create notes history array
            $notesHistory = [
                [
                    'note' => $currentNote,
                    'timestamp' => $timestamp,
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->username
                ]
            ];

            // First create the registered inquiry without unique_id
            $registeredInquiry = RegisteredInquiry::create([
                'inquiry_id' => $this->inquiryId,
                'users_id' => auth()->id(),
                'passport_number' => $this->passport_number,
                'course_name' => $this->course_name,
                'course_link' => $this->course_link,
                'student_name' => $this->student_name,
                'student_contact' => $this->student_contact,
                'emergency_contact_1' => $this->emergency_contact_1,
                'emergency_contact_2' => $this->emergency_contact_2,
                'course_intake' => $this->course_intake,
                'university_name'=> $this->university_name,
                'gmail_password' => $this->gmail_password,
                'matric_dmc_path' => $matricDmcPath,
                'intermediate_dmc_path' => $intermediateDmcPath,
                'bs_hons_path' => $bsHonsPath,
                'ba_bsc_path' => $baBscPath,
                'ma_msc_path' => $maMscPath,
                'reference_letters_path' => $referenceLetterPath, // Store single path
                'cv_file_path' => $cvFilePath,
                'passport_pages_path' => $passportPagesPath,
                'experience_letter_path' => $experienceLetterPath,
                'english_test_path' => $englishTestPath,
                'agent_consent_path' => $agentConsentPath,
                'student_consent_path' => $studentConsentPath,
                'additional_docs_path' => $additionalDocsPath,
                'extra_path' => $extraPath,
                'extra2_path' => $extra2Path,
                'extra3_path' => $extra3Path,
                'extra4_path' => $extra4Path,
                'extra5_path' => $extra5Path,
                'extra6_path' => $extra6Path,
                'extra7_path' => $extra7Path,
                'extra8_path' => $extra8Path,
                'extra9_path' => $extra9Path,
                'extra10_path' => $extra10Path,
                'extra11_path' => $extra11Path,
                'refusal_letter_path' => $refusalLetterPath,
                'has_refusal_letter' => $this->has_refusal_letter,
                'notes' => $this->getAgentPrefix() . $this->notes,
                'notes_history' => json_encode($notesHistory),
            ]);


            // Now generate the unique ID with student initials and the actual record ID
            $uniqueId = $this->generateUniqueId($this->student_name, $registeredInquiry->id);
            
            // Update the record with the generated unique ID
            $registeredInquiry->update([
                'unique_id' => $uniqueId
            ]);
     // Create notification for admission team AFTER generating the uniqueId
// Instead of broadcasting to admission_team, send to specific users
Notification::create([
    'type' => 'new_application',
    'notifiable_type' => 'admission_team', // single shared team
    'notifiable_id' => 0, 
    'registered_inquiry_id' => $registeredInquiry->id,
    'inquiry_id' => $this->inquiryId,
    'data' => [
        'student_name' => $this->student_name,
        'unique_id' => $uniqueId,
        'course_name' => $this->course_name,
        'university_name' => $this->university_name,
        'agent_name' => auth()->user()->username,
        'agent_id' => auth()->id(),
        'registered_at' => now()->toDateTimeString()
    ]
]);


            // Update the inquiry status
            Inquiiry::where('id', $this->inquiryId)->update([
                'inquiry_status' => 'registered'
            ]);

            session()->flash('success', 'Student registration completed successfully! Registration ID: ' . $uniqueId);
            return redirect()->route('agent.admission-dashboard');

        } catch (\Exception $e) {
            session()->flash('error', 'Error saving registration: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.agent.inquiry.registered')->layout('layouts.agentdashboard');
    }
}