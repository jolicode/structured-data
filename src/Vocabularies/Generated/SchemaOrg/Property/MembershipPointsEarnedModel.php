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

final class MembershipPointsEarnedModel
{
    public const DESCRIPTION = 'The number of membership points earned by the member. If necessary, the unitText can be used to express the units the points are issued in. (E.g. stars, miles, etc.)';
    public const LABEL = 'membershipPointsEarned';
    public const NAME = 'schema:membershipPointsEarned';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['MemberProgramTier' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MemberProgramTierModel', 'PriceSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PriceSpecificationModel', 'ProgramMembership' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProgramMembershipModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2085'];
    public const SUPERSEDED_BY = null;
}
