@extends('layouts.app')

@section('title', 'Контакт')

@section('content')
    <section>
        <div class="mx-auto max-w-5xl px-4 py-14">

            <h1 class="text-3xl md:text-4xl font-extrabold text-center">
                Свържете се с нас
            </h1>

            <p class="mt-3 text-slate-600 text-center max-w-2xl mx-auto">
                Консултация, оферта и техническо решение според нуждите на
обекта.
            </p>

            {{-- Контактна информация --}}
            <div class="mt-12 grid gap-6 md:grid-cols-3">

                {{-- Телефон --}}
                <div class="rounded-xl border bg-white p-6 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-3">
                <div class="h-10 w-10 flex items-center justify-center rounded-full bg-red-600">
                    <img
                        src="/icons/64pxcontacts.png"
                        alt="Контакти"
                        class="h-5 w-5 object-contain"
                    >
                </div>
                <h3 class="font-bold text-lg">Контакти</h3>
            </div>

                    <div class="space-y-2 text-slate-700">

                        <div>
                            <a href="tel:+359876939373" class="text-lg hover:text-red-600 transition">
                                +359 87 693 9373
                            </a>
                        </div>

                        <div>
                            <a href="mailto:vis.cctv@yahoo.com" class="hover:text-red-600 transition">
                                vis.cctv@yahoo.com
                            </a>
                        </div>

                    </div>
                </div>

                {{-- Работно време --}}
                <div class="rounded-xl border bg-white p-6 text-center md:text-left">

                    <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                        <div class="h-10 w-10 flex items-center justify-center rounded-full bg-black text-white">
                            <img src="{{ asset('icons/workTime.png') }}" class="w-5 h-5" alt="Instagram">
                        </div>
                        <h3 class="font-bold text-lg">Работно време</h3>
                    </div>

                    <div class="space-y-2 text-slate-700">

                        <div class="flex justify-between border-b pb-2">
                            <span>Понеделник - Петък</span>
                            <span class="font-semibold">09:00 - 18:00</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Събота</span>
                            <span class="font-semibold">09:00 - 14:00</span>
                        </div>

                    </div>

                    <div class="mt-4 text-xs text-slate-500">
                        Неделя: Почивен ден
                    </div>

                </div>

                {{-- Социални --}}
                <div class="rounded-xl border bg-white p-6 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                        <div
                            class="h-10 w-10 flex items-center justify-center rounded-full bg-blue-600 text-white font-bold">
                            #
                        </div>
                        <h3 class="font-bold text-lg">Социални мрежи</h3>
                    </div>

                    <div class="flex items-center justify-center md:justify-start gap-6">

                        <a href="https://www.facebook.com/profile.php?id=61583394609243" target="_blank"
                            class="flex items-center gap-2 hover:scale-105 transition">
                            <img src="{{ asset('icons/facebook.png') }}" class="w-6 h-6" alt="Facebook">
                            <span class="text-slate-700 hover:text-red-600 transition">
                                Facebook
                            </span>
                        </a>

                        <a href="https://www.instagram.com/vis.cctv/" target="_blank"
                            class="flex items-center gap-2 hover:scale-105 transition">
                            <img src="{{ asset('icons/instagram.png') }}" class="w-6 h-6" alt="Instagram">
                            <span class="text-slate-700 hover:text-red-600 transition">
                                Instagram
                            </span>
                        </a>

                    </div>
                </div>

            </div>

            @if (session('success'))
                <div class="mt-10 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Форма --}}
            <div class="mt-12 mx-auto max-w-3xl">
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold">Име</label>
                        <input name="name" value="{{ old('name') }}" required
                            class="mt-1 w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Име и фамилия">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold">Телефон</label>
                        <input name="phone" value="{{ old('phone') }}" required
                            class="mt-1 w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="+359...">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold">Имейл (по избор)</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="mt-1 w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="email@example.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold">Тип обект</label>
                        <select name="object_type"
                            class="mt-1 w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">Изберете</option>
                            <option value="home" @selected(old('object_type') === 'home')>Дом</option>
                            <option value="office" @selected(old('object_type') === 'office')>Офис</option>
                            <option value="shop" @selected(old('object_type') === 'shop')>Магазин</option>
                            <option value="other" @selected(old('object_type') === 'other')>Друго</option>
                        </select>
                        @error('object_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold">Съобщение</label>
                        <textarea name="message" rows="5"
                            class="mt-1 w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Опишете накратко какво търсите">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 font-semibold text-white hover:bg-red-500 transition">
                        Изпрати запитване
                    </button>

                    <p class="text-sm text-slate-500">
                        С изпращането се съгласявате да се свържем с вас по предоставените данни.
                    </p>
                </form>
            </div>

        </div>
    </section>
@endsection
