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

    public function hasInvalidDataTypeValue(array $expectedProperty, mixed $givenValue): false|string
    {
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
        // A string is judged on the value it carries, not on the JSON type it was written
        // with: Google reads "1800" as the number 1800, so reporting it as Text would send
        // the author looking for a problem that is not there.
        if (\is_string($value)) {
            return match (true) {
                $this->isIntegerLiteral($value) => self::DATA_TYPE_INTEGER,
                $this->isNumberLiteral($value) => self::DATA_TYPE_NUMBER,
                default => self::DATA_TYPE_TEXT,
            };
        }

        return $this->getScalarDataType($value) ?: get_debug_type($value);
    }

    /**
     * Google accepts a number written as a string, and so does schema.org: both the
     * schema.org examples and the Google documentation quote prices, positions and counts
     * indifferently as JSON numbers or as strings.
     *
     * @see https://developers.google.com/search/docs/appearance/structured-data/product-snippet#offer-properties
     */
    private function isNumberLiteral(string $value): bool
    {
        return is_numeric(trim($value));
    }

    private function isIntegerLiteral(string $value): bool
    {
        return 1 === preg_match('/^[+-]?\d+$/', trim($value));
    }

    private function isBooleanLiteral(string $value): bool
    {
        return \in_array(strtolower(trim($value)), ['true', 'false'], true);
    }

    /**
     * Recovers the number a decorated value was meant to carry.
     *
     * Google parses the value itself: a currency symbol, a thousands separator or a decimal
     * comma makes the whole property unreadable, however obvious it looks to a human. Being
     * able to name the plain number turns "this is not a Number" into something the author
     * can act on.
     *
     * @see https://developers.google.com/search/docs/appearance/structured-data/product-snippet#offer-properties
     */
    private function getPlainNumber(string $value): ?string
    {
        // Currency symbols, and spaces including the non-breaking ones a CMS inserts.
        $candidate = preg_replace('/[\p{Sc}\s\x{00A0}\x{202F}]+/u', '', $value);

        if (null === $candidate || '' === $candidate) {
            return null;
        }

        // An ISO 4217 code sits against the amount once the spaces are gone: "EUR1800", "1800EUR".
        $candidate = preg_replace('/^[A-Z]{3}(?=[\d+-])|(?<=\d)[A-Z]{3}$/', '', $candidate) ?? $candidate;

        $candidate = match (true) {
            // 1,800 and 1,800.00
            1 === preg_match('/^[+-]?\d{1,3}(?:,\d{3})+(?:\.\d+)?$/', $candidate) => str_replace(',', '', $candidate),
            // 1.800 and 1.800,00
            1 === preg_match('/^[+-]?\d{1,3}(?:\.\d{3})+(?:,\d+)?$/', $candidate) => str_replace(['.', ','], ['', '.'], $candidate),
            // 1800,00
            1 === preg_match('/^[+-]?\d+,\d+$/', $candidate) => str_replace(',', '.', $candidate),
            default => $candidate,
        };

        return is_numeric($candidate) ? $candidate : null;
    }

    private function getNumberFormattingViolation(string $givenValue, string $plainNumber): string
    {
        return \sprintf(
            'Incorrect number format: "%s" given. Google expects a plain number, without currency symbol, thousands separator or unit: "%s".',
            $givenValue,
            $plainNumber,
        );
    }

    private function getDataTypeViolation(string $expectedType, mixed $givenValue): string
    {
        return \sprintf(
            'Incorrect type value: value of type "%s" expected, but "%s" was given (%s).',
            $expectedType,
            $this->getSchemaOrgDataType($givenValue),
            \is_string($givenValue) ? \sprintf('"%s"', $givenValue) : $givenValue,
        );
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
        if (\is_int($givenValue) || \is_float($givenValue)) {
            return false;
        }

        if (\is_string($givenValue)) {
            if ($this->isNumberLiteral($givenValue)) {
                return false;
            }

            if (null !== ($plainNumber = $this->getPlainNumber($givenValue))) {
                return $this->getNumberFormattingViolation($givenValue, $plainNumber);
            }
        }

        return $this->getDataTypeViolation(self::DATA_TYPE_NUMBER, $givenValue);
    }

    private function hasIncorrectInteger(mixed $givenValue): false|string
    {
        if (\is_int($givenValue)) {
            return false;
        }

        if (\is_string($givenValue)) {
            if ($this->isIntegerLiteral($givenValue)) {
                return false;
            }

            $plainNumber = $this->getPlainNumber($givenValue);

            if (null !== $plainNumber && $this->isIntegerLiteral($plainNumber)) {
                return $this->getNumberFormattingViolation($givenValue, $plainNumber);
            }
        }

        return $this->getDataTypeViolation(self::DATA_TYPE_INTEGER, $givenValue);
    }

    private function hasIncorrectBoolean(mixed $givenValue): false|string
    {
        if (\is_bool($givenValue)) {
            return false;
        }

        if (\is_string($givenValue) && $this->isBooleanLiteral($givenValue)) {
            return false;
        }

        return $this->getDataTypeViolation(self::DATA_TYPE_BOOLEAN, $givenValue);
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
