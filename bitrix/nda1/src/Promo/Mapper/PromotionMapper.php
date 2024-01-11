<?php

namespace App\Promo\Mapper\Promotions;

use App\Promo\DTO\Promotions\Promotion;
use App\Promo\Repositories\Promotions\PromotionRepository;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ORM\Objectify\Collection;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\SystemException;

class PromotionMapper
{
    public static function getFromObject(EntityObject $item): Promotion
    {
        $promotion = [];
        foreach (PromotionRepository::$defaultSelect as $fieldName) {
            try {
                $value = $item->get($fieldName);
            } catch (ArgumentException|SystemException  $exception) {
                $value = null;
            }
            if ($value instanceof Collection) {
                $promotion[$fieldName] = $value->getValueList();
            } elseif ($value instanceof EntityObject) {
                if ($fieldName === "IBLOCK_SECTION") {
                    $promotion[$fieldName] = PromotionCategoryMapper::getFromObject($value);
                } else {
                    $promotion[$fieldName] = $value->getValue();
                }
            } else {
                $promotion[$fieldName] = $value;
            }
        }
        return new Promotion($promotion);
    }
}
