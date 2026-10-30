@props(['number', 'title'])
<li class="group flex min-h-44 flex-col border border-navy/20 bg-white p-6 transition-colors duration-300 hover:border-brand hover:bg-brand/5">
    <span class="text-xs font-bold text-brand">{{ str_pad($number, 2, '0', STR_PAD_LEFT) }}</span>
    <h3 class="mt-4 font-display text-lg font-semibold leading-snug tracking-tight text-navy transition-colors duration-200 group-hover:text-brand sm:text-xl">{{ $title }}</h3>
</li>
