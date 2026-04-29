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

    @php
        $securityPackages = [
            [
                'key' => 'basic',
                'title' => 'БАЗОВ',
                'suitable' => 'Подходящ за апартаменти, малки обекти и входове',
                'price' => 'От 649€',
                'note' => 'Включен монтаж и настройка',
                'items' => [
                    'До 3 камери',
                    'Записващо устройство',
                    'Монтаж и настройка',
                    'Достъп през телефон',
                    'Основно покритие на обекта',
                ],
                'accent' => 'green',
                'buttonClass' => 'border border-red-600 text-red-600 hover:bg-red-600 hover:text-white',
            ],
            [
                'key' => 'standard',
                'title' => 'СТАНДАРТ',
                'badge' => 'НАЙ-ИЗБИРАН',
                'suitable' => 'Подходящ за къщи, офиси, малък и среден бизнес',
                'price' => 'От 1049€',
                'note' => 'Включен монтаж и настройка',
                'items' => [
                    '4 до 6 камери',
                    'По-добро покритие',
                    'Повече интелигентни функции',
                    'Записващо устройство',
                    'Монтаж и настройка',
                    'Достъп през телефон',
                    '+ 1 година включена поддръжка',
                ],
                'accent' => 'red',
                'featured' => true,
                'buttonClass' => 'bg-red-600 text-white hover:bg-red-500',
            ],
            [
                'key' => 'premium',
                'title' => 'ПРЕМИУМ',
                'suitable' => 'Подходящ за по-големи обекти, търговски площи и бизнеси',
                'price' => 'От 1649€',
                'note' => 'Включен монтаж и настройка',
                'items' => [
                    '6 до 10+ камери',
                    'Пълно покритие на обекта',
                    'Разширено наблюдение',
                    'Записващо устройство',
                    'Монтаж и настройка',
                    'Достъп през телефон',
                    '+ 1 година приоритетна поддръжка',
                ],
                'accent' => 'dark',
                'buttonClass' => 'bg-slate-950 text-white hover:bg-slate-800',
            ],
        ];
    @endphp

    {{-- SECURITY PACKAGES --}}
    <section class="bg-slate-50">
        <div class="mx-auto max-w-6xl px-4 py-14">
            <div class="mx-auto max-w-4xl text-center">
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-600">
                    ПАКЕТИ ВИДЕОНАБЛЮДЕНИЕ ЗА МАКСИМАЛНА СИГУРНОСТ
                </p>

                <h2 class="mt-3 text-2xl font-extrabold leading-tight md:text-3xl">
                    Избери готово решение за максимална сигурност на твоя дом или бизнес
                </h2>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-3 md:items-stretch">
                @foreach ($securityPackages as $package)
                    @php
                        $isFeatured = $package['featured'] ?? false;
                        $accentClasses = match ($package['accent']) {
                            'green' => [
                                'iconWrap' => 'bg-green-50 text-green-600',
                                'title' => 'text-green-600',
                                'check' => 'text-green-600',
                            ],
                            'red' => [
                                'iconWrap' => 'bg-red-50 text-red-600',
                                'title' => 'text-red-600',
                                'check' => 'text-red-600',
                            ],
                            default => [
                                'iconWrap' => 'bg-slate-100 text-slate-950',
                                'title' => 'text-slate-950',
                                'check' => 'text-slate-950',
                            ],
                        };
                    @endphp

                    <article
                        class="relative flex h-full flex-col rounded-xl border bg-white p-4 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md md:p-6 {{ $isFeatured ? 'border-red-500 md:-mt-3 md:mb-3' : 'border-slate-200' }}"
                    >
                        @if ($isFeatured)
                            <span class="absolute left-1/2 top-0 -translate-x-1/2 -translate-y-1/2 rounded-full bg-red-600 px-4 py-1 text-[11px] font-extrabold uppercase tracking-wide text-white">
                                {{ $package['badge'] }}
                            </span>
                        @endif

                        <div class="flex h-14 w-14 items-center justify-center rounded-full {{ $accentClasses['iconWrap'] }}">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 3.75 5.75 6.1v4.7c0 4.1 2.55 7.8 6.25 9.45 3.7-1.65 6.25-5.35 6.25-9.45V6.1L12 3.75Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                <path d="m9.25 12 1.8 1.8 3.95-4.05" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <h3 class="mt-6 text-xl font-extrabold {{ $accentClasses['title'] }}">
                            {{ $package['title'] }}
                        </h3>

                        <p class="mt-2 min-h-[3rem] text-sm leading-6 text-slate-600">
                            {{ $package['suitable'] }}
                        </p>

                        <div class="mt-5">
                            <p class="text-4xl font-extrabold tracking-tight text-slate-950">
                                {{ $package['price'] }}
                            </p>
                            <p class="mt-1 text-sm font-semibold text-slate-500">
                                {{ $package['note'] }}
                            </p>
                        </div>

                        <ul class="mt-6 space-y-3 text-sm text-slate-700">
                            @foreach ($package['items'] as $item)
                                <li class="flex items-start gap-3">
                                    <svg class="mt-0.5 h-5 w-5 shrink-0 {{ $accentClasses['check'] }}" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                        <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="m6.5 10.2 2.25 2.25 4.75-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="{{ str_starts_with($item, '+') ? 'font-bold text-slate-950' : '' }}">
                                        {{ $item }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                        <a
                            href="{{ route('quote', ['package' => $package['key']]) }}"
                            class="mt-8 inline-flex w-full items-center justify-center rounded-lg px-4 py-3 text-center text-sm font-bold transition {{ $package['buttonClass'] }}"
                        >
                            Вземи оферта
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-6 grid gap-5 rounded-xl border border-slate-200 bg-white p-5 shadow-sm md:grid-cols-[1fr_0.8fr] md:p-6">
                <div class="flex gap-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M10.75 18.5a7.75 7.75 0 1 1 5.48-13.23 7.75 7.75 0 0 1-5.48 13.23Z" stroke="currentColor" stroke-width="1.7"/>
                            <path d="m16.5 16.5 4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <p class="text-sm leading-6 text-slate-700">
                        Крайната цена се определя след безплатен оглед според обекта, избраното оборудване и специфичните изисквания. Всеки от пакетите включва висок клас техника.
                    </p>
                </div>

                <div class="flex gap-4 border-slate-200 md:border-l md:pl-6">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19.25 12a7.25 7.25 0 1 1-14.5 0 7.25 7.25 0 0 1 14.5 0Z" stroke="currentColor" stroke-width="1.7"/>
                            <path d="M18.25 4.75 20 3m-14.25 1.75L4 3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold leading-6 text-slate-950">
                        Безплатен оглед и оферта до 24 часа.
                    </p>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a
                    href="{{ route('services') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-red-600 bg-white px-5 py-3 text-sm font-bold text-red-600 transition hover:bg-red-600 hover:text-white"
                >
                    Разгледай всички услуги
                </a>
            </div>

            <div class="mx-auto mt-7 max-w-2xl text-center">
                <h3 class="text-xl font-extrabold text-slate-950">
                    Не сте сигурни кой пакет е подходящ за Вас?
                </h3>
                <p class="mt-2 text-sm text-slate-600">
                    Свържете се с нас за безплатен оглед и персонална оферта.
                </p>
                <a
                    href="{{ route('quote') }}"
                    class="mt-5 inline-flex items-center justify-center rounded-lg bg-red-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-500"
                >
                    Свържи се с нас
                </a>
            </div>
        </div>
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
