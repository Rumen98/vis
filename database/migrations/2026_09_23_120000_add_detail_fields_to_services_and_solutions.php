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
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->string('featured_image')->nullable()->after('description');
            $table->longText('body')->nullable()->after('featured_image');
        });

        $used = [];
        foreach (DB::table('services')->orderBy('id')->get() as $service) {
            $base = Str::slug((string) $service->title) ?: 'usluga-'.$service->id;
            $slug = $base;
            $suffix = 2;
            while (in_array($slug, $used, true)) $slug = $base.'-'.$suffix++;
            $used[] = $slug;
            DB::table('services')->where('id', $service->id)->update(['slug' => $slug]);
        }

        Schema::table('services', function (Blueprint $table) {
            $table->unique('slug');
        });

        Schema::table('solutions', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'featured_image', 'body']);
        });

        Schema::table('solutions', function (Blueprint $table) {
            $table->dropColumn('featured_image');
        });
    }
};
