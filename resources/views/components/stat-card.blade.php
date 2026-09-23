@props([
    'target',
    'label',
    'suffix' => '',
    'prefix' => '',
    'decimals' => 0,
    'duration' => 1400,
])

<div class="stat-cell">
    <div
        class="stat-value"
        data-countup
        data-target="{{ $target }}"
        data-suffix="{{ $suffix }}"
        data-prefix="{{ $prefix }}"
        data-decimals="{{ $decimals }}"
        data-duration="{{ $duration }}"
    >
        {{ $prefix }}{{ number_format((float) $target, (int) $decimals, '.', '') }}{{ $suffix }}
    </div>

    <div class="stat-label">{{ $label }}</div>
</div>
