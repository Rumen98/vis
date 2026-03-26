@extends('layouts.app')

@section('title', 'Защо нас')

@section('content')
<section class="bg-white">
    <div class="mx-auto max-w-6xl px-4 py-14">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div class="max-w-2xl">
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900">
                    Защо нас
                </h1>
                {{-- Removed subtitle text under the page title (per requirements) --}}
            </div>

            <div class="flex gap-3">
                <a href="{{ url('/contact') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-50">
                    Свържете се с нас
                </a>
                <a href="{{ url('/quote') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-50">
                    Вземи оферта
                </a>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="mt-10 rounded-2xl border border-slate-200 bg-slate-50 p-2">
            <div class="flex flex-wrap gap-2">
                <button type="button" data-tab="tab-why"
                        class="tab-btn rounded-xl bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm">
                    Защо нас
                </button>

                {{-- "Process" tab removed per Oliver --}}
                <button type="button" data-tab="tab-how"
                        class="tab-btn rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-white hover:text-slate-900">
                    Как работим
                </button>

                <button type="button" data-tab="tab-faq"
                        class="tab-btn rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-white hover:text-slate-900">
                    Въпроси
                </button>
            </div>
        </div>

        {{-- Tab content --}}
        <div class="mt-6">
            {{-- TAB: WHY --}}
            <div id="tab-why" class="tab-panel">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-extrabold text-slate-900">Ние сме фирма, специализирана в:</h2>

                    <p class="mt-3 text-sm text-slate-600">
                        Изграждането на системи за видеонаблюдение, охранителни системи, контрол на достъпа, паркинг системи,
                        LAN и Wi-Fi мрежи.
                    </p>
                    <p class="mt-3 text-sm text-slate-600">
                        Интегрираме различни видове системи и се стремим към перфектност, устойчивост и модернизация във всяко решение,
                        което предлагаме за вашата сигурност.
                    </p>
                    <p class="mt-3 text-sm text-slate-600">
                        Работим с ясно разбиране, че сигурността не е просто техника, а добре обмислена система, съобразена с реалните нужди
                        на обекта и хората, които я използват.
                    </p>
                </div>

                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">Мислим в перспектива</h3>
                        <p class="mt-2 text-sm text-slate-600">
                            Всеки проект започва с анализ - какво е необходимо днес и какво ще е нужно утре.
                        </p>
                        <p class="mt-2 text-sm text-slate-600">
                            Целта ни е да изграждаме решения, които работят надеждно във времето, могат да се надграждат и не създават
                            излишни усложнения.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">Фокус върху малък и среден бизнес и частни клиенти</h3>
                        <p class="mt-2 text-sm text-slate-600">
                            Работим основно с малък и среден бизнес, офиси, търговски обекти, жилищни сгради и частни домове.
                        </p>
                        <p class="mt-2 text-sm text-slate-600">
                            Разбираме ограниченията, приоритетите и нуждата от баланс между цена, функционалност и качество.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">Интегрирани решения, а не отделни системи</h3>
                        <p class="mt-2 text-sm text-slate-600">
                            Подхождаме цялостно - видеонаблюдение, контрол на достъп, мрежова инфраструктура и охрана трябва да работят
                            като едно цяло, а не като отделни елементи.
                        </p>
                        <p class="mt-2 text-sm text-slate-600">
                            Това гарантира по-висока сигурност, по-лесно управление и по-добра ефективност.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">Отношение и отговорност</h3>
                        <p class="mt-2 text-sm text-slate-600">
                            За нас е важно не просто да монтираме система, а да сме партньор, на когото може да се разчита.
                        </p>
                        <p class="mt-2 text-sm text-slate-600">
                            Комуникираме ясно, работим прецизно и поемаме отговорност за изпълнението и поддръжката на всяко решение.
                        </p>
                    </div>
                </div>

                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Кажи ни какъв е обектът</h3>
                            <p class="mt-1 text-sm text-slate-600">
                                Консултация, оферта и техническо решение според нуждите на обекта.
                            </p>
                        </div>

                        {{-- Button should be black (per requirements) --}}
                        <a href="{{ url('/contact') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                            Изпрати запитване
                        </a>
                    </div>
                </div>
            </div>

            {{-- TAB: HOW --}}
            <div id="tab-how" class="tab-panel hidden">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900">Как работим</h3>
                    <p class="mt-2 text-sm text-slate-600">
                        Държим нещата прости: анализ на нуждите, предложение за решение, изпълнение и поддръжка.
                        Целта е системата да е ясна за ползване и стабилна във времето.
                    </p>

                    {{-- Labels replaced with icons (per requirements) --}}
                    <div class="mt-4 grid gap-4 md:grid-cols-4">
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white shadow-sm">
                                    {{-- Search / analysis icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="7"></circle>
                                        <path d="M21 21l-4.3-4.3"></path>
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-sm font-bold text-slate-900">Анализ</div>
                                    <div class="mt-1 text-sm text-slate-600">Оглед и реални нужди на обекта.</div>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white shadow-sm">
                                    {{-- Lightbulb / solution icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 18h6"></path>
                                        <path d="M10 22h4"></path>
                                        <path d="M12 2a7 7 0 0 0-4 12c.7.6 1 1.4 1 2h6c0-.6.3-1.4 1-2A7 7 0 0 0 12 2z"></path>
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-sm font-bold text-slate-900">Решение</div>
                                    <div class="mt-1 text-sm text-slate-600">Комбинация от системи + бюджет.</div>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white shadow-sm">
                                    {{-- Tools / installation icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14.7 6.3a4 4 0 0 0-5.7 5.6l-6 6a2 2 0 0 0 2.8 2.8l6-6a4 4 0 0 0 5.9-5.4l-2.3 2.3-2.8-2.8 2.1-2.5z"></path>
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-sm font-bold text-slate-900">Монтаж</div>
                                    <div class="mt-1 text-sm text-slate-600">Прецизно изпълнение и настройка.</div>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white shadow-sm">
                                    {{-- Shield / support icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2l8 4v6c0 5-3.4 9.4-8 10-4.6-.6-8-5-8-10V6l8-4z"></path>
                                        <path d="M9 12l2 2 4-4"></path>
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-sm font-bold text-slate-900">Поддръжка</div>
                                    <div class="mt-1 text-sm text-slate-600">Реакция и развитие при нужда.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB: FAQ --}}
            <div id="tab-faq" class="tab-panel hidden">
                <div class="grid gap-4">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-base font-bold text-slate-900">Може ли да се надгражда системата?</h3>
                        <p class="mt-2 text-sm text-slate-600">
                            Да - планираме решенията така, че да могат да се разширяват без излишни усложнения.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-base font-bold text-slate-900">Работите ли с бизнес и частни клиенти?</h3>
                        <p class="mt-2 text-sm text-slate-600">
                            Да - фокусът ни е малък/среден бизнес и частни обекти, с баланс между цена, функционалност и качество.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-base font-bold text-slate-900">Може ли интеграция на различни системи?</h3>
                        <p class="mt-2 text-sm text-slate-600">
                            Да - целта е видеонаблюдение, контрол на достъп, мрежа и охрана да работят като едно цяло.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Tabs logic (vanilla, no dependencies)
    (function () {
        const buttons = document.querySelectorAll('.tab-btn');
        const panels = document.querySelectorAll('.tab-panel');

        function setActive(tabId) {
            panels.forEach(p => p.classList.add('hidden'));
            const active = document.getElementById(tabId);
            if (active) active.classList.remove('hidden');

            buttons.forEach(btn => {
                const isActive = btn.getAttribute('data-tab') === tabId;
                btn.classList.toggle('bg-white', isActive);
                btn.classList.toggle('shadow-sm', isActive);
                btn.classList.toggle('text-slate-900', isActive);
                btn.classList.toggle('text-slate-700', !isActive);
            });
        }

        buttons.forEach(btn => {
            btn.addEventListener('click', () => setActive(btn.getAttribute('data-tab')));
        });

        setActive('tab-why');
    })();
</script>
@endsection