<?php

namespace App\Providers;

use App\Models\Slider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendSliderServiceProvider extends ServiceProvider
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
            $sliders = Slider::query()
                ->where('status', true)
                ->where(function ($query) {
                    $query->whereNull('start_date')
                        ->orWhere('start_date', '<=', now());
                })
                ->where(function ($query) {
                    $query->whereNull('end_date')
                        ->orWhere('end_date', '>=', now());
                })
                ->orderBy('display_order')
                ->get();

            $view->with('sliders', $sliders);
        });
    }
}
