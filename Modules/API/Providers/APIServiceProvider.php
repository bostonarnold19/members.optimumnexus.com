<?php

namespace Modules\API\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class APIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->eventProviders();

        Passport::routes();
    }

    public function register()
    {
        $this->providers();
        $this->eventProviders();
    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }

    public function eventProviders()
    {
        $this->app->register("Modules\API\Providers\EventProviders\ApiEventServiceProvider");
    }

    public function providers()
    {
    }

}
