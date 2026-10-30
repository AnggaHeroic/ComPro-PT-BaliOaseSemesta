<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_public_pages_render_with_company_data(): void
    {
        foreach (['/', '/tentang-kami', '/bidang-usaha', '/kontak'] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee('PT. BALI OASE SEMESTA')
                ->assertSee('mailto:balioasesemesta24@gmail.com', false)
                ->assertSee('tel:+6285100426891', false);
        }
    }

    public function test_activities_page_lists_all_seven_activities(): void
    {
        $response = $this->get('/bidang-usaha');

        foreach (config('company.activities') as $activity) {
            $response->assertSee($activity);
        }
        $this->assertCount(7, config('company.activities'));
    }

    public function test_activity_groups_cover_every_activity_exactly_once(): void
    {
        $numbers = collect(config('company.activity_groups'))->pluck('items')->flatten()->sort()->values()->all();

        $this->assertSame(range(1, count(config('company.activities'))), $numbers);
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
