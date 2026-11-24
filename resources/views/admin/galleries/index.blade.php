@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
    <x-admin.page-header title="Galeri">
        <x-ui.button :href="route('admin.galleries.create')">Tambah Galeri</x-ui.button>
    </x-admin.page-header>

    <x-admin.table :headers="['Gambar', 'Judul', 'Deskripsi', 'Aksi']">
        @forelse ($galleries as $gallery)
            <tr>
                <td class="px-4 py-3"><img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="size-16 border border-navy/10 object-cover"></td>
                <td class="px-4 py-3 font-semibold text-navy">{{ $gallery->title }}</td>
                <td class="max-w-md px-4 py-3 text-muted">{{ \Illuminate\Support\Str::limit($gallery->description, 80) }}</td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="text-sm font-semibold text-navy hover:text-brand">Ubah</a>
                        <x-ui.confirm-delete :action="route('admin.galleries.destroy', $gallery)" message="Galeri &quot;{{ $gallery->title }}&quot; akan dihapus beserta gambarnya. Lanjutkan?" />
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-10 text-center text-muted">Belum ada galeri.</td>
            </tr>
        @endforelse
    </x-admin.table>

    {{ $galleries->links() }}
@endsection
