<?php

namespace App\Livewire\Admission\AdmissionTeam\Modals;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Models\AdmissionForm;
use Livewire\WithFileUploads;
use App\Models\User; // Add this import

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ModifyAdmissionInquiry extends Component
{
    use WithFileUploads;
      // Add this property
    public $users_id;
    public $agents = []; // Add this property to store agents/managers
    public $original_status; // Add this property
    public $inquiryId, $registered_inquiry_id, $currentPage = 1;
    public $showModal = false;

    // Basic Information Fields
    public $passport_number, $student_name, $student_contact, $emergency_contact_1, $emergency_contact_2;
    public $gmail_password;
    public $inquiry_status = 'underassessment'; // Default value

    // Course Information Fields
    public $course_name, $course_intake, $course_link, $university_name;
    public $referrer; // Add this property to track the referring page
    // Add this property to track pending deletions
    public $pendingDeletions = [];
    // Add these properties to your component
public $application_portal_logins;
public $cas_shield_logins;
public $enrollment_logins;
public $visa_application_links;
    public $disableUsersId = false;

    public $partner;

    // Document Fields
    public $matric_dmc, $intermediate_dmc, $bs_hons, $ba_bsc, $ma_msc, $cv_file, $passport_pages;
    public $experience_letter, $english_test, $agent_consent, $student_consent, $additional_docs, $refusal_letter;
    public $extra, $extra2, $extra3, $extra4, $extra5, $extra6, $extra7, $extra8, $extra9, $extra10, $extra11;

    // Document Paths
    public $matric_dmc_path, $intermediate_dmc_path, $bs_hons_path, $ba_bsc_path, $ma_msc_path;
    public $cv_file_path, $passport_pages_path, $experience_letter_path, $english_test_path;
    public $agent_consent_path, $student_consent_path, $additional_docs_path, $refusal_letter_path;
    public $extra_path, $extra2_path, $extra3_path, $extra4_path, $extra5_path, $extra6_path;
    public $extra7_path, $extra8_path, $extra9_path, $extra10_path, $extra11_path;

    // Notes Fields
    public $notes, $notes_history;

    protected $statusFlow = [
        'underassessment',
        'processed',
        'conditional',
        'unconditional',
        'undercas',
        'casreceived',
        'visaprocess',
        'enrollment',
        'caseclosed', // Special status that can be selected from any state
        'rejection' ,  // New rejection status that can be selected from any state
            'withdrawn' // Add this new status


    ];

    public function mount()
    {
        $this->currentPage = request()->get('page', 1);
    }

    #[On('editAdmissionInquiry')]
    public function editAdmissionInquiry($id, $referrer = null)
    {
        $inquiry = RegisteredInquiry::findOrFail($id);
        $this->registered_inquiry_id = $inquiry->id;
        $this->original_status = $inquiry->inquiry_status; // Store original status
        $this->inquiry_status = $inquiry->inquiry_status; // Initialize current status
        
        // Basic Information
        $this->passport_number = $inquiry->passport_number;
        $this->student_name = $inquiry->student_name;
        $this->student_contact = $inquiry->student_contact;
        $this->emergency_contact_1 = $inquiry->emergency_contact_1;
        $this->emergency_contact_2 = $inquiry->emergency_contact_2;
        $this->referrer = $referrer ?? url()->previous(); // Store the referring page
        $this->inquiry_status = $inquiry->inquiry_status;
        $this->gmail_password = $inquiry->gmail_password;
                $this->users_id = $inquiry->users_id;
                        $this->checkIfUsersIdShouldBeDisabled($inquiry->users_id);

                        $this->loadAgents();



        // Course Information
        $this->course_name = $inquiry->course_name;
        $this->course_intake = $inquiry->course_intake;
        $this->course_link = $inquiry->course_link;
        $this->university_name = $inquiry->university_name;
                    $this->partner = $inquiry->partner;


        // Document Paths
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
        

        // Notes
        $this->notes = '';
        $this->notes_history = $inquiry->notes_history;
          $admissionForm = AdmissionForm::where('registered_inquiry_id', $inquiry->id)->first();
    
    if ($admissionForm) {
        $this->application_portal_logins = $admissionForm->application_portal_logins;
        $this->cas_shield_logins = $admissionForm->cas_shield_logins;
        $this->enrollment_logins = $admissionForm->enrollment_logins;
        $this->visa_application_links = $admissionForm->visa_application_links;
    }

        $this->showModal = true;
    }

    protected function getCurrentStatusIndex()
    {
        return array_search($this->inquiry_status, $this->statusFlow);
    }
     protected function loadAgents()
    {
        $this->agents = User::where('status', 1) // Only active users (status = 1)
            ->whereIn('role', ['manager', 'counsellor']) // Only managers and counsellors
            ->orderBy('username')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role
                ];
            })
            ->toArray();
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->inquiry_status = $this->original_status; // Reset to original status
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function getAllowedStatuses()
    {
        // Lock status if enrollment is reached
        if ($this->original_status === 'enrollment') {
            return [];
        }

        $currentIndex = array_search($this->original_status, $this->statusFlow);
        $allowedStatuses = [];

        // Always allow caseclosed except for enrollment
        $allowedStatuses[] = 'caseclosed';
    $allowedStatuses[] = 'rejection'; // Add rejection to always allowed statuses
        $allowedStatuses[] = 'withdrawn'; // Add this line


        // Allow one step forward if not at the end
        if ($currentIndex !== false && $currentIndex < count($this->statusFlow) - 4) {
            $allowedStatuses[] = $this->statusFlow[$currentIndex + 1];
        }

        // Allow all previous steps
        if ($currentIndex !== false) {
            for ($i = 0; $i < $currentIndex; $i++) {
                $allowedStatuses[] = $this->statusFlow[$i];
            }
        }

         // If original status is caseclosed or rejection, only allow underassessment
      if ($this->original_status === 'caseclosed' || $this->original_status === 'rejection' || $this->original_status === 'withdrawn') {
        return ['underassessment'];
    }

    return array_unique($allowedStatuses);
}

 protected function checkIfUsersIdShouldBeDisabled($currentUserId)
    {
        $user = User::find($currentUserId);
        
        if ($user) {
            // Disable if role is NOT counsellor or manager
            $this->disableUsersId = !in_array($user->role, ['counsellor', 'manager']);
        } else {
            // If user not found, enable the field
            $this->disableUsersId = false;
        }
    }
    public function isStatusAllowed($status)
    {
        return in_array($status, $this->getAllowedStatuses());
    }
// In your update() method, add these custom validation rules
// In your update() method, add these custom validation rules
protected $messages = [
    'application_portal_logins.regex' => 'The application portal logins must be in the format: username_or_email/password',
    'cas_shield_logins.regex' => 'The CAS shield logins must be in the format: username_or_email/password',
    'enrollment_logins.regex' => 'The enrollment logins must be in the format: username_or_email/password',
    'visa_application_links.format' => 'Each visa application link must be in the format: URL,password (one per line)',
];
    public function update()
    {
           $customValidation = [];
    
    // Format: username_or_email/password
    $loginFields = [
        'application_portal_logins',
        'cas_shield_logins', 
        'enrollment_logins'
    ];
    
    foreach ($loginFields as $field) {
        if (!empty($this->$field)) {
            $customValidation[$field] = 'regex:/^[^\/]+\/[^\/]+$/';
        }
    }
    
    // Format: URL,password (one per line)
    if (!empty($this->visa_application_links)) {
        $customValidation['visa_application_links'] = [
            function ($attribute, $value, $fail) {
                $lines = explode("\n", $value);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (!empty($line)) {
                        // Check if the line contains a comma and has content on both sides
                        if (strpos($line, ',') === false) {
                            $fail('Each visa application link must be in the format: URL,password');
                            return;
                        }
                        
                        $parts = explode(',', $line, 2);
                        if (empty($parts[0]) || empty($parts[1])) {
                            $fail('Each entry must include both a URL and password separated by a comma');
                            return;
                        }
                        
                        // Validate URL format
                        if (!filter_var(trim($parts[0]), FILTER_VALIDATE_URL)) {
                            $fail('Invalid URL format: ' . trim($parts[0]));
                            return;
                        }
                    }
                }
            }
        ];
    }
    
    // Only validate status if it's being changed
    $statusValidation = $this->inquiry_status !== $this->original_status
        ? [
            'inquiry_status' => [
                'required',
                function ($attribute, $value, $fail) {
                    $allowedStatuses = $this->getAllowedStatuses();
                    if (!in_array($value, $allowedStatuses)) {
                        $current = ucwords(str_replace('_', ' ', $this->original_status));
                        $fail("Invalid status transition from $current to " . ucwords(str_replace('_', ' ', $value)));
                    }

                    // Additional check for unconditional to undercas
                    if ($this->original_status === 'unconditional' && $value === 'undercas' && !in_array('undercas', $allowedStatuses)) {
                        $fail("Cannot change status from Unconditional to Under CAS directly");
                    }
                }
            ]
        ]
        : [];

    $validated = $this->validate(array_merge([
        // Your existing validation rules...
        'application_portal_logins' => 'nullable|string|max:1000',
        'cas_shield_logins' => 'nullable|string|max:1000',
        'enrollment_logins' => 'nullable|string|max:1000',
        'visa_application_links' => 'nullable|string|max:1000',
        // ... other rules
    ], $customValidation, $statusValidation));

        
        
        // Only validate status if it's being changed
        $statusValidation = $this->inquiry_status !== $this->original_status
            ? [
                'inquiry_status' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $allowedStatuses = $this->getAllowedStatuses();
                        if (!in_array($value, $allowedStatuses)) {
                            $current = ucwords(str_replace('_', ' ', $this->original_status));
                            $fail("Invalid status transition from $current to " . ucwords(str_replace('_', ' ', $value)));
                        }

                        // Additional check for unconditional to undercas
                        if ($this->original_status === 'unconditional' && $value === 'undercas' && !in_array('undercas', $allowedStatuses)) {
                            $fail("Cannot change status from Unconditional to Under CAS directly");
                        }
                    }
                ]
            ]
            : [];

        $validated = $this->validate(array_merge([
            // Basic fields validation
                        'users_id' => 'required|exists:users,id',

            'passport_number' => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'student_contact' => 'required|string|max:255',
            'emergency_contact_1' => 'required|string|max:255',
            'emergency_contact_2' => 'nullable|string|max:255',
            'gmail_password' => 'required|string|max:255',

            // Course fields validation
            'course_name' => 'required|string|max:255',
            'course_intake' => 'required|string|max:255',
            'course_link' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
               // New fields validation
    'application_portal_logins' => 'nullable|string|max:1000',
    'cas_shield_logins' => 'nullable|string|max:1000',
    'enrollment_logins' => 'nullable|string|max:1000',
    'visa_application_links' => 'nullable|string|max:1000',

            // Notes validation
            'notes' => 'nullable|string',
            'partner' => 'nullable|string|max:255', // Add this line


            // Document validation
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
        ], $statusValidation));

        $inquiry = RegisteredInquiry::findOrFail($this->registered_inquiry_id);
        $user = Auth::user();
        $updateData = $validated;
        
        if ($this->inquiry_status !== $this->original_status) {
            // Save the old status to last_inquiry_status before updating the new status
            $updateData['last_inquiry_status'] = $this->original_status;
            $updateData['status_change_time'] = now(); // Add status change timestamp

        }

        // Check if status is being changed to "processed"
        if ($this->inquiry_status === 'processed' && $this->inquiry_status !== $this->original_status) {
            // Check if admission form already exists with SOP
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $inquiry->id)
                ->whereNotNull('sop_path')
                ->first();
            
            if (!$admissionForm) {
                // First update all other changes except status
                unset($updateData['inquiry_status']);
                
                // Handle file uploads
                $fileFields = [
                    'matric_dmc',
                    'intermediate_dmc',
                    'bs_hons',
                    'ba_bsc',
                    'ma_msc',
                    'cv_file',
                    'passport_pages',
                    'experience_letter',
                    'english_test',
                    'agent_consent',
                    'student_consent',
                    'additional_docs',
                    'refusal_letter',
                    'extra',
                    'extra2',
                    'extra3',
                    'extra4',
                    'extra5',
                    'extra6',
                    'extra7',
                    'extra8',
                    'extra9',
                    'extra10',
                    'extra11'
                ];

                foreach ($fileFields as $field) {
                    if ($this->$field) {
                        $updateData[$field . '_path'] = $this->$field->store('registered-docs');
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

                // Update all changes except status
                $inquiry->update($updateData);

                // Close the modal and redirect to processed form
                $this->showModal = false;
                $this->notes = '';
                
                return redirect()->route('admission.forms.processed-form', ['inquiry_id' => $inquiry->id])
                    ->with('status_message', 'Please upload SOP before changing status to Processed');
            }
        }

        // Check if status is being changed to "conditional"
        if ($this->inquiry_status === 'conditional' && $this->inquiry_status !== $this->original_status) {
            // Check if conditional form already exists and is marked read
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $inquiry->id)
                ->where('conditional_marked_read', true)
                ->first();
            
            if (!$admissionForm) {
                // First update all other changes except status
                unset($updateData['inquiry_status']);
                
                // Handle file uploads
                $fileFields = [
                    'matric_dmc',
                    'intermediate_dmc',
                    'bs_hons',
                    'ba_bsc',
                    'ma_msc',
                    'cv_file',
                    'passport_pages',
                    'experience_letter',
                    'english_test',
                    'agent_consent',
                    'student_consent',
                    'additional_docs',
                    'refusal_letter',
                    'extra',
                    'extra2',
                    'extra3',
                    'extra4',
                    'extra5',
                    'extra6',
                    'extra7',
                    'extra8',
                    'extra9',
                    'extra10',
                    'extra11'
                ];

                foreach ($fileFields as $field) {
                    if ($this->$field) {
                        $updateData[$field . '_path'] = $this->$field->store('registered-docs');
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

                // Update all changes except status
                $inquiry->update($updateData);

                // Close the modal and redirect to conditional form
                $this->showModal = false;
                $this->notes = '';
                
                return redirect()->route('admission.forms.conditional-offers-form', ['inquiry_id' => $inquiry->id])
                    ->with('status_message', 'Please confirm conditional offer channels before changing status to Conditional');
            }
        }

        // Check if status is being changed to "unconditional"
        if ($this->inquiry_status === 'unconditional' && $this->inquiry_status !== $this->original_status) {
            // Check if unconditional form already exists with required documents
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $inquiry->id)
                ->whereNotNull('fee_payment_path') // Changed from fee_voucher_path

                ->first();
            
            if (!$admissionForm) {
                // First update all other changes except status
                unset($updateData['inquiry_status']);
                
                // Handle file uploads
                $fileFields = [
                    'matric_dmc',
                    'intermediate_dmc',
                    'bs_hons',
                    'ba_bsc',
                    'ma_msc',
                    'cv_file',
                    'passport_pages',
                    'experience_letter',
                    'english_test',
                    'agent_consent',
                    'student_consent',
                    'additional_docs',
                    'refusal_letter',
                    'extra',
                    'extra2',
                    'extra3',
                    'extra4',
                    'extra5',
                    'extra6',
                    'extra7',
                    'extra8',
                    'extra9',
                    'extra10',
                    'extra11'
                ];

                foreach ($fileFields as $field) {
                    if ($this->$field) {
                        $updateData[$field . '_path'] = $this->$field->store('registered-docs');
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

                // Update all changes except status
                $inquiry->update($updateData);

                // Close the modal and redirect to unconditional form
                $this->showModal = false;
                $this->notes = '';
                
                return redirect()->route('admission.forms.unconditional-offers-form', ['inquiry_id' => $inquiry->id])
                    ->with('status_message', 'Please upload unconditional offer documents before changing status to Unconditional');
            }
        }

        // Check if status is being changed to "undercas"
        if ($this->inquiry_status === 'undercas' && $this->inquiry_status !== $this->original_status) {
            // Check if undercas form already exists with required documents
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $inquiry->id)
                ->whereNotNull('fee_voucher_path')
                ->whereNotNull('bank_statement_path')
                ->whereNotNull('interview_pass_path')
                ->whereNotNull('tb_test_path')
                ->first();
            
            if (!$admissionForm) {
                // First update all other changes except status
                unset($updateData['inquiry_status']);
                
                // Handle file uploads
                $fileFields = [
                    'matric_dmc',
                    'intermediate_dmc',
                    'bs_hons',
                    'ba_bsc',
                    'ma_msc',
                    'cv_file',
                    'passport_pages',
                    'experience_letter',
                    'english_test',
                    'agent_consent',
                    'student_consent',
                    'additional_docs',
                    'refusal_letter',
                    'extra',
                    'extra2',
                    'extra3',
                    'extra4',
                    'extra5',
                    'extra6',
                    'extra7',
                    'extra8',
                    'extra9',
                    'extra10',
                    'extra11'
                ];

                foreach ($fileFields as $field) {
                    if ($this->$field) {
                        $updateData[$field . '_path'] = $this->$field->store('registered-docs');
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

                // Update all changes except status
                $inquiry->update($updateData);

                // Close the modal and redirect to undercas form
                $this->showModal = false;
                $this->notes = '';
                
                return redirect()->route('admission.forms.under-cas-form', ['inquiry_id' => $inquiry->id])
                    ->with('status_message', 'Please upload CAS documents before changing status to Under CAS');
            }
        }

        // Check if status is being changed to "casreceived"
        if ($this->inquiry_status === 'casreceived' && $this->inquiry_status !== $this->original_status) {
            // Check if CAS document already exists
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $inquiry->id)
                ->whereNotNull('cas_document_path')
                ->first();
            
            if (!$admissionForm) {
                // First update all other changes except status
                unset($updateData['inquiry_status']);
                
                // Handle file uploads
                $fileFields = [
                    'matric_dmc',
                    'intermediate_dmc',
                    'bs_hons',
                    'ba_bsc',
                    'ma_msc',
                    'cv_file',
                    'passport_pages',
                    'experience_letter',
                    'english_test',
                    'agent_consent',
                    'student_consent',
                    'additional_docs',
                    'refusal_letter',
                    'extra',
                    'extra2',
                    'extra3',
                    'extra4',
                    'extra5',
                    'extra6',
                    'extra7',
                    'extra8',
                    'extra9',
                    'extra10',
                    'extra11'
                ];

                foreach ($fileFields as $field) {
                    if ($this->$field) {
                        $updateData[$field . '_path'] = $this->$field->store('registered-docs');
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

                // Update all changes except status
                $inquiry->update($updateData);

                // Close the modal and redirect to CAS received form
                $this->showModal = false;
                $this->notes = '';
                
                return redirect()->route('admission.forms.cas-received-form', ['inquiry_id' => $inquiry->id])
                    ->with('status_message', 'Please upload CAS document before changing status to CAS Received');
            }
        }

        // Check if status is being changed to "visaprocess"
        if ($this->inquiry_status === 'visaprocess' && $this->inquiry_status !== $this->original_status) {
            // Check if visa process form already exists with required documents
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $inquiry->id)
                ->whereNotNull('cnic_path')
                ->whereNotNull('new_bank_statement_path')
                ->whereNotNull('visa_history_path')
                               ->whereNotNull('visa_application_path')
                ->whereNotNull('appointment_letter_path')

                ->first();
            
            if (!$admissionForm) {
                // First update all other changes except status
                unset($updateData['inquiry_status']);
                
                // Handle file uploads
                $fileFields = [
                    'matric_dmc',
                    'intermediate_dmc',
                    'bs_hons',
                    'ba_bsc',
                    'ma_msc',
                    'cv_file',
                    'passport_pages',
                    'experience_letter',
                    'english_test',
                    'agent_consent',
                    'student_consent',
                    'additional_docs',
                    'refusal_letter',
                    'extra',
                    'extra2',
                    'extra3',
                    'extra4',
                    'extra5',
                    'extra6',
                    'extra7',
                    'extra8',
                    'extra9',
                    'extra10',
                    'extra11'
                ];

                foreach ($fileFields as $field) {
                    if ($this->$field) {
                        $updateData[$field . '_path'] = $this->$field->store('registered-docs');
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

                // Update all changes except status
                $inquiry->update($updateData);

                // Close the modal and redirect to visa process form
                $this->showModal = false;
                $this->notes = '';
                
                return redirect()->route('admission.forms.visa-process-form', ['inquiry_id' => $inquiry->id])
                    ->with('status_message', 'Please upload visa process documents before changing status to Visa Process');
            }
        }

        // Check if status is being changed to "enrollment"
        if ($this->inquiry_status === 'enrollment' && $this->inquiry_status !== $this->original_status) {
            // Check if enrollment form already exists with required documents
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $inquiry->id)
 
                ->whereNotNull('decision_letter_path')
                ->whereNotNull('e_visa_path')
                ->whereNotNull('student_id_card_path')
                ->first();
            
            if (!$admissionForm) {
                // First update all other changes except status
                unset($updateData['inquiry_status']);
                
                // Handle file uploads
                $fileFields = [
                    'matric_dmc',
                    'intermediate_dmc',
                    'bs_hons',
                    'ba_bsc',
                    'ma_msc',
                    'cv_file',
                    'passport_pages',
                    'experience_letter',
                    'english_test',
                    'agent_consent',
                    'student_consent',
                    'additional_docs',
                    'refusal_letter',
                    'extra',
                    'extra2',
                    'extra3',
                    'extra4',
                    'extra5',
                    'extra6',
                    'extra7',
                    'extra8',
                    'extra9',
                    'extra10',
                    'extra11'
                ];

                foreach ($fileFields as $field) {
                    if ($this->$field) {
                        $updateData[$field . '_path'] = $this->$field->store('registered-docs');
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

                // Update all changes except status
                $inquiry->update($updateData);

                // Close the modal and redirect to enrollment form
                $this->showModal = false;
                $this->notes = '';
                
                return redirect()->route('admission.forms.enrollment-form', ['inquiry_id' => $inquiry->id])
                    ->with('status_message', 'Please upload enrollment documents before changing status to Enrollment');
            }
        }

        // Only update status if it was changed (for non-processed, non-conditional, and non-unconditional cases)
        if ($this->inquiry_status !== $this->original_status) {
            $inquiry->update(['inquiry_status' => $this->inquiry_status,
                            'status_change_time' => now(), // Add status change timestamp
            'last_inquiry_status' => $this->original_status
        ]);
            $this->original_status = $this->inquiry_status;
        }

        // Handle file uploads
        $fileFields = [
            'matric_dmc',
            'intermediate_dmc',
            'bs_hons',
            'ba_bsc',
            'ma_msc',
            'cv_file',
            'passport_pages',
            'experience_letter',
            'english_test',
            'agent_consent',
            'student_consent',
            'additional_docs',
            'refusal_letter',
            'extra',
            'extra2',
            'extra3',
            'extra4',
            'extra5',
            'extra6',
            'extra7',
            'extra8',
            'extra9',
            'extra10',
            'extra11'
        ];

        foreach ($fileFields as $field) {
            if ($this->$field) {
                $updateData[$field . '_path'] = $this->$field->store('registered-docs');
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
        
        // Clear pending deletions after successful update
        $this->pendingDeletions = [];
        
        // Update the original_status property if status was changed
        if ($this->inquiry_status !== $this->original_status) {
            $this->original_status = $this->inquiry_status;
        }
        $admissionFormData = [
    'application_portal_logins' => $this->application_portal_logins,
    'cas_shield_logins' => $this->cas_shield_logins,
    'enrollment_logins' => $this->enrollment_logins,
    'visa_application_links' => $this->visa_application_links,
];

$admissionForm = AdmissionForm::where('registered_inquiry_id', $this->registered_inquiry_id)->first();

if ($admissionForm) {
    $admissionForm->update($admissionFormData);
} else {
    // Create a new admission form record if it doesn't exist
    AdmissionForm::create(array_merge($admissionFormData, [
        'user_id' => Auth::id(),
        'inquiry_id' => $inquiry->inquiry_id, // You might need to adjust this
        'registered_inquiry_id' => $this->registered_inquiry_id,
    ]));
}

        session()->flash('message', 'Admission inquiry updated successfully.');
        $this->showModal = false;
        $this->notes = '';

        // Get the referring URL and add page=1 parameter
        $referrer = $this->referrer ?: route('admission.all-applications');
        $referrer = str_contains($referrer, '?') 
            ? preg_replace('/([?&])page=[^&]*(&|$)/', '$1', $referrer) . 'page=1'
            : $referrer . '?page=1';

        return redirect()->to($referrer);
    }
    
    public function deleteFile($field)
    {
        // Instead of deleting immediately, add to pending deletions
        $this->pendingDeletions[$field] = true;
        
        // Clear the file input and path for UI
        $this->{$field} = null;
        $this->{$field . '_path'} = null;
    }

    public function confirmDelete($field)
    {
        $this->dispatch(
            'confirmDelete',
            field: $field,
            message: 'Are you sure you want to remove this document?',
            callback: 'deleteFile'
        );
    }
    

    public function render()
    {
        return view('livewire.admission.admission-team.modals.modify-admission-inquiry');
    }
}