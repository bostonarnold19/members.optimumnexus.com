<?php

namespace Modules\Modal\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Modal\Entities\UserClient;
use Modules\Modal\Repositories\UserClientRepository;

class ModalServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(resource_path('views/modules/modal'), 'modal');
    }

    public function providers()
    {
        $this->app->bind('Modules\Modal\Interfaces\UserClientRepositoryInterface', function ($app) {
            return new UserClientRepository(new UserClient());
        });
    }

    public function eventProviders()
    {
        $this->app->register("Modules\Modal\Providers\EventProviders\ModalEventServiceProvider");
    }
}
