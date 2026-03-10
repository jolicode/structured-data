<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class SupersededByModel
{
    public const DESCRIPTION = 'Relates a term (i.e. a property, class or enumeration) to one that supersedes it.';
    public const LABEL = 'supersededBy';
    public const NAME = 'schema:supersededBy';
    public const VALUES = ['ClassModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ClassModel', 'EnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnumerationModel', 'PropertyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyModel'];
    public const TYPES = ['Class' => 'Jolicode\Vocabularies\SchemaOrg\Type\ClassModel', 'Enumeration' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnumerationModel', 'Property' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
