<?php

namespace App\Controller\Promo\Promotions;

use App\Promo\Repositories\Promotions\PromotionCategoryInterface;
use App\Promo\Repositories\Promotions\PromotionCategoryRepository;
use App\System\Controller\AbstractController;
use App\System\Entities\Error;
use App\System\Entities\Result;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionCategoryController extends AbstractController
{
    private PromotionCategoryInterface $repository;
    private Result                     $result;

    public function __construct(PromotionCategoryRepository $repository, Result $result)
    {
        $this->repository = $repository;
        $this->result     = $result;
    }

    /**
     * @Route(
     *     "/api/promo/promotions/category/{code}",
     *      name="promo_promotions_category",
     *      methods={"GET"},
     * )
     */
    public function get(string $code): Response
    {
        $promotion = $this->repository->getCategoryByCode($code);
        if ($promotion) {
            $this->result->setResult($promotion);
        } else {
            $this->result->addError(new Error("not found"));
        }
        return $this->json($this->result);
    }
}
