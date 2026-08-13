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

final class FundingModel
{
    public const DESCRIPTION = 'A [[Grant]] that directly or indirectly provide funding or sponsorship for this item. See also [[ownershipFundingInfo]].';
    public const LABEL = 'funding';
    public const NAME = 'schema:funding';
    public const VALUES = ['GrantModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GrantModel'];
    public const TYPES = ['BioChemEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel', 'CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EventModel', 'MedicalEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel', 'Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel', 'Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/383'];
    public const SUPERSEDED_BY = null;
}
