<?php

namespace App\Shared\Application\Dto;

class ArrayDto implements DtoInterface
{
    public array $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }
}
