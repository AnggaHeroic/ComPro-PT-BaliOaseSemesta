@props(['eyebrow' => null, 'title', 'invert' => false])
<div {{ $attributes->class(['max-w-2xl']) }}>
    @if ($eyebrow)
        <p class="text-sm font-bold uppercase tracking-widest {{ $invert ? 'text-brand-bright' : 'text-brand' }}">{{ $eyebrow }}</p>
    @endif
    <h2 class="mt-2 text-3xl font-extrabold leading-tight sm:text-4xl {{ $invert ? 'text-white' : 'text-navy' }}">{{ $title }}</h2>
    @if (trim($slot))
        <p class="mt-4 text-base leading-relaxed {{ $invert ? 'text-white/75' : 'text-muted' }}">{{ $slot }}</p>
    @endif
</div>
