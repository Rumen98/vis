<?php

namespace Tests\Feature;

use App\Models\ObjectSolution;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ObjectSolutionTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_renders_object_cards(): void
    {
        // Миграцията сийдва 4 карти по подразбиране.
        $this->get('/')
            ->assertOk()
            ->assertSee('Решения според обекта')
            ->assertSee('Къщи и вили')
            ->assertSee('Спокойствие и контрол');
    }

    public function test_card_links_to_solution_subpage_when_set(): void
    {
        $solution = Solution::create([
            'title' => 'Сигурност за дома',
            'slug' => 'sigurnost-za-doma',
            'solution_type' => Solution::TYPE_BUSINESS,
            'is_active' => true,
        ]);

        ObjectSolution::query()->where('title', 'Къщи и вили')->update([
            'solution_id' => $solution->id,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('/solutions/sigurnost-za-doma');
    }

    public function test_admin_object_solutions_page_renders(): void
    {
        $user = User::factory()->create(['email' => 'admin@viscctv.com']);

        $this->actingAs($user)
            ->get('/admin/object-solutions')
            ->assertOk()
            ->assertSee('Решения според обекта');
    }
}
