import './carousel';

const header = document.querySelector('[data-site-header]');
const toggle = document.querySelector('[data-nav-toggle]');
const menu = document.querySelector('[data-nav-menu]');

// Navbar navy di atas halaman, putih setelah di-scroll.
if (header) {
    const update = () => header.setAttribute('data-scrolled', String(window.scrollY > 8));
    update();
    window.addEventListener('scroll', update, { passive: true });
}

// Menu navigasi mobile.
if (toggle && menu) {
    const setOpen = (open) => {
        menu.hidden = !open;
        toggle.setAttribute('aria-expanded', String(open));
    };

    toggle.addEventListener('click', () => setOpen(menu.hidden));
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !menu.hidden) {
            setOpen(false);
            toggle.focus();
        }
    });
    window.matchMedia('(min-width: 1024px)').addEventListener('change', (e) => {
        if (e.matches) setOpen(false);
    });
}
