<?php

namespace App\Sight\Domain\Service;

use App\Sight\Domain\Repository\SightRepositoryInterface;

readonly class SightListingService
{
    public function __construct(
        private SightRepositoryInterface $repository
    )
    {
    }

    public function find(int $page, int $limit, array $filter): ?array
    {
        return $this->repository->find($page, $limit, $filter);
    }

    public function findByCoordinates(int $page, int $limit, ?string $coordinates): ?array
    {
        $filter["coordinates"] = $coordinates?:(new UserService())->get()->getCoordinates();
        return $this->repository->find($page, $limit, $filter);
    }

}
