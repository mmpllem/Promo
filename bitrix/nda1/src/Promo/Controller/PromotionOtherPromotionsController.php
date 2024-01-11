<?php

namespace App\Controller\Promo\Promotions;

use App\Promo\Repositories\Promotions\PromotionsInterface;
use App\Promo\Repositories\Promotions\PromotionsRepository;
use App\Service\RequestContainer;
use App\System\Controller\AbstractController;
use App\System\Entities\Error;
use App\System\Entities\Result;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionOtherPromotionsController extends AbstractController
{
    private Request             $request;
    private PromotionsInterface $repository;
    private Result              $result;

    public function __construct(RequestContainer $requestContainer, PromotionsRepository $repository, Result $result)
    {
        $this->request    = $requestContainer->getRequest();
        $this->repository = $repository;
        $this->result     = $result;
    }

    /**
     * @Route(
     *     "/api/promo/promotions/list/other",
     *      name="promo_promotions_other_promotions",
     *      methods={"GET"},
     * )
     */
    public function get(): Response
    {
        $page       = $this->request->get("page") ?? 1;
        $promotions = $this->repository->getOtherPromotions($page);
        if ($promotions) {
            $this->result->setResult($promotions);
        } else {
            $this->result->addError(new Error("not found"));
        }
        return $this->json($this->result);
    }
}
