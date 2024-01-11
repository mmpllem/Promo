<?php

namespace App\Shared\Application\Collection;

use Ramsey\Collection\AbstractCollection as RamseyCollection;

abstract class AbstractCollection extends RamseyCollection
{
    abstract public function getDtoType(): string;
}
