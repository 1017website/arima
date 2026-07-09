<?php

namespace App\Providers;

use App\Models\Information;
use Illuminate\Support\Facades\Schema;
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
        try {
            $siteInformation = Schema::hasTable('information') ? Information::first() : null;
        } catch (\Throwable $e) {
            $siteInformation = null;
        }

        View::share('siteInformation', $siteInformation);
    }
}
