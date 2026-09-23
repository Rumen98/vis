<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceSubpageTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_card_and_its_individual_page_render(): void
    {
        Service::create([
            'title' => 'Тестова услуга',
            'slug' => 'testova-usluga',
            'description' => 'Кратко описание.',
            'body' => '<p>Подробно съдържание.</p>',
            'bullets' => ['Първа точка'],
            'is_active' => true,
        ]);

        $this->get('/services')
            ->assertOk()
            ->assertSee('/services/testova-usluga');

        $this->get('/services/testova-usluga')
            ->assertOk()
            ->assertSee('Тестова услуга')
            ->assertSee('Подробно съдържание.');
    }

    public function test_inactive_service_returns_404(): void
    {
        $service = Service::create([
            'title' => 'Скрита услуга',
            'slug' => 'skrita-usluga',
            'is_active' => false,
        ]);

        $this->get('/services/'.$service->slug)->assertNotFound();
    }

    public function test_admin_service_form_has_hero_image_and_detail_content_fields(): void
    {
        $user = User::factory()->create(['email' => 'admin@viscctv.com']);
        $service = Service::create(['title' => 'Тестова услуга', 'slug' => 'testova-usluga']);

        $this->actingAs($user)->get('/admin/services/'.$service->id.'/edit')
            ->assertOk()
            ->assertSee('Снимка за черната лента зад заглавието')
            ->assertSee('Заглавие на информационната секция');
    }
}
