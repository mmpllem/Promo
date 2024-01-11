<?php

namespace App\Controller\Promo\Promotions;

use App\Promo\Repositories\Promotions\PromotionsInterface;
use App\Promo\Repositories\Promotions\PromotionsRepository;
use App\System\Controller\AbstractController;
use App\System\Entities\Error;
use App\System\Entities\Result;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionMainPromotionController extends AbstractController
{
    private PromotionsInterface $repository;
    private Result                      $result;

    public function __construct(PromotionsRepository $repository, Result $result)
    {
        $this->repository = $repository;
        $this->result     = $result;
    }

    /**
     * @Route(
     *     "/api/promo/promotions/mainPromotion",
     *      name="promo_promotions_main_promotion",
     *      methods={"GET"},
     * )
     */
    public function get(): Response
    {
        $promotion = $this->repository->getMainPromotion();
        if ($promotion) {
            $this->result->setResult($promotion);
        } else {
            $this->result->addError(new Error("not found"));
        }
        return $this->json($this->result);
    }
}
