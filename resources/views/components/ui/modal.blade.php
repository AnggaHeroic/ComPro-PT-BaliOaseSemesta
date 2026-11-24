{{-- Props: name (wajib), title. Dibuka dengan $dispatch('open-modal', 'nama') dan ditutup dengan $dispatch('close-modal', 'nama'). Slot: isi modal. --}}
@props(['name', 'title' => null])
<div x-data="{ show: false }"
     x-show="show" x-cloak
     @open-modal.window="if ($event.detail === @js($name)) show = true"
     @close-modal.window="if ($event.detail === @js($name)) show = false"
     @keydown.escape.window="show = false"
     class="fixed inset-0 z-50 flex items-center justify-center bg-navy-dark/60 p-4"
     role="dialog" aria-modal="true" @if ($title) aria-label="{{ $title }}" @endif>
    <div class="absolute inset-0" @click="show = false" aria-hidden="true"></div>
    <div class="relative w-full max-w-md border-t-4 border-brand bg-white p-6 shadow-xl">
        @if ($title)
            <h2 class="font-display text-lg font-bold text-navy">{{ $title }}</h2>
        @endif
        <div class="mt-3 text-sm text-ink">{{ $slot }}</div>
    </div>
</div>
