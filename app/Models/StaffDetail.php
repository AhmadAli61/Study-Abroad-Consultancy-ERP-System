<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
{
    use HasFactory;

    protected $table = 'staff_details';

    protected $fillable = [
        'full_name',
        'father_name',
        'date_of_birth',
        'cnic_number',
        'personal_contact_number',
        'emergency_contact_number',
        'home_address',
        'city',
        'cnic_staff',
        'cnic_mother',
        'cnic_father',
        'result_card_matric',
        'result_card_intermediate',
        'result_card_bachelors',
        'utility_bill_copy',
        'resume_cv',
        'one_original_document',
        'role',
        'date_of_joining',
        'salary_package',
        'commission',
        // Updated fields
        'bank_name',
        'account_number',
        'assigned_laptop',
        'assigned_laptop_ip',
        'assigned_phone',
        'assigned_phone_ip',
        // Existing fields
        'company_phone_number',
        'gmail_password',
        'outlook',
        'portal_credentials',
        'remarks',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_joining' => 'date',
    ];
}