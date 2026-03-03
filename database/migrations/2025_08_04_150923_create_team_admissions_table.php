<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_admissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('manager_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('team_admission_agent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('team_admissions')->onDelete('cascade');
            $table->foreignId('agent_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_admission_agent');
        Schema::dropIfExists('team_admissions');
    }
};