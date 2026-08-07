<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Type;

use Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class IncentiveTypeModel
{
    public const DESCRIPTION = 'Enumerates common financial incentives for products, including tax credits, tax deductions, rebates and subsidies, etc.';
    public const LABEL = 'IncentiveType';
    public const NAME = 'schema:IncentiveType';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['IncentiveTypeLoanModel' => 'EnumerationMember\IncentiveTypeLoanModel', 'IncentiveTypeRebateOrSubsidyModel' => 'EnumerationMember\IncentiveTypeRebateOrSubsidyModel', 'IncentiveTypeTaxCreditModel' => 'EnumerationMember\IncentiveTypeTaxCreditModel', 'IncentiveTypeTaxDeductionModel' => 'EnumerationMember\IncentiveTypeTaxDeductionModel', 'IncentiveTypeTaxWaiverModel' => 'EnumerationMember\IncentiveTypeTaxWaiverModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3572'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
