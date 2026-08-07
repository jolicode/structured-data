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

final class HasTierRequirementModel
{
    public const DESCRIPTION = 'A requirement for a user to join a membership tier, for example: a CreditCard if the tier requires sign up for a credit card, A UnitPriceSpecification if the user is required to pay a (periodic) fee, or a MonetaryAmount if the user needs to spend a minimum amount to join the tier. If a tier is free to join then this property does not need to be specified.';
    public const LABEL = 'hasTierRequirement';
    public const NAME = 'schema:hasTierRequirement';
    public const VALUES = ['CreditCardModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreditCardModel', 'MonetaryAmountModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'UnitPriceSpecificationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const TYPES = ['MemberProgramTier' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MemberProgramTierModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3563'];
    public const SUPERSEDED_BY = null;
}
