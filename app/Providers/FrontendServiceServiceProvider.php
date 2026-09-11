<?php

namespace App\Providers;

use App\Models\Service;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.home', function ($view) {

            $services = Service::query()
                ->where('status', true)
                ->orderBy('display_order')
                ->get();

            $view->with('services', $services);
        });
    }
}
