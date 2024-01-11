<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Elasticsearch\Index;

use App\Shared\Infrastructure\Elasticsearch\Mapping\Mapping;
use Elastic\Elasticsearch\Client;

class Create
{
    public function __construct(
        private Client $client,
    ) {
    }

    public function execute(Mapping $mapping): void
    {
        $body = [
            'mappings' => $mapping->getMapping(),
        ];

        if (!empty($mapping->getSettings())) {
            $body['settings'] = $mapping->getSettings();
        }

        $this->client->indices()->create([
            'index' => $mapping->getIndexName(),
            'body' => $body
        ]);
    }
}
