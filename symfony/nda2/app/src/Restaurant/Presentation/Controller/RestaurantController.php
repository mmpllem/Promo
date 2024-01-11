<?php

namespace App\Restaurant\Presentation\Controller;

use App\Restaurant\Application\UseCase\ShowExtendedRestaurantUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    public function __construct(
        private readonly ShowExtendedRestaurantUseCase $useCase,
    )
    {
    }

    #[Route(
        "/restaurants/{restaurantCode}",
        name: "restaurant",
        requirements: [
            "restaurantCode" => "^[-a-zA-Z]+$",
        ],
        methods: "GET"
    )]
    public function showRestaurant(string $restaurantCode): SuccessResponse
    {
        $result = $this->useCase
            ->setRestaurantCode($restaurantCode)
            ->execute();
        return new SuccessResponse($result->getResult());
    }
}
