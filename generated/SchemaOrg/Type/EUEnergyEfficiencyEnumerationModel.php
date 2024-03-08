<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class EUEnergyEfficiencyEnumerationModel
{
    public const DESCRIPTION = 'Enumerates the EU energy efficiency classes A-G as well as A+, A++, and A+++ as defined in EU directive 2017/1369.';
    public const LABEL = 'EUEnergyEfficiencyEnumeration';
    public const NAME = 'schema:EUEnergyEfficiencyEnumeration';
    public const PARENTS = ['EnergyEfficiencyEnumerationModel' => 'SchemaOrg\Type\EnergyEfficiencyEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['EUEnergyEfficiencyCategoryA1PlusModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryA1PlusModel', 'EUEnergyEfficiencyCategoryA2PlusModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryA2PlusModel', 'EUEnergyEfficiencyCategoryA3PlusModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryA3PlusModel', 'EUEnergyEfficiencyCategoryAModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryAModel', 'EUEnergyEfficiencyCategoryBModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryBModel', 'EUEnergyEfficiencyCategoryCModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryCModel', 'EUEnergyEfficiencyCategoryDModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryDModel', 'EUEnergyEfficiencyCategoryEModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryEModel', 'EUEnergyEfficiencyCategoryFModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryFModel', 'EUEnergyEfficiencyCategoryGModel' => 'EnumerationMember\EUEnergyEfficiencyCategoryGModel'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
