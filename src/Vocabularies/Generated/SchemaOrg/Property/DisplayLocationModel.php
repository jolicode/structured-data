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

final class DisplayLocationModel
{
    public const DESCRIPTION = 'The location at which an item can be viewed or experienced in-person.';
    public const LABEL = 'displayLocation';
    public const NAME = 'schema:displayLocation';
    public const VALUES = ['PlaceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/4513'];
    public const SUPERSEDED_BY = null;
}
