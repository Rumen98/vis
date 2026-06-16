<?php

namespace Tests\Feature;

use App\Models\GalleryImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    private function seedGallery(int $count): void
    {
        for ($i = 1; $i <= $count; $i++) {
            GalleryImage::create([
                'image' => "gallery/img-{$i}.jpg",
                'caption' => "Обект {$i}",
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }
    }

    public function test_home_renders_gallery_section(): void
    {
        $this->seedGallery(3);

        $this->get('/')
            ->assertOk()
            ->assertSee('Нашата работа')
            ->assertSee('Обект 1');
    }

    public function test_gallery_load_endpoint_paginates(): void
    {
        $this->seedGallery(12);

        $page1 = $this->getJson('/gallery/load?page=1');
        $page1->assertOk()->assertJson(['hasMore' => true]);
        $this->assertEquals(8, substr_count($page1->json('html'), '<figure'));

        $page2 = $this->getJson('/gallery/load?page=2');
        $page2->assertOk()->assertJson(['hasMore' => false]);
        $this->assertEquals(4, substr_count($page2->json('html'), '<figure'));
    }

    public function test_admin_gallery_page_renders(): void
    {
        $user = User::factory()->create(['email' => 'admin@viscctv.com']);

        $this->actingAs($user)
            ->get('/admin/gallery-images')
            ->assertOk()
            ->assertSee('Галерия');
    }
}
