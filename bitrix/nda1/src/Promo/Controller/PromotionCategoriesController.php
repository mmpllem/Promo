<?php

namespace App\Controller\Promo\Promotions;

use App\Promo\Repositories\Promotions\PromotionCategoryInterface;
use App\Promo\Repositories\Promotions\PromotionCategoryRepository;
use App\System\Controller\AbstractController;
use App\System\Entities\Error;
use App\System\Entities\Result;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionCategoriesController extends AbstractController
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
     *     "/api/promo/promotions/categories",
     *      name="promo_promotions_categories",
     *      methods={"GET"},
     * )
     */
    public function get(): Response
    {
        $promotions = $this->repository->getCategories();
        if ($promotions) {
            $this->result->setResult($promotions);
        } else {
            $this->result->addError(new Error("not found"));
        }
        return $this->json($this->result);
    }
}
