<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('home_video_button_enabled')->default(true);
            $table->string('home_video_button_label')->nullable();
            $table->string('home_video_button_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'home_video_button_enabled',
                'home_video_button_label',
                'home_video_button_url',
            ]);
        });
    }
};
