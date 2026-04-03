<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class BrandPagesTest extends TestCase
{
    protected string $brandsRoot;

    protected function setUp(): void
    {
        parent::setUp();

        $this->brandsRoot = storage_path('framework/testing/brands-feature-'.uniqid());

        File::ensureDirectoryExists($this->brandsRoot);

        config()->set('brand-pages.paths', [
            [
                'directory' => $this->brandsRoot,
                'asset_base' => 'images/brands',
            ],
        ]);

        $this->createBrand(
            'AJAX',
            [
                'AJAX.png' => 10,
                'ajaxhub.png' => 40,
                'ajaxcameras.jpg' => 120,
            ],
            <<<'TEXT'
H1: Ajax технологии за сигурност и автоматизация
Въведение
Ajax е иновативна марка за сигурност и автоматизация.
H2: За бранда Ajax
Ajax предлага лесни за управление системи.
Надеждни безжични решения
Видеонаблюдение и аларми
H2: Продукти и решения
H3: Видеонаблюдение
IP камери с висока резолюция
Отдалечен достъп
CTA бутон: „Запитване за оферта“
TEXT
        );

        $this->createBrand(
            'HIKVISION',
            [
                'HIKVISION.png' => 10,
                'hikvisioncamera.jpg' => 80,
            ],
            <<<'TEXT'
H1: Hikvision технологии за сигурност и автоматизация
Въведение
Hikvision е водещ производител на решения за сигурност.
H2: За бранда Hikvision
Интегрирани решения за видеонаблюдение и контрол.
CTA бутон: „Запитване за оферта“
TEXT
        );
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->brandsRoot);

        parent::tearDown();
    }

    public function test_tehnika_page_lists_brands_without_card_descriptions(): void
    {
        $response = $this->get('/tehnika');

        $response->assertOk();
        $response->assertSee('Техника');
        $response->assertSee('Брандове');
        $response->assertSee('Ajax');
        $response->assertSee('Hikvision');
        $response->assertSee('Виж повече');
        $response->assertDontSee('Ajax е иновативна марка за сигурност и автоматизация.');
        $response->assertDontSee('ajaxcameras.jpg', false);
        $response->assertDontSee('bg-slate-50', false);
        $response->assertSee('<title>Техника | ВиС - Видеонаблюдение и сигурност</title>', false);
        $response->assertSee('/ajax', false);
        $response->assertSee('/hikvision', false);
    }

    public function test_brand_page_renders_on_canonical_slug_route(): void
    {
        $response = $this->get('/ajax');

        $response->assertOk();
        $response->assertSee('Ajax');
        $response->assertSee('За бранда Ajax');
        $response->assertSee('Надеждни безжични решения');
        $response->assertSee('ajaxcameras.jpg', false);
        $response->assertDontSee('bg-slate-50', false);
        $response->assertSee('<title>Ajax | ВиС - Видеонаблюдение и сигурност</title>', false);
    }

    public function test_legacy_brand_url_redirects_to_canonical_slug(): void
    {
        $response = $this->get('/brands/AJAX');

        $response->assertRedirect('/ajax');
    }

    private function createBrand(string $folder, array $images, string $documentContent): void
    {
        $directory = $this->brandsRoot.DIRECTORY_SEPARATOR.$folder;

        File::ensureDirectoryExists($directory);

        foreach ($images as $file => $size) {
            File::put($directory.DIRECTORY_SEPARATOR.$file, str_repeat('a', $size));
        }

        File::put($directory.DIRECTORY_SEPARATOR."TEXT {$folder}.docx", $documentContent);
    }
}
