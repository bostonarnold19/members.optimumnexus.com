<?php

namespace Modules\Scraper\Repositories;

use Modules\Core\Repositories\AbstractEloquentRepository;
use Modules\Scraper\Interfaces\ScraperRepositoryInterface;

class ScraperRepository extends AbstractEloquentRepository implements ScraperRepositoryInterface
{
    public function RouteConfig()
    {
        return json_encode([
            'update' => route('om.update', '@id'),
            'store' => route('om.store'),
            'destroy' => route('om.destroy', '@id'),
            'index' => route('om.index'),
            'scrape' => route('scraper.scrape'),
            'store_event' => route('scraper.store.event'),
            'get_event' => route('scraper.get.event', '@id'),
        ]);
    }
}
