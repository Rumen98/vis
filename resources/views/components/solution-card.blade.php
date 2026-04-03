@props([
    'solution',
])

@php
    $href = $solution->article?->slug ? route('articles.show', $solution->article->slug) : null;
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        class="block rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"
    >
        <div class="flex h-full flex-col">
            <div class="flex items-start gap-4">
                @if (! empty($solution->icon))
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-slate-800 bg-slate-900">
                        <img
                            src="{{ asset('icons/' . $solution->icon) }}"
                            class="h-6 w-6 object-contain"
                            alt="{{ $solution->title }}"
                            loading="lazy"
                        >
                    </div>
                @endif

                <div class="min-w-0 flex-1">
                    <h3 class="text-base font-bold leading-tight text-slate-900 md:text-lg">
                        {{ $solution->title }}
                    </h3>
                </div>
            </div>

            <div class="mt-auto pt-6 text-sm font-semibold text-red-600">
                Прочети →
            </div>
        </div>
    </a>
@else
    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="flex h-full flex-col">
            <div class="flex items-start gap-4">
                @if (! empty($solution->icon))
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-slate-800 bg-slate-900">
                        <img
                            src="{{ asset('icons/' . $solution->icon) }}"
                            class="h-6 w-6 object-contain"
                            alt="{{ $solution->title }}"
                            loading="lazy"
                        >
                    </div>
                @endif

                <div class="min-w-0 flex-1">
                    <h3 class="text-base font-bold leading-tight text-slate-900 md:text-lg">
                        {{ $solution->title }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
@endif
