@props(['name', 'accent' => 'stroke-brand'])
@php
    // Ikon garis kustom (viewBox 48). Warna utama: currentColor; detail merah memakai stroke-brand.
    $icons = [
        // Sewa guna usaha: kunci
        'rental' => '<circle cx="17" cy="31" r="7"/><circle cx="17" cy="31" r="2" class="stroke-brand"/><path d="M22 26 38 10"/><path d="m33 15 5 5"/><path d="m37 11 4 4" class="stroke-brand"/>',
        // Reproduksi media rekaman film dan video: rol film
        'film' => '<rect x="6" y="11" width="36" height="26" rx="2"/><path d="M12 11v26M36 11v26"/><path d="M6 18h6M6 24h6M6 30h6M36 18h6M36 24h6M36 30h6"/><path d="m21 18 9 6-9 6z" class="stroke-brand"/>',
        // Perdagangan besar alat tulis dan gambar: pensil dan penggaris
        'stationery' => '<path d="M8 40l3-10L32 9a3 3 0 0 1 4 0l3 3a3 3 0 0 1 0 4L18 37z"/><path d="m28 13 7 7"/><path d="m11 30 7 7"/><rect x="22" y="31" width="20" height="9" rx="1" class="stroke-brand"/><path d="M27 31v4M32 31v5M37 31v4" class="stroke-brand"/>',
        // Perdagangan besar barang percetakan dan penerbitan: printer
        'printing' => '<rect x="8" y="19" width="32" height="14" rx="2"/><path d="M15 19V9h18v10"/><path d="M20 14h8" class="stroke-brand"/><path d="M15 33v7h18v-7"/><path d="M33 25h2"/>',
        // Portal web dan platform digital: jendela peramban dan globe
        'web' => '<rect x="6" y="9" width="36" height="30" rx="2"/><path d="M6 17h36"/><path d="M11 13h.01M15 13h.01M19 13h.01"/><circle cx="24" cy="28" r="7" class="stroke-brand"/><path d="M17 28h14M24 21c-3 3-3 11 0 14M24 21c3 3 3 11 0 14" class="stroke-brand"/>',
        // Penerbitan buku: buku terbuka
        'book' => '<path d="M24 14c-4-3-10-4-17-3v26c7-1 13 0 17 3 4-3 10-4 17-3V11c-7-1-13 0-17 3z"/><path d="M24 14v26"/><path d="M12 19c3 0 6 .5 8 1.5M12 25c3 0 6 .5 8 1.5" class="stroke-brand"/>',
        // Penasihat investasi: diagram batang
        'advisory' => '<path d="M8 8v32h34"/><rect x="14" y="26" width="6" height="14"/><rect x="24" y="18" width="6" height="22"/><rect x="34" y="10" width="6" height="30" class="stroke-brand"/>',
    ];
@endphp
<svg {{ $attributes->class('shrink-0') }} viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! str_replace('stroke-brand', $accent, $icons[$name] ?? '') !!}</svg>
