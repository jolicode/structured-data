<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class RangeIncludesModel
{
    public const DESCRIPTION = 'Relates a property to a class that constitutes (one of) the expected type(s) for values of the property.';
    public const LABEL = 'rangeIncludes';
    public const NAME = 'schema:rangeIncludes';
    public const VALUES = ['ClassModel' => 'SchemaOrg\\Type\\ClassModel'];
    public const TYPES = ['Property' => 'SchemaOrg\\Type\\PropertyModel'];
}
