<?php

namespace App\Promo\Repositories\Promotions;

use App\Promo\DTO\Promotions\Promotion;

interface PromotionsInterface
{
    public function getMainPromotion(): ?Promotion;

    public function getPromotionsEndingSoon(): ?array;

    public function getPromotionsPopular(): ?array;

    public function getOtherPromotions(): ?array;

    public function getPromotionsByCategory(int $categoryId, int $curPage, int $limit = 6): ?array;
}
