<?php

namespace App\Restaurant\Domain\Repository;

use App\Restaurant\Domain\Entity\Restaurant;

interface RestaurantRepositoryInterface
{
    public function findByCode(string $code): ?Restaurant;

    public function find(int $page = 1, int $limit = 99, array $filter = []): array;
}
