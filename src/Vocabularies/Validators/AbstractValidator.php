<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators;

use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Parser\Range;
use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;

abstract class AbstractValidator implements ValidatorInterface
{
    public const VALIDATOR_NAME = 'AbstractValidator';

    public function getValidatorName(): string
    {
        return static::VALIDATOR_NAME;
    }

    /**
     * @return MappedError[]
     */
    protected function validateDuplicateKeys(MappedType $type): array
    {
        $errors = [];

        foreach ($type->getDuplicateKeys() as $key) {
            $target = $type->getProperty($key) ?? $type;
            $message = \sprintf('Duplicate property key "%s": only the last value is used.', $key);
            $errors[] = $this->addMappedError($target, $message, $type, MappedError::SEVERITY_WARNING);
        }

        return $errors;
    }

    /**
     * @return MappedError[]
     */
    protected function validateTypeCasing(MappedType $type, MappedType|MappedProperty $errorTarget): array
    {
        $errors = [];

        foreach ((array) $type->getType() as $label) {
            if (!$label || IriResolver::isAbsoluteIri($label)) {
                continue;
            }

            $originalLabel = $this->findOriginalTypeLabel($type, $label);

            if (!$originalLabel || $originalLabel === $label || 0 !== strcasecmp($originalLabel, $label)) {
                continue;
            }

            $errors[] = $this->addMappedError(
                $type->getProperty(Keyword::TYPE->value) ?? $errorTarget,
                \sprintf('Incorrect type casing: "%s" given, expected "%s".', $originalLabel, $label),
                $type,
                MappedError::SEVERITY_ERROR,
            );
        }

        return $errors;
    }

    /**
     * @return MappedError[]
     */
    protected function validatePropertyCasing(MappedType $type, MappedProperty $property): array
    {
        $originalKey = $property->getOriginalKey();

        if (!$originalKey || $originalKey === $property->getKey() || 0 !== strcasecmp($originalKey, $property->getKey())) {
            return [];
        }

        return [
            $this->addMappedError(
                $property,
                \sprintf('Incorrect property casing: "%s" given, expected "%s".', $originalKey, $property->getKey()),
                $type,
                MappedError::SEVERITY_ERROR,
            ),
        ];
    }

    protected function addMappedError(MappedType|MappedProperty $target, string $message, MappedType $typeWithError, string $severity): MappedError
    {
        $typeLabel = $typeWithError->getType();

        if (\is_array($typeLabel)) {
            $typeLabel = \sprintf(
                '[%s]',
                implode(', ', $typeLabel),
            );
        }

        $range = array_map(
            static fn (Range $range) => \sprintf(
                '%d:%d to %d:%d',
                $range->start?->line,
                $range->start?->column,
                $range->end?->line,
                $range->end?->column,
            ),
            $target->getValueRanges(),
        );

        $range = implode(\PHP_EOL, $range);

        $error = new MappedError(
            $message,
            $target instanceof MappedProperty ? $target->getKey() : null,
            $typeLabel,
            $severity,
            static::VALIDATOR_NAME,
            $range,
            parent: $target,
        );

        $target->addError($error);
        $target->setIsValid(false);

        if (MappedError::SEVERITY_ERROR !== $target->getErrorSeverity()) {
            $target->setErrorSeverity($severity);
        }

        $parentType = $target instanceof MappedProperty ? $target->getOwnerType() : $target->getParent();

        while ($parentType) {
            if (MappedError::SEVERITY_ERROR !== $parentType->getErrorSeverity()) {
                $parentType->setErrorSeverity($severity);
            }

            if (!\in_array($error, $parentType->getErrors(), true)) {
                $parentType->addChildrenError($error);
            }

            $parentType = $parentType->getParent();
        }

        return $error;
    }

    private function findOriginalTypeLabel(MappedType $type, string $label): ?string
    {
        $originalType = $type->getOriginalType();

        if (\is_string($originalType)) {
            return $originalType;
        }

        foreach ((array) $originalType as $originalLabel) {
            if (0 === strcasecmp($originalLabel, $label)) {
                return $originalLabel;
            }
        }

        return null;
    }
}
