<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdmissionForm extends Model
{
    protected $fillable = [
        'user_id',
        'inquiry_id',
        'registered_inquiry_id',
        'sop_path',
        'application_submission',
        'partner_info',
        'application_portal_info',
        'conditional_document',
        'student_gmail_info',
        'conditional_marked_read',
        'fee_voucher_path',
        'bank_statement_path',
        'interview_pass_path',
        'tb_test_path',
        'fee_payment_path',
        'extra_undercas_path',
        'cas_document_path',
        'cnic_path',
        'new_bank_statement_path',
        'visa_history_path',
        'birth_certificate',
        'parental_consent_letter',
        'funds_source',
        'visa_application_path',
        'appointment_letter_path',
        'decision_letter_path',
        'e_visa_path',
        'student_id_card_path',
        'application_portal_logins',
        'cas_shield_logins',
        'enrollment_logins',
        'visa_application_links'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiiry::class);
    }

    public function registeredInquiry(): BelongsTo
    {
        return $this->belongsTo(RegisteredInquiry::class);
    }
}