<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // e.g., 'new_application'
            $table->morphs('notifiable');
            $table->text('data');
            $table->unsignedBigInteger('registered_inquiry_id')->nullable(); // NEW
            $table->unsignedBigInteger('inquiry_id')->nullable(); // NEW
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('registered_inquiry_id')->references('id')->on('registered_inquiries')->onDelete('cascade');
            $table->foreign('inquiry_id')->references('id')->on('inquiiries')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};