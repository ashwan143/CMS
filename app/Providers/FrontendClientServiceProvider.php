<?php

namespace App\Providers;

use App\Models\Client;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendClientServiceProvider extends ServiceProvider
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

            $clients = Client::query()
                ->where('status', true)
                ->orderBy('order')
                ->get();

            $view->with('clients', $clients);
        });
    }
}
