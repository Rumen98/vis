<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('object_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('tagline')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('solution_id')->nullable()->constrained('solutions')->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Начални 4 карти — клиентът после задава решение/текст в админа.
        $defaults = [
            ['title' => 'Къщи и вили', 'description' => 'Защита за дома и близките ви.', 'tagline' => 'Спокойствие и контрол', 'icon' => 'house'],
            ['title' => 'Офиси', 'description' => 'Сигурност и спокойствие за вашия бизнес.', 'tagline' => 'Контрол и ред', 'icon' => 'building'],
            ['title' => 'Заведения', 'description' => 'Дискретност, контрол и безпроблемна работа.', 'tagline' => 'Дискретна сигурност', 'icon' => 'utensils'],
            ['title' => 'Магазини', 'description' => 'Надежден контрол и защита на търговски обекти.', 'tagline' => 'Защита на оборота', 'icon' => 'store'],
        ];

        foreach ($defaults as $i => $d) {
            DB::table('object_solutions')->insert([
                'title' => $d['title'],
                'description' => $d['description'],
                'tagline' => $d['tagline'],
                'icon' => $d['icon'],
                'sort_order' => $i,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('object_solutions');
    }
};
