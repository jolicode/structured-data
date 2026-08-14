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

use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;

interface ValidatorInterface
{
    /**
     * The name used to attribute the produced errors to this validator, e.g. in
     * diagnostic messages and audit filters.
     */
    public function getValidatorName(): string;

    /**
     * A stable string describing the parts of the validator configuration that
     * affect its output. It participates in the validation caches keys, so two
     * configurations leading to different validation results must produce
     * different signatures.
     */
    public function getConfigurationSignature(): string;

    /**
     * This method must validate a type exists.
     *
     * @return MappedError[]
     */
    public function validateType(MappedType $type): array;

    /**
     * This method must validate a generic property, like a string or a boolean.
     *
     * @return MappedError[]
     */
    public function validateProperty(MappedType $type, MappedProperty $property, ?MappedProperty $originalProperty = null): array;
}
