<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\Services;

/**
 * This class is made to perform better comparisons between referenced data structures.
 *
 * PHP native methods like in_array will compare them using == or ===, which doesn't work.
 * We want a strict comparison on the properties of the data structure, but not on the data structure itself.
 */
class DataStructureComparator
{
    public static function objectAlreadyInArray(\stdClass $object, array $array): bool
    {
        foreach ($array as $arrayObject) {
            if (self::objectsHaveSameProperties($object, $arrayObject)) {
                return true;
            }
        }

        return false;
    }

    public static function objectsHaveSameProperties(object $object1, object $object2, string $propertyToSkip = null): bool
    {
        if ($object1 === $object2) {
            return true;
        }

        foreach (get_object_vars($object1) as $property => $value) {
            if ($propertyToSkip && $propertyToSkip === $property) {
                continue;
            }

            if (!property_exists($object2, $property)) {
                return false;
            }

            if (\is_object($value)) {
                if (!self::objectsHaveSameProperties($value, $object2->$property)) {
                    return false;
                }

                continue;
            }

            if ($object2->$property !== $value) {
                return false;
            }
        }

        return true;
    }
}
