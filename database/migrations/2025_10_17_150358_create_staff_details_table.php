<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('staff_details', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('full_name');
            $table->string('father_name');
            $table->date('date_of_birth');
            $table->string('cnic_number')->unique();
            $table->string('personal_contact_number');
            $table->string('emergency_contact_number');
            $table->text('home_address');
            $table->string('city');
            
            // Document Uploads (file paths)
            $table->string('cnic_staff')->nullable();
            $table->string('cnic_mother')->nullable();
            $table->string('cnic_father')->nullable();
            $table->string('result_card_matric')->nullable();
            $table->string('result_card_intermediate')->nullable();
            $table->string('result_card_bachelors')->nullable();
            $table->string('utility_bill_copy')->nullable();
            $table->string('resume_cv')->nullable();
            $table->string('one_original_document')->nullable();
            
            // Job Details
            $table->string('role');
            $table->date('date_of_joining');
            $table->string('salary_package');
            $table->string('commission')->nullable();
            
            // Updated Bank Details (Split into 2 fields)
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            
            // Updated Company Assets / Access (Split into 4 fields)
            $table->string('assigned_laptop')->nullable();
            $table->string('assigned_laptop_ip')->nullable();
            $table->string('assigned_phone')->nullable();
            $table->string('assigned_phone_ip')->nullable();
            
            // Existing fields
            $table->string('company_phone_number')->nullable();
            $table->string('gmail_password')->nullable();
            $table->string('outlook')->nullable();
            $table->text('portal_credentials')->nullable();
            $table->text('remarks')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_details');
    }
};