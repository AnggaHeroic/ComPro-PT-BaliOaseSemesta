@php $c = config('company'); @endphp
<x-layouts.app title="Bidang Usaha" :description="'Bidang kegiatan usaha '.$c['name'].'.'">
    <x-page-hero eyebrow="Bidang Usaha" title="Aktivitas Usaha Perusahaan">
        {{ count($c['activities']) }} bidang kegiatan usaha yang dijalankan perusahaan.
    </x-page-hero>

    <section class="bg-surface py-16 sm:py-20">
        <div class="container-site">
            <ol class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($c['activities'] as $i => $activity)
                    <x-activity-card :number="$i + 1" :title="$activity" />
                @endforeach
            </ol>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="container-site flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
            <p class="text-xl font-bold text-navy">Ingin mengetahui lebih lanjut?</p>
            <x-button :href="route('contact')">
                Hubungi Kami
                <x-icon name="arrow-right" class="size-4" />
            </x-button>
        </div>
    </section>
</x-layouts.app>
