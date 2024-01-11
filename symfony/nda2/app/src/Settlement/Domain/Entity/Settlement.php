<?php

namespace App\Settlement\Domain\Entity;

class Settlement
{
    protected int    $id;
    protected string $name;
    protected string $code;
    protected string $coordinates;

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
