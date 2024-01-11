<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Elasticsearch\Index;

use App\Shared\Infrastructure\Elasticsearch\Mapping\Mapping;
use App\Shared\Infrastructure\Elasticsearch\Mapping\MappingCollection;
use Elastic\Elasticsearch\Client;

readonly class Indexes
{
    public function __construct(
        private Client $client,
        private MappingCollection $mappingCollection,
    ) {
    }

    public function check(): array
    {
        $checker = new Check($this->client, $this->mappingCollection);
        return $checker->exist();
    }

    public function create(Mapping $mapping): void
    {
        $creator = new Create($this->client);
        $creator->execute($mapping);
    }
}
