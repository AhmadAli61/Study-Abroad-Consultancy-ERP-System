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
        Schema::create('inquiiries', function (Blueprint $table) {
            $table->id();
            $table->string('website')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->unique();
            $table->string('url')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->default('unassigned');
            $table->datetime('status_updated_at')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable(); // Stores counselor/manager ID
            $table->text('response')->collation(collation: 'utf8mb4_unicode_ci')->nullable();
            $table->enum('inquiry_status', ['hot', 'cold', 'dead', 'pending' , 'registered'])->default('pending'); // Status for Manager/Counsellor
            $table->datetime('assigned_at')->nullable(); // Stores date of assignmentc
            $table->string('phone_number2')->nullable();
            $table->string('study_course')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('country')->nullable();
            $table->string('budget')->nullable();
            $table->string('plan')->nullable();
            $table->text('extra')->nullable();
            $table->timestamps();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('previous_assigned_to')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiiries');
    }
};
