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

interface ValidatorInterface
{
    /**
     * This method must validate a type when it is the value of a property.
     */
    public static function validateTypeProperty(string $propertyLabel, string $typeLabel): ValidationResult;

    /**
     * This method must validate a generic property, like a string or a boolean.
     */
    public static function validateRegularProperty(string $propertyLabel, string|array $typeLabels): ValidationResult;
}
