<?php

namespace Modules\Category\Providers\EventProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CategoryEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Modules\Category\Events\SomeEvent' => [
            'Modules\Category\Listeners\EventListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
