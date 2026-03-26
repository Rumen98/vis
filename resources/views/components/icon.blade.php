@props([
    'name',
    'size' => 48,
    'alt' => '',
])

<img
    src="{{ asset("icons/png/{$name}.png") }}"
    alt="{{ $alt }}"
    width="{{ $size }}"
    height="{{ $size }}"
    class="opacity-90"
>
