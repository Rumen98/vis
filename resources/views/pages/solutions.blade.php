@extends('layouts.app')

@section('title', 'Решения и статии')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="eyebrow">Решения</div>
            <h1>Правилната система за конкретния обект.</h1>
            <p>
                Дом, офис, магазин, ресторант, паркинг или жилищна сграда – различният риск изисква
                различна комбинация от технологии.
            </p>

            <div class="hero-actions">
                <a class="btn primary" href="#business">Бизнес решения</a>
                <a class="btn ghost" href="#smb">Решения за дома</a>
                <a class="btn ghost" href="#articles">Статии</a>
            </div>
        </div>
    </section>

    <section class="section tone-white" id="business">
        <div class="container">
            <div class="section-head">
                <div class="copy">
                    <div class="eyebrow">За бизнеса</div>
                    <h2>Контрол, когато обектът работи.</h2>
                </div>

                <p class="lead">
                    Комбинираме видеонаблюдение, охрана, достъп и мрежа според процесите в конкретния бизнес.
                </p>
            </div>

            @if ($businessSolutions->count())
                <div class="grid grid-3">
                    @foreach ($businessSolutions as $solution)
                        <x-solution-card :solution="$solution" :index="$loop->iteration" />
                    @endforeach
                </div>
            @else
                <div class="empty-note">Няма добавени бизнес решения още.</div>
            @endif
        </div>
    </section>

    <section class="section tone-soft" id="smb">
        <div class="container">
            <div class="section-head">
                <div class="copy">
                    <div class="eyebrow">За дома</div>
                    <h2>Спокойствие, когато не сте там.</h2>
                </div>

                <p class="lead">
                    Къщи, вили и жилищни сгради с видеонаблюдение, аларма, периметрова защита и контрол на входовете.
                </p>
            </div>

            @if ($smbSolutions->count())
                <div class="grid grid-3">
                    @foreach ($smbSolutions as $solution)
                        <x-solution-card :solution="$solution" :index="$loop->iteration" />
                    @endforeach
                </div>
            @else
                <div class="empty-note">Няма добавени решения за дома още.</div>
            @endif
        </div>
    </section>

    <section class="section tone-white" id="articles">
        <div class="container">
            <div class="section-head">
                <div class="copy">
                    <div class="eyebrow">Статии</div>
                    <h2>Практични материали от работата.</h2>
                </div>

                <a class="btn outline" href="{{ route('articles.index') }}">Всички статии →</a>
            </div>

            @if ($articles->count())
                <div class="article-grid">
                    @foreach ($articles as $article)
                        <a class="article-card" href="{{ route('articles.show', $article->slug) }}">
                            <div>
                                <span class="tag">
                                    {{ $article->solution ? 'Към решение: ' . $article->solution->title : 'Обща статия' }}
                                </span>

                                <h3>{{ $article->title }}</h3>

                                @if (! empty($article->excerpt))
                                    <p>{{ $article->excerpt }}</p>
                                @endif
                            </div>

                            <div class="card-foot">
                                <span>Прочети</span>
                                <span class="arrow">→</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-note">Няма добавени статии още.</div>
            @endif
        </div>
    </section>

    <section class="cta-band">
        <div class="container">
            <div>
                <div class="eyebrow">Не виждате вашия тип обект?</div>
                <h2>Опишете го. Ще изградим решението.</h2>
            </div>

            <a class="btn dark" href="{{ route('quote') }}">Запитване →</a>
        </div>
    </section>
@endsection
