<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class MultipleValuesModel
{
    public const DESCRIPTION = 'Whether multiple values are allowed for the property.  Default is false.';
    public const LABEL = 'multipleValues';
    public const NAME = 'schema:multipleValues';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['PropertyValueSpecification' => 'SchemaOrg\Type\PropertyValueSpecificationModel'];
}
