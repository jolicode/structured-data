<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type;

use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ITNonprofitTypeModel
{
    public const DESCRIPTION = 'ITNonprofitType: Non-profit organization type originating from Italy.';
    public const LABEL = 'ITNonprofitType';
    public const NAME = 'schema:ITNonprofitType';
    public const PARENTS = ['NonprofitTypeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NonprofitTypeModel'];
    public const ENUMERATION_MEMBERS = ['ITCooperativeCharityModel' => 'EnumerationMember\ITCooperativeCharityModel', 'ITMutualAidCharityModel' => 'EnumerationMember\ITMutualAidCharityModel', 'ITSocialCompanyCharityModel' => 'EnumerationMember\ITSocialCompanyCharityModel', 'ITSocialPromotionCharityModel' => 'EnumerationMember\ITSocialPromotionCharityModel', 'ITSportCompanyCharityModel' => 'EnumerationMember\ITSportCompanyCharityModel', 'ITVolunteerAssociationCharityModel' => 'EnumerationMember\ITVolunteerAssociationCharityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3629'];
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
