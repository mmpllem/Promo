<?php

namespace App\Promo\Repositories\Promotions;

use App\Promo\DTO\Promotions\Promotion;
use App\Promo\Mapper\Promotions\PromotionMapper;
use App\Promo\Tools\EntityListHelper;
use Bitrix\Iblock\Iblock;
use Bitrix\Main\ORM\Query\Result;
use Bitrix\Main\Type\DateTime;

class PromotionsRepository implements PromotionsInterface
{
    protected const PROMO_SECTION_CODE = "promo";

    protected array $defaultSelect = [
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
    protected array $defaultFilter = [];

    protected string $dataManager;

    public function getMainPromotion(): ?Promotion
    {
        $this->init();
        $promotion = null;
        $query     = [
            "select" => $this->defaultSelect,
            "filter" => $this->getFilter(["=ACTIVE" => "Y", "=MAINPAGE_SHOW.ITEM.VALUE" => "Y"]), //todo узнать что за свойство
            "order"  => ["ID" => "DESC"],
            "limit"  => 1,
        ];
        $list      = $this->dataManager::getList($query);
        if ($list instanceof Result && $list->getSelectedRowsCount()) {
            $promotion = PromotionMapper::getFromObject($list->fetchObject());
        }
        return $promotion;
    }

    public function getPromotionsEndingSoon(int $limit = 4): ?array
    {
        $this->init();
        $result = null;
        $list   = $this->dataManager::getList(
            [
                "select" => $this->defaultSelect,
                "filter" => $this->getFilter(["=MAINPAGE_SHOW.ITEM.VALUE" => false, ">ACTIVE_TO" => new DateTime()]),
                "order"  => [
                    "ACTIVE_TO"    => "ASC",
                    "SHOW_COUNTER" => "DESC",
                ],
                "limit"  => $limit,
            ]);
        if ($list instanceof Result && $list->getSelectedRowsCount()) {
            while ($promotion = $list->fetchObject()) {
                $result[] = PromotionMapper::getFromObject($promotion);
            }
        }
        return $result;
    }

    public function getPromotionsPopular(bool $excludedEndingSoonPromotions = true, int $limit = 5): ?array
    {
        $this->init();
        $result = null;
        $filter = ["=MAINPAGE_SHOW.ITEM.VALUE" => false];
        if ($excludedEndingSoonPromotions && $excludedEndingSoonIds = $this->getExcludedIdsPromotions(false)) {
            $filter["!ID"] = $excludedEndingSoonIds;
        }
        $query = [
            "select" => $this->defaultSelect,
            "filter" => $this->getFilter($filter),
            "order"  => [
                "SHOW_COUNTER" => "DESC",
            ],
            "limit"  => $limit,

        ];
        $list  = $this->dataManager::getList($query);
        if ($list instanceof Result && $list->getSelectedRowsCount()) {
            while ($promotion = $list->fetchObject()) {
                $result[] = PromotionMapper::getFromObject($promotion);
            }
        }
        return $result;
    }

    public function getOtherPromotions(int $curPage = 1, int $limit = 5): array
    {
        $this->init();
        $promotions  = [];
        $excludedIds = $this->getExcludedIdsPromotions();
        $manager     = (new EntityListHelper($this->dataManager))
            ->setSelect($this->defaultSelect)
            ->setFilter(array_merge($this->defaultFilter, ["!ID" => $excludedIds]))
            ->setOrder(["SHOW_COUNTER" => "DESC"])
            ->setLimit($limit)
            ->setCurPage($curPage);

        foreach ($manager->getData() as $promotion) {
            $promotions[] = PromotionMapper::getFromObject($promotion);
        }
        $navigation = $manager->getNavigation();
        return ["items" => $promotions, "navigation" => $navigation];
    }

    public function getPromotionsByCategory(int $categoryId, int $curPage, int $limit = 6): ?array
    {
        $this->init();
        $promotions = [];
        $manager    = (new EntityListHelper($this->dataManager))
            ->setSelect($this->defaultSelect)
            ->setFilter(array_merge($this->defaultFilter, ["=IBLOCK_SECTION_ID" => $categoryId]))
            ->setOrder(["SHOW_COUNTER" => "DESC"])
            ->setLimit($limit)
            ->setCurPage($curPage);

        foreach ($manager->getData() as $promotion) {
            $promotions[] = PromotionMapper::getFromObject($promotion);
        }
        if (empty($promotions)) {
            return null;
        }
        $navigation = $manager->getNavigation();
        return ["items" => $promotions, "navigation" => $navigation];
    }

    protected function getExcludedIdsPromotions(bool $excludedAll = true): array
    {
        $ids = $this->getExcludedEndingSoonIds();
        if ($excludedAll) {
            $ids = array_merge($ids, $this->getExcludedPopularIds());
        }
        return $ids;
    }

    protected function getExcludedEndingSoonIds()
    {
        $ids   = [];
        $query = [
            "select" => ["ID"],
            "filter" => array_merge(
                $this->defaultFilter,
                [
                    "=MAINPAGE_SHOW.ITEM.VALUE" => false,
                    ">ACTIVE_TO"                => new DateTime(),
                ]
            ),
            "order"  => [
                "ACTIVE_TO"    => "ASC",
                "SHOW_COUNTER" => "DESC",
            ],
            "limit"  => 4,
        ];
        $list  = $this->dataManager::getList($query);
        if ($list instanceof Result && $list->getSelectedRowsCount()) {
            $ids = $list->fetchCollection()->getIdList();
        }
        return $ids;
    }

    protected function getExcludedPopularIds(array $endingSoonIds = [])
    {
        $ids  = [];
        $list = $this->dataManager::getList([
            "select" => ["ID"],
            "filter" => array_merge(
                $this->defaultFilter,
                ["!ID" => $endingSoonIds]
            ),
            "order"  => [
                "SHOW_COUNTER" => "DESC",
            ],
            "limit"  => 5,
        ]);
        if ($list instanceof Result && $list->getSelectedRowsCount()) {
            $ids = $list->fetchCollection()->getIdList();
        }
        return $ids;
    }

    protected function getFilter(array $filter = []): array
    {
        return array_merge($this->defaultFilter, $filter);
    }

    protected function init(): void
    {
        $this->initDataManager();
        $this->initDefaultFilter();
    }

    protected function initDataManager(): void
    {
        $this->dataManager = Iblock::wakeUp(PROMO_IBLOCK_ID)->getEntityDataClass();
    }

    protected function initDefaultFilter(): void
    {
        $sectionId           = (new PromotionCategoryRepository())->getIdByCode(BX_PROMO_IBCODE);
        $this->defaultFilter = [
            "=ACTIVE"                           => true,
            "=IBLOCK_SECTION.IBLOCK_SECTION_ID" => $sectionId,
        ];
    }
}
