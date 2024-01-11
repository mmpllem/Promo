<?php

namespace App\Sight\Presentation\Controller;

use App\Sight\Application\UseCase\ShowImmediateListingSightUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SightImmediateController extends AbstractController
{
    public function __construct(
        private readonly ShowImmediateListingSightUseCase $useCase,
    )
    {
    }

    #[Route(
        "/sights/immediate/show",
        name: "sight_immediate",
        methods: "GET"
    )]
    public function showImmediate(Request $request): SuccessResponse
    {
        if ($coordinates = $request->query->getString("coordinates")) {
            $this->useCase->setCoordinates($coordinates);
        }
        $result = $this->useCase
            ->setPage($request->query->getInt("page") ?: 1)
            ->setLimit($request->query->getInt("limit") ?: 1)
            ->execute();
        return new SuccessResponse($result->getResult());
    }
}
