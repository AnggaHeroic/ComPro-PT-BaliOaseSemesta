{{-- Props: categories, total (wajib), active (kategori terpilih atau null), sticky (bool) --}}
@props(['categories', 'active' => null, 'total', 'sticky' => false])
{{-- Sidebar kategori usaha.
     Desktop: panel putih yang menempel ke tepi kiri layar, dibuka balok navy gelap polos di tepi atas.
     Mobile: bar navy gelap berisi kategori terpilih; diketuk untuk membuka daftar (Alpine: open, Esc / klik di luar untuk menutup).
     Daftar yang sama dipakai di kedua ukuran layar, hanya jarak dan ukuran teksnya yang berbeda.
     Tata letak item: "Semua Aktivitas Usaha" sebagai induk, kategori menjorok di bawahnya.
     Setiap kategori diawali titik kecil (di tengah vertikal blok teks) yang tersambung garis vertikal tipis (kesan pohon).
     Semua baris berukuran seragam (tinggi minimum sama; di desktop lebar blok teks juga sama). Teks item tegas (kapital, tracking lebar), rata kiri;
     di desktop dimulai dekat sisi kanan panel lewat padding kiri besar. Nama kategori yang panjang otomatis turun ke baris berikutnya.
     Baris aktif ditandai teks merah, latar merah muda tipis, dan garis merah tipis di tepi kanan panel.
     $sticky = true hanya bila daftar kartu lebih dari satu baris, supaya sidebar (desktop) mengikuti scroll sampai daftar berakhir;
     bila kartu hanya satu baris, sidebar diam.
     Tautan membawa #daftar-aktivitas agar halaman tetap berada di daftar setelah berpindah kategori. --}}
@php
    $links = [['label' => 'Semua Aktivitas Usaha', 'href' => route('activities').'#daftar-aktivitas', 'on' => $active === null, 'child' => false]];
    foreach ($categories as $category) {
        $links[] = [
            'label' => $category['name'],
            'href' => route('activities.category', $category['slug']).'#daftar-aktivitas',
            'on' => $active !== null && $active['slug'] === $category['slug'],
            'child' => true,
        ];
    }
    $current = collect($links)->firstWhere('on', true)['label'];
@endphp
<aside aria-label="Kategori usaha" x-data="{ open: false }" @keydown.escape.window="open = false" @click.outside="open = false" @class([
    'mb-8 px-5 lg:mb-0 lg:self-start lg:border-y lg:border-r lg:border-t-0 lg:border-navy/15 lg:bg-white lg:px-0 lg:shadow-xl lg:shadow-navy/10',
    'lg:sticky lg:top-28' => $sticky,
])>
    {{-- Desktop: balok navy gelap selebar panel di tepi atas; dekoratif. --}}
    <div class="hidden h-7 bg-navy-dark lg:block xl:h-8" aria-hidden="true"></div>

    <h2 class="sr-only">Kategori Usaha</h2>

    {{-- Mobile: bar pembuka daftar kategori. --}}
    <button type="button" @click="open = !open" :aria-expanded="open" aria-controls="daftar-kategori"
            class="flex w-full items-center justify-between gap-4 bg-navy-dark px-5 py-4 text-left text-white lg:hidden">
        <span class="min-w-0">
            <span class="block text-[0.6875rem] font-bold uppercase tracking-[0.18em] text-white/60">Kategori Usaha</span>
            <span class="mt-1 block text-sm font-bold uppercase leading-snug tracking-[0.1em]">{{ $current }}</span>
        </span>
        <x-ui.icon name="chevron-down" class="size-5 shrink-0 text-brand-bright transition-transform duration-200" ::class="open && 'rotate-180'" />
    </button>

    <nav id="daftar-kategori" :data-open="open"
         class="hidden border border-t-0 border-navy/15 bg-white shadow-lg shadow-navy/10 data-[open=true]:block lg:block lg:border-0 lg:shadow-none">
        @foreach ($links as $link)
            <a href="{{ $link['href'] }}" @if ($link['on']) aria-current="page" @endif
               @class([
                   'group flex min-h-14 items-center border-t border-navy/10 py-4 pr-5 text-left text-xs font-bold uppercase leading-relaxed tracking-[0.12em] transition-colors first:border-t-0 lg:min-h-[5.5rem] lg:border-t lg:pr-8',
                   'pl-5 lg:pl-14 lg:text-[0.8125rem] xl:pl-20' => ! $link['child'],
                   'relative pl-10 before:absolute before:inset-y-0 before:left-[2.6875rem] before:w-px before:bg-navy/15 lg:pl-20 lg:before:left-[5.1875rem] xl:pl-28 xl:before:left-[7.1875rem]' => $link['child'],
                   'bg-[#fdf2f2] text-brand shadow-[inset_-4px_0_0_var(--color-brand)]' => $link['on'],
                   'text-navy hover:bg-surface hover:text-brand' => ! $link['on'],
                   'bg-surface/60' => ! $link['child'] && ! $link['on'],
               ])>
                {{-- Induk ("Semua Aktivitas Usaha") memakai panah di kanan. Kategori: titik berada di tengah vertikal blok teks
                     walau nama kategori memakan beberapa baris; di desktop lebar blok teks sama untuk semuanya. --}}
                <span @class([
                    'flex w-full items-center',
                    'justify-between gap-3' => ! $link['child'],
                    'lg:max-w-[13rem]' => $link['child'],
                ])>
                    @if ($link['child'])
                        <span @class([
                            'relative z-10 mr-3 shrink-0 rounded-full ring-4 transition-all duration-200',
                            'size-2.5 bg-brand ring-[#fdf2f2]' => $link['on'],
                            'size-1.5 bg-navy/30 ring-white group-hover:size-2 group-hover:bg-brand group-hover:ring-surface' => ! $link['on'],
                        ]) aria-hidden="true"></span>
                    @endif
                    <span @class(['transition-transform duration-200', 'lg:group-hover:translate-x-1' => $link['child']])>{{ $link['label'] }}</span>
                    @unless ($link['child'])
                        <x-ui.icon name="arrow-right" @class([
                            'size-5 shrink-0 transition-transform duration-200',
                            'text-brand' => $link['on'],
                            'text-navy/40 group-hover:translate-x-1 group-hover:text-brand' => ! $link['on'],
                        ]) />
                    @endunless
                </span>
            </a>
        @endforeach
    </nav>
</aside>
