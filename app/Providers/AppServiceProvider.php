<?php

namespace App\Providers;

use App\Models\SiteSetting;
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
        // $settings dipake di beberapa partial (footer, kontak, tentang) yang
        // di-include dari banyak halaman berbeda (landing, /artikel, /produk, dst).
        // Daripada tiap halaman manual fetch sendiri-sendiri (gampang kelupaan,
        // kayak yang kejadian di halaman Artikel & Produk kemarin), $settings
        // di-suntik otomatis tiap salah satu view ini dirender, dari manapun
        // dia dipanggil.
        View::composer(
            ['sections.footer', 'sections.kontak', 'sections.tentang'],
            fn ($view) => $view->with('settings', SiteSetting::current())
        );
    }
}
