@php $c = config('company'); @endphp
<x-layouts.app title="Kontak" :description="'Hubungi '.$c['name'].' melalui email, telepon, atau kunjungi alamat kami di '.$c['city'].'.'">
    <x-page-hero eyebrow="Kontak" title="Hubungi Kami" />

    <section class="py-16 sm:py-20">
        <div class="container-site grid gap-4 md:grid-cols-2 lg:max-w-4xl">
            <x-contact-card icon="mail" title="Email" :value="$c['email']" :href="'mailto:'.$c['email']" />
            <x-contact-card icon="phone" title="Telepon" :value="$c['phone']" :href="'tel:'.$c['phone_href']" />
            <x-contact-card icon="map-pin" title="Alamat" :value="$c['address']" class="md:col-span-2" />
        </div>
    </section>
</x-layouts.app>
