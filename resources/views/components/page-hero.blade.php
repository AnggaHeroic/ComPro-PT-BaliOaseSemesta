@props(['eyebrow' => null, 'title'])
<section class="relative isolate overflow-hidden bg-navy text-white">
    <div class="pattern-hatch absolute inset-y-0 right-0 -z-10 w-full opacity-60 [mask-image:linear-gradient(to_left,black,transparent_70%)]" aria-hidden="true"></div>
    <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand" aria-hidden="true"></div>
    <div class="container-site py-14 sm:py-20">
        @if ($eyebrow)
            <p class="text-sm font-bold uppercase tracking-widest text-brand-bright">{{ $eyebrow }}</p>
        @endif
        <h1 class="mt-3 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl">{{ $title }}</h1>
        @if (trim($slot))
            <p class="mt-5 max-w-2xl text-lg leading-relaxed text-white/80">{{ $slot }}</p>
        @endif
    </div>
</section>
