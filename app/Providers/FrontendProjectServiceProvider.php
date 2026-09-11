<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendProjectServiceProvider extends ServiceProvider
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

            $projects = Project::query()
                ->where('status', true)
                ->orderBy('display_order')
                ->get();

            $view->with('projects', $projects);
        });
    }
}
