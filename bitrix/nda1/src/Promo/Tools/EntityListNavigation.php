<?php

namespace App\Promo\Tools;

use Bitrix\Main\UI\PageNavigation;

class EntityListNavigation
{
    protected const DEFAULT_LIMIT = 999;
    protected const DEFAULT_PAGE  = 1;
    protected PageNavigation $pageNavigation;

    public function __construct(string $name = "navigation")
    {
        $this->initNavigation($name);
    }

    public function getNavigation(): array
    {
        return [
            "pages"        => $this->pageNavigation->getPageCount(),
            "pages_offset" => $this->pageNavigation->getOffset(),
            "pages_size"   => $this->pageNavigation->getPageSize(),
            "current_page" => $this->pageNavigation->getCurrentPage(),
        ];
    }

    public function setLimit(int $limit): EntityListNavigation
    {
        $this->pageNavigation->setPageSize($limit);
        return $this;
    }

    public function setTotalCount(int $totalCount): EntityListNavigation
    {
        $this->pageNavigation->setRecordCount($totalCount);
        if ($this->pageNavigation->getCurrentPage() > $this->pageNavigation->getPageCount()) {
            $this->pageNavigation->setCurrentPage(self::DEFAULT_PAGE);
        }
        return $this;
    }

    public function setCurPage(int $curPage): EntityListNavigation
    {
        $this->pageNavigation->setCurrentPage($curPage);
        return $this;
    }

    public function getLimit(): int
    {
        return (int)$this->pageNavigation->getLimit();
    }

    public function getOffset(): int
    {
        return (int)$this->pageNavigation->getOffset();
    }

    protected function initNavigation(string $name): void
    {
        $this->pageNavigation = (new PageNavigation($name))
            ->setPageSize(self::DEFAULT_LIMIT)
            ->setCurrentPage(self::DEFAULT_PAGE);
    }
}
