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

final class VariesByModel
{
    public const DESCRIPTION = 'Indicates the property or properties by which the variants in a [[ProductGroup]] vary, e.g. their size, color etc. Schema.org properties can be referenced by their short name e.g. "color"; terms defined elsewhere can be referenced with their URIs. Variant properties can be provided using [[PropertyValue]] instead of plain [[Text]], to allow specification of the values available for a variant property.';
    public const LABEL = 'variesBy';
    public const NAME = 'schema:variesBy';
    public const VALUES = ['DefinedTermModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'PropertyValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ProductGroup' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductGroupModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1797', 'https://github.com/schemaorg/schemaorg/issues/4885'];
    public const SUPERSEDED_BY = null;
}
