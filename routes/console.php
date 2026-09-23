<?php

use App\Support\ExportContentImporter;
use Illuminate\Support\Facades\Artisan;

Artisan::command('vis:import-export-content {path? : Път до export папката}', function (?string $path = null): int {
    $path ??= base_path('ViS-site-export-20260916-134556');

    if (! is_dir($path)) {
        $this->error("Не е намерена export папка: {$path}");
        return 1;
    }

    $counts = app(ExportContentImporter::class)->import($path);
    $this->info("Импортирани: {$counts['services']} услуги и {$counts['solutions']} решения.");

    return 0;
})->purpose('Попълва текстовете и hero снимките от ViS-site-export');

use Illuminate\Foundation\Inspiring;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
