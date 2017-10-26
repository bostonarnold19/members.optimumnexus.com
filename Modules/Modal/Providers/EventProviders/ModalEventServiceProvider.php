<?php

namespace Modules\Modal\Providers\EventProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ModalEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Modules\Modal\Events\SomeEvent' => [
            'Modules\Modal\Listeners\EventListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
