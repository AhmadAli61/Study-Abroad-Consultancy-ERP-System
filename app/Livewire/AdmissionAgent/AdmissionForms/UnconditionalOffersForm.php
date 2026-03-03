<?php

namespace App\Livewire\AdmissionAgent\AdmissionForms;

use Livewire\Component;
use App\Models\RegisteredInquiry;
use App\Models\AdmissionForm;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UnconditionalOffersForm extends Component
{
    use WithFileUploads;

    public $inquiry_id;
    public $registered_inquiry;
    public $fee_payment;
    public $extra_document;
    
    public $existing_fee_payment;
    public $existing_extra_document;
    public $referrer;

    public function mount($inquiry_id = null)
    {
        $this->inquiry_id = $inquiry_id;
        $this->referrer = url()->previous();
        
        if ($this->inquiry_id) {
            $this->registered_inquiry = RegisteredInquiry::findOrFail($this->inquiry_id);
            
            $admissionForm = AdmissionForm::where('registered_inquiry_id', $this->inquiry_id)->first();
            
            if ($admissionForm) {
                $this->existing_fee_payment = $admissionForm->fee_payment_path;
                $this->existing_extra_document = $admissionForm->extra_undercas_path;
            }
        }
    }

    public function submitDocuments()
    {
        $this->validate([
            'fee_payment' => 'nullable|file|mimes:pdf|max:5120',
            'extra_document' => 'required|file|mimes:pdf|max:5120',
        ]);

        // Store files
        $feePaymentPath = $this->fee_payment ? $this->fee_payment->store('admission-docs') : null;
        $extraDocPath = $this->extra_document ? $this->extra_document->store('admission-docs') : null;

        // Update or create admission form
        AdmissionForm::updateOrCreate(
            ['registered_inquiry_id' => $this->inquiry_id],
            [
                'user_id' => Auth::id(),
                'inquiry_id' => $this->registered_inquiry->inquiry_id,
                'fee_payment_path' => $feePaymentPath,
                'extra_undercas_path' => $extraDocPath,
            ]
        );

        // Update the inquiry status to unconditional
        $this->registered_inquiry->update([
            'inquiry_status' => 'unconditional'
        ]);

        session()->flash('message', 'Documents submitted successfully and status updated to Unconditional!');
        
        // Get the referring URL and add page=1 parameter
        $referrer = $this->referrer ?: route('admission-agent.all-applications');
        $referrer = str_contains($referrer, '?') 
            ? preg_replace('/([?&])page=[^&]*(&|$)/', '$1', $referrer) . 'page=1'
            : $referrer . '?page=1';

        return redirect()->to($referrer);
    }

    public function deleteDocument($type)
    {
        $admissionForm = AdmissionForm::where('registered_inquiry_id', $this->inquiry_id)->first();
        
        if ($admissionForm) {
            $pathField = $type === 'extra_document' ? 'extra_undercas_path' : 'fee_payment_path';
            
            if ($admissionForm->$pathField) {
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
        return view('livewire.admission-agent.admission-forms.unconditional-offers-form')->layout('layouts.admissionagentdashboard');
    }
}