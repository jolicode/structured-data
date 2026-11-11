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

final class HasDigitalProductPassportModel
{
    public const DESCRIPTION = 'A link to a Digital Product Passport (DPP) or a digital record detailing the lifecycle, sustainability, and compliance data for this product or offer. This may be a direct URL, a GS1 Digital Link URI, or a nested DigitalProductPassport object. Note: This property is aligned with the IANA \'dpp\' link relation and the GS1 Web Vocabulary \'dpp\' link type.';
    public const LABEL = 'hasDigitalProductPassport';
    public const NAME = 'schema:hasDigitalProductPassport';
    public const VALUES = ['DigitalProductPassportModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DigitalProductPassportModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/DPP'];
    public const SUPERSEDED_BY = null;
}
