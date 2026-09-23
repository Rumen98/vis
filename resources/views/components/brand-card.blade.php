@props([
    'brand',
    'href' => null,
])

@php
    $destination = $href ?? route('brands.show', ['brand' => $brand['slug']]);
@endphp

<a class="brand-card" href="{{ $destination }}">
    <div class="brand-logo">
        @if ($brand['logo'])
            <img
                src="{{ asset($brand['logo']['asset_path']) }}"
                alt="{{ $brand['logo']['alt'] }}"
                loading="lazy"
                decoding="async"
            >
        @else
            <span style="font-weight:800">{{ $brand['display_name'] }}</span>
        @endif
    </div>

    <div>
        <h3>{{ $brand['display_name'] }}</h3>
    </div>

    <div class="card-foot">
        <span>Виж повече</span>
        <span class="arrow">→</span>
    </div>
</a>
