@props(['activities', 'speed' => 35])
@php
    $icons = config('company.activity_icons');
    $images = config('company.activity_images');
@endphp
<div data-carousel data-carousel-speed="{{ $speed }}" role="region" aria-roledescription="carousel" aria-label="Aktivitas usaha perusahaan" tabindex="-1">
    {{-- Jalur: bergeser pelan ke kiri secara berulang; berhenti saat kursor di atasnya, dan bisa digeser dengan scroll mouse. --}}
    <ol data-carousel-track class="no-scrollbar flex gap-4 overflow-x-auto" tabindex="0" aria-label="Daftar aktivitas, geser untuk melihat lainnya">
        @foreach ($activities as $i => $activity)
            <li data-carousel-item
                class="group flex shrink-0 basis-[280px] overflow-hidden border border-navy/15 bg-white transition-colors duration-300 hover:border-brand/40 sm:basis-[340px] lg:basis-[380px]">
                {{-- Sementara menuju halaman daftar; ganti ke halaman detail aktivitas bila sudah tersedia. --}}
                <a href="{{ route('activities') }}" draggable="false" class="flex w-full flex-col">
                    {{-- Foto PLACEHOLDER sementara (Picsum/Unsplash, bebas pakai). Ganti dengan foto resmi perusahaan bila tersedia. --}}
                    <img src="https://picsum.photos/id/{{ $images[$i] ?? 1076 }}/640/400" alt="" width="640" height="400" loading="lazy" draggable="false" referrerpolicy="no-referrer" class="aspect-[16/10] w-full select-none object-cover">

                    <div class="flex flex-1 flex-col items-center px-6 pb-6 text-center">
                        <span class="-mt-8 flex size-16 shrink-0 items-center justify-center rounded-full bg-navy text-white ring-4 ring-white">
                            <x-activity-icon :name="$icons[$i] ?? ''" accent="stroke-brand-bright" class="size-10" />
                        </span>

                        {{-- Area judul memuat hingga tiga baris, judul di tengahnya; skeleton menempel di bawahnya. --}}
                        <div class="flex min-h-[5.5rem] items-center">
                            <h3 class="max-w-xs font-display text-lg font-bold leading-snug tracking-tight text-navy sm:text-xl">{{ $activity }}</h3>
                        </div>

                        {{-- Aksen visual: baris skeleton dekoratif, bukan konten. --}}
                        <div class="mt-4 w-full max-w-[15rem] space-y-2.5" aria-hidden="true">
                            <div class="h-2.5 w-full rounded-full bg-navy/10"></div>
                            <div class="mx-auto h-2.5 w-5/6 rounded-full bg-navy/10"></div>
                            <div class="mx-auto h-2.5 w-2/3 rounded-full bg-navy/10"></div>
                        </div>

                        {{-- Penutup kartu: ajakan "Lihat", selalu di dasar kartu. --}}
                        <div class="mt-auto w-full pt-6">
                            <span class="flex w-full items-center justify-center border-t border-navy/10 pt-4 text-sm font-semibold text-brand transition-colors duration-200 group-hover:text-brand-dark">
                                Lihat Aktivitas Usaha
                            </span>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ol>

    {{-- Kontrol manual --}}
    <div class="mt-8 flex justify-center gap-2">
        <button type="button" data-carousel-prev aria-label="Aktivitas sebelumnya"
                class="inline-flex size-11 items-center justify-center border border-navy/25 bg-white text-navy transition-colors hover:bg-navy hover:text-white">
            <x-icon name="arrow-right" class="size-5 rotate-180" />
        </button>
        <button type="button" data-carousel-next aria-label="Aktivitas berikutnya"
                class="inline-flex size-11 items-center justify-center border border-navy/25 bg-white text-navy transition-colors hover:bg-navy hover:text-white">
            <x-icon name="arrow-right" class="size-5" />
        </button>
    </div>
</div>
