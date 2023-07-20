<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Parser\Properties;

use Jolicode\JsonLd\Validation\Error\AbstractValidationError;

class Property
{
    public function __construct(
        public readonly Key $key,
        public ?Value $value = null,

        /**
         * @var AbstractValidationError[]
         */
        private array $errors = [],
    ) {
    }

    public function isValid(): bool
    {
        return 0 === \count($this->errors);
    }

    public function addError(AbstractValidationError $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @return AbstractValidationError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
