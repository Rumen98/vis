@extends('layouts.app')

@section('title', 'Начало')

@section('body-class', 'home-page')

@section('preload')
    <link rel="preload" as="image" href="{{ asset('/images/hero/hero.webp') }}" type="image/webp">
@endsection

@section('content')

    @php
        // Текстовете под номерата остават същите — само подредбата е нова.
        $approach = [
            ['title' => 'Оглед', 'note' => 'и конкретни препоръки'],
            ['title' => 'Монтаж', 'note' => 'чисто и тествано'],
            ['title' => 'Настройка', 'note' => 'достъп от телефон'],
            ['title' => 'Поддръжка', 'note' => 'при нужда'],
        ];

        // --- Нови блокове от редизайна ---
        $heroMicro = [
            'Камери, аларми, достъп и мрежи',
            'Решение според обекта и бюджета',
            'Съвместими системи, настроени да работят заедно',
            'Сервиз, разширение и надграждане',
        ];

        $problems = [
            [
                'title' => 'Притеснявате се от кражби и вандализъм?',
                'text' => 'Домът или обектът остават без надзор, когато ви няма. Камерите ви дават контрол и запис при инцидент.',
            ],
            [
                'title' => 'Не знаете кой влиза и излиза?',
                'text' => 'Служители, посетители, доставки. Виждате кой е бил в обекта и кога, включително през телефона си.',
            ],
            [
                'title' => 'Случват се щети и няма как да ги докажете?',
                'text' => 'Ударена кола, повредено имущество или спор на обекта. Записът показва какво реално се е случило.',
            ],
            [
                'title' => 'Искате да знаете навреме, а не след това?',
                'text' => 'При движение или зададено събитие получавате известие директно на телефона и можете да реагирате.',
            ],
        ];

        $areas = ['София', 'Банкя', 'Божурище', 'Костинброд', 'Елин Пелин', 'Околни населени места'];

        $processSteps = [
            [
                'no' => '01',
                'title' => 'Запитване',
                'text' => 'Кратко описание на обекта и нуждите.',
                'icon' => 'icons/iconiHomePage/HomePageProccessTab/64pxzapitvane.png',
            ],
            [
                'no' => '02',
                'title' => 'Оглед и оферта',
                'text' => 'Предложение с оборудване и план за монтаж.',
                'icon' => 'icons/iconiHomePage/HomePageProccessTab/64pxogled.png',
            ],
            [
                'no' => '03',
                'title' => 'Монтаж и тест',
                'text' => 'Инсталация, настройки и кратко обучение.',
                'icon' => 'icons/iconiHomePage/HomePageProccessTab/64pwork.png',
            ],
        ];
    @endphp

    {{-- HERO --}}
    <section class="hero" style="--hero-image:url('{{ asset('/images/hero/hero.webp') }}')">
        <div class="container">
            <div class="hero-copy">
                <div class="eyebrow">Правилният избор за твоята сигурност</div>

                <h1>
                    <span class="hero-line">Видеонаблюдение,</span>
                    <span class="signal-line">системи за</span>
                    <span class="signal-line">сигурност и</span>
                    <span class="hero-line">комуникация</span>
                </h1>

                <p>
                    Проектираме и изграждаме надеждни решения за домове, офиси и обекти. Ясна оферта,
                    чист монтаж и поддръжка.
                </p>

                <p class="hero-location">Работим в <strong>София и региона</strong>.</p>

                <div class="hero-actions">
                    <a class="btn ghost" href="{{ route('services') }}">Услуги</a>
                    <a class="btn primary" href="{{ route('quote') }}">Запитване за оферта →</a>
                    <a class="btn ghost" href="https://tools.viscctv.com" target="_blank" rel="noopener">Планирай система</a>
                </div>

                <div class="hero-micro">
                    @foreach ($heroMicro as $micro)
                        <span>{{ $micro }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ПОДХОД — същите 4 стъпки, в новата лента под хероя --}}
    <section class="trust-strip">
        <div class="container trust-grid">
            @foreach ($approach as $item)
                <div class="trust-item">
                    <strong>{{ $item['title'] }}</strong>
                    <small>{{ $item['note'] }}</small>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ПРОБЛЕМИ, КОИТО РЕШАВАМЕ (нова секция от редизайна) --}}
    <section class="section home-light problems-home">
        <div class="container">
            <div class="section-head">
                <div class="copy">
                    <div class="eyebrow">Проблеми, които решаваме</div>
                    <h2>Контрол там, където има значение.</h2>
                </div>

                <p class="lead">
                    Не започваме от камерата. Започваме от това какво искате да виждате, доказвате и контролирате.
                </p>
            </div>

            <div class="problem-home-grid problem-home-grid-4">
                @foreach ($problems as $problem)
                    <article class="problem-home-card">
                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $problem['title'] }}</h3>
                        <p>{{ $problem['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- РЕШЕНИЯ СПОРЕД ОБЕКТА — админ-управляеми --}}
    @if ($objectSolutions->isNotEmpty())
        <section class="section home-soft solutions-home">
            <div class="container">
                <div class="section-head">
                    <div class="copy">
                        <div class="eyebrow">Решения според обекта</div>
                        <h2>Подходящо решение за всеки тип обект.</h2>
                    </div>

                    <a class="btn outline" href="{{ route('solutions') }}">Виж всички решения →</a>
                </div>

                <div class="object-grid">
                    @foreach ($objectSolutions as $index => $card)
                        <a class="object-card" href="{{ $card->url() }}">
                            <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} /</span>

                            <h3>{{ $card->title }}</h3>

                            @if ($card->description)
                                <p>{{ $card->description }}</p>
                            @endif

                            <b>{{ $card->tagline ?: 'Научете повече' }} →</b>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- УСЛУГИ --}}
    @if (isset($homeServices) && $homeServices->count())
        <section class="section home-dark services-home">
            <div class="container">
                <div class="section-head">
                    <div class="copy">
                        <div class="eyebrow">Услуги</div>
                        <h2>Какво предлагаме.</h2>
                    </div>

                    <p class="lead">
                        От камерите и охраната до мрежата и достъпа. Всяка услуга води към страницата с повече
                        информация.
                    </p>
                </div>

                <div class="service-plain-grid">
                    @foreach ($homeServices as $index => $service)
                        <a
                            class="service-plain-card @if ($loop->first || $loop->last) service-plain-card-wide @endif"
                            href="{{ route('services.show', $service->slug) }}"
                        >
                            <span class="service-code">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} / Услуга</span>

                            <h3>{{ $service->title }}</h3>

                            @if (! empty($service->description))
                                <p>{{ $service->description }}</p>
                            @endif

                            <b>Научи повече →</b>
                        </a>
                    @endforeach
                </div>

                <div class="service-all-link">
                    <a class="btn light" href="{{ route('services') }}">Виж всичките ни услуги →</a>
                </div>
            </div>
        </section>
    @endif

    {{-- ВИДЕО ПРЕЗЕНТАЦИЯ --}}
    @php
        $siteSetting = \App\Models\SiteSetting::current();

        $homeVideoUrl = $siteSetting->home_video_path
            ? \Illuminate\Support\Facades\Storage::disk('public')->url($siteSetting->home_video_path)
            : (file_exists(public_path('videos/home.mp4')) ? asset('videos/home.mp4') : null);

        $homeVideoPoster = $siteSetting->home_video_poster
            ? \Illuminate\Support\Facades\Storage::disk('public')->url($siteSetting->home_video_poster)
            : (file_exists(public_path('videos/home-poster.jpg')) ? asset('videos/home-poster.jpg') : null);
    @endphp

    @if ($homeVideoUrl || $homeVideoPoster)
        <section class="section home-light video-simple-section">
            <div class="container">
                <div class="section-head">
                    <div class="copy">
                        <div class="eyebrow">На фокус този месец</div>
                        <h2>Под лупата на ВиС</h2>
                    </div>

                    <p class="lead">
                        Всеки месец избираме една тема - камера, система, функция или реален казус от
                        практиката. Показваме как работи, какво е важно и къде има смисъл от нея.
                    </p>
                </div>

                <div class="simple-video-shell">
                    @if ($homeVideoUrl)
                        <video autoplay muted loop playsinline preload="metadata"
                            @if ($homeVideoPoster) poster="{{ $homeVideoPoster }}" @endif>
                            <source src="{{ $homeVideoUrl }}" type="video/mp4">
                        </video>
                    @else
                        <img src="{{ $homeVideoPoster }}" alt="" style="width:100%;aspect-ratio:16/9;object-fit:cover">
                    @endif

                    <div class="simple-video-meta">
                        <div>
                            <span>ВиС - Видеонаблюдение и сигурност</span>
                            <strong>Твоят доверен партньор за сигурността.</strong>
                        </div>

                        @if ($siteSetting->videoButtonEnabled())
                            <a class="btn outline" href="{{ $siteSetting->videoButtonUrl() }}" target="_blank"
                                rel="noopener">
                                {{ $siteSetting->videoButtonLabel() }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ПРОЦЕС --}}
    <section class="section home-dark process-home">
        <div class="container">
            <div class="eyebrow">Процес</div>
            <h2 style="margin:14px 0 18px">Прост и работещ процес.</h2>
            <p class="lead" style="margin-bottom:48px">Без излишни обещания, само ясни стъпки.</p>

            <div class="process process-3">
                @foreach ($processSteps as $step)
                    <div class="process-step">
                        <div class="no">{{ $step['no'] }}</div>
                        <h4>{{ $step['title'] }}</h4>
                        <p>{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta-band">
        <div class="container">
            <div>
                <div class="eyebrow">Имате обект?</div>
                <h2>Да го направим правилно.</h2>
                <p>
                    Опишете какво искате да защитите. Ще върнем насока, ориентировъчна оферта или
                    предложение за оглед.
                </p>
            </div>

            <a class="btn dark" href="{{ route('quote') }}">Запитване за оферта →</a>
        </div>
    </section>

    {{-- GOOGLE ОТЗИВИ --}}
    @php($googleReviews = config('google-reviews'))

    <x-google-reviews
        :profile-url="$googleReviews['profile_url']"
        :reviews="$googleReviews['reviews']"
    />

    {{-- ГАЛЕРИЯ „Нашата работа" — админ-управляема, lazy-load --}}
    @if ($galleryImages->isNotEmpty())
        <section class="section home-dark gallery-home">
            <div class="container">
                <div class="section-head">
                    <div class="copy">
                        <div class="eyebrow">Реализирани обекти</div>
                        <h2>Нашата работа.</h2>
                    </div>

                    <div class="gallery-controls">
                        <button type="button" class="slider-btn" data-scroll-target="gallery-strip" data-dir="-1"
                            aria-label="Назад">←</button>
                        <button type="button" class="slider-btn" data-scroll-target="gallery-strip" data-dir="1"
                            aria-label="Напред">→</button>
                    </div>
                </div>

                <div class="gallery-shell">
                    <div class="gallery-track" id="gallery-strip" data-has-more="{{ $galleryHasMore ? '1' : '0' }}">
                        @include('partials.gallery-list', ['images' => $galleryImages])
                    </div>
                </div>

                @if ($galleryHasMore)
                    <div class="gallery-more">
                        <button type="button" id="gallery-more" class="btn light" data-page="2">Виж още</button>
                    </div>
                @endif
            </div>
        </section>

        <script nonce="{{ Vite::cspNonce() }}">
            (function () {
                var strip = document.getElementById('gallery-strip');
                if (!strip) return;

                var page = 2;
                var hasMore = strip.getAttribute('data-has-more') === '1';
                var loading = false;
                var moreBtn = document.getElementById('gallery-more');

                function loadMore() {
                    if (loading || !hasMore) return;
                    loading = true;
                    if (moreBtn) moreBtn.disabled = true;

                    fetch('{{ route('gallery.load') }}?page=' + page, { headers: { 'Accept': 'application/json' } })
                        .then(function (r) { return r.json(); })
                        .then(function (data) {
                            strip.insertAdjacentHTML('beforeend', data.html);
                            hasMore = !!data.hasMore;
                            page += 1;
                            loading = false;
                            if (moreBtn) {
                                if (hasMore) { moreBtn.disabled = false; }
                                else { moreBtn.remove(); }
                            }
                        })
                        .catch(function () { loading = false; if (moreBtn) moreBtn.disabled = false; });
                }

                // Lazy-load при достигане на края на лентата
                strip.addEventListener('scroll', function () {
                    if (strip.scrollLeft + strip.clientWidth >= strip.scrollWidth - 300) {
                        loadMore();
                    }
                });

                if (moreBtn) moreBtn.addEventListener('click', loadMore);
            })();
        </script>
    @endif

    {{-- РАЙОН НА РАБОТА (нова секция от редизайна) --}}
    <section class="section home-light area-home">
        <div class="container">
            <div class="area-box">
                <div class="area-copy">
                    <div class="eyebrow">Район на работа</div>
                    <h2 style="margin:14px 0 20px">София и околните райони.</h2>

                    <p class="lead">
                        Работим с частни клиенти, жилищни сгради и малък/среден бизнес. За по-големи обекти
                        извън София обсъждаме проекта според мащаба.
                    </p>

                    <div class="area-list">
                        @foreach ($areas as $area)
                            <span>{{ $area }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="area-map" aria-hidden="true">
                    <span class="map-pin"></span>
                </div>
            </div>
        </div>
    </section>

    {{-- СТАТИИ --}}
    <section class="section home-light">
        <div class="container">
            <div class="section-head">
                <div class="copy">
                    <div class="eyebrow">Статии</div>
                    <h2>Вижте всички новости в света на охранителните системи тук.</h2>
                </div>

                <p class="lead">Статии, съвети и тенденции за видеонаблюдение и сигурност.</p>
            </div>

            <a class="btn dark" href="{{ route('articles.index') }}">Към статиите →</a>
        </div>
    </section>

@endsection
