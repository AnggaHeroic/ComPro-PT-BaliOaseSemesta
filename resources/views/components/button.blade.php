@props(['href', 'variant' => 'primary'])
@php
    $styles = [
        'primary' => 'bg-brand text-white hover:bg-brand-dark',
        'light' => 'bg-white text-navy hover:bg-navy-tint',
        'outline-light' => 'border border-white/40 text-white hover:bg-white/10',
        'outline' => 'border border-navy/30 text-navy hover:bg-navy-tint',
    ][$variant];
@endphp
<a href="{{ $href }}" {{ $attributes->class(['inline-flex min-h-11 items-center justify-center gap-2 rounded-sm px-6 py-3 text-sm font-semibold transition-colors', $styles]) }}>
    {{ $slot }}
</a>
