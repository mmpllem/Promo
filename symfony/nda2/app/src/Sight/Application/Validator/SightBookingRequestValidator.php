<?php

namespace App\Sight\Application\Validator;

use App\Shared\Application\Enum\ErrorEnum;
use App\Shared\Application\Validator\AbstractValidator;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class SightBookingRequestValidator extends AbstractValidator
{
    protected function getValidationSchema(): Collection
    {
        return new Collection([
            "fields" => [
                "fullName"          => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                ],
                "phone"             => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                    new Regex(
                        "/7\d{10}$/",
                        ErrorEnum::E_2003->value
                    ),
                ],
                "email"             => [
                    new Email(
                        [],
                        ErrorEnum::E_2005->value
                    ),
                ],
                "countChildPersons" => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value

                    ),
                ],
                "countAdultPersons" => [
                    new NotBlank(
                        [],
                        ErrorEnum::E_2001->value
                    ),
                ],
            ],
        ]);
    }
}
