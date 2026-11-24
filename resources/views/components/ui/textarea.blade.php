{{-- Props: name (wajib), label, value (isi awal), rows (default 4). Atribut lain diteruskan ke textarea. --}}
@props(['name', 'label' => null, 'value' => null, 'rows' => 4])
<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-navy">{{ $label }}</label>
    @endif
    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}"
              {{ $attributes->merge(['class' => 'mt-1 block w-full border border-navy/20 bg-white px-3 py-2 text-sm text-ink focus:border-navy focus:outline-none focus:ring-1 focus:ring-navy']) }}>{{ $value }}</textarea>
    @error($name)
        <p class="mt-1 text-sm text-brand">{{ $message }}</p>
    @enderror
</div>
