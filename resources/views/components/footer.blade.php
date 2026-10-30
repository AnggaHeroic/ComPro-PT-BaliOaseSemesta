@php $c = config('company'); @endphp
<footer id="kontak" class="border-t-2 border-brand bg-navy-dark text-white/80">
    <div class="container-site grid gap-10 py-14 md:grid-cols-3">
        <div>
            <div class="flex items-center gap-3">
                <span class="flex size-14 shrink-0 items-center justify-center rounded-full bg-white">
                    <x-logo size="size-11" />
                </span>
                <span class="font-display text-base font-extrabold uppercase leading-tight tracking-wide text-white">{{ $c['name'] }}</span>
            </div>
            <p class="mt-4 max-w-xs text-sm leading-relaxed">{{ $c['city'] }}</p>
        </div>

        <nav aria-label="Navigasi footer">
            <h2 class="text-sm font-bold uppercase tracking-widest text-brand-bright">Navigasi</h2>
            <ul class="mt-4 space-y-2 text-sm">
                @foreach ($c['nav'] as $route => $label)
                    <li><a href="{{ route($route) }}" class="rounded transition-colors hover:text-white hover:underline">{{ $label }}</a></li>
                @endforeach
            </ul>
        </nav>

        <div>
            <h2 class="text-sm font-bold uppercase tracking-widest text-brand-bright">Kontak</h2>
            <address class="mt-4 space-y-3 text-sm not-italic">
                <p><span class="block text-white/60">Email</span><a href="mailto:{{ $c['email'] }}" class="break-all rounded transition-colors hover:text-white hover:underline">{{ $c['email'] }}</a></p>
                <p><span class="block text-white/60">Telepon</span><a href="tel:{{ $c['phone_href'] }}" class="rounded transition-colors hover:text-white hover:underline">{{ $c['phone'] }}</a></p>
                <p><span class="block text-white/60">Alamat</span>{{ $c['address'] }}</p>
            </address>
        </div>
    </div>
    <div class="border-t border-white/10">
        <p class="container-site py-5 text-xs text-white/60">&copy; {{ date('Y') }} {{ $c['name'] }}. Hak cipta dilindungi.</p>
    </div>
</footer>
