<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Свързва началните карти „Решения според обекта“ с най-подходящото
     * съществуващо решение (по ключови думи в заглавието), за да водят
     * директно към конкретната подстраница. Клиентът може да го смени
     * от админ панела по всяко време.
     */
    public function up(): void
    {
        $map = [
            'Къщи и вили' => ['за дома', 'къщ', 'вила', 'жилищн'],
            'Офиси' => ['офис'],
            'Заведения' => ['ресторант', 'заведен', 'салон'],
            'Магазини' => ['магазин', 'търговск'],
        ];

        foreach ($map as $cardTitle => $keywords) {
            $card = DB::table('object_solutions')->where('title', $cardTitle)->first();

            // Не пипаме, ако картата вече е свързана ръчно.
            if (! $card || $card->solution_id) {
                continue;
            }

            foreach ($keywords as $keyword) {
                $solution = DB::table('solutions')
                    ->where('is_active', true)
                    ->where('title', 'like', '%'.$keyword.'%')
                    ->orderBy('sort_order')
                    ->first();

                if ($solution) {
                    DB::table('object_solutions')
                        ->where('id', $card->id)
                        ->update(['solution_id' => $solution->id]);

                    break;
                }
            }
        }
    }

    public function down(): void
    {
        // Връща картите към „без връзка“ (общи решения).
        DB::table('object_solutions')
            ->whereIn('title', ['Къщи и вили', 'Офиси', 'Заведения', 'Магазини'])
            ->update(['solution_id' => null]);
    }
};
