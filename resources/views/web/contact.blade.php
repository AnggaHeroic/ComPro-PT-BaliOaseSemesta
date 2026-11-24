@extends('layouts.public')


@section('title', 'Kontak')
@section('description', 'Hubungi '.$company['name'].' melalui email, telepon, atau kunjungi alamat kami di '.$company['city'].'.')

@section('content')
    <x-web.hero eyebrow="Kontak" title="Hubungi Kami" />

    <section class="py-16 sm:py-20">
        <div class="container-site grid gap-4 md:grid-cols-2 lg:max-w-4xl">
            <x-web.contact-card icon="mail" title="Email" :value="$company['email']" :href="'mailto:'.$company['email']" />
            <x-web.contact-card icon="phone" title="Telepon" :value="$company['phone']" :href="'tel:'.$company['phone_href']" />
            <x-web.contact-card icon="map-pin" title="Alamat" :value="$company['address']" class="md:col-span-2" />
        </div>
    </section>
@endsection
