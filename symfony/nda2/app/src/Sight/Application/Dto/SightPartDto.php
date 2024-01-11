<?php

namespace App\Sight\Application\Dto;

class SightPartDto
{
    public int    $id;
    public string $name;
    public string $description;
    public string $image;

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
