@extends('layouts.app')

@section('title', 'Запитване за оферта')

@section('content')
<section class="bg-slate-50">
    <div class="mx-auto max-w-4xl px-4 py-14">
        <h1 class="text-3xl md:text-4xl font-extrabold">Запитване за оферта</h1>
        <p class="mt-3 max-w-2xl text-slate-600">
            Опишете обекта и какво искате да изградим. Ще получите ориентировъчна оферта или предложение за оглед.
        </p>

        @if(session('success'))
            <div class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('quote.store') }}" class="mt-10 grid gap-6 md:grid-cols-2">
            @csrf

            <div>
                <label class="block text-sm font-semibold">Име</label>
                <input
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="mt-1 w-full rounded-lg border px-3 py-2"
                    placeholder="Име и фамилия"
                >
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold">Телефон</label>
                <input
                    name="phone"
                    value="{{ old('phone') }}"
                    required
                    class="mt-1 w-full rounded-lg border px-3 py-2"
                    placeholder="+359..."
                >
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold">Имейл (по избор)</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="mt-1 w-full rounded-lg border px-3 py-2"
                    placeholder="email@example.com"
                >
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold">Тип обект</label>
                <select name="object_type" class="mt-1 w-full rounded-lg border px-3 py-2">
                    <option value="">Изберете</option>
                    <option value="home" @selected(old('object_type') === 'home')>Дом</option>
                    <option value="office" @selected(old('object_type') === 'office')>Офис</option>
                    <option value="shop" @selected(old('object_type') === 'shop')>Магазин</option>
                    <option value="other" @selected(old('object_type') === 'other')>Друго</option>
                </select>
                @error('object_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold">Описание</label>
                <textarea
                    name="message"
                    rows="6"
                    class="mt-1 w-full rounded-lg border px-3 py-2"
                    placeholder="Брой камери, вътре/вън, интернет, срок и др."
                >{{ old('message') }}</textarea>
                @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <button class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 font-semibold text-white hover:bg-red-500">
                    Изпрати запитване за оферта
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
