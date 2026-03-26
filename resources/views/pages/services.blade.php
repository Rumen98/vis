@extends('layouts.app')

@section('title', 'Услуги')

@section('content')
<section class="bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-14">
        <h1 class="text-3xl md:text-4xl font-extrabold">Услуги</h1>
        <p class="mt-3 max-w-2xl text-slate-600">
            Изграждаме системи за сигурност и комуникация за домове, офиси и обекти.
            От оглед до монтаж и поддръжка.
        </p>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @forelse ($services as $service)
                <div class="rounded-xl border bg-white p-6 flex flex-col">
                    {{-- ICON --}}
                    @if(!empty($service->icon))
                        <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-slate-900">
                            <img
                                src="{{ asset('icons/' . $service->icon) }}"
                                alt="{{ $service->title }}"
                                class="h-10 w-10"
                                loading="lazy"
                            >
                        </div>
                    @else
                        <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-slate-900 text-white font-bold">
                            ?
                        </div>
                    @endif

                    <h2 class="text-lg font-bold leading-tight">
                        {{ $service->title }}
                    </h2>

                    @if(!empty($service->description))
                        <p class="mt-2 text-sm text-slate-600">
                            {!! nl2br(e($service->description)) !!}
                        </p>
                    @endif

                    @php
                        $bullets = is_array($service->bullets) ? $service->bullets : [];
                    @endphp

                    @if(count($bullets))
                        <ul class="mt-4 space-y-2 text-sm text-slate-700">
                            @foreach ($bullets as $item)
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a
                        href="{{ route('quote') }}"
                        class="mt-auto inline-flex justify-center rounded-lg bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-500 transition"
                    >
                        Вземи оферта
                    </a>
                </div>
            @empty
                <div class="rounded-xl border bg-white p-6 text-slate-700">
                    Няма добавени услуги още. Влез в админ панела и добави поне една услуга.
                </div>
            @endforelse
        </div>

        {{-- CTA --}}
        <div class="mt-12 rounded-xl border bg-white p-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-lg font-bold">
                    Не си сигурен кое решение ти е нужно?
                </h3>
                <p class="mt-1 text-sm text-slate-600">
                    Опиши обекта и изискванията - ще предложим най-подходящия вариант.
                </p>
            </div>

            <a
                href="{{ route('quote') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-black px-5 py-3 font-semibold text-white hover:opacity-90"
            >
                <img src="{{ asset('icons/64pxoffer.png') }}" class="h-5 w-5" alt="" loading="lazy">
                Запитване за оферта
            </a>
        </div>
    </div>
</section>
@endsection
