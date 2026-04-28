<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Validators\Google;

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\Vocabularies\Mapper\MappedError;
use Jolicode\Vocabularies\Mapper\MappedProperty;
use Jolicode\Vocabularies\Mapper\MappedType;
use Jolicode\Vocabularies\Validators\AbstractValidator;
use Jolicode\Vocabularies\Validators\Google\SpecialRules\SpecialRulesRegistry;

class GoogleValidator extends AbstractValidator
{
    public const VALIDATOR_NAME = 'Google';
    public const DATA_TYPES = [
        self::DATA_TYPE_DATE,
        self::DATA_TYPE_TIME,
        self::DATA_TYPE_DATETIME,
        self::DATA_TYPE_URL,
        self::DATA_TYPE_TEXT,
    ];

    private const DATA_TYPE_DATE = 'Date';
    private const DATA_TYPE_TIME = 'Time';
    private const DATA_TYPE_DATETIME = 'DateTime';
    private const DATA_TYPE_URL = 'URL';
    private const DATA_TYPE_TEXT = 'Text';

    private const SEVERITY_REQUIRED = 'required';
    private const SEVERITY_RECOMMENDED = 'recommended';

    public function __construct(
        private readonly Stack $stack = new Stack(),
    ) {
    }

    public function validateType(MappedType $type): array
    {
        $errors = [];

        if (null === $type->type) {
            $message = 'The @type entry of this type is missing. Google will ignore this type, which can prevent rich-results eligibility.';
            $target = $type->parentProperty ?: $type;

            $errors[] = $this->addMappedError($target, $message, $type, MappedError::SEVERITY_WARNING);

            return $errors;
        }

        if (\is_array($type->type)) {
            return $this->validateMultipleTypesEntry($type);
        }

        $currentProperties = $this->stack
            ->newType($type)
            ->getTypeValidationProperties();

        if (!$currentProperties) {
            return $errors;
        }

        $this->findMissingProperties(
            $type,
            $currentProperties,
            $errors,
        );

        foreach ($this->getSpecialTypeViolations($type) as $violation) {
            $errors[] = $this->addMappedError(
                $violation['target'],
                $violation['message'],
                $type,
                $violation['severity'],
            );
        }

        return $errors;
    }

    public function validateProperty(MappedType $type, MappedProperty $property, ?MappedProperty $originalProperty = null): array
    {
        $errors = [];

        $currentProperty = $this->stack
            ->newProperty($property)
            ->getNextValidationProperty($property->key);

        if (!$currentProperty) {
            // If a property is not found, it might mean it is just a property Google doesn't care about.
            // Google only cares about what it expects to see, not about what it should not see.
            // If it should not be present, the Schema.org validator will notify it.
            return $errors;
        }

        $propertyValue = \is_array($property->value) ? $property->value : [$property->value];

        foreach ($propertyValue as $value) {
            if (\is_scalar($value)) {
                if ($message = $this->hasInvalidDataTypeValue($currentProperty, $value)) {
                    $errors[] = $this->addMappedError($property, $message, $type, MappedError::SEVERITY_WARNING);
                }

                if (\array_key_exists('value', $currentProperty)) {
                    if ($message = $this->hasInvalidExactValue($currentProperty['value'], $value)) {
                        $errors[] = $this->addMappedError($property, $message, $type, MappedError::SEVERITY_WARNING);
                    }
                }
            }
        }

        return $errors;
    }

    private function validateMultipleTypesEntry(MappedType $type): array
    {
        $totalErrors = [];

        foreach ($type->type as $label) {
            $clone = clone $type;
            $clone->type = $label;

            $typeErrors = $this->validateType($clone);

            if (!\count($typeErrors)) {
                return [];
            }

            $totalErrors[] = [...$typeErrors];
        }

        // All types in the array failed validation. Root-level errors were added
        // to clones, so they never propagated to the original type.
        // Copy any missing root-level errors back to the original type.
        $flatErrors = array_merge(...$totalErrors);

        foreach ($flatErrors as $error) {
            if (!\in_array($error, $type->errors, true)) {
                $type->errors[] = $error;
                $type->isValid = false;
            }
        }

        return $flatErrors;
    }

    private function findMissingProperties(MappedType $type, array $validationProperties, array &$errors): void
    {
        $missingProperties = array_diff_key($validationProperties, $type->properties);

        foreach ($missingProperties as $property) {
            if (\array_key_exists('@target', $property)) {
                continue;
            }

            if (self::SEVERITY_REQUIRED === $property['severity']) {
                $this->validateRequiredProperty($type, $property, $errors);
            }

            if (self::SEVERITY_RECOMMENDED === $property['severity']) {
                $this->validateRecommendedProperty($type, $property, $errors);
            }
        }
    }

    private function validateRequiredProperty(MappedType $type, array $missingProperty, array &$errors): void
    {
        if ($this->shouldIgnoreMissingRequiredProperty($type, $missingProperty)) {
            return;
        }

        if ('atLeastOneOf' === $missingProperty['name']) {
            if (!\count(array_intersect_key($missingProperty['value'], $type->properties))) {
                $message = \sprintf(
                    'Missing required property: at least one of the following properties must be present "%s"',
                    implode(', ', array_keys($missingProperty['value'])),
                );

                $errors[] = $this->addMappedError($type, $message, $type, MappedError::SEVERITY_ERROR);
            }

            return;
        }

        $message = \sprintf('Missing required property: "%s" for the type "%s"', $missingProperty['name'], $type->type);

        $errors[] = $this->addMappedError($type, $message, $type, MappedError::SEVERITY_ERROR);
    }

    private function validateRecommendedProperty(MappedType $type, array $missingProperty, array &$errors): void
    {
        if ($this->shouldIgnoreMissingRecommendedProperty($type, $missingProperty)) {
            return;
        }

        if ('atLeastOneOf' === $missingProperty['name']) {
            if (!\count(array_intersect_key($missingProperty['value'], $type->properties))) {
                $message = \sprintf(
                    'Missing recommended property: at least one of the following properties should be present "%s"',
                    implode(', ', array_keys($missingProperty['value'])),
                );

                $errors[] = $this->addMappedError($type, $message, $type, MappedError::SEVERITY_WARNING);
            }

            return;
        }

        $message = \sprintf('Missing recommended property: "%s" for the type "%s"', $missingProperty['name'], $type->type);

        $errors[] = $this->addMappedError($type, $message, $type, MappedError::SEVERITY_WARNING);
    }

    private function hasInvalidDataTypeValue(array $expectedProperty, mixed $givenValue): false|string
    {
        $supportedTypes = $expectedProperty['supportedTypes'];

        return match ($this->getMatchingDataType($supportedTypes, $givenValue)) {
            self::DATA_TYPE_DATETIME => $this->hasIncorrectDate($givenValue),
            self::DATA_TYPE_TEXT => $this->hasIncorrectText($givenValue),
            self::DATA_TYPE_URL => $this->hasIncorrectUrl($givenValue),
            default => false,
        };
    }

    private function hasInvalidExactValue(array $expectedValues, string|int $givenValue): false|string
    {
        if (\in_array($givenValue, $expectedValues, true)) {
            return false;
        }

        if (\in_array(strtolower($givenValue), $expectedValues, true)) {
            return 'The value is correct, but is not lowercased. Google expects lowercased values.';
        }

        if (!\in_array($givenValue, $expectedValues, true)) {
            return \sprintf('Incorrect value: "%s" given, expected one of "%s".', $givenValue, implode(', ', $expectedValues));
        }

        return false;
    }

    private function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        foreach ($this->getSpecialRules() as $specialRule) {
            if ($specialRule->shouldIgnoreMissingRecommendedProperty($type, $missingProperty)) {
                return true;
            }
        }

        return false;
    }

    private function getMatchingDataType(array $supportedTypes, mixed $givenValue): string|false
    {
        $timeTypes = [self::DATA_TYPE_DATE, self::DATA_TYPE_TIME, self::DATA_TYPE_DATETIME];

        // If given value is any of the 3 time types, and any of the 3 time types are supported, we validate
        if (
            \in_array($givenValue, $timeTypes, true)
            && \count(array_intersect($timeTypes, $supportedTypes))
        ) {
            return self::DATA_TYPE_DATETIME;
        }

        if (
            \in_array(self::DATA_TYPE_URL, $supportedTypes, true)
            && \is_string($givenValue)
        ) {
            return self::DATA_TYPE_URL;
        }

        if (
            \in_array(self::DATA_TYPE_TEXT, $supportedTypes, true)
            && \is_string($givenValue)
        ) {
            return self::DATA_TYPE_TEXT;
        }

        return false;
    }

    private function hasIncorrectText(mixed $givenValue, ?string $overwriteType = null): false|string
    {
        $type = $overwriteType ?? 'Text';

        $message = \sprintf(
            'Incorrect "%s" type given: value of type "%s" given.',
            $type,
            \gettype($givenValue),
        );

        return \is_string($givenValue) ? false : $message;
    }

    private function hasIncorrectDate(string $givenValue): false|string
    {
        if (false === strtotime($givenValue)) {
            return \sprintf('Date/time format is incompatible with the ISO 8601 standard. "%s" given', $givenValue);
        }

        return false;
    }

    private function hasIncorrectUrl(mixed $givenValue): false|string
    {
        if ($errorMessage = $this->hasIncorrectText($givenValue, 'URL')) {
            return $errorMessage;
        }

        return IriResolver::isAbsoluteIri($givenValue) ? false : \sprintf('Incorrect URL: "%s" given.', $givenValue);
    }

    /**
     * @return array<array{target: MappedType|MappedProperty, message: string, severity: string}>
     */
    private function getSpecialTypeViolations(MappedType $type): array
    {
        $violations = [];

        foreach ($this->getSpecialRules() as $specialRule) {
            $violations = [
                ...$violations,
                ...$specialRule->getTypeViolations($type),
            ];
        }

        return $violations;
    }

    private function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        foreach ($this->getSpecialRules() as $specialRule) {
            if ($specialRule->shouldIgnoreMissingRequiredProperty($type, $missingProperty)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<SpecialRules\SpecialRuleInterface>
     */
    private function getSpecialRules(): array
    {
        $validationClass = $this->stack->getValidationClass();

        if (null === $validationClass || !class_exists($validationClass)) {
            return [];
        }

        return SpecialRulesRegistry::forKeys($validationClass::SPECIAL_RULE_KEYS);
    }
}
