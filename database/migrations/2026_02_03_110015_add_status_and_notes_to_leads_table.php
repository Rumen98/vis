<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {

            if (! Schema::hasColumn('leads', 'status')) {
                $table->string('status')->default('new')->after('email');
            }

            if (! Schema::hasColumn('leads', 'admin_note')) {
                $table->text('admin_note')->nullable()->after('status');
            }

            // ⚠️ Тук ти гърми – защото вече съществува в create миграцията
            if (! Schema::hasColumn('leads', 'contacted_at')) {
                $table->timestamp('contacted_at')->nullable()->after('admin_note');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {

            if (Schema::hasColumn('leads', 'contacted_at')) {
                $table->dropColumn('contacted_at');
            }

            if (Schema::hasColumn('leads', 'admin_note')) {
                $table->dropColumn('admin_note');
            }

            if (Schema::hasColumn('leads', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};