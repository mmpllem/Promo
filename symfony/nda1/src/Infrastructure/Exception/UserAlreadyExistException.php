<?php

namespace App\Infrastructure\Exception;

class UserAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('user already exist');
    }
}
