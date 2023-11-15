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

use Jolicode\JsonLd\Validation\Error\ValidationError;
use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;
use Jolicode\JsonLd\Validation\Validators\ValidatorInterface;
use League\Uri\Exceptions\SyntaxError;
use League\Uri\Uri;

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

        // "creator":{
        //     "@type":"Organization",
        //     "url": "https://www.ncei.noaa.gov/",
        //     "name":"OC/NOAA/NESDIS/NCEI > National Centers for Environmental Information, NESDIS, NOAA, U.S. Department of Commerce",
        //     "contactPoint":{
        //        "@type":"ContactPoint",
        //        "contactType": "customer service",
        //        "telephone":"+1-828-271-4800",
        //        "email":"ncei.orders@noaa.gov"
        //     }
        //  },

        if (!$property && \is_string($type->type)) {
            self::$rootType = $type->type;
        }

        if (class_exists($fqcn = self::buildFqcn($typesStack, $type))) {
            dd($fqcn);
        }

        foreach ((array) $type->type as $label) {
            $typeNamespace = self::getFqcn($label);
        }

        return $errors;
    }

    public static function validateProperty(MappedType $type, MappedProperty $property): array
    {
        $errors = [];

        foreach ((array) $type->type as $label) {
            $typeNamespace = self::getFqcn($label);
            // TODO: not working ?
            $typeFqcn = sprintf('%s\\%s', $typeNamespace, $label);

            if (!class_exists($typeFqcn)) {
                continue;
            }

            $propertyKey = $property->key;
            // $propertyKey = ucfirst($property->key);

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
        try {
            Uri::createFromString($givenValue);
        } catch (SyntaxError $error) {
            return sprintf('Incorrect URL: "%s" given.', $givenValue);
        }

        return false;
    }

    private static function buildFqcn(array $typesStack, MappedType $currentType): string
    {
        $fqcn = self::BASE_NAMESPACE;

        foreach ($typesStack as $type) {
            // TODO : Fix this!
            if (\is_array($type)) {
                continue;
            }

            $fqcn .= sprintf('\\%s', ucfirst($type));
        }

        if (\is_string($currentType->type)) {
            $fqcn .= sprintf('\\%s', $currentType->type);
        }

        return $fqcn;
    }

    private static function getFqcn(string $label): string
    {
        return sprintf('%s\\%s', self::BASE_NAMESPACE, $label);
    }
}
