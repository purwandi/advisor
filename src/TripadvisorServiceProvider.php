<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TripadvisorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tripadvisor', function ($app) {
            return new Tripadvisor(env('TRIPADVISOR_KEY'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['tripadvisor'];
    }
}
