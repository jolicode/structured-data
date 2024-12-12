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

final class HealthInsurancePlanModel
{
    public const DESCRIPTION = 'A US-style health insurance plan, including PPOs, EPOs, and HMOs.';
    public const LABEL = 'HealthInsurancePlan';
    public const NAME = 'schema:HealthInsurancePlan';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BenefitsSummaryUrlModel $benefitsSummaryUrl = null,
        public ?Property\ContactPointModel $contactPoint = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\HealthPlanDrugOptionModel $healthPlanDrugOption = null,
        public ?Property\HealthPlanDrugTierModel $healthPlanDrugTier = null,
        public ?Property\HealthPlanIdModel $healthPlanId = null,
        public ?Property\HealthPlanMarketingUrlModel $healthPlanMarketingUrl = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IncludesHealthPlanFormularyModel $includesHealthPlanFormulary = null,
        public ?Property\IncludesHealthPlanNetworkModel $includesHealthPlanNetwork = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\UsesHealthPlanIdStandardModel $usesHealthPlanIdStandard = null,
    ) {
    }
}
