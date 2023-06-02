<?php

namespace Jolicode\JsonLd\Validation;

class ValidationResult
{
    public function __construct(
        /**
         * @var ValidationError|array<ValidationError>
         */
        private ValidationError|array $errors = [],

        private ?object $type = null,
    ) {
    }

    public function setType(object $type): void
    {
        $this->type = $type;
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    /**
     * @return array<ValidationError>
     */
    public function getErrors(): array
    {
        return (array) $this->errors;
    }

    public function addError(string $message): void
    {
        $this->errors[] = new ValidationError($message);
    }

    public function getErrorMessages(): array
    {
        return array_map(
            fn (ValidationError $error) => $error->message,
            $this->getErrors()
        );
    }
}
