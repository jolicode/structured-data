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
 * The validation outcome of a MappedProperty, as stored by the validation snippet cache.
 */
final readonly class ValidatedPropertyTemplate
{
    /**
     * @param array<string>                           $isPartOf
     * @param array<string>                           $source
     * @param list<MappedErrorTemplate>               $errors
     * @param array<array-key, ValidatedTypeTemplate> $nestedTypes the templates of the
     *                                                             nested types of a
     *                                                             multi-valued property,
     *                                                             indexed like its values
     */
    public function __construct(
        public ?string $description,
        public array $isPartOf,
        public array $source,
        public array $errors,
        public ?ValidatedTypeTemplate $nestedType,
        public array $nestedTypes,
    ) {
    }
}
