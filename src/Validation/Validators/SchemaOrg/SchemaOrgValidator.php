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

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Validation\Error\ValidationError;
use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;
use Jolicode\JsonLd\Validation\Validators\ValidatorInterface;

class SchemaOrgValidator implements ValidatorInterface
{
    public const VALIDATOR_NAME = 'SchemaOrg';

    public static function validateType(MappedType $type, ?MappedProperty $property, array $typesStack): array
    {
        $errors = [];

        $typeLabel = $type->type;

        if (
            $property
            && \is_array($typeLabel)
            && \count($typeLabel) > 1
        ) {
            // @see https://www.w3.org/TR/json-ld/#specifying-the-type
            $message = sprintf('A typed value may only have one type, %d provided.', \count($typeLabel));

            $errors[] = [ValidationError::SEVERITY_ERROR, $message];

            return $errors;
        }

        if (null === $typeLabel) {
            $typeLabel = self::guessTypeFromProperties($type->properties);

            $message = 'The @type entry of this type was not set. We had to guess it from its properties.';

            $errors[] = [ValidationError::SEVERITY_WARNING, $message];
        }

        foreach ((array) $typeLabel as $label) {
            $typeFqcn = self::getTypeFqcn($label);

            if (!class_exists($typeFqcn)) {
                $message = sprintf('The "%s" type is not a valid Schema.org type.', $label);

                $errors[] = [ValidationError::SEVERITY_ERROR, $message];

                continue;
            }

            if ($property && !IriResolver::isAbsoluteIri($property->key)) {
                if (!self::propertyTypeIsValid($property->key, $typeFqcn)) {
                    $message = sprintf('The "%s" property does not accept the "%s" type as a value.', $property->key, $typeFqcn::LABEL);

                    $errors[] = [ValidationError::SEVERITY_ERROR, $message];
                }
            }
        }

        return $errors;
    }

    public static function validateProperty(MappedType $type, MappedProperty $property, array $typesStack): array
    {
        $errors = [];
        $propertyKey = self::stripActionSuffixes($property->key);

        if (!class_exists(self::getPropertyFqcn($propertyKey))) {
            $message = sprintf('This property does not exist: %s.', $propertyKey);

            $errors[] = [ValidationError::SEVERITY_ERROR, $message];

            return $errors;
        }

        $typeFqcns = [];

        foreach ((array) $type->type as $label) {
            $typeFqcns[] = self::getTypeFqcn($label);
        }

        $propertyIsValid = false;

        foreach ($typeFqcns as $typeFqcn) {
            if (property_exists($typeFqcn, $propertyKey)) {
                $propertyIsValid = true;
            }
        }

        if (!$propertyIsValid) {
            if (\is_string($type->type)) {
                $message = sprintf('The property "%s" does not exist on the type "%s".', $propertyKey, $type->type);
            } else {
                $message = sprintf('The property "%s" does not exist on any of these types: "%s".', $propertyKey, implode(', ', $type->type));
            }

            $errors[] = [ValidationError::SEVERITY_ERROR, $message];
        }

        return $errors;
    }

    /**
     * @param array<MappedProperty> $properties
     */
    public static function guessTypeFromProperties(array $properties): string
    {
        $possibleTypes = [];

        foreach ($properties as $property) {
            $propertyKey = self::stripActionSuffixes($property->key);

            $types = self::getPropertyFqcn($propertyKey)::TYPES;

            foreach ($types as $shortName => $fqcn) {
                $possibleTypes[$fqcn] = $shortName;
            }
        }

        foreach ($possibleTypes as $fqcn => $shortName) {
            foreach ($properties as $property) {
                if (!property_exists($fqcn, self::stripActionSuffixes($property->key))) {
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

    private static function stripActionSuffixes(string $propertyLabel): string
    {
        $propertyLabel = str_replace(['-input', '-output'], '', $propertyLabel);

        return $propertyLabel;
    }

    private static function propertyTypeIsValid(string $propertyLabel, string $typeFqcn): bool
    {
        // Ok this may look weird but take a look at http://blog.schema.org/2014/06/introducing-role.html
        if (str_contains($typeFqcn::LABEL, 'Role')) {
            return true;
        }

        $propertyValues = self::getPropertyFqcn($propertyLabel)::VALUES;

        if (!\in_array($typeFqcn, $propertyValues, true)) {
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
