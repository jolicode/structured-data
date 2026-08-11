<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators\Google;

use JoliCode\StructuredData\Mapper\MappedType;

/**
 * Checks a property value against the data types Google expects.
 *
 * Every method returns either false (the value is fine) or the message describing
 * what is wrong: creating the MappedError stays the validator responsibility.
 */
final class DataTypeChecker
{
    public const DATA_TYPES = [
        self::DATA_TYPE_DATE,
        self::DATA_TYPE_TIME,
        self::DATA_TYPE_DATETIME,
        self::DATA_TYPE_URL,
        self::DATA_TYPE_TEXT,
        self::DATA_TYPE_NUMBER,
        self::DATA_TYPE_INTEGER,
        self::DATA_TYPE_BOOLEAN,
    ];

    private const DATA_TYPE_DATE = 'Date';
    private const DATA_TYPE_TIME = 'Time';
    private const DATA_TYPE_DATETIME = 'DateTime';
    private const DATA_TYPE_URL = 'URL';
    private const DATA_TYPE_TEXT = 'Text';
    private const DATA_TYPE_NUMBER = 'Number';
    private const DATA_TYPE_INTEGER = 'Integer';
    private const DATA_TYPE_BOOLEAN = 'Boolean';

    /** @var array<string, false|string> */
    private array $urlValidationResults = [];

    public function hasInvalidDataTypeValue(MappedType $type, array $expectedProperty, mixed $givenValue): false|string
    {
        $givenValue = $this->coerceScalarForSourceFormat($type, $expectedProperty['supportedTypes'], $givenValue);
        $supportedTypes = $expectedProperty['supportedTypes'];

        return match ($this->getMatchingDataType($supportedTypes, $givenValue)) {
            self::DATA_TYPE_DATE => $this->hasIncorrectDate($givenValue, self::DATA_TYPE_DATE),
            self::DATA_TYPE_TIME => $this->hasIncorrectDate($givenValue, self::DATA_TYPE_TIME),
            self::DATA_TYPE_DATETIME => $this->hasIncorrectDate($givenValue, self::DATA_TYPE_DATETIME),
            self::DATA_TYPE_TEXT => $this->hasIncorrectText($givenValue),
            self::DATA_TYPE_URL => $this->hasIncorrectUrl($givenValue),
            self::DATA_TYPE_NUMBER => $this->hasIncorrectNumber($givenValue),
            self::DATA_TYPE_INTEGER => $this->hasIncorrectInteger($givenValue),
            self::DATA_TYPE_BOOLEAN => $this->hasIncorrectBoolean($givenValue),
            default => false,
        };
    }

    public function hasInvalidExactValue(array $expectedValues, string|int $givenValue): false|string
    {
        if (isset($expectedValues[0]) && $expectedValues[0] === $givenValue) {
            return false;
        }

        if (\in_array($givenValue, $expectedValues, true)) {
            return false;
        }

        if (\is_string($givenValue)) {
            $lowercasedValue = strtolower($givenValue);

            if ($lowercasedValue !== $givenValue && \in_array($lowercasedValue, $expectedValues, true)) {
                return 'The value is correct, but is not lowercased. Google expects lowercased values.';
            }
        }

        return \sprintf('Incorrect value: "%s" given, expected one of "%s".', $givenValue, implode(', ', $expectedValues));
    }

    private function coerceScalarForSourceFormat(MappedType $type, array $supportedTypes, mixed $givenValue): mixed
    {
        if (!\is_string($givenValue) || !$supportedTypes) {
            return $givenValue;
        }

        $sourceFormat = $type->getSourceFormat();

        if ('microdata' !== $sourceFormat && 'rdfa' !== $sourceFormat) {
            return $givenValue;
        }

        $supportedTypesLookup = array_fill_keys($supportedTypes, true);

        if (isset($supportedTypesLookup[self::DATA_TYPE_INTEGER]) && preg_match('/^-?\d+$/', $givenValue)) {
            return (int) $givenValue;
        }

        if (isset($supportedTypesLookup[self::DATA_TYPE_NUMBER]) && is_numeric($givenValue)) {
            return (float) $givenValue;
        }

        if (isset($supportedTypesLookup[self::DATA_TYPE_BOOLEAN])) {
            if ('' === $givenValue) {
                return $givenValue;
            }

            return match (strtolower($givenValue)) {
                'true' => true,
                'false' => false,
                default => $givenValue,
            };
        }

        return $givenValue;
    }

    private function getMatchingDataType(array $supportedTypes, mixed $givenValue): string|false
    {
        $supportedDataTypes = array_values(array_intersect($supportedTypes, self::DATA_TYPES));

        if (!$supportedDataTypes) {
            return false;
        }

        if (!isset($supportedDataTypes[1])) {
            return $supportedDataTypes[0];
        }

        $supportedDataTypesLookup = array_fill_keys($supportedDataTypes, true);

        if (isset($supportedDataTypesLookup[self::DATA_TYPE_DATE])) {
            return self::DATA_TYPE_DATE;
        }

        if (isset($supportedDataTypesLookup[self::DATA_TYPE_TIME])) {
            return self::DATA_TYPE_TIME;
        }

        if (isset($supportedDataTypesLookup[self::DATA_TYPE_DATETIME])) {
            return self::DATA_TYPE_DATETIME;
        }

        $isString = \is_string($givenValue);

        if ($isString && isset($supportedDataTypesLookup[self::DATA_TYPE_URL])) {
            return self::DATA_TYPE_URL;
        }

        $givenValueDataType = match (true) {
            $isString => self::DATA_TYPE_TEXT,
            \is_int($givenValue) => self::DATA_TYPE_INTEGER,
            \is_float($givenValue) => self::DATA_TYPE_NUMBER,
            \is_bool($givenValue) => self::DATA_TYPE_BOOLEAN,
            default => false,
        };

        if (false !== $givenValueDataType) {
            if (isset($supportedDataTypesLookup[$givenValueDataType])) {
                return $givenValueDataType;
            }

            if (self::DATA_TYPE_INTEGER === $givenValueDataType && isset($supportedDataTypesLookup[self::DATA_TYPE_NUMBER])) {
                return self::DATA_TYPE_NUMBER;
            }
        }

        if (isset($supportedDataTypesLookup[self::DATA_TYPE_URL])) {
            return self::DATA_TYPE_URL;
        }

        if (isset($supportedDataTypesLookup[self::DATA_TYPE_TEXT])) {
            return self::DATA_TYPE_TEXT;
        }

        if (isset($supportedDataTypesLookup[self::DATA_TYPE_INTEGER])) {
            return self::DATA_TYPE_INTEGER;
        }

        if (isset($supportedDataTypesLookup[self::DATA_TYPE_NUMBER])) {
            return self::DATA_TYPE_NUMBER;
        }

        if (isset($supportedDataTypesLookup[self::DATA_TYPE_BOOLEAN])) {
            return self::DATA_TYPE_BOOLEAN;
        }

        return $supportedDataTypes[0];
    }

    private function getScalarDataType(mixed $value): string|false
    {
        return match (true) {
            \is_string($value) => self::DATA_TYPE_TEXT,
            \is_int($value) => self::DATA_TYPE_INTEGER,
            \is_float($value) => self::DATA_TYPE_NUMBER,
            \is_bool($value) => self::DATA_TYPE_BOOLEAN,
            default => false,
        };
    }

    private function hasIncorrectText(mixed $givenValue, ?string $overwriteType = null): false|string
    {
        if (\is_string($givenValue)) {
            return false;
        }

        return \sprintf(
            'Incorrect type value: value of type "%s" expected, but "%s" was given ("%s").',
            $overwriteType ?? 'Text',
            $this->getSchemaOrgDataType($givenValue),
            $givenValue,
        );
    }

    private function getSchemaOrgDataType(mixed $value): string
    {
        return $this->getScalarDataType($value) ?: get_debug_type($value);
    }

    private function hasIncorrectDate(mixed $givenValue, string $expectedType): false|string
    {
        if ($errorMessage = $this->hasIncorrectText($givenValue, $expectedType)) {
            return $errorMessage;
        }

        if (false === strtotime($givenValue)) {
            return \sprintf('Date/time format is incompatible with the ISO 8601 standard. "%s" given', $givenValue);
        }

        return false;
    }

    private function hasIncorrectNumber(mixed $givenValue): false|string
    {
        if (\is_int($givenValue) || \is_float($givenValue) || (\is_string($givenValue) && is_numeric($givenValue))) {
            return false;
        }

        $schemaOrgDataType = $this->getScalarDataType($givenValue) ?: get_debug_type($givenValue);

        return \sprintf(
            'Incorrect type value: value of type "%s" expected, but "%s" was given (%s).',
            self::DATA_TYPE_NUMBER,
            $schemaOrgDataType,
            self::DATA_TYPE_TEXT === $schemaOrgDataType ? \sprintf('"%s"', $givenValue) : $givenValue,
        );
    }

    private function hasIncorrectInteger(mixed $givenValue): false|string
    {
        if (\is_int($givenValue) || (\is_string($givenValue) && preg_match('/^-?\d+$/', $givenValue))) {
            return false;
        }

        $schemaOrgDataType = $this->getScalarDataType($givenValue) ?: get_debug_type($givenValue);

        return \sprintf(
            'Incorrect type value: value of type "%s" expected, but "%s" was given (%s).',
            self::DATA_TYPE_INTEGER,
            $schemaOrgDataType,
            self::DATA_TYPE_TEXT === $schemaOrgDataType ? \sprintf('"%s"', $givenValue) : $givenValue,
        );
    }

    private function hasIncorrectBoolean(mixed $givenValue): false|string
    {
        if (\is_bool($givenValue)) {
            return false;
        }

        $schemaOrgDataType = $this->getScalarDataType($givenValue) ?: get_debug_type($givenValue);

        return \sprintf(
            'Incorrect type value: value of type "%s" expected, but "%s" was given (%s).',
            self::DATA_TYPE_BOOLEAN,
            $schemaOrgDataType,
            self::DATA_TYPE_TEXT === $schemaOrgDataType ? \sprintf('"%s"', $givenValue) : $givenValue,
        );
    }

    private function hasIncorrectUrl(mixed $givenValue): false|string
    {
        if ($errorMessage = $this->hasIncorrectText($givenValue, 'URL')) {
            return $errorMessage;
        }

        if (isset($this->urlValidationResults[$givenValue])) {
            return $this->urlValidationResults[$givenValue];
        }

        $parts = parse_url($givenValue);

        if (false === $parts) {
            return $this->urlValidationResults[$givenValue] = \sprintf('Incorrect URL: "%s" given.', $givenValue);
        }

        $scheme = $parts['scheme'] ?? null;

        if ('http' === $scheme || 'https' === $scheme) {
            return $this->urlValidationResults[$givenValue] = false;
        }

        // Per RFC 3986, a relative reference is any URL-shaped string without a scheme.
        // A string with whitespace is not URL-shaped.
        if (null === $scheme && !str_contains($givenValue, ' ')) {
            return $this->urlValidationResults[$givenValue] = false;
        }

        return $this->urlValidationResults[$givenValue] = \sprintf('Incorrect URL: "%s" given. Expected an HTTP(S) URL or a relative URL.', $givenValue);
    }
}
