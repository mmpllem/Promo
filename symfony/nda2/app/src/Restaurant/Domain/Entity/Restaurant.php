<?php

namespace App\Restaurant\Domain\Entity;

use App\Kitchen\Domain\Entity\Kitchen;
use App\Settlement\Domain\Entity\Settlement;

class Restaurant
{
    protected int            $id;
    protected string         $code;
    protected string         $name;
    protected RestaurantType $type;
    protected Settlement     $settlement;
    protected ?string        $description;
    protected ?string        $check;
    protected ?string        $checkInfo;
    protected Kitchen        $kitchen;
    protected ?array         $phone;
    protected ?array         $email;
    protected ?array         $address;
    protected ?array         $tags;
    protected ?string        $site;
    protected string         $image;
    protected ?array         $gallery;
    protected ?string        $seoTitle;
    protected ?string        $seoDescription;
    protected ?string        $seoKeywords;
    protected ?string        $detailLink;

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

    public function getType(): RestaurantType
    {
        return $this->type;
    }

    public function getSettlement(): Settlement
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

    public function getKitchen(): Kitchen
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
