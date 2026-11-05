<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_public_pages_render_with_company_data(): void
    {
        foreach (['/', '/tentang-kami', '/layanan-jasa', '/kontak'] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee('PT. BALI OASE SEMESTA')
                ->assertSee('mailto:balioasesemesta24@gmail.com', false)
                ->assertSee('tel:+6285100426891', false);
        }
    }

    public function test_activities_page_lists_all_seven_activities(): void
    {
        $response = $this->get('/layanan-jasa');

        foreach (config('company.activities') as $activity) {
            $response->assertSee($activity);
        }
        $this->assertCount(7, config('company.activities'));
    }

    public function test_activity_categories_cover_every_activity_exactly_once(): void
    {
        $numbers = collect(config('company.activity_categories'))->pluck('items')->flatten()->sort()->values()->all();

        $this->assertSame(range(1, count(config('company.activities'))), $numbers);
    }

    public function test_category_page_shows_only_its_own_activities(): void
    {
        $category = config('company.activity_categories')[0];

        $response = $this->get(route('activities.category', $category['slug']))->assertOk()->assertSee($category['name']);

        foreach (config('company.activities') as $i => $activity) {
            in_array($i + 1, $category['items'], true)
                ? $response->assertSee($activity)
                : $response->assertDontSee($activity);
        }
    }

    public function test_unknown_category_returns_404(): void
    {
        $this->get('/layanan-jasa/tidak-ada')->assertNotFound();
    }

    public function test_sidebar_lists_every_category_when_enabled(): void
    {
        $response = $this->get('/layanan-jasa')->assertOk()->assertSee('Kategori Usaha');

        foreach (config('company.activity_categories') as $category) {
            $response->assertSee($category['name']);
        }
    }

    public function test_sidebar_is_hidden_and_all_cards_shown_when_categories_are_disabled(): void
    {
        config(['company.activity_categories_enabled' => false]);

        $response = $this->get('/layanan-jasa')->assertOk()->assertDontSee('Kategori Usaha');

        foreach (config('company.activities') as $activity) {
            $response->assertSee($activity);
        }

        $this->get(route('activities.category', config('company.activity_categories')[0]['slug']))
            ->assertRedirect(route('activities'));
    }

    public function test_every_activity_has_a_unique_slug(): void
    {
        $slugs = config('company.activity_slugs');

        $this->assertCount(count(config('company.activities')), $slugs);
        $this->assertSame($slugs, array_values(array_unique($slugs)));
    }

    public function test_every_activity_detail_page_renders_its_own_content(): void
    {
        foreach (config('company.activities') as $i => $title) {
            $this->get(route('activities.show', config('company.activity_slugs')[$i]))
                ->assertOk()
                ->assertSee($title)
                ->assertSee(config('company.activity_descriptions')[$i]);
        }
    }

    public function test_activity_list_links_to_each_detail_page(): void
    {
        $response = $this->get('/layanan-jasa')->assertOk();

        foreach (config('company.activity_slugs') as $slug) {
            $response->assertSee(route('activities.show', $slug), false);
        }
    }

    public function test_activity_detail_shows_its_category_and_survives_disabled_categories(): void
    {
        $category = config('company.activity_categories')[0];
        $slug = config('company.activity_slugs')[$category['items'][0] - 1];

        $categoryUrl = route('activities.category', $category['slug']);

        $this->get(route('activities.show', $slug))->assertOk()->assertSee($categoryUrl, false);

        config(['company.activity_categories_enabled' => false]);

        $this->get(route('activities.show', $slug))->assertOk()->assertDontSee($categoryUrl, false);
    }

    public function test_every_activity_has_a_gallery_within_the_limit(): void
    {
        $max = config('images.gallery_max_per_activity');

        foreach (config('company.activity_slugs') as $slug) {
            $count = count(config("company.activity_gallery.{$slug}", []));

            $this->assertGreaterThan(0, $count, "Galeri {$slug} kosong");
            $this->assertLessThanOrEqual($max, $count);
        }
    }

    public function test_detail_page_shows_gallery_and_lightbox_before_the_cta(): void
    {
        $slug = config('company.activity_slugs')[0];
        $ids = config("company.activity_gallery.{$slug}");

        $html = $this->get(route('activities.show', $slug))->assertOk()
            ->assertSee('Dokumentasi')
            ->assertSee('documentationLightbox', false)
            ->assertSee("https://picsum.photos/id/{$ids[0]}/1200/800", false)
            ->getContent();

        $this->assertLessThan(strpos($html, 'Butuh informasi lebih lanjut'), strpos($html, 'judul-dokumentasi'));
    }

    public function test_gallery_is_truncated_to_the_per_activity_limit_and_paged(): void
    {
        $slug = config('company.activity_slugs')[0];
        config([
            'images.gallery_max_per_activity' => 3,
            'images.gallery_per_page' => 2,
        ]);

        $html = $this->get(route('activities.show', $slug))->assertOk()->getContent();

        $this->assertSame(3, substr_count($html, 'aria-label="Lihat dokumentasi '));
        $this->assertStringContainsString('pages: 2', $html);
    }

    public function test_detail_page_hides_the_gallery_when_there_are_no_photos(): void
    {
        $slug = config('company.activity_slugs')[0];
        config(["company.activity_gallery.{$slug}" => []]);

        $this->get(route('activities.show', $slug))->assertOk()->assertDontSee('judul-dokumentasi', false);
    }

    public function test_unknown_activity_returns_404(): void
    {
        $this->get('/layanan-jasa/aktivitas/tidak-ada')->assertNotFound();
    }

    public function test_every_activity_has_an_icon(): void
    {
        $this->assertCount(count(config('company.activities')), config('company.activity_icons'));

        $this->get('/')->assertOk()->assertSee('data-carousel-item', false);
    }

    public function test_navigation_links_to_every_page(): void
    {
        $this->get('/')
            ->assertSee(route('about'), false)
            ->assertSee(route('activities'), false)
            ->assertSee(route('contact'), false);
    }
}
