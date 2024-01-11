<?php

namespace App\Sight\Domain\Service;

use App\Shared\Application\Dto\AddingResultDto;
use App\Sight\Application\Dto\SightBookingRequestDto;
use App\Sight\Infrastructure\ElasticSearch\Repository\SightBookingRepository;

readonly class SightBookingService
{
    public function __construct(
        private SightBookingRepository $repository
    )
    {
    }

    public function add(string $sightId, SightBookingRequestDto $bookingRequestDto): AddingResultDto
    {
        return $this->repository->add($sightId, $bookingRequestDto);
    }
}
