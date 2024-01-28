<?php

namespace App\Providers;

use App\Http\Middleware\LogRequestsMiddleware;
use Illuminate\Support\ServiceProvider;

class LogRequestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddleware();
    }
    protected function registerMiddleware()
    {
        $this->app['router']->pushMiddlewareToGroup('api', LogRequestsMiddleware::class);
    }
}
