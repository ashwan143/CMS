<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendMenuServiceProvider extends ServiceProvider
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
        View::composer('frontend.layouts.header', function ($view) {
            $menus = Menu::query()
                ->where('location', 'header')
                ->where('status', true)
                ->whereNull('parent_id')
                ->with([
                    'children' => function ($query) {
                        $query
                            ->where('status', true)
                            ->orderBy('display_order');
                    },
                    'page',
                ])
                ->orderBy('display_order')
                ->get();

            $view->with('menus', $menus);
        });
    }
}
