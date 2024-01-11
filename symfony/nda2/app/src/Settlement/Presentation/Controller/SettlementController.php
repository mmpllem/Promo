<?php

namespace App\Settlement\Presentation\Controller;

use App\Settlement\Application\UseCase\ShowExtendedSettlementUseCase;
use App\Shared\Infrastructure\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SettlementController extends AbstractController
{
    public function __construct(
        private readonly ShowExtendedSettlementUseCase $useCase,
    )
    {
    }

    #[Route(
        "/settlements/{settlementId}",
        name: "settlement",
        requirements: [
            "settlementId" => "\d+",
        ],
        methods: "GET"
    )]
    public function showSettlement(int $settlementId): SuccessResponse
    {
        $result = $this->useCase
            ->setSettlementId($settlementId)
            ->execute();
        return new SuccessResponse($result->getResult());
    }
}
