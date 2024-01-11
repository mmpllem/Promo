<?php

namespace App\System\Entities;

class Result
{
    /**
     * @var mixed
     */
    protected $result;
    /**
     * @var array
     */
    protected array $errors = [];

    public function isSuccess(): bool
    {
        return empty($this->errors);
    }

    public function setResult($result): self
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    public function addError(Error $error): self
    {
        $this->errors[] = $error;
        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
