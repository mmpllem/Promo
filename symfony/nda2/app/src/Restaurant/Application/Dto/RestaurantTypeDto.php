<?php

namespace App\Restaurant\Application\Dto;

use App\Shared\Application\Dto\DtoInterface;

class RestaurantTypeDto implements DtoInterface
{
    public int    $id;
    public string $code;
    public string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
