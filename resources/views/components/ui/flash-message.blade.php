{{-- Props: tidak ada. Menampilkan flash session 'success' dan 'error' yang bisa ditutup; dipasang sekali di layout. --}}
@foreach (['success' => 'border-green-600 bg-green-50 text-green-900', 'error' => 'border-brand bg-red-50 text-brand-dark'] as $type => $style)
    @if (session($type))
        <div x-data="{ open: true }" x-show="open" role="alert"
             class="flex items-start justify-between gap-4 border-l-4 px-4 py-3 text-sm {{ $style }}">
            <p>{{ session($type) }}</p>
            <button type="button" @click="open = false" class="font-bold leading-none" aria-label="Tutup pesan">&times;</button>
        </div>
    @endif
@endforeach
