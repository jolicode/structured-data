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

final class SpecificationModel
{
    public const DESCRIPTION = 'A specification of the product, often grouped by a section header/name. This is a cleaner alternative to additionalProperty for strict retail product specifications.';
    public const LABEL = 'specification';
    public const NAME = 'schema:specification';
    public const VALUES = ['PropertyValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel'];
    public const TYPES = ['Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/4878'];
    public const SUPERSEDED_BY = null;
}
