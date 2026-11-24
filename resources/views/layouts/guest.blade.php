<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('title', 'Masuk') — {{ config('app.name') }}</title>

    <x-ui.favicon />
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Layout halaman tamu (login). Konten halaman lewat @section('content'). --}}
<body class="flex min-h-screen flex-col items-center justify-center bg-surface px-4 py-10">
    <a href="{{ route('home') }}" class="mb-6 flex flex-col items-center gap-3">
        <x-ui.application-logo size="size-16" />
        <span class="font-display text-sm font-extrabold uppercase tracking-wide text-navy">{{ config('app.name') }}</span>
    </a>

    <div class="w-full max-w-md border-t-4 border-brand bg-white p-6 shadow-sm">
        <x-ui.flash-message />

        @yield('content')
    </div>
</body>
</html>
