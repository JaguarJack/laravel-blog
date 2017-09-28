<?php

namespace App\Socialite;

use Laravel\Socialite\SocialiteManager;
use App\Socialite\QqProvider;
use App\Socialite\SinaProvider;

class SocialManager extends SocialiteManager
{    
    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createQqDriver()
    {
        $config = $this->app['config']['services.qq'];
        
        return $this->buildProvider(
            QqProvider::class, $config
        );
    }
    
    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createSinaDriver()
    {
        $config = $this->app['config']['services.sina'];
        
        return $this->buildProvider(
            SinaProvider::class, $config
        );
    }
}
