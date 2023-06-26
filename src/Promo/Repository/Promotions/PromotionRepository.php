<?php

namespace App\Promo\Repositories\Promotions;

use App\Promo\DTO\Promotions\Promotion;
use App\Promo\Mapper\Promotions\PromotionMapper;
use Bitrix\Iblock\Iblock;
use Bitrix\Main\ORM\Query\Result;
use CIBlockElement;

class PromotionRepository implements PromotionInterface
{
    public static array $defaultSelect = [
        "ID",
        "NAME",
        "PREVIEW_TEXT",
        "PREVIEW_PICTURE",
        "ACTIVE_TO",
        "ACTIVE",
        "DETAIL_TEXT",
        "IBLOCK_SECTION",
        "SHOW_COUNTER",
    ];
    protected array     $defaultFilter = [
        "=ACTIVE"              => true,
        "=IBLOCK_SECTION.CODE" => BX_PROMO_IBCODE,
    ];

    protected string $dataManager;

    public function getById(int $id): ?Promotion
    {
        $this->initDataManager();
        $item = $this->dataManager::getList([
            "select" => self::$defaultSelect,
            "filter" => ["=ID" => $id, "=ACTIVE" => true],
            "limit"  => 1,
        ]);
        if ($item instanceof Result && $item->getSelectedRowsCount()) {
            $promotion = $item->fetchObject();
            return PromotionMapper::getFromObject($promotion);
        }
        return null;
    }

    public function getPromotionProducts(int $promotionId): array
    {
        $this->initDataManager();
        $productsIds = [];
        $item        = $this->dataManager::getList([
            "select" => [
                "ITEMS.VALUE",
                "SECTIONS.ID",
                "SECTIONS.NAME",
                "SECTIONS.CODE",
            ],
            "filter" => [
                "=ID" => $promotionId,
            ],
        ]);
        if ($item instanceof Result && $item->getSelectedRowsCount()) {
            $promotion = $item->fetchObject();
            if ($productsCollection = $promotion->get("ITEMS")) {
                $productsIds = $productsCollection->getValueList();
            }
        }
        return $productsIds;
    }

    public function incShowCounter(int $id): bool
    {
        CIBlockElement::CounterInc($id);
        return in_array($id, $_SESSION["IBLOCK_COUNTER"], true);
    }

    protected function initDataManager(): void
    {
        $this->dataManager = Iblock::wakeUp(PROMO_IBLOCK_ID)->getEntityDataClass();
    }
}
