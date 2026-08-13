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

use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\AbstractStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ObjectStructure;

/**
 * Shape predicates over the expanded JSON-LD the mapper walks: which entries are
 * node references, nested types, or plain "@value"/"@id" wrappers.
 */
final class ExpandedValueShape
{
    public static function isParsedFlattenedTypeReference(AbstractStructure $type): bool
    {
        if (!$type instanceof ObjectStructure) {
            return false;
        }

        $properties = $type->getProperties();

        return 1 === \count($properties)
            && \array_key_exists('id', $properties)
            && IriResolver::isBlankNodeIdentifier($properties['id']->value?->content);
    }

    public static function isTypeReference(\stdClass|MappedType|string $valueEntry): bool
    {
        if (!$valueEntry instanceof \stdClass) {
            return false;
        }

        $properties = get_object_vars($valueEntry);

        return 1 === \count($properties)
            && Keyword::ID->value === array_key_first($properties)
            && IriResolver::isBlankNodeIdentifier($valueEntry->{Keyword::ID->value});
    }

    public static function isTypeProperty(\stdClass|array|string $valueEntry): bool
    {
        if (!$valueEntry instanceof \stdClass) {
            return false;
        }

        $properties = get_object_vars($valueEntry);

        if (1 === \count($properties)) {
            if (property_exists($valueEntry, Keyword::ID->value)) {
                return IriResolver::isBlankNodeIdentifier($valueEntry->{Keyword::ID->value});
            }

            if (property_exists($valueEntry, Keyword::VALUE->value)) {
                return false;
            }
        }

        return true;
    }

    public static function isValueOrId(\stdClass|MappedType|string $valueEntry): bool
    {
        if ($valueEntry instanceof MappedType) {
            return false;
        }

        if (!$valueEntry instanceof \stdClass) {
            return false;
        }

        return property_exists($valueEntry, Keyword::VALUE->value)
            || property_exists($valueEntry, Keyword::ID->value);
    }

    /**
     * Both values will not be present at the same time.
     * Value is used for regular values, while ID is used for URIs.
     */
    public static function retrieveValueOrId(\stdClass $basicProperty): string|int|float|bool|null
    {
        return $basicProperty->{Keyword::VALUE->value} ?? $basicProperty->{Keyword::ID->value};
    }
}
