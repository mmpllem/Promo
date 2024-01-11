<?php

namespace App\Shared\Application\Validator;

use App\Shared\Application\Enum\ErrorEnum;
use App\Shared\Application\Exception\ValidateException;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

abstract class AbstractValidator
{
    private ValidatorInterface $validator;
    private Collection         $schema;
    private array|object       $object;

    public function __construct()
    {
        $this->validator = (new ValidatorBuilder())->getValidator();
        $this->schema    = $this->getFullSchema();
    }

    public function setValidationObject(array|object $object): AbstractValidator
    {
        $this->object = $object;
        return $this;
    }

    public function validate(): void
    {
        $violations = $this->validator->validate($this->object, $this->schema);
        if ($violations->count()) {
            $violationList = [];
            foreach ($violations as $violation) {
                $param                 = $this->removeSpecialCharsFromParam($violation->getPropertyPath());
                $violationList[$param] = $violation->getMessage();
            }
            throw new ValidateException(json_encode($violationList));
        }
    }

    private function removeSpecialCharsFromParam(string $param): string
    {
        return trim($param, "]\[");
    }

    protected function getFullSchema(): Collection
    {
        $schema                       = $this->getValidationSchema();
        $schema->missingFieldsMessage = ErrorEnum::E_2001->value;
        $schema->extraFieldsMessage   = ErrorEnum::E_2002->value;
        return $schema;
    }

    abstract protected function getValidationSchema(): Collection;
}
