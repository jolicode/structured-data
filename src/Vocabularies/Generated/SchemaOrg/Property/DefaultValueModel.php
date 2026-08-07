<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class DefaultValueModel
{
    public const DESCRIPTION = 'The default value of the input.  For properties that expect a literal, the default is a literal value, for properties that expect an object, it\'s an ID reference to one of the current values.';
    public const LABEL = 'defaultValue';
    public const NAME = 'schema:defaultValue';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'ThingModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['PropertyValueSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PropertyValueSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
