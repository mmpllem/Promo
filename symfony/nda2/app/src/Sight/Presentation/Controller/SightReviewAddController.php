<?php

namespace App\Sight\Presentation\Controller;

use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;
use App\Sight\Application\Dto\SightReviewDto;
use App\Sight\Application\UseCase\AddSightReviewUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SightReviewAddController extends AbstractController
{
    public function __construct(
        private readonly AddSightReviewUseCase $useCase,
        private readonly TypedReflectionHydrator  $hydrator
    )
    {
    }

    #[Route(
        "/sights/{sightId}/reviews/add",
        name: "sight_reviews_add",
        requirements: [
            "sightId" => "^[-a-zA-Z]+$",
        ],
        methods: "POST"
    )]
    public function addReview(string $sightId, Request $request): SuccessResponse
    {
        $requestDto = $this->hydrator->hydrate($request->request->all(), SightReviewDto::class);

        $result = $this->useCase
            ->setSightId($sightId)
            ->setReview($requestDto)
            ->execute();
        return new SuccessResponse($result->getResult());
    }
}
