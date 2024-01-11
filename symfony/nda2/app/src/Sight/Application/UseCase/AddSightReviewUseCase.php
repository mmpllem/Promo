<?php

namespace App\Sight\Application\UseCase;

use App\Shared\Application\Dto\ReviewDto;
use App\Sight\Application\Validator\SightReviewValidator;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Sight\Domain\Service\SightReviewService;

class AddSightReviewUseCase implements UseCaseInterface
{
    private string $sightId;

    private ReviewDto $reviewDto;

    public function __construct(
        private readonly SightReviewValidator $validator,
        private readonly SightReviewService   $service,
        private readonly UseCaseResult        $result,
    )
    {
    }

    public function setSightId(string $id): static
    {
        $this->sightId = $id;
        return $this;
    }

    public function setReview(ReviewDto $reviewDto): static
    {
        $this->reviewDto = $reviewDto;
        return $this;
    }

    public function execute(): UseCaseResult
    {
        $this->validator
            ->setValidationObject((array)$this->reviewDto)
            ->validate();
        $result = $this->service->add($this->sightId, $this->reviewDto);
        $this->result->setResult($result);
        return $this->result;
    }
}
