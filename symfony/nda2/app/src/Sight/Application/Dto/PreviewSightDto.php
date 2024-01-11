<?php

namespace App\Sight\Application\Dto;

use App\Shared\Application\Dto\DtoInterface;

class PreviewSightDto implements DtoInterface
{
    public int          $id;
    public string       $name;
    public string       $code;
    public SightTypeDto $type;
    public ?string      $check;
    public string       $image;
    public string       $detailLink;

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

    public function getType(): SightTypeDto
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
