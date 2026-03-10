<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class HealthAspectEnumerationModel
{
    public const DESCRIPTION = 'HealthAspectEnumeration enumerates several aspects of health content online, each of which might be described using [[hasHealthAspect]] and [[HealthTopicContent]].';
    public const LABEL = 'HealthAspectEnumeration';
    public const NAME = 'schema:HealthAspectEnumeration';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['AllergiesHealthAspectModel' => 'EnumerationMember\AllergiesHealthAspectModel', 'BenefitsHealthAspectModel' => 'EnumerationMember\BenefitsHealthAspectModel', 'CausesHealthAspectModel' => 'EnumerationMember\CausesHealthAspectModel', 'ContagiousnessHealthAspectModel' => 'EnumerationMember\ContagiousnessHealthAspectModel', 'EffectivenessHealthAspectModel' => 'EnumerationMember\EffectivenessHealthAspectModel', 'GettingAccessHealthAspectModel' => 'EnumerationMember\GettingAccessHealthAspectModel', 'HowItWorksHealthAspectModel' => 'EnumerationMember\HowItWorksHealthAspectModel', 'HowOrWhereHealthAspectModel' => 'EnumerationMember\HowOrWhereHealthAspectModel', 'IngredientsHealthAspectModel' => 'EnumerationMember\IngredientsHealthAspectModel', 'LivingWithHealthAspectModel' => 'EnumerationMember\LivingWithHealthAspectModel', 'MayTreatHealthAspectModel' => 'EnumerationMember\MayTreatHealthAspectModel', 'MisconceptionsHealthAspectModel' => 'EnumerationMember\MisconceptionsHealthAspectModel', 'OverviewHealthAspectModel' => 'EnumerationMember\OverviewHealthAspectModel', 'PatientExperienceHealthAspectModel' => 'EnumerationMember\PatientExperienceHealthAspectModel', 'PregnancyHealthAspectModel' => 'EnumerationMember\PregnancyHealthAspectModel', 'PreventionHealthAspectModel' => 'EnumerationMember\PreventionHealthAspectModel', 'PrognosisHealthAspectModel' => 'EnumerationMember\PrognosisHealthAspectModel', 'RelatedTopicsHealthAspectModel' => 'EnumerationMember\RelatedTopicsHealthAspectModel', 'RisksOrComplicationsHealthAspectModel' => 'EnumerationMember\RisksOrComplicationsHealthAspectModel', 'SafetyHealthAspectModel' => 'EnumerationMember\SafetyHealthAspectModel', 'ScreeningHealthAspectModel' => 'EnumerationMember\ScreeningHealthAspectModel', 'SeeDoctorHealthAspectModel' => 'EnumerationMember\SeeDoctorHealthAspectModel', 'SelfCareHealthAspectModel' => 'EnumerationMember\SelfCareHealthAspectModel', 'SideEffectsHealthAspectModel' => 'EnumerationMember\SideEffectsHealthAspectModel', 'StagesHealthAspectModel' => 'EnumerationMember\StagesHealthAspectModel', 'SymptomsHealthAspectModel' => 'EnumerationMember\SymptomsHealthAspectModel', 'TreatmentsHealthAspectModel' => 'EnumerationMember\TreatmentsHealthAspectModel', 'TypesHealthAspectModel' => 'EnumerationMember\TypesHealthAspectModel', 'UsageOrScheduleHealthAspectModel' => 'EnumerationMember\UsageOrScheduleHealthAspectModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2374'];

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
