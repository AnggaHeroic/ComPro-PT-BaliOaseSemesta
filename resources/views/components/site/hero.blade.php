@props(['variant' => 'plain', 'eyebrow' => null, 'title', 'actions' => null, 'aside' => null])
{{--
    Satu komponen untuk semua hero.
      full    : memenuhi layar, foto latar (Beranda); mendukung slot `actions` untuk tombol.
      split   : memenuhi layar seperti varian full; panel navy semi-transparan bersisi miring dengan pita navy terang dan dua garis merah yang memudar, foto memenuhi lebar hero (halaman Layanan & Jasa; butuh @section('nav', 'transparent')).
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
        'split' => [
            'container' => 'py-28 sm:py-32',
            'title' => 'mt-4 text-4xl font-black leading-[1.05] tracking-tight sm:text-5xl xl:text-6xl',
            'text' => 'mt-6 max-w-lg text-base leading-relaxed text-white/80 sm:text-lg',
        ],
        'plain' => [
            'container' => 'py-14 sm:py-20',
            'title' => 'mt-3 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl',
            'text' => 'mt-5 max-w-2xl text-lg leading-relaxed text-white/80',
        ],
        'detail' => [
            'container' => 'py-16 sm:py-20 lg:py-24',
            'title' => 'mt-4 max-w-3xl text-4xl font-extrabold leading-[1.1] tracking-tight sm:text-5xl',
            'text' => 'mt-6 max-w-2xl text-base leading-relaxed text-white/80 sm:text-lg',
        ],
    ][$variant];
@endphp
@if ($variant === 'split')
    {{-- --hero-edge = posisi x tepi miring di bagian atas hero. Dihitung dari tepi kanan kontainer (tempat menu navbar berakhir)
             dikurangi 25.35rem, sehingga bagian atas pita navy terang (tepi + 3rem) tepat di tengah teks menu "Beranda". --}}
    <section class="relative isolate flex min-h-[max(100vh,100dvh)] items-center overflow-hidden bg-navy text-white [--hero-edge:calc(min(50%_+_34rem,100%_-_2rem)_-_25.35rem)]">
        {{-- Foto PLACEHOLDER sementara (Picsum/Unsplash, bebas pakai). Ganti dengan foto resmi perusahaan bila tersedia.
             Foto memenuhi seluruh lebar hero; di desktop bagian kirinya tertutup panel navy semi-transparan. --}}
        <img src="https://picsum.photos/id/1048/1920/900" alt="" class="absolute inset-0 -z-30 size-full object-cover" fetchpriority="high" referrerpolicy="no-referrer">
        {{-- Penyelarasan warna ala hero Beranda: foto ditutup lapisan navy biasa (bukan multiply) yang menipis ke sisi kanan, plus gradient navy dari bawah, sehingga terbaca biru navy seperti palet logo. Lapisan ini berada di bawah panel dan pita, jadi aksen tetap semi-transparan. --}}
        <div class="absolute inset-0 -z-30 bg-gradient-to-r from-navy/55 from-50% to-navy/20" aria-hidden="true"></div>
        {{-- Desaturasi sisi kanan saja: lapisan abu-abu dengan blend mode saturation, makin kuat ke kanan. --}}
        <div class="absolute inset-0 -z-30 bg-gradient-to-r from-transparent from-50% to-neutral-500/70 mix-blend-saturation" aria-hidden="true"></div>
        <div class="absolute inset-0 -z-30 bg-gradient-to-t from-navy/60 to-transparent" aria-hidden="true"></div>
        {{-- Mobile: foto ditutup gradien navy.
             Desktop: panel navy (opasitas 70%) selebar --hero-edge dengan sisi kanan miring, ditambah tiga pita sejajar di tepinya:
             pita navy terang, pita merah lebar yang memudar (mulai 28% tinggi), dan garis merah tipis (mulai 42% tinggi), keduanya digeser ke sisi foto. --}}
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-navy from-15% via-navy/90 via-50% to-navy/60 lg:hidden" aria-hidden="true"></div>
        <div class="absolute inset-y-0 left-0 -z-10 hidden w-[var(--hero-edge)] bg-navy/70 [clip-path:polygon(0_0,100%_0,calc(100%-8rem)_100%,0_100%)] lg:block" aria-hidden="true"></div>
        <div class="absolute inset-y-0 left-0 -z-10 hidden w-[calc(var(--hero-edge)+6rem)] bg-[#3a5cc4]/30 [clip-path:polygon(calc(100%-6rem)_0,100%_0,calc(100%-8rem)_100%,calc(100%-14rem)_100%)] lg:block" aria-hidden="true"></div>
        <div class="absolute inset-y-0 left-0 -z-10 hidden w-[calc(var(--hero-edge)+8rem)] bg-gradient-to-b from-brand/90 from-28% via-brand/50 to-brand/10 [clip-path:polygon(calc(100%-7.24rem)_28%,calc(100%-2.24rem)_28%,calc(100%-8rem)_100%,calc(100%-13rem)_100%)] lg:block" aria-hidden="true"></div>
        <div class="absolute inset-y-0 left-0 -z-10 hidden w-[calc(var(--hero-edge)+10rem)] bg-gradient-to-b from-brand/80 from-42% to-brand/10 [clip-path:polygon(calc(100%-4.36rem)_42%,calc(100%-3.36rem)_42%,calc(100%-8rem)_100%,calc(100%-9rem)_100%)] lg:block" aria-hidden="true"></div>
        {{-- Pola titik sangat samar di sudut kiri bawah agar panel navy tidak terasa datar. --}}
        <div class="pattern-dots absolute bottom-0 left-0 -z-10 hidden h-3/4 w-1/2 opacity-25 [mask-image:linear-gradient(to_top_right,black,transparent_70%)] lg:block" aria-hidden="true"></div>
        {{-- Gradient atas agar navbar transparan tetap terbaca di atas foto. --}}
        <div class="absolute inset-x-0 top-0 -z-10 h-36 bg-gradient-to-b from-navy/70 to-transparent" aria-hidden="true"></div>
        {{-- Strip aksen di tepi bawah, seperti hero Beranda. --}}
        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand" aria-hidden="true"></div>

        <div class="container-site {{ $s['container'] }}">
            <div class="border-l-4 border-brand-bright pl-5 sm:pl-8">
                @if ($eyebrow)
                    <p class="text-sm font-bold uppercase tracking-widest text-brand-bright">{{ $eyebrow }}</p>
                @endif
                <h1 class="{{ $s['title'] }}">{{ $title }}</h1>
                @if (trim($slot))
                    <p class="{{ $s['text'] }}">{{ $slot }}</p>
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
