<?php

namespace App\Shared\Application\Dto;

class ListingDto implements DtoInterface
{
    public array $list;
    public array $pagination;
    public array $filterVariants;

    public function __construct(array $data)
    {
        $this->list           = (array)$data["list"];
        $this->pagination     = (array)$data["pagination"];
        $this->filterVariants = (array)$data["filterVariants"];
    }
}
