<?php

namespace App\Sight\Domain\Service;

use App\Sight\Domain\Entity\Sight;
use App\Sight\Domain\Repository\SightRepositoryInterface;

readonly class SightRandomService
{
    public function __construct(
        private SightRepositoryInterface $repository
    )
    {
    }

    public function get(): ?Sight
    {
        return $this->repository->findRandom();
    }
}
