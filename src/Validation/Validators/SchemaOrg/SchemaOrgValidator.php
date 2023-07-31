<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Validators\SchemaOrg;

use Jolicode\JsonLd\Validation\Validators\ValidationResult;
use Jolicode\JsonLd\Validation\Validators\ValidatorInterface;

class SchemaOrgValidator implements ValidatorInterface
{
    public static function validateTypeProperty(string $propertyLabel, string|array $typeLabel): ValidationResult
    {
        // @see https://www.w3.org/TR/json-ld/#specifying-the-type
        if (\is_array($typeLabel) && \count($typeLabel) > 1) {
            $message = sprintf('A value object may only have one type, %d provided', \count($typeLabel));

            return new ValidationResult(hasErrors: true, message: $message);
        }

        $typeFqcn = self::getTypeFqcn($typeLabel);

        if (!class_exists($typeFqcn)) {
            $message = sprintf('This type is not a valid Schema.org type: %s', $typeLabel);

            return new ValidationResult(hasErrors: true, message: $message);
        }

        if (!self::propertyTypeIsValid($propertyLabel, $typeFqcn)) {
            $message = sprintf('The "%s" property does not accept the "%s" type as a value', $propertyLabel, $typeFqcn::LABEL);

            return new ValidationResult(hasErrors: true, message: $message);
        }

        return new ValidationResult(hasErrors: false);
    }

    public static function validateRegularProperty(string $propertyLabel, string|array $typeLabels): ValidationResult
    {
        if (!class_exists(self::getPropertyFqcn($propertyLabel))) {
            $message = sprintf('This property does not exist: %s', $propertyLabel);

            return new ValidationResult(hasErrors: true, message: $message);
        }

        $typeFqcns = [];

        foreach ((array) $typeLabels as $label) {
            $typeFqcns[] = self::getTypeFqcn($label);
        }

        $propertyIsValid = false;

        foreach ($typeFqcns as $typeFqcn) {
            if (property_exists($typeFqcn, $propertyLabel)) {
                $propertyIsValid = true;
            }
        }

        if (!$propertyIsValid) {
            if (\is_string($typeLabels)) {
                $message = sprintf('The property "%s" does not exist on the type "%s"', $propertyLabel, $typeLabels);
            } else {
                $message = sprintf('The property "%s" does not exist on any of these types: "%s"', $propertyLabel, implode(', ', $typeLabels));
            }

            return new ValidationResult(hasErrors: true, message: $message);
        }

        return new ValidationResult(hasErrors: false);
    }

    /**
     * @param array<MappedProperty> $properties
     */
    public static function guessTypeFromProperties(array $properties): string
    {
        $possibleTypes = [];

        foreach ($properties as $property) {
            $types = self::getPropertyFqcn($property->key)::TYPES;

            foreach ($types as $shortName => $fqcn) {
                $possibleTypes[$fqcn] = $shortName;
            }
        }

        foreach ($possibleTypes as $fqcn => $shortName) {
            foreach ($properties as $property) {
                if (!property_exists($fqcn, $property->key)) {
                    unset($possibleTypes[$fqcn]);
                }
            }
        }

        if (\count($possibleTypes) > 1) {
            return self::getMostSpecificType($possibleTypes);
        }

        if (1 === \count($possibleTypes)) {
            return array_pop($possibleTypes);
        }

        return 'Thing';
    }

    private static function getMostSpecificType(array $possibleTypes): string
    {
        $typesCounts = [];

        foreach ($possibleTypes as $fqcn => $shortName) {
            $typesCounts[self::countLongestParentsChain($fqcn)] = $shortName;
        }

        ksort($typesCounts, \SORT_NUMERIC);

        return array_pop($typesCounts);
    }

    private static function countLongestParentsChain(string $fqcn, int $currentCount = 0): int
    {
        if (!$fqcn::PARENTS) {
            return $currentCount;
        }

        foreach ($fqcn::PARENTS as $parentType) {
            if (self::countLongestParentsChain($parentType, $currentCount) > $currentCount) {
                ++$currentCount;
            }
        }

        return ++$currentCount;
    }

    private static function getTypeFqcn(string $typeShortName): string
    {
        return sprintf('SchemaOrg\\Type\\%sModel', $typeShortName);
    }

    private static function getPropertyFqcn(string $propertyShortName): string
    {
        return sprintf('SchemaOrg\\Property\\%sModel', ucfirst($propertyShortName));
    }

    private static function propertyTypeIsValid(string $propertyLabel, string $typeFqcn): bool
    {
        if (!\in_array($typeFqcn, self::getPropertyFqcn($propertyLabel)::VALUES, true)) {
            foreach ($typeFqcn::PARENTS as $parentType) {
                if (self::propertyTypeIsValid($propertyLabel, $parentType)) {
                    return true;
                }
            }

            return false;
        }

        return true;
    }
}
