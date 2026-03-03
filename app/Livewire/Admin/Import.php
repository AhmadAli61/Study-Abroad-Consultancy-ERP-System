<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Inquiiry;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

class Import extends Component
{
    use WithFileUploads;
    public bool $isUploading = false;
    public $csv_files = [];
    public $duplicates = [];
    public $showDuplicateModal = false;
    public $successMessage = '';

    public function uploadCsv()
    {
        $this->isUploading = true;

        $this->validate([
            'csv_files.*' => 'required|mimes:csv,txt|max:51200', // 50MB max
        ]);

        $this->isUploading = false;
        $this->duplicates = [];
        $this->successMessage = '';

        foreach ($this->csv_files as $file) {
            $path = $file->store('private/uploads');
            $filePath = storage_path("app/private/{$path}");

            if (!file_exists($filePath)) continue;

            $handle = fopen($filePath, 'r');
            if (!$handle) continue;

            $header = fgetcsv($handle, 1000, ",");
            if (!$header) {
                session()->flash('error', 'CSV file is empty or invalid.');
                fclose($handle);
                continue;
            }

            $header = array_map(fn($h) => strtolower(trim($h)), $header);

            $requiredColumns = [
                'phone number', 'website', 'name', 'email', 'phone number 2',
                'url', 'type', 'remarks', 'graduation', 'country',
                'city', 'future plan', 'english test', 'inquiry status', 'assigned to'
            ];
            foreach ($requiredColumns as $column) {
                if (!in_array($column, $header)) {
                    session()->flash('error', "Missing column: {$column}");
                    fclose($handle);
                    return;
                }
            }

            while ($row = fgetcsv($handle, 1000, ",")) {
                if (count($row) !== count($header)) continue;

                $data = array_map(fn($v) => self::cleanUtf8(trim($v)), array_combine($header, $row));
                if (empty($data['phone number'])) continue;
                
                // Validate type field
              // In your uploadCsv() method, replace the type validation section with:

// Validate type field
$allowedTypes = ['Referral', 'Meta Leads F', 'Meta Leads W', 'Google Leads', 'Event Leads', 'Website Leads', 'TikTok Leads'];
$typeFromCsv = trim($data['type'] ?? '');

// Clean and normalize the type
$typeFromCsv = trim($typeFromCsv, " \t\n\r\0\x0B\"'");

if (!in_array($typeFromCsv, $allowedTypes)) {
    // Try case-insensitive comparison as fallback
    $normalizedCsvType = ucwords(strtolower($typeFromCsv));
    $normalizedAllowed = array_map('ucwords', array_map('strtolower', $allowedTypes));
    
    if (!in_array($normalizedCsvType, $normalizedAllowed)) {
        session()->flash('error', "Invalid type '{$typeFromCsv}' found. Allowed types: " . implode(', ', $allowedTypes) . ".");
        fclose($handle);
        return;
    }
    // If case-insensitive match found, use the correct case from allowed types
    $key = array_search($normalizedCsvType, $normalizedAllowed);
    $data['type'] = $allowedTypes[$key];
}

                $phone = str_replace(' ', '', $data['phone number']);

                if (Inquiiry::where('phone_number', $phone)->exists()) {
                    $this->duplicates[] = (string) $phone;
                    continue;
                }

                // Assigned to logic
                if (is_numeric($data['assigned to']) && $data['assigned to'] > 0) {
                    $assignedUser = User::find($data['assigned to']);
                    if ($assignedUser) {
                        $data['assigned to'] = $assignedUser->id;
    
                        // Inquiry status logic
                        $statusFromCsv = strtolower(trim($data['inquiry status'] ?? ''));
                        if (in_array($statusFromCsv, ['hot', 'cold', 'dead', 'pending'])) {
                            $data['inquiry status'] = $statusFromCsv;
                        } else {
                            $data['inquiry status'] = 'pending';
                        }
    
                    } else {
                        $data['inquiry status'] = 'pending';
                        $data['assigned to'] = null;
                    }
                } else {
                    $statusFromCsv = strtolower(trim($data['inquiry status'] ?? ''));
                    if (in_array($statusFromCsv, ['hot', 'cold', 'dead', 'pending'])) {
                        $data['inquiry status'] = $statusFromCsv;
                    } else {
                        $data['inquiry status'] = 'pending';
                    }
                    $data['assigned to'] = null;
                }

                Inquiiry::updateOrCreate(
                    ['phone_number' => $phone],
                    [
                        'website'         => $data['website'] ?? null,
                        'name'            => $data['name'] ?? null,
                        'email'           => $data['email'] ?? null,
                        'phone_number2'   => $data['phone number 2'] ?? null,
                        'url'             => $data['url'] ?? null,
                        'type'            => $data['type'] ?? null,
                        'response'        => $data['remarks'] ?? null,
                        'study_course'    => $data['graduation'] ?? null,
                        'country'         => $data['country'] ?? null,
                        'budget'          => $data['city'] ?? null,
                        'plan'            => $data['future plan'] ?? null,
                        'extra'           => $data['english test'] ?? null,
                        'inquiry_status'  => $data['inquiry status'],
                        'assigned_to'     => $data['assigned to'] ?? null,
                        'status'          => empty($data['assigned to']) ? 'unassigned' : 'assigned',
                    ]
                );
            }

            fclose($handle);
        }

        if (!empty($this->duplicates)) {
            $this->showDuplicateModal = true;
        } else {
            $this->successMessage = 'All CSV files uploaded and processed successfully.';
            $this->reset(['csv_files']);
            
            // Redirect after successful import without duplicates
            return redirect()->route('admin.import'); // Replace with your actual route name
        }
    }

    public static function cleanUtf8($string)
    {
        return mb_convert_encoding($string, 'UTF-8', 'UTF-8');
    }

    public function maxUploadSizeInKilobytes(): int
    {
        return 512 * 1024; 
    }

    public function skipDuplicates()
    {
        $this->duplicates = [];
        $this->showDuplicateModal = false;
        $this->successMessage = 'CSV files uploaded successfully. Duplicate records were skipped.';
        $this->reset(['csv_files']);
        
        // Redirect after skipping duplicates
        return redirect()->route('admin.import'); // Replace with your actual route name
    }

    public function render()
    {
        return view('livewire.admin.import')->layout('layouts.admindashboard');
    }
}