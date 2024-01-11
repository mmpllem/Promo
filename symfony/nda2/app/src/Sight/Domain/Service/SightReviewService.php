<?php

namespace App\Sight\Domain\Service;

use App\Shared\Application\Dto\AddingResultDto;
use App\Shared\Application\Dto\ReviewDto;
use App\Sight\Infrastructure\ElasticSearch\Repository\SightReviewRepository;

readonly class SightReviewService
{
    public function __construct(
        private SightReviewRepository $repository
    )
    {
    }

    public function getAllBySightId(string $sightId): array
    {
        return $this->repository->findAllBySightId($sightId);
    }

    public function add(string $sightId, ReviewDto $reviewDto): AddingResultDto
    {
        return $this->repository->add($sightId, $reviewDto);
    }

}
