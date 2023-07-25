<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Error;

/**
 * This error is raised when a property has one or more type(s) as a value but this type is not accepted for this property.
 */
readonly class TypePropertyValidationError extends ValidationError
{
}
