@props([
    'solution',
    'index' => null,
])

<a class="list-card" href="{{ route('solutions.show', $solution->slug) }}">
    <div>
        <span class="tag">{{ $index !== null ? str_pad($index, 2, '0', STR_PAD_LEFT) . ' / ' : '' }}Решение</span>

        @if (! empty($solution->icon))
            <span class="card-icon" aria-hidden="true">
                <img src="{{ asset('icons/' . $solution->icon) }}" alt="" loading="lazy">
            </span>
        @endif

        <h3>{{ $solution->title }}</h3>

        @if ($solution->description)
            <p>{{ $solution->description }}</p>
        @endif
    </div>

    <div class="card-foot">
        <span>Виж решението</span>
        <span class="arrow">→</span>
    </div>
</a>
