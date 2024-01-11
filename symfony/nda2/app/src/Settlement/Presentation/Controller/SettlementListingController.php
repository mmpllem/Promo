<?php

namespace App\Settlement\Presentation\Controller;

use App\Settlement\Application\UseCase\ShowListingSettlementUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SettlementListingController extends AbstractController
{
    public function __construct(
        private readonly ShowListingSettlementUseCase $useCase,
    )
    {
    }

    #[Route(
        "/settlements/",
        name: "settlement_list",
        methods: "GET"
    )]
    public function showListing(Request $request): SuccessResponse
    {
        $result = $this->useCase
            ->setPage($request->query->getInt("page") ?: 1)
            ->setLimit($request->query->getInt("limit") ?: 1)
            ->execute();

        return new SuccessResponse($result->getResult());
    }
}
