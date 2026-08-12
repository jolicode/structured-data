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

final class HasAdultConsiderationModel
{
    public const DESCRIPTION = 'Used to tag an item to be intended or suitable for consumption or use by adults only.';
    public const LABEL = 'hasAdultConsideration';
    public const NAME = 'schema:hasAdultConsideration';
    public const VALUES = ['AdultOrientedEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AdultOrientedEnumerationModel'];
    public const TYPES = ['Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2989'];
    public const SUPERSEDED_BY = null;
}
