<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('solutions', 'article_id')) {
            return;
        }

        // Cross-database compatible: dropForeign generates the correct
        // constraint name on MySQL and rebuilds the table on SQLite.
        Schema::table('solutions', function (Blueprint $table) {
            try {
                $table->dropForeign(['article_id']);
            } catch (\Throwable $e) {
                // Foreign key may not exist. Ignore and continue.
            }
        });

        Schema::table('solutions', function (Blueprint $table) {
            $table->dropColumn('article_id');
        });
    }

    public function down(): void
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->foreignId('article_id')
                ->nullable()
                ->after('icon');
        });

        Schema::table('solutions', function (Blueprint $table) {
            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->nullOnDelete();
        });
    }
};
