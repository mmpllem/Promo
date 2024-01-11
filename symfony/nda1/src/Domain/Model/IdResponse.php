<?php

namespace App\Domain\Model;

class IdResponse
{
    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}