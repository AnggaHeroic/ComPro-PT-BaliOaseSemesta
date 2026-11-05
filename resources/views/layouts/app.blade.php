@php
    $company = config('company');
    $pageTitle = View::hasSection('title') ? $__env->yieldContent('title').' — '.$company['name'] : $company['name'];
    $metaDescription = View::hasSection('description')
        ? $__env->yieldContent('description')
        : $company['name'].', '.$company['city'].'. Profil perusahaan, bidang usaha, dan informasi kontak.';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Primary Metadata (nilai @section sudah ter-escape, maka dicetak apa adanya) --}}
    <title>{!! $pageTitle !!}</title>
    <meta name="description" content="{!! $metaDescription !!}">
    <meta property="og:title" content="{!! $pageTitle !!}">
    <meta property="og:description" content="{!! $metaDescription !!}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta name="theme-color" content="#0a1650">

    {{-- Favicon --}}
    <x-favicon />

    {{-- Assets --}}
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col">
    <a href="#konten" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-lg focus:bg-navy focus:px-4 focus:py-2 focus:text-white">Lewati ke konten</a>

    {{-- Global Navigation --}}
    @include('components.site.navbar')

    {{-- Page Content --}}
    <main id="konten" class="flex-1">
        @yield('content')
    </main>

    {{-- Global Footer --}}
    @include('components.site.footer')
</body>
</html>
