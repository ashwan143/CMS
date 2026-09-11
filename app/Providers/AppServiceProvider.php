<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }



    public function boot(): void
{
    Schema::defaultStringLength(191);
    Blade::if('permission', function (string $permission) {
        return auth()->check()
            && auth()->user()->hasPermission($permission);
    });
}
}
