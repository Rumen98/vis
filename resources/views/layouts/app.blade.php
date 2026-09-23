<!doctype html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    @php
        $pageTitle = trim($__env->yieldContent('title'));
        $siteTitle = 'ВиС - Видеонаблюдение и сигурност';
        $fullTitle =
            $pageTitle && mb_strtolower($pageTitle) !== 'начало' ? $pageTitle . ' | ' . $siteTitle : $siteTitle;

        $bodyClass = trim($__env->yieldContent('body-class')) ?: 'inner-page';
    @endphp

    <title>{{ $fullTitle }}</title>
    <meta name="description"
        content="Видеонаблюдение, охранителни системи, контрол на достъп, LAN и Wi-Fi мрежи, паркинг решения. Проектиране, монтаж и поддръжка.">
    <link rel="canonical" href="https://viscctv.com">
    <meta name="theme-color" content="#0a0b0c">

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
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ВиС - Видеонаблюдение и сигурност">
    <meta name="twitter:description"
        content="Видеонаблюдение, охранителни системи, контрол на достъп, LAN и Wi-Fi мрежи и паркинг решения.">
    <meta name="twitter:image" content="https://viscctv.com/images/og/og-default.jpg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sofia+Sans+Extra+Condensed:wght@500;600;700;800;900&display=swap"
        rel="stylesheet">

    @hasSection('preload')
        @yield('preload')
    @endif

    @vite(['resources/css/app.css', 'resources/css/blackgrid.css', 'resources/js/app.js'])
</head>

<body class="{{ $bodyClass }}">
    <a class="skip-link" href="#main-content">Към съдържанието</a>

    <div class="utility">
        <div class="container">
            <span>Системи за сигурност · София и региона</span>
            <a href="tel:+359876939373">Обади се +359 87 693 9373</a>
        </div>
    </div>

    <header class="site-header">
        <div class="container nav">
            <a href="{{ route('home') }}" aria-label="ВиС начало">
                <img src="{{ asset('images/logo/logo-footer-com.png') }}" alt="ВиС - Видеонаблюдение и сигурност"
                    class="logo-img header-logo" width="2013" height="617">
            </a>

            <button type="button" class="menu-btn" aria-controls="main-nav" aria-expanded="false"
                aria-label="Отвори меню">
                МЕНЮ
            </button>

            <nav class="nav-links" id="main-nav" aria-label="Основна навигация">
                <a href="{{ route('services') }}" @class(['active' => request()->routeIs('services')])>Услуги</a>
                <a href="{{ route('solutions') }}" @class(['active' => request()->routeIs('solutions*')])>Решения</a>
                <a href="{{ route('tech') }}" @class(['active' => request()->routeIs('tech') || request()->routeIs('brands.*')])>Техника</a>
                <a href="{{ route('why') }}" @class(['active' => request()->routeIs('why')])>Защо нас</a>
                <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Контакт</a>
                <a href="{{ route('quote') }}" class="nav-cta">Оферта</a>
            </nav>
        </div>
    </header>

    <main id="main-content">
        @yield('content')
    </main>

    <footer class="site-footer" id="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/logo-footer-com.png') }}" alt="ВиС" class="logo-img footer-logo"
                            width="2013" height="617">
                    </a>

                    <p>
                        Модерни решения за защита на дома, офиса и бизнеса. Видеонаблюдение, охранителни системи,
                        контрол на достъп и мрежова инфраструктура.
                    </p>
                </div>

                <div class="footer-col">
                    <h4>Услуги</h4>
                    <a href="{{ route('services') }}">Всички услуги</a>
                    <a href="{{ route('solutions') }}">Решения</a>
                    <a href="{{ route('tech') }}">Техника</a>
                    <a href="{{ route('quote') }}">Запитване за оферта</a>
                </div>

                <div class="footer-col">
                    <h4>Компания</h4>
                    <a href="{{ route('why') }}">Защо нас</a>
                    <a href="{{ route('articles.index') }}">Статии</a>
                    <a href="{{ route('contact') }}">Контакт</a>
                </div>

                <div class="footer-col">
                    <h4>Контакти</h4>
                    <a href="tel:+359876939373">+359 87 693 9373</a>
                    <a href="mailto:vis.cctv@yahoo.com">vis.cctv@yahoo.com</a>
                    <span>Понеделник - Петък: 09:00 - 18:00</span>
                    <span>Събота: 09:00 - 14:00</span>
                    <a href="https://www.facebook.com/profile.php?id=61583394609243" target="_blank"
                        rel="noopener noreferrer">Facebook ↗</a>
                    <a href="https://www.instagram.com/vis.cctv/" target="_blank" rel="noopener noreferrer">Instagram ↗</a>
                </div>
            </div>

            <div class="footer-bottom">
                <span>© {{ date('Y') }} ВиС - Видеонаблюдение и сигурност. Всички права запазени.</span>
                <span>София и региона · Пон–Пет 09:00–18:00 · Събота 09:00–14:00</span>
            </div>
        </div>
    </footer>

    <div class="mobile-action-bar" aria-label="Бързи действия">
        <a class="mobile-call" href="tel:+359876939373">Обади се</a>
        <a class="mobile-quote" href="{{ route('quote') }}">Оферта →</a>
    </div>
</body>

</html>
