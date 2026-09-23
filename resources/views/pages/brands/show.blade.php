@extends('layouts.app')

@section('title', $brand['display_name'])

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumbs" aria-label="Навигационна пътека">
                <a href="{{ route('home') }}">Начало</a>
                <span>/</span>
                <a href="{{ route('tech') }}">Техника</a>
                <span>/</span>
                <span>{{ $brand['display_name'] }}</span>
            </nav>

            <div class="eyebrow">Марка</div>
            <h1>{{ $brand['display_name'] }}</h1>

            @if ($brand['document_title'] !== $brand['display_name'])
                <p>{{ $brand['document_title'] }}</p>
            @endif
        </div>
    </section>

    <section class="section tone-white">
        <div class="container">
            <div class="brand-intro">
                <div class="brand-hero-media">
                    <div class="brand-intro-logo">
                        @if ($brand['logo'])
                            <img
                                src="{{ asset($brand['logo']['asset_path']) }}"
                                alt="{{ $brand['logo']['alt'] }}"
                                loading="lazy"
                                decoding="async"
                            >
                        @else
                            <span style="font-weight:800;font-size:1.4rem">{{ $brand['display_name'] }}</span>
                        @endif
                    </div>

                    @if ($brand['hero_image'])
                        <div class="brand-shot">
                            <img
                                src="{{ asset($brand['hero_image']['asset_path']) }}"
                                alt="{{ $brand['hero_image']['alt'] }}"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    @endif
                </div>

                <div>
                    <div class="eyebrow">За марката</div>

                    <h2 style="margin:14px 0 22px">{{ $brand['display_name'] }}</h2>

                    @foreach ($brand['introduction_paragraphs'] as $paragraph)
                        <p class="lead">{{ $paragraph }}</p>
                    @endforeach

                    @if ($brand['introduction_bullets'])
                        <ul class="brand-section-list">
                            @foreach ($brand['introduction_bullets'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div style="margin-top:28px;display:flex;flex-wrap:wrap;gap:12px">
                        <a class="btn primary" href="{{ route('quote') }}">{{ $brand['button_label'] }}</a>
                        <a class="btn outline" href="{{ route('tech') }}">Към техника</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($brand['sections'] as $index => $section)
        <section @class(['section', 'tone-soft' => $index % 2 === 0, 'tone-white' => $index % 2 !== 0])>
            <div class="container">
                <div class="section-head">
                    <div class="copy">
                        <div class="eyebrow">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} / {{ $brand['display_name'] }}</div>
                        <h2>{{ $section['title'] }}</h2>
                    </div>
                </div>

                @foreach ($section['paragraphs'] as $paragraph)
                    <p class="lead" style="max-width:820px">{{ $paragraph }}</p>
                @endforeach

                @if ($section['bullets'])
                    <ul class="brand-section-list">
                        @foreach ($section['bullets'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </section>
    @endforeach

    @if ($brand['trailing_images'])
        <section class="section tone-white">
            <div class="container">
                <div class="brand-products">
                    @foreach ($brand['trailing_images'] as $image)
                        <div class="brand-shot">
                            <img
                                src="{{ asset($image['asset_path']) }}"
                                alt="{{ $image['alt'] }}"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($otherBrands->isNotEmpty())
        <section class="section tone-soft">
            <div class="container">
                <div class="section-head">
                    <div class="copy">
                        <div class="eyebrow">Още марки</div>
                        <h2>Други марки.</h2>
                    </div>

                    <a class="btn outline" href="{{ route('tech') }}">Цялата техника →</a>
                </div>

                <div class="brand-grid">
                    @foreach ($otherBrands as $otherBrand)
                        <x-brand-card :brand="$otherBrand" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="cta-band">
        <div class="container">
            <div>
                <div class="eyebrow">Имате предпочитана марка?</div>
                <h2>Ще проверим дали е правилният избор.</h2>
            </div>

            <a class="btn dark" href="{{ route('quote') }}">Запитване →</a>
        </div>
    </section>
@endsection
