@extends('layouts.app')

@section('title', $service->title)

@section('content')
    @php($heroImage = $service->featured_image ? \Illuminate\Support\Facades\Storage::disk('public')->url($service->featured_image) : null)

    <section class="detail-hero" @if ($heroImage) style="--detail-image:url('{{ $heroImage }}')" @endif>
        <div class="container">
            <nav class="breadcrumbs" aria-label="Навигационна пътека">
                <a href="{{ route('home') }}">Начало</a><span>/</span>
                <a href="{{ route('services') }}">Услуги</a><span>/</span>
                <span>{{ $service->title }}</span>
            </nav>
            <div class="eyebrow">Услуга</div>
            <h1>{{ $service->title }}</h1>
            @if ($service->description)<p>{{ $service->description }}</p>@endif
        </div>
    </section>

    <section class="section tone-white">
        <div class="container">
            <div class="detail-grid">
                <div class="detail-copy">
                    <div class="eyebrow">Какво включва</div>
                    <h2>{{ $service->intro_heading ?: 'Стабилната сигурност започва с ясен план.' }}</h2>
                    <p>{{ $service->intro_text ?: 'Уточняваме обекта, необходимото покритие и начина на работа, преди да предложим конкретна конфигурация.' }}</p>
                    <div style="margin-top:28px"><a class="btn dark" href="{{ route('quote') }}">Запитване за тази услуга →</a></div>
                </div>
                <div class="scope-card">
                    <h3>Типичен обхват</h3>
                    @forelse (($service->bullets ?? []) as $bullet)
                        @php($title = is_array($bullet) ? ($bullet['title'] ?? $bullet['value'] ?? '') : $bullet)
                        @php($text = is_array($bullet) ? ($bullet['text'] ?? '') : '')
                        <div class="scope-item"><div class="no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div><div><b>{{ $title }}</b>@if ($text)<p>{{ $text }}</p>@endif</div></div>
                    @empty
                        <p>Обхватът се определя след оглед на конкретния обект.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    @if (filled($service->body))
        <section class="section tone-soft"><div class="container"><div class="article-shell"><div class="richtext">{!! $service->body !!}</div></div></div></section>
    @endif

    @if ($related->isNotEmpty())
        <section class="section tone-white"><div class="container"><div class="section-head"><div class="copy"><div class="eyebrow">Още услуги</div><h2>Други услуги.</h2></div><a class="btn outline" href="{{ route('services') }}">Всички услуги →</a></div><div class="related-grid">@foreach ($related as $item)<a class="related-card" href="{{ route('services.show', $item->slug) }}"><h3>{{ $item->title }}</h3><b>Виж →</b></a>@endforeach</div></div></section>
    @endif

    <section class="cta-band"><div class="container"><div><div class="eyebrow">Обект в София и региона?</div><h2>Нека планираме системата.</h2></div><a class="btn dark" href="{{ route('quote') }}">Запитване →</a></div></section>
@endsection
