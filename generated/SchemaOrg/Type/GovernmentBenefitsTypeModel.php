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

final class GovernmentBenefitsTypeModel
{
    public const DESCRIPTION = 'GovernmentBenefitsType enumerates several kinds of government benefits to support the COVID-19 situation. Note that this structure may not capture all benefits offered.';
    public const LABEL = 'GovernmentBenefitsType';
    public const NAME = 'schema:GovernmentBenefitsType';
    public const PARENTS = ['EnumerationModel' => 'SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['BasicIncomeModel' => 'EnumerationMember\BasicIncomeModel', 'BusinessSupportModel' => 'EnumerationMember\BusinessSupportModel', 'DisabilitySupportModel' => 'EnumerationMember\DisabilitySupportModel', 'HealthCareModel' => 'EnumerationMember\HealthCareModel', 'OneTimePaymentsModel' => 'EnumerationMember\OneTimePaymentsModel', 'PaidLeaveModel' => 'EnumerationMember\PaidLeaveModel', 'ParentalSupportModel' => 'EnumerationMember\ParentalSupportModel', 'UnemploymentSupportModel' => 'EnumerationMember\UnemploymentSupportModel'];

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
