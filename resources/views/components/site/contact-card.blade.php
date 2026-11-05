@props(['icon', 'title', 'value', 'href' => null])
@if ($href)
    <a href="{{ $href }}" {{ $attributes->class('group flex gap-4 border border-navy/10 bg-white p-5 transition duration-200 hover:border-brand/40 hover:shadow-lg hover:shadow-navy/5') }}>
        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-navy-tint text-navy transition-colors group-hover:bg-brand group-hover:text-white">
            <x-icon :name="$icon" class="size-5" />
        </span>
        <span class="min-w-0">
            <span class="block text-sm font-semibold text-muted">{{ $title }}</span>
            <span class="mt-1 block break-words text-base font-semibold leading-snug text-navy">{{ $value }}</span>
        </span>
    </a>
@else
    <div {{ $attributes->class('flex gap-4 border border-navy/10 bg-white p-5') }}>
        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-navy-tint text-navy">
            <x-icon :name="$icon" class="size-5" />
        </span>
        <div class="min-w-0">
            <p class="text-sm font-semibold text-muted">{{ $title }}</p>
            <p class="mt-1 break-words text-base font-semibold leading-snug text-navy">{{ $value }}</p>
        </div>
    </div>
@endif
