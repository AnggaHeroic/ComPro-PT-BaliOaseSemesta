{{-- Props: action (URL DELETE, wajib), message (teks konfirmasi). Slot: label tombol pemicu (default "Hapus"). --}}
@props(['action', 'message' => 'Data yang dihapus tidak bisa dikembalikan. Lanjutkan?'])
<span x-data>
    <button type="button" @click="$dispatch('open-modal', @js('confirm-delete-'.md5($action)))"
            class="text-sm font-semibold text-brand hover:text-brand-dark">{{ $slot->isEmpty() ? 'Hapus' : $slot }}</button>

    <x-ui.modal :name="'confirm-delete-'.md5($action)" title="Konfirmasi hapus">
        <p>{{ $message }}</p>
        <form method="POST" action="{{ $action }}" class="mt-6 flex justify-end gap-3">
            @csrf
            @method('DELETE')
            <x-ui.button variant="secondary" @click="$dispatch('close-modal', @js('confirm-delete-'.md5($action)))">Batal</x-ui.button>
            <x-ui.button type="submit" variant="danger">Hapus</x-ui.button>
        </form>
    </x-ui.modal>
</span>
