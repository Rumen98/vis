@foreach ($images as $image)
    @include('partials.gallery-item', ['image' => $image])
@endforeach
