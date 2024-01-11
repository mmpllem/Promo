<?php

namespace App\Sight\Domain\Repository;

use App\Shared\Application\Dto\AddingResultDto;
use App\Sight\Application\Dto\SightBookingRequestDto;

interface SightBookingRepositoryInterface
{
    public function add(string $sightId, SightBookingRequestDto $bookingRequestDto): AddingResultDto;
}
