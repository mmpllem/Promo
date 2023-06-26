<?php

namespace App\Promo\Repositories\Promotions;

use App\Promo\DTO\Promotions\PromotionCategory;

interface PromotionCategoryInterface
{
    public function getIdByCode(string $code): int;

    public function getCategoryByCode(string $code): ?PromotionCategory;
}
