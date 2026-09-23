@extends('layouts.app')

@section('title', 'Статии')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="eyebrow">Статии</div>
            <h1>Практични материали от работата.</h1>
            <p>Полезни материали и кратки насоки.</p>
        </div>
    </section>

    <section class="section tone-white">
        <div class="container">
            @forelse ($articles as $article)
                @if ($loop->first)
                    <div class="article-grid">
                @endif

                <a class="article-card" href="{{ route('articles.show', $article->slug) }}">
                    <div>
                        <span class="tag">Статия</span>
                        <h3>{{ $article->title }}</h3>

                        @if ($article->excerpt)
                            <p>{{ $article->excerpt }}</p>
                        @endif
                    </div>

                    <div class="card-foot">
                        <span>Прочети</span>
                        <span class="arrow">→</span>
                    </div>
                </a>

                @if ($loop->last)
                    </div>
                @endif
            @empty
                <div class="empty-note">Няма публикувани статии.</div>
            @endforelse
        </div>
    </section>

    <section class="cta-band">
        <div class="container">
            <div>
                <div class="eyebrow">Имате въпрос за вашия обект?</div>
                <h2>Ще отговорим конкретно.</h2>
            </div>

            <a class="btn dark" href="{{ route('contact') }}">Свържи се с нас →</a>
        </div>
    </section>
@endsection
