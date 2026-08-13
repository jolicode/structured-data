<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Compact;

/**
 * The Add Value macro from the JSON-LD 1.1 Processing Algorithms and API W3C
 * Recommendation, with the exact semantics compaction relies on (an existing
 * scalar entry is wrapped into an array before appending).
 *
 * Beware: this is deliberately not Services\ValueAdder::addValue(), which has a
 * different signature and different array-wrapping semantics. The two must stay
 * apart, which is why this one lives in the Compact namespace.
 *
 * @see https://www.w3.org/TR/json-ld-api/#dfn-add-value
 */
final class CompactionValueAdder
{
    public static function addValue(\stdClass $object, string $key, mixed $value, bool $asArray = false): void
    {
        // 1
        if ($asArray && !property_exists($object, $key)) {
            $object->{$key} = [];
        }

        // 2
        if (\is_array($value)) {
            foreach ($value as $item) {
                self::addValue($object, $key, $item);
            }

            return;
        }

        // 3
        if (!property_exists($object, $key)) {
            $object->{$key} = $asArray ? [$value] : $value;

            return;
        }

        if (!\is_array($object->{$key})) {
            $object->{$key} = [$object->{$key}];
        }

        $object->{$key}[] = $value;
    }
}
