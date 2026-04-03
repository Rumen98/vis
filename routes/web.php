<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServicesController;
use App\Support\BrandCatalog;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function (): void {
    Route::get('/', 'home')->name('home');
    Route::get('/solutions', 'solutions')->name('solutions');
    Route::get('/tehnika', 'tech')->name('tech');
    Route::get('/why-us', 'why')->name('why');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/quote', 'quote')->name('quote');
    Route::get('/brands/{brand}', 'legacyBrandRedirect')
        ->whereIn('brand', BrandCatalog::legacyRouteKeys());
    Route::get('/{brand}', 'brand')
        ->whereIn('brand', BrandCatalog::routeSlugs())
        ->name('brands.show');
});

Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::redirect('/tech', '/tehnika', 301);

Route::controller(ArticleController::class)
    ->prefix('articles')
    ->name('articles.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('/{slug}', 'show')->name('show');
    });

Route::controller(LeadController::class)->group(function (): void {
    Route::post('/contact', 'storeContact')->name('contact.store');
    Route::post('/quote', 'storeQuote')->name('quote.store');
});
