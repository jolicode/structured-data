<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Expand;

use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;

/**
 * Shape predicates over expanded JSON-LD objects, as the Expansion algorithm
 * understands them.
 *
 * Beware: IriCompactor carries same-named predicates with deliberately different
 * semantics, because compaction and expansion do not need the same strictness.
 * isListObject() and isNodeObject() below enforce an entry count that the
 * compaction variants do not, and IriCompactor::isGraphObject() enforces an
 * allowed-entry whitelist that this one does not. Never merge the two sets, and
 * never use IriCompactor from the Expand namespace.
 */
final class ExpandedObjectShape
{
    public static function isGraphObject(mixed $object): bool
    {
        return \is_object($object) && property_exists($object, Keyword::GRAPH->value);
    }

    public static function isValueObject(mixed $object): bool
    {
        return \is_object($object) && property_exists($object, Keyword::VALUE->value);
    }

    public static function isListObject(mixed $object): bool
    {
        if (!\is_object($object) || !property_exists($object, Keyword::LIST->value)) {
            return false;
        }

        if (property_exists($object, Keyword::INDEX->value)) {
            return 2 === \count(get_object_vars($object));
        }

        return 1 === \count(get_object_vars($object));
    }

    public static function isNodeObject(mixed $object): bool
    {
        if (!\is_object($object)) {
            return false;
        }

        if (
            property_exists($object, Keyword::VALUE->value)
            || property_exists($object, Keyword::LIST->value)
            || property_exists($object, Keyword::SET->value)
        ) {
            return false;
        }

        if (
            2 === \count(get_object_vars($object))
            && property_exists($object, Keyword::GRAPH->value)
            && property_exists($object, Keyword::CONTEXT->value)
        ) {
            return false;
        }

        return true;
    }
}
