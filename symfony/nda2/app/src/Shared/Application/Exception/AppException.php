<?php

namespace App\Shared\Application\Exception;

use App\Shared\Application\Enum\ErrorEnum;
use Exception;
use Throwable;

class AppException extends Exception
{
    public const HTTP_CODE = 500;

    public function __construct(ErrorEnum|string $error, ?Throwable $previous = null)
    {
        if ($error instanceof ErrorEnum) {
            parent::__construct($error->getMessage(), $error->value, $previous);
        } else {
            parent::__construct($error, 0, $previous);
        }
    }
}
