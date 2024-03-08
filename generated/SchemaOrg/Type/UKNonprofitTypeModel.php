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

final class UKNonprofitTypeModel
{
    public const DESCRIPTION = 'UKNonprofitType: Non-profit organization type originating from the United Kingdom.';
    public const LABEL = 'UKNonprofitType';
    public const NAME = 'schema:UKNonprofitType';
    public const PARENTS = ['NonprofitTypeModel' => 'SchemaOrg\\Type\\NonprofitTypeModel'];
    public const ENUMERATION_MEMBERS = ['CharitableIncorporatedOrganizationModel' => 'EnumerationMember\\CharitableIncorporatedOrganizationModel', 'LimitedByGuaranteeCharityModel' => 'EnumerationMember\\LimitedByGuaranteeCharityModel', 'UKTrustModel' => 'EnumerationMember\\UKTrustModel', 'UnincorporatedAssociationCharityModel' => 'EnumerationMember\\UnincorporatedAssociationCharityModel'];

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
