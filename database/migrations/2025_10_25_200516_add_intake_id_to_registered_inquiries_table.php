<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registered_inquiries', function (Blueprint $table) {
            $table->foreignId('intake_id')->nullable()->after('parent_id')->constrained('intakes')->onDelete('set null');
            $table->timestamp('added_to_intake_at')->nullable()->after('intake_id');
        });
    }

    public function down(): void
    {
        Schema::table('registered_inquiries', function (Blueprint $table) {
            $table->dropForeign(['intake_id']);
            $table->dropColumn(['intake_id', 'added_to_intake_at']);
        });
    }
};