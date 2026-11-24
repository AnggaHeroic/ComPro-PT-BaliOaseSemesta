{{-- Props: company (array CompanyService), menu (item NavigationService: label, href, icon, active, submenu), transparent (bool: navbar menyatu dengan hero berfoto) --}}
@props(['company', 'menu', 'transparent' => false])
{{-- Di posisi atas halaman: navy (atau transparan di atas hero); putih setelah di-scroll (data-scrolled diatur app.js). --}}
<header data-site-header data-scrolled="false"
        @class([
            'group z-50 border-b transition-colors duration-300 data-[scrolled=true]:border-brand data-[scrolled=true]:bg-white data-[scrolled=true]:shadow-sm data-[menu-open=true]:data-[scrolled=false]:bg-navy-dark',
            'fixed inset-x-0 top-0 border-transparent bg-transparent' => $transparent,
            'sticky top-0 border-white/10 bg-navy' => ! $transparent,
        ])>
    <div class="container-site flex h-[4.5rem] items-center justify-between gap-4 lg:h-20">
        <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-lg" aria-label="{{ $company['name'] }} — Beranda">
            <span class="flex size-12 shrink-0 items-center justify-center rounded-full bg-white ring-1 ring-navy/10">
                <x-ui.application-logo size="size-10" />
            </span>
            <span class="font-display text-sm font-extrabold uppercase leading-tight tracking-wide text-white transition-colors group-data-[scrolled=true]:text-navy sm:text-base">
                Bali Oase <span class="text-brand-bright transition-colors group-data-[scrolled=true]:text-brand">Semesta</span>
            </span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Navigasi utama">
            @foreach ($menu as $item)
                @php $active = $item['active']; @endphp
                <a href="{{ $item['href'] }}" @if ($active) aria-current="page" @endif
                   class="relative rounded py-2 text-sm font-semibold transition-colors
                          {{ $active ? 'text-white group-data-[scrolled=true]:text-brand' : 'text-white/75 hover:text-white group-data-[scrolled=true]:text-ink/70 group-data-[scrolled=true]:hover:text-brand' }}">
                    {{ $item['label'] }}
                    @if ($active)
                        <span class="absolute inset-x-0 -bottom-1 h-0.5 rounded-full bg-brand-bright group-data-[scrolled=true]:bg-brand" aria-hidden="true"></span>
                    @endif
                </a>
            @endforeach
        </nav>

        {{-- Tombol hamburger: tanpa bingkai; tiga garis berubah menjadi X saat menu terbuka (aria-expanded diatur app.js). --}}
        <button type="button" data-nav-toggle aria-expanded="false" aria-controls="menu-mobile"
                class="group/toggle inline-flex size-11 items-center justify-center text-white transition-colors hover:text-brand-bright group-data-[scrolled=true]:text-navy group-data-[scrolled=true]:hover:text-brand lg:hidden">
            <span class="sr-only">Buka menu navigasi</span>
            <span class="relative block h-3.5 w-5" aria-hidden="true">
                <span class="absolute inset-x-0 top-0 h-0.5 bg-current transition-all duration-300 group-aria-expanded/toggle:top-1.5 group-aria-expanded/toggle:rotate-45"></span>
                <span class="absolute inset-x-0 top-1.5 h-0.5 bg-current transition-opacity duration-200 group-aria-expanded/toggle:opacity-0"></span>
                <span class="absolute inset-x-0 top-3 h-0.5 bg-current transition-all duration-300 group-aria-expanded/toggle:top-1.5 group-aria-expanded/toggle:-rotate-45"></span>
            </span>
        </button>
    </div>

    {{-- Menu mobile: panel navy gelap selebar layar (putih setelah di-scroll). Tiap menu berikon dengan panah di kanan; halaman aktif diberi
         latar terang dan teks tebal. "Layanan & Jasa" membuka submenu kategori (Alpine) dengan penanda kotak merah. --}}
    <nav id="menu-mobile" data-nav-menu hidden aria-label="Navigasi seluler"
         class="max-h-[calc(100dvh-4.5rem)] animate-menu-in overflow-y-auto border-t-2 border-brand bg-navy-dark shadow-xl shadow-navy-dark/30 group-data-[scrolled=true]:bg-white lg:hidden">
        <ul>
            @foreach ($menu as $item)
                @php
                    $active = $item['active'];
                    $hasSub = count($item['submenu']) > 0;
                    $row = 'flex w-full items-center justify-between gap-5 px-5 py-5 text-left text-base transition-colors sm:px-8 '.($active
                        ? 'bg-white/10 font-bold text-brand-bright group-data-[scrolled=true]:bg-navy-tint group-data-[scrolled=true]:text-brand'
                        : 'font-medium text-white/90 hover:bg-white/5 group-data-[scrolled=true]:text-ink group-data-[scrolled=true]:hover:bg-surface');
                @endphp
                <li class="border-b border-white/10 last:border-b-0 group-data-[scrolled=true]:border-navy/10"
                    @if ($hasSub) x-data="{ open: {{ $active ? 'true' : 'false' }} }" @endif>
                    @if ($hasSub)
                        {{-- Layanan & Jasa: baris ini membuka/menutup submenu kategori (dibuka otomatis di halaman layanan). --}}
                        <button type="button" @click="open = !open" :aria-expanded="open" aria-controls="submenu-layanan" class="{{ $row }}">
                            <span class="flex items-center gap-5">
                                <x-ui.icon :name="$item['icon']" class="size-6" />
                                {{ $item['label'] }}
                            </span>
                            <x-ui.icon name="chevron-down" class="size-5 text-white/40 transition-transform duration-200 group-data-[scrolled=true]:text-navy/40" ::class="open && 'rotate-180 text-brand-bright!'" />
                        </button>
                        <ul id="submenu-layanan" x-show="open" x-cloak x-transition.opacity.duration.200ms
                            class="mx-4 mb-3 border border-white/10 bg-white/5 px-4 sm:mx-8 group-data-[scrolled=true]:border-navy/10 group-data-[scrolled=true]:bg-surface">
                            @foreach ($item['submenu'] as $sub)
                                <li @class(['border-white/10 group-data-[scrolled=true]:border-navy/10', 'border-t' => ! $loop->first])>
                                    <a href="{{ $sub['href'] }}" @if ($sub['active']) aria-current="page" @endif
                                       @class([
                                           'flex items-center gap-4 py-4 text-base transition-colors',
                                           'font-bold text-brand-bright group-data-[scrolled=true]:text-brand' => $sub['active'],
                                           'text-white/85 hover:text-white group-data-[scrolled=true]:text-ink group-data-[scrolled=true]:hover:text-brand' => ! $sub['active'],
                                       ])>
                                        <span class="size-1.5 shrink-0 bg-brand-bright group-data-[scrolled=true]:bg-brand" aria-hidden="true"></span>
                                        {{ $sub['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <a href="{{ $item['href'] }}" @if ($active) aria-current="page" @endif class="{{ $row }}">
                            <span class="flex items-center gap-5">
                                <x-ui.icon :name="$item['icon']" class="size-6" />
                                {{ $item['label'] }}
                            </span>
                            <x-ui.icon name="chevron-right" class="size-5 text-white/40 group-data-[scrolled=true]:text-navy/40" />
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</header>
