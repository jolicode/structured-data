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

final class AdultOrientedEnumerationModel
{
    public const DESCRIPTION = 'Enumeration of considerations that make a product relevant or potentially restricted for adults only.';
    public const LABEL = 'AdultOrientedEnumeration';
    public const NAME = 'schema:AdultOrientedEnumeration';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['AlcoholConsiderationModel' => 'EnumerationMember\AlcoholConsiderationModel', 'DangerousGoodConsiderationModel' => 'EnumerationMember\DangerousGoodConsiderationModel', 'HealthcareConsiderationModel' => 'EnumerationMember\HealthcareConsiderationModel', 'NarcoticConsiderationModel' => 'EnumerationMember\NarcoticConsiderationModel', 'ReducedRelevanceForChildrenConsiderationModel' => 'EnumerationMember\ReducedRelevanceForChildrenConsiderationModel', 'SexualContentConsiderationModel' => 'EnumerationMember\SexualContentConsiderationModel', 'TobaccoNicotineConsiderationModel' => 'EnumerationMember\TobaccoNicotineConsiderationModel', 'UnclassifiedAdultConsiderationModel' => 'EnumerationMember\UnclassifiedAdultConsiderationModel', 'ViolenceConsiderationModel' => 'EnumerationMember\ViolenceConsiderationModel', 'WeaponConsiderationModel' => 'EnumerationMember\WeaponConsiderationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2989'];
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
