@props([
    'target',
    'label',
    'suffix' => '',
    'prefix' => '',
    'decimals' => 0,
    'duration' => 1400,
])

<div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/80">
    <div
        class="text-3xl font-extrabold tracking-[-0.03em] text-slate-950"
        data-countup
        data-target="{{ $target }}"
        data-suffix="{{ $suffix }}"
        data-prefix="{{ $prefix }}"
        data-decimals="{{ $decimals }}"
        data-duration="{{ $duration }}"
    >
        {{ $prefix }}{{ number_format((float) $target, (int) $decimals, '.', '') }}{{ $suffix }}
    </div>

    <div class="mt-1 text-sm text-slate-600">{{ $label }}</div>
</div>
