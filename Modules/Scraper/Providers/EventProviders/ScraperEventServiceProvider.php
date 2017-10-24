<?php

namespace Modules\Scraper\Providers\EventProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ScraperEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Modules\Scraper\Events\SomeEvent' => [
            'Modules\Scraper\Listeners\EventListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
