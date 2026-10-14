<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('<title>Видеонаблюдение София | Монтаж на камери | ВиС</title>', false)
            ->assertSee(
                '<meta name="description" content="Монтаж на видеонаблюдение в София за домове и бизнес. Оглед, ясна оферта, чист монтаж и настройка. Вижте реални обекти на ВиС.">',
                false,
            );

        $this->assertSame(1, substr_count($response->getContent(), '<meta name="description"'));
    }
}
