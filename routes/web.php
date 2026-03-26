<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ArticleController;


Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/services', [ServicesController::class, 'index'])->name('services');

Route::get('/solutions', [PageController::class, 'solutions'])->name('solutions');
Route::get('/why-us', [PageController::class, 'why'])->name('why');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/quote', [PageController::class, 'quote'])->name('quote');


Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');


Route::post('/contact', [LeadController::class, 'storeContact'])->name('contact.store');
Route::post('/quote', [LeadController::class, 'storeQuote'])->name('quote.store');
