@extends('layouts.app')

@section('title', 'Начало')

@section('content')

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-black text-white">
        <img src="{{ asset('/images/hero/hero.jpg') }}" alt=""
            class="absolute inset-0 h-full w-full object-cover object-[72%_center] opacity-35 md:object-right md:opacity-50"
            aria-hidden="true">

        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/95 to-black/55 md:to-black/20" aria-hidden="true">
        </div>

        <div class="relative mx-auto max-w-6xl px-3 py-10 sm:px-4 sm:py-12 md:py-20">
            <p class="text-[10px] uppercase tracking-[0.2em] text-white/70 sm:text-xs">
                Правилният избор за твоята сигурност
            </p>

            <h1 class="mt-4 text-[2rem] sm:text-5xl md:text-6xl font-extrabold leading-[0.92] tracking-[-0.02em]">
                <span class="block">Видеонаблюдение,</span>
                <span class="block text-red-500">системи за</span>
                <span class="block text-red-500">сигурност и</span>
                <span class="block">комуникация</span>
            </h1>

            <p class="mt-5 max-w-xl text-base leading-8 text-white/80 sm:text-lg">
                Проектираме и изграждаме надеждни решения за домове, офиси и обекти. Ясна оферта, чист монтаж и поддръжка.
            </p>

            <div class="mt-6 flex flex-col gap-3 sm:mt-8 sm:flex-row">
                <a href="{{ route('services') }}"
                    class="rounded-lg bg-white px-5 py-3 text-center font-semibold text-black">
                    Услуги
                </a>
                <a href="{{ route('quote') }}"
                    class="rounded-lg bg-red-600 px-5 py-3 text-center font-semibold hover:bg-red-500">
                    Запитване за оферта
                </a>
            </div>
        </div>
    </section>


    {{-- ABOUT / INTRO --}}
    <section>
        <div class="mx-auto max-w-6xl px-4 py-14">
            <div class="grid md:grid-cols-2 gap-10 items-start">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold">
                        Изградени за защита. Фокус върху качество и надеждност.
                    </h2>

                    <p class="mt-4 text-slate-600">
                        Работим с доказани производители и сертифицирани решения.
                        Подхождаме практично - какво реално ти трябва, как да се
                        позиционира и как да се поддържа.
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

                {{-- STATS --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-lg border p-6">
                        <div class="text-3xl font-extrabold">200+</div>
                        <div class="mt-1 text-sm text-slate-600">Изградени системи</div>
                    </div>

                    <div class="rounded-lg border p-6">
                        <div class="text-3xl font-extrabold">150+</div>
                        <div class="mt-1 text-sm text-slate-600">Доволни клиенти</div>
                    </div>

                    <div class="rounded-lg border p-6">
                        <div class="text-3xl font-extrabold">99.9%</div>
                        <div class="mt-1 text-sm text-slate-600">Стабилност</div>
                    </div>

                    <div class="rounded-lg border p-6">
                        <div class="text-3xl font-extrabold">24/7</div>
                        <div class="mt-1 text-sm text-slate-600">Сигурност</div>
                    </div>
                </div>
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
            <h2 class="text-2xl md:text-3xl font-extrabold">Процес</h2>
            <p class="mt-3 max-w-2xl text-slate-600">
                Прост и работещ процес - без излишни обещания, само ясни стъпки.
            </p>

            <div class="mt-8 grid md:grid-cols-3 gap-6">

                <div class="rounded-xl border bg-white p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-10 w-10 flex items-center justify-center rounded-full bg-black">
                            <img src="/icons/iconiHomePage/HomePageProccessTab/64pxzapitvane.png" alt="Запитване"
                                class="h-5 w-5 object-contain">
                        </div>
                        <h3 class="font-bold text-lg">Запитване</h3>
                    </div>

                    <p class="text-sm text-slate-600">
                        Кратко описание на обекта и нуждите.
                    </p>
                </div>

                <div class="rounded-xl border bg-white p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-10 w-10 flex items-center justify-center rounded-full bg-black">
                            <img src="/icons/iconiHomePage/HomePageProccessTab/64pxogled.png" alt="Оглед и оферта"
                                class="h-5 w-5 object-contain">
                        </div>
                        <h3 class="font-bold text-lg">Оглед и оферта</h3>
                    </div>

                    <p class="text-sm text-slate-600">
                        Предложение с оборудване и план за монтаж.
                    </p>
                </div>

                <div class="rounded-xl border bg-white p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-10 w-10 flex items-center justify-center rounded-full bg-black">
                            <img src="/icons/iconiHomePage/HomePageProccessTab/64pwork.png" alt="Монтаж и тест"
                                class="h-5 w-5 object-contain">
                        </div>
                        <h3 class="font-bold text-lg">Монтаж и тест</h3>
                    </div>

                    <p class="text-sm text-slate-600">
                        Инсталация, настройки и кратко обучение.
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection
