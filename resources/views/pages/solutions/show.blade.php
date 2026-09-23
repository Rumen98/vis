@extends('layouts.app')

@section('title', $solution->title)

@section('content')
    @php($heroImage = $solution->featured_image ? \Illuminate\Support\Facades\Storage::disk('public')->url($solution->featured_image) : null)

    <section class="detail-hero" @if ($heroImage) style="--detail-image:url('{{ $heroImage }}')" @endif>
        <div class="container">
            <nav class="breadcrumbs" aria-label="Навигационна пътека">
                <a href="{{ route('home') }}">Начало</a>
                <span>/</span>
                <a href="{{ route('solutions') }}">Решения</a>
                <span>/</span>
                <span>{{ $solution->title }}</span>
            </nav>

            <div class="eyebrow">Решение</div>
            <h1>{{ $solution->title }}</h1>

            @if ($solution->description)
                <p>{{ $solution->description }}</p>
            @endif
        </div>
    </section>

    @if (! empty($solution->problems))
        <section class="section tone-white">
            <div class="container">
                <div class="problem-wrap">
                    <div class="problem-copy">
                        <div class="eyebrow">Какви проблеми решаваме?</div>
                        <h2>{{ $solution->intro_heading ?: 'Сигурността трябва да решава реален проблем.' }}</h2>
                        @if ($solution->intro_text)<p>{{ $solution->intro_text }}</p>@endif
                    </div>
                    <div class="problem-grid">
                        @foreach ($solution->problems as $problem)
                            <article class="problem-card"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $problem['title'] ?? '' }}</h3><p>{{ $problem['text'] ?? '' }}</p></article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="section tone-white">
        <div class="container">
            <div class="detail-grid">
                <div class="detail-copy">
                    <div class="eyebrow">Какво включва</div>
                    <h2>{{ $solution->problems ? 'Една система. Ясна логика.' : ($solution->intro_heading ?: 'Една система. Ясна логика.') }}</h2>

                    <p>
                        Планираме обхвата според обекта, рисковите зони и начина, по който се използва.
                        Изпратете запитване и ще уточним конфигурацията.
                    </p>

                    <div style="margin-top:28px;display:flex;flex-wrap:wrap;gap:12px">
                        <a class="btn dark" href="{{ route('quote') }}">Запитване за решение →</a>
                        <a class="btn outline" href="{{ route('contact') }}">Свържи се с нас</a>
                    </div>
                </div>

                <div class="scope-card">
                    <h3>Компоненти</h3>

                    @if (! empty($solution->bullets))
                        <div class="scope-list">@foreach ($solution->bullets as $bullet) @php($title = is_array($bullet) ? ($bullet['title'] ?? $bullet['value'] ?? '') : $bullet) @php($text = is_array($bullet) ? ($bullet['text'] ?? '') : '') <div class="scope-item"><div class="no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div><div><b>{{ $title }}</b>@if ($text)<p>{{ $text }}</p>@endif</div></div> @endforeach</div>
                    @else
                        <p>Обхватът се определя след оглед на конкретния обект.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if (filled($solution->body))
        <section class="section tone-soft">
            <div class="container">
                <div class="article-shell">
                    <div class="richtext">
                        {!! $solution->body !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($related->count())
        <section class="section tone-white">
            <div class="container">
                <div class="section-head">
                    <div class="copy">
                        <div class="eyebrow">Още решения</div>
                        <h2>Други решения.</h2>
                    </div>

                    <a class="btn outline" href="{{ route('solutions') }}">Всички решения →</a>
                </div>

                <div class="related-grid">
                    @foreach ($related as $item)
                        <a class="related-card" href="{{ route('solutions.show', $item->slug) }}">
                            <h3>{{ $item->title }}</h3>
                            <b>Виж →</b>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="cta-band">
        <div class="container">
            <div>
                <div class="eyebrow">Обект в София и региона?</div>
                <h2>Нека планираме системата.</h2>
            </div>

            <a class="btn dark" href="{{ route('quote') }}">Запитване →</a>
        </div>
    </section>
@endsection
