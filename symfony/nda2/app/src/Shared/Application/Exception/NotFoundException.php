<?php

namespace App\Shared\Application\Exception;

use App\Shared\Application\Enum\ErrorEnum;
use Throwable;

class NotFoundException extends AppException
{
    public const HTTP_CODE = 404;

    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(ErrorEnum::E_1002, $previous);
    }
}
