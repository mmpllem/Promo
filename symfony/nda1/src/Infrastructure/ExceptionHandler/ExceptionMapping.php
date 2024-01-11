<?php

namespace App\Infrastructure\ExceptionHandler;

readonly class ExceptionMapping
{
    public function __construct(
        private int $code,
        private bool $hidden,
        private bool $loggable
    ) {}

    public static function fromCode(int $code): ExceptionMapping
    {
        return new self($code, true, false);
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function isLoggable(): bool
    {
        return $this->loggable;
    }
}
