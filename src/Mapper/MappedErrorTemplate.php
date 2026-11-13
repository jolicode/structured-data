<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Mapper;

/**
 * The serialized form of a MappedError, as stored by the validation snippet cache.
 */
final readonly class MappedErrorTemplate
{
    public function __construct(
        public string $message,
        public string $severity,
        public ?string $validatorName,
        public ?string $documentationLink,
        public ?string $missingProperty = null,
    ) {
    }
}
