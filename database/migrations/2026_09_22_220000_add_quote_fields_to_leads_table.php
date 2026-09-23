<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Полетата от подробната форма за оферта в новия дизайн:
 * услуга, район/адрес, предпочитан срок и съгласие за контакт.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table): void {
            if (! Schema::hasColumn('leads', 'service')) {
                $table->string('service')->nullable()->after('object_type');
            }

            if (! Schema::hasColumn('leads', 'area')) {
                $table->string('area')->nullable()->after('service');
            }

            if (! Schema::hasColumn('leads', 'timing')) {
                $table->string('timing')->nullable()->after('area');
            }

            if (! Schema::hasColumn('leads', 'consent')) {
                $table->boolean('consent')->default(false)->after('timing');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table): void {
            foreach (['consent', 'timing', 'area', 'service'] as $column) {
                if (Schema::hasColumn('leads', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
