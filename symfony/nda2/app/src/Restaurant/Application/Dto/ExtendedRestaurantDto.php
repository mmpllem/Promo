<?php

namespace App\Restaurant\Application\Dto;

use App\Kitchen\Application\Dto\KitchenDto;
use App\Settlement\Application\Dto\SettlementDto;
use App\Shared\Application\Dto\DtoInterface;

class ExtendedRestaurantDto implements DtoInterface
{
    public int               $id;
    public string            $code;
    public string            $name;
    public RestaurantTypeDto $type;
    public SettlementDto     $settlement;
    public ?string           $description;
    public ?string           $check;
    public ?string           $checkInfo;
    public KitchenDto        $kitchen;
    public ?array            $phone;
    public ?array            $email;
    public ?array            $address;
    public ?array            $tags;
    public ?string           $site;
    public string            $image;
    public ?array            $gallery;
    public ?string           $seoTitle;
    public ?string           $seoDescription;
    public ?string           $seoKeywords;
    public ?string           $detailLink;

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

    public function getType(): RestaurantTypeDto
    {
        return $this->type;
    }

    public function getSettlement(): SettlementDto
    {
        return $this->settlement;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCheck(): ?string
    {
        return $this->check;
    }

    public function getCheckInfo(): ?string
    {
        return $this->checkInfo;
    }

    public function getKitchen(): KitchenDto
    {
        return $this->kitchen;
    }

    public function getPhone(): ?array
    {
        return $this->phone;
    }

    public function getEmail(): ?array
    {
        return $this->email;
    }

    public function getAddress(): ?array
    {
        return $this->address;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getGallery(): ?array
    {
        return $this->gallery;
    }

    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function getSeoKeywords(): ?string
    {
        return $this->seoKeywords;
    }

    public function getDetailLink(): ?string
    {
        return $this->detailLink;
    }
}
