<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiiries', function (Blueprint $table) {
            $table->enum('previous_inquiry_status', ['hot', 'cold', 'dead', 'pending', 'registered'])->nullable()->after('inquiry_status');
            $table->datetime('inquiry_status_updated_at')->nullable()->after('previous_inquiry_status');
        });
    }

    public function down(): void
    {
        Schema::table('inquiiries', function (Blueprint $table) {
            $table->dropColumn(['previous_inquiry_status', 'inquiry_status_updated_at']);
        });
    }
};