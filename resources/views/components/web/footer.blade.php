{{-- Props: company (array dari CompanyService), menu (item navigasi dari NavigationService) --}}
@props(['company', 'menu'])
<footer id="kontak" class="border-t-2 border-brand bg-black text-white/80">
    <div class="container-site grid gap-10 py-14 md:grid-cols-3">
        <div>
            <div class="flex items-center gap-3">
                <span class="flex size-14 shrink-0 items-center justify-center rounded-full bg-white">
                    <x-ui.application-logo size="size-11" />
                </span>
                <span class="font-display text-base font-extrabold uppercase leading-tight tracking-wide text-white">{{ $company['name'] }}</span>
            </div>
            {{-- Hanya fakta terkonfirmasi: domisili dan jumlah bidang usaha. --}}
            <p class="mt-5 max-w-sm text-sm leading-relaxed">{{ $company['name'] }} berkedudukan di {{ $company['city'] }} dan menjalankan kegiatan usaha pada {{ count($company['activities']) }} bidang. Silakan lihat halaman Layanan &amp; Jasa untuk mengetahui layanan yang tersedia.</p>
        </div>

        <nav aria-label="Navigasi footer">
            <h2 class="text-sm font-bold uppercase tracking-widest text-brand-bright">Navigasi</h2>
            <ul class="mt-4 space-y-2 text-sm">
                @foreach ($menu as $item)
                    <li><a href="{{ $item['href'] }}" class="rounded transition-colors hover:text-white hover:underline">{{ $item['label'] }}</a></li>
                @endforeach
            </ul>
        </nav>

        <div>
            <h2 class="text-sm font-bold uppercase tracking-widest text-brand-bright">Kontak</h2>
            <address class="mt-4 space-y-3 text-sm not-italic">
                <p><span class="block text-white/60">Email</span><a href="mailto:{{ $company['email'] }}" class="break-all rounded transition-colors hover:text-white hover:underline">{{ $company['email'] }}</a></p>
                <p><span class="block text-white/60">Telepon</span><a href="tel:{{ $company['phone_href'] }}" class="rounded transition-colors hover:text-white hover:underline">{{ $company['phone'] }}</a></p>
                <p><span class="block text-white/60">Alamat</span>{{ $company['address'] }}</p>
            </address>
        </div>
    </div>
    <div class="border-t border-white/10">
        <p class="container-site py-5 text-xs text-white/60">&copy; {{ date('Y') }} {{ $company['name'] }}. Hak cipta dilindungi.</p>
    </div>
</footer>
