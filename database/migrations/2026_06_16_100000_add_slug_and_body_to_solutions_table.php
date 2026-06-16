<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->longText('body')->nullable()->after('description');
        });

        // Генерира slug за съществуващите решения (с гарантирана уникалност).
        $used = [];

        foreach (DB::table('solutions')->orderBy('id')->get() as $solution) {
            $base = Str::slug((string) $solution->title);

            if ($base === '') {
                $base = 'reshenie-'.$solution->id;
            }

            $slug = $base;
            $i = 2;

            while (in_array($slug, $used, true)) {
                $slug = $base.'-'.$i++;
            }

            $used[] = $slug;

            DB::table('solutions')->where('id', $solution->id)->update(['slug' => $slug]);
        }

        Schema::table('solutions', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'body']);
        });
    }
};
