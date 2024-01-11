<?php

namespace App\Shared\Application\UseCase;

interface UseCaseInterface
{
    public function execute(): UseCaseResult;
}
