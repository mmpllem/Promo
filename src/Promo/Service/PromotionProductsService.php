<?php


use App\Promo\Collection\ProductsCollection;
use App\Promo\Repositories\ElasticSearchRepository;
use App\Promo\Repositories\Promotions\PromotionRepository;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\ORM\Query\Result;

class PromotionProductsService
{
    protected const PAGE_SIZE = 16;

    protected ElasticSearchRepository $repository;
    protected array                   $promotionProductIds = [];
    protected int                     $promotionId;
    protected string                  $sortField;
    protected string                  $sortType;
    protected int                     $curPage;
    protected string                  $filteredCategory;

    public function getData(): array
    {
        $this->initRepository();
        $this->initPromotionProductsIds();

        if (isset($this->curPage)) {
            $this->repository->setPage($this->curPage);
        }
        if (isset($this->sortType, $this->sortField)) {
            $this->repository->setSort($this->sortField, $this->sortType);
        }
        if (isset($this->filteredCategory)) {
            $this->repository->setFilterField("iblock_id", $this->filteredCategory);
        }
        $this->repository->setFilterField("product_id", $this->promotionProductIds);
        $this->repository->setPageSize(self::PAGE_SIZE);

        /**
         * @var $collection ProductsCollection
         */
        [$collection, $navigation] = $this->repository->getList();
        $sortVariants     = $this->getSortVariants();
        $categoryVariants = $this->getCategoryVariants();

        return [
            "items"      => $collection,
            "navigation" => $navigation,
            "sort"       => $sortVariants,
            "categories" => $categoryVariants,
        ];
    }

    public function setPromotionId(int $id): PromotionProductsService
    {
        $this->promotionId = $id;
        return $this;
    }

    public function setPage(int $page): PromotionProductsService
    {
        $this->curPage = $page;
        return $this;
    }

    public function setSortField(string $field): PromotionProductsService
    {
        $this->sortField = $field;
        return $this;
    }

    public function setSortType(string $type): PromotionProductsService
    {
        $this->sortType = $type;
        return $this;
    }


    public function setCategoryFilter(string $category): PromotionProductsService
    {
        $this->filteredCategory = $category;
        return $this;
    }

    protected function initRepository(): void
    {
        $this->repository = new ElasticSearchRepository();
    }

    protected function initPromotionProductsIds(): void
    {
        $this->promotionProductIds = (new PromotionRepository())->getPromotionProducts($this->promotionId);
    }

    protected function getSortVariants(): array
    {
        return [
            [
                "field" => "sort",
                "type"  => "asc",
                "name"  => "По популярности",
            ],
            [
                "field" => "sort",
                "type"  => "desc",
                "name"  => "По популярности",
            ],
            [
                "field" => "price",
                "type"  => "asc",
                "name"  => "По цене",
            ],
            [
                "field" => "price",
                "type"  => "desc",
                "name"  => "По цене",
            ],
            [
                "field" => "discount",
                "type"  => "asc",
                "name"  => "По скидке",

            ],
            [
                "field" => "discount",
                "type"  => "desc",
                "name"  => "По скидке",
            ],
            //TODO По новизне
        ];
    }

    protected function getCategoryVariants(): array
    {
        $categories = [];
        $result     = ElementTable::getList([
                "filter" => ["=ID" => $this->promotionProductIds],
                "select" => ["ID", "NAME", "IBLOCK.ID", "IBLOCK.NAME"],
                "cache"  => [
                    "ttl"         => \App\Promo\Services\Promotions\TTL,
                    "cache_joins" => true,
                ],
            ]
        );
        if ($result instanceof Result && $result->getSelectedRowsCount()) {
            while ($iblock = $result->fetchObject()) {
                $iblock                        = $iblock->get("IBLOCK");
                $iblockId                      = $iblock->getId();
                $categories[$iblockId]["id"]   = $iblock->getId();
                $categories[$iblockId]["name"] = $iblock->getName();
                $categories[$iblockId]["count"]++;
            }
        }
        return array_values($categories);
    }
}
