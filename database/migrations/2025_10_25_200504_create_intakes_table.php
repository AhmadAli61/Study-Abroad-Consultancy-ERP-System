<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intakes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Fall Intake", "September Intake"
            $table->integer('year'); // e.g., 2025, 2026
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            
            // Unique constraint to prevent duplicate intakes
            $table->unique(['name', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intakes');
    }
};