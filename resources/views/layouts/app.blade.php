<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>@hasSection('title')@yield('title') — @endif Admin {{ config('app.name') }}</title>

    <x-ui.favicon />
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Layout panel admin (CMS). Konten halaman lewat @section('content'). --}}
<body class="min-h-screen bg-surface">
    <header class="border-b-2 border-brand bg-navy text-white">
        <div class="container-site flex h-16 items-center justify-between gap-4">
            <div class="flex items-center gap-8">
                <a href="{{ route('admin.galleries.index') }}" class="flex items-center gap-3 font-display text-sm font-extrabold uppercase tracking-wide">
                    <x-ui.application-logo size="size-8" class="rounded-full bg-white p-0.5" />
                    Admin
                </a>
                <nav aria-label="Navigasi admin" class="flex gap-5 text-sm font-semibold">
                    <a href="{{ route('admin.galleries.index') }}"
                       @class(['transition-colors hover:text-white', 'text-white' => request()->routeIs('admin.galleries.*'), 'text-white/70' => ! request()->routeIs('admin.galleries.*')])>Galeri</a>
                </nav>
            </div>

            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('home') }}" class="text-white/70 transition-colors hover:text-white">Lihat situs</a>
                <span class="hidden text-white/70 sm:inline">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="font-semibold text-brand-bright transition-colors hover:text-white">Keluar</button>
                </form>
            </div>
        </div>
    </header>

    <main class="container-site space-y-6 py-8">
        <x-ui.flash-message />

        @yield('content')
    </main>
</body>
</html>
