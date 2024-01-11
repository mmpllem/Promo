<?php

namespace App\Infrastructure\Listener;

use App\Infrastructure\ExceptionHandler\ExceptionMapping;
use App\Infrastructure\ExceptionHandler\ExceptionMappingResolver;
use App\Infrastructure\Model\ErrorResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

readonly class ApiExceptionListener
{
    public function __construct(
        private ExceptionMappingResolver $exceptionMappingResolver,
        private LoggerInterface          $logger,
        private SerializerInterface      $serializer
    )
    {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        if ('dev' === $_ENV['APP_ENV']) {
//            return;
        }
        $throwable = $event->getThrowable();
        if ($this->isSecurityException($throwable)) {
            return;
        }

        $mapping = $this->exceptionMappingResolver->resolve(get_class($throwable));
        if (null === $mapping) {
            $mapping = ExceptionMapping::fromCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if ($mapping->getCode() >= Response::HTTP_INTERNAL_SERVER_ERROR) {
            $this->logger->error($throwable->getMessage(), [
                'trace' => $throwable->getTrace(),
                'prev'  => null !== $throwable->getPrevious() ? $throwable->getPrevious()->getMessage() : '',
            ]);
        }
        $message  = $mapping->isHidden() ? Response::$statusTexts[$mapping->getCode()] : $throwable->getMessage();
        $data     = $this->serializer->serialize(new ErrorResponse($message), JsonEncoder::FORMAT);
        $response = new JsonResponse($data, $mapping->getCode(), [], true);
        $event->setResponse($response);
    }

    private function isSecurityException(\Throwable $throwable): bool
    {
        return $throwable instanceof AuthenticationException || $throwable instanceof AccessDeniedException;
    }
}
