<?php

namespace App\Sight\Application\Validator;

use App\Shared\Application\Enum\ErrorEnum;
use App\Shared\Application\Validator\AbstractValidator;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;

class SightValidator extends AbstractValidator
{
    protected function getValidationSchema(): Collection
    {
        return new Collection([
            "fields" => [
                "sightCode" => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                ],
            ],
        ]);
    }
}
