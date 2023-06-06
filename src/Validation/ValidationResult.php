<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation;

class ValidationResult
{
    public function __construct(
        /**
         * @var ValidationError|array<ValidationError>
         */
        private ValidationError|array $errors = [],
    ) {
    }

    public function isValid(): bool
    {
        return 0 === \count((array) $this->errors);
    }

    /**
     * @return array<ValidationError>
     */
    public function getErrors(): array
    {
        return (array) $this->errors;
    }

    public function addError(string $message, object $type): void
    {
        $this->errors[] = new ValidationError($message, $type);
    }

    public function getErrorMessages(): array
    {
        return array_map(
            fn (ValidationError $error) => $error->message,
            $this->getErrors()
        );
    }
}
