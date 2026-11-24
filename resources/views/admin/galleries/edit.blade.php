@extends('layouts.app')

@section('title', 'Ubah Galeri')

@section('content')
    <x-admin.page-header title="Ubah Galeri" />

    <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data" class="max-w-2xl space-y-5 border border-navy/10 bg-white p-6">
        @method('PUT')
        @include('admin.galleries._form')
    </form>
@endsection
