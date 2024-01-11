<?php

namespace App\Sight\Application\Validator;

use App\Shared\Application\Enum\ErrorEnum;
use App\Shared\Application\Validator\AbstractValidator;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class SightReviewValidator extends AbstractValidator
{
    protected function getValidationSchema(): Collection
    {
        return new Collection([
            "fields" => [
                "score"     => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                    new Regex(
                        "/[1-3]/",
                        ErrorEnum::E_2004->value
                    ),
                ],
                "userName"  => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                ],
                "userEmail" => [
                    new Email(
                        [],
                        ErrorEnum::E_2005->value
                    ),
                ],
                "text"      => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                ],
                "city"      => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                ],
            ],
        ]);
    }
}
