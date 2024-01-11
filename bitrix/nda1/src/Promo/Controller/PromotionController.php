<?php

namespace App\Controller\Promo\Promotions;

use App\Promo\Repositories\Promotions\PromotionInterface;
use App\Promo\Repositories\Promotions\PromotionRepository;
use App\System\Controller\AbstractController;
use App\System\Entities\Error;
use App\System\Entities\Result;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    private PromotionInterface $repository;
    private Result             $result;

    public function __construct(PromotionRepository $repository, Result $result)
    {
        $this->repository = $repository;
        $this->result     = $result;
    }

    /**
     * @Route(
     *     "/api/promo/promotions/detail/{id}",
     *      name="promo_promotions_detail",
     *      methods={"GET"},
     *      requirements={"id"="\d+"}
     * )
     */
    public function get(int $id): Response
    {
        $promotions = $this->repository->getById($id, true);
        if ($promotions) {
            $this->result->setResult($promotions);
        } else {
            $this->result->addError(new Error("not found"));
        }
        return $this->json($this->result);
    }
}
