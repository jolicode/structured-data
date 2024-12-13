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

final class ValueRequiredModel
{
    public const DESCRIPTION = 'Whether the property must be filled in to complete the action.  Default is false.';
    public const LABEL = 'valueRequired';
    public const NAME = 'schema:valueRequired';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['PropertyValueSpecification' => 'Jolicode\SchemaOrg\Type\PropertyValueSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
