<?php

namespace App\Sight\Domain\Repository;

use App\Shared\Application\Dto\AddingResultDto;
use App\Shared\Application\Dto\ReviewDto;

interface SightReviewRepositoryInterface
{
    public function findAllBySightId(string $sightId): ?array;

    public function add(string $sightId, ReviewDto $reviewDto): AddingResultDto;
}
