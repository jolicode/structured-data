<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Parser;

use JoliCode\StructuredData\Extraction\SourceMap;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\AbstractStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ArrayStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ObjectStructure;

/**
 * Replaces the ranges of a parsed document, computed in the generated JSON, by
 * the ranges its source map gives in the HTML markup it was built from.
 *
 * A key or value the map does not know is anchored on the nearest enclosing
 * item that it does: a position inside the generated JSON is never left, as it
 * would point at an unrelated place of the page.
 */
final class SourceMapApplier
{
    public static function apply(AbstractStructure $structure, SourceMap $sourceMap): void
    {
        $rootRange = $sourceMap->getValue('');

        if (null === $rootRange) {
            return;
        }

        if (null !== $structure->range) {
            self::assign($structure->range, $rootRange);
        }

        self::walk($structure, '', $rootRange, $sourceMap);
    }

    private static function walk(AbstractStructure $structure, string $pointer, Range $fallback, SourceMap $sourceMap): void
    {
        if ($structure instanceof ObjectStructure) {
            foreach ($structure->getProperties() as $name => $property) {
                $propertyPointer = $pointer . SourceMap::pointerSegment($name);

                self::assign($property->key->range, $sourceMap->getKey($propertyPointer) ?? $fallback);

                if (null === $property->value) {
                    continue;
                }

                $valueRange = $sourceMap->getValue($propertyPointer) ?? $fallback;
                self::assign($property->value->range, $valueRange);

                if ($property->value->content instanceof AbstractStructure) {
                    self::walk($property->value->content, $propertyPointer, $valueRange, $sourceMap);
                }
            }

            return;
        }

        if ($structure instanceof ArrayStructure) {
            foreach ($structure->getValues() as $index => $value) {
                $valuePointer = $pointer . SourceMap::pointerSegment($index);
                $valueRange = $sourceMap->getValue($valuePointer) ?? $fallback;
                self::assign($value->range, $valueRange);

                if ($value->content instanceof AbstractStructure) {
                    self::walk($value->content, $valuePointer, $valueRange, $sourceMap);
                }
            }
        }
    }

    /**
     * Ranges are shared: the range of a nested structure is also the range of
     * the value holding it. They are updated in place, never replaced, so that
     * every holder sees the new position.
     */
    private static function assign(Range $target, Range $source): void
    {
        $target->start = null === $source->start ? null : clone $source->start;
        $target->end = null === $source->end ? null : clone $source->end;
    }
}
