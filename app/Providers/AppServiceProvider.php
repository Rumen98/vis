<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Fix for older MySQL/MariaDB (key length limit with utf8mb4)
        Schema::defaultStringLength(191);

        // Позволява качване на по-големи файлове (видеоклип) през админ панела.
        // По подразбиране Livewire ограничава временните качвания до 12 MB.
        config([
            'livewire.temporary_file_upload.rules' => ['required', 'file', 'max:204800'], // 200 MB
        ]);
    }
}
