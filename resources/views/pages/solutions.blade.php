@extends('layouts.app')

@section('title', 'Решения и статии')

@section('content')
<section class="bg-white">
    <div class="mx-auto max-w-6xl px-4 py-14">
        <div class="max-w-3xl">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900">
                Решения и статии
            </h1>
        </div>

        <div class="mt-10 rounded-2xl border border-slate-200 bg-white p-2">
            <div class="flex flex-wrap gap-2">
                <button type="button" data-main-tab="solutions"
                    class="main-tab-btn rounded-xl bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm">
                    Решения
                </button>

                <button type="button" data-main-tab="articles"
                    class="main-tab-btn rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-white hover:text-slate-900">
                    Статии
                </button>
            </div>
        </div>

        <div class="mt-6">
            <div id="main-tab-solutions" class="main-tab-panel">
                <div class="rounded-2xl border border-slate-200 bg-white p-2">
                    <div class="flex flex-wrap gap-2">
                        <button type="button" data-solution-tab="business"
                            class="solution-tab-btn rounded-xl bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm">
                            Бизнес решения
                        </button>

                        <button type="button" data-solution-tab="smb"
                            class="solution-tab-btn rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-white hover:text-slate-900">
                            Решения за дома
                        </button>
                    </div>
                </div>

                <div class="mt-6">
                    {{-- BUSINESS --}}
                    <div id="solution-tab-business" class="solution-tab-panel">
                        @if ($businessSolutions->count())
                            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                @foreach ($businessSolutions as $solution)
                                    <x-solution-card :solution="$solution" />
                                @endforeach
                            </div>
                        @else
                            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                                <p class="text-sm text-slate-600">Няма добавени бизнес решения още.</p>
                            </div>
                        @endif
                    </div>

                    {{-- SMB --}}
                    <div id="solution-tab-smb" class="solution-tab-panel hidden">
                        @if ($smbSolutions->count())
                            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                @foreach ($smbSolutions as $solution)
                                    <x-solution-card :solution="$solution" />
                                @endforeach
                            </div>
                        @else
                            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                                <p class="text-sm text-slate-600">Няма добавени решения за дома още.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="main-tab-articles" class="main-tab-panel hidden">
                @if ($articles->count())
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($articles as $article)
                            <a href="{{ route('articles.show', $article->slug) }}"
                               class="block rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                @if (!empty($article->featured_image))
                                    <img
                                        src="{{ asset('storage/' . $article->featured_image) }}"
                                        alt="{{ $article->title }}"
                                        class="mb-4 w-full rounded-xl border border-slate-200 object-cover"
                                        style="aspect-ratio: 16/9;"
                                        loading="lazy"
                                    >
                                @endif

                                <div class="mb-3">
                                    @if ($article->solution)
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                            Към решение: {{ $article->solution->title }}
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                            Обща статия
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-lg font-bold leading-tight text-slate-900">
                                    {{ $article->title }}
                                </h3>

                                @if (!empty($article->excerpt))
                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        {{ $article->excerpt }}
                                    </p>
                                @endif

                                <div class="mt-4 text-sm font-semibold text-red-600">
                                    Прочети →
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <p class="text-sm text-slate-600">Няма добавени статии още.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script nonce="{{ Vite::cspNonce() }}">
    (function () {
        const mainButtons = document.querySelectorAll('.main-tab-btn');
        const mainPanels = document.querySelectorAll('.main-tab-panel');

        const solutionButtons = document.querySelectorAll('.solution-tab-btn');
        const solutionPanels = document.querySelectorAll('.solution-tab-panel');

        function setMainTab(tabName) {
            mainPanels.forEach(panel => panel.classList.add('hidden'));
            const activePanel = document.getElementById('main-tab-' + tabName);
            if (activePanel) activePanel.classList.remove('hidden');

            mainButtons.forEach(btn => {
                const active = btn.getAttribute('data-main-tab') === tabName;

                btn.classList.toggle('bg-white', active);
                btn.classList.toggle('shadow-sm', active);
                btn.classList.toggle('text-slate-900', active);
                btn.classList.toggle('text-slate-700', !active);
            });
        }

        function setSolutionTab(tabName) {
            solutionPanels.forEach(panel => panel.classList.add('hidden'));
            const activePanel = document.getElementById('solution-tab-' + tabName);
            if (activePanel) activePanel.classList.remove('hidden');

            solutionButtons.forEach(btn => {
                const active = btn.getAttribute('data-solution-tab') === tabName;

                btn.classList.toggle('bg-white', active);
                btn.classList.toggle('shadow-sm', active);
                btn.classList.toggle('text-slate-900', active);
                btn.classList.toggle('text-slate-700', !active);
            });
        }

        mainButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                setMainTab(btn.getAttribute('data-main-tab'));
            });
        });

        solutionButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                setSolutionTab(btn.getAttribute('data-solution-tab'));
            });
        });

        const hash = window.location.hash.replace('#', '');

        if (hash === 'articles') {
            setMainTab('articles');
        } else {
            setMainTab('solutions');
        }

        setSolutionTab('business');
    })();
</script>
@endsection
