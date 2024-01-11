<?php

namespace App\Restaurant\Domain\Service;

use App\Restaurant\Domain\Entity\Restaurant;
use App\Restaurant\Domain\Repository\RestaurantRepositoryInterface;

readonly class RestaurantExtendedService
{
    public function __construct(
        private RestaurantRepositoryInterface $repository
    )
    {
    }

    public function getRestaurantByCode(string $code): ?Restaurant
    {
        return $this->repository->findByCode($code);
    }
}
