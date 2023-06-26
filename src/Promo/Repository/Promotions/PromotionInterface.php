<?php

namespace App\Promo\Repositories\Promotions;

use App\Promo\DTO\Promotions\Promotion;

interface PromotionInterface
{
    public function getById(int $id): ?Promotion;

    public function incShowCounter(int $id): bool;
}
