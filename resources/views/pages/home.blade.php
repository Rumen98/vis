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

    {{-- Клипът запълва плътно целия див: пълна широчина и височина (16:9), без заглавие --}}
    <section>
        <div class="relative aspect-video w-full overflow-hidden bg-slate-200">
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

            {{-- Градиент отдолу (само там, където бутонът стои върху клипа) --}}
            <div class="absolute inset-x-0 bottom-0 hidden h-1/3 bg-gradient-to-t from-black/60 to-transparent sm:block" aria-hidden="true"></div>

            {{-- Бутон ВЪРХУ клипа — само таблет/десктоп (текст и линк от админ панела) --}}
            @if ($siteSetting->videoButtonEnabled())
                <div class="absolute inset-x-0 bottom-0 hidden justify-center px-4 pb-6 sm:flex">
                    <a
                        href="{{ $siteSetting->videoButtonUrl() }}"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex items-center justify-center rounded-lg border-2 border-red-600 bg-black/80 px-6 py-3 text-center font-semibold text-white backdrop-blur-sm transition hover:bg-red-600"
                    >
                        {{ $siteSetting->videoButtonLabel() }}
                    </a>
                </div>
            @endif
        </div>

        {{-- Бутон ПОД клипа — само мобилно, за да не пада върху текста в клипа --}}
        @if ($siteSetting->videoButtonEnabled())
            <div class="flex justify-center bg-black px-4 py-4 sm:hidden">
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
    </section>

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

@endsection
