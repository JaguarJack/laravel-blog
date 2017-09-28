<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\BuildMenuService;
use Auth;

class AssignVarToLayoutServiceProvider extends ServiceProvider
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
            $view->with([
                'menus' => $menu,
                'user'  => Auth::guard('home')->user(),
                
            ]);
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
