<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Halaman publik Layanan & Jasa. Data dibaca dari config('company') sekarang; strukturnya meniru
 * skema tabel (kategori -> aktivitas) agar kelak mudah dipindahkan ke database dan dashboard admin.
 */
class ActivityController extends Controller
{
    public function index(): View
    {
        return $this->show(null);
    }

    public function category(string $category): View|RedirectResponse
    {
        // Saat pengategorian dimatikan, semua aktivitas tampil di satu halaman.
        if (! config('company.activity_categories_enabled')) {
            return redirect()->route('activities');
        }

        $found = collect(config('company.activity_categories'))->firstWhere('slug', $category);
        abort_if($found === null, 404);

        return $this->show($found);
    }

    public function detail(string $activity): View
    {
        $company = config('company');

        $index = array_search($activity, $company['activity_slugs'], true);
        abort_if($index === false, 404);

        $number = $index + 1;
        $enabled = (bool) $company['activity_categories_enabled'];
        $category = $enabled
            ? collect($company['activity_categories'])->first(fn (array $c) => in_array($number, $c['items'], true))
            : null;

        // Seluruh aktivitas (untuk daftar samping dan navigasi sebelumnya/berikutnya) dalam urutan tampil.
        $all = collect($company['activities'])->map(fn (string $title, int $i) => [
            'title' => $title,
            'slug' => $company['activity_slugs'][$i],
            'current' => $i === $index,
        ])->all();

        // Galeri dokumentasi (placeholder), dipotong sesuai batas per aktivitas.
        $gallery = collect($company['activity_gallery'][$activity] ?? [])
            ->take(config('images.gallery_max_per_activity'))
            ->map(fn (int $id) => "https://picsum.photos/id/{$id}/1200/800")
            ->values()
            ->all();

        return view('pages.activity-detail', [
            'gallery' => $gallery,
            'title' => $company['activities'][$index],
            'description' => $company['activity_descriptions'][$index],
            'image' => $company['activity_images'][$index],
            'icon' => $company['activity_icons'][$index],
            'number' => $number,
            'category' => $category,
            'all' => $all,
            'previous' => $all[$index - 1] ?? null,
            'next' => $all[$index + 1] ?? null,
        ]);
    }

    private function show(?array $active): View
    {
        $company = config('company');
        $enabled = (bool) $company['activity_categories_enabled'];

        $numbers = $enabled && $active ? $active['items'] : range(1, count($company['activities']));

        $items = collect($numbers)->map(fn (int $n) => [
            'title' => $company['activities'][$n - 1],
            'slug' => $company['activity_slugs'][$n - 1],
            'image' => $company['activity_images'][$n - 1],
            'icon' => $company['activity_icons'][$n - 1],
        ])->all();

        $categories = $enabled
            ? collect($company['activity_categories'])->map(fn (array $category) => $category + ['count' => count($category['items'])])->all()
            : [];

        return view('pages.activities', [
            'sidebar' => $enabled,
            'categories' => $categories,
            'active' => $enabled ? $active : null,
            'items' => $items,
            'total' => count($company['activities']),
        ]);
    }
}
