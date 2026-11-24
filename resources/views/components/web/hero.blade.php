{{-- Props: variant (full|services|profile|plain|detail), eyebrow, title (wajib), actions (slot), aside (slot), footer (slot, varian services) --}}
@props(['variant' => 'plain', 'eyebrow' => null, 'title', 'actions' => null, 'aside' => null, 'footer' => null])
{{--
    Satu komponen untuk semua hero.
      full    : memenuhi layar, foto latar (Beranda); mendukung slot `actions` untuk tombol.
      services: memenuhi layar, foto berlapis navy seragam dengan kisi halus; label eyebrow merah bersudut tajam, judul, paragraf, tombol (`actions`), dan bilah di dasar hero lewat slot `footer` (indeks bidang usaha di halaman Layanan & Jasa; butuh @section('nav', 'transparent')).
      profile : memenuhi layar seperti varian full: foto di latar kiri yang memudar halus ke navy di kanan, kisi halus, panel miring tipis, dan garis kotak bertumpuk di kanan; teks di kiri dengan garis aksen merah, slot `aside` (emblem) di kanan (halaman Tentang Kami; butuh @section('nav', 'transparent')).
      plain   : latar navy dengan garis miring, tanpa foto (Tentang Kami, Kontak).
      detail  : seperti plain tetapi lebih tinggi, dengan slot `aside` di kanan (desktop) untuk ikon/ilustrasi (detail aktivitas).
    Slot: `title` (boleh berisi markup), slot utama = paragraf pengantar, `actions` = tombol (opsional), `aside` = elemen kanan (varian detail).
    Varian full dan split membutuhkan @section('nav', 'transparent') agar navbar menyatu dengan hero.
--}}
@php
    $photo = $variant === 'full';
    $s = [
        'full' => [
            'section' => 'min-h-[max(100vh,100dvh)] items-center',
            'image' => 'https://picsum.photos/id/1076/1920/1080',
            'top' => 'h-44',
            'container' => 'py-28 sm:py-32',
            'title' => 'mt-4 text-4xl font-extrabold leading-tight sm:text-5xl lg:whitespace-nowrap xl:text-[3.5rem]',
            'text' => 'mt-6 max-w-2xl text-lg leading-relaxed text-white/80',
        ],
        'services' => [
            'container' => 'py-28 sm:py-32',
            'title' => 'mt-6 text-4xl font-black leading-[1.05] tracking-tight sm:text-5xl xl:text-6xl',
            'text' => 'mt-6 max-w-xl text-base leading-relaxed text-white/80 sm:text-lg',
        ],
        'plain' => [
            'container' => 'py-14 sm:py-20',
            'title' => 'mt-3 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl',
            'text' => 'mt-5 max-w-2xl text-lg leading-relaxed text-white/80',
        ],
        'profile' => [
            'container' => 'py-28 sm:py-32',
            'title' => 'mt-5 text-4xl font-black leading-[1.05] tracking-tight sm:text-5xl',
            'text' => 'mt-6 max-w-xl text-base leading-relaxed text-white/80 sm:text-lg',
        ],
        'detail' => [
            'container' => 'py-16 sm:py-20 lg:py-24',
            'title' => 'mt-4 max-w-3xl text-4xl font-extrabold leading-[1.1] tracking-tight sm:text-5xl',
            'text' => 'mt-6 max-w-2xl text-base leading-relaxed text-white/80 sm:text-lg',
        ],
    ][$variant];
@endphp
@if ($variant === 'services')
    <section class="relative isolate flex min-h-[max(100vh,100dvh)] flex-col overflow-hidden bg-navy text-white">
        {{-- Foto PLACEHOLDER sementara (Picsum/Unsplash, bebas pakai). Ganti dengan foto resmi perusahaan bila tersedia. --}}
        <img src="https://picsum.photos/id/1048/1920/1100" alt="" class="absolute inset-0 -z-30 size-full object-cover" fetchpriority="high" referrerpolicy="no-referrer">
        {{-- Lapisan navy seragam agar teks terbaca, gelap di dasar untuk bilah indeks, dan gelap di atas untuk navbar transparan. --}}
        <div class="absolute inset-0 -z-30 bg-navy/75" aria-hidden="true"></div>
        <div class="absolute inset-0 -z-20 bg-gradient-to-t from-navy-dark via-navy-dark/30 to-transparent" aria-hidden="true"></div>
        <div class="absolute inset-x-0 top-0 -z-20 h-36 bg-gradient-to-b from-navy/80 to-transparent" aria-hidden="true"></div>
        {{-- Efek pendukung: kisi tipis yang memudar ke bawah. --}}
        <div class="pattern-grid absolute inset-0 -z-10 [mask-image:linear-gradient(to_bottom,black,transparent_75%)]" aria-hidden="true"></div>

        <div class="flex flex-1 items-center">
            <div class="container-site w-full {{ $s['container'] }}">
                @if ($eyebrow)
                    <p class="inline-block bg-brand px-3 py-1.5 text-xs font-bold uppercase tracking-widest text-white">{{ $eyebrow }}</p>
                @endif
                <h1 class="{{ $s['title'] }}">{{ $title }}</h1>
                @if (trim($slot))
                    <p class="{{ $s['text'] }}">{{ $slot }}</p>
                @endif
                @if ($actions)
                    <div class="mt-10 flex flex-col gap-3 sm:flex-row">{{ $actions }}</div>
                @endif
            </div>
        </div>

        @if ($footer)
            <div class="border-t border-white/15 bg-navy-dark/70 backdrop-blur-sm">{{ $footer }}</div>
        @endif
        {{-- Strip aksen di tepi bawah, seperti hero lainnya. --}}
        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand" aria-hidden="true"></div>
    </section>
@elseif ($variant === 'profile')
    <section class="relative isolate flex min-h-[max(100vh,100dvh)] items-center overflow-hidden bg-gradient-to-br from-[#0e1d63] via-navy to-navy-dark text-white">
        {{-- Foto PLACEHOLDER sementara (Picsum/Unsplash, bebas pakai). Ganti dengan foto resmi perusahaan bila tersedia.
             Mobile: memenuhi lebar. Desktop: 68% lebar dari kiri, memudar ke kanan lewat mask. Lapisan navy di atasnya menjaga teks terbaca. --}}
        <div class="absolute inset-y-0 left-0 -z-30 w-full lg:w-[68%] lg:[mask-image:linear-gradient(to_right,black_50%,transparent)]" aria-hidden="true">
            <img src="https://picsum.photos/id/1031/1600/1000" alt="" class="size-full object-cover" fetchpriority="high" referrerpolicy="no-referrer">
            <div class="absolute inset-0 bg-gradient-to-r from-navy/90 via-navy/75 to-navy/55"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-navy/60 to-transparent"></div>
        </div>
        {{-- Latar dekoratif: kisi halus yang memudar ke kiri dan panel miring tipis di kanan (bahasa visual yang sama dengan hero Beranda). --}}
        <div class="pattern-grid absolute inset-y-0 right-0 -z-20 w-full [mask-image:linear-gradient(to_left,black,transparent_75%)]" aria-hidden="true"></div>
        <div class="absolute inset-y-0 right-0 -z-20 hidden w-[42%] bg-[#3a5cc4]/10 [clip-path:polygon(28%_0,100%_0,100%_100%,0_100%)] lg:block" aria-hidden="true"></div>
        {{-- Aksen: kotak tipis bertumpuk di kanan (sudut tajam, selaras dengan beranda) dan strip merah di dasar. --}}
        <svg class="absolute -right-40 top-1/2 -z-10 size-[44rem] -translate-y-1/2" viewBox="0 0 400 400" fill="none" stroke="white" stroke-width="1" aria-hidden="true">
            <rect x="140" y="140" width="120" height="120" stroke-opacity=".14"/>
            <rect x="95" y="95" width="210" height="210" stroke="#ff3535" stroke-opacity=".4"/>
            <rect x="50" y="50" width="300" height="300" stroke-opacity=".12"/>
            <rect x="5" y="5" width="390" height="390" stroke-opacity=".08"/>
        </svg>
        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand" aria-hidden="true"></div>

        <div class="container-site {{ $s['container'] }}">
            <div class="grid items-center gap-14 lg:grid-cols-12">
                <div class="border-l-4 border-brand-bright pl-5 sm:pl-8 lg:col-span-7">
                    @if ($eyebrow)
                        <p class="text-sm font-bold uppercase tracking-widest text-brand-bright">{{ $eyebrow }}</p>
                    @endif
                    <h1 class="{{ $s['title'] }}">{{ $title }}</h1>
                    @if (trim($slot))
                        <p class="{{ $s['text'] }}">{{ $slot }}</p>
                    @endif
                </div>
                @if ($aside)
                    <div class="hidden justify-center lg:col-span-5 lg:flex" aria-hidden="true">{{ $aside }}</div>
                @endif
            </div>
        </div>
    </section>
@else
    <section @class(['relative isolate overflow-hidden bg-navy text-white', 'flex '.($s['section'] ?? '') => $photo])>
        @if ($photo)
            {{-- Foto PLACEHOLDER sementara (Picsum/Unsplash, bebas pakai). Ganti dengan foto resmi perusahaan bila tersedia. --}}
            <img src="{{ $s['image'] }}" alt="" class="absolute inset-0 -z-30 size-full object-cover" fetchpriority="high" referrerpolicy="no-referrer">
            {{-- Gradient navy di sisi kiri agar judul tetap terbaca. --}}
            <div class="absolute inset-0 -z-20 bg-gradient-to-r from-navy from-15% via-navy/85 via-50% to-navy/20" aria-hidden="true"></div>
            <div class="absolute inset-0 -z-20 bg-gradient-to-t from-navy/60 to-transparent" aria-hidden="true"></div>
            {{-- Gradient atas agar navbar transparan tetap terbaca di atas foto. --}}
            <div class="absolute inset-x-0 top-0 -z-20 bg-gradient-to-b from-navy/80 to-transparent {{ $s['top'] }}" aria-hidden="true"></div>
            {{-- Efek pendukung: kisi tipis yang memudar ke kiri (halus, selaras dengan halaman Tentang Kami). --}}
            <div class="pattern-grid absolute inset-0 -z-10 [mask-image:linear-gradient(to_left,black,transparent_70%)]" aria-hidden="true"></div>
        @else
            <div class="pattern-hatch absolute inset-y-0 right-0 -z-10 w-full opacity-60 [mask-image:linear-gradient(to_left,black,transparent_70%)]" aria-hidden="true"></div>
        @endif
        {{-- Strip aksen di tepi bawah. --}}
        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand" aria-hidden="true"></div>

        <div @class(['container-site', $s['container'], 'flex items-center justify-between gap-12' => $aside])>
            <div @if ($photo) class="border-l-4 border-brand-bright pl-5 sm:pl-8" @endif>
                @if ($eyebrow)
                    <p class="text-sm font-bold uppercase tracking-widest text-brand-bright">{{ $eyebrow }}</p>
                @endif
                <h1 class="{{ $s['title'] }}">{{ $title }}</h1>
                @if (trim($slot))
                    <p class="{{ $s['text'] }}">{{ $slot }}</p>
                @endif
                @if ($actions)
                    <div class="mt-10 flex flex-col gap-3 sm:flex-row">{{ $actions }}</div>
                @endif
            </div>
            @if ($aside)
                <div class="hidden shrink-0 lg:block" aria-hidden="true">{{ $aside }}</div>
            @endif
        </div>
    </section>
@endif
