<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Validators;

readonly class ValidationResult
{
    public function __construct(
        /**
         * @var array<array<string>>
         */
        public array $errors = [],

        public bool $hasErrors = false,
        public bool $hasWarnings = false,
    ) {
    }
}
