<?php

declare(strict_types=1);

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

final class HealthPlanCostSharingSpecificationModel
{
    public const DESCRIPTION = 'A description of costs to the patient under a given network or formulary.';
    public const LABEL = 'HealthPlanCostSharingSpecification';
    public const NAME = 'schema:HealthPlanCostSharingSpecification';
    public const PARENTS = ['IntangibleModel' => 'SchemaOrg\\Type\\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\HealthPlanCoinsuranceOptionModel $healthPlanCoinsuranceOption = null,
        public ?Property\HealthPlanCoinsuranceRateModel $healthPlanCoinsuranceRate = null,
        public ?Property\HealthPlanCopayModel $healthPlanCopay = null,
        public ?Property\HealthPlanCopayOptionModel $healthPlanCopayOption = null,
        public ?Property\HealthPlanPharmacyCategoryModel $healthPlanPharmacyCategory = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
