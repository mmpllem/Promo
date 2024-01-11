<?php

namespace App\Infrastructure\Exception;

class RequestBodyConvertException extends \RuntimeException
{
    public function __construct(\Throwable $previously)
    {
        dd($previously);
        parent::__construct('error while unmarshalling request body', 0, $previously);
    }
}
