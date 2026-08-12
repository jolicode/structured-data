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

final class HealthPlanPharmacyCategoryModel
{
    public const DESCRIPTION = 'The category or type of pharmacy associated with this cost sharing.';
    public const LABEL = 'healthPlanPharmacyCategory';
    public const NAME = 'schema:healthPlanPharmacyCategory';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HealthPlanCostSharingSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HealthPlanCostSharingSpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1062'];
    public const SUPERSEDED_BY = null;
}
