<?php

namespace Tests\Feature;

use App\Mail\LeadSubmitted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OperationalHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_submissions_are_rate_limited(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'Тестов клиент',
            'phone' => '0888000000',
            'message' => 'Тестово запитване.',
        ];

        foreach (range(1, 5) as $attempt) {
            $this->post('/contact', $payload)->assertRedirect();
        }

        $this->post('/contact', $payload)->assertTooManyRequests();

        Mail::assertSent(LeadSubmitted::class, 5);
    }

    public function test_canonical_and_open_graph_urls_follow_the_current_page(): void
    {
        $this->get('/services')
            ->assertOk()
            ->assertSee('<link rel="canonical" href="http://localhost/services">', false)
            ->assertSee('<meta property="og:url" content="http://localhost/services">', false);
    }
}
