{{-- Props: title (wajib). Slot: tombol aksi di sisi kanan. --}}
@props(['title'])
<div class="flex flex-col gap-4 border-b border-navy/10 pb-5 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="font-display text-2xl font-extrabold text-navy">{{ $title }}</h1>
    @if (! $slot->isEmpty())
        <div class="flex gap-3">{{ $slot }}</div>
    @endif
</div>
