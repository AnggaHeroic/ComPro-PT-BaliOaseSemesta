{{-- Props: name (wajib), label, current (URL gambar saat ini, untuk halaman edit). Pratinjau gambar lewat Alpine. --}}
@props(['name', 'label' => null, 'current' => null])
<div class="space-y-2"
     x-data="{
         preview: @js($current),
         pick(e) {
             const file = e.target.files[0];
             if (file) this.preview = URL.createObjectURL(file);
         },
     }">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-navy">{{ $label }}</label>
    @endif

    <input type="file" id="{{ $name }}" name="{{ $name }}" accept="image/*"
           @change="pick($event)"
           {{ $attributes->merge(['class' => 'block w-full text-sm text-ink file:mr-4 file:border-0 file:bg-navy file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-navy-dark']) }}>

    <img x-show="preview" x-cloak :src="preview" alt="Pratinjau gambar" class="h-32 border border-navy/10 object-cover">

    @error($name)
        <p class="text-sm text-brand">{{ $message }}</p>
    @enderror
</div>
