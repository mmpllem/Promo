<?php

namespace App\Infrastructure\ArgumentResolver;

use App\Infrastructure\Attribute\RequestBody;
use App\Infrastructure\Exception\RequestBodyConvertException;
use App\Infrastructure\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class RequestBodyArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (!$argument->getAttributesOfType(RequestBody::class, ArgumentMetadata::IS_INSTANCEOF)) {
            return [];
        }
        try {
            $model = $this->serializer->deserialize(
                $request->getContent(),
                $argument->getType(),
                JsonEncoder::FORMAT
            );
        } catch (\Throwable $throwable) {
            throw new RequestBodyConvertException($throwable);
        }

        $errors = $this->validator->validate($model);
        if ($errors->count() > 0) {
            throw new ValidationException($errors);
        }

        return [$model];
    }
}
