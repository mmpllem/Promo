<?php

namespace App\Infrastructure\Exception;

class UserNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('user not found');
    }
}
