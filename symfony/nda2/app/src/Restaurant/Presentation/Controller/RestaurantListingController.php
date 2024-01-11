<?php

namespace App\Restaurant\Presentation\Controller;

use App\Restaurant\Application\UseCase\ShowListingRestaurantUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantListingController extends AbstractController
{
    public function __construct(
        private readonly ShowListingRestaurantUseCase $useCase,
    )
    {
    }

    #[Route(
        "/restaurants/",
        name: "restaurants_list",
        methods: "GET"
    )]
    public function showListing(Request $request): SuccessResponse
    {
        if ($settlementId = $request->query->getInt("settlementId")) {
            $this->useCase->setSettlementId($settlementId);
        }
        if ($restaurantTypeId = $request->query->getInt("restaurantTypeId")) {
            $this->useCase->setRestaurantTypeId($restaurantTypeId);
        }
        if ($kitchenId = $request->query->getInt("kitchenId")) {
            $this->useCase->setKitchenId($kitchenId);
        }
        $result = $this->useCase
            ->setPage($request->query->getInt("page") ?: 1)
            ->setLimit($request->query->getInt("limit") ?: 1)
            ->execute();

        return new SuccessResponse($result->getResult());
    }
}
