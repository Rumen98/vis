<?php

namespace Tests\Unit;

use App\Support\BrandCatalog;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class BrandCatalogTest extends TestCase
{
    protected string $brandsRoot;

    protected function setUp(): void
    {
        parent::setUp();

        $this->brandsRoot = storage_path('framework/testing/brands-unit-'.uniqid());

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

    public function test_it_detects_brand_slug_order_and_images(): void
    {
        $catalog = new BrandCatalog;
        $brands = $catalog->all();
        $ajax = $catalog->find('ajax');

        $this->assertSame('hikvision', $brands->first()['slug']);
        $this->assertNotNull($ajax);
        $this->assertSame('AJAX.png', $ajax['logo']['file']);
        $this->assertSame('ajaxcameras.jpg', $ajax['hero_image']['file']);
        $this->assertCount(1, $ajax['section_images']);
        $this->assertSame('ajaxhub.png', $ajax['section_images'][0]['file']);
        $this->assertSame('Ajax технологии за сигурност и автоматизация', $ajax['document_title']);
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
