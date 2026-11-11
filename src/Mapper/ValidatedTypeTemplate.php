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
 * The validation outcome of a MappedType, as stored by the validation snippet cache.
 */
final readonly class ValidatedTypeTemplate
{
    /**
     * @param array<string>                            $isPartOf
     * @param array<string>                            $source
     * @param list<MappedErrorTemplate>                $errors
     * @param array<string, ValidatedPropertyTemplate> $properties
     */
    public function __construct(
        public ?string $description,
        public array $isPartOf,
        public array $source,
        public ?string $documentationLink,
        public array $errors,
        public array $properties,
    ) {
    }
}
