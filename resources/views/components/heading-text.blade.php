@props(['text'])

@php
    $safeText = e($text);
    $safeText = preg_replace(
        '/(Видеонаблюдение)(?=[\s,.!?…]|$)/iu',
        '<span class="heading-word">$1</span>',
        $safeText,
    );
@endphp

{!! $safeText !!}
