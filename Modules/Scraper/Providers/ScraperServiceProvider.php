<?php

namespace Modules\Scraper\Providers;

use Illuminate\Support\ServiceProvider;

class ScraperServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->registerViews();
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

    public function registerViews()
    {
        $this->loadViewsFrom(resource_path('views/modules/scaper'), 'scraper');
    }

    public function providers()
    {
        
    }

    public function eventProviders()
    {
        $this->app->register("Modules\Scraper\Providers\EventProviders\ScraperEventServiceProvider");
    }
}
