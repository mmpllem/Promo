<?php

namespace App\Sight\Application\Collection;

use App\Shared\Application\Collection\AbstractCollection;
use App\Sight\Application\Dto\SightPartDto;
use App\Sight\Domain\Entity\SightPart;
use IteratorAggregate;

/**
 * @extends AbstractCollection<SightPart>
 *
 * @implements IteratorAggregate<SightPart>
 */
class SightPartCollection extends AbstractCollection
{
    public function getType(): string
    {
        return SightPart::class;
    }
    public function getDtoType(): string
    {
        return SightPartDto::class;
    }
}
