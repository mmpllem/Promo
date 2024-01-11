<?php

namespace App\Restaurant\Application\Dto;

use App\Shared\Application\Dto\DtoInterface;

class PreviewRestaurantDto implements DtoInterface
{
    public int               $id;
    public string            $name;
    public string            $code;
    public RestaurantTypeDto $type;
    public ?string           $check;
    public string            $image;
    public string            $detailLink;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getType(): RestaurantTypeDto
    {
        return $this->type;
    }

    public function getCheck(): ?string
    {
        return $this->check;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getDetailLink(): string
    {
        return $this->detailLink;
    }
}
