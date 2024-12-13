<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Validators\SchemaOrg;

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\SchemaOrg\Mapper\MappedError;
use Jolicode\SchemaOrg\Mapper\MappedProperty;
use Jolicode\SchemaOrg\Mapper\MappedType;
use Jolicode\SchemaOrg\Validators\AbstractValidator;

class SchemaOrgValidator extends AbstractValidator
{
    public const VALIDATOR_NAME = 'SchemaOrg';

    public static function validateType(MappedType $type, ?MappedProperty $property, array $typesStack): array
    {
        $errors = [];
        $typeLabel = $type->type;
        $errorTarget = $type->getProperty(Keyword::TYPE->value) ?: $type;

        if (
            $property
            && \is_array($typeLabel)
            && \count($typeLabel) > 1
        ) {
            // @see https://www.w3.org/TR/json-ld/#specifying-the-type
            $message = \sprintf('A typed value may only have one type, %d provided', \count($typeLabel));

            $errors[] = self::addMappedError($errorTarget, $message, $type, MappedError::SEVERITY_ERROR);

            return $errors;
        }

        if (null === $typeLabel) {
            if (!$type->parent) {
                $message = 'Missing a @type entry. The @type entry is mandatory for root types';

                $errors[] = self::addMappedError($errorTarget, $message, $type, MappedError::SEVERITY_ERROR);

                return $errors;
            }

            $typeLabel = self::guessTypeFromProperties($type->properties);
            $message = 'The @type entry of this type was not set. We had to guess it from its properties. The guessed type is: ' . $typeLabel;

            $errors[] = self::addMappedError($errorTarget, $message, $type, MappedError::SEVERITY_WARNING);
        }

        foreach ((array) $typeLabel as $label) {
            if (!$label) {
                continue;
            }

            $typeFqcn = self::getTypeFqcn($label);

            if (!class_exists($typeFqcn)) {
                $message = \sprintf('The "%s" type is not a valid Schema.org type', $label);
                $errors[] = self::addMappedError($errorTarget, $message, $type, MappedError::SEVERITY_ERROR);

                continue;
            }

            $type->description = $typeFqcn::DESCRIPTION;
            $type->isPartOf = array_merge($type->isPartOf, $typeFqcn::IS_PART_OF);
            $type->source = array_merge($type->source, $typeFqcn::SOURCE);

            if ($property && !IriResolver::isAbsoluteIri($property->key)) {
                $propertyKey = self::stripActionSuffixes($property->key);

                if (!class_exists(self::getPropertyFqcn($propertyKey))) {
                    return $errors;
                }

                if (!self::propertyTypeIsValid($property->key, $typeFqcn)) {
                    $message = \sprintf('The "%s" property does not accept the "%s" type as a value', $property->key, $typeFqcn::LABEL);

                    $errors[] = self::addMappedError($errorTarget, $message, $type, MappedError::SEVERITY_ERROR);
                }
            }
        }

        return $errors;
    }

    public static function validateProperty(MappedType $type, MappedProperty $property, array $typesStack): array
    {
        $errors = [];
        $typeLabel = $type->type;

        if (!$typeLabel && !$type->parent) {
            return $errors;
        }

        $propertyKey = self::stripActionSuffixes($property->key);

        if (Keyword::tryFrom($propertyKey)) {
            return $errors;
        }

        $propertyFqcn = self::getPropertyFqcn($propertyKey);

        if (!class_exists($propertyFqcn)) {
            $message = \sprintf('This property does not exist: %s', $propertyKey);

            $errors[] = self::addMappedError($property, $message, $type, MappedError::SEVERITY_ERROR);

            return $errors;
        }

        $property->description = $propertyFqcn::DESCRIPTION;
        $property->isPartOf = array_merge($property->isPartOf, $propertyFqcn::IS_PART_OF);
        $property->source = array_merge($property->source, $propertyFqcn::SOURCE);

        if (!$typeLabel) {
            $typeLabel = self::guessTypeFromProperties($type->properties);
        }

        $typeFqcns = [];

        foreach ((array) $typeLabel as $label) {
            $typeFqcns[] = self::getTypeFqcn($label);
        }

        $propertyIsValid = false;
        $typeExists = false;

        foreach ($typeFqcns as $typeFqcn) {
            if (class_exists($typeFqcn)) {
                $typeExists = true;

                if (property_exists($typeFqcn, $propertyKey) || str_contains($typeFqcn::LABEL, 'Role')) {
                    $propertyIsValid = true;
                }
            }
        }

        if (!$typeExists) {
            return $errors;
        }

        if (!$propertyIsValid) {
            if (\is_string($typeLabel)) {
                $message = \sprintf('The property "%s" does not exist on the type "%s"', $propertyKey, $typeLabel);
            } else {
                $message = \sprintf('The property "%s" does not exist on any of these types: "%s"', $propertyKey, implode(', ', $typeLabel));
            }

            $errors[] = self::addMappedError($property, $message, $type, MappedError::SEVERITY_ERROR);
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
            if (Keyword::tryFrom($property->key)) {
                continue;
            }

            $propertyKey = self::stripActionSuffixes($property->key);
            $typeFqcn = self::getPropertyFqcn($propertyKey);

            if (!class_exists($typeFqcn)) {
                continue;
            }

            $types = $typeFqcn::VALUES;

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
        return \sprintf('Jolicode\\SchemaOrg\\Type\\%sModel', $typeShortName);
    }

    private static function getPropertyFqcn(string $propertyShortName): string
    {
        return \sprintf('Jolicode\\SchemaOrg\\Property\\%sModel', ucfirst($propertyShortName));
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

        $propertyFqcn = self::getPropertyFqcn($propertyLabel);

        if (!class_exists($propertyFqcn)) {
            return false;
        }

        $propertyValues = $propertyFqcn::VALUES;

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
