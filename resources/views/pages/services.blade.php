@extends('layouts.app')

@section('title', 'Услуги')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="eyebrow">Услуги</div>
            <h1>Системи, изградени около обекта.</h1>
            <p>
                Изграждаме системи за сигурност и комуникация за домове, офиси и обекти.
                От оглед до монтаж и поддръжка.
            </p>
        </div>
    </section>

    <section class="section tone-white">
        <div class="container">
            <div class="grid grid-3">
                @forelse ($services as $service)
                    <a class="list-card" href="{{ route('services.show', $service->slug) }}">
                        <div>
                            <span class="tag">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / Услуга</span>

                            @if (! empty($service->icon))
                                <span class="card-icon" aria-hidden="true">
                                    <img src="{{ asset('icons/' . $service->icon) }}" alt="" loading="lazy">
                                </span>
                            @endif

                            <h3>{{ $service->title }}</h3>

                            @if (! empty($service->description))
                                <p>{!! nl2br(e($service->description)) !!}</p>
                            @endif

                            @php($bullets = is_array($service->bullets) ? $service->bullets : [])

                            @if (count($bullets))
                                <ul>
                                    @foreach ($bullets as $item)
                                        <li>{{ is_array($item) ? ($item['value'] ?? '') : $item }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="card-foot"><span class="btn dark" style="min-height:44px">Научи повече →</span></div>
                    </a>
                @empty
                    <div class="empty-note" style="grid-column:1/-1">
                        Няма добавени услуги още. Влез в админ панела и добави поне една услуга.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="cta-band">
        <div class="container">
            <div>
                <div class="eyebrow">Не сте сигурни?</div>
                <h2>Кажете какъв е обектът.</h2>
                <p>Опиши обекта и изискванията - ще предложим най-подходящия вариант.</p>
            </div>

            <a class="btn dark" href="{{ route('quote') }}">Запитване за оферта →</a>
        </div>
    </section>
@endsection
