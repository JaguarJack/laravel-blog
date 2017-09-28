<?php

namespace App\Providers;

use Laravel\Socialite\SocialiteServiceProvider;
use Laravel\Socialite\Contracts\Factory;
use App\Socialite\SocialManager;

class SocialServiceProvider extends SocialiteServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    
    /**
     * 
     * {@inheritDoc}
     * @see \Laravel\Socialite\SocialiteServiceProvider::register()
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new SocialManager($app);
        });
    }
}
