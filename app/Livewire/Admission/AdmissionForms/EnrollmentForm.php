<?php

namespace App\Livewire\Admission\AdmissionForms;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use App\Models\AdmissionForm;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EnrollmentForm extends Component
{
    use WithFileUploads;

    public $inquiry_id;
    public $registered_inquiry;
    public $student;
    
    // Document fields

    public $decision_letter;
    public $e_visa;
    public $student_id_card;
    
    // Existing document paths
 
    public $existing_decision_letter;
    public $existing_e_visa;
    public $existing_student_id_card;
    
    public $referrer; // To track the referring page

    public function mount($inquiry_id = null)
    {
        $this->inquiry_id = $inquiry_id;
        $this->referrer = url()->previous(); // Store the referring page
        
        if ($this->inquiry_id) {
            $this->registered_inquiry = RegisteredInquiry::findOrFail($this->inquiry_id);
            $this->student = $this->registered_inquiry;
            
            // Check if form already exists
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $this->inquiry_id)
                            ->whereNotNull('decision_letter_path')
                ->first();
            
            if ($admissionForm) {
        
                $this->existing_decision_letter = $admissionForm->decision_letter_path;
                $this->existing_e_visa = $admissionForm->e_visa_path;
                $this->existing_student_id_card = $admissionForm->student_id_card_path;
            }
        }
    }

    public function submitEnrollmentDocuments()
    {
        $this->validate([
        
            'decision_letter' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'e_visa' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'student_id_card' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Store files

        $decisionLetterPath = $this->decision_letter->store('admission-docs');
        $eVisaPath = $this->e_visa->store('admission-docs');
        $studentIdCardPath = $this->student_id_card->store('admission-docs');

        // Update or create admission form
        AdmissionForm::updateOrCreate(
            ['registered_inquiry_id' => $this->inquiry_id],
            [
                'user_id' => Auth::id(),
                'inquiry_id' => $this->registered_inquiry->inquiry_id,

                'decision_letter_path' => $decisionLetterPath,
                'e_visa_path' => $eVisaPath,
                'student_id_card_path' => $studentIdCardPath,
            ]
        );

        // Update the inquiry status to enrollment
        $this->registered_inquiry->update([
            'inquiry_status' => 'enrollment'
        ]);

        session()->flash('message', 'Documents submitted successfully and status updated to Enrollment!');
        
        // Get the referring URL and add page=1 parameter
        $referrer = $this->referrer ?: route('admission.all-applications');
        $referrer = str_contains($referrer, '?') 
            ? preg_replace('/([?&])page=[^&]*(&|$)/', '$1', $referrer) . 'page=1'
            : $referrer . '?page=1';

        return redirect()->to($referrer);
    }

    public function deleteDocument($type)
    {
        $admissionForm = AdmissionForm::where('registered_inquiry_id', $this->inquiry_id)->first();
        
        if ($admissionForm) {
            $pathField = match($type) {

                'decision_letter' => 'decision_letter_path',
                'e_visa' => 'e_visa_path',
                'student_id_card' => 'student_id_card_path',
                default => null
            };
            
            if ($pathField && $admissionForm->$pathField) {
                Storage::delete($admissionForm->$pathField);
                $admissionForm->$pathField = null;
                $admissionForm->save();
                
                $this->{'existing_' . $type} = null;
                $this->{$type} = null;
                
                session()->flash('message', 'Document deleted successfully!');
            }
        }
    }

    public function render()
    {
        return view('livewire.admission.admission-forms.enrollment-form')->layout('layouts.admissiondashboard');
    }
}