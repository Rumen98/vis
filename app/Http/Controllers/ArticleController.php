<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()
            ->active()
            ->ordered()
            ->latest('id')
            ->get();

        return view('pages.articles.index', compact('articles'));
    }

    public function show(string $slug): View
    {
        $article = Article::query()
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.articles.show', compact('article'));
    }
}
