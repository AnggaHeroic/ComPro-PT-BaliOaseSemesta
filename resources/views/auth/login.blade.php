@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
    <h1 class="font-display text-xl font-extrabold text-navy">Masuk ke Admin</h1>

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
        @csrf
        <x-ui.input name="email" type="email" label="Email" :value="old('email')" required autofocus autocomplete="username" />
        <x-ui.input name="password" type="password" label="Kata sandi" required autocomplete="current-password" />

        <label class="flex items-center gap-2 text-sm text-muted">
            <input type="checkbox" name="remember" class="border-navy/30 text-brand focus:ring-brand">
            Ingat saya
        </label>

        <x-ui.button type="submit" class="w-full">Masuk</x-ui.button>
    </form>
@endsection
