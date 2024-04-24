<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Validators;

use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\Range;
use Jolicode\JsonLd\Validation\Mapper\MappedError;
use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;

abstract class AbstractValidator
{
    public const VALIDATOR_NAME = 'AbstractValidator';

    /**
     * This method must validate a type exists.
     *
     * @return MappedError[]
     */
    abstract public static function validateType(MappedType $type, ?MappedProperty $property, array $typesStack): array;

    /**
     * This method must validate a generic property, like a string or a boolean.
     *
     * @return MappedError[]
     */
    abstract public static function validateProperty(MappedType $type, MappedProperty $property, array $typesStack): array;

    protected static function addMappedError(MappedType|MappedProperty $target, string $message, MappedType $typeWithError, string $severity): MappedError
    {
        $typeLabel = $typeWithError->type;

        if (\is_array($typeLabel)) {
            $typeLabel = sprintf(
                '[%s]',
                implode(', ', $typeLabel),
            );
        }

        $range = array_map(
            fn (Range $range) => sprintf(
                'starting line %d, column %d and ending line %d, column %d',
                $range->start->line,
                $range->start->column,
                $range->end->line,
                $range->end->column,
            ),
            $target->getValueRanges(),
        );

        $range = implode(\PHP_EOL, $range);

        $error = new MappedError(
            $message,
            Keyword::TYPE->value,
            $typeLabel,
            $severity,
            static::VALIDATOR_NAME,
            $range,
        );

        $target->errors[] = $error;
        $target->isValid = false;

        if (MappedError::SEVERITY_ERROR !== $target->errorSeverity) {
            $target->errorSeverity = $severity;
        }

        $parentType = $target instanceof MappedProperty ? $target->type : $target->parent;

        while ($parentType) {
            if (MappedError::SEVERITY_ERROR !== $parentType->errorSeverity) {
                $parentType->isValid = false;
            }

            $parentType->errorSeverity = $severity;

            // We add all the errors to the base type so it is possible to count them directly without iterating over all its subtypes and properties.
            if (!$parentType->parent) {
                $parentType->errors[] = $error;
            }

            $parentType = $parentType->parent;
        }

        return $error;
    }
}
