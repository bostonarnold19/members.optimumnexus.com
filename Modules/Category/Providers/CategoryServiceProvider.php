<?php

namespace Modules\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;

class CategoryServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(resource_path('views/modules/category'), 'category');
    }

    public function providers()
    {
        $this->app->bind('Modules\Category\Interfaces\CategoryRepositoryInterface', function ($app) {
            return new CategoryRepository(new Category());
        });
    }

    public function eventProviders()
    {
        $this->app->register("Modules\Category\Providers\EventProviders\CategoryEventServiceProvider");
    }
}
