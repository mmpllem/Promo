<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Elasticsearch\Mapping;

use Ramsey\Collection\AbstractCollection;

class MappingCollection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return Mapping::class;
    }
}
