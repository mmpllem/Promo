<?php

namespace App\Sight\Presentation\Controller;

use App\Sight\Application\UseCase\ShowListingSightUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SightListingController extends AbstractController
{
    public function __construct(
        private readonly ShowListingSightUseCase $useCase,
    )
    {
    }

    #[Route(
        "/sights/",
        name: "sights_list",
        methods: "GET"
    )]
    public function showListing(Request $request): SuccessResponse
    {
        if ($settlementId = $request->query->getInt("settlementId")) {
            $this->useCase->setSettlementId($settlementId);
        }
        if ($sightTypeId = $request->query->getInt("sightTypeId")) {
            $this->useCase->setRestaurantTypeId($sightTypeId);
        }
        if ($kitchenId = $request->query->getInt("kitchenId")) {
            $this->useCase->setKitchenId($kitchenId);
        }
        if ($request->query->has("mainPage")) {
            $mainPage = $request->query->getBoolean("mainPage");
            $this->useCase->setMainPage($mainPage);
        }
        $result = $this->useCase
            ->setPage($request->query->getInt("page") ?: 1)
            ->setLimit($request->query->getInt("limit") ?: 1)
            ->execute();

        return new SuccessResponse($result->getResult());
    }
}
