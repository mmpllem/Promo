<?php

namespace App\Restaurant\Application\Validator;

use App\Shared\Application\Enum\ErrorEnum;
use App\Shared\Application\Validator\AbstractValidator;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;

class RestaurantValidator extends AbstractValidator
{
    protected function getValidationSchema(): Collection
    {
        return new Collection([
            "fields" => [
                "restaurantCode" => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                ],
            ],
        ]);
    }
}
