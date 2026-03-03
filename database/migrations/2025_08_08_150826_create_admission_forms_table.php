<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('inquiry_id')->constrained('inquiiries')->onDelete('cascade');
            $table->foreignId('registered_inquiry_id')->constrained('registered_inquiries')->onDelete('cascade');
            
            // SOP Fields (UnderAssessment → Processed)
            $table->string('sop_path')->nullable();
            $table->string('application_submission')->nullable();
            
            // Conditional Fields (Processed → Conditional)
            $table->text('partner_info')->nullable();
            $table->text('application_portal_info')->nullable();
            $table->text('student_gmail_info')->nullable();
            $table->boolean('conditional_marked_read')->default(false);
            $table->string('conditional_document')->nullable();
            
            // Unconditional Fields (Conditional → Unconditional)
            $table->string('fee_voucher_path')->nullable();
            $table->string('bank_statement_path')->nullable();
            $table->string('interview_pass_path')->nullable();
            $table->string('tb_test_path')->nullable();
            
            // UnderCAS Fields (Unconditional → UnderCAS)
            $table->string('fee_payment_path')->nullable();
            $table->string('extra_undercas_path')->nullable();
            
            // CASReceived Fields (UnderCAS → CASReceived)
            $table->string('cas_document_path')->nullable();
            
            // VisaProcess Fields (CASReceived → VisaProcess)
            $table->string('cnic_path')->nullable();
            $table->string('new_bank_statement_path')->nullable();
            $table->string('visa_history_path')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('parental_consent_letter')->nullable();
            $table->string('funds_source')->nullable();
            
            // Enrollment Fields (VisaProcess → Enrollment)
            $table->string('visa_application_path')->nullable();
            $table->string('appointment_letter_path')->nullable();
            $table->string('decision_letter_path')->nullable();
            $table->string('e_visa_path')->nullable();
            $table->string('student_id_card_path')->nullable();

            //New Fields
            $table->string('application_portal_logins')->nullable();
            $table->string('cas_shield_logins')->nullable();
            $table->string('enrollment_logins')->nullable();
            $table->string('visa_application_links')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_forms');
    }
};