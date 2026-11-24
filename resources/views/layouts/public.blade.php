<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Primary Metadata (nilai @section sudah ter-escape oleh Blade, maka dicetak apa adanya lewat @yield) --}}
    <title>@hasSection('title')@yield('title') — {{ $company['name'] }}@else{{ $company['name'] }}@endif</title>
    <meta name="description" content="@yield('description', $company['default_description'])">
    <meta property="og:title" content="@hasSection('title')@yield('title') — {{ $company['name'] }}@else{{ $company['name'] }}@endif">
    <meta property="og:description" content="@yield('description', $company['default_description'])">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta name="theme-color" content="#0a1650">

    {{-- Favicon --}}
    <x-ui.favicon />

    {{-- Assets --}}
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col">
    <a href="#konten" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-lg focus:bg-navy focus:px-4 focus:py-2 focus:text-white">Lewati ke konten</a>

    {{-- Global Navigation --}}
    <x-web.navbar :company="$company" :menu="$menu" :transparent="$__env->yieldContent('nav') === 'transparent'" />

    {{-- Page Content --}}
    <main id="konten" class="flex-1">
        @yield('content')
    </main>

    {{-- Global Footer --}}
    <x-web.footer :company="$company" :menu="$menu" />
</body>
</html>
