<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Validators;

use Jolicode\JsonLd\Mapper\MappedError;
use Jolicode\JsonLd\Mapper\MappedProperty;
use Jolicode\JsonLd\Mapper\MappedType;
use Jolicode\JsonLd\Parser\Range;

abstract class AbstractValidator
{
    public const VALIDATOR_NAME = 'AbstractValidator';

    /**
     * This method must validate a type exists.
     *
     * @return MappedError[]
     */
    abstract public function validateType(MappedType $type): array;

    /**
     * This method must validate a generic property, like a string or a boolean.
     *
     * @return MappedError[]
     */
    abstract public function validateProperty(MappedType $type, MappedProperty $property, ?MappedProperty $originalProperty = null): array;

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
}
