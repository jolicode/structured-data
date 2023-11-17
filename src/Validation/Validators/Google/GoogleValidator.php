<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Validators\Google;

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Validation\Error\ValidationError;
use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;
use Jolicode\JsonLd\Validation\Validators\ValidatorInterface;

class GoogleValidator implements ValidatorInterface
{
    private const BASE_NAMESPACE = 'Google';

    private const DATA_TYPE_DATE = 'Date';
    private const DATA_TYPE_TIME = 'Time';
    private const DATA_TYPE_DATETIME = 'DateTime';
    private const DATA_TYPE_URL = 'URL';

    private static string $rootType = '';

    // TODO : Type validation should intersect keys of recommended/required properties and found properties. If missing, generate corresponding errors.

    public static function validateType(MappedType $type, ?MappedProperty $property, array $typesStack): array
    {
        $errors = [];

        if (null === $type->type) {
            $errors[] = [ValidationError::SEVERITY_WARNING, 'The @type entry of this type is missing. Google will ignore this type.'];

            return $errors;
        }

        if (\is_array($type->type)) {
            return self::validateMultipleTypesEntry($type, $property, $typesStack);
        }

        if (!$property) {
            self::$rootType = $type->type;
        }

        $baseType = self::buildFqcn($type->type);
        $nestedType = self::buildFqcn($type->type, $typesStack);

        if (!class_exists($baseType) && !class_exists($nestedType)) {
            return $errors;
        }

        $requiredProperties = [];
        $recommendedProperties = [];

        if (class_exists($baseType)) {
            $requiredProperties = array_merge($requiredProperties, $baseType::REQUIRED_PROPERTIES);
            $recommendedProperties = array_merge($recommendedProperties, $baseType::RECOMMENDED_PROPERTIES);
        }

        if (class_exists($nestedType)) {
            $requiredProperties = array_merge($requiredProperties, $nestedType::REQUIRED_PROPERTIES);
            $recommendedProperties = array_merge($recommendedProperties, $nestedType::RECOMMENDED_PROPERTIES);
        }

        self::validateRequiredProperties(
            $type,
            $requiredProperties,
            $errors
        );
        self::validateRecommendedProperties(
            $type,
            $recommendedProperties,
            $errors
        );

        return $errors;
    }

    public static function validateProperty(MappedType $type, MappedProperty $property, array $typesStack): array
    {
        $errors = [];

        foreach ((array) $type->type as $label) {
            $typeFqcn = self::buildFqcn($label, $typesStack);

            if (!class_exists($typeFqcn)) {
                continue;
            }

            $propertyKey = $property->key;

            $foundProperty = array_filter(
                [...$typeFqcn::RECOMMENDED_PROPERTIES, ...$typeFqcn::REQUIRED_PROPERTIES],
                fn (string $key) => $key === $propertyKey,
                \ARRAY_FILTER_USE_KEY
            );

            if (!\count($foundProperty)) {
                // If a property is not found, it might mean it is just a property Google doesn't care about.
                // Google only cares about what it expects to see, not about what it should not see.
                // If it should not be present, the Schema.org validator will notify it.
                continue;
            }

            foreach ($foundProperty[$propertyKey] as $propertyType) {
                if ($message = self::typeHasInvalidValue($propertyType, $property->value)) {
                    $errors[] = [ValidationError::SEVERITY_WARNING, $message];
                }
            }
        }

        return $errors;
    }

    private static function validateMultipleTypesEntry(MappedType $type, ?MappedProperty $property, array $typesStack): array
    {
        $className = self::concatenateTypeLabels($type);
        $fqcn = sprintf(
            '%s\\%s\\%s',
            self::BASE_NAMESPACE,
            $className,
            $className,
        );

        if (class_exists($fqcn)) {
            $clone = clone $type;
            $clone->type = $className;

            return self::validateType($clone, $property, $typesStack);
        }

        $cloneErrors = [];

        foreach ($type->type as $label) {
            $clone = clone $type;
            $clone->type = $label;

            $typeErrors = self::validateType($clone, $property, $typesStack);

            if (!\count($typeErrors)) {
                return [];
            }

            $cloneErrors[] = [...$typeErrors];
        }

        return $cloneErrors;
    }

    private static function validateRequiredProperties(MappedType $type, array $properties, array &$errors): void
    {
        $missingRequiredProperties = array_diff_key($properties, $type->properties);

        SpecialCasesHandler::handleSpecialRequiredProperties($type, $missingRequiredProperties);

        foreach ($missingRequiredProperties as $label => $values) {
            $message = sprintf('Missing required property: "%s"', $label);

            $errors[] = [ValidationError::SEVERITY_ERROR, $message];
        }
    }

    private static function validateRecommendedProperties(MappedType $type, array $properties, array &$errors): void
    {
        $missingRecommendedProperties = array_diff_key($properties, $type->properties);

        SpecialCasesHandler::handleSpecialRecommendedProperties($type, $missingRecommendedProperties);

        foreach ($missingRecommendedProperties as $label => $values) {
            $message = sprintf('Missing recommended property: "%s"', $label);

            $errors[] = [ValidationError::SEVERITY_WARNING, $message];
        }
    }

    private static function concatenateTypeLabels(MappedType $type): string
    {
        $className = $type->type;
        array_walk($className, fn (string & $word) => $word = ucfirst($word));
        $className = implode('', $className);

        return $className;
    }

    private static function typeHasInvalidValue(string $expectedType, string $givenValue): false|string
    {
        return match (true) {
            self::DATA_TYPE_DATE === $expectedType => self::hasIncorrectDate($givenValue),
            self::DATA_TYPE_TIME === $expectedType => self::hasIncorrectDate($givenValue),
            self::DATA_TYPE_DATETIME === $expectedType => self::hasIncorrectDate($givenValue),
            self::DATA_TYPE_URL === $expectedType => self::hasIncorrectUrl($givenValue),
            default => false,
        };
    }

    private static function hasIncorrectDate(string $givenValue): false|string
    {
        if (false === strtotime($givenValue)) {
            return sprintf('Date/time format is incompatible with the ISO 8601 standard. "%s" given', $givenValue);
        }

        return false;
    }

    private static function hasIncorrectUrl(string $givenValue): false|string
    {
        return IriResolver::isAbsoluteIri($givenValue) ? false : sprintf('Incorrect URL: "%s" given.', $givenValue);
    }

    private static function buildFqcn(string $typeName, array $parents = []): string
    {
        $fqcn = self::BASE_NAMESPACE;

        // When no parents are provided, this means we are trying to build a main type.
        // Main types have no parent and their namespace is Google\TypeName.
        if (\count($parents)) {
            array_unshift($parents, self::$rootType);
        }

        foreach ($parents as $type) {
            if (\is_array($type)) {
                // The array will be full of the same string. It is used to map the errors back to the user, it should not be used
                // for validation.
                $type = $type[0];
            }

            $fqcn .= sprintf('\\%s', ucfirst($type));
        }

        $fqcn .= sprintf('\\%s', $typeName);

        return $fqcn;
    }
}
