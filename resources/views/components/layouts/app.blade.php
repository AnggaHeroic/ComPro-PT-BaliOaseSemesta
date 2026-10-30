@props(['title' => null, 'description' => null, 'transparentNav' => false])
@php
    $company = config('company');
    $pageTitle = $title ? $title.' — '.$company['name'] : $company['name'];
    $metaDescription = $description ?? $company['name'].', '.$company['city'].'. Profil perusahaan, bidang usaha, dan informasi kontak.';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="theme-color" content="#0a1650">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col">
    <a href="#konten" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-lg focus:bg-navy focus:px-4 focus:py-2 focus:text-white">Lewati ke konten</a>
    <x-navbar :transparent="$transparentNav" />
    <main id="konten" class="flex-1">
        {{ $slot }}
    </main>
    <x-footer />
</body>
</html>
