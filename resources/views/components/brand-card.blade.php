@props([
    'brand',
    'href' => null,
])

@php
    $destination = $href ?? route('brands.show', ['brand' => $brand['slug']]);
@endphp

<a
    href="{{ $destination }}"
    class="group rounded-xl border bg-white p-4 transition hover:-translate-y-0.5 hover:shadow-sm md:p-6"
>
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

    <div class="mt-4 flex items-center justify-between gap-4">
        <h3 class="text-lg font-bold">{{ $brand['display_name'] }}</h3>
        <span class="text-sm font-semibold text-red-600 transition group-hover:text-red-500">Виж повече</span>
    </div>
</a>
