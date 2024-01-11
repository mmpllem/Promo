<?php

namespace App\Promo\Repositories;

use App\ElasticSearch\Catalog\ListingRequestManager;
use App\ElasticSearch\Search\RequestParser\JsonParser;
use App\ElasticSearch\Service\CatalogProductService;
use App\Promo\Collection\ProductsCollection;
use App\Promo\Tools\EntityListNavigation;

class ElasticSearchRepository
{
    protected ListingRequestManager $requestManager;
    protected array                 $filter   = [];
    protected int                   $page     = 1;
    protected int                   $pageSize = 10;
    protected int                   $totalCount;
    protected string                $sortField;
    protected string                $sortMethod;

    public function __construct()
    {
        $this->initRequestManager();
    }

    public function getList(): array
    {
        $this->initQueryParser();
        return [$this->getProducts(), $this->getNavigation()];
    }

    /**
     * @param string $key
     * @param array|string $value
     * @return $this
     */
    public function setFilterField(string $key, $value): ElasticSearchRepository
    {
        $this->filter[$key] = $value;
        return $this;
    }

    public function setPage(int $page): ElasticSearchRepository
    {
        $this->page = $page;
        return $this;
    }

    public function setPageSize(int $pageSize): ElasticSearchRepository
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function setSort(string $field, string $method): ElasticSearchRepository
    {
        $this->sortField  = $field;
        $this->sortMethod = $method;
        return $this;
    }

    protected function initQueryParser(): void
    {
        $this->requestManager->setParser($this->getJsonParser());
    }

    protected function initRequestManager(): void
    {
        $this->requestManager = new ListingRequestManager();
    }

    protected function getProducts(): ProductsCollection
    {
        $collection      = new ProductsCollection();
        $catalogProducts = (new CatalogProductService())
            ->setElasticProducts($this->requestManager->search())
            ->get()
            ->getAll();
        foreach ($catalogProducts as $catalogProduct) {
            $collection->append($catalogProduct);
        }
        return $collection;
    }

    protected function getJsonParser(): JsonParser
    {
        $query = [
            "filter"    => $this->filter,
            "page"      => $this->page,
            "page_size" => $this->pageSize,
        ];
        if (isset($this->sortField, $this->sortMethod)) {
            $query["sort"]   = $this->sortField;
            $query["method"] = $this->sortMethod;
        }
        return new JsonParser(json_encode($query));
    }

    protected function getNavigation(): array
    {
        return (new EntityListNavigation())
            ->setLimit($this->pageSize)
            ->setCurPage($this->page)
            ->setTotalCount($this->requestManager->getTotalDocumentsCount())
            ->getNavigation();
    }
}
