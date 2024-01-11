<?php

namespace App\Sight\Presentation\Controller;

use App\Sight\Application\UseCase\ShowListingSightReviewsUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SightReviewListingController extends AbstractController
{
    public function __construct(
        private readonly ShowListingSightReviewsUseCase $useCase,
    )
    {
    }

    #[Route(
        "/sights/{sightId}/reviews",
        name: "sight_reviews_listing",
        requirements: [
            "sightId" => "^[-a-zA-Z]+$",
        ],
        methods: "GET"
    )]
    public function showReviewListing(string $sightId): SuccessResponse
    {
        $result = $this->useCase
            ->setSightId($sightId)
            ->execute();

        return new SuccessResponse($result->getResult());
    }
}
