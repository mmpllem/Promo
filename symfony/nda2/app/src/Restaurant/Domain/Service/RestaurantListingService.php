<?php

namespace App\Restaurant\Domain\Service;

use App\Restaurant\Domain\Repository\RestaurantRepositoryInterface;

readonly class RestaurantListingService
{
    public function __construct(
        private RestaurantRepositoryInterface $repository
    )
    {
    }

    public function find(int $page, int $limit, array $filter): ?array
    {
        return $this->repository->find($page, $limit, $filter);
    }

}
