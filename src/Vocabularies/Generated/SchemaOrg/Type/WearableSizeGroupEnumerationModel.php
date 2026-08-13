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

final class WearableSizeGroupEnumerationModel
{
    public const DESCRIPTION = 'Enumerates common size groups (also known as "size types") for wearable products.';
    public const LABEL = 'WearableSizeGroupEnumeration';
    public const NAME = 'schema:WearableSizeGroupEnumeration';
    public const PARENTS = ['SizeGroupEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SizeGroupEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['WearableSizeGroupBigModel' => 'EnumerationMember\WearableSizeGroupBigModel', 'WearableSizeGroupBoysModel' => 'EnumerationMember\WearableSizeGroupBoysModel', 'WearableSizeGroupExtraShortModel' => 'EnumerationMember\WearableSizeGroupExtraShortModel', 'WearableSizeGroupExtraTallModel' => 'EnumerationMember\WearableSizeGroupExtraTallModel', 'WearableSizeGroupGirlsModel' => 'EnumerationMember\WearableSizeGroupGirlsModel', 'WearableSizeGroupHuskyModel' => 'EnumerationMember\WearableSizeGroupHuskyModel', 'WearableSizeGroupInfantsModel' => 'EnumerationMember\WearableSizeGroupInfantsModel', 'WearableSizeGroupJuniorsModel' => 'EnumerationMember\WearableSizeGroupJuniorsModel', 'WearableSizeGroupMaternityModel' => 'EnumerationMember\WearableSizeGroupMaternityModel', 'WearableSizeGroupMensModel' => 'EnumerationMember\WearableSizeGroupMensModel', 'WearableSizeGroupMissesModel' => 'EnumerationMember\WearableSizeGroupMissesModel', 'WearableSizeGroupPetiteModel' => 'EnumerationMember\WearableSizeGroupPetiteModel', 'WearableSizeGroupPlusModel' => 'EnumerationMember\WearableSizeGroupPlusModel', 'WearableSizeGroupRegularModel' => 'EnumerationMember\WearableSizeGroupRegularModel', 'WearableSizeGroupShortModel' => 'EnumerationMember\WearableSizeGroupShortModel', 'WearableSizeGroupTallModel' => 'EnumerationMember\WearableSizeGroupTallModel', 'WearableSizeGroupWomensModel' => 'EnumerationMember\WearableSizeGroupWomensModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2811'];
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
