<?php

namespace App\Sight\Infrastructure\ElasticSearch\Client;

use DEV\ElasticSearch\Configuration;

class SightConfiguration implements \DEV\ElasticSearch\Configuration
{
    public function getIndexName(): string
    {
        return "sight";
    }

    public function getMapping(): array
    {
        return include __DIR__ . '/mappings.php';
    }

    public function getSettings(): array
    {
        return include __DIR__ . '/settings.php';
    }

}
