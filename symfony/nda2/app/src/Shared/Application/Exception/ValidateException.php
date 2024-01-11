<?php

namespace App\Shared\Application\Exception;

use App\Shared\Application\Enum\ErrorEnum;
use Throwable;

class ValidateException extends AppException
{
    public const HTTP_CODE = 400;
}
