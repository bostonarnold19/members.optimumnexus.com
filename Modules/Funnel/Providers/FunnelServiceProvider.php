<?php

namespace Modules\Funnel\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Funnel\Entities\Funnel;
use Modules\Funnel\Entities\Page;
use Modules\Funnel\Repositories\FunnelRepository;
use Modules\Funnel\Repositories\PageRepository;

class FunnelServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(resource_path('views/modules/funnel'), 'funnel');
        $this->loadViewsFrom(resource_path('views/modules/page'), 'page');
        $this->loadViewsFrom(resource_path('views/modules/category/bagel'), 'category_bagel');
    }

    public function providers()
    {
        $this->app->bind('Modules\Funnel\Interfaces\FunnelRepositoryInterface', function ($app) {
            return new FunnelRepository(new Funnel());
        });

        $this->app->bind('Modules\Funnel\Interfaces\PageRepositoryInterface', function ($app) {
            return new PageRepository(new Page());
        });
    }

    public function eventProviders()
    {
        $this->app->register("Modules\Funnel\Providers\EventProviders\FunnelEventServiceProvider");
    }
}
