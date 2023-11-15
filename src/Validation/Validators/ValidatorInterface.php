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

use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;

interface ValidatorInterface
{
    /**
     * This method must validate a type exists.
     */
    public static function validateType(MappedType $type, ?MappedProperty $property, array $typesStack): array;

    /**
     * This method must validate a generic property, like a string or a boolean.
     */
    public static function validateProperty(MappedType $type, MappedProperty $property): array;
}
