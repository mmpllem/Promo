<?php

namespace App\Shared\Infrastructure\EventListener;

use App\Shared\Application\Enum\ErrorEnum;
use App\Shared\Infrastructure\Exception\ApiException;
use JsonException;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ApiRequestListener
{
    public function onKernelRequest(RequestEvent $event): bool
    {
        $request = $event->getRequest();
        if ($request->getContentTypeFormat() !== "json") {
            return false;
        }

        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            throw new ApiException(ErrorEnum::E_1001);
        }

        if (!is_array($data)) {
            return true;
        }
        $request->request->replace($data);
        return true;
    }
}
