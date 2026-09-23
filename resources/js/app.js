import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const statElements = document.querySelectorAll('[data-countup]');

    if (! statElements.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const formatter = new Intl.NumberFormat('bg-BG', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 1,
    });

    const formatValue = (element, value) => {
        const decimals = Number(element.dataset.decimals ?? 0);
        const prefix = element.dataset.prefix ?? '';
        const suffix = element.dataset.suffix ?? '';
        const normalizedValue = Number(Number(value).toFixed(decimals));

        return `${prefix}${formatter.format(normalizedValue)}${suffix}`;
    };

    const setFinalValue = (element) => {
        element.textContent = formatValue(element, Number(element.dataset.target ?? 0));
    };

    if (prefersReducedMotion) {
        statElements.forEach(setFinalValue);

        return;
    }

    const animateValue = (element) => {
        if (element.dataset.countupAnimated === 'true') {
            return;
        }

        element.dataset.countupAnimated = 'true';

        const target = Number(element.dataset.target ?? 0);
        const duration = Number(element.dataset.duration ?? 1400);
        const start = performance.now();

        const step = (timestamp) => {
            const progress = Math.min((timestamp - start) / duration, 1);
            const easedProgress = 1 - Math.pow(1 - progress, 3);

            element.textContent = formatValue(element, target * easedProgress);

            if (progress < 1) {
                window.requestAnimationFrame(step);

                return;
            }

            setFinalValue(element);
        };

        element.textContent = formatValue(element, 0);
        window.requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (! entry.isIntersecting) {
                    return;
                }

                animateValue(entry.target);
                observer.unobserve(entry.target);
            });
        },
        {
            threshold: 0,
        },
    );

    statElements.forEach((element) => {
        observer.observe(element);
    });
});

/* =============================================================
   ViS BLACKGRID — UI behaviours
   Ported from the redesign export (assets/js/main.js) and extended
   for the Laravel views: mobile nav, FAQ, tabs, sliders, stepped
   quote form (with server-side validation awareness).
   ============================================================= */
document.addEventListener('DOMContentLoaded', () => {
    /* ---- Mobile navigation ---- */
    const menuBtn = document.querySelector('.menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (menuBtn && navLinks) {
        const closeNav = () => {
            navLinks.classList.remove('open');
            menuBtn.setAttribute('aria-expanded', 'false');
        };

        menuBtn.addEventListener('click', () => {
            const open = navLinks.classList.toggle('open');
            menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        navLinks.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeNav));

        window.addEventListener('resize', () => {
            if (window.innerWidth > 1020) {
                closeNav();
            }
        });
    }

    /* ---- FAQ accordion ---- */
    document.querySelectorAll('.faq-q').forEach((btn) => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            const open = item.classList.toggle('open');

            btn.setAttribute('aria-expanded', open ? 'true' : 'false');

            const icon = btn.querySelector('span:last-child');

            if (icon) {
                icon.textContent = open ? '−' : '+';
            }
        });
    });

    /* ---- Tabs ---- */
    document.querySelectorAll('[data-tabs]').forEach((group) => {
        const buttons = group.querySelectorAll('[data-tab-target]');
        const panels = group.querySelectorAll('[data-tab-panel]');

        const activate = (name) => {
            panels.forEach((panel) => {
                panel.hidden = panel.dataset.tabPanel !== name;
            });

            buttons.forEach((btn) => {
                btn.setAttribute('aria-selected', btn.dataset.tabTarget === name ? 'true' : 'false');
            });
        };

        buttons.forEach((btn) => {
            btn.addEventListener('click', () => {
                activate(btn.dataset.tabTarget);
                history.replaceState(null, '', '#' + btn.dataset.tabTarget);
            });
        });

        const hash = window.location.hash.replace('#', '');
        const initial = [...buttons].some((btn) => btn.dataset.tabTarget === hash)
            ? hash
            : (group.dataset.tabsDefault || (buttons[0] && buttons[0].dataset.tabTarget));

        if (initial) {
            activate(initial);
        }
    });

    /* ---- Horizontal sliders (gallery) ---- */
    document.querySelectorAll('[data-scroll-target]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const track = document.getElementById(btn.getAttribute('data-scroll-target'));

            if (! track) {
                return;
            }

            const dir = Number(btn.getAttribute('data-dir') || 1);
            track.scrollBy({ left: dir * track.clientWidth * 0.82, behavior: 'smooth' });
        });
    });

    /* ---- Stepped quote form ---- */
    const quote = document.querySelector('[data-quote-form]');

    if (quote) {
        const steps = [...quote.querySelectorAll('.step')];
        const bar = quote.querySelector('.progress span');
        let index = 0;

        const show = (n, scroll = true) => {
            index = Math.max(0, Math.min(n, steps.length - 1));

            steps.forEach((step, i) => step.classList.toggle('active', i === index));

            if (bar) {
                bar.style.width = ((index + 1) / steps.length) * 100 + '%';
            }

            if (scroll) {
                window.scrollTo({ top: Math.max(0, quote.offsetTop - 120), behavior: 'smooth' });
            }
        };

        quote.querySelectorAll('[data-next]').forEach((btn) => btn.addEventListener('click', () => show(index + 1)));
        quote.querySelectorAll('[data-prev]').forEach((btn) => btn.addEventListener('click', () => show(index - 1)));

        // Enter в поле от ранна стъпка иначе се опитва да submit-не формата, а
        // задължителните полета в последната стъпка са скрити -> браузърът
        // блокира тихо. Вместо това продължаваме към следващата стъпка.
        quote.addEventListener('keydown', (event) => {
            if (event.key !== 'Enter' || event.target.tagName === 'TEXTAREA') {
                return;
            }

            if (index < steps.length - 1) {
                event.preventDefault();
                show(index + 1);
            }
        });

        // Laravel validation failed: open the first step that actually has an error.
        const firstError = quote.querySelector('.field.has-error');
        const errorStep = firstError ? steps.findIndex((step) => step.contains(firstError)) : -1;

        show(errorStep > -1 ? errorStep : 0, false);

        // Deep link: /quote?service=Видеонаблюдение
        const service = new URLSearchParams(window.location.search).get('service');

        if (service) {
            const select = quote.querySelector('select[name="service"]');

            if (select) {
                [...select.options].forEach((option) => {
                    if (option.value === service || option.textContent.trim() === service) {
                        option.selected = true;
                    }
                });
            }
        }
    }
});
