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
            threshold: 0.35,
        },
    );

    statElements.forEach((element) => {
        observer.observe(element);
    });
});
