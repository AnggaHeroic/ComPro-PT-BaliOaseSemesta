@extends('layouts.app')

@php $c = config('company'); @endphp

@section('title', 'Tentang Kami')
@section('description', $c['name'].' berkedudukan di '.$c['city'].'.')

@section('content')
    <x-site.hero eyebrow="Tentang Kami" :title="$c['name']" />

    {{-- Hanya fakta yang dikonfirmasi. Sejarah, visi, misi, dan nilai belum tersedia, sehingga tidak ditampilkan. --}}
    <section class="py-16 sm:py-20">
        <div class="container-site grid gap-12 lg:grid-cols-3 lg:gap-16">
            <div class="space-y-5 text-base leading-relaxed text-muted lg:col-span-2">
                <p><strong class="font-semibold text-navy">{{ $c['name'] }}</strong> berkedudukan di {{ $c['city'] }}. Perusahaan menjalankan kegiatan usaha pada tujuh bidang berikut.</p>
                <ul class="space-y-3 border-l-2 border-brand pl-5">
                    @foreach ($c['activities'] as $activity)
                        <li class="font-medium text-navy">{{ $activity }}</li>
                    @endforeach
                </ul>
                <p>Untuk informasi lebih lanjut, silakan hubungi kami melalui halaman kontak.</p>
                <div class="pt-2"><x-button :href="route('contact')">Hubungi Kami</x-button></div>
            </div>

            <aside class="h-fit space-y-4" aria-label="Informasi perusahaan">
                <x-site.contact-card icon="map-pin" title="Alamat" :value="$c['address']" />
                <x-site.contact-card icon="mail" title="Email" :value="$c['email']" :href="'mailto:'.$c['email']" />
                <x-site.contact-card icon="phone" title="Telepon" :value="$c['phone']" :href="'tel:'.$c['phone_href']" />
            </aside>
        </div>
    </section>
@endsection
