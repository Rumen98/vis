<!doctype html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $pageTitle = trim($__env->yieldContent('title'));
        $siteTitle = 'ВиС - Видеонаблюдение и сигурност';
        $fullTitle =
            $pageTitle && mb_strtolower($pageTitle) !== 'начало' ? $pageTitle . ' | ' . $siteTitle : $siteTitle;
    @endphp

    <title>{{ $fullTitle }}</title>
    <meta name="description"
        content="Видеонаблюдение, охранителни системи, контрол на достъп, LAN и Wi-Fi мрежи, паркинг решения. Проектиране, монтаж и поддръжка.">
    <link rel="canonical" href="https://viscctv.com">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ВиС CCTV">
    <meta property="og:title" content="ВиС - Видеонаблюдение и сигурност">
    <meta property="og:description"
        content="Видеонаблюдение, охранителни системи, контрол на достъп, LAN и Wi-Fi мрежи и паркинг решения.">
    <meta property="og:url" content="https://viscctv.com">
    <meta property="og:image" content="https://viscctv.com/images/og/og-default.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ВиС - Видеонаблюдение и сигурност">
    <meta name="twitter:description"
        content="Видеонаблюдение, охранителни системи, контрол на достъп, LAN и Wi-Fi мрежи и паркинг решения.">
    <meta name="twitter:image" content="https://viscctv.com/images/og/og-default.jpg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700;800&display=swap"
        rel="stylesheet">

    @hasSection('preload')
        @yield('preload')
    @endif

    <style>
        @media (min-width: 1024px) {
            .nav-desktop {
                display: flex !important;
            }

            .nav-mobile {
                display: none !important;
            }

            .mobile-menu {
                display: none !important;
            }
        }

        @media (max-width: 1023.98px) {
            .nav-desktop {
                display: none !important;
            }

            .nav-mobile {
                display: flex !important;
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-white text-slate-900" style="padding-top: env(safe-area-inset-top);">
    <header class="bg-black text-white" style="padding-top: env(safe-area-inset-top);">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3 md:gap-6 md:py-4">
            <a href="{{ route('home') }}" class="flex items-center">
                <picture>
                    <source srcset="{{ asset('images/logo/logo-white.webp') }}" type="image/webp">
                    <img src="{{ asset('images/logo/logo-white.png') }}" alt="ВиС - Видеонаблюдение и сигурност"
                        class="h-8 w-auto sm:h-9 md:h-12" width="1600" height="710">
                </picture>
            </a>

            <nav class="nav-desktop items-center gap-4 text-sm">
                <a href="{{ route('services') }}" class="hover:opacity-80">Услуги</a>
                <a href="{{ route('solutions') }}" class="hover:opacity-80">Решения</a>
                <a href="{{ route('tech') }}" class="hover:opacity-80">Техника</a>
                <a href="{{ route('why') }}" class="hover:opacity-80">Защо нас</a>
                <a href="{{ route('contact') }}" class="hover:opacity-80">Контакт</a>
                <a href="{{ route('quote') }}" class="rounded bg-red-600 px-3 py-1 hover:bg-red-500">Оферта</a>
            </nav>

            <div class="nav-mobile items-center gap-2 sm:gap-3">
                <a href="{{ route('quote') }}"
                    class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold leading-none hover:bg-red-500">
                    Оферта
                </a>

                <button type="button" id="mobileMenuBtn" aria-controls="mobileMenu" aria-expanded="false" aria-label="Меню"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-white/20 bg-white/5 hover:bg-white/10">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="mobile-menu hidden border-t border-white/10 bg-black">
            <div class="mx-auto flex max-w-6xl flex-col gap-2 px-4 py-4 text-sm">
                <a href="{{ route('services') }}" class="py-2 hover:opacity-80">Услуги</a>
                <a href="{{ route('solutions') }}" class="py-2 hover:opacity-80">Решения</a>
                <a href="{{ route('tech') }}" class="py-2 hover:opacity-80">Техника</a>
                <a href="{{ route('why') }}" class="py-2 hover:opacity-80">Защо нас</a>
                <a href="{{ route('contact') }}" class="py-2 hover:opacity-80">Контакт</a>
            </div>
        </div>
    </header>

    <main class="flex-1 bg-white">
        @yield('content')
    </main>
    <footer class="bg-black text-white">
        <div class="mx-auto max-w-6xl px-4 py-10">
            <div class="flex flex-col gap-8 md:flex-row md:items-start md:justify-between">
                <div class="flex flex-col items-center text-center md:items-start md:text-left">
                    <picture>
                        <source srcset="{{ asset('images/logo/logo-white.webp') }}" type="image/webp">
                        <img src="{{ asset('images/logo/logo-white.png') }}" class="h-10 w-auto md:h-12" alt="ВиС" width="1600" height="710">
                    </picture>

                    <p class="mt-4 font-semibold text-red-600">
                        Модерни решения за защита
                    </p>

                    <p class="text-white">
                        на дома, офиса и бизнеса
                    </p>
                </div>

                <div class="space-y-6 text-sm text-white/80">
                    <div>
                        <div class="font-semibold text-white">Контакти</div>
                        <div class="mt-2">
                            <a href="tel:+359876939373" class="transition hover:text-red-500">
                                +359 87 693 9373
                            </a>
                        </div>
                        <div>Понеделник - Петък: 09:00 - 18:00</div>
                        <div>Събота: 09:00 - 14:00</div>
                    </div>

                    <div>
                        <div class="font-semibold text-white">Социални мрежи</div>

                        <div class="mt-2 flex items-center gap-5">
                            <a href="https://www.facebook.com/profile.php?id=61583394609243" target="_blank"
                                rel="noopener" class="flex items-center gap-2 transition hover:opacity-80">
                                <picture>
                                    <source srcset="{{ asset('icons/facebook.webp') }}" type="image/webp">
                                    <img src="{{ asset('icons/facebook.png') }}" class="h-5 w-5" alt="Facebook" width="512" height="512">
                                </picture>
                                <span class="text-white/80 transition hover:text-white">Facebook</span>
                            </a>

                            <a href="https://www.instagram.com/vis.cctv/" target="_blank" rel="noopener"
                                class="flex items-center gap-2 transition hover:opacity-80">
                                <picture>
                                    <source srcset="{{ asset('icons/instagram.webp') }}" type="image/webp">
                                    <img src="{{ asset('icons/instagram.png') }}" class="h-5 w-5" alt="Instagram" width="512" height="512">
                                </picture>
                                <span class="text-white/80 transition hover:text-white">Instagram</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center text-sm text-white/50">
                © 2026 Всички права запазени.
            </div>
        </div>
    </footer>

    <script nonce="{{ Vite::cspNonce() }}">
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobileMenuBtn');
            const menu = document.getElementById('mobileMenu');

            if (!btn || !menu) return;

            function closeMenu() {
                menu.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            }

            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const isHidden = menu.classList.contains('hidden');
                menu.classList.toggle('hidden');
                btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
            });

            document.addEventListener('click', function(e) {
                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                    closeMenu();
                }
            });

            menu.querySelectorAll('a').forEach(function(a) {
                a.addEventListener('click', closeMenu);
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeMenu();
                }
            });
        });
    </script>
</body>

</html>
