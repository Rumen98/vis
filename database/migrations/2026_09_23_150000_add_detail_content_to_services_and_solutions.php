<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['services', 'solutions'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('intro_heading')->nullable()->after('description');
                $table->text('intro_text')->nullable()->after('intro_heading');
                $table->json('problems')->nullable()->after('bullets');
            });
        }
    }

    public function down(): void
    {
        foreach (['services', 'solutions'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn(['intro_heading', 'intro_text', 'problems']);
            });
        }
    }
};
