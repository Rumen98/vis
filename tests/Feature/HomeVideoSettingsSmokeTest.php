<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeVideoSettingsSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_video_settings_page_renders(): void
    {
        $user = User::factory()->create(['email' => 'admin@viscctv.com']);

        $this->actingAs($user)
            ->get('/admin/home-video-settings')
            ->assertOk()
            ->assertSee('Видео в началната страница');
    }

    public function test_home_page_renders_video_section(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Научете повече')
            ->assertSee('tools.viscctv.com')
            ->assertDontSee('БАЗОВ');
    }

    public function test_video_button_label_and_url_are_editable(): void
    {
        \App\Models\SiteSetting::current()->update([
            'home_video_button_label' => 'Виж услугите',
            'home_video_button_url' => 'https://viscctv.com/services',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Виж услугите')
            ->assertSee('https://viscctv.com/services')
            ->assertDontSee('Научете повече');
    }

    public function test_video_button_can_be_hidden(): void
    {
        \App\Models\SiteSetting::current()->update([
            'home_video_button_enabled' => false,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('Научете повече');
    }
}
