<?php

namespace App\Services;

/**
 * Menyusun menu navigasi situs publik (navbar desktop, menu mobile, footer) berikut penanda halaman aktif.
 */
class NavigationService
{
    // Ikon per menu pada navigasi mobile.
    private const ICONS = ['home' => 'home', 'about' => 'building', 'activities' => 'layers', 'contact' => 'mail'];

    public function __construct(private ActivityService $activityService) {}

    /**
     * Item menu utama; item "activities" membawa submenu kategori (kosong bila pengategorian mati).
     *
     * @return array<int, array<string, mixed>>
     */
    public function menu(?string $routeName, ?string $categorySlug): array
    {
        $submenu = $this->activitiesSubmenu($routeName, $categorySlug);

        $items = [];
        foreach (config('company.nav') as $route => $label) {
            $items[] = [
                'label' => $label,
                'href' => route($route),
                'icon' => self::ICONS[$route] ?? 'arrow-right',
                // Sub-route (mis. activities.show) tetap menandai induknya sebagai aktif.
                'active' => $routeName === $route || str_starts_with((string) $routeName, $route.'.'),
                'submenu' => $route === 'activities' ? $submenu : [],
            ];
        }

        return $items;
    }

    private function activitiesSubmenu(?string $routeName, ?string $categorySlug): array
    {
        $categories = $this->activityService->categories();

        if ($categories === []) {
            return [];
        }

        $submenu = [['label' => 'Semua Aktivitas Usaha', 'href' => route('activities'), 'active' => $routeName === 'activities']];

        foreach ($categories as $category) {
            $submenu[] = [
                'label' => $category['name'],
                'href' => route('activities.category', $category['slug']),
                'active' => $categorySlug === $category['slug'],
            ];
        }

        return $submenu;
    }
}
