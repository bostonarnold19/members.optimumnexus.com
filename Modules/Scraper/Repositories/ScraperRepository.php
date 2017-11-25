<?php

namespace Modules\Scraper\Repositories;

use Modules\Core\Repositories\AbstractEloquentRepository;
use Modules\Scraper\Interfaces\ScraperRepositoryInterface;

class ScraperRepository extends AbstractEloquentRepository implements ScraperRepositoryInterface
{
    public function RouteConfig()
    {
        return json_encode([
            'update' => route('scraper.update', '@id'),
            'store' => route('scraper.store'),
            'destroy' => route('scraper.destroy', '@id'),
            'index' => route('scraper.index'),
            'scrape' => route('scraper.scrape'),
            'store_event' => route('scraper.store.event')
        ]);
    }
}
