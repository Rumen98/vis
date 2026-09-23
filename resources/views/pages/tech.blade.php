@extends('layouts.app')

@section('title', 'Техника')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="eyebrow">Техника</div>
            <h1>Марки, които избираме според задачата.</h1>
            <p>
                Работим с доказани световни производители, за да гарантираме надеждност и дългосрочна сигурност.
                Тук може да научите повече за технологиите и част от марките, които използваме при изграждането
                на нашите решения.
            </p>
        </div>
    </section>

    <section class="section tone-white">
        <div class="container">
            <div class="section-head">
                <div class="copy">
                    <div class="eyebrow">Брандове</div>
                    <h2>Технологията е инструмент. Решението е системата.</h2>
                </div>

                <p class="lead">
                    Натиснете върху марка, за да видите къде я използваме, какво предлага и за какви обекти
                    е подходяща.
                </p>
            </div>

            @forelse ($brands as $brand)
                @if ($loop->first)
                    <div class="brand-grid">
                @endif

                <x-brand-card :brand="$brand" />

                @if ($loop->last)
                    </div>
                @endif
            @empty
                <div class="empty-note">
                    Не бяха открити папки с марки. Добави папки в `public/images/brands` или `public/brands`,
                    за да се появят автоматично тук.
                </div>
            @endforelse
        </div>
    </section>

    {{-- РЕАЛНИ КАДРИ (нова секция от редизайна) --}}
    @php
        $footage = collect([
            [
                'brand' => 'Hikvision',
                'slug' => 'hikvision',
                'video' => 'videos/hikvision-ptz.mp4',
                'poster' => 'videos/posters/hikvision-ptz.jpg',
                'text' => 'PTZ, оптично приближение и работа в реална среда.',
            ],
            [
                'brand' => 'Dahua',
                'slug' => 'dahua',
                'video' => 'videos/dahua-ptz.mp4',
                'poster' => 'videos/posters/dahua-ptz.jpg',
                'text' => 'Реални кадри, аналитични функции и работа на системата на обект.',
            ],
        ])->filter(fn (array $item): bool => file_exists(public_path($item['video'])));
    @endphp

    @if ($footage->isNotEmpty())
        <section class="section tech-footage tone-soft" id="real-footage">
            <div class="container">
                <div class="section-head">
                    <div class="copy">
                        <div class="eyebrow">Реални кадри</div>
                        <h2>Виж какво може техниката в реална среда.</h2>
                    </div>

                    <p class="lead">
                        Кратки демонстрации и реални кадри. Оттук можете да отворите страницата на
                        конкретната марка и да разгледате решенията ѝ.
                    </p>
                </div>

                <div class="tech-footage-grid">
                    @foreach ($footage as $item)
                        <article class="tech-footage-card">
                            <div class="tech-footage-media">
                                <video controls playsinline preload="metadata"
                                    aria-label="Реални кадри от {{ $item['brand'] }} PTZ камера"
                                    @if (file_exists(public_path($item['poster']))) poster="{{ asset($item['poster']) }}" @endif>
                                    <source src="{{ asset($item['video']) }}" type="video/mp4">
                                    Вашият браузър не поддържа видео.
                                </video>

                                <span class="tech-footage-badge">{{ mb_strtoupper($item['brand']) }} / REAL FOOTAGE</span>
                            </div>

                            <div class="tech-footage-copy">
                                <h3>{{ $item['brand'] }}</h3>
                                <p>{{ $item['text'] }}</p>

                                <a class="btn light" href="{{ route('brands.show', ['brand' => $item['slug']]) }}">
                                    Виж {{ $item['brand'] }} →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="tech-footage-contact">
                    <span>Търсите конкретен модел или искате да видите подходящо решение?</span>
                    <a class="btn primary" href="{{ route('contact') }}">Свържи се с нас →</a>
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
