@php($galleryUrl = $image->imageUrl())
@if ($galleryUrl)
    <article class="gallery-item">
        <img
            src="{{ $galleryUrl }}"
            alt="{{ $image->caption }}"
            loading="lazy"
            decoding="async"
        >
        @if ($image->caption)
            <div class="gallery-caption">{{ $image->caption }}</div>
        @endif
    </article>
@endif
