<?php

namespace Modules\Api\Providers\EventProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ApiEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Modules\API\Events\SomeEvent' => [
            'Modules\API\Listeners\EventListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
