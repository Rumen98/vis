<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLeadSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_admin_pages_render_with_the_new_quote_fields(): void
    {
        $user = User::factory()->create(['email' => 'admin@viscctv.com']);

        $lead = Lead::create([
            'name' => 'Смоук Тест',
            'phone' => '0888000000',
            'object_type' => 'building',
            'service' => 'Паркинг решения',
            'area' => 'София, Люлин',
            'timing' => 'До месец',
            'consent' => true,
            'message' => 'тест',
            'source' => 'quote',
        ]);

        $this->actingAs($user);

        $this->get('/admin/leads')->assertOk();
        $this->get('/admin/leads/' . $lead->getKey())->assertOk()
            ->assertSee('Паркинг решения')
            ->assertSee('София, Люлин')
            ->assertSee('Жилищна сграда');
        $this->get('/admin/leads/' . $lead->getKey() . '/edit')->assertOk();

        $lead->delete();
    }
}
