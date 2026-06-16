@extends('layouts.app')

@section('title', 'Начало')

@section('preload')
    <link rel="preload" as="image" href="{{ asset('/images/hero/hero.webp') }}" type="image/webp">
@endsection

@section('content')

    @php
        $stats = [
            [
                'target' => 200,
                'suffix' => '+',
                'label' => 'Изградени системи',
            ],
            [
                'target' => 150,
                'suffix' => '+',
                'label' => 'Доволни клиенти',
            ],
            [
                'target' => 99.9,
                'suffix' => '%',
                'decimals' => 1,
                'label' => 'Стабилност',
            ],
            [
                'target' => 24,
                'suffix' => '/7',
                'label' => 'Сигурност',
            ],
        ];
    @endphp

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-black text-white">
        <picture>
            <source srcset="{{ asset('/images/hero/hero.webp') }}" type="image/webp">
            <img
                src="{{ asset('/images/hero/hero.jpg') }}"
                alt=""
                class="absolute inset-0 h-full w-full object-cover object-[72%_center] opacity-35 md:object-right md:opacity-50"
                aria-hidden="true"
                fetchpriority="high"
            >
        </picture>

        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/95 to-black/55 md:to-black/20" aria-hidden="true">
        </div>

        <div class="relative mx-auto max-w-6xl px-3 py-10 sm:px-4 sm:py-12 md:py-20">
            <p class="text-[10px] uppercase tracking-[0.2em] text-white/70 sm:text-xs">
                Правилният избор за твоята сигурност
            </p>

            <h1 class="mt-4 text-[2rem] font-extrabold leading-[0.92] tracking-[-0.02em] sm:text-5xl md:text-6xl">
                <span class="block">Видеонаблюдение,</span>
                <span class="block text-red-500">системи за</span>
                <span class="block text-red-500">сигурност и</span>
                <span class="block">комуникация</span>
            </h1>

            <p class="mt-5 max-w-xl text-base leading-8 text-white/80 sm:text-lg">
                Проектираме и изграждаме надеждни решения за домове, офиси и обекти. Ясна оферта,
                чист монтаж и поддръжка.
            </p>

            <div class="mt-5 flex items-center gap-2 text-sm text-white/90 sm:text-base">
                <svg class="h-5 w-5 shrink-0 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11Z" stroke-linejoin="round"/>
                    <circle cx="12" cy="10" r="2.5"/>
                </svg>
                <span>Работим в <strong class="font-semibold text-white">София и региона</strong>.</span>
            </div>

            <div class="mt-6 flex flex-col gap-3 sm:mt-8 sm:flex-row">
                <a
                    href="{{ route('services') }}"
                    class="rounded-lg bg-white px-5 py-3 text-center font-semibold text-black"
                >
                    Услуги
                </a>

                <a
                    href="{{ route('quote') }}"
                    class="rounded-lg bg-red-600 px-5 py-3 text-center font-semibold hover:bg-red-500"
                >
                    Запитване за оферта
                </a>

                <a
                    href="https://tools.viscctv.com"
                    target="_blank"
                    rel="noopener"
                    class="rounded-lg border-2 border-red-600 bg-black px-5 py-3 text-center font-semibold text-white transition hover:bg-red-600"
                >
                    Планирай система
                </a>
            </div>
        </div>
    </section>

    {{-- ABOUT / INTRO --}}
    <section>
        <div class="mx-auto max-w-6xl px-4 py-14">
            <div class="grid items-start gap-10 md:grid-cols-2">
                <div>
                    <h2 class="text-2xl font-extrabold md:text-3xl">
                        Изградени за защита. Фокус върху качество и надеждност.
                    </h2>

                    <p class="mt-4 text-slate-600">
                        Работим с доказани производители и сертифицирани решения. Подхождаме практично
                        - какво реално ти трябва, как да се позиционира и как да се поддържа.
                    </p>

                    <div class="mt-6 grid grid-cols-2 gap-4 text-sm text-slate-700">
                        <div class="flex items-start gap-2">
                            <span class="mt-1 inline-block size-2 rounded-full bg-red-600"></span>
                            <div>
                                <strong>Оглед</strong><br>
                                <span class="text-slate-500">и конкретни препоръки</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2">
                            <span class="mt-1 inline-block size-2 rounded-full bg-red-600"></span>
                            <div>
                                <strong>Монтаж</strong><br>
                                <span class="text-slate-500">чисто и тествано</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2">
                            <span class="mt-1 inline-block size-2 rounded-full bg-red-600"></span>
                            <div>
                                <strong>Настройка</strong><br>
                                <span class="text-slate-500">достъп от телефон</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2">
                            <span class="mt-1 inline-block size-2 rounded-full bg-red-600"></span>
                            <div>
                                <strong>Поддръжка</strong><br>
                                <span class="text-slate-500">при нужда</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($stats as $stat)
                        <x-stat-card
                            :target="$stat['target']"
                            :suffix="$stat['suffix'] ?? ''"
                            :decimals="$stat['decimals'] ?? 0"
                            :label="$stat['label']"
                        />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- РЕШЕНИЯ СПОРЕД ОБЕКТА (Задача 1) — админ-управляеми, бели карти --}}
    @if ($objectSolutions->isNotEmpty())
        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-4 pb-4 pt-2">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-600">Решения според обекта</p>
                        <h2 class="mt-2 text-2xl font-extrabold leading-tight md:text-3xl">
                            Подходящо решение за всеки тип обект
                        </h2>
                    </div>

                    <a href="{{ route('solutions') }}" class="text-sm font-semibold text-red-600 hover:text-red-700">
                        Виж всички решения →
                    </a>
                </div>

                {{-- На десктоп: квадратни карти. На мобилно: компактни правоъгълници (по-малко място). --}}
                <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-4">
                    @foreach ($objectSolutions as $card)
                        <a
                            href="{{ $card->url() }}"
                            class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-md sm:aspect-square sm:flex-col sm:items-start sm:justify-start"
                        >
                            @if ($card->iconPath())
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-600 transition group-hover:bg-red-100">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="{{ $card->iconPath() }}" />
                                    </svg>
                                </div>
                            @endif

                            <div class="min-w-0 flex-1 sm:mt-5 sm:flex sm:w-full sm:flex-col">
                                <h3 class="text-base font-extrabold leading-tight text-slate-900 md:text-lg">
                                    {{ $card->title }}
                                </h3>

                                @if ($card->description)
                                    <p class="mt-2 hidden text-sm leading-6 text-slate-600 sm:block">
                                        {{ $card->description }}
                                    </p>
                                @endif

                                @if ($card->tagline)
                                    <p class="mt-1 text-sm font-bold text-red-600 sm:mt-auto sm:pt-4">
                                        {{ $card->tagline }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- VIDEO PRESENTATION (заменя секцията с пакети) --}}
    @php
        $siteSetting = \App\Models\SiteSetting::current();

        $homeVideoUrl = $siteSetting->home_video_path
            ? \Illuminate\Support\Facades\Storage::disk('public')->url($siteSetting->home_video_path)
            : (file_exists(public_path('videos/home.mp4')) ? asset('videos/home.mp4') : null);

        $homeVideoPoster = $siteSetting->home_video_poster
            ? \Illuminate\Support\Facades\Storage::disk('public')->url($siteSetting->home_video_poster)
            : (file_exists(public_path('videos/home-poster.jpg')) ? asset('videos/home-poster.jpg') : null);
    @endphp

    {{-- ВИДЕО — контейнер 1200×450 (8:3), центриран, responsive (Задача 6) --}}
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-12">
            <div class="relative mx-auto aspect-[8/3] w-full max-w-[1200px] overflow-hidden rounded-2xl bg-slate-200 shadow-lg">
                @if ($homeVideoUrl)
                    <video
                        class="absolute inset-0 h-full w-full object-cover"
                        autoplay
                        muted
                        loop
                        playsinline
                        preload="metadata"
                        @if ($homeVideoPoster) poster="{{ $homeVideoPoster }}" @endif
                    >
                        <source src="{{ $homeVideoUrl }}" type="video/mp4">
                    </video>
                @elseif ($homeVideoPoster)
                    <img src="{{ $homeVideoPoster }}" alt="" class="absolute inset-0 h-full w-full object-cover">
                @endif

            </div>

            {{-- Бутон ПОД клипа (за всички екрани — клипът е малък, за да не пада върху текста) --}}
            @if ($siteSetting->videoButtonEnabled())
                <div class="mt-5 flex justify-center">
                    <a
                        href="{{ $siteSetting->videoButtonUrl() }}"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex w-full max-w-xs items-center justify-center rounded-lg border-2 border-red-600 bg-black px-6 py-3 text-center font-semibold text-white transition hover:bg-red-600"
                    >
                        {{ $siteSetting->videoButtonLabel() }}
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- УСЛУГИ под видеото (Задача 2) --}}
    @if (isset($homeServices) && $homeServices->count())
        <section class="bg-slate-50">
            <div class="mx-auto max-w-6xl px-4 py-14">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-600">Услуги</p>
                        <h2 class="mt-2 text-2xl font-extrabold leading-tight md:text-3xl">
                            Какво предлагаме
                        </h2>
                    </div>

                    <a href="{{ route('services') }}" class="text-sm font-semibold text-red-600 hover:text-red-700">
                        Виж всичките ни услуги →
                    </a>
                </div>

                <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($homeServices as $service)
                        <a
                            href="{{ route('services') }}"
                            class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                        >
                            @if (! empty($service->icon))
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-600 shadow">
                                    <img src="{{ asset('icons/' . $service->icon) }}" class="h-6 w-6 object-contain" alt="{{ $service->title }}" loading="lazy">
                                </div>
                            @endif

                            <h3 class="mt-4 text-base font-bold leading-tight text-slate-900 md:text-lg">
                                {{ $service->title }}
                            </h3>

                            @if (! empty($service->description))
                                <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600">
                                    {{ $service->description }}
                                </p>
                            @endif

                            <span class="mt-auto inline-flex items-center gap-1 pt-4 text-sm font-semibold text-red-600">
                                Научи повече →
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ГАЛЕРИЯ „Нашата работа" (Задача 3) — админ-управляема, lazy-load --}}
    @if ($galleryImages->isNotEmpty())
        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-4 py-14">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-600">Реализирани обекти</p>
                        <h2 class="mt-2 text-2xl font-extrabold leading-tight md:text-3xl">
                            Нашата работа
                        </h2>
                    </div>

                    <div class="flex gap-2">
                        <button type="button" data-gallery-arrow="prev" aria-label="Назад"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-300 text-slate-700 transition hover:border-red-600 hover:bg-red-600 hover:text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6l-6 6 6 6" /></svg>
                        </button>
                        <button type="button" data-gallery-arrow="next" aria-label="Напред"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-300 text-slate-700 transition hover:border-red-600 hover:bg-red-600 hover:text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6" /></svg>
                        </button>
                    </div>
                </div>

                <div
                    id="gallery-strip"
                    data-has-more="{{ $galleryHasMore ? '1' : '0' }}"
                    class="mt-8 flex snap-x gap-4 overflow-x-auto scroll-smooth pb-3"
                >
                    @include('partials.gallery-list', ['images' => $galleryImages])
                </div>

                @if ($galleryHasMore)
                    <div class="mt-6 text-center">
                        <button type="button" id="gallery-more" data-page="2"
                            class="inline-flex items-center justify-center rounded-lg border-2 border-red-600 px-5 py-3 text-sm font-bold text-red-600 transition hover:bg-red-600 hover:text-white">
                            Виж още
                        </button>
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

                document.querySelectorAll('[data-gallery-arrow]').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        var dir = btn.getAttribute('data-gallery-arrow') === 'next' ? 1 : -1;
                        strip.scrollBy({ left: dir * Math.round(strip.clientWidth * 0.8), behavior: 'smooth' });
                    });
                });

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

    @php($googleReviews = config('google-reviews'))

    <x-google-reviews
        :profile-url="$googleReviews['profile_url']"
        :reviews="$googleReviews['reviews']"
    />

    {{-- PROCESS --}}
    <section class="bg-slate-50">
        <div class="mx-auto max-w-6xl px-4 py-14">
            <h2 class="text-2xl font-extrabold md:text-3xl">Процес</h2>
            <p class="mt-3 max-w-2xl text-slate-600">
                Прост и работещ процес - без излишни обещания, само ясни стъпки.
            </p>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <div class="rounded-xl border bg-white p-6">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-black">
                            <img
                                src="/icons/iconiHomePage/HomePageProccessTab/64pxzapitvane.png"
                                alt="Запитване"
                                class="h-5 w-5 object-contain"
                                width="64" height="64"
                                loading="lazy"
                            >
                        </div>

                        <h3 class="text-lg font-bold">Запитване</h3>
                    </div>

                    <p class="text-sm text-slate-600">
                        Кратко описание на обекта и нуждите.
                    </p>
                </div>

                <div class="rounded-xl border bg-white p-6">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-black">
                            <img
                                src="/icons/iconiHomePage/HomePageProccessTab/64pxogled.png"
                                alt="Оглед и оферта"
                                class="h-5 w-5 object-contain"
                                width="64" height="64"
                                loading="lazy"
                            >
                        </div>

                        <h3 class="text-lg font-bold">Оглед и оферта</h3>
                    </div>

                    <p class="text-sm text-slate-600">
                        Предложение с оборудване и план за монтаж.
                    </p>
                </div>

                <div class="rounded-xl border bg-white p-6">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-black">
                            <img
                                src="/icons/iconiHomePage/HomePageProccessTab/64pwork.png"
                                alt="Монтаж и тест"
                                class="h-5 w-5 object-contain"
                                width="64" height="64"
                                loading="lazy"
                            >
                        </div>

                        <h3 class="text-lg font-bold">Монтаж и тест</h3>
                    </div>

                    <p class="text-sm text-slate-600">
                        Инсталация, настройки и кратко обучение.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ЛИНК КЪМ СТАТИИ под „Процес" (Задача 5) --}}
    <section class="bg-slate-50">
        <div class="mx-auto max-w-6xl px-4 pb-14">
            <a
                href="{{ route('articles.index') }}"
                class="group flex flex-col items-start gap-4 rounded-2xl bg-slate-900 p-6 text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:flex-row sm:items-center sm:justify-between"
            >
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-600 shadow">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 5h11a1 1 0 0 1 1 1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Z" />
                            <path d="M16 8h3a1 1 0 0 1 1 1v9a2 2 0 0 1-2 2M7 8h6M7 12h6M7 16h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold leading-snug md:text-lg">
                            Вижте всички новости в света на охранителните системи тук
                        </h3>
                        <p class="mt-1 text-sm text-white/70">
                            Статии, съвети и тенденции за видеонаблюдение и сигурност.
                        </p>
                    </div>
                </div>

                <span class="inline-flex shrink-0 items-center gap-2 rounded-lg border-2 border-red-600 px-5 py-2.5 text-sm font-semibold transition group-hover:bg-red-600">
                    Към статиите →
                </span>
            </a>
        </div>
    </section>

@endsection
