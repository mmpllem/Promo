<?php

namespace App\Sight\Presentation\Controller;

use App\Shared\Infrastructure\Response\SuccessResponse;
use App\Sight\Application\UseCase\ShowRandomSightUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SightRandomController extends AbstractController
{
    public function __construct(
        private readonly ShowRandomSightUseCase $useCase,
    )
    {
    }

    #[Route(
        "/sights/random/show",
        name: "sight_random",
        methods: "GET"
    )]
    public function showRandom(): SuccessResponse
    {
        $result = $this->useCase->execute();
        return new SuccessResponse($result->getResult());
    }
}
