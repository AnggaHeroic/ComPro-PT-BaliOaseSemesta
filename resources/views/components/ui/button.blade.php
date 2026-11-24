{{-- Props: href (opsional; bila ada tampil sebagai tautan), type (button|submit, default button), variant (primary|secondary|danger|light|outline|outline-light) --}}
@props(['href' => null, 'type' => 'button', 'variant' => 'primary'])
@php
    $styles = [
        'primary' => 'bg-brand text-white hover:bg-brand-dark',
        'secondary' => 'border border-navy/20 bg-white text-navy hover:bg-navy-tint',
        'danger' => 'bg-brand-dark text-white hover:bg-red-900',
        'light' => 'bg-white text-navy hover:bg-navy-tint',
        'outline-light' => 'border border-white/40 text-white hover:bg-white/10',
        'outline' => 'border border-navy/30 text-navy hover:bg-navy-tint',
    ][$variant];
    $class = 'inline-flex min-h-11 items-center justify-center gap-2 rounded-sm px-6 py-3 text-sm font-semibold transition-colors';
@endphp
@if ($href)
    <a href="{{ $href }}" {{ $attributes->class([$class, $styles]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->class([$class, $styles]) }}>{{ $slot }}</button>
@endif
