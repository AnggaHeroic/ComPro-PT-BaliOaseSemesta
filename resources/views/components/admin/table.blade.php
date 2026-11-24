{{-- Props: headers (array label kolom, wajib). Slot: baris <tr> pada tbody. --}}
@props(['headers'])
<div class="overflow-x-auto border border-navy/10 bg-white">
    <table class="min-w-full divide-y divide-navy/10 text-left text-sm">
        <thead class="bg-navy-tint text-xs font-bold uppercase tracking-wider text-navy">
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="px-4 py-3">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-navy/10 text-ink">{{ $slot }}</tbody>
    </table>
</div>
