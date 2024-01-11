<?php

namespace App\Restaurant\Application\UseCase;

use App\Restaurant\Application\Dto\ExtendedRestaurantDto;
use App\Restaurant\Application\Validator\RestaurantValidator;
use App\Restaurant\Domain\Service\RestaurantExtendedService;
use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;

class ShowExtendedRestaurantUseCase implements UseCaseInterface
{
    private string $restaurantCode;

    public function __construct(
        private readonly RestaurantValidator       $validator,
        private readonly RestaurantExtendedService $service,
        private UseCaseResult                      $result,
    )
    {
    }

    public function setRestaurantCode(string $code): static
    {
        $this->restaurantCode = $code;
        return $this;
    }

    public function execute(): UseCaseResult
    {
        $this->validator
            ->setValidationObject(["restaurantCode" => $this->restaurantCode])
            ->validate();

        $result = (new TypedReflectionHydrator())->hydrate(
            $this->service->getRestaurantByCode($this->restaurantCode),
            ExtendedRestaurantDto::class
        );
        if (!$result) {
            throw new NotFoundException();
        }

        $this->result->setResult($result);
        return $this->result;
    }
}
