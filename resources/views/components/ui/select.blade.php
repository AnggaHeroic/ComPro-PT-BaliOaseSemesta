{{-- Props: name (wajib), label. Slot: elemen <option>. Atribut lain diteruskan ke select. --}}
@props(['name', 'label' => null])
<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-navy">{{ $label }}</label>
    @endif
    <select id="{{ $name }}" name="{{ $name }}"
            {{ $attributes->merge(['class' => 'mt-1 block w-full border border-navy/20 bg-white px-3 py-2 text-sm text-ink focus:border-navy focus:outline-none focus:ring-1 focus:ring-navy']) }}>
        {{ $slot }}
    </select>
    @error($name)
        <p class="mt-1 text-sm text-brand">{{ $message }}</p>
    @enderror
</div>
