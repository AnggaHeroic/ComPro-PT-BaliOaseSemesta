@extends('layouts.app')

@section('title', 'Tambah Galeri')

@section('content')
    <x-admin.page-header title="Tambah Galeri" />

    <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data" class="max-w-2xl space-y-5 border border-navy/10 bg-white p-6">
        @include('admin.galleries._form')
    </form>
@endsection
