@extends('layouts.app')

@section('title', $brand['display_name'])

@section('content')
<section class="bg-white">
    <div class="mx-auto max-w-6xl px-4 py-14">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_420px] lg:items-start">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold">{{ $brand['display_name'] }}</h1>

                @if ($brand['document_title'] !== $brand['display_name'])
                    <p class="mt-3 text-slate-600">{{ $brand['document_title'] }}</p>
                @endif

                @foreach ($brand['introduction_paragraphs'] as $paragraph)
                    <p class="mt-3 text-slate-600">{{ $paragraph }}</p>
                @endforeach

                @if ($brand['introduction_bullets'])
                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        @foreach ($brand['introduction_bullets'] as $item)
                            <li class="flex items-start gap-2">
                                <span class="mt-1 h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <a
                        href="{{ route('quote') }}"
                        class="inline-flex items-center justify-center rounded-lg bg-red-600 px-5 py-3 font-semibold text-white hover:bg-red-500"
                    >
                        {{ $brand['button_label'] }}
                    </a>
                    <a
                        href="{{ route('tech') }}"
                        class="inline-flex items-center justify-center rounded-lg border bg-white px-5 py-3 font-semibold text-black"
                    >
                        Към техника
                    </a>
                </div>
            </div>

            <div class="rounded-xl border bg-white p-4 md:p-6">
                <div class="flex h-20 items-center justify-center overflow-hidden sm:h-24">
                    @if ($brand['logo'])
                        <img
                            src="{{ asset($brand['logo']['asset_path']) }}"
                            alt="{{ $brand['logo']['alt'] }}"
                            class="h-full w-full object-cover object-center"
                            loading="lazy"
                        >
                    @else
                        <span class="text-sm font-semibold text-slate-900">{{ $brand['display_name'] }}</span>
                    @endif
                </div>

                @if ($brand['hero_image'])
                    <div class="mt-4 overflow-hidden rounded-xl border bg-white">
                        <img
                            src="{{ asset($brand['hero_image']['asset_path']) }}"
                            alt="{{ $brand['hero_image']['alt'] }}"
                            class="block h-auto w-full object-contain"
                            loading="lazy"
                        >
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@foreach ($brand['sections'] as $index => $section)
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-14">
            <div class="max-w-3xl">
                <h2 class="text-2xl md:text-3xl font-extrabold">{{ $section['title'] }}</h2>

                @foreach ($section['paragraphs'] as $paragraph)
                    <p class="mt-3 text-slate-600">{{ $paragraph }}</p>
                @endforeach
            </div>

            @if ($section['bullets'])
                <div class="mt-8 rounded-xl border bg-white p-4 md:p-6">
                    <ul class="{{ count($section['bullets']) > 4 ? 'grid gap-3 md:grid-cols-2 text-sm text-slate-700' : 'space-y-3 text-sm text-slate-700' }}">
                        @foreach ($section['bullets'] as $item)
                            <li class="flex items-start gap-2">
                                <span class="mt-1 h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($section['subsections'])
                <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($section['subsections'] as $subsection)
                        <div class="rounded-xl border bg-white p-4 md:p-6">
                            <h3 class="text-lg font-bold">{{ $subsection['title'] }}</h3>

                            @foreach ($subsection['paragraphs'] as $paragraph)
                                <p class="mt-3 text-slate-600">{{ $paragraph }}</p>
                            @endforeach

                            @if ($subsection['bullets'])
                                <ul class="mt-4 space-y-3 text-sm text-slate-700">
                                    @foreach ($subsection['bullets'] as $item)
                                        <li class="flex items-start gap-2">
                                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @php($sectionImage = $brand['section_images'][$index] ?? null)

            @if ($sectionImage)
                <div class="mt-8 overflow-hidden rounded-xl border bg-white">
                    <img
                        src="{{ asset($sectionImage['asset_path']) }}"
                        alt="{{ $sectionImage['alt'] }}"
                        class="block h-auto w-full object-contain"
                        loading="lazy"
                    >
                </div>
            @endif
        </div>
    </section>
@endforeach

@if ($brand['trailing_images'])
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-14">
            <h2 class="text-2xl md:text-3xl font-extrabold">Изображения</h2>

            <div @class([
                'mt-8',
                'max-w-4xl' => count($brand['trailing_images']) === 1,
                'grid gap-6 md:grid-cols-2' => count($brand['trailing_images']) > 1,
            ])>
                @foreach ($brand['trailing_images'] as $image)
                    <div class="overflow-hidden rounded-xl border bg-white">
                        <img
                            src="{{ asset($image['asset_path']) }}"
                            alt="{{ $image['alt'] }}"
                            class="block h-auto w-full object-contain"
                            loading="lazy"
                        >
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if ($otherBrands->isNotEmpty())
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-14">
            <div class="max-w-3xl">
                <h2 class="text-2xl md:text-3xl font-extrabold">Други марки</h2>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($otherBrands as $otherBrand)
                    <x-brand-card :brand="$otherBrand" />
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection
