<?php

namespace App\Sight\Domain\Entity;

class SightPart
{
    protected int    $id;
    protected string $name;
    protected string $description;
    protected string $image;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
