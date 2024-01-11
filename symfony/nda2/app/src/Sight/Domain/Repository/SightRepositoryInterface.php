<?php

namespace App\Sight\Domain\Repository;

use App\Sight\Domain\Entity\Sight;

interface SightRepositoryInterface
{
    public function findByCode(string $code): ?Sight;

    public function find(int $page = 1, int $limit = 99, array $filter = []): array;

    public function findRandom(): ?Sight;
}
