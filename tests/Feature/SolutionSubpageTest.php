<?php

namespace Tests\Feature;

use App\Models\Solution;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SolutionSubpageTest extends TestCase
{
    use RefreshDatabase;

    private function makeSolution(): Solution
    {
        return Solution::create([
            'title' => 'Тест решение',
            'slug' => 'test-reshenie',
            'solution_type' => Solution::TYPE_BUSINESS,
            'description' => 'Кратко описание на решението.',
            'body' => '<p>Подробен текст за решението.</p>',
            'is_active' => true,
        ]);
    }

    public function test_solution_subpage_renders(): void
    {
        $this->makeSolution();

        $this->get('/solutions/test-reshenie')
            ->assertOk()
            ->assertSee('Тест решение')
            ->assertSee('Подробен текст за решението');
    }

    public function test_inactive_solution_returns_404(): void
    {
        $s = $this->makeSolution();
        $s->update(['is_active' => false]);

        $this->get('/solutions/test-reshenie')->assertNotFound();
    }

    public function test_admin_solution_edit_form_renders(): void
    {
        $user = User::factory()->create(['email' => 'admin@viscctv.com']);
        $s = $this->makeSolution();

        $this->actingAs($user)
            ->get('/admin/solutions/'.$s->getKey().'/edit')
            ->assertOk()
            ->assertSee('Съдържание на подстраницата');
    }
}
