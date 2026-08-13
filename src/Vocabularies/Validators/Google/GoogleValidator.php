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

use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Vocabularies\Validators\AbstractValidator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\SpecialRules\SpecialRulesRegistry;

class GoogleValidator extends AbstractValidator
{
    public const VALIDATOR_NAME = 'Google';

    private const SEVERITY_REQUIRED = 'required';
    private const SEVERITY_RECOMMENDED = 'recommended';

    /** @var array<string, array<SpecialRules\SpecialRuleInterface>> */
    private array $specialRulesByValidationClass = [];

    public function __construct(
        private readonly Stack $stack = new Stack(),
        private readonly DataTypeChecker $dataTypeChecker = new DataTypeChecker(),
    ) {
    }

    public function validateType(MappedType $type): array
    {
        $errors = $this->validateDuplicateKeys($type);

        if (null === $type->getType()) {
            $message = 'The @type entry of this type is missing. Google will ignore this type, which can prevent rich-results eligibility.';
            $target = $type->getParentProperty() ?: $type;

            $errors[] = $this->addMappedError($target, $message, $type, MappedError::SEVERITY_WARNING);

            return $errors;
        }

        $typeCasingErrors = $this->validateTypeCasing($type, $type);

        if ($typeCasingErrors) {
            array_push($errors, ...$typeCasingErrors);
        }

        if (\is_array($type->getType())) {
            return $this->validateMultipleTypesEntry($type);
        }

        $currentProperties = $this->stack
            ->newType($type)
            ->getTypeValidationProperties();

        $validationClass = $this->stack->getValidationClass();

        if ($validationClass && \defined($validationClass . '::DOCUMENTATION')) {
            $type->setDocumentationLink($validationClass::DOCUMENTATION);
        }

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
        if (\is_array($type->getType())) {
            return $this->validatePropertyForMultipleTypesEntry($type, $property, $originalProperty);
        }

        $errors = $this->validatePropertyCasing($type, $property);

        $currentProperty = $this->stack
            ->newType($type)
            ->getNextValidationProperty($property->getKey());

        if (!$currentProperty) {
            // If a property is not found, it might mean it is just a property Google doesn't care about.
            // Google only cares about what it expects to see, not about what it should not see.
            // If it should not be present, the Schema.org validator will notify it.
            return $errors;
        }

        $propertyValues = \is_array($property->getValue()) ? $property->getValue() : [$property->getValue()];

        foreach ($propertyValues as $propertyValue) {
            $value = $this->extractScalarPropertyValue($propertyValue);

            if (!\is_scalar($value)) {
                continue;
            }

            if ($message = $this->dataTypeChecker->hasInvalidDataTypeValue($type, $currentProperty, $value)) {
                $errors[] = $this->addMappedError(
                    $property,
                    $message,
                    $type,
                    $this->definePropertyViolationSeverity($currentProperty),
                );
            }

            if (isset($currentProperty['value'])) {
                if ($message = $this->dataTypeChecker->hasInvalidExactValue($currentProperty['value'], $value)) {
                    $errors[] = $this->addMappedError(
                        $property,
                        $message,
                        $type,
                        $this->definePropertyViolationSeverity($currentProperty, $message),
                    );
                }
            }
        }

        return $errors;
    }

    private function extractScalarPropertyValue(mixed $value): mixed
    {
        if ($value instanceof MappedType) {
            $literalValue = $value->getProperty('@value')?->getValue();

            if (\is_scalar($literalValue)) {
                return $literalValue;
            }
        }

        return $value;
    }

    private function validatePropertyForMultipleTypesEntry(MappedType $type, MappedProperty $property, ?MappedProperty $originalProperty = null): array
    {
        $typeLabels = $this->getUniqueTypeLabels($type);

        $totalErrors = [];

        foreach ($typeLabels as $label) {
            $clone = clone $type;
            $clone->setType($label);

            $typeErrors = $this->validateProperty($clone, $property, $originalProperty);

            if (!$typeErrors) {
                return [];
            }

            array_push($totalErrors, ...$typeErrors);
        }

        return $totalErrors;
    }

    private function validateMultipleTypesEntry(MappedType $type): array
    {
        $typeLabels = $this->getUniqueTypeLabels($type);

        $flatErrors = [];

        foreach ($typeLabels as $label) {
            $clone = clone $type;
            $clone->setType($label);
            $clone->setDuplicateKeys([]);

            $typeErrors = $this->validateType($clone);
            $type->setDocumentationLink($clone->getDocumentationLink());

            if (!$typeErrors) {
                return [];
            }

            array_push($flatErrors, ...$typeErrors);
        }

        // All types in the array failed validation. Root-level errors were added
        // to clones, so they never propagated to the original type.
        // Copy any missing root-level errors back to the original type.
        $rootErrorIds = [];

        foreach ($type->getErrors() as $error) {
            $rootErrorIds[spl_object_id($error)] = true;
        }

        foreach ($flatErrors as $error) {
            $errorId = spl_object_id($error);

            if (isset($rootErrorIds[$errorId])) {
                continue;
            }

            $rootErrorIds[$errorId] = true;
            $type->addError($error);
            $type->setIsValid(false);

            if (MappedError::SEVERITY_ERROR !== $type->getErrorSeverity()) {
                $type->setErrorSeverity($error->getSeverity());
            }
        }

        return $flatErrors;
    }

    /**
     * @return list<string>
     */
    private function getUniqueTypeLabels(MappedType $type): array
    {
        $typeLabels = $type->getType();

        if (!\is_array($typeLabels)) {
            return [(string) $typeLabels];
        }

        if (!isset($typeLabels[1])) {
            return array_values($typeLabels);
        }

        return array_values(array_unique($typeLabels));
    }

    private function findMissingProperties(MappedType $type, array $validationProperties, array &$errors): void
    {
        $typeProperties = $type->getProperties();

        foreach ($validationProperties as $propertyName => $property) {
            if (isset($typeProperties[$propertyName])) {
                continue;
            }

            if (isset($property['@target'])) {
                continue;
            }

            $severity = $property['severity'];

            if (self::SEVERITY_REQUIRED === $severity) {
                $this->validateRequiredProperty($type, $property, $errors);

                continue;
            }

            if (self::SEVERITY_RECOMMENDED === $severity) {
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
            if (!$this->hasAnyPropertyKey($type, $missingProperty['value'])) {
                $expectedProperties = implode(', ', array_keys($missingProperty['value']));

                $message = \sprintf(
                    'Missing required property: at least one of the following properties must be present "%s" for the type "%s"',
                    $expectedProperties,
                    $type->getType(),
                );

                $errors[] = $this->addMappedError($type, $message, $type, MappedError::SEVERITY_ERROR);
            }

            return;
        }

        $message = \sprintf('Missing required property: "%s" for the type "%s"', $missingProperty['name'], $type->getType());

        $errors[] = $this->addMappedError($type, $message, $type, MappedError::SEVERITY_ERROR);
    }

    private function validateRecommendedProperty(MappedType $type, array $missingProperty, array &$errors): void
    {
        if ($this->shouldIgnoreMissingRecommendedProperty($type, $missingProperty)) {
            return;
        }

        if ('atLeastOneOf' === $missingProperty['name']) {
            if (!$this->hasAnyPropertyKey($type, $missingProperty['value'])) {
                $expectedProperties = implode(', ', array_keys($missingProperty['value']));

                $message = \sprintf(
                    'Missing recommended property: at least one of the following properties should be present "%s"',
                    $expectedProperties,
                );

                $errors[] = $this->addMappedError($type, $message, $type, MappedError::SEVERITY_WARNING);
            }

            return;
        }

        $message = \sprintf('Missing recommended property: "%s" for the type "%s"', $missingProperty['name'], $type->getType());

        $errors[] = $this->addMappedError($type, $message, $type, MappedError::SEVERITY_WARNING);
    }

    private function definePropertyViolationSeverity(array $property, ?string $message = null): string
    {
        if ('The value is correct, but is not lowercased. Google expects lowercased values.' === $message) {
            return MappedError::SEVERITY_WARNING;
        }

        if (self::SEVERITY_REQUIRED === ($property['severity'] ?? null)) {
            return MappedError::SEVERITY_ERROR;
        }

        return MappedError::SEVERITY_WARNING;
    }

    private function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        $specialRules = $this->getSpecialRules();

        if (!isset($specialRules[0])) {
            return false;
        }

        if (!isset($specialRules[1])) {
            return $specialRules[0]->shouldIgnoreMissingRecommendedProperty($type, $missingProperty);
        }

        foreach ($specialRules as $specialRule) {
            if ($specialRule->shouldIgnoreMissingRecommendedProperty($type, $missingProperty)) {
                return true;
            }
        }

        return false;
    }

    private function hasAnyPropertyKey(MappedType $type, array $expectedProperties): bool
    {
        return (bool) array_intersect_key($expectedProperties, $type->getProperties());
    }

    /**
     * @return array<array{target: MappedType|MappedProperty, message: string, severity: string}>
     */
    private function getSpecialTypeViolations(MappedType $type): array
    {
        $specialRules = $this->getSpecialRules();

        if (!$specialRules) {
            return [];
        }

        if (!isset($specialRules[1])) {
            return $specialRules[0]->getTypeViolations($type);
        }

        $violations = [];

        foreach ($specialRules as $specialRule) {
            if (!($typeViolations = $specialRule->getTypeViolations($type))) {
                continue;
            }

            foreach ($typeViolations as $typeViolation) {
                $violations[] = $typeViolation;
            }
        }

        return $violations;
    }

    private function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        $specialRules = $this->getSpecialRules();

        if (!$specialRules) {
            return false;
        }

        if (!isset($specialRules[1])) {
            return $specialRules[0]->shouldIgnoreMissingRequiredProperty($type, $missingProperty);
        }

        foreach ($specialRules as $specialRule) {
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
        if (!$validationClass = $this->stack->getValidationClass()) {
            return [];
        }

        return $this->specialRulesByValidationClass[$validationClass] ??= SpecialRulesRegistry::forKeys($validationClass::SPECIAL_RULE_KEYS);
    }
}
