<?php

namespace App\Settlement\Domain\Service;

use App\Settlement\Domain\Entity\Settlement;
use App\Settlement\Domain\Repository\SettlementRepositoryInterface;

class SettlementService
{
    public function __construct(
        private readonly SettlementRepositoryInterface $repository
    )
    {
    }

    public function getById(int $id): ?Settlement
    {
        return $this->repository->findById($id);
    }

    public function find(int $page, int $limit, array $filter): ?array
    {
        return $this->repository->find($page, $limit, $filter);
    }

}
