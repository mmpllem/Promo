<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Elasticsearch\Mapping;

use DEV\ElasticSearch\Configuration;

readonly class Mapping implements Configuration
{
    public function __construct(
        private string $index,
        private array $mapping,
        private array $settings = [],
    ) {
    }

    public function getIndexName(): string
    {
        return $this->index;
    }

    public function getMapping(): array
    {
        return $this->mapping;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }
}
