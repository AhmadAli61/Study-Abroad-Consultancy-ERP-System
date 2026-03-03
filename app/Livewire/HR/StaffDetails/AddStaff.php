<?php

namespace App\Livewire\Hr\StaffDetails;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\StaffDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AddStaff extends Component
{
    use WithFileUploads;

    // Personal Information
    public $full_name;
    public $father_name;
    public $date_of_birth;
    public $cnic_number;
    public $personal_contact_number;
    public $emergency_contact_number;
    public $home_address;
    public $city;

    // Document Uploads
    public $cnic_staff;
    public $cnic_mother;
    public $cnic_father;
    public $result_card_matric;
    public $result_card_intermediate;
    public $result_card_bachelors;
    public $utility_bill_copy;
    public $resume_cv;
    public $one_original_document;

    // Job Details
    public $role;
    public $date_of_joining;
    public $salary_package;
    public $commission;
    
    // Updated Bank Details
    public $bank_name;
    public $account_number;
    
    // Updated Company Assets
    public $assigned_laptop;
    public $assigned_laptop_ip;
    public $assigned_phone;
    public $assigned_phone_ip;
    
    // Existing fields
    public $company_phone_number;
    public $gmail_password;
    public $outlook;
    public $portal_credentials;
    public $remarks;

    protected $rules = [
        // Personal Information
        'full_name' => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'cnic_number' => 'required|string|unique:staff_details,cnic_number',
        'personal_contact_number' => 'required|string|unique:staff_details,personal_contact_number',
        'emergency_contact_number' => 'required|string|unique:staff_details,emergency_contact_number',
        'home_address' => 'required|string',
        'city' => 'required|string|max:255',

        // Document Uploads
        'cnic_staff' => 'nullable|file|max:10240',
        'cnic_mother' => 'nullable|file|max:10240',
        'cnic_father' => 'nullable|file|max:10240',
        'result_card_matric' => 'nullable|file|max:10240',
        'result_card_intermediate' => 'nullable|file|max:10240',
        'result_card_bachelors' => 'nullable|file|max:10240',
        'utility_bill_copy' => 'nullable|file|max:10240',
        'resume_cv' => 'nullable|file|max:10240',
        'one_original_document' => 'nullable|file|max:10240',

        // Job Details
        'role' => 'required|string|max:255',
        'date_of_joining' => 'required|date',
        'salary_package' => 'required|string',
        'commission' => 'nullable|string',
        
        // Updated Bank Details
        'bank_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:255',
        
        // Updated Company Assets
        'assigned_laptop' => 'nullable|string|max:255',
        'assigned_laptop_ip' => 'nullable|string|max:255',
        'assigned_phone' => 'nullable|string|max:255',
        'assigned_phone_ip' => 'nullable|string|max:255',

        // Existing fields
        'company_phone_number' => 'nullable|string|unique:staff_details,company_phone_number',
        'gmail_password' => 'nullable|string|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com\/.+$/',
        'outlook' => 'nullable|string',
        'portal_credentials' => 'nullable|string|regex:/^[a-zA-Z0-9._-]+\/.+$/',
        'remarks' => 'nullable|string',
    ];

    protected $messages = [
        '*.max' => 'File size must be less than 10MB.',
        'personal_contact_number.unique' => 'This personal contact number already exists in the system.',
        'emergency_contact_number.unique' => 'This emergency contact number already exists in the system.',
        'company_phone_number.unique' => 'This company phone number already exists in the system.',
        'personal_contact_number.regex' => 'Personal contact number must be in format 923001234567 (12 digits starting with 92).',
        'emergency_contact_number.regex' => 'Emergency contact number must be in format 923001234567 (12 digits starting with 92).',
        'company_phone_number.regex' => 'Company phone number must be in format 923001234567 (12 digits starting with 92).',
        'gmail_password.regex' => 'Gmail/Password must be in format: example@gmail.com/password',
        'portal_credentials.regex' => 'Portal credentials must be in format: username/password',
    ];

    // Add custom validation rules
    public function updated($propertyName)
    {
        // Add regex validation for phone numbers
        $this->rules['personal_contact_number'] = 'required|string|unique:staff_details,personal_contact_number|regex:/^92\d{10}$/';
        $this->rules['emergency_contact_number'] = 'required|string|unique:staff_details,emergency_contact_number|regex:/^92\d{10}$/';
        $this->rules['company_phone_number'] = 'nullable|string|unique:staff_details,company_phone_number|regex:/^92\d{10}$/';
        
        if ($propertyName === 'gmail_password' && $this->gmail_password) {
            $this->validateOnly($propertyName, [
                'gmail_password' => 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com\/.+$/'
            ]);
        }
        
        if ($propertyName === 'portal_credentials' && $this->portal_credentials) {
            $this->validateOnly($propertyName, [
                'portal_credentials' => 'regex:/^[a-zA-Z0-9._-]+\/.+$/'
            ]);
        }

        $this->validateOnly($propertyName);
    }

    private function formatGmailPassword($input)
    {
        if (empty($input)) {
            return null;
        }

        // Remove any extra spaces
        $input = trim($input);
        
        // Ensure it contains both email and password separated by /
        if (strpos($input, '/') === false) {
            // If no slash found, you might want to handle this case
            return $input;
        }

        return $input;
    }
    
    private function formatPortalCredentials($input)
    {
        if (empty($input)) {
            return null;
        }

        // Remove any extra spaces
        $input = trim($input);
        
        // Ensure it contains both username and password separated by /
        if (strpos($input, '/') === false) {
            // If no slash found, you might want to handle this case
            return $input;
        }

        return $input;
    }

    // Method to format phone number
    private function formatPhoneNumber($number)
    {
        // Remove all non-digit characters
        $cleaned = preg_replace('/\D/', '', $number);
        
        // If number starts with 0, replace with 92
        if (strlen($cleaned) === 11 && str_starts_with($cleaned, '0')) {
            $cleaned = '92' . substr($cleaned, 1);
        }
        
        // If number starts with +92, remove the +
        if (str_starts_with($cleaned, '+92')) {
            $cleaned = '92' . substr($cleaned, 3);
        }
        
        // Ensure it's exactly 12 digits starting with 92
        if (strlen($cleaned) === 12 && str_starts_with($cleaned, '92')) {
            return $cleaned;
        }
        
        return $number; // Return original if format is invalid
    }

    // Method to check for duplicate numbers
    private function checkDuplicateNumbers()
    {
        $errors = [];

        // Check personal contact number
        if ($this->personal_contact_number) {
            $formattedPersonal = $this->formatPhoneNumber($this->personal_contact_number);
            if (StaffDetail::where('personal_contact_number', $formattedPersonal)->exists()) {
                $errors['personal_contact_number'] = 'This personal contact number already exists in the system.';
            }
        }

        // Check emergency contact number
        if ($this->emergency_contact_number) {
            $formattedEmergency = $this->formatPhoneNumber($this->emergency_contact_number);
            if (StaffDetail::where('emergency_contact_number', $formattedEmergency)->exists()) {
                $errors['emergency_contact_number'] = 'This emergency contact number already exists in the system.';
            }
        }

        // Check company phone number
        if ($this->company_phone_number) {
            $formattedCompany = $this->formatPhoneNumber($this->company_phone_number);
            if (StaffDetail::where('company_phone_number', $formattedCompany)->exists()) {
                $errors['company_phone_number'] = 'This company phone number already exists in the system.';
            }
        }

        return $errors;
    }

    // Method to validate phone number format
    private function validatePhoneNumberFormat($number)
    {
        $formatted = $this->formatPhoneNumber($number);
        return preg_match('/^92\d{10}$/', $formatted);
    }

    public function save()
    {
        // Add regex validation for phone numbers
        $this->rules['personal_contact_number'] = 'required|string|unique:staff_details,personal_contact_number|regex:/^92\d{10}$/';
        $this->rules['emergency_contact_number'] = 'required|string|unique:staff_details,emergency_contact_number|regex:/^92\d{10}$/';
        $this->rules['company_phone_number'] = 'nullable|string|unique:staff_details,company_phone_number|regex:/^92\d{10}$/';

        // Validate all rules
        $this->validate();

        // Check for duplicate numbers with custom logic
        $duplicateErrors = $this->checkDuplicateNumbers();
        if (!empty($duplicateErrors)) {
            foreach ($duplicateErrors as $field => $error) {
                $this->addError($field, $error);
            }
            return;
        }

        // Validate phone number formats
        if (!$this->validatePhoneNumberFormat($this->personal_contact_number)) {
            $this->addError('personal_contact_number', 'Personal contact number must be in format 923001234567 (12 digits starting with 92).');
            return;
        }

        if (!$this->validatePhoneNumberFormat($this->emergency_contact_number)) {
            $this->addError('emergency_contact_number', 'Emergency contact number must be in format 923001234567 (12 digits starting with 92).');
            return;
        }

        if ($this->company_phone_number && !$this->validatePhoneNumberFormat($this->company_phone_number)) {
            $this->addError('company_phone_number', 'Company phone number must be in format 923001234567 (12 digits starting with 92).');
            return;
        }
        
        // Format credentials
        if ($this->gmail_password) {
            $this->gmail_password = $this->formatGmailPassword($this->gmail_password);
        }
        
        if ($this->portal_credentials) {
            $this->portal_credentials = $this->formatPortalCredentials($this->portal_credentials);
        }

        // Format phone numbers before saving
        $formattedPersonal = $this->formatPhoneNumber($this->personal_contact_number);
        $formattedEmergency = $this->formatPhoneNumber($this->emergency_contact_number);
        $formattedCompany = $this->company_phone_number ? $this->formatPhoneNumber($this->company_phone_number) : null;

        // First create staff record to get the ID
        $staff = StaffDetail::create([
            // Personal Information
            'full_name' => $this->full_name,
            'father_name' => $this->father_name,
            'date_of_birth' => $this->date_of_birth,
            'cnic_number' => $this->cnic_number,
            'personal_contact_number' => $formattedPersonal,
            'emergency_contact_number' => $formattedEmergency,
            'home_address' => $this->home_address,
            'city' => $this->city,

            // Job Details
            'role' => $this->role,
            'date_of_joining' => $this->date_of_joining,
            'salary_package' => $this->salary_package,
            'commission' => $this->commission,
            
            // Updated Bank Details
            'bank_name' => $this->bank_name,
            'account_number' => $this->account_number,
            
            // Updated Company Assets
            'assigned_laptop' => $this->assigned_laptop,
            'assigned_laptop_ip' => $this->assigned_laptop_ip,
            'assigned_phone' => $this->assigned_phone,
            'assigned_phone_ip' => $this->assigned_phone_ip,

            // Existing fields
            'company_phone_number' => $formattedCompany,
            'gmail_password' => $this->gmail_password,
            'outlook' => $this->outlook,
            'portal_credentials' => $this->portal_credentials,
            'remarks' => $this->remarks,
        ]);

        // Handle file uploads after creating the record
        $documentPaths = [];
        $documentFields = [
            'cnic_staff',
            'cnic_mother',
            'cnic_father',
            'result_card_matric',
            'result_card_intermediate',
            'result_card_bachelors',
            'utility_bill_copy',
            'resume_cv',
            'one_original_document',
        ];

        foreach ($documentFields as $field) {
            if ($this->$field) {
                // Generate unique filename
                $originalExtension = $this->$field->getClientOriginalExtension();
                $filename = $this->generateStaffFilename($field, $this->full_name, $staff->id) . '.' . $originalExtension;
                
                // Store in private folder (not in public)
                $filePath = $this->$field->storeAs('staff-documents', $filename);
                $documentPaths[$field] = $filePath;
            }
        }

        // Update staff record with document paths
        if (!empty($documentPaths)) {
            $staff->update($documentPaths);
        }

        session()->flash('message', 'Staff member added successfully!');

        // Reset form
        $this->reset();
    }

    // Add this method to generate staff initials
    public function getStaffInitials($name)
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

    // Add this method to generate unique filename
    public function generateStaffFilename($fieldName, $staffName, $recordId = null)
    {
        $staffInitials = $this->getStaffInitials($staffName);
        $currentYear = date('y');
        $timestamp = now()->format('Ymd_His');
        
        // Create base filename
        $baseFilename = "staff-details-{$staffInitials}{$currentYear}-{$timestamp}";
        
        // If record ID is available, include it
        if ($recordId) {
            $baseFilename = "staff-details-{$staffInitials}{$currentYear}{$recordId}-{$timestamp}";
        }
        
        // Add field name to make it unique per document type
        $fieldMapping = [
            'cnic_staff' => 'cnic-staff',
            'cnic_mother' => 'cnic-mother',
            'cnic_father' => 'cnic-father',
            'result_card_matric' => 'matric-result',
            'result_card_intermediate' => 'intermediate-result',
            'result_card_bachelors' => 'bachelors-result',
            'utility_bill_copy' => 'utility-bill',
            'resume_cv' => 'resume-cv',
            'one_original_document' => 'original-doc'
        ];
        
        $fieldSlug = $fieldMapping[$fieldName] ?? $fieldName;
        
        return "{$baseFilename}-{$fieldSlug}";
    }

    public function render()
    {
        $roles = [
            'Counsellor',
            'Manager',
            'Admission Manager',
            'Admission Agent',
            'IT Team',
            'IT Manager',
            'FDO',
            'HR Department',
            'Accounts Department'
        ];

        return view('livewire.hr.staff-details.add-staff', compact('roles'))->layout('layouts.hrdashboard');
    }
}