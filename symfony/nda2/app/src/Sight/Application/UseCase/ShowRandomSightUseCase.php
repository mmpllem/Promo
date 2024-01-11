<?php

namespace App\Sight\Application\UseCase;

use App\Sight\Application\Dto\ExtendedSightDto;
use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;
use App\Sight\Domain\Service\SightRandomService;

class ShowRandomSightUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly SightRandomService $service,
        private readonly UseCaseResult      $result,
    )
    {
    }

    public function execute(): UseCaseResult
    {
        $result = (new TypedReflectionHydrator())->hydrate(
            $this->service->get(),
            ExtendedSightDto::class
        );
        if (!$result) {
            throw new NotFoundException();
        }

        $this->result->setResult($result);
        return $this->result;
    }
}
