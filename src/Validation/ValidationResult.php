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

use Jolicode\JsonLd\Validation\Error\AbstractValidationError;
use Jolicode\JsonLd\Validation\Error\TypeValidationError;

class ValidationResult
{
    public function __construct(
        /**
         * @var AbstractValidationError|array<AbstractValidationError>
         */
        private AbstractValidationError|array $errors = [],
    ) {
    }

    public function isValid(): bool
    {
        return 0 === \count((array) $this->errors);
    }

    /**
     * @return array<AbstractValidationError>
     */
    public function getErrors(): array
    {
        return (array) $this->errors;
    }

    public function addTypeError(string $message, ?string $key, array $parents = []): void
    {
        $this->errors[] = new TypeValidationError($message, $key, $parents);
    }

    public function getErrorMessages(): array
    {
        return array_map(
            fn (AbstractValidationError $error) => $error->message,
            $this->getErrors()
        );
    }
}
