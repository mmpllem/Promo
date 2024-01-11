<?php

namespace App\Shared\Infrastructure\Response;

use App\Shared\Application\Enum\ErrorEnum;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ErrorResponse extends JsonResponse
{
    private array   $errors;
    private ?string $message = null;

    public function __construct(int $status = 500, array $headers = [])
    {
        parent::__construct(
            $this->defaultResponse(),
            $status,
            $headers
        );

        $this->errors = [];
    }

    public function addError(int $code, string $message, ?array $additionalParam = null): self
    {
        $error = [
            "code"  => $code,
            "error" => $message,
        ];
        if ($additionalParam) {
            $error += $additionalParam;
        }
        $this->errors[] = $error;

        $this->updateData();

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        $this->updateData();
        return $this;
    }

    private function updateData(): void
    {
        $data = [];
        if ($this->message) {
            $data["message"] = $this->message;
        }
        $data["errors"] = $this->errors;
        $this->setData($data);
    }

    private function defaultResponse(): array
    {
        return [
            "errors" => [
                [
                    "code"  => ErrorEnum::E_1000->value,
                    "error" => ErrorEnum::E_1000->getMessage(),
                ],
            ],
        ];
    }
}
