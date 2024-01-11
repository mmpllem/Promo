<?php

namespace App\Promo\Mapper\Promotions;

use App\Promo\DTO\Promotions\PromotionCategory;
use App\Promo\Repositories\Promotions\PromotionCategoryRepository;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\SystemException;

class PromotionCategoryMapper
{
    public static function getFromObject(EntityObject $item): PromotionCategory
    {
        $category = [];
        foreach (PromotionCategoryRepository::$defaultSelect as $fieldName) {
            try {
                $value = $item->get($fieldName);
            } catch (ArgumentException|SystemException  $exception) {
                $value = null;
            }
            $category[$fieldName] = $value;
        }
        return new PromotionCategory($category);
    }
}
