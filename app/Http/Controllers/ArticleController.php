<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        return view('pages.articles.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::query()
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.articles.show', compact('article'));
    }
}