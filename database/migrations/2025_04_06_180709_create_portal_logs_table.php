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
        Schema::create('portal_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('role');
            $table->timestamp('login_time');
            $table->timestamp('logout_time')->nullable();
            $table->string('ip_address');
            $table->string('device');
            $table->boolean('is_logged_in')->default(true);
            $table->string('session_id')->nullable(); // Optional: to track sessions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal_logs');
    }
};
