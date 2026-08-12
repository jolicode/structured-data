<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class SupersededByModel
{
    public const DESCRIPTION = 'Relates a term (i.e. a property, class or enumeration) to one that supersedes it.';
    public const LABEL = 'supersededBy';
    public const NAME = 'schema:supersededBy';
    public const VALUES = ['ClassModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ClassModel', 'EnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel', 'PropertyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyModel'];
    public const TYPES = ['Class' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ClassModel', 'Enumeration' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel', 'Property' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyModel'];
    public const IS_PART_OF = ['https://meta.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
