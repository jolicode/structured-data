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

final class HasVariantModel
{
    public const DESCRIPTION = 'Indicates a [[Product]] that is a member of this [[ProductGroup]] (or [[ProductModel]]).';
    public const LABEL = 'hasVariant';
    public const NAME = 'schema:hasVariant';
    public const VALUES = ['ProductModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const TYPES = ['ProductGroup' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductGroupModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1797'];
    public const SUPERSEDED_BY = null;
}
