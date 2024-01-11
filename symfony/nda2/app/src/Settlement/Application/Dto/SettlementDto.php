<?php

namespace App\Settlement\Application\Dto;


class SettlementDto implements \App\Shared\Application\Dto\DtoInterface
{
    public int    $id;
    public string $name;
    public string $code;
    public string $coordinates;

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

    public function getCoordinates(): string
    {
        return $this->coordinates;
    }
}
