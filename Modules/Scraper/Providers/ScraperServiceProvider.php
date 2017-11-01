<?php

namespace Modules\Scraper\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Scraper\Entities\Scraper;
use Modules\Scraper\Repositories\ScraperRepository;

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
        $this->loadViewsFrom(resource_path('views/modules/scraper'), 'scraper');
    }

    public function providers()
    {
        $this->app->bind('Modules\Scraper\Interfaces\ScraperRepositoryInterface', function ($app) {
            return new ScraperRepository(new Scraper());
        });
    }

    public function eventProviders()
    {
        $this->app->register("Modules\Scraper\Providers\EventProviders\ScraperEventServiceProvider");
    }
}
