<?php

use App\System;
use App\System\Entities\Result;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @OA\Info(title="App API", version="1.0.0")
 * @OA\Tag(
 *     name="Basket",
 *     description="***Корзина*** - Операции для работы с корзиной"
 * )
 * @OA\Tag(
 *     name="Compare",
 *     description="***Сравнение*** - запросы для работы со сравнением"
 * )
 * @OA\Tag(
 *     name="SEO",
 *     description="***SEO*** - всякое для поисковой оптимизации"
 * )
 */
abstract class AbstractController
{
    protected function json($data, int $status = 200, array $headers = []): JsonResponse
    {
        global $APPLICATION;
        if ($APPLICATION) {
            $APPLICATION->RestartBuffer();
        }

        if ($data instanceof Result) {
            $useCaseResult = $data;
            $data          = [
                "success" => $useCaseResult->isSuccess(),
            ];
            if ($useCaseResult->isSuccess()) {
                $data["data"] = $useCaseResult->getResult();
            } else {
                $data["errors"] = $useCaseResult->getErrors();
            }
        }

        if ($APPLICATION) {
            $data = System::getInstance()->sqlTracker->enrich($data);
        }

        return JsonResponse::create($data, $status, $headers);
    }
}
