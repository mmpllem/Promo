<?php

namespace App\Infrastructure\Model;

use OpenApi\Annotations as OA;

readonly class ErrorResponse
{
    public function __construct(
        private string $message,
        private mixed $details = null
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @OA\Property(type="object")
     */
    public function getDetails(): array
    {
        return $this->details;
    }
}
