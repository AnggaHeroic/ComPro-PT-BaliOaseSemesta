@extends('layouts.app')

@php
    $c = config('company');
    // Tautan "kembali": ke kategori aktivitas ini bila pengategorian aktif, selain itu ke daftar lengkap.
    $backUrl = $category ? route('activities.category', $category['slug']).'#daftar-aktivitas' : route('activities').'#daftar-aktivitas';
@endphp

@section('title', $title.' — Layanan & Jasa')
@section('description', $description)

@section('content')
    <x-site.hero variant="detail" :eyebrow="$category['name'] ?? 'Layanan & Jasa'" :title="$title">
        {{ $description }}
        {{-- Ikon aktivitas di dalam cincin konsentris, di kanan hero (desktop). --}}
        <x-slot:aside>
            <div class="relative flex size-56 items-center justify-center xl:size-64">
                <span class="absolute inset-0 rounded-full border border-white/10"></span>
                <span class="absolute inset-4 rounded-full border border-brand-bright/30"></span>
                <span class="absolute inset-8 rounded-full bg-white/5 ring-1 ring-white/15"></span>
                <x-icon :name="$icon" accent="stroke-brand-bright" class="relative size-24 text-white xl:size-28" />
            </div>
        </x-slot:aside>
    </x-site.hero>

    {{-- Jejak halaman --}}
    <nav class="border-b border-navy/10 bg-white" aria-label="Jejak halaman">
        <ol class="container-site flex flex-wrap items-center gap-x-2 gap-y-1 py-4 text-xs font-semibold text-muted sm:text-sm">
            <li><a href="{{ route('home') }}" class="transition-colors hover:text-brand">Beranda</a></li>
            <li aria-hidden="true">/</li>
            <li><a href="{{ route('activities') }}" class="transition-colors hover:text-brand">{{ $c['nav']['activities'] }}</a></li>
            @if ($category)
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('activities.category', $category['slug']) }}" class="transition-colors hover:text-brand">{{ $category['name'] }}</a></li>
            @endif
            <li aria-hidden="true">/</li>
            <li class="min-w-0 truncate text-navy" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <section class="bg-surface py-12 sm:py-16">
        <div class="container-site grid gap-10 lg:grid-cols-12 lg:gap-12">
            <article class="lg:col-span-8">
                {{-- Foto PLACEHOLDER sementara (Picsum/Unsplash, bebas pakai). Ganti dengan foto resmi perusahaan bila tersedia. --}}
                <div class="relative aspect-[16/9] overflow-hidden bg-navy" aria-hidden="true">
                    <img src="https://picsum.photos/id/{{ $image }}/1200/675" alt="" width="1200" height="675" loading="lazy" referrerpolicy="no-referrer" class="size-full object-cover">
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-navy-dark/60 to-transparent"></div>
                    <div class="absolute left-0 top-0 h-1 w-24 bg-brand"></div>
                    <div class="absolute right-6 top-6 size-8 border-r-2 border-t-2 border-white/80"></div>
                </div>

                <div class="border border-t-0 border-navy/10 bg-white px-6 pb-8 sm:px-10 sm:pb-10">
                    {{-- Ikon bulat menumpang di sambungan foto dan panel, seperti kartu pada daftar aktivitas. --}}
                    <span class="relative z-10 -mt-8 flex size-16 items-center justify-center rounded-full bg-navy text-white ring-4 ring-white" aria-hidden="true">
                        <x-icon :name="$icon" accent="stroke-brand-bright" class="size-9" />
                    </span>

                    <h2 class="mt-6 text-xs font-bold uppercase tracking-[0.18em] text-brand">Deskripsi Kegiatan Usaha</h2>
                    <p class="mt-4 text-lg leading-8 text-ink">{{ $description }}</p>

                    <h2 class="mt-10 text-xs font-bold uppercase tracking-[0.18em] text-brand">Ringkasan</h2>
                    <dl class="mt-4 divide-y divide-navy/10 border-y border-navy/10 text-sm">
                        <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-6">
                            <dt class="font-semibold uppercase tracking-[0.12em] text-muted">Kegiatan Usaha</dt>
                            <dd class="font-semibold text-navy sm:col-span-2">{{ $title }}</dd>
                        </div>
                        @if ($category)
                            <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-6">
                                <dt class="font-semibold uppercase tracking-[0.12em] text-muted">Kategori Usaha</dt>
                                <dd class="sm:col-span-2"><a href="{{ route('activities.category', $category['slug']) }}#daftar-aktivitas" class="font-semibold text-navy underline decoration-brand decoration-2 underline-offset-4 transition-colors hover:text-brand">{{ $category['name'] }}</a></dd>
                            </div>
                        @endif
                        <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-6">
                            <dt class="font-semibold uppercase tracking-[0.12em] text-muted">Perusahaan</dt>
                            <dd class="font-semibold text-navy sm:col-span-2">{{ $c['name'] }}</dd>
                        </div>
                        <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-6">
                            <dt class="font-semibold uppercase tracking-[0.12em] text-muted">Kedudukan</dt>
                            <dd class="font-semibold text-navy sm:col-span-2">{{ $c['city'] }}</dd>
                        </div>
                    </dl>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <x-button :href="$backUrl" variant="outline">
                            <x-icon name="arrow-right" class="size-4 rotate-180" />
                            Kembali ke Daftar
                        </x-button>
                        <x-button :href="route('contact')">
                            Hubungi Kami
                            <x-icon name="arrow-right" class="size-4" />
                        </x-button>
                    </div>
                </div>
            </article>

            {{-- Daftar seluruh aktivitas; yang sedang dibuka ditandai merah. Menempel saat scroll di desktop. --}}
            <aside class="lg:col-span-4" aria-label="Seluruh aktivitas usaha">
                <div class="border border-navy/15 bg-white shadow-xl shadow-navy/10 lg:sticky lg:top-28">
                    <div class="h-7 bg-navy-dark" aria-hidden="true"></div>
                    <h2 class="px-6 pt-5 text-xs font-bold uppercase tracking-[0.18em] text-navy">Aktivitas Usaha Lainnya</h2>
                    <ul class="mt-3 pb-2">
                        @foreach ($all as $item)
                            <li class="border-t border-navy/10">
                                <a href="{{ route('activities.show', $item['slug']) }}" @if ($item['current']) aria-current="page" @endif
                                   @class([
                                       'block py-4 pl-6 pr-6 text-sm leading-6 transition-colors',
                                       'bg-[#fdf2f2] font-bold text-brand shadow-[inset_4px_0_0_var(--color-brand)]' => $item['current'],
                                       'font-semibold text-navy hover:bg-surface hover:text-brand' => ! $item['current'],
                                   ])>{{ $item['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>

        {{-- Navigasi sebelumnya / berikutnya --}}
        <div class="container-site mt-12">
            <nav class="grid border border-navy/10 bg-white sm:grid-cols-2 sm:divide-x sm:divide-navy/10" aria-label="Navigasi aktivitas">
                @foreach ([['item' => $previous, 'label' => 'Sebelumnya', 'next' => false], ['item' => $next, 'label' => 'Berikutnya', 'next' => true]] as $nav)
                    @if ($nav['item'])
                        <a href="{{ route('activities.show', $nav['item']['slug']) }}"
                           @class(['group flex items-center gap-4 p-6 transition-colors hover:bg-navy hover:text-white sm:p-8', 'flex-row-reverse text-right' => $nav['next'], 'border-t border-navy/10 sm:border-t-0' => $nav['next']])>
                            <x-icon name="arrow-right" @class(['size-5 shrink-0 text-brand transition-transform duration-200', 'rotate-180 group-hover:-translate-x-1' => ! $nav['next'], 'group-hover:translate-x-1' => $nav['next']]) />
                            <span class="min-w-0">
                                <span class="block text-xs font-bold uppercase tracking-[0.18em] text-brand">{{ $nav['label'] }}</span>
                                <span class="mt-1 block text-sm font-semibold leading-6 text-navy group-hover:text-white">{{ $nav['item']['title'] }}</span>
                            </span>
                        </a>
                    @else
                        <div class="hidden sm:block" aria-hidden="true"></div>
                    @endif
                @endforeach
            </nav>
        </div>
    </section>

    {{-- Galeri dokumentasi: paginasi per config('images.gallery_per_page') foto dengan tombol panah (Alpine); klik foto membuka lightbox.
         Pola yang sama dengan halaman detail layanan PT. Putra Maju Sukses. Foto masih placeholder. --}}
    @if (count($gallery))
        @php $perPage = config('images.gallery_per_page'); @endphp
        <section class="bg-white" aria-labelledby="judul-dokumentasi">
            <div class="container-site py-16 sm:py-20"
                 x-data="{
                     currentPage: 0,
                     pages: {{ (int) ceil(count($gallery) / $perPage) }},
                     nextPage() { if (this.currentPage < this.pages - 1) this.currentPage++ },
                     previousPage() { if (this.currentPage > 0) this.currentPage-- },
                 }">
                <div class="flex flex-col gap-6 border-b border-navy/10 pb-6 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand">Dokumentasi</span>
                        <h2 id="judul-dokumentasi" class="mt-3 text-3xl font-extrabold leading-tight tracking-tight text-navy sm:text-4xl">
                            Galeri <span class="text-brand">Kegiatan Usaha</span>
                        </h2>
                    </div>

                    <div x-show="pages > 1" x-cloak class="flex items-center gap-3">
                        <span class="text-xs font-bold tracking-[0.15em] text-muted" aria-live="polite">
                            <span x-text="currentPage + 1"></span> / <span x-text="pages"></span>
                        </span>
                        <button type="button" @click="previousPage()" :disabled="currentPage === 0" aria-label="Dokumentasi sebelumnya"
                                class="inline-flex size-11 items-center justify-center border border-navy/20 text-navy transition-colors hover:border-navy hover:bg-navy hover:text-white disabled:pointer-events-none disabled:opacity-30">
                            <x-icon name="arrow-left" class="size-5" />
                        </button>
                        <button type="button" @click="nextPage()" :disabled="currentPage === pages - 1" aria-label="Dokumentasi berikutnya"
                                class="inline-flex size-11 items-center justify-center border border-navy/20 text-navy transition-colors hover:border-navy hover:bg-navy hover:text-white disabled:pointer-events-none disabled:opacity-30">
                            <x-icon name="arrow-right" class="size-5" />
                        </button>
                    </div>
                </div>

                <div class="mt-8">
                    @foreach (array_chunk($gallery, $perPage, true) as $pageIndex => $pageImages)
                        <div @if ($pageIndex > 0) x-show="currentPage === {{ $pageIndex }}" x-cloak @else x-show="currentPage === 0" @endif
                             class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                            @foreach ($pageImages as $globalIndex => $imageUrl)
                                <button type="button"
                                        @click="$dispatch('documentation-open', { index: {{ $globalIndex }} })"
                                        aria-label="Lihat dokumentasi {{ $globalIndex + 1 }}"
                                        class="group relative aspect-[4/3] overflow-hidden bg-navy-tint text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2">
                                    <img src="{{ $imageUrl }}" alt="Dokumentasi {{ $globalIndex + 1 }}" width="1200" height="800" loading="lazy" referrerpolicy="no-referrer"
                                         class="size-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <span class="absolute inset-0 flex items-center justify-center bg-navy-dark/0 transition-colors duration-300 group-hover:bg-navy-dark/40">
                                        <span class="flex size-11 scale-90 items-center justify-center text-white opacity-0 transition-all duration-300 group-hover:scale-100 group-hover:opacity-100">
                                            <x-icon name="zoom-in" class="size-9 drop-shadow" />
                                        </span>
                                    </span>
                                    <span class="absolute inset-x-0 bottom-0 h-0.5 origin-left scale-x-0 bg-brand transition-transform duration-500 group-hover:scale-x-100" aria-hidden="true"></span>
                                </button>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <x-site.img-lightbox :images="$gallery" />
            </div>
        </section>
    @endif

    <x-site.contact-cta />
@endsection
