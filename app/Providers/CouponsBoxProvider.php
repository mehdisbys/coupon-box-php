<?php

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

class CouponsBoxProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() != 'testing') {
            $this->app->bind(
                ClientInterface::class,
                Client::class
            );
        }
    }
}
