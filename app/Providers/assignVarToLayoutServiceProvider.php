<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\BuildMenuService;

class assignVarToLayoutServiceProvider extends ServiceProvider
{
    /**
     * 延迟绑定
     * @var string
     */
    protected $defer = false;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(BuildMenuService $menuService)
    {
        view()->composer('layouts/main', function ($view) use ($menuService) {
            $menu = $menuService->sortMenu();
            $view->with('menus', $menu);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
