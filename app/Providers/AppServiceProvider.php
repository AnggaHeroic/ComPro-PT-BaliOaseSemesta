<?php

namespace App\Providers;

use App\Services\CompanyService;
use App\Services\NavigationService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Data bersama untuk layout dan halaman publik, dibaca lewat Service (bukan config langsung di view).
        View::composer(['layouts.public', 'web.*'], function ($view): void {
            $route = request()->route();

            $view->with([
                'company' => app(CompanyService::class)->profile(),
                'menu' => app(NavigationService::class)->menu($route?->getName(), $route?->parameter('category')),
            ]);
        });
    }
}
