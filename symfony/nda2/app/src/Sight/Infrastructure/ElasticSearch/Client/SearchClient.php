<?php

namespace App\Sight\Infrastructure\ElasticSearch\Client;

use App\Shared\Infrastructure\Elasticsearch\Factory\ClientFactory;
use DEV\ElasticSearch\Criteria\Query\SearchQueryHandler;
use DEV\ElasticSearch\SearchService;

class SearchClient
{
    private function __construct() { }

    protected static SearchQueryHandler $oInstance;

    public static function getInstance(): SearchQueryHandler
    {
        if (!isset(static::$oInstance)) {
            static::$oInstance = new SearchQueryHandler(
                new SearchService(
                    ClientFactory::create(),
                   new SightConfiguration(),
                )
            );
        }

        return static::$oInstance;
    }
}
