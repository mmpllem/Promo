<?php

namespace App\Shared\Application\UseCase;

use App\Shared\Application\Dto\DtoInterface;

class UseCaseResult
{
    private DtoInterface $result;

    public function setResult(DtoInterface $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function getResult(): DtoInterface
    {
        return $this->result;
    }
}
