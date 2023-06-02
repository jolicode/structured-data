<?php

namespace Jolicode\JsonLd\Validation;

readonly class ValidationError
{
    public function __construct(
        public string $message,
    ) {
    }
}
