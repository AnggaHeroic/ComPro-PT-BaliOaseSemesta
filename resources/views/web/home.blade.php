@extends('layouts.public')


@section('nav', 'transparent')

@section('content')
    <x-web.hero variant="full" :eyebrow="$company['city']">
        <x-slot:title>{{ $company['name'] }}</x-slot:title>
        Perusahaan yang bergerak di bidang perdagangan alat tulis dan barang percetakan, penerbitan buku, reproduksi media rekaman, platform digital, sewa guna usaha, dan penasihat investasi.
        <x-slot:actions>
            <x-ui.button :href="route('activities')">Lihat Layanan &amp; Jasa</x-ui.button>
            <x-ui.button :href="route('contact')" variant="outline-light">Hubungi Kami</x-ui.button>
        </x-slot:actions>
    </x-web.hero>

    {{-- Pengantar perusahaan --}}
    <section class="relative isolate overflow-hidden bg-surface">
        {{-- Aksen ringan: cahaya oranye lembut dan pola titik yang memudar ke kiri. --}}
        <div class="absolute -right-24 top-1/2 -z-10 size-[30rem] -translate-y-1/2 rounded-full bg-brand-bright/10 blur-3xl" aria-hidden="true"></div>
        <div class="pattern-dots absolute inset-y-0 right-0 -z-10 w-full lg:w-3/5 [mask-image:linear-gradient(to_left,black,transparent_85%)]" aria-hidden="true"></div>
        <div class="container-site py-24 lg:py-32">
            <div class="grid items-center gap-14 lg:grid-cols-12 lg:gap-12">
                <div class="lg:col-span-8">
                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand">Profil Singkat</span>

                    <h2 class="mt-5 text-4xl font-extrabold leading-[1.08] tracking-tight text-navy sm:text-5xl">
                        <span class="block">Mengenal</span>
                        <span class="block text-brand">{{ $company['short_name'] }}</span>
                    </h2>

                    <p class="mt-7 max-w-2xl text-base leading-8 text-muted sm:text-lg">
                        {{ $company['name'] }} berkedudukan di {{ $company['city'] }}. Kegiatan usaha perusahaan mencakup tujuh bidang yang dirangkum pada bagian berikut. Informasi lebih lanjut tersedia melalui kontak resmi perusahaan.
                    </p>

                    <div class="mt-9">
                        <x-ui.button :href="route('about')">
                            Tentang Kami
                            <x-ui.icon name="arrow-right" class="size-4" />
                        </x-ui.button>
                    </div>
                </div>

                {{-- Kartu ringkasan: jumlah bidang usaha (dihitung dari data). --}}
                <div class="relative flex flex-col overflow-hidden border border-navy/15 bg-white/60 p-8 shadow-sm backdrop-blur-sm sm:p-10 lg:col-span-4">
                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-muted">Bidang Usaha</span>
                    <span class="mt-4 font-display text-8xl font-extrabold leading-none tracking-tight text-brand">{{ str_pad(count($company['activities']), 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="mt-6 border-t border-navy/15 pt-6 text-sm leading-6 text-muted">Kegiatan usaha yang dijalankan perusahaan.</span>
                    <span class="absolute inset-x-0 bottom-0 h-0.5 bg-brand" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </section>

    {{-- Bidang usaha --}}
    <section id="layanan-jasa" class="scroll-mt-24 overflow-hidden">
        {{-- Judul: latar navy --}}
        <div class="relative isolate overflow-hidden bg-gradient-to-br from-[#0e1d63] via-navy to-navy-dark py-16 lg:py-20">
            {{-- Aksen pendukung: kotak tipis bertumpuk (sudut tajam, selaras dengan tombol dan kartu) di kedua sisi, dan strip tipis di dasar. --}}
            <svg class="absolute -left-48 top-1/2 -z-10 size-[26rem] -translate-y-1/2 sm:-left-40 sm:size-[36rem]" viewBox="0 0 400 400" fill="none" stroke="white" stroke-width="1" aria-hidden="true">
                <rect x="140" y="140" width="120" height="120" stroke-opacity=".14"/>
                <rect x="95" y="95" width="210" height="210" stroke-opacity=".12"/>
                <rect x="50" y="50" width="300" height="300" stroke="#ff3535" stroke-opacity=".4"/>
                <rect x="5" y="5" width="390" height="390" stroke-opacity=".08"/>
            </svg>
            <svg class="absolute -right-48 top-1/2 -z-10 size-[26rem] -translate-y-1/2 sm:-right-40 sm:size-[36rem]" viewBox="0 0 400 400" fill="none" stroke="white" stroke-width="1" aria-hidden="true">
                <rect x="140" y="140" width="120" height="120" stroke-opacity=".14"/>
                <rect x="95" y="95" width="210" height="210" stroke="#ff3535" stroke-opacity=".4"/>
                <rect x="50" y="50" width="300" height="300" stroke-opacity=".12"/>
                <rect x="5" y="5" width="390" height="390" stroke-opacity=".08"/>
            </svg>
            <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand" aria-hidden="true"></div>

            <div class="container-site text-center">
                <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand-bright">Layanan &amp; Jasa</span>
                <h2 class="mx-auto mt-6 max-w-3xl text-4xl font-bold leading-[1.05] tracking-tight text-white sm:text-5xl lg:text-6xl">
                    <span class="text-brand-bright">Aktivitas Usaha</span> Perusahaan
                </h2>
                <div class="mt-8">
                    <x-ui.button :href="route('activities')">
                        Lihat Semua
                        <x-ui.icon name="arrow-right" class="size-4" />
                    </x-ui.button>
                </div>
            </div>
        </div>

        {{-- Carousel selebar layar (tanpa padding kontainer), latar putih --}}
        <div class="bg-white py-14 lg:py-16">
            <x-web.activity-carousel :activities="$activities" />
        </div>
    </section>

    {{-- CTA kontak: panel terbagi, kiri navy (ajakan), kanan putih (data kontak) --}}
    <section class="bg-surface">
        <div class="container-site py-16 lg:py-20">
            <div class="mx-auto max-w-6xl overflow-hidden border border-navy/15 bg-white shadow-sm shadow-navy/5">
                <div class="grid lg:grid-cols-12">
                    <div class="relative isolate overflow-hidden bg-gradient-to-br from-[#0e1d63] via-navy to-navy-dark p-8 sm:p-10 lg:col-span-7 lg:p-12">
                        {{-- Aksen: kotak tipis saling tumpang tindih dengan ukuran bervariasi. --}}
                        <svg class="absolute -bottom-24 -right-24 -z-10 size-[22rem]" viewBox="0 0 400 400" fill="none" stroke="#ff3535" stroke-width="1" aria-hidden="true">
                            <rect x="150" y="130" width="190" height="190" stroke-opacity=".45"/>
                            <rect x="90" y="40" width="150" height="150" stroke-opacity=".3"/>
                            <rect x="30" y="110" width="130" height="130" stroke-opacity=".22"/>
                            <rect x="205" y="60" width="80" height="80" stroke-opacity=".3"/>
                        </svg>
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand lg:inset-x-auto lg:inset-y-0 lg:left-0 lg:h-auto lg:w-1" aria-hidden="true"></div>

                        <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand-bright">Kontak</span>
                        <h2 class="mt-5 max-w-xl text-4xl font-bold leading-[1.08] tracking-tight text-white sm:text-5xl">
                            Ada yang ingin <span class="text-brand-bright">Anda tanyakan?</span>
                        </h2>
                        <p class="mt-5 max-w-md text-sm leading-7 text-white/75 sm:text-base">
                            Hubungi kami melalui email atau telepon, atau kunjungi alamat perusahaan.
                        </p>
                        <div class="mt-8">
                            <x-ui.button :href="route('contact')">
                                Hubungi Kami
                                <x-ui.icon name="arrow-right" class="size-4" />
                            </x-ui.button>
                        </div>
                    </div>

                    <div class="p-8 sm:p-10 lg:col-span-5 lg:p-12">
                        <span class="text-xs font-bold uppercase tracking-[0.18em] text-navy">Informasi Kontak</span>

                        <div class="mt-6 space-y-3">
                            <a href="tel:{{ $company['phone_href'] }}" class="group flex items-center gap-4 border border-navy/10 p-4 transition-colors hover:border-brand/40">
                                <span class="flex size-11 shrink-0 items-center justify-center bg-navy text-white transition-colors group-hover:bg-brand">
                                    <x-ui.icon name="phone" class="size-5" />
                                </span>
                                <span class="min-w-0">
                                    <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-muted">Telepon</span>
                                    <span class="mt-0.5 block text-sm font-semibold text-navy">{{ $company['phone'] }}</span>
                                </span>
                            </a>
                            <a href="mailto:{{ $company['email'] }}" class="group flex items-center gap-4 border border-navy/10 p-4 transition-colors hover:border-brand/40">
                                <span class="flex size-11 shrink-0 items-center justify-center bg-navy text-white transition-colors group-hover:bg-brand">
                                    <x-ui.icon name="mail" class="size-5" />
                                </span>
                                <span class="min-w-0">
                                    <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-muted">Email</span>
                                    <span class="mt-0.5 block break-all text-sm font-semibold text-navy">{{ $company['email'] }}</span>
                                </span>
                            </a>
                            <a href="{{ $company['maps_url'] }}" target="_blank" rel="noopener noreferrer" class="group flex gap-4 border border-navy/10 p-4 transition-colors hover:border-brand/40">
                                <span class="flex size-11 shrink-0 items-center justify-center bg-navy text-white transition-colors group-hover:bg-brand">
                                    <x-ui.icon name="map-pin" class="size-5" />
                                </span>
                                <span class="min-w-0">
                                    <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-muted">Alamat <span class="sr-only">(buka di Google Maps, tab baru)</span></span>
                                    <span class="mt-0.5 block text-sm leading-6 text-navy">{{ $company['address'] }}</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
