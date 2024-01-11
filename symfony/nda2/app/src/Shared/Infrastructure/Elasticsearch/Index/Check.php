<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Elasticsearch\Index;

use App\Shared\Infrastructure\Elasticsearch\Mapping\Mapping;
use App\Shared\Infrastructure\Elasticsearch\Mapping\MappingCollection;
use Elastic\Elasticsearch\Client;
use Symfony\Component\HttpFoundation\Response;

class Check
{
    public function __construct(
        private Client $client,
        private MappingCollection $collection,
    ) {
    }

    public function exist(): array
    {
        $indexesExist = [];
        foreach ($this->collection as $mapping) {
            /** @var Mapping $mapping */

            $response = $this->client->indices()->exists(['index' => $mapping->getIndexName()]);
            $indexesExist[$mapping->getIndexName()] = $response->getStatusCode() === Response::HTTP_OK;
        }

        return $indexesExist;
    }
}
