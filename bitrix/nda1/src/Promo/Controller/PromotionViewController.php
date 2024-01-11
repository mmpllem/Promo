<?php

namespace App\Controller\Promo\Promotions;

use App\Promo\Repositories\Promotions\PromotionInterface;
use App\Promo\Repositories\Promotions\PromotionRepository;
use App\Service\RequestContainer;
use App\System\Controller\AbstractController;
use App\System\Entities\Error;
use App\System\Entities\Result;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionViewController extends AbstractController
{
    private Request            $request;
    private PromotionInterface $repository;
    private Result             $result;

    public function __construct(RequestContainer $requestContainer, PromotionRepository $repository, Result $result)
    {
        $this->request    = $requestContainer->getRequest();
        $this->repository = $repository;
        $this->result     = $result;
    }

    /**
     * @Route(
     *     "/api/promo/promotions/detail/show/",
     *      name="promo_promotions_detail_inc_show_counter",
     *      methods={"POST"},
     * )
     */
    public function get(): Response
    {
        if (!$this->repository->incShowCounter($this->request->get("id"))) {
            $this->result->addError(new Error("not found"));
        }
        return $this->json($this->result);
    }
}
