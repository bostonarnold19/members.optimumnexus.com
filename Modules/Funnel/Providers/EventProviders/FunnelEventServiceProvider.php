<?php

namespace Modules\Funnel\Providers\EventProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class FunnelEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Modules\Funnel\Events\SomeEvent' => [
            'Modules\Funnel\Listeners\EventListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
