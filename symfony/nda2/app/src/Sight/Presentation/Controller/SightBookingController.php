<?php

namespace App\Sight\Presentation\Controller;

use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;
use App\Sight\Application\Dto\SightBookingRequestDto;
use App\Sight\Application\UseCase\AddBookingRequestSightUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SightBookingController extends AbstractController
{
    public function __construct(
        private readonly AddBookingRequestSightUseCase $useCase,
        private readonly TypedReflectionHydrator       $hydrator
    )
    {
    }

    #[Route(
        "/sights/{sightId}/booking",
        name: "sight_booking",
        requirements: [
            "sightId" => "^[-a-zA-Z]+$",
        ],
        methods: "POST"
    )]
    public function addBookingRequest(string $sightId, Request $request): SuccessResponse
    {
        $requestDto = $this->hydrator->hydrate($request->request->all(), SightBookingRequestDto::class);

        $result = $this->useCase
            ->setSightId($sightId)
            ->setBookingRequest($requestDto)
            ->execute();
        return new SuccessResponse($result->getResult());
    }
}
