{{-- Props: company (array dari CompanyService), heading dan accent (judul; accent berwarna merah, bawaan: ajakan panjang) --}}
@props(['company', 'heading' => 'Butuh informasi lebih lanjut', 'accent' => 'tentang kegiatan usaha kami?'])
{{-- CTA: pita navy selebar layar. Aksen miring di kanan mengulang bahasa visual hero; kiri ajakan, kanan tombol dan kontak langsung.
     Dipakai di halaman Layanan & Jasa dan detail aktivitas. --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-[#0e1d63] via-navy to-navy-dark text-white">
    <div class="absolute inset-y-0 right-0 -z-10 hidden w-1/3 bg-[#3a5cc4]/20 [clip-path:polygon(30%_0,100%_0,100%_100%,0_100%)] lg:block" aria-hidden="true"></div>
    <div class="absolute inset-y-0 right-0 -z-10 hidden w-1/4 bg-gradient-to-b from-brand/70 to-brand/10 [clip-path:polygon(34%_0,100%_0,100%_100%,0_100%)] lg:block" aria-hidden="true"></div>

    <div class="container-site grid items-center gap-10 py-16 lg:grid-cols-12 lg:py-20">
        <div class="lg:col-span-7">
            <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand-bright">Hubungi Kami</span>
            <div class="mt-5">
                <h2 class="max-w-2xl text-3xl font-extrabold leading-[1.1] tracking-tight sm:text-4xl xl:text-5xl">
                    {{ $heading }} <span class="text-brand-bright">{{ $accent }}</span>
                </h2>
                <p class="mt-5 max-w-xl text-sm leading-7 text-white/75 sm:text-base">
                    Sampaikan kebutuhan Anda kepada {{ $company['name'] }}. Kami siap menanggapi melalui email maupun telepon.
                </p>
            </div>
        </div>

        <div class="lg:col-span-5 lg:pl-10 xl:pl-16">
            <x-ui.button :href="route('contact')">
                Hubungi Kami
                <x-ui.icon name="arrow-right" class="size-4" />
            </x-ui.button>

            <ul class="mt-8 space-y-4 border-t border-white/15 pt-6 text-sm">
                <li>
                    <a href="tel:{{ $company['phone_href'] }}" class="group inline-flex items-center gap-3 text-white/85 transition-colors hover:text-white">
                        <x-ui.icon name="phone" class="size-5 text-brand-bright" />
                        <span>{{ $company['phone'] }}</span>
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ $company['email'] }}" class="group inline-flex items-center gap-3 break-all text-white/85 transition-colors hover:text-white">
                        <x-ui.icon name="mail" class="size-5 shrink-0 text-brand-bright" />
                        <span>{{ $company['email'] }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
