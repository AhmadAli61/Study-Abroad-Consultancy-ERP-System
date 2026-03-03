<?php
// database/migrations/xxxx_add_meta_tracking_fields_to_inquiiries.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiiries', function (Blueprint $table) {
            // Meta lead identification
            $table->string('meta_lead_id')->nullable()->index()->after('id');
            $table->string('whatsapp_conversation_id')->nullable()->index()->after('meta_lead_id');
            
            // Ad tracking (critical for country-specific optimization)
            $table->string('ad_id')->nullable()->index()->after('whatsapp_conversation_id');
            $table->string('ad_name')->nullable()->after('ad_id');
            $table->string('campaign_id')->nullable()->index()->after('ad_name');
            $table->string('campaign_name')->nullable()->after('campaign_id');
            $table->string('campaign_country')->nullable()->after('campaign_name'); // UK, US, AU, etc.
            
            // Meta sync tracking
            $table->string('meta_sync_status')->default('pending')->after('campaign_country');
            $table->json('meta_raw_data')->nullable()->after('meta_sync_status');
            $table->datetime('meta_synced_at')->nullable()->after('meta_raw_data');
            $table->integer('meta_sync_attempts')->default(0)->after('meta_synced_at');
        });
    }

    public function down(): void
    {
        Schema::table('inquiiries', function (Blueprint $table) {
            $table->dropColumn([
                'meta_lead_id',
                'whatsapp_conversation_id',
                'ad_id',
                'ad_name',
                'campaign_id',
                'campaign_name',
                'campaign_country',
                'meta_sync_status',
                'meta_raw_data',
                'meta_synced_at',
                'meta_sync_attempts'
            ]);
        });
    }
};