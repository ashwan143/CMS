<?php

namespace App\Providers;

use App\Models\Testimonial;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendTestimonialServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('frontend.home', function ($view) {
            $testimonials = Testimonial::query()
                ->where('status', true)
                ->where('is_featured', true)
                ->orderBy('display_order')
                ->orderByDesc('published_at')
                ->get();

            $view->with('testimonials', $testimonials);
        });
    }
}
