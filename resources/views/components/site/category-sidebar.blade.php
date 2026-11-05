@props(['categories', 'active' => null, 'total', 'sticky' => false])
{{-- Sidebar kategori usaha. Desktop: panel putih yang menempel ke tepi kiri layar; mobile: deretan chip yang bisa digeser.
     Tata letak item: "Semua Aktivitas Usaha" sebagai induk, kategori menjorok di bawahnya.
     Setiap kategori diawali titik kecil (di tengah vertikal blok teks) yang tersambung garis vertikal tipis (kesan pohon). Tanpa judul yang terlihat (hanya sr-only untuk pembaca layar); panel dibuka dengan balok navy gelap polos di tepi atas.
     Semua baris berukuran seragam (tinggi minimum sama, lebar blok teks sama). Teks item tegas (kapital, tracking lebar), tetap rata kiri tetapi dimulai dekat sisi kanan panel lewat padding kiri besar;
     nama kategori yang panjang otomatis turun ke baris berikutnya.
     Baris aktif ditandai teks merah, latar merah muda tipis, dan garis merah tipis di tepi kanan panel.
     $sticky = true hanya bila daftar kartu lebih dari satu baris, supaya sidebar mengikuti scroll sampai daftar berakhir;
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
@endphp
<aside aria-label="Kategori usaha" @class([
    'mb-8 px-5 lg:mb-0 lg:self-start lg:border-y lg:border-r lg:border-navy/15 lg:border-t-0 lg:bg-white lg:px-0 lg:shadow-xl lg:shadow-navy/10',
    'lg:sticky lg:top-28' => $sticky,
])>
    {{-- Balok navy gelap selebar panel di tepi atas (pengganti garis merah); dekoratif, hanya desktop. --}}
    <div class="hidden h-7 bg-navy-dark lg:block xl:h-8" aria-hidden="true"></div>

    <h2 class="sr-only">Kategori Usaha</h2>

    <nav class="no-scrollbar flex gap-2 overflow-x-auto pb-1 lg:flex-col lg:gap-0 lg:overflow-visible lg:pb-0">
        @foreach ($links as $link)
            <a href="{{ $link['href'] }}" @if ($link['on']) aria-current="page" @endif
               @class([
                   'group flex shrink-0 items-center border py-3 pr-4 text-sm font-semibold transition-colors lg:min-h-[5.5rem] lg:border-0 lg:border-t lg:border-navy/10 lg:py-4 lg:pr-8 lg:text-left lg:font-bold lg:uppercase lg:leading-relaxed lg:tracking-[0.12em]',
                   'pl-4 lg:pl-14 lg:text-[0.8125rem] xl:pl-20' => ! $link['child'],
                   'relative pl-4 lg:pl-20 lg:text-xs lg:before:absolute lg:before:inset-y-0 lg:before:left-[5.1875rem] lg:before:w-px lg:before:bg-navy/15 xl:pl-28 xl:before:left-[7.1875rem]' => $link['child'],
                   'border-brand bg-white font-bold text-brand lg:bg-[#fdf2f2] lg:shadow-[inset_-4px_0_0_var(--color-brand)]' => $link['on'],
                   'border-navy/20 bg-white text-navy hover:text-brand lg:bg-transparent lg:hover:bg-surface' => ! $link['on'],
                   'lg:bg-surface/60' => ! $link['child'] && ! $link['on'],
               ])>
                {{-- Induk ("Semua Aktivitas Usaha") memakai panah di kanan. Kategori: lebar blok teks sama untuk semuanya,
                     titik berada di tengah vertikal blok teks walau nama kategori memakan beberapa baris. --}}
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
                        <x-icon name="arrow-right" @class([
                            'hidden size-5 shrink-0 transition-transform duration-200 lg:block',
                            'text-brand' => $link['on'],
                            'text-navy/40 group-hover:translate-x-1 group-hover:text-brand' => ! $link['on'],
                        ]) />
                    @endunless
                </span>
            </a>
        @endforeach
    </nav>
</aside>
