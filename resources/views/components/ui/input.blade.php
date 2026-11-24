{{-- Props: name (wajib), label, type (default text), value. Atribut lain (required, autofocus, dll) diteruskan ke input. --}}
@props(['name', 'label' => null, 'type' => 'text', 'value' => null])
<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-navy">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" @if ($value !== null) value="{{ $value }}" @endif
           {{ $attributes->merge(['class' => 'mt-1 block w-full border border-navy/20 bg-white px-3 py-2 text-sm text-ink focus:border-navy focus:outline-none focus:ring-1 focus:ring-navy']) }}>
    @error($name)
        <p class="mt-1 text-sm text-brand">{{ $message }}</p>
    @enderror
</div>
