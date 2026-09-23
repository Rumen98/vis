@extends('layouts.app')

@section('title', 'Защо нас')

@section('content')
    @php
        $principles = [
            [
                'title' => 'Мислим в перспектива',
                'paragraphs' => [
                    'Всеки проект започва с анализ - какво е необходимо днес и какво ще е нужно утре.',
                    'Целта ни е да изграждаме решения, които работят надеждно във времето, могат да се надграждат и не създават излишни усложнения.',
                ],
            ],
            [
                'title' => 'Фокус върху малък и среден бизнес и частни клиенти',
                'paragraphs' => [
                    'Работим основно с малък и среден бизнес, офиси, търговски обекти, жилищни сгради и частни домове.',
                    'Разбираме ограниченията, приоритетите и нуждата от баланс между цена, функционалност и качество.',
                ],
            ],
            [
                'title' => 'Интегрирани решения, а не отделни системи',
                'paragraphs' => [
                    'Подхождаме цялостно - видеонаблюдение, контрол на достъп, мрежова инфраструктура и охрана трябва да работят като едно цяло, а не като отделни елементи.',
                    'Това гарантира по-висока сигурност, по-лесно управление и по-добра ефективност.',
                ],
            ],
            [
                'title' => 'Отношение и отговорност',
                'paragraphs' => [
                    'За нас е важно не просто да монтираме система, а да сме партньор, на когото може да се разчита.',
                    'Комуникираме ясно, работим прецизно и поемаме отговорност за изпълнението и поддръжката на всяко решение.',
                ],
            ],
        ];

        $howWeWork = [
            ['no' => '01', 'title' => 'Анализ', 'text' => 'Оглед и реални нужди на обекта.'],
            ['no' => '02', 'title' => 'Решение', 'text' => 'Комбинация от системи + бюджет.'],
            ['no' => '03', 'title' => 'Монтаж', 'text' => 'Прецизно изпълнение и настройка.'],
            ['no' => '04', 'title' => 'Поддръжка', 'text' => 'Реакция и развитие при нужда.'],
        ];

        $faq = [
            [
                'q' => 'Може ли да се надгражда системата?',
                'a' => 'Да - планираме решенията така, че да могат да се разширяват без излишни усложнения.',
            ],
            [
                'q' => 'Работите ли с бизнес и частни клиенти?',
                'a' => 'Да - фокусът ни е малък/среден бизнес и частни обекти, с баланс между цена, функционалност и качество.',
            ],
            [
                'q' => 'Може ли интеграция на различни системи?',
                'a' => 'Да - целта е видеонаблюдение, контрол на достъп, мрежа и охрана да работят като едно цяло.',
            ],
        ];
    @endphp

    <section class="page-hero">
        <div class="container">
            <div class="eyebrow">Защо нас</div>
            <h1>Система, а не просто техника.</h1>
            <p>
                Работим в София и региона с ясно разбиране, че сигурността не е просто техника, а добре
                обмислена система, съобразена с реалните нужди на обекта и хората, които я използват.
            </p>

            <div class="hero-actions">
                <a class="btn primary" href="{{ route('quote') }}">Вземи оферта →</a>
                <a class="btn ghost" href="{{ route('contact') }}">Свържете се с нас</a>
            </div>
        </div>
    </section>

    <section class="section tone-white">
        <div class="container statement">
            <div>
                <div class="eyebrow">Ние сме фирма, специализирана в</div>

                <h2 style="margin-top:14px">Мислим в перспектива.<span>Изпълняваме практично.</span></h2>

                <p class="lead" style="margin-top:24px">
                    Изграждането на системи за видеонаблюдение, охранителни системи, контрол на достъпа,
                    паркинг системи, LAN и Wi-Fi мрежи.
                </p>

                <p class="lead">
                    Интегрираме различни видове системи и се стремим към перфектност, устойчивост и
                    модернизация във всяко решение, което предлагаме за вашата сигурност.
                </p>
            </div>

            <div class="principles light">
                @foreach ($principles as $principle)
                    <div class="principle">
                        <div class="no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <div>
                            <h4>{{ $principle['title'] }}</h4>
                            @foreach ($principle['paragraphs'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section tone-dark">
        <div class="container">
            <div class="eyebrow">Как работим</div>
            <h2 style="margin:14px 0 18px">Анализ. Решение. Монтаж. Поддръжка.</h2>
            <p class="lead" style="margin-bottom:48px">
                Държим нещата прости: анализ на нуждите, предложение за решение, изпълнение и поддръжка.
                Целта е системата да е ясна за ползване и стабилна във времето.
            </p>

            <div class="process process-4">
                @foreach ($howWeWork as $step)
                    <div class="process-step">
                        <div class="no">{{ $step['no'] }}</div>
                        <h4>{{ $step['title'] }}</h4>
                        <p>{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section tone-soft">
        <div class="container">
            <div class="section-head">
                <div class="copy">
                    <div class="eyebrow">Въпроси</div>
                    <h2>Ясно, преди да започнем.</h2>
                </div>
            </div>

            <div class="faq">
                @foreach ($faq as $item)
                    <div class="faq-item">
                        <button type="button" class="faq-q" aria-expanded="false">
                            <span>{{ $item['q'] }}</span>
                            <span>+</span>
                        </button>
                        <div class="faq-a">{{ $item['a'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cta-band">
        <div class="container">
            <div>
                <div class="eyebrow">Кажи ни какъв е обектът</div>
                <h2>Ще предложим техническо решение.</h2>
                <p>Консултация, оферта и техническо решение според нуждите на обекта.</p>
            </div>

            <a class="btn dark" href="{{ route('contact') }}">Изпрати запитване →</a>
        </div>
    </section>
@endsection
