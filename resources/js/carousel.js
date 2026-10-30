// Carousel berulang: bergeser pelan ke kiri, berhenti saat kursor di atas kartu atau saat pengguna berinteraksi.
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
const RESUME_DELAY = 2500;

document.querySelectorAll('[data-carousel]').forEach((root) => {
    const track = root.querySelector('[data-carousel-track]');
    const originals = [...root.querySelectorAll('[data-carousel-item]')];
    const prev = root.querySelector('[data-carousel-prev]');
    const next = root.querySelector('[data-carousel-next]');

    if (!track || originals.length === 0) return;

    const copy = () => originals.map((item) => {
        const clone = item.cloneNode(true);
        clone.removeAttribute('data-carousel-item');
        clone.setAttribute('data-clone', '');
        clone.setAttribute('aria-hidden', 'true');
        clone.inert = true;
        return clone;
    });

    const step = () => {
        const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
        return originals[0].getBoundingClientRect().width + gap;
    };
    const setWidth = () => originals.length * step();

    // Salinan kartu di kiri dan kanan agar putaran tidak putus, berapa pun lebar layarnya.
    let extra = 1;

    let pos = 0;
    let lastInteraction = -Infinity;
    let hovering = false;
    let focused = false;
    let visible = true;
    const touch = () => { lastInteraction = performance.now(); };

    const wrap = () => {
        const w = setWidth();
        if (track.scrollLeft >= (extra + 1) * w) track.scrollLeft -= w;
        else if (track.scrollLeft < w) track.scrollLeft += w;
        pos = track.scrollLeft;
    };

    const go = (dir) => {
        touch();
        track.scrollBy({ left: dir * step(), behavior: reduceMotion.matches ? 'auto' : 'smooth' });
    };

    const build = () => {
        track.querySelectorAll('[data-clone]').forEach((el) => el.remove());
        extra = Math.ceil(track.clientWidth / setWidth()) + 1;
        for (let i = 0; i < extra; i++) {
            track.prepend(...copy());
            track.append(...copy());
        }
        track.scrollLeft = pos = extra * setWidth();
    };
    build();

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(build, 150);
    });

    prev?.addEventListener('click', () => go(-1));
    next?.addEventListener('click', () => go(1));
    root.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') { e.preventDefault(); go(-1); }
        if (e.key === 'ArrowRight') { e.preventDefault(); go(1); }
    });
    track.addEventListener('scroll', () => {
        if (Math.abs(track.scrollLeft - pos) > 2) pos = track.scrollLeft; // gulir manual
        wrap();
    }, { passive: true });
    ['touchstart', 'pointerdown'].forEach((type) => track.addEventListener(type, touch, { passive: true }));

    // Scroll mouse (vertikal) di atas carousel menggeser kartu ke kanan/kiri, dengan gerak yang diperhalus.
    let wheelRemaining = 0;
    track.addEventListener('wheel', (e) => {
        if (e.ctrlKey) return; // biarkan zoom
        const delta = Math.abs(e.deltaY) >= Math.abs(e.deltaX) ? e.deltaY : e.deltaX;
        if (!delta) return;
        e.preventDefault();
        touch();
        const unit = e.deltaMode === 1 ? 16 : e.deltaMode === 2 ? track.clientWidth : 1;
        if (reduceMotion.matches) {
            track.scrollLeft += delta * unit;
        } else {
            const limit = track.clientWidth * 2;
            wheelRemaining = Math.max(-limit, Math.min(limit, wheelRemaining + delta * unit));
        }
    }, { passive: false });

    track.addEventListener('pointerenter', (e) => { if (e.pointerType === 'mouse') hovering = true; });
    track.addEventListener('pointerleave', () => { hovering = false; });
    root.addEventListener('focusin', (e) => { focused = e.target.matches(':focus-visible'); });
    root.addEventListener('focusout', () => { focused = false; });
    new IntersectionObserver(([entry]) => { visible = entry.isIntersecting; }).observe(root);

    if (reduceMotion.matches) return;

    const speed = Number(root.dataset.carouselSpeed) || 0;
    let last = performance.now();
    const tick = (now) => {
        const dt = Math.min(now - last, 100);
        last = now;

        if (wheelRemaining) {
            // Mendekati target secara eksponensial agar terasa mengalir, bukan loncat per langkah roda.
            let move = wheelRemaining * (1 - Math.exp(-dt / 110));
            if (Math.abs(wheelRemaining) < 0.5) move = wheelRemaining;
            wheelRemaining -= move;
            pos += move;
            track.scrollLeft = pos;
        } else if (hovering || focused || !visible || document.hidden || now - lastInteraction < RESUME_DELAY) {
            pos = track.scrollLeft;
        } else if (speed) {
            pos += (speed * dt) / 1000;
            track.scrollLeft = pos;
        }
        requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
});
