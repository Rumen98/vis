@props([
    'profileUrl',
    'reviews' => [],
])

<section class="bg-white">
    <div class="mx-auto max-w-6xl px-4 py-14">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-red-600">
                    Google Отзиви
                </p>

                <h2 class="mt-3 text-2xl font-extrabold md:text-3xl">
                    Какво казват клиентите за работата ни
                </h2>

                <p class="mt-4 text-slate-600">
                    Реални мнения от хора, които вече са избрали нашите решения за видеонаблюдение,
                    сигурност и техническо изпълнение.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <a
                    href="{{ route('quote') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-red-600 px-5 py-3 font-semibold text-white transition hover:bg-red-500"
                >
                    Запитване за оферта
                </a>

                <a
                    href="{{ $profileUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-5 py-3 font-semibold text-slate-900 transition hover:border-slate-900 hover:bg-slate-50"
                >
                    Виж всички в Google
                </a>
            </div>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2">
            @foreach ($reviews as $review)
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">{{ $review['author'] }}</h3>
                            <p class="text-sm text-slate-500">{{ $review['label'] }}</p>
                        </div>

                        <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-500">
                            {{ $review['time_label'] }}
                        </span>
                    </div>

                    <div class="mt-4 flex items-center gap-1 text-amber-400" aria-label="{{ $review['rating'] }} от 5">
                        @foreach (range(1, $review['rating']) as $star)
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.076 3.313a1 1 0 00.95.69h3.484c.969 0 1.371 1.24.588 1.81l-2.82 2.048a1 1 0 00-.364 1.118l1.077 3.313c.299.921-.755 1.688-1.539 1.118l-2.82-2.048a1 1 0 00-1.176 0l-2.82 2.048c-.783.57-1.838-.197-1.539-1.118l1.077-3.313a1 1 0 00-.364-1.118L2.951 8.74c-.783-.57-.38-1.81.588-1.81h3.484a1 1 0 00.95-.69l1.076-3.313z" />
                            </svg>
                        @endforeach

                        <span class="ml-2 text-sm font-semibold text-slate-700">{{ $review['rating'] }}/5</span>
                    </div>

                    <p class="mt-4 text-[15px] leading-7 text-slate-700">
                        “{{ $review['content'] }}”
                    </p>
                </article>
            @endforeach
        </div>
    </div>
</section>
