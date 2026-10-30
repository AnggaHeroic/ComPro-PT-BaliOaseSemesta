@props(['transparent' => false])
@php
    $items = config('company.nav');
@endphp
{{-- Di posisi atas halaman: navy (atau transparan di atas hero); putih setelah di-scroll (data-scrolled diatur app.js). --}}
<header data-site-header data-scrolled="false"
        @class([
            'group z-50 border-b transition-colors duration-300 data-[scrolled=true]:border-brand data-[scrolled=true]:bg-white data-[scrolled=true]:shadow-sm',
            'fixed inset-x-0 top-0 border-transparent bg-transparent' => $transparent,
            'sticky top-0 border-white/10 bg-navy' => ! $transparent,
        ])>
    <div class="container-site flex h-[4.5rem] items-center justify-between gap-4 lg:h-20">
        <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-lg" aria-label="{{ config('company.name') }} — Beranda">
            <span class="flex size-12 shrink-0 items-center justify-center rounded-full bg-white ring-1 ring-navy/10">
                <x-logo size="size-10" />
            </span>
            <span class="font-display text-sm font-extrabold uppercase leading-tight tracking-wide text-white transition-colors group-data-[scrolled=true]:text-navy sm:text-base">
                Bali Oase <span class="text-brand-bright transition-colors group-data-[scrolled=true]:text-brand">Semesta</span>
            </span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Navigasi utama">
            @foreach ($items as $route => $label)
                @php $active = request()->routeIs($route); @endphp
                <a href="{{ route($route) }}" @if ($active) aria-current="page" @endif
                   class="relative rounded py-2 text-sm font-semibold transition-colors
                          {{ $active ? 'text-white group-data-[scrolled=true]:text-brand' : 'text-white/75 hover:text-white group-data-[scrolled=true]:text-ink/70 group-data-[scrolled=true]:hover:text-brand' }}">
                    {{ $label }}
                    @if ($active)
                        <span class="absolute inset-x-0 -bottom-1 h-0.5 rounded-full bg-brand-bright group-data-[scrolled=true]:bg-brand" aria-hidden="true"></span>
                    @endif
                </a>
            @endforeach
        </nav>

        <button type="button" data-nav-toggle aria-expanded="false" aria-controls="menu-mobile"
                class="inline-flex size-11 items-center justify-center rounded-lg text-white transition-colors hover:bg-white/10 group-data-[scrolled=true]:text-navy group-data-[scrolled=true]:hover:bg-navy-tint lg:hidden">
            <span class="sr-only">Buka menu navigasi</span>
            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
    </div>

    <nav id="menu-mobile" data-nav-menu hidden aria-label="Navigasi seluler"
         class="max-h-[calc(100dvh-4.5rem)] overflow-y-auto border-t border-white/10 bg-navy group-data-[scrolled=true]:border-navy/10 group-data-[scrolled=true]:bg-white lg:hidden">
        <ul class="container-site py-2">
            @foreach ($items as $route => $label)
                @php $active = request()->routeIs($route); @endphp
                <li class="border-b border-white/10 group-data-[scrolled=true]:border-navy/10">
                    <a href="{{ route($route) }}" @if ($active) aria-current="page" @endif
                       class="flex items-center justify-between py-4 text-base font-semibold transition-colors
                              {{ $active ? 'text-brand-bright group-data-[scrolled=true]:text-brand' : 'text-white/85 hover:text-white group-data-[scrolled=true]:text-ink group-data-[scrolled=true]:hover:text-brand' }}">
                        <span>{{ $label }}</span>
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</header>
