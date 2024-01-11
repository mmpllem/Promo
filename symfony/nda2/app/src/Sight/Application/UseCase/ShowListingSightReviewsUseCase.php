<?php

namespace App\Sight\Application\UseCase;

use App\Shared\Application\Dto\ArrayDto;
use App\Sight\Application\Dto\ExtendedSightDto;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;
use App\Sight\Domain\Service\SightReviewService;

class ShowListingSightReviewsUseCase implements UseCaseInterface
{
    private string $sightId;

    public function __construct(
        private readonly SightReviewService $service,
        private readonly UseCaseResult      $result,
    )
    {
    }

    public function setSightId(string $sightId): static
    {
        $this->sightId = $sightId;
        return $this;
    }

    public function execute(): UseCaseResult
    {
        $collection = $this->service->getAllBySightId($this->sightId);
        if ($collection) {
            foreach ($collection as &$sightReview) {
                $sightReview = (new TypedReflectionHydrator())->hydrate($sightReview, ExtendedSightDto::class);
            }
        }
        unset($sightReview);

        $this->result->setResult(new ArrayDto($collection));
        return $this->result;
    }
}
