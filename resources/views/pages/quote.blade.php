@extends('layouts.app')

@section('title', 'Запитване за оферта')

@section('content')
    @php
        // Стъпка 1 - трите типа обект от дизайна (стойностите са ключовете на Lead::OBJECT_TYPES).
        $objectTypes = [
            'home' => ['label' => 'Дом', 'note' => 'Апартамент, къща или вила'],
            'office' => ['label' => 'Бизнес', 'note' => 'Офис, магазин, склад, заведение'],
            'building' => ['label' => 'Жилищна сграда', 'note' => 'Вход, общи части, паркинг'],
        ];
    @endphp

    <section class="page-hero">
        <div class="container">
            <div class="eyebrow">Запитване за оферта</div>
            <h1>Кажете ни какво трябва да изградим.</h1>
            <p>
                Фокусираното запитване ни помага да разберем обекта преди първия разговор и да ви
                върнем по-точна насока.
            </p>
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

            <div class="form-shell">
                <aside class="form-aside">
                    <div class="eyebrow">Преди да изпратите</div>
                    <h2>Какво следва?</h2>
                    <p>Преглеждаме запитването, задаваме важните въпроси и уговаряме оглед, когато е необходим.</p>

                    <div class="principles" style="margin-top:28px">
                        <div class="principle">
                            <div class="no">01</div>
                            <div>
                                <h4>Преглеждаме обекта</h4>
                                <p>Тип система, локация, срок и достъп.</p>
                            </div>
                        </div>

                        <div class="principle">
                            <div class="no">02</div>
                            <div>
                                <h4>Свързваме се</h4>
                                <p>Обикновено по телефон в рамките на работното време.</p>
                            </div>
                        </div>

                        <div class="principle">
                            <div class="no">03</div>
                            <div>
                                <h4>Уговаряме следващата стъпка</h4>
                                <p>Насока, оглед или конкретна оферта.</p>
                            </div>
                        </div>
                    </div>

                    <a class="btn primary" href="tel:+359876939373" style="margin-top:28px">Обади се сега</a>
                </aside>

                <form method="POST" action="{{ route('quote.store') }}" class="form-main" data-quote-form>
                    @csrf

                    <div class="progress"><span></span></div>

                    {{-- СТЪПКА 1 — тип обект --}}
                    <div class="step">
                        <div class="step-top">
                            <strong>1. Тип обект</strong>
                            <span>Стъпка 1 от 4</span>
                        </div>

                        <div @class(['choice-grid', 'has-error' => $errors->has('object_type')])>
                            @foreach ($objectTypes as $value => $type)
                                <div class="choice">
                                    <input type="radio" id="ot-{{ $value }}" name="object_type"
                                        value="{{ $value }}" @checked(old('object_type') === $value)>
                                    <label for="ot-{{ $value }}">
                                        {{ $type['label'] }}<br>
                                        <small>{{ $type['note'] }}</small>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        @error('object_type') <p class="field-error" style="margin-top:12px">{{ $message }}</p> @enderror

                        <div class="form-actions">
                            <span></span>
                            <button type="button" class="btn dark" data-next>Продължи →</button>
                        </div>
                    </div>

                    {{-- СТЪПКА 2 — услуга --}}
                    <div class="step">
                        <div class="step-top">
                            <strong>2. Услуга</strong>
                            <span>Стъпка 2 от 4</span>
                        </div>

                        <div @class(['field', 'has-error' => $errors->has('service')])>
                            <label for="service">Какво ви трябва?</label>
                            <select id="service" name="service">
                                @foreach (\App\Models\Lead::SERVICES as $service)
                                    <option value="{{ $service }}" @selected(old('service') === $service)>
                                        {{ $service }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn outline" data-prev>← Назад</button>
                            <button type="button" class="btn dark" data-next>Продължи →</button>
                        </div>
                    </div>

                    {{-- СТЪПКА 3 — обектът --}}
                    <div class="step">
                        <div class="step-top">
                            <strong>3. Обектът</strong>
                            <span>Стъпка 3 от 4</span>
                        </div>

                        <div class="field-grid">
                            <div @class(['field', 'has-error' => $errors->has('area')])>
                                <label for="area">Район / адрес</label>
                                <input id="area" name="area" value="{{ old('area') }}"
                                    placeholder="напр. София, Младост">
                                @error('area') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div @class(['field', 'has-error' => $errors->has('timing')])>
                                <label for="timing">Предпочитан срок</label>
                                <select id="timing" name="timing">
                                    @foreach (\App\Models\Lead::TIMINGS as $timing)
                                        <option value="{{ $timing }}" @selected(old('timing') === $timing)>
                                            {{ $timing }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('timing') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div @class(['field', 'full', 'has-error' => $errors->has('message')])>
                                <label for="message">Кратко описание</label>
                                <textarea id="message" name="message" rows="6"
                                    placeholder="Какво искате да изградим, има ли съществуваща система и какво е важно за вас?">{{ old('message') }}</textarea>
                                @error('message') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn outline" data-prev>← Назад</button>
                            <button type="button" class="btn dark" data-next>Продължи →</button>
                        </div>
                    </div>

                    {{-- СТЪПКА 4 — контакти --}}
                    <div class="step">
                        <div class="step-top">
                            <strong>4. Контакти</strong>
                            <span>Стъпка 4 от 4</span>
                        </div>

                        <div class="field-grid">
                            <div @class(['field', 'has-error' => $errors->has('name')])>
                                <label for="name">Име</label>
                                <input id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                                    placeholder="Име и фамилия">
                                @error('name') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div @class(['field', 'has-error' => $errors->has('phone')])>
                                <label for="phone">Телефон</label>
                                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required
                                    autocomplete="tel" placeholder="+359...">
                                @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div @class(['field', 'full', 'has-error' => $errors->has('email')])>
                                <label for="email">Имейл <span class="field-hint">(по избор)</span></label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    autocomplete="email" placeholder="email@example.com">
                                @error('email') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div @class(['field', 'full', 'has-error' => $errors->has('consent')])>
                                <label class="field-check" for="consent">
                                    <input type="checkbox" id="consent" name="consent" value="1" required
                                        @checked(old('consent'))>
                                    <span>Съгласявам се да се свържете с мен по това запитване.</span>
                                </label>
                                @error('consent') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn outline" data-prev>← Назад</button>
                            <button type="submit" class="btn primary">Изпрати запитване →</button>
                        </div>

                        <p class="form-note">
                            С изпращането се съгласявате да се свържем с вас по това запитване.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
