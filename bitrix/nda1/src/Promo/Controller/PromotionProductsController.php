<?php

namespace App\Controller\Promo\Promotions;

use App\Promo\Services\Promotions\PromotionProductsService;
use App\Service\RequestContainer;
use App\System\Controller\AbstractController;
use App\System\Entities\Error;
use App\System\Entities\Result;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionProductsController extends AbstractController
{
    private Request                  $request;
    private PromotionProductsService $service;
    private Result                   $result;


    public function __construct(RequestContainer $requestContainer, PromotionProductsService $service, Result $result)
    {
        $this->request = $requestContainer->getRequest();
        $this->service = $service;
        $this->result  = $result;
    }

    /**
     * @Route(
     *     "/api/promo/promotions/{id}/products",
     *      name="promo_promotions_products",
     *      methods={"GET"},
     *      requirements={"id"="\d+"}
     * )
     */
    public function get(int $id): Response
    {
        $this->service->setPromotionId($id);
        if ($this->request->get("page")) {
            $this->service->setPage((int)$this->request->get("page"));
        }
        if ($this->request->get("sortField") && $this->request->get("sortType")) {
            $this->service->setSortField((string)$this->request->get("sortField"));
            $this->service->setSortType((string)$this->request->get("sortType"));
        }
        if ($this->request->get("category")) {
            $this->service->setCategoryFilter((string)$this->request->get("category"));
        }
        $data = $this->service->getData();
        if ($data) {
            $this->result->setResult($data);
        } else {
            $this->result->addError(new Error("not found"));
        }
        return $this->json($this->result);
    }
}
