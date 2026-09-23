@props([
    'profileUrl',
    'reviews' => [],
])

<section class="section home-light reviews-home">
    <div class="container">
        <div class="section-head">
            <div class="copy">
                <div class="eyebrow">Google отзиви</div>
                <h2>Какво казват клиентите за работата ни.</h2>
            </div>

            <p class="lead">
                Реални мнения от хора, които вече са избрали нашите решения за видеонаблюдение,
                сигурност и техническо изпълнение.
            </p>
        </div>

        <div class="grid grid-4 reviews-grid">
            @foreach ($reviews as $review)
                <article class="quote-card">
                    <div>
                        <div class="quote-top">
                            <div class="stars" aria-label="{{ $review['rating'] }} от 5">
                                {{ str_repeat('★', (int) $review['rating']) }}{{ str_repeat('☆', 5 - (int) $review['rating']) }}
                            </div>

                            <span class="quote-when">{{ $review['time_label'] }}</span>
                        </div>

                        <blockquote>“{{ $review['content'] }}”</blockquote>
                    </div>

                    <small>{{ $review['author'] }} · {{ $review['label'] }}</small>
                </article>
            @endforeach
        </div>

        <div style="margin-top:28px;display:flex;flex-wrap:wrap;gap:12px">
            <a class="btn primary" href="{{ route('quote') }}">Запитване за оферта →</a>
            <a class="btn outline" href="{{ $profileUrl }}" target="_blank" rel="noopener noreferrer">Виж всички в Google ↗</a>
        </div>
    </div>
</section>
