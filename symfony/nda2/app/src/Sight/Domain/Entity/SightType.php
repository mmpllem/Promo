<?php

namespace App\Sight\Domain\Entity;

class SightType
{
    protected int    $id;
    protected string $name;
    protected string $code;

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
}
