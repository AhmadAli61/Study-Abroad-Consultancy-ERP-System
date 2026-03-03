<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registered_inquiries', function (Blueprint $table) {
            $table->id();
            // Add to your registered_inquiries migration
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            $table->string('unique_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('registered_inquiries')->onDelete('cascade');
            $table->foreignId('inquiry_id')->constrained('inquiiries')->onDelete('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->string('passport_number');
            $table->string('student_name');
            $table->string('student_contact');
            $table->string('emergency_contact_1');
            $table->string('emergency_contact_2')->nullable();
            $table->string('course_name');
            $table->string('course_intake');
            $table->string('course_link');
            $table->string('gmail_password');
            $table->string('university_name');
            $table->string('inquiry_status')->default('underassessment');
            $table->datetime('status_change_time')->nullable();
            $table->string('last_inquiry_status')->nullable();
            $table->text('partner')->nullable();

            
            // New columns
            $table->datetime('assigned_at')->nullable(); // Stores date of assignmentc
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->string('status')->default('unassigned');
            $table->timestamp('status_updated_at')->nullable();
            $table->unsignedBigInteger('previous_assigned_to')->nullable();
            $table->timestamp('previous_assigned_at')->nullable();

            
            // Document paths
            $table->string('matric_dmc_path');
            $table->string('intermediate_dmc_path');
            $table->string('bs_hons_path')->nullable();
            $table->string('ba_bsc_path')->nullable();
            $table->string('ma_msc_path')->nullable();
            $table->string('reference_letters_path')->nullable();
            $table->enum('has_refusal_letter', ['yes', 'no'])->default('no');
            $table->string('cv_file_path');
            $table->string('passport_pages_path');
            $table->string('experience_letter_path')->nullable();
            $table->string('english_test_path')->nullable();
            $table->string('agent_consent_path');
            $table->string('student_consent_path')->nullable();
            $table->string('additional_docs_path')->nullable();
            $table->string('extra_path')->nullable();
            $table->string('extra2_path')->nullable();
            $table->string('extra3_path')->nullable();
            $table->string('extra4_path')->nullable();
            $table->string('extra5_path')->nullable();
            $table->string('refusal_letter_path')->nullable();
            $table->longText('notes_history')->nullable();
            $table->text('notes')->nullable();
            
            // New extra columns
            $table->string('extra6_path')->nullable();
            $table->string('extra7_path')->nullable();
            $table->string('extra8_path')->nullable();
            $table->string('extra9_path')->nullable();
            $table->string('extra10_path')->nullable();
            $table->string('extra11_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_inquiries');
    }
};