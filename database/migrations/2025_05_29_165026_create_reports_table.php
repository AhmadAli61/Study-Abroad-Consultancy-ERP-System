<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
               $table->foreignId('user_id')
                  ->after('id') // Place after the id column
                  ->constrained('users') // Reference the users table
                  ->onDelete('cascade'); // Cascade delete if the user is deleted
            $table->date('date');
            $table->integer('total_inquiries_received')->nullable();
            $table->integer('inbound_calls')->nullable();
            $table->integer('dial_calls')->nullable();
            $table->integer('connect_calls')->nullable();
            $table->integer('interested_followups')->nullable();
            $table->integer('weak_followups')->nullable();
            $table->integer('today_registration')->nullable();
            $table->integer('expected_registration')->nullable();
            $table->integer('total_students')->nullable();
            $table->integer('on_hold_students')->nullable();
            $table->integer('applications_processed')->nullable();
            $table->integer('total_conditional_offers')->nullable();
            $table->integer('total_students_processed')->nullable();
            $table->integer('total_unconditional_offers')->nullable();
            $table->integer('cas_stage_students')->nullable();
            $table->integer('visa_stage_students')->nullable();
            $table->text('gmail_check')->nullable();
            $table->text('gmail_chase_up')->nullable();
            $table->text('miscellaneous_tasks')->nullable();

            // New columns for box data
            $table->integer('total_leads')->nullable();
            $table->integer('hot_leads')->nullable();
            $table->integer('cold_leads')->nullable();
            $table->integer('dead_leads')->nullable();
            $table->integer('pending_leads')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
