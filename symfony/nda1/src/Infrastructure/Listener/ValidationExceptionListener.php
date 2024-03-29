<?php

namespace App\Infrastructure\Listener;

use App\Infrastructure\Exception\ValidationException;
use App\Infrastructure\Model\ErrorResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

readonly class ValidationExceptionListener
{
    public function __construct(
        private SerializerInterface $serializer
    ) {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        if (!$throwable instanceof ValidationException) {
            return;
        }
        $data = $this->serializer->serialize(
            new ErrorResponse($throwable->getMessage(), ['violations' => $throwable->getViolationList()]),
            JsonEncoder::FORMAT
        );
        $event->setResponse(new JsonResponse($data, Response::HTTP_BAD_REQUEST, [], true));
    }
}
