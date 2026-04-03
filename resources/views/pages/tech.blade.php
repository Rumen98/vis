@extends('layouts.app')

@section('title', 'Техника')

@section('content')
<section class="bg-white">
    <div class="mx-auto max-w-6xl px-4 py-14">
        <div class="max-w-3xl">
            <h1 class="text-3xl md:text-4xl font-extrabold">Техника</h1>
            <p class="mt-3 text-slate-600">
                Работим с доказани световни производители, за да гарантираме надеждност и дългосрочна сигурност. Тук може да научите повече за технологиите и част от марките, които използваме при изграждането на нашите решения.
            </p>
        </div>

        <div class="mt-14">
            <div class="max-w-3xl">
                <h2 class="text-2xl md:text-3xl font-extrabold">Брандове</h2>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($brands as $brand)
                    <x-brand-card :brand="$brand" />
                @empty
                    <div class="rounded-xl border bg-white p-4 md:p-6 md:col-span-2 lg:col-span-3">
                        <p class="text-slate-600">
                            Не бяха открити папки с марки. Добави папки в `public/images/brands` или `public/brands`,
                            за да се появят автоматично тук.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
