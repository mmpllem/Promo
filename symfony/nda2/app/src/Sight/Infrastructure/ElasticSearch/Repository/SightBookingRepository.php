<?php

namespace App\Sight\Infrastructure\ElasticSearch\Repository;

use App\Shared\Application\Dto\AddingResultDto;
use App\Sight\Application\Dto\SightBookingRequestDto;
use App\Sight\Domain\Repository\SightBookingRepositoryInterface;

class SightBookingRepository implements SightBookingRepositoryInterface
{
    //todo Реализовать после подключения эластика и удалить моки

    public function add(string $sightId, SightBookingRequestDto $bookingRequestDto): AddingResultDto
    {
        $savedId = 1;
        return new AddingResultDto($savedId);
    }
}
