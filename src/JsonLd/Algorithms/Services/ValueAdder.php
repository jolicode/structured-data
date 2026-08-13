<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Services;

class ValueAdder
{
    /**
     * This is a PHP implementation of the Add Value macro based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * see https://www.w3.org/TR/json-ld-api/#algorithm-terms
     */
    public static function addValue(mixed $value, mixed $key, \stdClass|array $object, bool $asArray = false): \stdClass
    {
        if (\is_array($object) && \array_key_exists(0, $object)) {
            // We don't want to convert 0 keys to objects so we directly access the object itself.
            $object = $object[0];
        }

        $object = (object) $object;

        // 1
        if ($asArray) {
            if (!property_exists($object, $key) || !\is_array($object->$key)) {
                $object->$key = $object->$key ?? [];
            }
        }

        // 2
        if (\is_array($value)) {
            foreach ($value as $element) {
                self::addValue($element, $key, $object);
            }
        // 3
        } else {
            // 3.1
            if (!property_exists($object, $key)) {
                $object->$key = $value;
            // 3.2
            } else {
                // 3.2.1 && 3.2.2 : we always set it to an array, the result should be an object in an array.
                $object->$key[] = $value;
            }
        }

        return $object;
    }
}
