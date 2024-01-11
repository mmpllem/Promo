<?php

namespace App\Sight\Presentation\Controller;

use App\Sight\Application\UseCase\ShowExtendedSightUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SightController extends AbstractController
{
    public function __construct(
        private readonly ShowExtendedSightUseCase $useCase,
    )
    {
    }

    #[Route(
        "/sights/{sightCode}",
        name: "sight",
        requirements: [
            "sightCode" => "^[-a-zA-Z]+$",
        ],
        methods: "GET"
    )]
    public function showSight(string $sightCode): SuccessResponse
    {
        $result = $this->useCase
            ->setSightCode($sightCode)
            ->execute();
        return new SuccessResponse($result->getResult());
    }
}
