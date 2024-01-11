<?php

namespace App\Sight\Domain\Service;

use App\Sight\Domain\Entity\Sight;
use App\Sight\Domain\Repository\SightRepositoryInterface;

readonly class SightExtendedService
{
    public function __construct(
        private SightRepositoryInterface $repository
    )
    {
    }

    public function getByCode(string $code): ?Sight
    {
        return $this->repository->findByCode($code);
    }
}
