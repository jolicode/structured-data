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

final class ValueNameModel
{
    public const DESCRIPTION = 'Indicates the name of the PropertyValueSpecification to be used in URL templates and form encoding in a manner analogous to HTML\'s input@name.';
    public const LABEL = 'valueName';
    public const NAME = 'schema:valueName';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PropertyValueSpecification' => 'Jolicode\SchemaOrg\Type\PropertyValueSpecificationModel'];
}
