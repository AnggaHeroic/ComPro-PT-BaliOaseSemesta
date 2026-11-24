<?php

namespace App\Services;

/**
 * Aktivitas usaha dan kategorinya. Data masih dibaca dari config('company'); bentuk datanya meniru
 * skema tabel (kategori -> aktivitas) agar mudah dipindah ke database.
 */
class ActivityService
{
    // Jumlah bidang ditulis dengan huruf hingga sepuluh, selebihnya angka.
    private const NUMBER_WORDS = [1 => 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh'];

    public function categoriesEnabled(): bool
    {
        return (bool) config('company.activity_categories_enabled');
    }

    /** Daftar kategori; kosong bila pengategorian dimatikan. */
    public function categories(): array
    {
        return $this->categoriesEnabled() ? config('company.activity_categories') : [];
    }

    public function findCategory(string $slug): ?array
    {
        return collect($this->categories())->firstWhere('slug', $slug);
    }

    /** Aktivitas untuk karusel beranda: judul, slug, ikon, dan foto. */
    public function cards(): array
    {
        return collect(range(1, $this->total()))->map(fn (int $n) => $this->card($n))->all();
    }

    /** Data halaman daftar Layanan & Jasa, dengan filter kategori opsional. */
    public function listing(?array $category): array
    {
        $numbers = $category ? $category['items'] : range(1, $this->total());

        $categories = collect($this->categories())
            ->map(fn (array $item) => $item + ['count' => count($item['items'])])
            ->all();

        return [
            'sidebar' => $this->categoriesEnabled(),
            'categories' => $categories,
            'active' => $category,
            'items' => collect($numbers)->map(fn (int $n) => $this->card($n))->all(),
            // Seluruh aktivitas untuk bilah indeks di hero, tidak terpengaruh filter kategori.
            'all_items' => $this->cards(),
            'total' => $this->total(),
            'total_label' => self::NUMBER_WORDS[$this->total()] ?? $this->total(),
        ];
    }

    /** Data halaman detail satu aktivitas; null bila slug tidak dikenal. */
    public function detail(string $slug): ?array
    {
        $company = config('company');

        $index = array_search($slug, $company['activity_slugs'], true);
        if ($index === false) {
            return null;
        }

        $number = $index + 1;
        $category = collect($this->categories())->first(fn (array $item) => in_array($number, $item['items'], true));

        // Seluruh aktivitas (daftar samping dan navigasi sebelumnya/berikutnya) dalam urutan tampil.
        $all = collect($company['activities'])->map(fn (string $title, int $i) => [
            'title' => $title,
            'slug' => $company['activity_slugs'][$i],
            'current' => $i === $index,
        ])->all();

        return [
            'title' => $company['activities'][$index],
            'description' => $company['activity_descriptions'][$index],
            'image' => $company['activity_images'][$index],
            'icon' => $company['activity_icons'][$index],
            'number' => $number,
            'category' => $category,
            // Tautan "kembali": ke kategori aktivitas ini bila pengategorian aktif, selain itu ke daftar lengkap.
            'back_url' => ($category ? route('activities.category', $category['slug']) : route('activities')).'#daftar-aktivitas',
            'all' => $all,
            'previous' => $all[$index - 1] ?? null,
            'next' => $all[$index + 1] ?? null,
            'gallery' => $this->gallery($slug),
            'gallery_per_page' => config('images.gallery_per_page'),
        ];
    }

    private function total(): int
    {
        return count(config('company.activities'));
    }

    private function card(int $number): array
    {
        $company = config('company');

        return [
            'title' => $company['activities'][$number - 1],
            'slug' => $company['activity_slugs'][$number - 1],
            'image' => $company['activity_images'][$number - 1],
            'icon' => $company['activity_icons'][$number - 1],
        ];
    }

    /** Galeri dokumentasi (placeholder Picsum), dipotong sesuai batas per aktivitas. */
    private function gallery(string $slug): array
    {
        return collect(config('company.activity_gallery')[$slug] ?? [])
            ->take(config('images.gallery_max_per_activity'))
            ->map(fn (int $id) => "https://picsum.photos/id/{$id}/1200/800")
            ->values()
            ->all();
    }
}
