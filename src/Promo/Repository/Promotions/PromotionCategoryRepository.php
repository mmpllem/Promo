<?php

namespace App\Promo\Repositories\Promotions;

use App\Promo\DTO\Promotions\PromotionCategory;
use App\Promo\Mapper\Promotions\PromotionCategoryMapper;
use Bitrix\Iblock\SectionTable;
use Bitrix\Main\ORM\Query\Result;

class PromotionCategoryRepository implements PromotionCategoryInterface
{
    public static array $defaultSelect = [
        "ID",
        "NAME",
        "DESCRIPTION",
        "CODE",
        "PICTURE",
    ];

    public function getIdByCode(string $code): int
    {
        $filter = [
            "CODE"       => $code,
            "=IBLOCK_ID" => PROMO_IBLOCK_ID,
        ];
        return (int)SectionTable::getRow(["filter" => $filter])["ID"];
    }

    public function getCategories(): ?array
    {
        $result = null;
        $query  = [
            "select" => self::$defaultSelect,
            "filter" => [
                "=IBLOCK_ID"         => PROMO_IBLOCK_ID,
                "=IBLOCK_SECTION_ID" => $this->getIdByCode(BX_PROMO_IBCODE),
                "=ACTIVE"            => "Y",
            ],
            "order"  => [
                "SORT" => "DESC",
            ],
            "limit"  => 99,
        ];
        $list   = SectionTable::getList($query);
        if ($list instanceof Result && $list->getSelectedRowsCount()) {
            while ($category = $list->fetchObject()) {
                $result[] = PromotionCategoryMapper::getFromObject($category);
            }
        }
        return $result;
    }

    public function getCategoryByCode(string $code): ?PromotionCategory
    {
        $promotion = null;
        $query     = [
            "select" => self::$defaultSelect,
            "filter" => [
                "=IBLOCK_ID"         => PROMO_IBLOCK_ID,
                "=IBLOCK_SECTION_ID" => $this->getIdByCode(BX_PROMO_IBCODE),
                "=CODE"              => $code,
                "=ACTIVE"            => "Y",
            ],
            "limit"  => 1,
        ];
        $result    = SectionTable::getList($query);
        if ($result instanceof Result && $result->getSelectedRowsCount()) {
            while ($category = $result->fetchObject()) {
                $promotion = PromotionCategoryMapper::getFromObject($category);
            }
        }
        return $promotion;
    }
}
