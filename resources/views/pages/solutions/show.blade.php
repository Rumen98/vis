@extends('layouts.app')

@section('title', $solution->title)

@section('content')
    <section class="bg-slate-50">
        <div class="mx-auto max-w-4xl px-4 py-14">
            <a href="{{ route('solutions') }}" class="text-sm text-slate-500 transition hover:text-slate-800">
                ← Назад към решенията
            </a>

            <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-8">
                <div class="flex items-start gap-4">
                    @if (! empty($solution->icon))
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-red-600 shadow">
                            <img src="{{ asset('icons/' . $solution->icon) }}" class="h-7 w-7 object-contain" alt="{{ $solution->title }}" loading="lazy">
                        </div>
                    @endif

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-600">Решение</p>
                        <h1 class="mt-1 text-3xl font-extrabold tracking-tight text-slate-900 md:text-4xl">
                            {{ $solution->title }}
                        </h1>
                    </div>
                </div>

                @if ($solution->description)
                    <p class="mt-6 text-base leading-7 text-slate-600">
                        {{ $solution->description }}
                    </p>
                @endif

                @if (! empty($solution->bullets))
                    <ul class="mt-6 grid gap-3 sm:grid-cols-2">
                        @foreach ($solution->bullets as $bullet)
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.5" />
                                    <path d="m6.5 10.2 2.25 2.25 4.75-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>{{ is_array($bullet) ? ($bullet['value'] ?? '') : $bullet }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if (filled($solution->body))
                    <style>
                        .solution-content { line-height: 1.8; color: #334155; word-break: break-word; }
                        .solution-content > *:first-child { margin-top: 0; }
                        .solution-content p { margin: 0 0 1.25rem; }
                        .solution-content h2, .solution-content h3, .solution-content h4 { margin: 2rem 0 1rem; font-weight: 800; line-height: 1.25; color: #0f172a; }
                        .solution-content h2 { font-size: 1.5rem; }
                        .solution-content h3 { font-size: 1.25rem; }
                        .solution-content ul, .solution-content ol { margin: 0 0 1.5rem 1.25rem; padding-left: 1rem; }
                        .solution-content li { margin-bottom: 0.5rem; }
                        .solution-content a { color: #dc2626; text-decoration: underline; }
                        .solution-content strong { color: #0f172a; font-weight: 700; }
                        .solution-content blockquote { margin: 1.5rem 0; padding: 0.75rem 0 0.75rem 1rem; border-left: 4px solid #cbd5e1; color: #475569; background: #f8fafc; border-radius: 0.5rem; }
                        .solution-content img { display: block; width: 100%; height: auto; margin: 1.5rem 0; border-radius: 0.75rem; border: 1px solid #e2e8f0; }
                    </style>

                    <div class="solution-content mt-8 max-w-none border-t border-slate-200 pt-8">
                        {!! $solution->body !!}
                    </div>
                @endif

                <div class="mt-8 flex flex-col gap-3 border-t border-slate-200 pt-8 sm:flex-row">
                    <a href="{{ route('quote') }}" class="inline-flex items-center justify-center rounded-lg bg-red-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-500">
                        Запитване за оферта
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-3 text-sm font-bold text-slate-900 transition hover:bg-slate-50">
                        Свържи се с нас
                    </a>
                </div>
            </div>

            @if ($related->count())
                <div class="mt-10">
                    <h2 class="text-lg font-extrabold text-slate-900">Други решения</h2>
                    <div class="mt-4 grid gap-4 sm:grid-cols-3">
                        @foreach ($related as $item)
                            <a href="{{ route('solutions.show', $item->slug) }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <h3 class="text-sm font-bold leading-tight text-slate-900">{{ $item->title }}</h3>
                                <span class="mt-3 inline-block text-sm font-semibold text-red-600">Виж →</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
