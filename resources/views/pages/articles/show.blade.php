@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumbs" aria-label="Навигационна пътека">
                <a href="{{ route('home') }}">Начало</a>
                <span>/</span>
                <a href="{{ route('articles.index') }}">Статии</a>
                <span>/</span>
                <span>{{ $article->title }}</span>
            </nav>

            <div class="eyebrow">Статия</div>
            <h1>{{ $article->title }}</h1>
        </div>
    </section>

    <section class="section tone-white">
        <div class="container">
            <div class="article-shell">
                @if ($article->excerpt)
                    <p class="article-lead">{{ $article->excerpt }}</p>
                @endif

                @if (! empty($article->featured_image))
                    <figure class="article-figure">
                        <img
                            src="{{ asset('storage/' . $article->featured_image) }}"
                            alt="{{ $article->title }}"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                @endif

                <div class="richtext">
                    {!! $article->content !!}
                </div>

                <div class="article-foot">
                    <a class="btn dark" href="{{ route('articles.index') }}">← Всички статии</a>
                    <a class="btn primary" href="{{ route('quote') }}">Запитване за оферта →</a>
                </div>
            </div>
        </div>
    </section>
@endsection
