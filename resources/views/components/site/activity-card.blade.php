@props(['title', 'image', 'icon', 'href'])
{{-- Kartu aktivitas: separuh atas foto, separuh bawah panel putih. Ikon menumpang di sambungan keduanya.
     Area judul punya tinggi tetap, sehingga ikon, judul, dan tombol panah sejajar di semua kartu. --}}
<li {{ $attributes->class('group relative flex flex-col sm:min-h-[30rem] overflow-hidden border border-navy/10 bg-white shadow-sm shadow-navy/5 transition-colors duration-300 hover:border-brand/40') }}>
    {{-- Foto PLACEHOLDER sementara (Picsum/Unsplash, bebas pakai). Ganti dengan foto resmi perusahaan bila tersedia. --}}
    <div class="relative h-56 shrink-0 overflow-hidden sm:h-60" aria-hidden="true">
        <img src="https://picsum.photos/id/{{ $image }}/800/600" alt="" width="800" height="600" loading="lazy" referrerpolicy="no-referrer"
             class="size-full object-cover transition-transform duration-700 group-hover:scale-105">
        {{-- Elemen pendukung: tab merah di pojok kiri atas (memanjang saat hover) dan siku di pojok kanan atas. --}}
        <div class="absolute left-0 top-0 h-1 w-16 bg-brand transition-all duration-500 group-hover:w-28"></div>
        <div class="absolute right-5 top-5 size-6 border-r-2 border-t-2 border-white/80"></div>
    </div>

    <div class="flex flex-1 flex-col px-6 pb-6 text-center sm:px-7">
        {{-- Ikon bulat di tengah, tepat di batas foto dan judul (setengah di foto, setengah di panel putih), seperti kartu carousel Beranda. --}}
        <span class="relative z-10 -mt-7 mx-auto flex size-14 shrink-0 items-center justify-center rounded-full bg-navy text-white ring-4 ring-white" aria-hidden="true">
            <x-icon :name="$icon" accent="stroke-brand-bright" class="size-8" />
        </span>

        {{-- Area judul setinggi empat baris (mulai layar sm, saat kartu berjajar) agar ikon, judul, dan panah sejajar; di mobile (satu kolom) tinggi mengikuti isi. --}}
        <h3 class="mt-4 font-display sm:min-h-[7.5rem] text-lg font-bold leading-snug tracking-tight text-navy">{{ $title }}</h3>

        {{-- Penanda "buka detail"; seluruh kartu menjadi tautan lewat anchor di bawah. --}}
        <span class="mx-auto mt-6 inline-flex size-10 sm:mt-auto items-center justify-center rounded-full border border-navy/30 text-navy transition-colors duration-200 group-hover:border-navy group-hover:bg-navy group-hover:text-white" aria-hidden="true">
            <x-icon name="arrow-right" class="size-4" />
        </span>
    </div>

    <a href="{{ $href }}" class="absolute inset-0 z-20 focus-visible:outline-2 focus-visible:-outline-offset-4 focus-visible:outline-brand">
        <span class="sr-only">Lihat detail: {{ $title }}</span>
    </a>

    {{-- Garis merah di dasar kartu yang melebar saat hover. --}}
    <div class="absolute inset-x-0 bottom-0 h-0.5 origin-left scale-x-0 bg-brand transition-transform duration-500 group-hover:scale-x-100" aria-hidden="true"></div>
</li>
