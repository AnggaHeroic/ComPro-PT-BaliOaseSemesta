@extends('layouts.public')

@section('title', 'Tentang Kami')
@section('description', $company['name'].' berkedudukan di '.$company['city'].'. Profil perusahaan, visi, misi, dan nilai.')
@section('nav', 'transparent')

{{-- Hanya fakta yang dikonfirmasi. Sejarah belum tersedia sehingga tidak ditampilkan. Profil, visi, misi, dan nilai masih placeholder. --}}
@section('content')
    <x-web.hero variant="profile" eyebrow="Tentang Kami">
        <x-slot:title><span class="block">Mengenal</span><span class="block text-brand-bright">{{ $company['short_name'] }}</span></x-slot:title>
        {{ $company['name'] }} berkedudukan di {{ $company['city'] }} dan menjalankan kegiatan usaha di bidang perdagangan, penerbitan, media rekaman, platform digital, sewa guna usaha, serta penasihat investasi.
        {{-- Emblem: logo perusahaan di tengah kotak-kotak bertumpuk. --}}
        <x-slot:aside>
            <div class="relative flex size-80 items-center justify-center xl:size-96">
                <span class="absolute inset-0 border border-white/15"></span>
                <span class="absolute inset-10 border border-brand-bright/50"></span>
                <span class="absolute inset-20 border border-white/10"></span>
                <span class="relative flex size-56 items-center justify-center rounded-full bg-white shadow-xl shadow-navy-dark/40">
                    <x-ui.application-logo size="size-48" />
                </span>
            </div>
        </x-slot:aside>
    </x-web.hero>

    {{-- Profil perusahaan: teks di kiri; foto bertajuk dan lembar fakta di kanan. Seluruh isi masih placeholder (config/company.php). --}}
    @if (! empty($about['profile']))
        @php($profile = $about['profile'])
        <section class="bg-white py-16 sm:py-20 lg:py-24" aria-labelledby="judul-profil">
            <div class="container-site grid items-start gap-12 lg:grid-cols-12 lg:gap-16">
                <div class="lg:col-span-7">
                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand">{{ $profile['label'] }}</span>
                    <h2 id="judul-profil" class="mt-5 text-3xl font-extrabold leading-[1.1] tracking-tight text-navy sm:text-4xl">
                        {{ $profile['title'] }} <span class="text-brand">{{ $profile['title_accent'] }}</span>
                    </h2>
                    <div class="mt-7 space-y-5 text-base leading-8 text-muted sm:text-lg">
                        @foreach ($profile['paragraphs'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                    <div class="mt-9 flex flex-wrap gap-3">
                        <x-ui.button :href="route('activities')">
                            Layanan &amp; Jasa
                            <x-ui.icon name="arrow-right" class="size-4" />
                        </x-ui.button>
                        <x-ui.button :href="route('contact')" variant="outline">Hubungi Kami</x-ui.button>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <figure>
                        <img src="https://picsum.photos/id/{{ $profile['image'] }}/1200/900" alt="{{ $profile['image_caption'] }}" class="aspect-[4/3] w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
                        <figcaption class="border-l-4 border-brand bg-navy-dark px-5 py-3 text-sm text-white/85">{{ $profile['image_caption'] }}</figcaption>
                    </figure>
                    @if (! empty($profile['facts']))
                        <dl class="mt-6 grid grid-cols-2 gap-px border border-navy/10 bg-navy/10">
                            @foreach ($profile['facts'] as $fact)
                                <div class="bg-surface px-5 py-4">
                                    <dt class="text-[11px] font-semibold uppercase tracking-[0.14em] text-muted">{{ $fact['title'] }}</dt>
                                    <dd class="mt-1.5 font-display text-base font-bold leading-snug text-navy">{{ $fact['text'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- Visi dan misi: satu panel dua bagian. Visi di blok navy (kiri), misi sebagai daftar bernomor di blok putih (kanan). Tinggi menyesuaikan teks terpanjang. Teks masih placeholder (config/company.php). --}}
    @if (! empty($about['vision']) || ! empty($about['missions']))
        <section class="bg-surface py-16 sm:py-20 lg:py-24" aria-labelledby="judul-visi-misi">
            <div class="container-site">
                <div class="grid border border-navy/10 bg-white shadow-sm shadow-navy/5 lg:grid-cols-12">
                    @if (! empty($about['vision']))
                        <div class="relative isolate flex flex-col justify-between gap-12 overflow-hidden bg-navy p-8 text-white sm:p-10 lg:min-h-[28rem] lg:p-12 {{ empty($about['missions']) ? 'lg:col-span-12' : 'lg:col-span-5' }}">
                            <div class="pattern-grid absolute inset-0 -z-10 [mask-image:linear-gradient(to_bottom_right,black,transparent_80%)]" aria-hidden="true"></div>
                            {{-- Kotak bertumpuk di sudut, mengulang aksen hero agar blok tidak terasa kosong. --}}
                            <svg class="absolute -bottom-24 -right-24 -z-10 size-96" viewBox="0 0 400 400" fill="none" aria-hidden="true">
                                <rect x="140" y="140" width="260" height="260" stroke="#fff" stroke-opacity=".12"/>
                                <rect x="95" y="95" width="305" height="305" stroke="#ff3535" stroke-opacity=".4"/>
                                <rect x="50" y="50" width="350" height="350" stroke="#fff" stroke-opacity=".12"/>
                                <rect x="5" y="5" width="395" height="395" stroke="#fff" stroke-opacity=".08"/>
                            </svg>
                            <span class="absolute inset-x-0 top-0 h-1 bg-brand" aria-hidden="true"></span>
                            <div>
                                <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand-bright">Visi</span>
                                <svg class="mt-6 size-9 text-brand-bright" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true"><path d="M4 18c0-6.6 3.3-11 9-12.5v3.6C10 10.4 8.7 12.6 8.6 15H13v11H4V18Zm15 0c0-6.600 3.300-11 9-12.500v3.600c-3 .8-4.300 3.100-4.400 5.500H28v11H19V18Z"/></svg>
                                <p id="judul-visi-misi" class="mt-4 font-display text-xl font-bold leading-snug sm:text-2xl">{{ $about['vision'] }}</p>
                            </div>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-white/50">{{ $company['name'] }}</p>
                        </div>
                    @endif

                    @if (! empty($about['missions']))
                        <div class="p-8 sm:p-10 lg:p-12 {{ empty($about['vision']) ? 'lg:col-span-12' : 'lg:col-span-7' }}">
                            <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand">Misi</span>
                            <ol class="mt-6 divide-y divide-navy/10">
                                @foreach ($about['missions'] as $mission)
                                    <li class="flex gap-5 py-5 first:pt-0 last:pb-0">
                                        <span class="flex size-10 shrink-0 items-center justify-center bg-navy font-display text-sm font-bold text-white">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                        <div class="min-w-0">
                                            <h3 class="font-display text-base font-bold leading-snug text-navy sm:text-lg">{{ $mission['title'] }}</h3>
                                            <p class="mt-1.5 text-sm leading-7 text-muted">{{ $mission['text'] }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- Nilai perusahaan: deretan kolom bersekat tipis. Teks masih placeholder. --}}
    @if (! empty($about['values']))
        <section class="relative isolate overflow-hidden bg-navy py-16 text-white sm:py-20 lg:py-24" aria-labelledby="judul-nilai">
            {{-- Efek pendukung halus: kisi tipis yang memudar ke tepi, dan garis merah pendek di tepi atas. --}}
            <div class="pattern-grid absolute inset-0 -z-10 [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]" aria-hidden="true"></div>
            <span class="absolute left-1/2 top-0 h-1 w-16 -translate-x-1/2 bg-brand" aria-hidden="true"></span>
            <div class="container-site">
                <div class="mx-auto max-w-2xl text-center">
                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand-bright">Nilai Perusahaan</span>
                    <h2 id="judul-nilai" class="mt-5 text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">Prinsip yang Kami Pegang</h2>
                </div>
                <ul class="mt-12 grid divide-y divide-white/15 border-y border-white/15 sm:grid-cols-2 sm:divide-x sm:divide-y-0 lg:grid-cols-4">
                    @foreach ($about['values'] as $value)
                        <li class="py-8 sm:px-6 sm:first:pl-0">
                            <span class="block h-1 w-8 bg-brand-bright" aria-hidden="true"></span>
                            <h3 class="mt-5 font-display text-xl font-bold">{{ $value['title'] }}</h3>
                            <p class="mt-3 text-sm leading-7 text-white/70">{{ $value['text'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <x-web.contact-cta :company="$company" heading="Mari" accent="Berdiskusi" />
@endsection
