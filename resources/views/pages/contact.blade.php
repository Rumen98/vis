@extends('layouts.app')

@section('title', 'Контакт')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="eyebrow">Контакт</div>
            <h1>Да говорим за обекта.</h1>
            <p>Консултация, оферта и техническо решение според нуждите на обекта.</p>
        </div>
    </section>

    <section class="section tone-white">
        <div class="container">
            @if (session('success'))
                <div class="flash flash-success">
                    <div>
                        <strong>Готово.</strong>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="contact-grid">
                <aside class="contact-panel">
                    <div class="eyebrow">Контакти</div>
                    <h2>Свържете се с нас.</h2>

                    <div class="contact-list">
                        <div class="contact-row">
                            <span>Телефон</span>
                            <a href="tel:+359876939373">+359 87 693 9373</a>
                        </div>

                        <div class="contact-row">
                            <span>Имейл</span>
                            <a href="mailto:vis.cctv@yahoo.com">vis.cctv@yahoo.com</a>
                        </div>

                        <div class="contact-row">
                            <span>Работно време</span>
                            <strong>
                                Понеделник - Петък: 09:00 - 18:00<br>
                                Събота: 09:00 - 14:00<br>
                                Неделя: Почивен ден
                            </strong>
                        </div>

                        <div class="contact-row">
                            <span>Социални мрежи</span>
                            <a href="https://www.facebook.com/profile.php?id=61583394609243" target="_blank"
                                rel="noopener noreferrer">Facebook ↗</a>
                            <a href="https://www.instagram.com/vis.cctv/" target="_blank"
                                rel="noopener noreferrer">Instagram ↗</a>
                        </div>
                    </div>
                </aside>

                <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                    @csrf

                    <div class="eyebrow">Кратко запитване</div>
                    <h3 style="margin:12px 0 28px">Опишете какво ви трябва.</h3>

                    <div class="field-grid">
                        <div @class(['field', 'has-error' => $errors->has('name')])>
                            <label for="cname">Име</label>
                            <input id="cname" name="name" value="{{ old('name') }}" required autocomplete="name"
                                placeholder="Име и фамилия">
                            @error('name') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div @class(['field', 'has-error' => $errors->has('phone')])>
                            <label for="cphone">Телефон</label>
                            <input id="cphone" type="tel" name="phone" value="{{ old('phone') }}" required
                                autocomplete="tel" placeholder="+359...">
                            @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div @class(['field', 'full', 'has-error' => $errors->has('email')])>
                            <label for="cemail">Имейл <span class="field-hint">(по избор)</span></label>
                            <input id="cemail" type="email" name="email" value="{{ old('email') }}"
                                autocomplete="email" placeholder="email@example.com">
                            @error('email') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div @class(['field', 'full', 'has-error' => $errors->has('object_type')])>
                            <label for="ctype">Тип обект</label>
                            <select id="ctype" name="object_type">
                                <option value="">Изберете</option>
                                @foreach (\App\Models\Lead::OBJECT_TYPES as $value => $label)
                                    <option value="{{ $value }}" @selected(old('object_type') === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('object_type') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div @class(['field', 'full', 'has-error' => $errors->has('message')])>
                            <label for="cmsg">Съобщение</label>
                            <textarea id="cmsg" name="message" rows="5"
                                placeholder="Опишете накратко какво търсите">{{ old('message') }}</textarea>
                            @error('message') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div style="margin-top:26px">
                        <button type="submit" class="btn dark">Изпрати запитване →</button>
                    </div>

                    <p class="form-note">
                        С изпращането се съгласявате да се свържем с вас по предоставените данни.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <section class="cta-band">
        <div class="container">
            <div>
                <div class="eyebrow">Искате по-подробна оферта?</div>
                <h2>Използвайте стъпките за оферта.</h2>
            </div>

            <a class="btn dark" href="{{ route('quote') }}">Към офертата →</a>
        </div>
    </section>
@endsection
