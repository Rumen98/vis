<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\Solution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DetailContentAndMediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_detail_renders_editable_structured_content(): void
    {
        $service = Service::create([
            'title' => 'Тестова услуга', 'slug' => 'testova-usluga', 'is_active' => true,
            'intro_heading' => 'Заглавие на секцията', 'intro_text' => 'Подробен текст за услугата.',
            'bullets' => [['title' => 'Първа точка', 'text' => 'Обяснение към точката.']],
        ]);

        $this->get('/services/'.$service->slug)->assertOk()
            ->assertSee('Заглавие на секцията')->assertSee('Обяснение към точката.');
    }

    public function test_solution_detail_renders_problems_and_scope(): void
    {
        $solution = Solution::create([
            'title' => 'Тестово решение', 'slug' => 'testovo-reshenie',
            'solution_type' => Solution::TYPE_BUSINESS, 'is_active' => true,
            'intro_heading' => 'Реален проблем', 'intro_text' => 'Контекст за решението.',
            'problems' => [['title' => 'Проблем', 'text' => 'Описание на проблема.']],
            'bullets' => [['title' => 'Компонент', 'text' => 'Описание на компонента.']],
        ]);

        $this->get('/solutions/'.$solution->slug)->assertOk()
            ->assertSee('Реален проблем')->assertSee('Описание на проблема.')->assertSee('Описание на компонента.');
    }

    public function test_replacing_or_deleting_a_detail_page_removes_its_old_hero_file(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('services/old.jpg', 'old image');
        Storage::disk('public')->put('services/new.jpg', 'new image');

        $service = Service::create(['title' => 'Услуга', 'slug' => 'usluga', 'featured_image' => 'services/old.jpg']);
        $service->update(['featured_image' => 'services/new.jpg']);
        Storage::disk('public')->assertMissing('services/old.jpg');

        $service->delete();
        Storage::disk('public')->assertMissing('services/new.jpg');
    }
}
