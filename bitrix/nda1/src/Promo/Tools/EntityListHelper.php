<?php

namespace App\Promo\Tools;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\ORM\Objectify\Collection;
use Bitrix\Main\SystemException;

class EntityListHelper
{
    protected string             $dataManager;
    private EntityListNavigation $listNavigation;
    private array                $filter = [];
    private array                $select = [];
    private array                $order  = [];

    public function __construct(string $entityDataManager)
    {
        $this->dataManager    = $entityDataManager;
        $this->listNavigation = new EntityListNavigation($entityDataManager);
    }

    public function setOrder(array $order): EntityListHelper
    {
        $this->order = $order;
        return $this;
    }

    public function setSelect(array $select): EntityListHelper
    {
        $this->select = $select;
        return $this;
    }

    public function setFilter(array $filter): EntityListHelper
    {
        $this->filter = array_merge($this->filter, $filter);
        return $this;
    }

    public function setLimit(int $limit): EntityListHelper
    {
        $this->listNavigation->setLimit($limit);
        return $this;
    }

    public function setCurPage(int $page): EntityListHelper
    {
        $this->listNavigation->setCurPage($page);
        return $this;
    }

    public function getData(): ?Collection
    {
        try {
            $this->listNavigation->setTotalCount($this->dataManager::getCount($this->filter));
            $result = $this->dataManager::getList($this->getQuery())->fetchCollection();
        } catch (ArgumentException|ObjectPropertyException|SystemException $exception) {
            $result = null;
        }
        return $result;
    }

    public function getNavigation(): array
    {
        return $this->listNavigation->getNavigation();
    }

    private function getQuery(): array
    {
        return [
            "select"      => $this->select,
            "filter"      => $this->filter,
            "order"       => $this->order,
            "limit"       => $this->listNavigation->getLimit(),
            "offset"      => $this->listNavigation->getOffset(),
            "count_total" => true,
        ];
    }
}
