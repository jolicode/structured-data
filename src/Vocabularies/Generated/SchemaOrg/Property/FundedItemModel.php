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

final class FundedItemModel
{
    public const DESCRIPTION = 'Indicates something directly or indirectly funded or sponsored through a [[Grant]]. See also [[ownershipFundingInfo]].';
    public const LABEL = 'fundedItem';
    public const NAME = 'schema:fundedItem';
    public const VALUES = ['BioChemEntityModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel', 'CreativeWorkModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'EventModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EventModel', 'MedicalEntityModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel', 'OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel', 'ProductModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const TYPES = ['Grant' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\GrantModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1950', 'https://github.com/schemaorg/schemaorg/issues/383'];
    public const SUPERSEDED_BY = null;
}
