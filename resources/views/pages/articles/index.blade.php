@extends('layouts.app')

@section('title', 'Статии')

@section('content')
<section class="bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-14">
        <h1 class="text-3xl md:text-4xl font-extrabold">Статии</h1>
        <p class="mt-3 max-w-2xl text-slate-600">
            Полезни материали и кратки насоки.
        </p>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($articles as $article)
                <a href="{{ route('articles.show', $article->slug) }}"
                   class="rounded-xl border bg-white p-6 hover:shadow-sm transition">
                    <h2 class="text-lg font-bold">{{ $article->title }}</h2>

                    @if($article->excerpt)
                        <p class="mt-2 text-sm text-slate-600">{{ $article->excerpt }}</p>
                    @endif

                    <div class="mt-4 text-sm font-semibold text-red-600">Прочети →</div>
                </a>
            @empty
                <div class="rounded-xl border bg-white p-6 text-slate-700">
                    Няма публикувани статии.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection