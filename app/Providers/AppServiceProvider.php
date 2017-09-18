<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\BuildMenuService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(BuildMenuService $menuService)
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
