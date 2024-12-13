<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ValueMaxLengthModel
{
    public const DESCRIPTION = 'Specifies the allowed range for number of characters in a literal value.';
    public const LABEL = 'valueMaxLength';
    public const NAME = 'schema:valueMaxLength';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['PropertyValueSpecification' => 'Jolicode\SchemaOrg\Type\PropertyValueSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
