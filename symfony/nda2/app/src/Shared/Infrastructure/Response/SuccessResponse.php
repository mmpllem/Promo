<?php

namespace App\Shared\Infrastructure\Response;

use App\Shared\Application\Dto\DtoInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class SuccessResponse extends JsonResponse
{
    public function __construct(DtoInterface $dto, int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($dto, $status, $headers, $json);
    }
}
