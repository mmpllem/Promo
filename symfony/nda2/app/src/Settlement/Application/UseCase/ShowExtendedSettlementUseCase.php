<?php

namespace App\Settlement\Application\UseCase;

use App\Settlement\Application\Dto\SettlementDto;
use App\Settlement\Domain\Service\SettlementService;
use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;

class ShowExtendedSettlementUseCase implements UseCaseInterface
{
    private int $settlementId;

    public function __construct(
        private readonly SettlementService $service,
        private readonly UseCaseResult     $result,
    )
    {
    }

    public function setSettlementId(int $id): static
    {
        $this->settlementId = $id;
        return $this;
    }

    public function execute(): UseCaseResult
    {
        $result = (new TypedReflectionHydrator())->hydrate(
            $this->service->getById($this->settlementId),
            SettlementDto::class
        );
        if (!$result) {
            throw new NotFoundException();
        }

        $this->result->setResult($result);
        return $this->result;
    }
}
