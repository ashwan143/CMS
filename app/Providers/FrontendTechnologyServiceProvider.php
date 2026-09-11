<?php

namespace App\Providers;

use App\Models\Technology;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendTechnologyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('frontend.home', function ($view) {

            $technologies = Technology::query()
                ->where('status', true)
                ->orderBy('order')
                ->get();

            $view->with('technologies', $technologies);
        });
    }
}
