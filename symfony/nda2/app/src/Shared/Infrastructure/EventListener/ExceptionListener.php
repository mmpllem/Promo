<?php

namespace App\Shared\Infrastructure\EventListener;

use App\Shared\Application\Enum\ErrorEnum;
use App\Shared\Application\Exception\AppException;
use App\Shared\Application\Exception\ValidateException;
use App\Shared\Infrastructure\Response\ErrorResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Throwable;

readonly final class ExceptionListener
{
    public function __construct(
        private KernelInterface $kernel,
//        private readonly LoggerInterface $logger,
    )
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if (!$exception instanceof AppException && $this->kernel->getEnvironment() === "dev") {
            throw $exception;
        }
        $response = new ErrorResponse();
        if ($exception instanceof ValidateException) {
            $errors = json_decode($exception->getMessage(), true, 512, JSON_THROW_ON_ERROR);
            foreach ($errors as $param => $error) {
                $error = ErrorEnum::from($error);
                $response->addError($error->value, $error->getMessage(), ["field" => $param]);
            }
        } else {
            $response->addError($exception->getCode(), $exception->getMessage());
            $response->setStatusCode($exception::HTTP_CODE);
        }
//        $this->logger->error(json_encode([
//            "code"    => $exception->getCode(),
//            "message" => $exception->getMessage(),
//            "trace"   => $exception->getTraceAsString(),
//        ]));

        $event->setResponse($response);
    }
}
