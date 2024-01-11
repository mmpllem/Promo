<?php

namespace App\Settlement\Domain\Repository;

use App\Settlement\Domain\Entity\Settlement;

interface SettlementRepositoryInterface
{
    public function findById(int $id): ?Settlement;

    public function find(int $page = 1, int $limit = 99, array $filter = []): array;
}
