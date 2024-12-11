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

final class ReadonlyValueModel
{
    public const DESCRIPTION = 'Whether or not a property is mutable.  Default is false. Specifying this for a property that also has a value makes it act similar to a "hidden" input in an HTML form.';
    public const LABEL = 'readonlyValue';
    public const NAME = 'schema:readonlyValue';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['PropertyValueSpecification' => 'Jolicode\SchemaOrg\Type\PropertyValueSpecificationModel'];
}
