<?php

namespace App\Sight\Application\UseCase;

use App\Sight\Application\Dto\ExtendedSightDto;
use App\Sight\Application\Validator\SightValidator;
use App\Sight\Domain\Service\SightExtendedService;
use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;

class ShowExtendedSightUseCase implements UseCaseInterface
{
    private string $sightCode;

    public function __construct(
        private readonly SightValidator       $validator,
        private readonly SightExtendedService $service,
        private UseCaseResult                 $result,
    )
    {
    }

    public function setSightCode(string $code): static
    {
        $this->sightCode = $code;
        return $this;
    }

    public function execute(): UseCaseResult
    {
        $this->validator
            ->setValidationObject(["sightCode" => $this->sightCode])
            ->validate();

        $result = (new TypedReflectionHydrator())->hydrate(
            $this->service->getByCode($this->sightCode),
            ExtendedSightDto::class
        );
        if (!$result) {
            throw new NotFoundException();
        }

        $this->result->setResult($result);
        return $this->result;
    }
}
