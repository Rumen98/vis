@php($galleryUrl = $image->imageUrl())
@if ($galleryUrl)
    <figure class="group relative aspect-[4/3] w-64 shrink-0 snap-start overflow-hidden rounded-2xl bg-slate-200 sm:w-80">
        <img
            src="{{ $galleryUrl }}"
            alt="{{ $image->caption }}"
            class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
            loading="lazy"
        >
        @if ($image->caption)
            <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/85 to-transparent p-4 pt-12">
                <span class="text-sm font-bold text-white">{{ $image->caption }}</span>
            </figcaption>
        @endif
    </figure>
@endif
