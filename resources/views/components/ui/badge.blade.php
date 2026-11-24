{{-- Props: variant (neutral|success|danger, default neutral). Slot: teks label. --}}
@props(['variant' => 'neutral'])
@php
    $styles = [
        'neutral' => 'bg-navy-tint text-navy',
        'success' => 'bg-green-100 text-green-800',
        'danger' => 'bg-red-100 text-brand-dark',
    ][$variant];
@endphp
<span {{ $attributes->class(['inline-flex items-center px-2 py-0.5 text-xs font-semibold', $styles]) }}>{{ $slot }}</span>
