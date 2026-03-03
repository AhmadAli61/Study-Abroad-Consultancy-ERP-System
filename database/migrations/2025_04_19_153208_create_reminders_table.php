<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reminders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->timestamp('reminder_time');
        $table->text('reminder_reason');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
