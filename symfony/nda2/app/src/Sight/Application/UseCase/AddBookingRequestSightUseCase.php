<?php

namespace App\Sight\Application\UseCase;

use App\Sight\Application\Dto\SightBookingRequestDto;
use App\Sight\Application\Validator\SightBookingRequestValidator;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Sight\Domain\Service\SightBookingService;
use App\Sight\Domain\Service\SightReviewService;

class AddBookingRequestSightUseCase implements UseCaseInterface
{
    private string $sightId;

    private SightBookingRequestDto $sightBookingRequestDto;

    public function __construct(
        private readonly SightBookingRequestValidator $validator,
        private readonly SightBookingService          $service,
        private readonly UseCaseResult                $result,
    )
    {
    }

    public function setSightId(string $id): static
    {
        $this->sightId = $id;
        return $this;
    }

    public function setBookingRequest(SightBookingRequestDto $bookingRequestDto): static
    {
        $this->sightBookingRequestDto = $bookingRequestDto;
        return $this;
    }

    public function execute(): UseCaseResult
    {
        $this->validator
            ->setValidationObject((array)$this->sightBookingRequestDto)
            ->validate();
        $result = $this->service->add($this->sightId, $this->sightBookingRequestDto);
        $this->result->setResult($result);
        return $this->result;
    }
}
