@extends('layouts.app')

@php $c = config('company'); @endphp

@section('title', $active ? $active['name'].' — Layanan & Jasa' : 'Layanan & Jasa')
@section('description', 'Bidang kegiatan usaha '.$c['name'].'.')
@section('nav', 'transparent')

@section('content')
    @php
        // $total berasal dari controller; jumlah bidang ditulis dengan huruf (hingga sepuluh), selebihnya angka.
        $words = [1 => 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh'];
    @endphp
    <x-site.hero variant="split" eyebrow="Layanan & Jasa">
        <x-slot:title><span class="block">{{ $words[$total] ?? $total }} Bidang,</span><span class="block text-brand-bright">Satu Perusahaan</span></x-slot:title>
        {{ $c['name'] }} berkedudukan di {{ $c['city'] }} dan menjalankan kegiatan usaha di bidang perdagangan, penerbitan, media rekaman, platform digital, sewa guna usaha, serta penasihat investasi.
    </x-site.hero>

    <section class="bg-surface py-16 sm:py-20">
        <div class="container-site">
            {{-- Pembuka daftar aktivitas (berubah mengikuti kategori yang dipilih) --}}
            <div class="mx-auto mb-10 max-w-2xl text-center sm:mb-12">
                @if ($active)
                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand">Kategori Usaha</span>
                    <h2 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight text-navy sm:text-4xl">{{ $active['name'] }}</h2>
                    <p class="mt-4 text-base leading-relaxed text-muted">
                        {{ count($items) }} aktivitas usaha {{ $c['name'] }} dalam kategori ini.
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
                <x-site.category-sidebar :categories="$categories" :active="$active" :total="$total" :sticky="count($items) > 3" />
            @endif

            <div @class(['px-5 lg:px-10' => $sidebar, 'container-site' => ! $sidebar])>
                <ol @class([
                    'mx-auto grid max-w-[68rem] gap-5 sm:grid-cols-2 xl:grid-cols-3' => $sidebar,
                    'mx-auto grid max-w-[68rem] gap-5 md:grid-cols-2 lg:grid-cols-6' => ! $sidebar,
                ])>
                    @foreach ($items as $item)
                        <x-site.activity-card
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

    <x-site.contact-cta />
@endsection
