<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Elasticsearch\Factory;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class ClientFactory
{
    private static Client $instance;

    public static function create(): Client
    {
        if (isset(self::$instance) === false) {
            self::$instance = ClientBuilder::create()
                ->setHosts(explode(',', $_ENV['ELASTIC_URL']))
                ->build();
        }

        return self::$instance;
    }
}
