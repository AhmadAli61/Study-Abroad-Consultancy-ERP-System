<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'date',
        'user_id',
        'total_inquiries_received',
        'inbound_calls',
        'dial_calls',
        'connect_calls',
        'interested_followups',
        'weak_followups',
        'today_registration',
        'expected_registration',
        'total_students',
        'on_hold_students',
        'applications_processed',
        'total_conditional_offers',
        'total_students_processed',
        'total_unconditional_offers',
        'cas_stage_students',
        'visa_stage_students',
        'gmail_check',
        'gmail_chase_up',
        'miscellaneous_tasks',
        
        // New columns for box data
        'total_leads',
        'hot_leads',
        'cold_leads',
        'dead_leads',
        'pending_leads'
    ];
}
