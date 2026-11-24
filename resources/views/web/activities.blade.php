@extends('layouts.public')


@section('title', $active ? $active['name'].' — Layanan & Jasa' : 'Layanan & Jasa')
@section('description', 'Bidang kegiatan usaha '.$company['name'].'.')
@section('nav', 'transparent')

@section('content')
    <x-web.hero variant="services" eyebrow="Layanan & Jasa">
        <x-slot:title><span class="block">{{ $total_label }} Bidang,</span><span class="block text-brand-bright">Satu Perusahaan</span></x-slot:title>
        {{ $company['name'] }} berkedudukan di {{ $company['city'] }} dan menjalankan kegiatan usaha di bidang perdagangan, penerbitan, media rekaman, platform digital, sewa guna usaha, serta penasihat investasi.
        <x-slot:actions>
            <x-ui.button href="#daftar-aktivitas">
                Jelajahi Layanan
                <x-ui.icon name="chevron-down" class="size-4" />
            </x-ui.button>
        </x-slot:actions>
        {{-- Bilah indeks di dasar hero: ketujuh bidang usaha, masing-masing menuju halaman detailnya (desktop). --}}
        <x-slot:footer>
            <nav class="container-site hidden lg:block" aria-label="Indeks bidang usaha">
                <ol class="grid grid-cols-7 divide-x divide-white/15 border-x border-white/15">
                    @foreach ($all_items as $item)
                        <li>
                            <a href="{{ route('activities.show', $item['slug']) }}" class="group flex h-full flex-col gap-3 px-4 py-5 transition-colors hover:bg-white/5">
                                <span class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-brand-bright">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <x-ui.icon :name="$item['icon']" accent="stroke-brand-bright" class="size-8 text-white" />
                                </span>
                                <span class="line-clamp-2 text-xs leading-snug text-white/70 transition-colors group-hover:text-white">{{ $item['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ol>
            </nav>
        </x-slot:footer>
    </x-web.hero>

    <section class="bg-surface py-16 sm:py-20">
        <div class="container-site">
            {{-- Pembuka daftar aktivitas (berubah mengikuti kategori yang dipilih) --}}
            <div class="mx-auto mb-10 max-w-2xl text-center sm:mb-12">
                @if ($active)
                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand">Kategori Usaha</span>
                    <h2 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight text-navy sm:text-4xl">{{ $active['name'] }}</h2>
                    <p class="mt-4 text-base leading-relaxed text-muted">
                        {{ count($items) }} aktivitas usaha {{ $company['name'] }} dalam kategori ini.
                    </p>
                @else
                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand">Aktivitas Usaha</span>
                    <h2 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight text-navy sm:text-4xl">
                        Daftar <span class="text-brand">Aktivitas Usaha</span> Perusahaan
                    </h2>
                    <p class="mt-4 text-base leading-relaxed text-muted">
                        Seluruh kegiatan usaha perusahaan{{ $sidebar ? ', dikelompokkan dalam kategori usaha pada panel di samping' : '' }}.
                    </p>
                @endif
            </div>

        </div>

        {{-- Sidebar kategori (bila diaktifkan) menempel ke tepi kiri layar dan sticky selama daftar masih terlihat;
             kartu di kanan. Tanpa sidebar: kartu memenuhi kontainer, tiga kolom dengan kartu terakhir di tengah. --}}
        <div id="daftar-aktivitas" @class(['scroll-mt-28', 'lg:grid lg:grid-cols-[17rem_minmax(0,1fr)] xl:grid-cols-[22rem_minmax(0,1fr)]' => $sidebar])>
            @if ($sidebar)
                {{-- Sticky hanya bila kartu lebih dari satu baris (tiga kartu per baris di desktop lebar). --}}
                <x-web.category-sidebar :categories="$categories" :active="$active" :total="$total" :sticky="count($items) > 3" />
            @endif

            <div @class(['px-5 lg:px-10' => $sidebar, 'container-site' => ! $sidebar])>
                <ol @class([
                    'mx-auto grid max-w-[68rem] gap-5 sm:grid-cols-2 xl:grid-cols-3' => $sidebar,
                    'mx-auto grid max-w-[68rem] gap-5 md:grid-cols-2 lg:grid-cols-6' => ! $sidebar,
                ])>
                    @foreach ($items as $item)
                        <x-web.activity-card
                            :title="$item['title']"
                            :href="route('activities.show', $item['slug'])"
                            :image="$item['image']"
                            :icon="$item['icon']"
                            :class="$sidebar ? '' : ($loop->last ? 'md:col-span-2 lg:col-span-2 lg:col-start-3' : 'lg:col-span-2')" />
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    <x-web.contact-cta :company="$company" />
@endsection
